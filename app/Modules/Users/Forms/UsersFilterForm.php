<?php

namespace App\Modules\Users\Forms;

use ProVision\Administration\Forms\AdminForm;

class UsersFilterForm extends AdminForm {
    public function buildForm()
    {

        $this->add('filter_names', 'text', [
            'label' => trans('users::admin.filter_names'),
            'wrapper' => ['class' => 'col-lg-5']
        ]);


        $this->add('online_status', 'checkbox', [
            'label' => trans('users::admin.filter_status'),
            'value' => 0,
            'checked' => 0,
            'wrapper' => ['class' => 'col-lg-7']
        ]);

    }
}