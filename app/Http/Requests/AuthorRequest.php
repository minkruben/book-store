<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use App\Author;

class AuthorRequest extends Request
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
        $unique = '|unique:authors';
        if ($this->isMethod('patch')) {
            $path = explode('/', $this->path());
            $id = array_pop($path);
            $author = Author::findOrFail($id);
            if ($this->input('name') == $author->name) {
                $unique = '';
            }
        }

        return [
            'name' => 'required'.$unique,
            'description' => 'required'
        ];
    }
}
