<?php

namespace App\DataTables;

use App\Models\CareerCouncil;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use App\Http\Controllers\Backend\CareerCouncilController;

class CareerCouncilDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        $locale = app()->getLocale();

        return datatables()
            ->eloquent($query)
            ->addColumn('title', fn($council) => $council->title[$locale] ?? '')
            ->addColumn('short_description', fn($council) => $council->short_description[$locale] ?? '')
            ->addColumn('image', function ($council) {
                if ($council->image && file_exists(storage_path('app/public/'.$council->image))) {
                    return '<img src="'.asset('storage/'.$council->image).'" class="council-img" style="width:60px;height:60px;object-fit:cover;border-radius:6px;">';
                }
                return '<span class="text-muted">No Image</span>';
            })
            ->addColumn('action', function ($council) {
                $editUrl = route('backend.career-councils.edit', $council->id);
                $deleteUrl = route('backend.career-councils.destroy', $council->id);
                $detailsUrl = route('backend.career-councils.show', $council->id);

                return '
                <a href="'.$detailsUrl.'" class="btn btn-info btn-sm me-1" title="View"><i class="bi bi-eye"></i></a>
                <a href="'.$editUrl.'" class="btn btn-primary btn-sm me-1" title="Edit"><i class="bi bi-pencil"></i></a>
                <form method="POST" action="'.$deleteUrl.'" class="d-inline-block delete-form">
                    '.csrf_field().method_field('DELETE').'
                    <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="bi bi-trash"></i></button>
                </form>';
            })
            ->rawColumns(['action', 'image'])
            ->setRowId('id');
    }

    public function query(CareerCouncil $model)
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('career-councils-table')
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

    protected function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('title')->title('Title'),
            Column::make('short_description')->title('Short Description'),
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

    protected function filename(): string
    {
        return 'CareerCouncils_'.date('YmdHis');
    }
}
