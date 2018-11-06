<?php

namespace App\Modules\Floors\Forms;

use App\Modules\Projects\Models\Projects;
use ProVision\Administration\Forms\AdminForm;

class FloorForm extends AdminForm
{
    public function buildForm()
    {

        $this->add('floor_num', 'text', [
            'label' => trans('floors::admin.floor_num'),
            'translate' => true,
        ]);

        $this->add('title', 'text', [
            'label' => trans('floors::admin.title'),
            'translate' => true,
        ]);

        $this->add('description', 'editor', [
            'label' => trans('floors::admin.description'),
            'translate' => true,
        ]);

        $this->addSeoFields();

        $projects = Projects::reversed()->get()->pluck('title', 'id')->toArray();

        $this->add('project_id', 'select', [
            'label' => trans('floors::admin.project_select'),
            'choices' => $projects,
            'selected' => @$this->model->project_id,
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
