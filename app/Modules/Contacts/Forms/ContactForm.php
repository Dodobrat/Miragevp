<?php

namespace App\Modules\Contacts\Forms;

use ProVision\Administration\Forms\AdminForm;

class ContactForm extends AdminForm
{
    public function buildForm()
    {
        $this->add('mobile', 'text', [
            'title' => 'Mobile',
        ]);

        $this->add('phone', 'text', [
            'title' => 'Phone',
        ]);

        $this->add('email', 'email', [
            'title' => 'Email',
            'attr' => [
                'required' => 'required'
            ]
        ]);

        $this->add('address', 'text', [
            'title' => 'address',
            'attr' => [
                'required' => 'required'
            ]
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
