<?php

namespace App\DataTables;

use App\Models\Publication;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PublicationsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder<Publication>  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('date', fn ($publications) => $publications->date ? Carbon::parse($publications->date)->format('d M Y') : '')
            ->addColumn('short_description', fn ($publications) => \Illuminate\Support\Str::limit($publications->short_description, 50))
            ->addColumn('image', function ($publications) {
                if ($publications->image && file_exists(storage_path('app/public/'.$publications->image))) {
                    return '<img src="'.asset('storage/'.$publications->image).'" class="publications-img" style="width:60px;height:60px;object-fit:cover;border-radius:6px;">';
                }

                return '<span class="text-muted">No Image</span>';
            })
            ->addColumn('file', function ($publications) {
                if ($publications->file && file_exists(storage_path('app/public/'.$publications->file))) {
                    $fileName = basename($publications->file);

                    return '<a href="'.asset('storage/'.$publications->file).'" target="_blank" class="btn btn-outline-secondary btn-sm" title="Download '.$fileName.'">
                    <i class="bi bi-file-earmark-arrow-down"></i> '.$fileName.'
                </a>';
                }

                return '<span class="text-muted">No File</span>';
            })
            ->addColumn('action', function ($publications) {
                $editUrl = route('publications.edit', $publications->id);
                $deleteUrl = route('publications.destroy', $publications->id);
                $detailsUrl = route('publications.show', $publications->id);

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
            ->rawColumns(['action', 'image', 'file'])
            ->setRowId('id');

    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Publication>
     */
    public function query(Publication $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('publications-table')
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
            Column::make('file'),
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
        return 'Publications_'.date('YmdHis');
    }
}
