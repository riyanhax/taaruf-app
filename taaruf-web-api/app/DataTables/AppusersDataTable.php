<?php

namespace App\DataTables;

use App\Appusers;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class AppusersDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'backend.appusers.datatables_actions')
        ->addColumn('nama',function (Appusers $appusers){
            $result = $appusers->join('profiles','profiles.id_user','appusers.id')->where('profiles.id_user',$appusers->id)->first();
            return $result['nama_asli'];
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Appusers $model)
    {
        return $model->newQuery();
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
            ->addAction(['width' => '80px'])
            ->parameters([
             //   'dom'     => 'Bfrtip',
                'order'   => [[0, 'desc']],
             /*   'buttons' => [
                    'create',
                    'export',
                    'print',
                    'reset',
                    'reload',
                ], */
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
            'id',
            ['title' => 'Nama', 'name' => 'nama', 'data' => 'nama'],
            'gender',
            'email',
            'no_hp',
            'verified',
        //    'remember_token',
        //    'device_id',
            'created_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'appusersdatatable_' . time();
    }
}