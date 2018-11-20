<?php

namespace App\Modules\Notifications\Forms;

use ProVision\Administration\Forms\AdminForm;

class NotificationsForm extends AdminForm
{
    public function buildForm()
    {

        $this->add('message', 'editor', [
            'label' => trans('notifications::admin.message'),
            'translate' => true,
        ]);

        $this->add('footer', 'admin_footer');
        $this->add('send', 'submit', [
            'label' => trans('administration::index.save'),
            'attr' => [
                'name' => 'save',
            ],
        ]);
    }
}
