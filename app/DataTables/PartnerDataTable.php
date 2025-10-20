<?php

namespace App\DataTables;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
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
     * @param  QueryBuilder<Partner>  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('logo', function ($partner) {
                return $partner->logo
                    ? '<img src="'.asset('storage/'.$partner->logo).'" style="width:60px;height:60px;object-fit:cover;border-radius:6px;">'
                    : '<span class="text-muted">No Logo</span>';
            })
            ->addColumn('action', function ($partner) {
                $editUrl = route('partners.create', $partner->id);
                $deleteUrl = route('partners.destroy', $partner->id);

                return '
                <a href="'.$editUrl.'" class="btn btn-primary btn-sm">Edit</a>
                <form method="POST" action="'.$deleteUrl.'" style="display:inline-block;">'.csrf_field().method_field('DELETE').'
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\');">Delete</button>
                </form>
            ';
            })
            ->rawColumns(['logo', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Partner>
     */
    public function query(Partner $model): QueryBuilder
    {
        return $model->newQuery();
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
            ->orderBy(1)
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
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('id'),
            Column::make('add your columns'),
            Column::make('created_at'),
            Column::make('updated_at'),
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
