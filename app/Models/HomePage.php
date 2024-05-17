<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'caption', 'content', 'banner', 'active'];

    public function rules() {
        return [
            'title' => 'required|min:3|max:255',
            'caption' => 'required|min:3|max:255',
            'content' => 'required',
            'banner' => 'required',
        ];
    }
    public function feedback()
    {

        return [
            'required' => 'O campo :attribute precisa ser preenchido',
        ];
    }
}
