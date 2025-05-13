<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFreelanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Only allow authenticated admins
        return auth()->guard('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'logo' => 'nullable|url',
            'start_salary' => 'required|numeric|min:0',
            'end_salary' => 'required|numeric|gte:start_salary',
            'status' => 'required|in:open,closed',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
