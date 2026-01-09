<?php

namespace App\DataTables;

use App\Models\Collaborator;
use Carbon\Carbon;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CollaboratorsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     */
    public function dataTable($query): EloquentDataTable
    {
        $locale = app()->getLocale(); // Get current app locale

        return datatables()
            ->eloquent($query)
            ->addColumn('name', fn($collaborators) => $collaborators->name[$locale] ?? '')
            ->addColumn('bio', fn($collaborators) => $collaborators->bio[$locale] ?? '')
            ->addColumn('image', function ($collaborators) {
                if ($collaborators->image && file_exists(storage_path('app/public/'.$collaborators->image))) {
                    return '<img src="'.asset('storage/'.$collaborators->image).'" class="collaborators-img" style="width:60px;height:60px;object-fit:cover;border-radius:6px;">';
                }
                return '<span class="text-muted">No Image</span>';
            })
            ->addColumn('action', function ($collaborators) {
                $editUrl = route('backend.collaborators.edit', $collaborators->id);
                $deleteUrl = route('backend.collaborators.destroy', $collaborators->id);
                $detailsUrl = route('backend.collaborators.show', $collaborators->id);

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
                </form>';
            })
            ->rawColumns(['action', 'image'])
            ->setRowId('id');
    }

    /**
     * Get query source of DataTable.
     */
    public function query(Collaborator $model)
    {
        // Select all columns (JSON columns will be accessed in PHP)
        return $model->newQuery();
    }

    /**
     * Optional HTML builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('collaborators-table')
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

    /**
     * Get columns definition.
     */
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

    /**
     * Get filename for export.
     */
    protected function filename(): string
    {
        return 'Collaborators_'.date('YmdHis');
    }
}
