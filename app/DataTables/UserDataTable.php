<?php

namespace App\DataTables;

use App\Models\User;
use App\Utils\CryptUtils;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<User> $query Results from query() method.
     */

    private string $filter_start_date;
    private string $filter_end_date;
    private string $filter_status;
    private string $filter_role;

    public function __construct(
        string $filter_start_date = '',
        string $filter_end_date = '',
        string $filter_status = '',
        string $filter_role = '',
    ) {
        $this->filter_start_date = $filter_start_date;
        $this->filter_end_date = $filter_end_date;
        $this->filter_status = $filter_status;
        $this->filter_role = $filter_role;
    }
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->filterColumn('role', function($query, $keyword) {
                $query->whereRaw("LOWER(roles.name) LIKE ?", ["%{$keyword}%"]);
            })
            ->filterColumn('status', function($query, $keyword) {
                $query->whereRaw("LOWER(statuses.name) LIKE ?", ["%{$keyword}%"]);
            })
            ->addColumn('action', function($row) {
                $userID      = $row->id;
                $userName    = $row->name;
                $routeEdit   = route('users-edit', ['id' => $userID]);
                $routeDelete = route('users-delete', ['id' => $userID]);
                $actions = [
                    [
                        'type'   => 'link',
                        'name'   => 'Edit',
                        'action' => $routeEdit
                    ],
                    [

                        'type'   => 'button',
                        'name'   => 'Delete',
                        'action' => "confirmDeleteDialog('$userName', '$routeDelete')"
                    ]
                ];

                return view('components.action-dropdown-table', compact('actions'));
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<User>
     */
    public function query(User $model): QueryBuilder
    {
        $query = $model->newQuery()
        ->addSelect('users.id', 'users.name', 'users.email','roles.name as role', 'statuses.name as status', 'users.created_at', 'users.updated_at')
        ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
        ->leftJoin('statuses', 'statuses.id', '=', 'users.status_id');

        // filter
        if ((request()->has('start_date') && request()->start_date != '') && (request()->has('end_date') && request()->end_date != '')) {
            $query->whereBetween('updated_at', [request()->start_date, request()->end_date]);
        }

        if (request()->has('status') && request()->status != '') {
            $query->where('statuses.id', request()->status);
        }

        if (request()->has('role') && request()->status != '') {
            $query->where('roles.id', request()->role);
        }

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->postAjax([
                    //     'url' => route('users'),
                    //     'data' => 'function(d) {
                    //         d.status ="'.$this->filter_status.'";
                    //         d.role = "'.$this->filter_role.'";
                    //         d.created_at = "'.$this->filter_created_at.'";
                    //     }'
                    // ])
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
            Column::make('email'),
            Column::make('role'),
            Column::make('status'),
            Column::make('created_at'),
            Column::make('updated_at'),
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
        return 'User_' . date('YmdHis');
    }
}
