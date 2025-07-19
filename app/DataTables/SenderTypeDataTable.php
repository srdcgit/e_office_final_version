<?php

namespace App\DataTables;
use App\Models\Sendertype;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SenderTypeDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function (Sendertype $sendertype) {
                return view('sendertype.action', compact('sendertype'));
            });
    }
    public function query(Sendertype $model)
    {
        return $model->newQuery()->orderBy('id', 'DESC');
    }
    public function html()
    {
        return $this->builder()
            ->setTableId('sendertype-table')
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
                    // ['extend' => 'create', 'className' => 'btn btn-primary btn-sm no-corner',],
                    // ['extend' => 'export', 'className' => 'btn btn-primary btn-sm no-corner',],
                    // ['extend' => 'reset', 'className' => 'btn btn-primary btn-sm no-corner',],
                    // ['extend' => 'reload', 'className' => 'btn btn-primary btn-sm no-corner',],
                    // ['extend' => 'pageLength', 'className' => 'btn btn-primary btn-sm no-corner',],

                    ['extend' => 'copy', 'className' => 'btn btn-primary btn-sm no-corner'],
                    ['extend' => 'csv', 'className' => 'btn btn-primary btn-sm no-corner'],
                    ['extend' => 'excel', 'className' => 'btn btn-primary btn-sm no-corner'],
                    ['extend' => 'pdf', 'className' => 'btn btn-primary btn-sm no-corner'],
                    ['extend' => 'print', 'className' => 'btn btn-primary btn-sm no-corner'],
                    ['extend' => 'colvis', 'className' => 'btn btn-primary btn-sm no-corner'],
                    ['extend' => 'pageLength', 'className' => 'btn btn-primary btn-sm no-corner'],
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
            Column::make('sendertype'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }
    protected function filename()
    {
        return 'Category_' . date('YmdHis');
    }
}
