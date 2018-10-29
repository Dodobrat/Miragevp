<?php

namespace App\Modules\Showroom\Http\Controllers\Admin;

use App\Modules\Showroom\Forms\ShowroomForm;
use App\Modules\Showroom\Http\Requests\StoreShowroomRequest;
use App\Modules\Showroom\Models\Showroom;
use Form;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Kris\LaravelFormBuilder\FormBuilder;
use ProVision\Administration\Administration;
use Yajra\DataTables\Facades\DataTables;

use ProVision\Administration\Http\Controllers\BaseAdministrationController;

class ShowroomController extends BaseAdministrationController
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
            $showrooms = Showroom::reversed();
            $datatables = Datatables::of($showrooms)
                ->addColumn('action', function ($showroom) {
                    $actions = '';
                    $actions .= Form::mediaManager($showroom);
                    $actions .= Form::adminDeleteButton(trans('administration::index.delete'),Administration::route('showroom.destroy', $showroom->id));
                    $actions .= Form::adminOrderButton($showroom);
                    return Form::adminEditButton(trans('administration::index.edit'), Administration::route('showroom.edit', $showroom->id)).$actions;
                })->addColumn('show_media', function ($showroom) {
                    return Form::adminSwitchButton('show_media', $showroom);
                })->addColumn('description', function ($showroom) {
                    return strip_tags(substr($showroom->description,0,50));
                });

            return $datatables->make(true);
        }

        Administration::setTitle(trans('showroom::admin.module_name'));
        Breadcrumbs::register('admin_final', function ($breadcrumbs) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('showroom::admin.module_name'), Administration::route('showroom.index'));
        });
        $table = Datatables::getHtmlBuilder()
            ->addColumn([
                'data' => 'id',
                'name' => 'id',
                'title' => trans('administration::administrators.id'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'title',
                'name' => 'title',
                'title' => trans('apartments::admin.title'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'description',
                'name' => 'description',
                'title' => trans('showroom::admin.description'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'show_media',
                'name' => 'show_media',
                'title' => trans('apartments::admin.show_media'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'created_at',
                'name' => 'created_at',
                'title' => trans('apartments::admin.date'),
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
        $form = $formBuilder->create(ShowroomForm::class, [
                'method' => 'POST',
                'url' => Administration::route('showroom.store'),
                'role' => 'form',
                'id' => 'formID'
            ]
        );
        Administration::setTitle(trans('showroom::admin.create'));

        Breadcrumbs::register('admin_final', function ($breadcrumbs) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('showroom::admin.module_name'), Administration::route('showroom.index'));
            $breadcrumbs->push(trans('showroom::admin.create'), Administration::route('showroom.create'));
        });

        return view('administration::empty-form', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreShowroomRequest $request
     * @return void
     */
    public function store(StoreShowroomRequest $request)
    {
        $showroom = new Showroom();
        $data = $request->only(array_keys($request->rules()));

        $showroom->fill($data);
        $showroom->save();
        return Redirect::route(Administration::routeName('showroom.index'));
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
        $showroom = Showroom::where('id', $id)->first();

        if (empty($showroom)) {
            return redirect()->back()->withErrors([trans('showroom::admin.not_found')]);
        }
        $form = $formBuilder->create(ShowroomForm::class, [
                'method' => 'PUT',
                'url' => Administration::route('showroom.update', $showroom->id),
                'role' => 'form',
                'id' => 'formID',
                'model' => $showroom
            ]
        );

        Administration::setTitle(trans('showroom::admin.edit') . ' - ' . $showroom->title);

        Breadcrumbs::register('admin_final', function ($breadcrumbs) use ($showroom) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('showroom::admin.module_name'), Administration::route('showroom.index'));
            $breadcrumbs->push($showroom->title, Administration::route('showroom.edit', $showroom->id));
        });
        return view('administration::empty-form', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreShowroomRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreShowroomRequest $request, $id)
    {
        $showroom = Showroom::where('id', $id)->first();
        $data = $request->only(array_keys($request->rules()));

        $showroom->fill($data);
        $showroom->save();
        return Redirect::route(Administration::routeName('showroom.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $showroom = Showroom::findOrFail($id);
        $showroom->delete();
        return response()->json(['ok'],200);
    }
}
