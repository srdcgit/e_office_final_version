<?php

namespace App\DataTables;

use App\Models\Fileshare;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FileinboxDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('sender_id', function (Fileshare $share) {
                $name = ($share->user != null) ? $share->user->name : '-';
                // Apply bold if a specific condition is met
                if ($share->read_status == 0) {
                    return '<b>' . $name . '</b>';
                }
                return $name;
            })
            ->editColumn('file_id', function (Fileshare $share) {
                $url = '';
                if (($share->status == 0 || $share->status == 2)) {
                    $url = route('file.view', ['id' => $share->file_id, 'file_share_id' => $share->id]);
                    // return '<a href="' . $url . '">' . $share->files->file_name . '</a>';
                } elseif ($share->status == 1  || $share->status == 3) {
                    $url = route('file.inbox.notes', ['id' => $share->file_id, 'file_share_id' => $share->id]);
                }

                $link = '<a href="' . $url . '">' . $share->files->file_name . '</a>';
                return $share->read_status == 0 ? '<b>' . $link . '</b>' : $link;
            })
            ->editColumn('department_id', function (Fileshare $share) {
                $dept_name =  ($share->department != null) ? $share->department->name : '-';
                if ($share->read_status == 0) {
                    return '<b>' . $dept_name . '</b>';
                }
                return $dept_name;
            })
            ->editColumn('section_id', function (Fileshare $share) {
                $section = ($share->section != null) ? $share->section->name : '-';
                if ($share->read_status == 0) {
                    return '<b>' . $section . '</b>';
                }
                return $section;
            })
            ->editColumn('duedate', function (Fileshare $share) {
                $duedate = $share->duedate; // Adjust according to your data structure
                // Apply bold if a specific condition is met
                if ($share->read_status == 0) { // Example condition
                    return '<b>' . $duedate . '</b>';
                }
                return $duedate;
            })
            ->editColumn('priority', function (Fileshare $share) {
                $priority = $share->priority; // Adjust according to your data structure
                // Apply bold if a specific condition is met
                if ($share->read_status == 0) { // Example condition
                    return '<b>' . $priority . '</b>';
                }
                return $priority;
            })
            ->editColumn('comments', function (Fileshare $share) {
                $comments = $share->comments; // Adjust according to your data structure
                // Apply bold if a specific condition is met
                if (!$comments) {
                    return "N/A";
                }
                if ($share->read_status == 0) { // Example condition: if comments are too long
                    return '<b>' . $comments . '</b>';
                }
                return $comments;
            })
            ->rawColumns(['file_id', 'sender_id', 'department_id', 'section_id', 'duedate', 'priority', 'comments']);
    }

    public function query(Fileshare $model)
    {
        // return $model->newQuery()->where('recever_id', Auth::user()->id)->orderBy('id', 'DESC');

        $subQuery = $model->newQuery()
            ->selectRaw('MAX(id) as id')
            ->where('recever_id', Auth::user()->id)
            ->where(function($q){
                $q->where('is_pulled_back', false)->orWhereNull('is_pulled_back');
            })
            ->groupBy('file_id');

        return $model->newQuery()
            ->whereIn('id', $subQuery)
            ->where(function($q){
                $q->where('is_pulled_back', false)->orWhereNull('is_pulled_back');
            })
            ->latest();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('shares-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
        ;
    }
    protected function getColumns()
    {
        return [
            Column::make('id')
                ->title('Sl No.')
                ->render('meta.row + meta.settings._iDisplayStart + 1;')
                ->orderable(false),
            Column::make('sender_id')->title('Sender'),
            Column::make('file_id')->title('File'),
            Column::make('department_id')->title('Department'),
            Column::make('section_id')->title('Section'),
            Column::make('duedate'),
            Column::make('priority'),
            Column::make('comments'),
        ];
    }
    protected function filename()
    {
        return 'share' . date('YmdHis');
    }
}
