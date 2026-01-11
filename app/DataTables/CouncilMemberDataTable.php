<?php

namespace App\DataTables;

use App\Models\CouncilMember;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CouncilMemberDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        $locale = app()->getLocale();

        return datatables()
            ->eloquent($query)
            ->addColumn('name', fn ($member) => $member->name[$locale] ?? '')
            ->addColumn('bio', fn ($member) => $member->bio[$locale] ?? '')
            ->addColumn('image', function ($member) {
                if ($member->image && file_exists(storage_path('app/public/'.$member->image))) {
                    return '<img src="'.asset('storage/'.$member->image).'" class="member-img" style="width:60px;height:60px;object-fit:cover;border-radius:6px;">';
                }

                return '<span class="text-muted">No Image</span>';
            })
            ->addColumn('action', function ($member) {
                $editUrl = route('backend.council-members.edit', $member->id);
                $deleteUrl = route('backend.council-members.destroy', $member->id);
                $detailsUrl = route('backend.council-members.show', $member->id);

                return '
        <a href="'.$detailsUrl.'" class="btn btn-info btn-sm me-1" title="View">
            <i class="bi bi-eye"></i>
        </a>
        <a href="'.$editUrl.'" class="btn btn-primary btn-sm me-1" title="Edit">
            <i class="bi bi-pencil"></i>
        </a>
        <form method="POST" action="'.$deleteUrl.'" class="d-inline-block delete-form">
            '.csrf_field().method_field('DELETE').'
            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    ';
            })

            ->rawColumns(['action', 'image'])
            ->setRowId('id');
    }

    public function query(CouncilMember $model)
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('council-members-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->responsive(true)
            ->autoWidth(false)
            ->parameters([
                'responsive' => true,
                'autoWidth' => false,
            ])
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
            ]);
    }

    protected function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name')->title('Name'),
            Column::make('bio')->title('Bio'),
            Column::make('image')->title('Image')->exportable(false)->printable(false),
            Column::make('created_at')->title('Created At'),
            Column::computed('action')
                ->title('Actions')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'CouncilMembers_'.date('YmdHis');
    }
}
