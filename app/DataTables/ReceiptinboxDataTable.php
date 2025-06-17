<?php

namespace App\DataTables;

use App\Models\Receiptshare;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ReceiptinboxDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('comp_no', function (Receiptshare $share) {
                return $share->receipts->computer_number ? $share->receipts->computer_number : "--";
            })
            ->addColumn('receipt_status', function (Receiptshare $share) {
                Log::info($share->receipts->receipt_status);
                $status = $share->receipts->receipt_status;
                if ($status == 'electronics' || $status == "Electronics") {
                    $status = "E";
                } else {
                    $status = "P";
                }
                return $status;
            })
            ->addColumn('subject', function (Receiptshare $share) {
                return $share->receipts->subject ? $share->receipts->subject : "--";
            })
            ->addColumn('remarks', function (Receiptshare $share) {
                return $share->receipts->remarks ? $share->receipts->remarks : "--";
            })
            ->editColumn('sender_id', function (Receiptshare $share) {
                Log::info($share->sender_id);
                return '<p class="sender" style="cursor: pointer; text-decoration: underline;" data-id="' . $share->sender_id . '">' . (($share->user != null) ? $share->user->name : '-') . '</p>';
            })
            ->editColumn('receipt_id', function (Receiptshare $share) {
                $url = route('receipt.details.view', encrypt($share->receipts->id));
                return '<a class="receipt_no custom-link" data-id="' . $share->id . '" href="' . $url . '">' . $share->receipts->letter_ref_no . '</a>';
            })
            // ->editColumn('department_id', function (Receiptshare $share) {
            //     return ($share->departments != null) ? $share->departments->name : '-';
            // })
            // ->editColumn('section_id', function (Receiptshare $share) {
            //     return ($share->section != null) ? $share->section->name : '-';
            // })
            ->rawColumns(['receipt_id', 'sender_id']);
    }

    public function query(Receiptshare $model)
    {
        return $model->newQuery()
        ->with(['receipts', 'user'])
        ->where('recever_id', Auth::user()->id)
        ->where('send_back', 0)
        ->where(function ($query) {
            
            $query->where('is_pulled_back', false);
        })
        ->orderBy('id', 'DESC');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('shares-table')
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
            Column::make('receipt_status')->title('Nature'), // New Column
            Column::make('comp_no')->title('Comp. No.'),
            Column::make('receipt_id')->title('Receipt No.'),
            Column::make('subject')->title('Subject'),
            Column::make('sender_id')->title('Sent By'),
            // Column::make('department_id')->title('Department'),
            // Column::make('section_id')->title('Section'),
            Column::make('remarks')->title('Remarks'),
        ];
    }
    protected function filename()
    {
        return 'share' . date('YmdHis');
    }
}
