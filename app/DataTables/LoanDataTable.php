<?php

namespace App\DataTables;

use App\Models\Loan;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class LoanDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'loans.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Loan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Loan $model)
    {

        $user = auth()->user();

        if ($user->role != 'user') {
            return $model->newQuery()->where('finished', 0)->where('loans.created_at', '>=', $user->created_at)
                ->with('user', 'client')->orderBy('loans.created_at', 'ASC');
        } else {

            $id = $user->id;

            return $model->newQuery()->where('user_id', $id)->with('user', 'client');
        }
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                //'order'     => [[2, 'asc']],
                'buttons'   => [],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'amount' => ['title' => __('messages.amount')],
            'finished' => [
                'title' => __('messages.finished'),
                'class' => 'hidden-xs'
            ],
            'date'  => [
                'title' => __('messages.date'),
                'title' => 'Start at',
                'class' => 'hidden-xs'
            ],
            'expires_at' => [
                'title' => __('messages.expires_at'),
                'class' => 'hidden-xs'
            ],
            'client_name' => new \Yajra\DataTables\Html\Column(['title' => __('messages.user'), 'data' => 'user.name', 'name' => 'user.name']),
            'user_name' => new \Yajra\DataTables\Html\Column(['title' => __('messages.client_endorsed'), 'data' => 'client.name', 'name' => 'client.name'])
            //'user_id'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'loansdatatable_' . time();
    }
}
