<?php

namespace App\DataTables;

use App\Models\Status;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StatusDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Status> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('is_active', function($row) {
                $type = 'is_active';
                $name = $row->is_active ? 'Active' : 'Inactive';
                return view('components.badge.badge-wrapper', compact('type', 'name'));;
            })
            ->addColumn('action', function($row) {
                $id                = $row->id;
                $name              = $row->name;
                $isActive          = $row->is_active;
                $desStatusName     = $isActive ? 'Inactive' : 'Active';
                $routeEdit         = route('statuses-edit', ['id' => $id]);
                $routeChangeStatus = route('statuses-change-status', ['id' => $id, 'status' => $isActive == 1 ? 0 : 1]);

                $actions = [
                    [
                        'type'   => 'link',
                        'name'   => 'Edit',
                        'action' => $routeEdit
                    ],
                    [
                        'type'   => 'button',
                        'name'   => "Set $desStatusName",
                        'action' => "confirmChangeStatusDialog('$name', '$desStatusName','$routeChangeStatus')"
                    ],
                ];

                return view('components.action-dropdown-table', compact('actions'));
            })
            ->rawColumns(['is_active', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Status>
     */
    public function query(Status $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('status-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex', '#'),
            Column::make('name'),
            Column::make('is_active'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Status_' . date('YmdHis');
    }
}
