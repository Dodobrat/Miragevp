<?php

namespace App\Modules\Showroom\Forms;

use ProVision\Administration\Forms\AdminForm;

class ShowroomForm extends AdminForm{

    public function buildForm(){
        $this->add('title', 'text', [
            'label' => trans('showroom::admin.title'),
            'translate' => true,
        ]);

        $this->add('description', 'editor', [
            'label' => trans('showroom::admin.description'),
            'translate' => true,
        ]);

        $this->add('show_media', 'checkbox', [
            'label' => trans('showroom::admin.show_media'),
            'value' => 1,
            'checked' => @$this->model->show_media,
        ]);

        $this->add('footer', 'admin_footer');
        $this->add('send', 'submit', [
            'label' => trans('administration::index.save'),
        ]);
    }

}