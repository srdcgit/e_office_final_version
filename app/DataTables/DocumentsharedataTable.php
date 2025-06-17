<?php
namespace App\DataTables;

use App\Models\Share;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
class DocumentsharedataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)                                        

            ->editColumn('department_id', function (Share $share) {
                return ($share->department != null) ? $share->department->name : '-';
            })
            ->editColumn('doc_id', function (Share $share) {
                if ($share->document->dtype == 'create') {
                    return $share->document->document_name;
                } else if ($share->document->dtype === 'upload') {
                    return $share->document->document_name; 
                } else {
                    return ''; 
                }
            })
            ->editColumn('receverid', function (Share $share) {
                return ($share->sendto != null) ? $share->sendto->name : '-';
            })
            ->rawColumns(['doc_id'])
            ->editColumn('section_id', function (Share $share) {
                return ($share->section != null) ? $share->section->name : '-';
            });
    }

    public function query(Share $model)
    {
        return $model->newQuery()->where('senderId', Auth::user()->id)->orderBy('id', 'DESC');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('document-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->language([
                "paginate" => [
                    "next" => '<i class="fas fa-angle-right"></i>',
                    "previous" => '<i class="fas fa-angle-left"></i>',
                ],
            ])
            ->parameters([
                "dom" => "
                                <'row'<'col-sm-12'><'col-sm-9'B><'col-sm-3'f>>
                                <'row'<'col-sm-12'tr>>
                                <' row mt-3 container-fluid'<'col-sm-5'i><'col-sm-7'p>>
                                ",

                'buttons' => [
                    // ['extend' => 'create', 'className' => 'btn btn-primary btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-primary btn-sm no-corner'],
                    ['extend' => 'reset', 'className' => 'btn btn-primary btn-sm no-corner'],
                    ['extend' => 'reload', 'className' => 'btn btn-primary btn-sm no-corner'],
                    ['extend' => 'pageLength', 'className' => 'btn btn-primary btn-sm no-corner'],
                ],

                "scrollX" => true,
            ])
            ->language([
                'buttons' => [
                    // 'create' => __('Create'),
                    'export' => __('Export'),
                    'print' => __('Print'),
                    'reset' => __('Reset'),
                    'reload' => __('Reload'),
                    'excel' => __('Excel'),
                    'csv' => __('CSV'),
                    'pageLength' => __('Show %d rows'),
                ],
            ]);

    }
    protected function getColumns()
    {
        return [
            Column::make('id')
                ->title('Sl No.')
                ->render('meta.row + meta.settings._iDisplayStart + 1;')
                ->orderable(false),
            Column::make('doc_id')->title('Document Name'),
            Column::make('created_at')->title('Send Document date'),
            Column::make('receverid')->title('SendTo'),
            Column::make('section_id')->title('Section'),
            Column::make('department_id')->title('Department'),
            Column::make('priority')->title('Priority'),
            Column::make('duedate')->title('Duedate'),
            // Column::make('comments')->title('Comments'),
        ];
    }
    protected function filename()
    {
        return 'share' . date('YmdHis');
    }
}
