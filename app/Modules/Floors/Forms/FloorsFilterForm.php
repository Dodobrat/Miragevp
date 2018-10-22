<?php

namespace App\Modules\Floors\Forms;

use ProVision\Administration\Forms\AdminForm;

class FloorsFilterForm extends AdminForm {
    public function buildForm()
    {
        $this->add('filter_floor_num', 'number', [
            'label' => trans('floors::admin.filter_floor_num'),
            'wrapper' => ['class' => 'col-lg-4']
        ]);

        $this->add('filter_floors', 'text', [
            'label' => trans('floors::admin.filter_floors'),
            'wrapper' => ['class' => 'col-lg-8']
        ]);


    }
}