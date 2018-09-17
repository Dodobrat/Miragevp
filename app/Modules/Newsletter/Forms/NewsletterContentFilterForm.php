<?php

namespace App\Modules\Newsletter\Forms;

use ProVision\Administration\Forms\AdminForm;

class NewsletterContentFilterForm extends AdminForm {
    public function buildForm()
    {

        $this->add('filter_title', 'text', [
            'label' => trans('newsletter::admin.filter_title'),
            'wrapper' => ['class' => 'col-lg-12 col-md-12']
        ]);

    }
}