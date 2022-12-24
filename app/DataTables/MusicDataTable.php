<?php

namespace App\DataTables;

use App\Models\Music;
use App\Models\Playlist;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MusicDataTable extends DataTable
{
    private $playlist = null;

    public function setPlaylist(string $playlist){
        $this->playlist = $playlist;
    }


    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($music) {
                $playlist = $this->playlist;
                return view('playButton', compact('music', 'playlist'));
            })
            ->addColumn('artist', function ($music) {
                return $music->artist->name;
            })
            ->rawColumns(['action'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Music $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Music $model): QueryBuilder
    {
        if ($this->playlist){
            return $model->newQuery()
                ->whereRelation('playlistSongs', 'name', '=', $this->playlist);
        }else
        return $model->newQuery()->with('artist');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('music-table')
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
                ->title('Song Name'),
            Column::computed('artist')
                ->title('Artist'),
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
        return 'Music_' . date('YmdHis');
    }
}
