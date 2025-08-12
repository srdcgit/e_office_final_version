<?php

namespace App\DataTables;

use App\Models\File as ModelsFile;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FileDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('file_name', function (ModelsFile $file) {
                
                $url = route('file.notes', $file->id);
                return '<a style="text-decoration: none;" href="' . $url . '">' . $file->file_name . '</a>';
            })
            ->rawColumns(['file_name'])
            ->addColumn('action', function (ModelsFile $file) {
                return view('file.action', compact('file'));
            });
    }

    public function query(ModelsFile $model)
    {
        if (\Auth::user()->hasRole('admin')) {
            return $model->newQuery()->orderBy('id', 'DESC');
        } else {
            // Hide files that are currently shared and not pulled back (similar to receipts index behavior)
            return $model->newQuery()
                ->where('createdBy', Auth::user()->id)
                ->where(function ($q) {
                    $q->whereNotIn('id', function ($sub) {
                        $sub->select('file_id')
                            ->from('fileshares')
                            ->where('sender_id', Auth::id());
                    })
                    ->orWhereIn('id', function ($sub) {
                        $sub->select('file_id')
                            ->from('fileshares as fs')
                            ->where('sender_id', Auth::id())
                            ->whereRaw('created_at = (SELECT MAX(created_at) FROM fileshares fs2 WHERE fs2.file_id = fs.file_id)')
                            ->where('is_pulled_back', true);
                    });
                })
                ->orderBy('id', 'DESC');
        }
        
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
        //         "previous" => '<i class="fas fa-angle-left"></i>',
        //     ],
        // ]);
        // ->parameters([
        //     "dom" => "
        //                     <'row'<'col-sm-12'><'col-sm-9'B><'col-sm-3'f>>
        //                     <'row'<'col-sm-12'tr>>
        //                     <' row mt-3 container-fluid'<'col-sm-5'i><'col-sm-7'p>>
        //                     ",

        //     'buttons' => [
        //         ['extend' => 'create', 'className' => 'btn btn-primary btn-sm no-corner'],
        //         ['extend' => 'export', 'className' => 'btn btn-primary btn-sm no-corner'],
        //         ['extend' => 'reset', 'className' => 'btn btn-primary btn-sm no-corner'],
        //         ['extend' => 'reload', 'className' => 'btn btn-primary btn-sm no-corner'],
        //         ['extend' => 'pageLength', 'className' => 'btn btn-primary btn-sm no-corner'],
        //     ],

        //     "scrollX" => true,
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
        //     ],
        // ]);
    }
    protected function getColumns()
    {
        return [

            Column::make('id')
                ->title('Sl No.')
                ->render('meta.row + meta.settings._iDisplayStart + 1;')
                ->orderable(false),
            Column::make('file_name'),
            Column::make('description'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }
    protected function filename()
    {
        return 'file' . date('YmdHis');
    }
}
