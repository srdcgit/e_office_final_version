<?php

namespace App\DataTables;

use App\Models\Fileshare;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FilesentDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('department_id', function (Fileshare $fileshare) {
                return ($fileshare->department != null) ? $fileshare->department->name : '-';
            })
            ->editColumn('section_id', function (Fileshare $fileshare) {
                return ($fileshare->section != null) ? $fileshare->section->name : '-';
            })
            ->editColumn('recever_id', function (Fileshare $fileshare) {
                return ($fileshare->sendto != null) ? $fileshare->sendto->name : '-';
            })
            ->editColumn('file_id', function (Fileshare $fileshare) {
                $url = route('file.notes', $fileshare->file_id);
                $fileName = $fileshare->files ? $fileshare->files->file_name : '-';
                return '<a href="' . $url . '">' . $fileName . '</a>';
            })
            ->editColumn('created_at', function (Fileshare $fileshare) {
                Log::info($fileshare->created_at);
                return date('d-m-Y H:i A', strtotime($fileshare->created_at));
            })
            ->addColumn('action', function (Fileshare $fileshare) {
                if ($fileshare->is_read) {
                    return '<span class="text-muted"><i class="fas fa-lock"></i> Viewed</span>';
                }
                if ($fileshare->is_pulled_back) {
                    return '<span class="badge bg-secondary">Pulled Back</span>';
                }
                return '<button class="btn btn-sm btn-danger pullback-btn" data-id="' . $fileshare->id . '"><i class="fas fa-undo-alt"></i> Pull Back</button>';
            })
            ->rawColumns(['file_id', 'action']);
    }

    public function query(Fileshare $model)
    {
        return $model->newQuery()
            ->where('sender_id', Auth::user()->id)
            ->where(function($q){
                $q->where('is_pulled_back', false)->orWhereNull('is_pulled_back');
            })
            ->orderBy('id', 'DESC');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('file-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
    }
    protected function getColumns()
    {
        return [
            Column::make('id')
                ->title('Sl No.')
                ->render('meta.row + meta.settings._iDisplayStart + 1;')
                ->orderable(false),
            Column::make('file_id')->title('File'),
            Column::make('created_at')->title('Send file date'),
            Column::make('recever_id')->title('SendTo'),
            Column::make('department_id')->title('Department'),
            Column::make('section_id')->title('Section'),
            Column::make('duedate'),
            Column::make('priority'),
            Column::computed('action')->exportable(false)->printable(false)->addClass('text-center')->title('Actions'),
        ];
    }
    protected function filename()
    {
        return 'file' . date('YmdHis');
    }
}
