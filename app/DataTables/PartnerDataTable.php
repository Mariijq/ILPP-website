<?php

namespace App\DataTables;

use App\Models\Partner;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PartnerDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  \Illuminate\Database\Eloquent\Builder<Partner>  $query
     */
public function dataTable($query): EloquentDataTable
{
    return datatables()
        ->eloquent($query)

        ->addColumn('name', function ($partner) {
            $locale = app()->getLocale();

            return $partner->name[$locale]
                ?? $partner->name['en']
                ?? '';
        })

        ->addColumn('logo', function ($partner) {
            if ($partner->logo && file_exists(storage_path('app/public/' . $partner->logo))) {
                return '<img src="' . asset('storage/' . $partner->logo) . '" 
                        style="width:60px;height:60px;object-fit:cover;border-radius:6px;">';
            }

            return '<span class="text-muted">No Logo</span>';
        })

        ->addColumn('action', function ($partner) {
            return '
                <a href="' . route('partners.show', $partner->id) . '" class="btn btn-info btn-sm me-1">
                    <i class="bi bi-eye"></i>
                </a>
                <a href="' . route('partners.edit', $partner->id) . '" class="btn btn-primary btn-sm me-1">
                    <i class="bi bi-pencil"></i>
                </a>
                <form method="POST" action="' . route('partners.destroy', $partner->id) . '" class="d-inline">
                    ' . csrf_field() . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>';
        })

        ->rawColumns(['logo', 'action'])
        ->setRowId('id');
}

    /**
     * Get the query source of dataTable.
     */
    public function query(Partner $model)
    {
        return $model->newQuery()->select(['id', 'name', 'logo', 'website', 'order', 'created_at', 'updated_at']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('partner-table')
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
    protected function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('logo'),
            Column::make('website'),
            Column::make('order'),
            Column::make('created_at'),
            Column::make('updated_at'),
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
        return 'Partner_'.date('YmdHis');
    }
}
