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

            ->addColumn('title', fn ($p) => $p->title[app()->getLocale()] ?? $p->title['en']
            )

            ->addColumn('date', fn ($p) => $p->date ? Carbon::parse($p->date)->format('d M Y') : ''
            )

            ->addColumn('short_description', fn ($p) => \Str::limit(
                $p->short_description[app()->getLocale()] ?? $p->short_description['en'],
                50
            )
            )

            ->addColumn('image', function ($p) {
                if ($p->image && file_exists(storage_path('app/public/'.$p->image))) {
                    return '<img src="'.asset('storage/'.$p->image).'" style="width:60px;height:60px;object-fit:cover;border-radius:6px;">';
                }

                return '<span class="text-muted">No Image</span>';
            })

            ->addColumn('file', function ($p) {
                if ($p->file && file_exists(storage_path('app/public/'.$p->file))) {
                    $fileName = basename($p->file);

                    return '<a href="'.asset('storage/'.$p->file).'" target="_blank" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-file-earmark-arrow-down"></i> '.$fileName.'
                </a>';
                }

                return '<span class="text-muted">No File</span>';
            })

            ->addColumn('action', function ($p) {
                return '
                <a href="'.route('publications.show', $p->id).'" class="btn btn-info btn-sm me-1">
                    <i class="bi bi-eye"></i>
                </a>
                <a href="'.route('publications.edit', $p->id).'" class="btn btn-primary btn-sm me-1">
                    <i class="bi bi-pencil"></i>
                </a>
                <form method="POST" action="'.route('publications.destroy', $p->id).'" class="d-inline">
                    '.csrf_field().method_field('DELETE').'
                    <button class="btn btn-danger btn-sm">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>';
            })

            ->rawColumns(['image', 'file', 'action'])
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
