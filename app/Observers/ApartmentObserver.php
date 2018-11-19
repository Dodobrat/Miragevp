<?php

namespace App\Observers;
use App\Modules\Apartments\Models\Apartments;
use App\Notifications\ApartmentReserved;
use App\User;

class ApartmentObserver
{
    public function created(User $current_user, Apartments $user_apartments)
    {
//        if($user_apartments->isDirty('user_id')) {
//            if ($user_apartments::where('user_id', '=', $current_user->id))
//            {
//                $current_user->notify(new ApartmentReserved);
//            }
            // email has changed
//            $new_email = $user->email;
//            $old_email = User::find($user->id)->email;
//        }
//        $user_apartments::where('user_id', '=', $current_user->id)->get();
//        $current_user->notify(new ApartmentReserved);
    }

    public function updated(Apartments $user_apartments)
    {
//        if($user_apartments->getOriginal('user_id') != $user_apartments->user_id) {
//            $current_user = Apartments::user_id()->first();
//            if (!empty($user_apartments->user_id)){
//                $cur_users = $user_apartments::where('user_id', '=', $current_user->id)->get();
//                foreach($cur_users as $cur_user){
////                    dd($cur_user->notify(new ApartmentReserved));
//                    $cur_user->notify(new ApartmentReserved);
//                }
//            }


//        $user_apartments::where('user_id', '=', $current_user->id)->get();
//        $current_user->notify(new ApartmentReserved);

        }
    }
}