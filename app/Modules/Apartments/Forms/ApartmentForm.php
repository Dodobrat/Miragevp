<?php

namespace App\Modules\Apartments\Forms;

use App\Modules\Floors\Models\Floors;
use App\Modules\Projects\Models\Projects;
use ProVision\Administration\Forms\AdminForm;

class ApartmentForm extends AdminForm
{
    public function buildForm()
    {
        $this->add('title', 'text', [
            'label' => trans('apartments::admin.title'),
            'translate' => true,
        ]);

        $this->add('description', 'editor', [
            'label' => trans('apartments::admin.description'),
            'translate' => true,
        ]);

        $this->addSeoFields();

        $projects = Projects::reversed()->get()->pluck('title', 'id')->toArray();
        $floors = Floors::reversed()->get()->pluck('title', 'id')->toArray();

        $this->add('project_id', 'select', [
            'label' => trans('apartments::admin.project_select'),
            'choices' => $projects,
            'selected' => @$this->model->project_id,
        ]);

        $this->add('floor_id', 'select', [
            'label' => trans('apartments::admin.floor_select'),
            'choices' => $floors,
            'selected' => @$this->model->floor_id,
        ]);

        $this->add('show_media', 'checkbox', [
            'label' => trans('apartments::admin.show_media'),
            'value' => 1,
            'checked' => @$this->model->show_media,
        ]);

        $this->add('reserved', 'checkbox', [
            'label' => trans('apartments::admin.reserved'),
            'value' => 1,
            'checked' => @$this->model->reserved,
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
