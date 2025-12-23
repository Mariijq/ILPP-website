<?php

namespace App\DataTables;

use App\Models\Slide;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SlideDataTable extends DataTable
{
    protected $locale;

    public function __construct()
    {
        $this->locale = app()->getLocale(); // current locale
    }

    public function dataTable($query): EloquentDataTable
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('image', function ($slide) {
                if ($slide->image && file_exists(storage_path('app/public/'.$slide->image))) {
                    return '<img src="'.asset('storage/'.$slide->image).'" style="width:80px;height:50px;object-fit:cover;border-radius:6px;">';
                }
                return '<span class="text-muted">No Image</span>';
            })
            ->addColumn('title', function ($slide) {
                return $slide->title[$this->locale] ?? $slide->title['en'] ?? '';
            })
            ->addColumn('subtitle', function ($slide) {
                return $slide->subtitle[$this->locale] ?? $slide->subtitle['en'] ?? '';
            })
            ->addColumn('news_title', function ($slide) {
                $news = $slide->news;
                return $news ? ($news->title[$this->locale] ?? $news->title['en'] ?? '') : '<span class="text-muted">No News</span>';
            })
            ->addColumn('action', function ($slide) {
                $editUrl = route('slides.edit', $slide->id);
                $deleteUrl = route('slides.destroy', $slide->id);

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

    public function query(Slide $model)
    {
        return $model->newQuery()->with('news')->select([
            'id', 'news_id', 'title', 'subtitle', 'date', 'image', 'order', 'created_at',
        ]);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('slides-table')
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
            Column::make('subtitle'),
            Column::make('date'),
            Column::make('order'),
            Column::make('created_at'),
            Column::computed('news_title')
                ->title('News')
                ->exportable(false)
                ->printable(true),
            Column::computed('image')
                ->title('Image')
                ->exportable(false)
                ->printable(false),
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
        return 'Slides_'.date('YmdHis');
    }
}
