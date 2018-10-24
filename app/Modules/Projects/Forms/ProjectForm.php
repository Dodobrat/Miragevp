<?php

namespace App\Modules\Projects\Forms;

use ProVision\Administration\Forms\AdminForm;

class ProjectForm extends AdminForm
{
    public function buildForm()
    {
        $this->add('title', 'text', [
            'label' => trans('blog::admin.title'),
            'translate' => true,
        ]);

        $this->addSeoFields();

        $this->add('visible', 'checkbox', [
            'label' => trans('blog::admin.visible'),
            'value' => 1,
            'checked' => @$this->model->visible,
        ]);

        $this->add('show_media', 'checkbox', [
            'label' => trans('blog::admin.show_media'),
            'value' => 1,
            'checked' => @$this->model->show_media,
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
