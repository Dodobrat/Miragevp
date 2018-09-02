<?php

namespace App\Modules\Users\Http\Controllers\Admin;

use App\Modules\Users\Forms\UserForm;
use App\Modules\Users\Forms\UsersFilterForm;
use App\Modules\Users\Http\Requests\EditUserRequest;
use App\Modules\Users\Http\Requests\StoreUserRequest;
use App\User;
use Carbon\Carbon;
use Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Kris\LaravelFormBuilder\FormBuilder;
use ProVision\Administration\Facades\Administration;
use ProVision\Administration\Http\Controllers\BaseAdministrationController;
use Yajra\DataTables\Facades\DataTables;


class UsersController extends BaseAdministrationController
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
            $users = User::whereDoesntHave('roles');
            $datatables = Datatables::of($users)
                ->addColumn('full_name', function ($user) {
                    $name = $user->first_name . ' ' . $user->last_name;
                    if (empty($user->first_name) && empty($user->last_name)) {
                        $name = trans('users::admin.user');
                    }
                    return $name;
                })
                ->addColumn('action', function ($user) {
                    $actions = '';
                    if (!empty($user->deleted_at)) {
                        $actions .= Form::adminRestoreButton(trans('administration::index.restore'), Administration::route('users.destroy', $user->id));
                    } else {
                        $actions .= Form::adminDeleteButton(trans('administration::index.delete'), Administration::route('users.destroy', $user->id));
                    }
                    return Form::adminEditButton(trans('administration::index.edit'), Administration::route('users.edit', $user->id)) . $actions;
                })->addColumn('online', function ($user) {
                    if ($user->isOnline()) {
                        return "Online";
                    } else {
                        return "Away";
                    }
                })->addColumn('login_counter', function ($user) {
                        return $user->login_counter;
                })->addColumn('last_sign_in_at', function ($user) {
                    return $user->last_sign_in_at;
                })->filter(function ($query) use ($request){
                    if ($request->has('filter_names') && !empty($request->get('filter_names'))) {
                        $query->where(DB::raw('concat(first_name," ",last_name)'),'LIKE', '%'. $request->get('filter_names') .'%');
                    }

                    if ($request->has('online_status') && $request->get('online_status') == 'true') {
                        $query->where('last_activity', '>', Carbon::now()->subMinutes(1));
                    }
                });

            return $datatables->make(true);
        }

        $filterForm = $this->form(UsersFilterForm::class, [
                'method' => 'POST',
                'url' => Administration::route('users.index')
            ]
        );

        Administration::setTitle(trans('users::admin.module_name'));

        \Breadcrumbs::register('admin_final', function ($breadcrumbs) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('users::admin.module_name'), Administration::route('users.index'));
        });


        $table = Datatables::getHtmlBuilder()
            ->addColumn([
                'data' => 'id',
                'name' => 'id',
                'title' => trans('administration::administrators.id'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'online',
                'name' => 'online',
                'title' => trans('users::admin.status'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'login_counter',
                'name' => 'login_counter',
                'title' => trans('users::admin.login_counter'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'full_name',
                'name' => 'full_name',
                'title' => trans('users::admin.full_name'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'email',
                'name' => 'email',
                'title' => trans('users::admin.email'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'last_sign_in_at',
                'name' => 'last_sign_in_at',
                'title' => trans('users::admin.last_sign_in_at'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'created_at',
                'name' => 'created_at',
                'title' => trans('users::admin.date'),
                'orderable' => false,
            ]);

        return view('administration::empty-listing', compact('table','filterForm'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param FormBuilder $formBuilder
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public
    function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(UserForm::class, [
            'url' => Administration::route('users.store'),
            'method' => 'POST',
            'role' => 'form',
            'id' => 'formID'
        ]);

        Administration::setTitle(trans('users::admin.create'));

        \Breadcrumbs::register('admin_final', function ($breadcrumbs) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('users::admin.module_name'), Administration::route('users.index'));
            $breadcrumbs->push(trans('users::admin.create'), Administration::route('users.create'));
        });

        return view('administration::empty-form', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(StoreUserRequest $request)
    {

        $user = new User();

        $user->fill($request->validated());
        $user->password = Hash::make($request['password']);
        $user->save();

        return \Redirect::route(Administration::routeName('users.index'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @param FormBuilder $formBuilder
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public
    function edit($id, FormBuilder $formBuilder)
    {

        $user = User::where('id', $id)->first();
        if (empty($user)) {
            return redirect()->back()->withErrors(trans('users::admin.not_found'));
        }

        $form = $formBuilder->create(UserForm::class, [
                'method' => 'PUT',
                'url' => Administration::route('users.update', $user->id),
                'role' => 'form',
                'id' => 'formID',
                'model' => $user
            ]
        );

        Administration::setTitle(trans('users::admin.edit') . ' - ' . $user->email);

        \Breadcrumbs::register('admin_final', function ($breadcrumbs) use ($user) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('users::admin.module_name'), Administration::route('users.index'));
            $breadcrumbs->push($user->email, Administration::route('users.edit', $user->id));
        });
        return view('administration::empty-form', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(EditUserRequest $request, $id)
    {

        $user = User::where('id', $id)->first();
        $data = $request->validated();
        unset($data['password']);

        $user->fill($data);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        return \Redirect::route(Administration::routeName('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['ok'], '200');
    }
}
