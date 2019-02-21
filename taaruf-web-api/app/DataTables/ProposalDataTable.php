<?php

namespace App\DataTables;

use App\Proposal;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use App\ProfileData;

class ProposalDataTable extends DataTable
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
        
        return $dataTable->addColumn('action', 'backend.proposals.datatables_actions')
        ->addColumn('pengirim', function (Proposal $proposal){
            $result =$proposal->join('profiles','profiles.id_user','proposal.id_pengirim')->where('profiles.id_user',$proposal->id_pengirim)->first();
            return $result['nama_asli'];
        })
        ->addColumn('penerima', function (Proposal $proposal){
            $result =$proposal->join('profiles','profiles.id_user','proposal.id_penerima')->where('profiles.id_user',$proposal->id_penerima)->first();
            return $result['nama_asli'];
        });

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Proposal $model)
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
              //'dom'     => 'Bfrtip',
                'order'   => [[5, 'desc']],
                /*'buttons' => [
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
            'id_pengirim',
            ['title' => 'Pengirim', 'name' => 'pengirim', 'data' => 'pengirim'],
            'id_penerima',
            ['title' => 'Penerima', 'name' => 'penerima', 'data' => 'penerima'],
            'respon',
            ['title' => 'Waktu', 'name' => 'created_at', 'data' => 'created_at']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'proposalsdatatable_' . time();
    }
}