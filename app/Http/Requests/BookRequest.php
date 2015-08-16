<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use App\Book;

class BookRequest extends Request
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
        $unique = '|unique:books';
        if ($this->isMethod('patch')) {
            $path = explode('/', $this->path());
            $id = array_pop($path);
            $book = Book::findOrFail($id);
            if ($this->input('isbn') == $book->isbn) {
                $unique = '';
            }
        }
        $rules = [
            'title' => 'required',
            'isbn' => 'required|digits:13'.$unique,
            'authors' => 'required|array',
            'description' => 'required',
            'pages' => 'required|integer',
            'publisher' => 'required',
            'published_date' => 'required|date_format:Y-m-d',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'category_id' => 'required|integer',
            'image' => 'mimes:jpeg,png'
        ];
        foreach ($this->input('authors') as $key => $val) {
            $rules['authors.'.$key] = 'integer';
        }

        return $rules;
    }
}
