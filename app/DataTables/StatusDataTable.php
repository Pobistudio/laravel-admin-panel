<?php

namespace App\DataTables;

use App\Models\Status;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
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
            ->addColumn('action', function($row) {
                $id          = $row->id;
                $name        = $row->name;
                $routeEdit   = route('statuses-edit', ['id' => $id]);
                $routeDelete = route('statuses-delete', ['id' => $id]);

                $actions = [
                    [
                        'type'   => 'link',
                        'name'   => 'Edit',
                        'action' => $routeEdit
                    ],
                    [
                        'type'   => 'button',
                        'name'   => 'Delete',
                        'action' => "confirmDeleteDialog('$name', '$routeDelete')"
                    ],
                ];

                return view('components.action-dropdown-table', compact('actions'));
            })
            ->rawColumns(['action'])
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
