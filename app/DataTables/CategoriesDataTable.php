<?php

namespace App\DataTables;

use App\Models\Category;
use App\Utils\Helper;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Str;

class CategoriesDataTable extends DataTable
{


  /**
   * Build DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   * @return \Yajra\DataTables\EloquentDataTable
   */
  public function dataTable(QueryBuilder $query)
  {
    $columns = array_column($this->getColumns(), 'data');

    return (new EloquentDataTable($query))
      ->editColumn('parent_id', function ($category) {
        $parent = $category->parentCategory ? $category->parentCategory->name : "parent";
        return Str::of($parent)->ucfirst();
      })
      ->editColumn('created_at', function ($category) {
        return Helper::editDateColumn($category->created_at);
      })
      ->editColumn('updated_at', function ($category) {
        return Helper::editDateColumn($category->updated_at);
      })
      ->editColumn('actions', function ($category) {
        return view('admin.categories.actions', ['id' => $category->id, 'position' => $category->position, 'slug' => $category->slug]);
      })
      ->editColumn('check', function ($category) {
        return $category;
      })
      ->orderColumn('name', function ($query) {
        $query->orderBy('name');
      })
      ->setRowAttr(['color' => 'blue'])
      ->rawColumns(array_merge($columns, ['action', 'check']));
  }

  /**
   * Get query source of dataTable.
   *
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function query(Category $model)
  {
    if (method_exists($model, 'relationsName') && count($model->relationsName()) > 0) {
      return $model->newQuery()->with($model->relationsName());
    } else {
      return $model->newQuery();
    }
  }

  public function html(): HtmlBuilder
  {

    return $this->builder()
      ->setTableId('categories-table')
      ->addTableClass(['table-hover'])
      ->columns($this->getColumns())
      ->minifiedAjax()
      ->serverSide()
      ->processing()
      ->deferRender()
      ->dom('BlfrtipC')
      ->orders([[3, 'asc'], [1, 'asc']])
      ->lengthMenu([10, 20, 30, 50, 70, 100])
      ->dom('<"card-header pt-0"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>> C<"clear">')
      ->buttons(
        (Button::raw('delete-selected')
          ->addClass('btn btn-relief-outline-primary waves-effect waves-float waves-light')
          ->text('<i class="bi bi-plus"></i> Add New')->attr([
            'onclick' => 'addNew()',
          ])
        ),

        Button::make('export')->addClass('btn btn-relief-outline-secondary waves-effect waves-float waves-light dropdown-toggle')->buttons([
          Button::make('print')->addClass('dropdown-item'),
          Button::make('copy')->addClass('dropdown-item'),
          Button::make('csv')->addClass('dropdown-item'),
          Button::make('excel')->addClass('dropdown-item'),
          Button::make('pdf')->addClass('dropdown-item'),
        ]),
        Button::make('reset')->addClass('btn btn-relief-outline-danger waves-effect waves-float waves-light'),
        Button::make('reload')->addClass('btn btn-relief-outline-primary waves-effect waves-float waves-light'),

        (Button::raw('delete-selected')
          ->addClass('btn btn-relief-outline-danger waves-effect waves-float waves-light')
          ->text('<i class="bi bi-trash3-fill"></i> Delete Selected')->attr([
            'onclick' => 'deleteSelected()',
          ])

        ),
      )
      ->rowGroupDataSrc('parent_id')
      ->columnDefs([
        [
          'targets' => 0,
          'className' => 'text-center text-primary',
          'width' => '10%',
          'orderable' => false,
          'searchable' => false,
          'responsivePriority' => 3,
          'render' => "function (data, type, full, setting) {
                var category = JSON.parse(data);
                return '<div class=\"form-check\"> <input class=\"form-check-input dt-checkboxes\" onchange=\"changeTableRowColor(this)\" type=\"checkbox\" value=\"' + category.id + '\" name=\"chkCategory[]\" id=\"chkCategory_' + category.id + '\" /><label class=\"form-check-label\" for=\"chkCategory_' + category.id + '\"></label></div>';
            }",
          'checkboxes' => [
            'selectAllRender' =>  '<div class="form-check"> <input class="form-check-input" onchange="changeAllTableRowColor()" type="checkbox" value="" id="checkboxSelectAll" /><label class="form-check-label" for="checkboxSelectAll"></label></div>',
          ]
        ],
      ]);
  }

  /**
   * Get columns.
   *
   * @return array
   */
  protected function getColumns(): array
  {

    return [
      Column::computed('check')->exportable(false)->printable(false)->width(60),
      'position' => new Column(['title' => 'position', 'data' => 'position', 'visible' => false]),
      'name' => new Column(['title' => 'Name', 'data' => 'name']),
      'parent_id' => new Column(['title' => 'Parent', 'data' => 'parent_id']),
      'updated_at' => new Column(['title' => 'Last Modified At', 'data' => 'updated_at']),

      Column::computed('actions')->exportable(false)->printable(false)->width(60)->addClass('text-center'),
      // 'slug' => new Column(['title' => 'Slug', 'data' => 'slug']),
      // 'position' => new Column(['title' => 'Position', 'data' => 'position', 'visible' => false]),
      // 'created_at' => new Column(['title' => 'Created', 'data' => 'created_at']),

    ];
  }

  /**
   * Get filename for export.
   *
   * @return string
   */
  protected function filename(): string
  {
    return 'categories_' . date('YmdHis');
  }
}
