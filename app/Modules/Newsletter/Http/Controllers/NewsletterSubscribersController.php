<?php

namespace App\Modules\Newsletter\Http\Controllers;

use App\Modules\Newsletter\Http\Requests\StoreNewsletterSubscriberRequest;
use App\Modules\Newsletter\Models\NewsletterSubscribers;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class NewsletterSubscribersController extends Controller
{
    public function store(StoreNewsletterSubscriberRequest $request){
        $user = new NewsletterSubscribers();

        $user->fill($request->validated());
        $user->save();

        return \Redirect::route('welcome');
    }
}
