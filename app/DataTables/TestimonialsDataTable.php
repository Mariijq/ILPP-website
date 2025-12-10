<?php

namespace App\DataTables;

use App\Models\Testimonials;
use Illuminate\Support\Str;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TestimonialsDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('image', function ($testimonial) {
                if ($testimonial->image && file_exists(storage_path('app/public/'.$testimonial->image))) {
                    return '<img src="'.asset('storage/'.$testimonial->image).'" style="width:60px;height:60px;border-radius:50%;object-fit:cover;">';
                }

                return '<span class="text-muted">No Image</span>';
            })
            ->addColumn('short_review', fn ($testimonial) => Str::limit($testimonial->review, 50))
            ->addColumn('action', function ($testimonial) {
                $editUrl = route('testimonials.edit', $testimonial->id);
                $deleteUrl = route('testimonials.destroy', $testimonial->id);

                return '
        <a href="'.$editUrl.'" class="btn btn-primary btn-sm me-1">
            <i class="bi bi-pencil"></i>
        </a>
        <form action="'.$deleteUrl.'" method="POST" class="d-inline-block delete-form">
            '.csrf_field().method_field('DELETE').'
            <button type="submit" class="btn btn-danger btn-sm">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    ';
            })
            ->rawColumns(['action', 'image']);
    }

    public function query(Testimonials $model)
    {
        return $model->newQuery()->select(['id', 'name', 'designation', 'review', 'image', 'created_at']);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('testimonials-table')
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
            Column::make('designation'),
            Column::make('review'),
            Column::make('image'),
            Column::make('created_at'),
            Column::computed('action')->exportable(false)->printable(false)->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Testimonials_'.date('YmdHis');
    }
}
