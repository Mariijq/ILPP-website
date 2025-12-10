<?php

namespace App\DataTables;

use App\Models\TeamMember;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TeamMemberDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('image', function ($member) {
                if ($member->image && file_exists(storage_path('app/public/'.$member->image))) {
                    return '<img src="'.asset('storage/'.$member->image).'" style="width:60px;height:60px;object-fit:cover;border-radius:6px;">';
                }

                return '<span class="text-muted">No Image</span>';
            })
            ->addColumn('bio', fn ($member) => \Illuminate\Support\Str::limit($member->bio, 50))
            ->addColumn('action', function ($member) {
                $editUrl = route('team-members.edit', $member->id);
                $deleteUrl = route('team-members.destroy', $member->id);

                return '
        <a href="'.$editUrl.'" class="btn btn-primary btn-sm me-1" title="Edit">
            <i class="bi bi-pencil"></i>
        </a>
        <form method="POST" action="'.$deleteUrl.'" class="d-inline-block delete-form">
            '.csrf_field().method_field('DELETE').'
            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                <i class="bi bi-trash"></i>
            </button>
        </form>';
            })
            ->rawColumns(['action', 'image'])
            ->setRowId('id');
    }

    public function query(TeamMember $model)
    {
        return $model->newQuery()->select(['id', 'name', 'position', 'bio', 'image', 'order', 'created_at']);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('team-members-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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
            Column::make('name'),
            Column::make('position'),  // replaces 'type'
            Column::make('bio'),
            Column::make('image'),     // replaces 'logo'
            Column::make('order'),
            Column::make('created_at'),
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
        return 'TeamMembers_'.date('YmdHis');
    }
}
