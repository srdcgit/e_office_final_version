<?php

namespace App\DataTables;

use App\Models\Document;
use App\Models\Share;
use App\Models\User;
use Category;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DocumentDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('file', function (Document $document) {
                if ($document->dtype === 'create') {
                    return $document->document_name;
                } else if ($document->dtype === 'upload') {
                    return $document->uploadmetatitle;
                } else {
                    return '';
                }
            })
            ->addColumn('action', function (Document $document) {
                return view('document.action', compact('document'));
            });
    }
    public function query(Document $model)
    {
        return $model->newQuery()->where('createdBy', Auth::user()->id)->orderBy('id', 'DESC');
    }
    public function html()
    {
        return $this->builder()
            ->setTableId('documents-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
        // ->language([
        //     "paginate" => [
        //         "next" => '<i class="fas fa-angle-right"></i>',
        //         "previous" => '<i class="fas fa-angle-left"></i>'
        //     ]
        // ])
        // ->parameters([
        //     "dom" =>  "
        //                     <'row'<'col-sm-12'><'col-sm-9'B><'col-sm-3'f>>
        //                     <'row'<'col-sm-12'tr>>
        //                     <' row mt-3 container-fluid'<'col-sm-5'i><'col-sm-7'p>>
        //                     ",

        //     'buttons'   => [
        //         ['extend' => 'create', 'className' => 'btn btn-primary btn-sm no-corner',],
        //         ['extend' => 'export', 'className' => 'btn btn-primary btn-sm no-corner',],
        //         ['extend' => 'reset', 'className' => 'btn btn-primary btn-sm no-corner',],
        //         ['extend' => 'reload', 'className' => 'btn btn-primary btn-sm no-corner',],
        //         ['extend' => 'pageLength','className' => 'btn btn-primary btn-sm no-corner',],
        //     ],

        //     "scrollX" => true
        // ])
        // ->language([
        //     'buttons' => [
        //         'create' => __('Create'),
        //         'export' => __('Export'),
        //         'print' => __('Print'),
        //         'reset' => __('Reset'),
        //         'reload' => __('Reload'),
        //         'excel' => __('Excel'),
        //         'csv' => __('CSV'),
        //         'pageLength' => __('Show %d rows'),
        //     ]
        // ]);
    }
    protected function getColumns()
    {
        return [
            Column::make('id')
                ->title('Sl No.')
                ->render('meta.row + meta.settings._iDisplayStart + 1;')
                ->orderable(false),
            Column::make('dtype'),
            Column::make('document_name'),
            Column::make('documentpath'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    protected function filename()
    {
        return 'document' . date('YmdHis');
    }
}
