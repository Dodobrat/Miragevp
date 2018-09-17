<?php

namespace App\Modules\Newsletter\Http\Controllers\Admin;

use App\Modules\Newsletter\Forms\NewsletterContentForm;
use App\Modules\Newsletter\Forms\NewsletterContentFilterForm;
use App\Modules\Newsletter\Http\Requests\StoreNewsletterContentRequest;
use App\Modules\Newsletter\Models\NewsletterContent;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Kris\LaravelFormBuilder\FormBuilder;
use ProVision\Administration\Http\Controllers\BaseAdministrationController;
use Form;
use ProVision\Administration\Facades\Administration;
use Yajra\DataTables\Facades\DataTables;

class NewsletterContentController extends BaseAdministrationController
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
            $news = NewsletterContent::query();
            $datatables = Datatables::of($news)
                ->addColumn('action', function ($news) {
                    $actions = '';
                    $actions .= Form::adminDeleteButton(trans('administration::index.delete'),Administration::route('newsletter_content.destroy', $news->id));

                    $actions .= Form::mediaManager($news);
                    return Form::adminEditButton(trans('administration::index.edit'), Administration::route('newsletter_content.edit', $news->id)).$actions;
                })->addColumn('show_media', function ($news) {
                    return Form::adminSwitchButton('show_media', $news);
                })->addColumn('title', function ($news) {
                    return $news->title;
                })->addColumn('subject', function ($news) {
                    return $news->subject;
                })->filter(function ($query) use ($request){
                    if ($request->has('filter_title') && !empty($request->get('filter_title'))) {
                        $query->where(DB::raw('title'),'LIKE', '%'. $request->get('filter_title') .'%');
                    }
                });

            return $datatables->make(true);
        }

        $filterForm = $this->form(NewsletterContentFilterForm::class, [
                'method' => 'POST',
                'url' => Administration::route('newsletter_content.index')
            ]
        );

        Administration::setTitle(trans('newsletter::admin.module_name'));
        Breadcrumbs::register('admin_final', function ($breadcrumbs) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('newsletter::admin.module_name'), Administration::route('newsletter_content.index'));
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
                'title' => trans('newsletter::admin.title'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'subject',
                'name' => 'subject',
                'title' => trans('newsletter::admin.subject'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'show_media',
                'name' => 'show_media',
                'title' => trans('newsletter::admin.show_media'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'created_at',
                'name' => 'created_at',
                'title' => trans('newsletter::admin.date'),
                'orderable' => false,
            ]);
        return view('administration::empty-listing', compact('table','filterForm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param FormBuilder $formBuilder
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(NewsletterContentForm::class, [
                'method' => 'POST',
                'url' => Administration::route('newsletter_content.store'),
                'role' => 'form',
                'id' => 'formID'
            ]
        );
        Administration::setTitle(trans('newsletter::admin.create'));

        Breadcrumbs::register('admin_final', function ($breadcrumbs) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('newsletter::admin.module_name'), Administration::route('newsletter_content.index'));
            $breadcrumbs->push(trans('newsletter::admin.create'), Administration::route('newsletter_content.create'));
        });

        return view('administration::empty-form', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNewsletterContentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsletterContentRequest $request)
    {
        $news = new NewsletterContent();
        $data = $request->only(array_keys($request->rules()));

        $news->fill($data);
        $news->save();
        return Redirect::route(Administration::routeName('newsletter_content.index'));
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
        $news = NewsletterContent::where('id', $id)->first();

        if (empty($news)) {
            return redirect()->back()->withErrors([trans('newsletter_content::admin.not_found')]);
        }
        $form = $formBuilder->create(NewsletterContentForm::class, [
                'method' => 'PUT',
                'url' => Administration::route('newsletter_content.update', $news->id),
                'role' => 'form',
                'id' => 'formID',
                'model' => $news
            ]
        );

        Administration::setTitle(trans('newsletter::admin.edit') . ' - ' . $news->title);

        Breadcrumbs::register('admin_final', function ($breadcrumbs) use ($news) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('newsletter::admin.module_name'), Administration::route('newsletter_content.index'));
            $breadcrumbs->push($news->title, Administration::route('newsletter_content.edit', $news->id));
        });
        return view('administration::empty-form', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreNewsletterContentRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreNewsletterContentRequest $request, $id)
    {
        $news = NewsletterContent::where('id', $id)->first();
        $data = $request->only(array_keys($request->rules()));

        $news->fill($data);
        $news->save();
        return Redirect::route(Administration::routeName('newsletter_content.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = NewsletterContent::findOrFail($id);
        $news->delete();

        return response()->json(['ok'], '200');
    }
}
