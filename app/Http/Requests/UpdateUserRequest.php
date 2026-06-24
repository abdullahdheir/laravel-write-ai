<?php

namespace App\Http\Requests;

use App\Enums\UserStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('users.update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->route('user.id') . ',id',
            'username' => 'required|string|max:255|unique:users,username,' . $this->route('user.id') . ',id',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
            'status' => 'required|in:' . UserStatus::imploaded(),
            'timezone' => 'required|string|timezone',
            'roles' => 'required|array',
            'roles.*' => 'required|integer|exists:roles,id',
        ];
    }
}
