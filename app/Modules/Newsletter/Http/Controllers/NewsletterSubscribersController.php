<?php

namespace App\Modules\Newsletter\Http\Controllers;

use App\Modules\Newsletter\Http\Requests\StoreNewsletterSubscriberRequest;
use App\Modules\Newsletter\Models\NewsletterSubscribers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class NewsletterSubscribersController extends Controller
{
    public function store(StoreNewsletterSubscriberRequest $request){
        $user = new NewsletterSubscribers();


//        $user->fill($request->validated());
        $user->email = $request->news_email;
        $user->locale = App::getLocale();
        $user->save();


        return \Redirect::route('welcome')->with('message', 'You have been subscribed successfully!');
    }
}
