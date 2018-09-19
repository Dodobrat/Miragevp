<?php

namespace App\Modules\Newsletter\Http\Controllers\Admin;

use App\Modules\Newsletter\Models\NewsletterSubscribers;
use Illuminate\Http\Request;
use Form;
use ProVision\Administration\Facades\Administration;
use ProVision\Administration\Http\Controllers\BaseAdministrationController;
use Yajra\DataTables\Facades\DataTables;

class NewsletterSubscribersController extends BaseAdministrationController
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
            $news = NewsletterSubscribers::query();
            $datatables = Datatables::of($news)
                ->addColumn('action', function ($news) {
                    $actions = '';
                    return Form::adminDeleteButton(trans('administration::index.delete'),Administration::route('newsletter_subscriber.destroy', $news->id)).$actions;
                })->addColumn('active', function ($news) {
                    return Form::adminSwitchButton('active', $news);
                });

            return $datatables->make(true);
        }

        Administration::setTitle(trans('newsletter::admin.module_name'));

        \Breadcrumbs::register('admin_final', function ($breadcrumbs) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('newsletter::admin.module_name'), Administration::route('newsletter_subscriber.index'));
        });


        $table = Datatables::getHtmlBuilder()
            ->addColumn([
                'data' => 'id',
                'name' => 'id',
                'title' => trans('administration::administrators.id'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'email',
                'name' => 'email',
                'title' => trans('newsletter::admin.email'),
                'orderable' => false,
            ])->addColumn([
                'data' => 'active',
                'name' => 'active',
                'title' => trans('newsletter::admin.active'),
                'orderable' => false,
            ]);

        return view('administration::empty-listing', compact('table'));
    }


    public function destroy($id)
    {
        $news = NewsletterSubscribers::findOrFail($id);
        $news->delete();

        return response()->json(['ok'], '200');
    }
}
