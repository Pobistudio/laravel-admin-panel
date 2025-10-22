<?php

namespace App\DataTables;

use App\Models\Icon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class IconDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Icon> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('name', function($row) {
                return '<i class="'.$row->id.' ri-lg"></i> '.$row->name;
            })
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
                $routeEdit         = route('icons-edit', ['id' => $id]);
                $routeChangeStatus = route('icons-change-status', ['id' => $id, 'status' => $isActive == 1 ? 0 : 1]);

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
            ->rawColumns(['name', 'is_active', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Icon>
     */
    public function query(Icon $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('icon-table')
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
            Column::computed('name'),
            Column::computed('is_active'),
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
        return 'Icon_' . date('YmdHis');
    }
}
