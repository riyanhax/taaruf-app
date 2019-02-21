<?php

namespace App\DataTables;

use App\KotaTaaruf;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class KotaTaarufDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'backend.kota_taarufs.datatables_actions')
        ->addColumn('administratif', function(KotaTaaruf $kotaTaaruf) {
            return (optional($kotaTaaruf->province_data)->province ? optional($kotaTaaruf->province_data)->province . ' > ' : '') . (optional($kotaTaaruf->city_data)->city_name ? optional($kotaTaaruf->city_data)->city_name . ' > ' : '') . optional($kotaTaaruf->subdistrict_data)->subdistrict_name;
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(KotaTaaruf $model)
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
                // 'dom'     => 'Bfrtip',
                'order'   => [[0, 'desc']],
                // 'buttons' => [
                //     'create',
                //     'export',
                //     'print',
                //     'reset',
                //     'reload',
                // ],
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
            'address',
            ['title' => 'Administratif', 'name' => 'administratif', 'data' => 'administratif'],
            ['title' => 'Picture', 'name' => 'nama', 'data' => 'nama']
            
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'kota_taarufsdatatable_' . time();
    }
}