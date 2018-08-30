<?php

namespace App\Modules\Apartments\Http\Controllers\Admin;

use App\Modules\Apartments\Forms\ApartmentForm;
use App\Modules\Apartments\Http\Requests\StoreApartmentsRequest;
use App\Modules\Apartments\Models\Apartments;
use Form;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Kris\LaravelFormBuilder\FormBuilder;
use ProVision\Administration\Administration;
use Yajra\DataTables\Facades\DataTables;

use ProVision\Administration\Http\Controllers\BaseAdministrationController;

class ApartmentsController extends BaseAdministrationController
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
            $apartments = Apartments::with(['project','floor'])->reversed();
            $datatables = Datatables::of($apartments)
                ->addColumn('action', function ($apartments) {
                    $actions = '';
                    $actions .= Form::adminDeleteButton(trans('administration::index.delete'),Administration::route('apartments.destroy', $apartments->id));

                    $actions .= Form::mediaManager($apartments);
                    $actions .= ' ' . Form::mediaManager($apartments,
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
                    $actions .= Form::adminOrderButton($apartments);
                    return Form::adminEditButton(trans('administration::index.edit'), Administration::route('apartments.edit', $apartments->id)).$actions;
                })->addColumn('show_media', function ($apartment) {
                    return Form::adminSwitchButton('show_media', $apartment);
                })->addColumn('project', function ($apartment) {
                    if (!empty($apartment->project)) {
                        return $apartment->project->title;
                    }
                    return '';
                })->addColumn('floor', function ($apartment) {
                    if (!empty($apartment->floor)) {
                        return $apartment->floor->title;
                    }
                    return '';
                })->addColumn('reserved', function ($apartment) {
                    return Form::adminSwitchButton('reserved', $apartment);
                });
            return $datatables->make(true);
        }

        Administration::setTitle(trans('apartments::admin.module_name'));
        Breadcrumbs::register('admin_final', function ($breadcrumbs) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('apartments::admin.module_name'), Administration::route('apartments.index'));
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
                'data' => 'project',
                'name' => 'project',
                'title' => trans('apartments::admin.project'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'floor',
                'name' => 'floor',
                'title' => trans('apartments::admin.floor'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'show_media',
                'name' => 'show_media',
                'title' => trans('apartments::admin.show_media'),
                'orderable' => false,
            ])->addColumn([
                'title' => trans('apartments::admin.reserved'),
                'data' => 'reserved',
                'name' => 'reserved',
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
        $form = $formBuilder->create(ApartmentForm::class, [
                'method' => 'POST',
                'url' => Administration::route('apartments.store'),
                'role' => 'form',
                'id' => 'formID'
            ]
        );
        Administration::setTitle(trans('apartments::admin.create'));

        Breadcrumbs::register('admin_final', function ($breadcrumbs) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('apartments::admin.module_name'), Administration::route('apartments.index'));
            $breadcrumbs->push(trans('apartments::admin.create'), Administration::route('apartments.create'));
        });

        return view('administration::empty-form', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreApartmentsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApartmentsRequest $request)
    {
        $apartments = new Apartments();
        $data = $request->only(array_keys($request->rules()));

        $apartments->fill($data);
        $apartments->save();
        return Redirect::route(Administration::routeName('apartments.index'));
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
        $apartments = Apartments::where('id', $id)->first();

        if (empty($apartments)) {
            return redirect()->back()->withErrors([trans('apartments::admin.not_found')]);
        }
        $form = $formBuilder->create(ApartmentForm::class, [
                'method' => 'PUT',
                'url' => Administration::route('apartments.update', $apartments->id),
                'role' => 'form',
                'id' => 'formID',
                'model' => $apartments
            ]
        );

        Administration::setTitle(trans('apartments::admin.edit') . ' - ' . $apartments->title);

        Breadcrumbs::register('admin_final', function ($breadcrumbs) use ($apartments) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('apartments::admin.module_name'), Administration::route('apartments.index'));
            $breadcrumbs->push($apartments->title, Administration::route('apartments.edit', $apartments->id));
        });
        return view('administration::empty-form', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreApartmentsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreApartmentsRequest $request, $id)
    {
        $apartments = Apartments::where('id', $id)->first();
        $data = $request->only(array_keys($request->rules()));

        $apartments->fill($data);
        $apartments->save();
        return Redirect::route(Administration::routeName('apartments.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apartments = Apartments::findOrFail($id);
        $apartments->delete();
        return response()->json(['ok'],200);
    }
}
