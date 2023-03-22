<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RolesStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if($this->user()->can('settings edit')){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $role_id = $this->route('role_permission');
        
        return [
            'permissions' => ['required'],
            'permissions.*' => ['exists:permissions,name'],
            'role' => ['required','unique:roles,name','max:60'],
        ];
    }
}
