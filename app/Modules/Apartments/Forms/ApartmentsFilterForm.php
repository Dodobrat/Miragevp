<?php

namespace App\Modules\Apartments\Forms;

use ProVision\Administration\Forms\AdminForm;

class ApartmentsFilterForm extends AdminForm {
    public function buildForm()
    {

        $this->add('filter_apartments', 'text', [
            'label' => trans('apartments::admin.filter_apartments'),
            'wrapper' => ['class' => 'col-lg-5']
        ]);


        $this->add('reservation_status', 'checkbox', [
            'label' => trans('apartments::admin.reservation_status'),
            'value' => 0,
            'checked' => 0,
            'wrapper' => ['class' => 'col-lg-7']
        ]);

    }
}