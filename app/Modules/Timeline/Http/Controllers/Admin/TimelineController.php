<?php

namespace App\Modules\Timeline\Http\Controllers\Admin;

use App\Modules\Timeline\Forms\TimelineForm;
use App\Modules\Timeline\Http\Requests\StoreTimelineRequest;
use App\Modules\Timeline\Models\Timeline;
use Illuminate\Http\Request;

use Form;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Support\Facades\Redirect;
use Kris\LaravelFormBuilder\FormBuilder;
use ProVision\Administration\Administration;
use Yajra\DataTables\Facades\DataTables;
use ProVision\Administration\Http\Controllers\BaseAdministrationController;

class TimelineController extends BaseAdministrationController
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
            $timeline = Timeline::get();
            $datatables = Datatables::of($timeline)
                ->addColumn('action', function ($timeline) {
                    $actions = '';
                    $actions .= Form::adminDeleteButton(trans('administration::index.delete'),Administration::route('timeline.destroy', $timeline->id));
                    return Form::adminEditButton(trans('administration::index.edit'), Administration::route('timeline.edit', $timeline->id)).$actions;
                })->addColumn('title', function ($timeline) {
                    return $timeline->title;
                })->addColumn('message', function ($timeline) {
                    return strip_tags(substr($timeline->message,0,90));
                });
            return $datatables->make(true);
        }

        Administration::setTitle(trans('timeline::admin.module_name'));
        Breadcrumbs::register('admin_final', function ($breadcrumbs) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('timeline::admin.module_name'), Administration::route('timeline.index'));
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
                'title' => trans('timeline::admin.title'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'message',
                'name' => 'message',
                'title' => trans('timeline::admin.message'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'created_at',
                'name' => 'created_at',
                'title' => trans('timeline::admin.date'),
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
        $form = $formBuilder->create(TimelineForm::class, [
                'method' => 'POST',
                'url' => Administration::route('timeline.store'),
                'role' => 'form',
                'id' => 'formID'
            ]
        );
        Administration::setTitle(trans('timeline::admin.create'));

        Breadcrumbs::register('admin_final', function ($breadcrumbs) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('timeline::admin.module_name'), Administration::route('timeline.index'));
            $breadcrumbs->push(trans('timeline::admin.create'), Administration::route('timeline.create'));
        });

        return view('administration::empty-form', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTimelineRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTimelineRequest $request)
    {
        $timeline = new Timeline();
        $data = $request->only(array_keys($request->rules()));

        $timeline->fill($data);
        $timeline->save();
        return Redirect::route(Administration::routeName('timeline.index'));
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        $timeline = Timeline::where('id', $id)->first();

        if (empty($timeline)) {
            return redirect()->back()->withErrors([trans('timeline::admin.not_found')]);
        }
        $form = $formBuilder->create(TimelineForm::class, [
                'method' => 'PUT',
                'url' => Administration::route('timeline.update', $timeline->id),
                'role' => 'form',
                'id' => 'formID',
                'model' => $timeline
            ]
        );

        Administration::setTitle(trans('timeline::admin.edit') . ' - ' . $timeline->title);

        Breadcrumbs::register('admin_final', function ($breadcrumbs) use ($timeline) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('timeline::admin.module_name'), Administration::route('timeline.index'));
            $breadcrumbs->push($timeline->id, Administration::route('timeline.edit', $timeline->id));
        });
        return view('administration::empty-form', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreTimelineRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTimelineRequest $request, $id)
    {
        $timeline = Timeline::where('id', $id)->first();
        $data = $request->only(array_keys($request->rules()));

        $timeline->fill($data);
        $timeline->save();
        return Redirect::route(Administration::routeName('timeline.index'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $timeline = Timeline::findOrFail($id);
        $timeline->delete();
        return response()->json(['ok'],200);
    }
}
