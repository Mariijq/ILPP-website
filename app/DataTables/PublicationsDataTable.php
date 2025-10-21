<?php

namespace App\DataTables;

use App\Models\Publication;
use Carbon\Carbon;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PublicationsDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('date', fn($publication) => $publication->date ? Carbon::parse($publication->date)->format('d M Y') : '')
            ->addColumn('short_description', fn($publication) => \Illuminate\Support\Str::limit($publication->short_description, 50))
            ->addColumn('image', function ($publication) {
                if ($publication->image && file_exists(storage_path('app/public/' . $publication->image))) {
                    return '<img src="'.asset('storage/'.$publication->image).'" style="width:60px;height:60px;object-fit:cover;border-radius:6px;">';
                }
                return '<span class="text-muted">No Image</span>';
            })
            ->addColumn('file', function ($publication) {
                if ($publication->file && file_exists(storage_path('app/public/' . $publication->file))) {
                    $fileName = basename($publication->file);
                    return '<a href="'.asset('storage/'.$publication->file).'" target="_blank" class="btn btn-outline-secondary btn-sm" title="Download '.$fileName.'">
                        <i class="bi bi-file-earmark-arrow-down"></i> '.$fileName.'
                    </a>';
                }
                return '<span class="text-muted">No File</span>';
            })
            ->addColumn('action', function ($publication) {
                $editUrl = route('publications.edit', $publication->id);
                $deleteUrl = route('publications.destroy', $publication->id);
                $detailsUrl = route('publications.show', $publication->id);

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

    public function query(Publication $model)
    {
        return $model->newQuery()->select(['id', 'title', 'date', 'short_description', 'detailed_description', 'image', 'file', 'created_at']);
    }

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

    protected function getColumns(): array
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

    protected function filename(): string
    {
        return 'Publications_'.date('YmdHis');
    }
}
