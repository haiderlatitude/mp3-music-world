<?php

namespace App\DataTables;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
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
            ->addColumn('action', function($category){
                return view('admin.category.buttons', compact('category'));
            })
            ->editColumn('created_at', function ($category) {
                return Carbon::createFromDate($category->created_at)->diffForHumans();
            })
            ->editColumn('updated_at', function ($category) {
                return Carbon::createFromDate($category->updated_at)->diffForHumans();
            })
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model): QueryBuilder
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
                    ->setTableId('category-table')
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
            Column::make('name')->title('Category'),
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
        return 'Category_' . date('YmdHis');
    }
}
