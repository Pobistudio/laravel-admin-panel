<?php

namespace App\DataTables;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Role> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('child_roles', function($row) {

                $items = array_map(fn($role) => ucwords(str_replace('_', ' ', $role)), explode(',', $row->child_roles));

                $result = '<div class="flex flex-wrap gap-1">';

                foreach ($items as $item) {
                    $result .= "<span class='bg-slate-200 text-lap-dark rounded-md p-2'>$item</span>";
                }

                $result .= '</div>';

                return $result;
            })
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
            ->rawColumns(['child_roles', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Role>
     */
    public function query(Role $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('role-table')
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
            Column::computed('child_roles'),
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
        return 'Role_' . date('YmdHis');
    }
}
