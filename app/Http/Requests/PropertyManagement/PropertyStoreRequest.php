<?php

namespace App\Http\Requests\PropertyManagement;

use App\Http\Helpers\UserPermissionHelper;
use App\Models\User\BasicSetting;
use App\Models\User\Language;
use App\Rules\ImageMimeTypeRule;
use App\Traits\Tenant\Frontend\Language as TenantFrontendLanguage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PropertyStoreRequest extends FormRequest
{
    use TenantFrontendLanguage;
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (Auth::guard('agent')->check() && Auth::guard('agent')->user()) {
            $tenantId = Auth::guard('agent')->user()->user_id;
            $userCurrentPackage =  UserPermissionHelper::currentPackage($tenantId);
        } elseif (Auth::guard('web')->check() && Auth::guard('web')->user()) {
            $tenantId = Auth::guard('web')->user()->id;
            $userCurrentPackage =  UserPermissionHelper::currentPackage($tenantId);
        }


        $rules = [
            'slider_images' => 'required|array|max:' . $userCurrentPackage->number_of_property_gallery_images ?? 0,
            'featured_image' => [
                'required',
                new ImageMimeTypeRule()
            ],
            'price' => 'nullable|numeric',
            'beds' => 'required_if:type,residential',
            'bath' => 'required_if:type,residential',
            'purpose' => 'required',
            'area' => 'required',
            'status' => 'required',
            'amenities' => 'required',
            'category_id' => 'required',
            'city_id' => 'required',
            'latitude' => ['required', 'numeric', 'regex:/^[-]?((([0-8]?[0-9])\.(\d+))|(90(\.0+)?))$/'],
            'longitude' => ['required', 'numeric', 'regex:/^[-]?((([1]?[0-7]?[0-9])\.(\d+))|([0-9]?[0-9])\.(\d+)|(180(\.0+)?))$/']

        ];


        $basicSettings = BasicSetting::where('user_id', $tenantId)->select('property_state_status', 'property_country_status')->first();
        if ($basicSettings->property_country_status == 1) {
            $rules['country_id'] =  'required';
        }
        if ($basicSettings->property_state_status == 1) {
            $rules['state_id'] =  'required';
        }
        $languages = $this->allLangs($tenantId);
        $defaulLang = $this->defaultLang($tenantId);

        $rules[$defaulLang->code . '_title'] = 'required|max:255';
        $rules[$defaulLang->code . '_address'] = 'required';
        $rules[$defaulLang->code . '_description'] = 'required';

        foreach ($languages as $language) {

            if ($language->id == $defaulLang->id) {
                continue;
            }

            if ($this->filled($language->code . '_title') || $this->filled($language->code . '_address') || $this->filled($language->code . '_description') || $this->filled($language->code . '_meta_keyword') || $this->filled($language->code . '_meta_description')) {
                $rules[$language->code . '_title'] = 'required|max:255';
                $rules[$language->code . '_address'] = 'required';
                $rules[$language->code . '_description'] = 'required';

                $rules[$language->code . '_label'] = 'array|max:' . $userCurrentPackage->number_of_property_adittionl_specifications ?? 0;
            }
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        $message = [];
        if (Auth::guard('agent')->check() && Auth::guard('agent')->user() && Auth::guard('agent')->user()->user_id != 0) {
            $tenantId = Auth::guard('agent')->user()->user_id;
        } elseif (Auth::guard('web')->check() && Auth::guard('web')->user()) {
            $tenantId = Auth::guard('web')->user()->id;
        }

        $languages = $this->allLangs($tenantId);

        foreach ($languages as $language) {
            $message[$language->code . '_title.required'] = __('The title field is required for') . ' ' . $language->name . ' ' . __('language');
            $message[$language->code . '_address.required'] = __('The address field is required for') . ' ' . $language->name . ' ' . __('language');
            $message[$language->code . '_description.required'] = __('The description field is required for') . ' ' . $language->name . ' ' . __('language');
            $message[$language->code . '_description.min'] = __('The description  must be at least 15 characters for') . ' ' . $language->name . ' ' . __('language');
            $message[$language->code . '_label.max'] = __('Additional Features shall not exceed') . ' :max ' . $language->name . ' ' . __('language');
        }

        $message['slider_images.required'] = __('The gallery image field is required');
        $message['slider_images.max'] = __('The gallery image shall not exceed') . ' :max';
        $message['featured_image.required'] = __('The thumbnail image field is required');
        $message['category_id.required'] = __('The category field is required');
        $message['country_id.required'] = __('The country field is required');
        $message['state_id.required'] = __('The state field is required');
        $message['city_id.required'] = __('The city field is required');
        return $message;
    }
}
