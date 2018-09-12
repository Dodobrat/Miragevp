<?php

namespace App\Modules\Apartments\Http\Requests;

use App\Modules\Apartments\Models\Apartments;
use App\Modules\Apartments\Models\ApartmentsTranslation;
use Illuminate\Foundation\Http\FormRequest;

class StoreApartmentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $locales = config('translatable.locales');

        $trans = [];


        foreach ($locales as $locale) {
            $trans[$locale . '.title'] = 'required|string';
            $trans[$locale . '.meta_title'] = 'nullable|string';
            $trans[$locale . '.meta_description'] = 'nullable|string';
            $trans[$locale . '.meta_keywords'] = 'nullable|string';
            $trans[$locale . '.description'] = 'nullable|string';

            if ($this->method() == 'PATCH' || $this->method() == 'PUT') {
                $locale_alb = ApartmentsTranslation::where('apartment_id', $this->route('apartment'))->where('locale', $locale)->first();
                if($this->has($locale.'.title') && !empty($locale_alb)) {
                    $trans[$locale . '.slug'] = 'nullable|string|unique:apartments_translations,slug,' . $locale_alb->id;
                }
            }else{
                $trans[$locale.'.slug'] = 'nullable|string|unique:apartments_translations,slug';
            }
        }

        $trans['show_media'] = 'boolean';
        $trans['user_id'] = 'nullable|integer';
        $trans['floor_id'] = 'required|integer';
        $trans['project_id'] = 'required|integer';
        $trans['type'] = 'required|string';
        $trans['price'] = 'required|numeric';

        return $trans;
    }
}
