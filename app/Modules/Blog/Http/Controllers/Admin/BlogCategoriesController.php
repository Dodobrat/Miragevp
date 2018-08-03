<?php

namespace App\Modules\Blog\Http\Controllers\Admin;

use App\Modules\Blog\Forms\BlogCategoriesForm;
use App\Modules\Blog\Http\Requests\StoreBlogCategoriesRequest;
use App\Modules\Blog\Models\BlogCategories;
use Illuminate\Http\Request;
use Form;

use Kris\LaravelFormBuilder\FormBuilder;
use ProVision\Administration\Facades\Administration;
use ProVision\Administration\Http\Controllers\BaseAdministrationController;
use Yajra\DataTables\Facades\DataTables;

class BlogCategoriesController extends BaseAdministrationController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $blog_categories = BlogCategories::withTranslation()->reversed();
            $datatables = Datatables::of($blog_categories)
                ->addColumn('action', function ($category) {
                    $actions = '';
                    if (!empty($category->deleted_at)) {
                        //restore button
                    } else {
                        $actions .= Form::adminDeleteButton(trans('administration::index.delete'), Administration::route('blog_categories.destroy', $category->id));
                    }
                    $actions .= Form::mediaManager($category);
                    $actions .= ' ' . Form::mediaManager($category,
                            [
                                'filters' => [
                                    'mediaable_sub_type' => 'header'
                                ],
                                'button' => [
                                    'title' => 'Header',
                                    'class' => 'media-manager btn btn-sm btn-default',
                                    'icon' => 'header'
                                ]
                            ]
                        );
                    $actions .= Form::adminOrderButton($category);
                    return Form::adminEditButton(trans('administration::index.edit'), Administration::route('blog_categories.edit', $category->id)) . $actions;
                })
                ->addColumn('visible', function ($category) {
                    return Form::adminSwitchButton('visible', $category);
                });
            return $datatables->make(true);
        }

        Administration::setTitle(trans('blog::admin.module_categories_name'));
        \Breadcrumbs::register('admin_final', function ($breadcrumbs) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('blog::admin.module_categories_name'), Administration::route('blog_categories.index'));
        });
        $table = Datatables::getHtmlBuilder()
            ->addColumn([
                'data' => 'id',
                'name' => 'id',
                'title' => trans('administration::administrators.id'),
            ])->addColumn([
                'data' => 'title',
                'name' => 'title',
                'title' => trans('administration::administrators.name'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'visible',
                'name' => 'visible',
                'title' => trans('blog::admin.visible'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'created_at',
                'name' => 'created_at',
                'title' => trans('blog::admin.date'),
                'orderable' => false,
            ]);
        return view('administration::empty-listing', compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param FormBuilder $formBuilder
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(BlogCategoriesForm::class, [
                'method' => 'POST',
                'url' => Administration::route('blog_categories.store'),
                'role' => 'form',
                'id' => 'formID'
            ]
        );
        Administration::setTitle(trans('blog::admin.create'));

        \Breadcrumbs::register('admin_final', function ($breadcrumbs) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('blog::admin.module_categories_name'), Administration::route('blog_categories.index'));
            $breadcrumbs->push(trans('blog::admin.create_category'), Administration::route('blog_categories.create'));
        });

        return view('administration::empty-form', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogCategoriesRequest $request)
    {
        $blog = new BlogCategories();
        $data = $request->only(array_keys($request->rules()));

        $blog->fill($data);
        $blog->save();
        return \Redirect::route(Administration::routeName('blog_categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @param FormBuilder $formBuilder
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        $blog_category = BlogCategories::where('id', $id)->first();

        if (empty($blog_category)) {
            return redirect()->back()->withErrors([trans('blog::admin.not_found')]);
        }
        $form = $formBuilder->create(BlogCategoriesForm::class, [
                'method' => 'PUT',
                'url' => Administration::route('blog_categories.update', $blog_category->id),
                'role' => 'form',
                'id' => 'formID',
                'model' => $blog_category
            ]
        );

        Administration::setTitle(trans('blog::admin.edit') . ' - ' . $blog_category->title);

        \Breadcrumbs::register('admin_final', function ($breadcrumbs) use ($blog_category) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('blog::admin.module_name'), Administration::route('blog_categories.index'));
            $breadcrumbs->push($blog_category->title, Administration::route('blog_categories.edit', $blog_category->id));
        });
        return view('administration::empty-form', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreBlogCategoriesRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBlogCategoriesRequest $request, $id)
    {
        $blog_category = BlogCategories::where('id', $id)->first();
        $data = $request->only(array_keys($request->rules()));

        $blog_category->fill($data);
        $blog_category->save();
        return \Redirect::route(Administration::routeName('blog_categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = BlogCategories::findOrFail($id);
        $blog->delete();
        return response()->json(['ok'], 200);
    }
}
