<?php

namespace App\Modules\Apartments\Forms;

use App\Modules\Floors\Models\Floors;
use App\Modules\Projects\Models\Projects;
use App\User;
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

        $this->add('project_id', 'select', [
            'label' => trans('apartments::admin.project_select'),
            'choices' => $projects,
            'selected' => @$this->model->project_id,
        ]);

        $floors = Floors::reversed()->get()->pluck('title', 'id')->toArray();

        $this->add('floor_id', 'select', [
            'label' => trans('apartments::admin.floor_select'),
            'choices' => $floors,
            'selected' => @$this->model->floor_id,
        ]);

        $users_raw = User::whereDoesntHave('roles')->get();
        $users = array();

        foreach ($users_raw as $user) {
            $users[$user->id] = $user->getFullName();
        }

        $this->add('user_id', 'select', [
            'label' => trans('apartments::admin.user_select'),
            'choices' => $users,
            'selected' => @$this->model->user_id,
            'empty_value' => ' ',
        ]);

        $types = ['office' => 'Office', 'apartment' => 'Apartment'];


        $this->add('type', 'select', [
            'label' => trans('apartments::admin.type'),
            'choices' => $types,
            'selected' => @$this->model->type,
            'empty_value' => ' '
        ]);

        $positions = ['a' => 'A', 'b1' => 'B1','b2' => 'B2', 'c' => 'C', 'd' => 'D', 'e' => 'E', 'g' => 'G'];


        $this->add('position', 'select', [
            'label' => trans('apartments::admin.position'),
            'choices' => $positions,
            'selected' => @$this->model->position,
            'empty_value' => ' '
        ]);

        $this->add('price', 'text', [
            'label' => trans('apartments::admin.price_euro'),
        ]);

        $this->add('show_media', 'checkbox', [
            'label' => trans('apartments::admin.show_media'),
            'value' => 1,
            'checked' => @$this->model->show_media,
        ]);

        $this->add('footer', 'admin_footer');
        $this->add('send', 'submit', [
            'label' => trans('administration::index.save'),
        ]);
    }
}
