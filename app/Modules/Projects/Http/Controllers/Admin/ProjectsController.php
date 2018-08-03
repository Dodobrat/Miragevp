<?php

namespace App\Modules\Projects\Http\Controllers\Admin;

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
use App\Modules\Projects\Forms\ProjectForm;
use App\Modules\Projects\Http\Requests\StoreProjectsRequest;
use App\Modules\Projects\Models\Projects;
use Form;

use Illuminate\Support\Facades\Redirect;
use Kris\LaravelFormBuilder\FormBuilder;
use ProVision\Administration\Facades\Administration;
use Yajra\DataTables\Facades\DataTables;

use ProVision\Administration\Http\Controllers\BaseAdministrationController;

class ProjectsController extends BaseAdministrationController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return void
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $projects = Projects::withTranslation()->reversed();
            $datatables = Datatables::of($projects)
                ->addColumn('action', function ($projects) {
                    $actions = '';
                    $actions .= Form::adminDeleteButton(trans('administration::index.delete'),Administration::route('projects.destroy', $projects->id));

                    $actions .= Form::mediaManager($projects);
                    $actions .= ' ' . Form::mediaManager($projects,
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
                    $actions .= Form::adminOrderButton($projects);
                    return Form::adminEditButton(trans('administration::index.edit'), Administration::route('projects.edit', $projects->id)).$actions;
                })
                ->editColumn('description', function ($project) {
                    return strip_tags(substr($project->description,0,20));
                })
                ->addColumn('visible', function ($projects) {
                    return Form::adminSwitchButton('visible', $projects);
                })
            ->addColumn('show_media', function ($projects) {
                return Form::adminSwitchButton('show_media', $projects);
            });
            return $datatables->make(true);
        }

        Administration::setTitle(trans('projects::admin.module_categories_name'));
        Breadcrumbs::register('admin_final', function ($breadcrumbs) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('projects::admin.module_categories_name'), Administration::route('projects.index'));
        });
        $table = Datatables::getHtmlBuilder()
            ->addColumn([
                'data' => 'id',
                'name' => 'id',
                'title' => trans('administration::administrators.id'),
            ])->addColumn([
                'data' => 'title',
                'name' => 'title',
                'title' => trans('projects::admin.title'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'description',
                'name' => 'description',
                'title' => trans('projects::admin.description'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'visible',
                'name' => 'visible',
                'title' => trans('projects::admin.visible'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'show_media',
                'name' => 'show_media',
                'title' => trans('projects::admin.show_media'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'created_at',
                'name' => 'created_at',
                'title' => trans('projects::admin.date'),
                'orderable' => false,
            ]);
        return view('administration::empty-listing', compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param FormBuilder $formBuilder
     * @return void
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(ProjectForm::class, [
                'method' => 'POST',
                'url' => Administration::route('projects.store'),
                'role' => 'form',
                'id' => 'formID'
            ]
        );
        Administration::setTitle(trans('projects::admin.create'));

        Breadcrumbs::register('admin_final', function ($breadcrumbs) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('projects::admin.module_categories_name'), Administration::route('projects.index'));
            $breadcrumbs->push(trans('projects::admin.create_category'), Administration::route('projects.create'));
        });

        return view('administration::empty-form', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProjectsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectsRequest $request)
    {
        $projects = new Projects();
        $data = $request->only(array_keys($request->rules()));

        $projects->fill($data);
        $projects->save();
        return Redirect::route(Administration::routeName('projects.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
     * @return void
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        $projects = Projects::where('id', $id)->first();

        if (empty($projects)) {
            return redirect()->back()->withErrors([trans('projects::admin.not_found')]);
        }
        $form = $formBuilder->create(ProjectForm::class, [
                'method' => 'PUT',
                'url' => Administration::route('projects.update', $projects->id),
                'role' => 'form',
                'id' => 'formID',
                'model' => $projects
            ]
        );

        Administration::setTitle(trans('projects::admin.edit') . ' - ' . $projects->title);

        Breadcrumbs::register('admin_final', function ($breadcrumbs) use ($projects) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('projects::admin.module_name'), Administration::route('projects.index'));
            $breadcrumbs->push($projects->title, Administration::route('projects.edit', $projects->id));
        });
        return view('administration::empty-form', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreProjectsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProjectsRequest $request, $id)
    {
        $projects = Projects::where('id', $id)->first();
        $data = $request->only(array_keys($request->rules()));

        $projects->fill($data);
        $projects->save();
        return Redirect::route(Administration::routeName('projects.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $projects = Projects::findOrFail($id);
        $projects->delete();
        return response()->json(['ok'], 200);
    }
}
