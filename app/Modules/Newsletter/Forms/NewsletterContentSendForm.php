<?php

namespace App\Modules\Newsletter\Forms;

use App\Modules\Newsletter\Models\NewsletterContent;
use ProVision\Administration\Forms\AdminForm;

class NewsletterContentSendForm extends AdminForm
{
    public function buildForm()
    {

        $news = NewsletterContent::get()->pluck('title', 'id')->toArray();

        $this->add('newsletter_id', 'select', [
            'label' => trans('newsletter::admin.news_select'),
            'choices' => $news,
            'selected' => @$this->model->newsletter_id,
        ]);

        $this->add('footer', 'admin_footer');
        $this->add('send', 'submit', [
            'label' => trans('newsletter::admin.send_to'),
        ]);
    }
}
