<?php

namespace App\DataTables;
use App\Models\Receipt;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ReceiptsearchDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()

            ->eloquent($query)
            ->editColumn('delivery_mode', function (Receipt $receipt) {
                return ($receipt->receipt != null) ? $receipt->receipt->mode : '-';
            })
            ->editColumn('sender_type', function (Receipt $receipt) {
                return ($receipt->sender != null) ? $receipt->sender->sendertype : '-';
            })
            ->editColumn('ministry_department', function (Receipt $receipt) {
                return ($receipt->ministry != null) ? $receipt->ministry->ministryname : '-';
                
            });
    }
    public function query(Receipt $model)
    
    {
        return $model->newQuery()->orderBy('id', 'DESC');
    }
    public function html()
    {
        return $this->builder()
            ->setTableId('receipts-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->language([
                "paginate" => [
                    "next" => '<i class="fas fa-angle-right"></i>',
                    "previous" => '<i class="fas fa-angle-left"></i>'
                ]
            ])
            ->parameters([
                "dom" =>  "
                                <'row'<'col-sm-12'><'col-sm-9'B><'col-sm-3'f>>
                                <'row'<'col-sm-12'tr>>
                                <' row mt-3 container-fluid'<'col-sm-5'i><'col-sm-7'p>>
                                ",

                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-primary btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-primary btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-primary btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-primary btn-sm no-corner',],
                    ['extend' => 'pageLength', 'className' => 'btn btn-primary btn-sm no-corner',],
                ],

                "scrollX" => true
            ])
            ->language([
                'buttons' => [
                    'create' => __('Create'),
                    'export' => __('Export'),
                    'print' => __('Print'),
                    'reset' => __('Reset'),
                    'reload' => __('Reload'),
                    'excel' => __('Excel'),
                    'csv' => __('CSV'),
                    'pageLength' => __('Show %d rows'),
                ]
            ]);
    }
    protected function getColumns()
    {
        return [

            Column::make('id')
                ->title('Sl No.')
                ->render('meta.row + meta.settings._iDisplayStart + 1;')
                ->orderable(false),
            Column::make('receipt_status'),
            Column::make('receved_date'),
            Column::make('letter_date'),
            Column::make('delivery_mode'),
            Column::make('ministry_department'),
            Column::make('sender_type'),
        ];
    }
    protected function filename()
    {
        return 'Category_' . date('YmdHis');
    }
}
