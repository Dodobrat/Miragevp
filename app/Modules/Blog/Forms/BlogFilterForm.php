<?php

namespace App\Modules\Blog\Forms;

use ProVision\Administration\Forms\AdminForm;

class BlogFilterForm extends AdminForm {
    public function buildForm()
    {

        $this->add('filter_blog', 'text', [
            'label' => trans('blog::admin.filter_blog'),
            'wrapper' => ['class' => 'col-lg-12 col-md-12']
        ]);

    }
}