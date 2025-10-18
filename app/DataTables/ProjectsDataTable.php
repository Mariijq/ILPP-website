<?php

namespace App\DataTables;

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProjectsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Project> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
                return datatables()
            ->eloquent($query)
            ->addColumn('date', fn ($projects) => $projects->date ? Carbon::parse($projects->date)->format('d M Y') : '')
            ->addColumn('short_description', fn ($projects) => \Illuminate\Support\Str::limit($projects->short_description, 50))
            ->addColumn('image', function ($projects) {
                if ($projects->image && file_exists(storage_path('app/public/'.$projects->image))) {
                    return '<img src="'.asset('storage/'.$projects->image).'" class="projects-img" style="width:60px;height:60px;object-fit:cover;border-radius:6px;">';
                }
                return '<span class="text-muted">No Image</span>';
            })
            ->addColumn('action', function ($projects) {
                $editUrl = route('projects.edit', $projects->id);
                $deleteUrl = route('projects.destroy', $projects->id);
                $detailsUrl = route('projects.show', $projects->id);

                return '
            <a href="'.$detailsUrl.'" class="btn btn-info btn-sm me-1" title="View">
                <i class="bi bi-eye"></i>
            </a>
            <a href="'.$editUrl.'" class="btn btn-primary btn-sm me-1" title="Edit">
                <i class="bi bi-pencil"></i>
            </a>
            <form method="POST" action="'.$deleteUrl.'" style="display:inline-block;" onsubmit="return confirm(\'Are you sure?\');">
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
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Project>
     */
    public function query(Project $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
          return $this->builder()
            ->setTableId('projects-table')
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

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('title'),
            Column::make('date'),
            Column::make('short_description'),
            Column::make('image'),
            Column::make('created_at'),
            Column::computed('action')
                ->title('Actions')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Projects_' . date('YmdHis');
    }
}
