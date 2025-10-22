<?php

namespace App\DataTables;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MenuDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Menu> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('icon', function($row) {
                return '<i class="'.$row->icon.' ri-lg"></i>';
            })
            ->addColumn('status', function($row) {
                $type = 'is_active';
                $name = $row->is_active ? 'Active' : 'Inactive';
                return view('components.badge.badge-wrapper', compact('type', 'name'));;
            })
            ->addColumn('action', function($row) {
                $id                = $row->id;
                $name              = $row->name;
                $status            = $row->status;
                $desStatusName     = $status ? 'Inactive' : 'Active';
                $routeEdit         = route('menus-edit', ['id' => $id]);
                $routeChangeStatus = route('menus-change-status', ['id' => $id, 'status' => !$status]);

                $actions = [
                    [
                        'type'   => 'link',
                        'name'   => 'Edit',
                        'action' => $routeEdit
                    ],
                    [
                        'type'   => 'button',
                        'name'   => 'Set '.$desStatusName,
                        'action' => "confirmChangeStatusDialog('$name', $desStatusName,'$routeChangeStatus')"
                    ],
                ];

                return view('components.action-dropdown-table', compact('actions'));
            })
            ->rawColumns(['icon', 'status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Menu>
     */
    public function query(Menu $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('menu-table')
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
            Column::make('link'),
            Column::make('link_alias'),
            Column::computed('icon'),
            Column::make('parent'),
            Column::make('order'),
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
        return 'Menu_' . date('YmdHis');
    }
}
