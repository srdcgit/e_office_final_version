<?php

namespace App\DataTables;

use App\Facades\UtilityFacades;
use App\Models\Role;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RolesDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('created_at', function (Role $role) {
                return  UtilityFacades::dateFormat($role->created_at);
            })
            ->addColumn('action', function (role $role) {
                return view('roles.action', compact('role'));
            });
    }


    public function query(Role $model)
    {
        return $model->newQuery()->where('name','!=','admin')->orderBy('id', 'ASC');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('users-table')
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

    // public function html()
    // {
    //     return $this->builder()
    //         ->setTableId('roles-table')
    //         ->columns($this->getColumns())
    //         ->minifiedAjax()
    //         ->dom('Bfrtip')
    //         ->orderBy(1)
    //         ->buttons(
    //             Button::make('create')->className('btn-primary btn-md no-corner ti ti-plus'),
    //             Button::make('export')->className('btn-light btn-md no-corner ti ti-download'),
    //             Button::make('print')->className('btn-light btn-md no-corner ti ti-printer'),
    //             Button::make('reset')->className('btn-light btn-md no-corner ti ti-arrow-back-up'),
    //             Button::make('reload')->className('btn-light btn-md no-corner ti ti-refresh'),
    //             Button::make('pageLength')->className('btn-light btn-md no-corner')
    //         ) ->language([
    //             'buttons'=>[
    //                 'create'=>__('Create'),
    //                 'export'=>__('Export'),
    //                 'print'=>__('Print'),
    //                 'reset'=>__('Reset'),
    //                 'reload'=>__('Reload'),
    //                 'excel'=>__('Excel'),
    //                 'csv'=>__('CSV'),
    //                 'pageLength'=>__('Show %d rows'),
    //             ]
    //         ]);
    // }


    protected function getColumns()
    {
        return [

            Column::make('id'),
            Column::make('name'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }


    protected function filename()
    {
        return 'Roles_' . date('YmdHis');
    }
}
