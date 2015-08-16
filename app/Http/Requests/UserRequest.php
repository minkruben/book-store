<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use App\User;

class UserRequest extends Request
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
        $unique = '|unique:users';
        $required = 'required|';
        if ($this->isMethod('patch')) {
            $path = explode('/', $this->path());
            $id = array_pop($path);
            $author = User::findOrFail($id);
            if ($this->input('email') == $author->email) {
                $unique = '';
            }
            $required = '';
        }

        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255'.$unique,
            'password' => $required.'confirmed|min:6',
            'is_admin' => 'boolean'
        ];
    }
}
