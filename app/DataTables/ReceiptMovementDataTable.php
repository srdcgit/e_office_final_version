<?php

namespace App\DataTables;

use App\Models\Movement;
use App\Models\Receiptshare;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;

use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ReceiptMovementDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('receipt_no', fn($row) => $row->receipt->letter_ref_no ?? '-')
            // ->addColumn('from', fn($row) => $row->fromUser->name ?? '-')
            ->addColumn('from', function ($row) {
                if ($row->fromUser) {
                    return '<p class="receiver text-primary" style="cursor: pointer; text-decoration: underline;" data-id="' . $row->from_user_id . '">' . $row->fromUser->name . '</p>';
                }
                return '-';
            })
            ->addColumn('to', function ($row) {
                if ($row->toUser) {
                    return '<p class="receiver text-primary" style="cursor: pointer; text-decoration: underline;" data-id="' . $row->to_user_id . '">' . $row->toUser->name . '</p>';
                }
                return '-';
            })
            ->addColumn('action', fn($row) => ucfirst($row->action))
            ->addColumn('remark', fn($row) => $row->remark)
            ->addColumn('created_at', fn($row) => $row->created_at->format('d-m-Y h:i A'))

            // ->editColumn('recever_id', function (Movement $share) {
            //     $name = ($share->senduser != null) ? $share->senduser->name : 'User Not found';
            //     return '<p class="receiver" style="cursor: pointer; text-decoration: underline;" data-id="' . $share->recever_id . '">' . $name . '</p>';
            // })


            // ->addColumn('remark_combined', function ($row) {
            //     $remark = $row->remark ?? '-';
            //     $time = $row->created_at
            //         ? $row->created_at->timezone('Asia/Kolkata')->format('d-m-Y h:i A')
            //         : '-';
            //     return "<div>PullBack: $remark<br>PullBack Time: $time</div>";
            // })

            ->addColumn('remark_combined', function ($row) {
                $remark = $row->latestPullBackShare->remark ?? '-';
                $remarks = $row->remark ?? '-';
                $time = $row->created_at
                    ? $row->created_at->timezone('Asia/Kolkata')->format('d-m-Y h:i A')
                    : '-';
                return "<div>Sent: $remark<br><div>PullBack: $remarks<br>PullBack Time: $time</div>";
            })
            
            
            

            ->rawColumns(['to', 'from', 'remark_combined', 'latestPullBackShare']);;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ReceiptMovementDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Movement $model)
    {

        $userId = auth()->id();
        $query = $model->newQuery()

            ->where(function ($q) use ($userId) {
                $q->where('from_user_id', $userId) // from user 
                    // ->orWhere('to_user_id', $userId) // show all movements for to user
                ;
            })
            // ->where('receipt_id', $this->receipt_id)
            ->with(['receipt', 'fromUser', 'toUser'])
            ->orderBy('created_at', 'DESC');
            ;

        if ($this->receipt_id) {
            $query->where('receipt_id', $this->receipt_id);
        }

        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('receipt-movement-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(5);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('Sl No.')
                ->addClass('text-center')
                ->orderable(false)
                ->searchable(false),
            Column::make('from')->title('Sent By'),
            // Column::make('receipt_no')->title('Receipt No'),
            Column::make('to')->title('To'),
            // Column::make('remark')->title('Pullback Reason'),
            // Column::make('created_at')->title('Time'),
            Column::make('remark_combined')->title('Remark'),
            Column::make('action')->title('Movement Type'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ReceiptMovement_' . date('YmdHis');
    }
}
