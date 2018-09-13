<?php

namespace App\Modules\Apartments\Forms;

use ProVision\Administration\Forms\AdminForm;

class ApartmentsFilterForm extends AdminForm {
    public function buildForm()
    {

        $this->add('filter_apartments', 'text', [
            'label' => trans('apartments::admin.filter_apartments'),
            'wrapper' => ['class' => 'col-lg-5 col-md-12']
        ]);

        $this->add('reservation_status', 'checkbox', [
            'label' => trans('apartments::admin.reservation_status'),
            'value' => 0,
            'checked' => 0,
            'wrapper' => ['class' => 'col-lg-2 col-md-12']
        ]);

        $this->add('filter_apartments_type_office', 'checkbox', [
            'label' => trans('apartments::admin.filter_apartments_type_office'),
            'value' => 'Office',
            'checked' => 0,
            'wrapper' => ['class' => 'col-lg-2 col-md-12']
        ]);

        $this->add('filter_apartments_type_apartment', 'checkbox', [
            'label' => trans('apartments::admin.filter_apartments_type_apartment'),
            'value' => 'Apartment',
            'checked' => 0,
            'wrapper' => ['class' => 'col-lg-3 col-md-12']
        ]);

    }
}