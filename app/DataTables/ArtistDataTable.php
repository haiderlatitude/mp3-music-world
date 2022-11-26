<?php

namespace App\DataTables;

use App\Models\Artist;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ArtistDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($artist) {
                return view('admin.artists.buttons', compact('artist'));
            })
            ->editColumn('created_at', function ($user) {
                return Carbon::createFromDate($user->created_at)->diffForHumans();
            })
            ->editColumn('updated_at', function ($user) {
                return Carbon::createFromDate($user->updated_at)->diffForHumans();
            })
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Artist $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Artist $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('artist-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->searching(true)
                    ->deferRender(true)
                    ->stateSave(true)
                    ->serverSide(true)
                    ->pagingType('full_numbers')
                    ->fixedHeaderHeader(true)
                    ->responsive(true)
                    ->autoWidth(true)
                    ->select(true)->parameters(
                        [
                            'select.className' => 'alert alert-success',
                            'select.blurable' => true,
                        ]
                    )
                    ->orderBy(0, 'asc');
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex', 'id')->title('Sr. No'),
            Column::make('name')->title('Artist Name'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Artist_' . date('YmdHis');
    }
}
