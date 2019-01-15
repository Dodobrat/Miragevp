<?php

namespace App\Modules\Contacts\Http\Controllers\Admin;

use App\Modules\Contacts\Forms\ContactForm;
use App\Modules\Contacts\Models\Contacts;
use App\Modules\Contacts\Http\Requests\StoreContactsRequest;
use App\Modules\Contacts\Http\Requests\EditContactsRequest;
use Illuminate\Http\Request;


use Form;
use Kris\LaravelFormBuilder\FormBuilder;
use ProVision\Administration\Facades\Administration;
use ProVision\Administration\Http\Controllers\BaseAdministrationController;
use Yajra\DataTables\Facades\DataTables;

class ContactsController extends BaseAdministrationController
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
            $contacts = Contacts::query();
            $datatables = Datatables::of($contacts)
                ->addColumn('action', function ($contact) {
                    $actions = '';
                    $actions .= ' ' . Form::mediaManager($contact,
                            [
                                'filters' => [
                                    'mediaable_sub_type' => 'contact_media'
                                ],
                                'button' => [
                                    'title' => 'Contact Icon',
                                    'class' => 'media-manager btn btn-sm btn-warning',
                                    'icon' => 'picture-o'
                                ]
                            ]
                        );
                    if (!empty($contact->deleted_at)) {
                        //
                    } else {
                        $actions .= Form::adminDeleteButton(trans('administration::index.delete'), Administration::route('contacts.destroy', $contact->id));
                    }
                    return Form::adminEditButton(trans('administration::index.edit'), Administration::route('contacts.edit', $contact->id)) . $actions;
                })->addColumn('show_map', function ($contacts) {
                    return Form::adminSwitchButton('show_map', $contacts);
                })->addColumn('working_days', function ($contacts) {
                    return strip_tags($contacts->working_days);
                });

            return $datatables->make(true);
        }

        Administration::setTitle(trans('contacts::admin.module_name'));

        \Breadcrumbs::register('admin_final', function ($breadcrumbs) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('contacts::admin.module_name'), Administration::route('contacts.index'));
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
                'title' => trans('contacts::admin.title'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'working_days',
                'name' => 'working_days',
                'title' => trans('contacts::admin.working_days'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'phone',
                'name' => 'phone',
                'title' => trans('contacts::admin.phone'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'email',
                'name' => 'email',
                'title' => trans('contacts::admin.email'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'address',
                'name' => 'address',
                'title' => trans('contacts::admin.address'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'show_map',
                'name' => 'show_map',
                'title' => trans('contacts::admin.visible'),
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
        $form = $formBuilder->create(ContactForm::class, [
            'url' => Administration::route('contacts.store'),
            'method' => 'POST',
            'role' => 'form',
            'id' => 'formID'
        ]);

        Administration::setTitle(trans('contacts::admin.create'));

        \Breadcrumbs::register('admin_final', function ($breadcrumbs) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('contacts::admin.module_name'), Administration::route('contacts.index'));
            $breadcrumbs->push(trans('contacts::admin.create'), Administration::route('contacts.create'));
        });

        return view('administration::empty-form', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreContactsRequest $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(StoreContactsRequest $request)
    {
        $contact = new Contacts();
        $contact->lat = $request->validated()['map']['lat'];
        $contact->lng = $request->validated()['map']['lng'];
        $contact->fill($request->validated());
        $contact->save();

        return \Redirect::route(Administration::routeName('contacts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function show($id)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @param FormBuilder $formBuilder
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FormBuilder $formBuilder)
    {

        $contact = Contacts::where('id', $id)->first();
        if (empty($contact)) {
            return redirect()->back()->withErrors(trans('contacts::admin.not_found'));
        }

        $form = $formBuilder->create(ContactForm::class, [
                'method' => 'PUT',
                'url' => Administration::route('contacts.update', $contact->id),
                'role' => 'form',
                'id' => 'formID',
                'model' => $contact
            ]
        );

        Administration::setTitle(trans('contacts::admin.edit') . ' - ' . $contact->email);

        \Breadcrumbs::register('admin_final', function ($breadcrumbs) use ($contact) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('contacts::admin.module_name'), Administration::route('contacts.index'));
            $breadcrumbs->push($contact->email, Administration::route('contacts.edit', $contact->id));
        });
        return view('administration::empty-form', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreContactsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreContactsRequest $request, $id)
    {
        $contact = Contacts::where('id', $id)->first();
        $contact->lat = $request->validated()['map']['lat'];
        $contact->lng = $request->validated()['map']['lng'];
        $contact->fill($request->validated());
        $contact->save();

        return \Redirect::route(Administration::routeName('contacts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contacts::findOrFail($id);
        $contact->delete();

        return response()->json(['ok'], '200');
    }
}
