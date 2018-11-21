<?php

namespace App\Modules\Notifications\Forms;

use ProVision\Administration\Forms\AdminForm;
use App\User;

class NotificationsForm extends AdminForm
{
    public function buildForm()
    {

        $this->add('message', 'editor', [
            'label' => trans('notifications::admin.message'),
            'translate' => true,
        ]);

        $users_raw = User::whereDoesntHave('roles')->get();
        $users = array();

        foreach ($users_raw as $user) {
            $users[$user->id] = $user->getFullName();
        }

        $this->add('user_id', 'select', [
            'label' => trans('notifications::admin.user_select'),
            'choices' => $users,
            'selected' => @$this->model->user_id,
            'empty_value' => ' ',
        ]);

        $this->add('all_users', 'checkbox', [
            'label' => trans('notifications::admin.all_users'),
            'value' => 0,
            'checked' => @$this->model->all_users,
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
