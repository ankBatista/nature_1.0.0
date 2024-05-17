<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sevices extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'icon', 'active'];

    public function rules()
    {
        return [
            'title' => 'required|min:3|max:120',
            'content' => 'required|min:3|max:500',
            'icon' => 'required|file|mimes:png'


        ];
    }
    public function feedback()
    {

        return [
            'required' => 'O campo :attribute precisa ser preenchido',
        ];
    }
}
