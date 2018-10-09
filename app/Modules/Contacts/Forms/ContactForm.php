<?php

namespace App\Modules\Contacts\Forms;

use ProVision\Administration\Forms\AdminForm;

class ContactForm extends AdminForm
{
    public function buildForm()
    {
        $this->add('description', 'editor', [
            'label' => trans('contacts::admin.description'),
            'translate' => true
        ]);

        $this->add('title', 'text', [
            'label' => trans('contacts::admin.title'),
            'translate' => true
        ]);

        $this->add('email', 'text', [
            'label' => trans('contacts::admin.email'),
            'translate' => true
        ]);

        $this->add('address', 'text', [
            'label' => trans('contacts::admin.address'),
            'translate' => true,
        ]);


        $this->add('phone', 'text', [
            'label' => trans('contacts::admin.phone'),
            'translate' => true,
        ]);

        $this->add('map', 'address_picker', [
            'label' => trans('contacts::admin.map'),
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
