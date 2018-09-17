<?php

namespace App\Modules\Newsletter\Forms;

use ProVision\Administration\Forms\AdminForm;

class NewsletterContentForm extends AdminForm
{
    public function buildForm()
    {
        $this->add('title', 'text', [
            'label' => trans('newsletter::admin.title'),
        ]);

        $this->add('subject', 'text', [
            'label' => trans('newsletter::admin.subject'),
            'translate' => true,
        ]);

        $this->add('content', 'editor', [
            'label' => trans('newsletter::admin.content'),
            'translate' => true,
        ]);

        $this->add('show_media', 'checkbox', [
            'label' => trans('newsletter::admin.show_media'),
            'value' => 1,
            'checked' => @$this->model->show_media,
        ]);

        $this->add('footer', 'admin_footer');
        $this->add('send', 'submit', [
            'label' => trans('administration::index.save'),
        ]);
    }
}
