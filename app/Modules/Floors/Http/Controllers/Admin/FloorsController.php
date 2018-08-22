<?php

namespace App\Modules\Floors\Http\Controllers\Admin;


use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
use App\Modules\Floors\Forms\FloorForm;
use App\Modules\Floors\Http\Requests\StoreFloorsRequest;
use App\Modules\Floors\Models\Floors;
use Form;

use Illuminate\Support\Facades\Redirect;
use Kris\LaravelFormBuilder\FormBuilder;
use ProVision\Administration\Administration;
use Yajra\DataTables\Facades\DataTables;

use ProVision\Administration\Http\Controllers\BaseAdministrationController;

class FloorsController extends BaseAdministrationController
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
            $floors = Floors::withTranslation(['project'])->reversed();
            $datatables = Datatables::of($floors)
                ->addColumn('action', function ($floors) {
                    $actions = '';
                    $actions .= Form::adminDeleteButton(trans('administration::index.delete'),Administration::route('floors.destroy', $floors->id));

                    $actions .= Form::mediaManager($floors);
                    $actions .= ' ' . Form::mediaManager($floors,
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
                    $actions .= Form::adminOrderButton($floors);
                    return Form::adminEditButton(trans('administration::index.edit'), Administration::route('floors.edit', $floors->id)).$actions;
                })->editColumn('description', function ($floor) {
                    return strip_tags(substr($floor->description,0,20));
                })->addColumn('show_media', function ($floor) {
                    return Form::adminSwitchButton('show_media', $floor);
                })->addColumn('project', function ($floor) {
                    if (!empty($floor->project->title)) {
                        return $floor->project->title;
                    }
                    return '';
                });
            return $datatables->make(true);
        }

        Administration::setTitle(trans('floors::admin.module_name'));
        Breadcrumbs::register('admin_final', function ($breadcrumbs) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('floors::admin.module_name'), Administration::route('floors.index'));
        });
        $table = Datatables::getHtmlBuilder()
            ->addColumn([
                'data' => 'id',
                'name' => 'id',
                'title' => trans('administration::administrators.id'),
            ])->addColumn([
                'data' => 'title',
                'name' => 'title',
                'title' => trans('floors::admin.title'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'description',
                'name' => 'description',
                'title' => trans('floors::admin.description'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'project',
                'name' => 'project',
                'title' => trans('floors::admin.project'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'show_media',
                'name' => 'show_media',
                'title' => trans('floors::admin.show_media'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'created_at',
                'name' => 'created_at',
                'title' => trans('floors::admin.date'),
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
        $form = $formBuilder->create(FloorForm::class, [
                'method' => 'POST',
                'url' => Administration::route('floors.store'),
                'role' => 'form',
                'id' => 'formID'
            ]
        );
        Administration::setTitle(trans('floors::admin.create'));

        Breadcrumbs::register('admin_final', function ($breadcrumbs) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('floors::admin.module_name'), Administration::route('floors.index'));
            $breadcrumbs->push(trans('floors::admin.create'), Administration::route('floors.create'));
        });

        return view('administration::empty-form', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFloorsRequest $request
     * @return void
     */
    public function store(StoreFloorsRequest $request)
    {
        $floors = new Floors();
        $data = $request->only(array_keys($request->rules()));

        $floors->fill($data);
        $floors->save();
        return Redirect::route(Administration::routeName('floors.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return void
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
        $floors = Floors::where('id', $id)->first();

        if (empty($floors)) {
            return redirect()->back()->withErrors([trans('floors::admin.not_found')]);
        }
        $form = $formBuilder->create(FloorForm::class, [
                'method' => 'PUT',
                'url' => Administration::route('floors.update', $floors->id),
                'role' => 'form',
                'id' => 'formID',
                'model' => $floors
            ]
        );

        Administration::setTitle(trans('floors::admin.edit') . ' - ' . $floors->title);

        Breadcrumbs::register('admin_final', function ($breadcrumbs) use ($floors) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('floors::admin.module_name'), Administration::route('floors.index'));
            $breadcrumbs->push($floors->title, Administration::route('floors.edit', $floors->id));
        });
        return view('administration::empty-form', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreFloorsRequest $request
     * @param  int $id
     * @return void
     */
    public function update(StoreFloorsRequest $request, $id)
    {
        $floors = Floors::where('id', $id)->first();
        $data = $request->only(array_keys($request->rules()));

        $floors->fill($data);
        $floors->save();
        return Redirect::route(Administration::routeName('floors.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $floors = Floors::findOrFail($id);
        $floors->delete();
        return response()->json(['ok'],200);
    }
}
