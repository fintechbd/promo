<?php

namespace Fintech\Promo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePromotionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'country_id' => ['required', 'integer', 'min:1'],
            'name' => ['required', 'string', 'min:5'],
            'category' => ['required', 'string', Rule::in(array_keys(config('fintech.promo.promotion_category', [])))],
            'content' => ['nullable', 'string', 'min:1'],
            'link' => ['nullable', 'string', 'url'],
            'enabled' => ['required', 'boolean'],
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
