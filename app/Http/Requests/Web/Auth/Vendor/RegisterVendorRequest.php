<?php

namespace App\Http\Requests\Web\Auth\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class RegisterVendorRequest extends FormRequest
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
        return [

            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:vendors',
            'phone' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'company_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required|string|max:255',
            'Postal_code' => 'required|string|max:255',
            'vodafone-cash' => 'required|string|max:255',
            'instapay' => 'required|string|max:255',
            'Type_business' => 'required|string|max:255',
            'category_id' => 'required|string|max:255',
            'country_id' => 'required|string|max:255',
            'city_id' => 'required|string|max:255',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'email.required' => 'The email field is required.',
            'email.string' => 'The email must be a string.',
            'email.email' => 'The email must be a valid email address.',
            'email.max' => 'The email may not be greater than 255 characters.',
            'email.unique' => 'The email has already been taken.',
            'phone.required' => 'The phone field is required.',
            'phone.string' => 'The phone must be a string.',
            'phone.max' => 'The phone may not be greater than 255 characters.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
            'company_name.required' => 'The company name field is required.',
            'company_name.string' => 'The company name must be a string.',
            'company_name.max' => 'The company name may not be greater than 255 characters.',
            'description.required' => 'The description field is required.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than 255 characters.',
            'image.image' => 'The image must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2048 kilobytes.',
            'address.required' => 'The address field is required.',
            'address.string' => 'The address must be a string.',
            'address.max' => 'The address may not be greater than 255 characters.',
            'Postal_code.required' => 'The Postal code field is required.',
            'Postal_code.string' => 'The Postal code must be a string.',
            'Postal_code.max' => 'The Postal code may not be greater than 255 characters.',
            'vodafone-cash.required' => 'The vodafone cash field is required.',
            'vodafone-cash.string' => 'The vodafone cash must be a string.',
            'vodafone-cash.max' => 'The vodafone cash may not be greater than 255 characters.',
            'instapay.required' => 'The instapay field is required.',
            'instapay.string' => 'The instapay must be a string.',
            'instapay.max' => 'The instapay may not be greater than 255 characters.',
            'Type_business.required' => 'The Type business field is required.',
            'Type_business.string' => 'The Type business must be a string.',
            'Type_business.max' => 'The Type business may not be greater than 255 characters.',
            'category_id.required' => 'The category field is required.',
            'category_id.exists' => 'The selected category is invalid.',
            'country_id.required' => 'The country field is required.',
            'country_id.exists' => 'The selected country is invalid.',
            'city_id.required' => 'The city field is required.',
            'city_id.exists' => 'The selected city is invalid.',
        ];
    }
}
