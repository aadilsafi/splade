<?php

namespace App\Http\Controllers;

use App\DataTables\CategoriesDataTable;
use App\Http\Requests\ActivityRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\CategoryResource;
use App\ViewModel\Category\CategoryViewModel;
use App\Models\Activity;
use App\Models\Category;
use App\Utils\Helper;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use DB;
use Illuminate\Http\Response;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = Category::whereNull('parent_id')->orderBy('parent_id')->orderBy('position')->get();
        return view('lms.categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        try {
            $data = $request->validated();
            $data['position'] = Category::whereNull('parent_id')->max('position') + 1;

            if ($request->has('parent_id') && $request->parent_id != 'Null') {
                $parent_category = Category::find($request->parent_id);
                $data['position'] = $parent_category->subCategories()->max('position') + 1;
            }
            $category = Category::create($data);
            $this->createFlashMessage(__('lang.commons.data_saved'));
            return redirect()->route('category.index');
        } catch (Exception $ex) {
            Helper::log("#### Category Store Error #### ", Helper::getExceptionInfo($ex));
            $this->createFlashMessage(__('lang.errors.something_went_wrong'), 'danger');
            return redirect()->route('category.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View
     */
    public function show(Category $category)
    {
        $user = auth()->user();
        if ($user->isAdmin){
            $categories = $category->subCategories;
            $courses = $category->courses;
        }else{
            $categories = $user->courses->pluck('category');
            $courses    = $category->courses;
        }
        return view('lms.categories.index', compact('categories', 'category', 'courses'));
    }

    public function create()
    {
        $types = (new Category())->all();
        $categories = Helper::getTreeData(collect($types), new Category());
        return view('lms.categories.create', compact('categories'));
    }

    public function edit($category)
    {
        try {

            if ($category && !empty($category)) {

                $all = (new Category())->all();
                $categories = Helper::getTreeData(collect($all), new Category());
                $data = [
                    'categories' => $categories,
                    'category' => $category,
                ];
                return view('lms.categories.edit', $data);
            }
            $this->createFlashMessage(__('lang.errors.data_not_found'));
            return redirect()->route('category.index');
        } catch (Exception $ex) {
            $this->createFlashMessage(__('lang.errors.something_went_wrong'), 'danger');
            return redirect()->route('category.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $data = $request->validated();
            $data['position'] = Category::whereNull('parent_id')->max('position') + 1;

            if ($request->has('parent_id') && $request->parent_id != 'Null') {
                $parent_category = Category::find($request->parent_id);
                $data['position'] = $parent_category->subCategories()->max('position') + 1;
            }
            $category->update($data);
            $this->createFlashMessage(__('lang.commons.data_updated'));
            return redirect()->route('category.index');
        } catch (Exception $ex) {
            Helper::log("#### Category Update Error #### ", Helper::getExceptionInfo($ex));
            $this->createFlashMessage(__('lang.errors.something_went_wrong'), 'danger');
            return redirect()->route('category.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Category $category)
    {
        try {
            $query = $category;
            if ($category->parent_id) {
                $query = $category->parentCategory;
                // dd($category->parent_id);
                //    $category =  $category->parentCategory;
            }
            $query->subCategories()->where('position', '>', $category->position)
                ->update([
                    'position' => DB::raw('position - 1')
                ]);
            $category->delete();
            $this->createFlashMessage(__('lang.errors.data_deleted'));
            return redirect()->route('category.index');
        } catch (Exception $ex) {
            $this->createFlashMessage(__('lang.errors.something_went_wrong'), 'danger');
            return redirect()->route('category.index');
        }
    }

    public function destroySelected(Request $request)
    {
        try {
            if (!request()->ajax()) {
                if ($request->has('chkCategory')) {

                    $record = Category::whereIn('id', $request->chkCategory)->delete();

                    if ($record) {
                        $this->createFlashMessage(__('lang.errors.data_deleted'));
                        return redirect()->route('category.index');
                    } else {
                        $this->createFlashMessage(__('lang.errors.data_not_found'));
                        return redirect()->route('category.index');
                    }
                }
            } else {
                abort(403);
            }
        } catch (Exception $ex) {
            $this->createFlashMessage(__('lang.errors.something_went_wrong'), 'danger');
            return redirect()->route('category.index');
        }
    }
    public function reorder(Request $request)
    {
        $reorder = false;
        if(auth()->user()->isAdmin){
            $reorder = $this->reorderModel(new Category(),$request->id,$request->position,'parent_id');
        }
        return response()->json($reorder, 200);
    }

    public function subCategories($parent_id)
    {
        $category = null;
        if ($parent_id != 'null') {
            $sub_categories = Category::where('parent_id', $parent_id)->get();
            $category  = Category::find($parent_id);
            $category  = CategoryViewModel::getSingleCategoryViewModel($category);
        } else {
            $sub_categories = Category::whereNull('parent_id')->get();
        }
        $sub_categories = CategoryViewModel::getMultipleCategoriesViewModel($sub_categories);
        return response()->json(['subcategories' => $sub_categories, 'category' => $category]);
    }
}
