<?php

namespace App\DataTables;

use App\Models\ApproveActivity;
use App\Models\Loan;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ApproveActivityDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'approve_activities.datatables_actions')
            ->addColumn('total', function ($data) {
                return $data->amount + $data->earnings;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ApproveActivity $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ApproveActivity $model)
    {
        $user = auth()->user();

        if ($user->role != 'user') {
            return $model->newQuery()->where('approve_activities.created_at', '>=', $user->created_at)->with(['activityType', 'loan.user']);
        } else {

            $user_id = $user->id;

            $loanIds = Loan::where('client_id', $user_id)
                ->orWhere(function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->pluck('id');

            return $model->newQuery()->whereIn('loan_id', $loanIds)->with(['activityType', 'loan.user']);
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
                'order'     => [[3, 'desc']],
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
            'total' => ['title' => __('messages.total')],
            'amount' => ['title' => __('messages.amount')],
            'earnings' => ['title' => __('messages.interest')],
            'due' => [
                'title' => __('messages.due'),
                'class' => 'hidden-xs'
            ],
            'date',
            'activity_type_name' => new \Yajra\DataTables\Html\Column(['title' => __('messages.type'), 'data' => 'activity_type.name', 'name' => 'name', 'class' => 'hidden-xs']),
            'user' => new \Yajra\DataTables\Html\Column(['title' => __('messages.user'), 'data' => 'loan.user.name', 'name' => 'loan.user.name']),
            //'activity_type_id'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'activitiesdatatable_' . time();
    }
}