<?php

namespace App\DataTables;

use App\Models\Playlist;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PlaylistDataTable extends DataTable
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
            ->addColumn('action', function ($playlist) {
                return view('playlist.buttons', compact('playlist'));
            })
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Playlist $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Playlist $model): QueryBuilder
    {
        return $model->newQuery()
            ->where('user_id', '=', Auth::id());
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('playlist-table')
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
            Column::make('DT_RowIndex', 'id')
                ->title('Sr#.'),
            Column::make('name')
                ->title('Playlist'),
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
        return 'Playlist_' . date('YmdHis');
    }
}
