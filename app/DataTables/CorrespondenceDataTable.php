<?php

namespace App\DataTables;

use App\Models\Correspondence;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CorrespondenceDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('checkbox', function($row){
                return '<input type="checkbox" name="correspondence_checkbox[]" class="correspondence-checkbox" value="'.$row->id.'">';
            })
            ->addIndexColumn()
            ->editColumn('created_at', function ($correspondence) {
                return $correspondence->created_at->timezone('Asia/Kolkata')->format('d-m-Y h:i:s A');
            })
            ->editColumn('creator.name', function ($correspondence) {
                return $correspondence->creator->name ?? 'N/A';
            })
            ->rawColumns(['checkbox'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Correspondence $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Correspondence $model): QueryBuilder
    {
        return $model->newQuery()
            ->with(['receipt', 'creator'])
            ->where('file_id', $this->file_id)
            ->whereNotNull('receipt_id');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('correspondence-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                // Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ])
            ->dom('Bfrtip')
            ->parameters([
                'drawCallback' => 'function() {
                    $(".select-all-checkbox").prop("checked", false);
                }',
            ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::computed('checkbox')
                ->title('<input type="checkbox" class="select-all-checkbox">')
                ->exportable(false)
                ->printable(false)
                ->width(20)
                ->addClass('text-center'),
            Column::make('DT_RowIndex')->title('Sl. No')->searchable(false)->orderable(false),
            Column::make('receipt.letter_ref_no')->title('Receipt/Issue No'),
            Column::make('receipt.subject')->title('Subject'),
            Column::make('creator.name')->title('Attached By'),
            Column::make('created_at')->title('Attached On'),
            Column::make('receipt.remarks')->title('Remarks'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Correspondence_' . date('YmdHis');
    }
} 