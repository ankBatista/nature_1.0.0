<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cards extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    public function rules()
    {
        return [
            'title' => 'required|min:3|max:30',
            'description' => 'required|min:3|max:500',

            // 'company_logo' => 'required|file|mimes:png'


        ];
    }
    public function feedback()
    {

        return [
            'required' => 'O campo :attribute precisa ser preenchido',
        ];
    }
}
