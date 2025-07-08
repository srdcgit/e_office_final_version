<?php

namespace App\DataTables;

use App\Models\CorrespondenceMovement;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CorrespondenceMovementDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('correspondence_ids', function ($movement) {
                return is_array($movement->correspondence_ids) ? implode(', ', $movement->correspondence_ids) : $movement->correspondence_ids;
            })
            ->editColumn('user.name', function ($movement) {
                return $movement->user->name ?? 'N/A';
            })
            ->editColumn('created_at', function ($movement) {
                return $movement->created_at ? $movement->created_at->format('d-m-Y H:i:s') : '';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CorrespondenceMovement $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CorrespondenceMovement $model): QueryBuilder
    {
        return $model->newQuery()->with('user');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('correspondence-movement-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('Sl. No')->searchable(false)->orderable(false),
            Column::make('correspondence_ids')->title('Correspondence IDs'),
            Column::make('remark')->title('Remark'),
            Column::make('user.name')->title('Moved By'),
            Column::make('created_at')->title('Moved At'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'CorrespondenceMovement_' . date('YmdHis');
    }
}
