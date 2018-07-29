<?php

namespace App\Modules\Users\Forms;

use ProVision\Administration\Forms\AdminForm;

class UserForm extends AdminForm {
    public function buildForm()
    {

        $this->add('first_name', 'text', [
            'title' => 'First Name',
        ]);

        $this->add('last_name', 'text', [
            'title' => 'Last Name',
            'attr' => [
                'required' => 'required'
            ]
        ]);

        $this->add('email', 'email', [
            'title' => 'Email',
        ]);

        $this->add('password', 'password', [
            'title' => 'Password',
            'value' => ''
        ]);

        $this->add('password_confirmation', 'password', [
            'title' => 'Confirm Password',
        ]);

        $this->add('footer', 'admin_footer');
        $this->add('send', 'submit', [
            'label' => trans('administration::index.save'),
            'attr' => [
                'name' => 'save'
            ]
        ]);
    }
}