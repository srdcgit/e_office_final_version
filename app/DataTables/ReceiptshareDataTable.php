<?php

namespace App\DataTables;

use App\Models\Receiptshare;
use Illuminate\Support\Facades\Auth;
use Receipt;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ReceiptshareDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('department_id', function (Receiptshare $share) {
                return ($share->departments != null) ? $share->departments->name : '-';
            })
            ->editColumn('receipt_status', function (Receiptshare $share) {
                if (!$share->receiptsNature) {
                    return 'Receipt Deleted';
                }

                return $share->receiptsNature->receipt_status === 'Electronics'
                    ? 'E'
                    : 'P';
            })

            ->editColumn('computer_number', function (Receiptshare $share) {
                return ($share->receiptsComputer != null) ? $share->receiptsComputer->computer_number : 'Receipt Deleted';
            })
            ->editColumn('receipt_id', function (Receiptshare $share) {
                return ($share->receipts != null) ? $share->receipts->letter_ref_no : 'Receipt Deleted';
            })
            ->editColumn('subject', function (Receiptshare $share) {
                return ($share->receipts != null) ? $share->receipts->subject : 'Receipt Deleted';
            })
            ->editColumn('receved_date', function (Receiptshare $share) {
                return ($share->receipts != null) ? $share->receipts->receved_date : 'Receipt Deleted';
            })

            ->editColumn('recever_id', function (Receiptshare $share) {
                $name = ($share->senduser != null) ? $share->senduser->name : 'User Not found';
                return '<p class="receiver" style="cursor: pointer; text-decoration: underline;" data-id="' . $share->recever_id . '">' . $name . '</p>';
            })
            ->editColumn('created_at', function (Receiptshare $share) {
                return ($share->receipts != null) ? $share->receipts->created_at->timezone('Asia/Kolkata')->format('d-m-Y h:i A') : 'Receipt Deleted';
            })
            ->editColumn('section_id', function (Receiptshare $share) {
                return ($share->section != null) ? $share->section->name : 'Receipt Deleted';
            })
            ->editColumn('share_type', function (Receiptshare $share) {
                return $share->share_type == 'Cc' ? '<span class="badge bg-secondary">Cc</span>' : '<span class="badge bg-primary">To</span>';
            })
            ->editColumn('priority', function (Receiptshare $share) {
                switch ($share->priority) {
                    case '1':
                        return '<span class="badge bg-danger">Immediate</span>';
                    case '2':
                        return '<span class="badge bg-warning text-dark">Most Immediate</span>';
                    case '3':
                        return '<span class="badge bg-info text-dark">Out Today</span>';
                    default:
                        return '<span class="badge bg-secondary">Normal</span>';
                }
            })

            ->addColumn('action', function (Receiptshare $share) {
                if ($share->is_read) {
                    return '<span class="text-muted"><i class="fas fa-lock"></i> Viewed</span>';
                }

                return '<button class="btn btn-sm btn-danger pullback-btn" data-id="' . $share->id . '">
                            <i class="fas fa-undo-alt"></i> Pull Back
                        </button>';
            })



            ->rawColumns(['recever_id', 'share_type', 'computer_number', 'receipt_status', 'priority', 'action']);
    }

    public function query(Receiptshare $model)
    {
        return $model->newQuery()
        ->where('sender_id', Auth::user()->id)
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
            Column::computed('receipt_status')
                ->title('Nature')
                ->orderable(false)
                ->searchable(false),
            Column::computed('computer_number')
                ->title('Comp. No')
                ->orderable(false)
                ->searchable(false),
            Column::make('receipt_id')->title('Receipt'),
            Column::make('subject')->title('Subject'),
            Column::make('receved_date')->title('Receipt Date'),
            Column::make('recever_id')->title('Sent To'),
            Column::make('share_type')->title('Type'),
            Column::make('created_at')->title('Sent On'),
            // Column::make('department_id')->title('Department'),
            // Column::make('section_id')->title('Section'),
            Column::make('due_date')->title('Due On'),
            Column::make('priority')->title(''),
            Column::make('remark')->title('Remark'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(100)
            ->addClass('text-center')
            ->title('Actions'),
        ];
    }
    protected function filename()
    {
        return 'share' . date('YmdHis');
    }
}
