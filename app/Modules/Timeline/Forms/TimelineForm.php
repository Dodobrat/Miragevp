<?php

namespace App\Modules\Timeline\Forms;

use ProVision\Administration\Forms\AdminForm;
use App\User;

class TimelineForm extends AdminForm
{
    public function buildForm()
    {

        $this->add('title', 'text', [
            'label' => trans('timeline::admin.title'),
            'translate' => true,
        ]);

        $this->add('message', 'editor', [
            'label' => trans('timeline::admin.message'),
            'translate' => true,
        ]);

        $users_raw = User::whereDoesntHave('roles')->get();
        $users = array();

        foreach ($users_raw as $user) {
            $users[$user->id] = $user->getFullName();
        }

        $this->add('user_id', 'select', [
            'label' => trans('timeline::admin.user_select'),
            'choices' => $users,
            'selected' => @$this->model->user_id,
            'empty_value' => ' ',
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
