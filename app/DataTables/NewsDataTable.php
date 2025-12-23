<?php

namespace App\DataTables;

use App\Models\News;
use Carbon\Carbon;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class NewsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     */
    public function dataTable($query): EloquentDataTable
    {
        $locale = app()->getLocale(); // Get current app locale

        return datatables()
            ->eloquent($query)
            ->addColumn('title', fn($news) => $news->title[$locale] ?? '')
            ->addColumn('subtitle', fn($news) => $news->subtitle[$locale] ?? '')
            ->addColumn('short_description', fn($news) => \Illuminate\Support\Str::limit($news->short_description[$locale] ?? '', 50))
            ->addColumn('date', fn($news) => $news->date ? Carbon::parse($news->date)->format('d M Y') : '')
            ->addColumn('image', function ($news) {
                if ($news->image && file_exists(storage_path('app/public/'.$news->image))) {
                    return '<img src="'.asset('storage/'.$news->image).'" class="news-img" style="width:60px;height:60px;object-fit:cover;border-radius:6px;">';
                }
                return '<span class="text-muted">No Image</span>';
            })
            ->addColumn('action', function ($news) {
                $editUrl = route('news.edit', $news->id);
                $deleteUrl = route('news.destroy', $news->id);
                $detailsUrl = route('news.show', $news->id);

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
    public function query(News $model)
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
            ->setTableId('news-table')
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
            Column::make('title')->title('Title'),
            Column::make('subtitle')->title('Subtitle'),
            Column::make('short_description')->title('Short Description'),
            Column::make('date')->title('Date'),
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
        return 'News_'.date('YmdHis');
    }
}
