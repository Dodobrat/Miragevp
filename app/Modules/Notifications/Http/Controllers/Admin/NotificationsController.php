<?php

namespace App\Modules\Notifications\Http\Controllers\Admin;

use App\Modules\Notifications\Forms\NotificationsForm;
use App\Modules\Notifications\Http\Requests\StoreNotificationsRequest;
use App\Modules\Notifications\Models\Notifications;
use Illuminate\Http\Request;

use Form;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Support\Facades\Redirect;
use Kris\LaravelFormBuilder\FormBuilder;
use ProVision\Administration\Administration;
use Yajra\DataTables\Facades\DataTables;
use ProVision\Administration\Http\Controllers\BaseAdministrationController;

class NotificationsController extends BaseAdministrationController
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
            $notifications = Notifications::get();
            $datatables = Datatables::of($notifications)
                ->addColumn('action', function ($notifications) {
                    $actions = '';
                    $actions .= Form::adminDeleteButton(trans('administration::index.delete'),Administration::route('notifications.destroy', $notifications->id));
                    return Form::adminEditButton(trans('administration::index.edit'), Administration::route('notifications.edit', $notifications->id)).$actions;
                })->addColumn('message', function ($notifications) {
                    return strip_tags(substr($notifications->message,0,60));
                });
            return $datatables->make(true);
        }

        Administration::setTitle(trans('notifications::admin.module_name'));
        Breadcrumbs::register('admin_final', function ($breadcrumbs) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('notifications::admin.module_name'), Administration::route('notifications.index'));
        });
        $table = Datatables::getHtmlBuilder()
            ->addColumn([
                'data' => 'id',
                'name' => 'id',
                'title' => trans('administration::administrators.id'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'message',
                'name' => 'message',
                'title' => trans('notifications::admin.message'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'created_at',
                'name' => 'created_at',
                'title' => trans('notifications::admin.date'),
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
        $form = $formBuilder->create(NotificationsForm::class, [
                'method' => 'POST',
                'url' => Administration::route('notifications.store'),
                'role' => 'form',
                'id' => 'formID'
            ]
        );
        Administration::setTitle(trans('notifications::admin.create'));

        Breadcrumbs::register('admin_final', function ($breadcrumbs) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('notifications::admin.module_name'), Administration::route('notifications.index'));
            $breadcrumbs->push(trans('notifications::admin.create'), Administration::route('notifications.create'));
        });

        return view('administration::empty-form', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNotificationsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotificationsRequest $request)
    {
        $notifications = new Notifications();
        $data = $request->only(array_keys($request->rules()));

        $notifications->fill($data);
        $notifications->save();
        return Redirect::route(Administration::routeName('notifications.index'));
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
        $notifications = Notifications::where('id', $id)->first();

        if (empty($notifications)) {
            return redirect()->back()->withErrors([trans('notifications::admin.not_found')]);
        }
        $form = $formBuilder->create(NotificationsForm::class, [
                'method' => 'PUT',
                'url' => Administration::route('notifications.update', $notifications->id),
                'role' => 'form',
                'id' => 'formID',
                'model' => $notifications
            ]
        );

        Administration::setTitle(trans('notifications::admin.edit') . ' - ' . $notifications->title);

        Breadcrumbs::register('admin_final', function ($breadcrumbs) use ($notifications) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('notifications::admin.module_name'), Administration::route('notifications.index'));
            $breadcrumbs->push($notifications->id, Administration::route('notifications.edit', $notifications->id));
        });
        return view('administration::empty-form', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreNotificationsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreNotificationsRequest $request, $id)
    {
        $notifications = Notifications::where('id', $id)->first();
        $data = $request->only(array_keys($request->rules()));

        $notifications->fill($data);
        $notifications->save();
        return Redirect::route(Administration::routeName('notifications.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notifications = Notifications::findOrFail($id);
        $notifications->delete();
        return response()->json(['ok'],200);
    }
}
