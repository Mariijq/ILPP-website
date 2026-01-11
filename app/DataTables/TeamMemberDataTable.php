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
    /**
     * Build DataTable class.
     */
    public function dataTable($query): EloquentDataTable
    {
        $locale = app()->getLocale(); // Get current locale (en, mk, al)

        return datatables()
            ->eloquent($query)
            ->editColumn('name', fn($member) => $member->name[$locale] ?? '')
            ->editColumn('position', fn($member) => $member->position[$locale] ?? '')
            ->editColumn('bio', fn($member) => \Illuminate\Support\Str::limit($member->bio[$locale] ?? '', 50))
            ->addColumn('image', function ($member) {
                if ($member->image && file_exists(storage_path('app/public/' . $member->image))) {
                    return '<img src="' . asset('storage/' . $member->image) . '" style="width:60px;height:60px;object-fit:cover;border-radius:6px;">';
                }
                return '<span class="text-muted">No Image</span>';
            })
            ->addColumn('facebook', function ($member) {
                return $member->facebook
                    ? '<a href="' . $member->facebook . '" target="_blank"><i class="bi bi-facebook"></i></a>'
                    : '';
            })
            ->addColumn('linkedin', function ($member) {
                return $member->linkedin
                    ? '<a href="' . $member->linkedin . '" target="_blank"><i class="bi bi-linkedin"></i></a>'
                    : '';
            })
            ->addColumn('action', function ($member) {
                $editUrl = route('backend.team-members.edit', $member->id);
                $deleteUrl = route('backend.team-members.destroy', $member->id);

                return '
                    <a href="' . $editUrl . '" class="btn btn-primary btn-sm me-1" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form method="POST" action="' . $deleteUrl . '" class="d-inline-block delete-form">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>';
            })
            ->rawColumns(['image', 'facebook', 'linkedin', 'action'])
            ->setRowId('id');
    }

    /**
     * Get query source of DataTable.
     */
    public function query(TeamMember $model)
    {
        // Select all columns; JSON fields remain JSON for locale extraction in PHP
        return $model->newQuery()->select([
            'id',
            'image',
            'order',
            'facebook',
            'linkedin',
            'created_at',
            'name',
            'position',
            'bio',
        ]);
    }

    /**
     * Optional HTML builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('team-members-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->responsive(true)
            ->autoWidth(false)
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
            ]);
    }

    /**
     * Get columns definition.
     */
    protected function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name')->title('Name'),
            Column::make('position')->title('Position'),
            Column::make('bio')->title('Bio'),
            Column::make('image')->title('Image')->exportable(false)->printable(false),
            Column::make('order')->title('Order'),
            Column::make('facebook')->title('Facebook')->exportable(false)->printable(false),
            Column::make('linkedin')->title('LinkedIn')->exportable(false)->printable(false),
            Column::make('created_at')->title('Created At'),
            Column::computed('action')
                ->title('Actions')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     */
    protected function filename(): string
    {
        return 'TeamMembers_' . date('YmdHis');
    }
}
