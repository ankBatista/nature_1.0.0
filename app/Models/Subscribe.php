<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    use HasFactory;

    protected $fillable = ['email'];

    public function rules()
    {
        return [

            'email' => 'required|email|unique:subscribes,email|max:50'

        ];
    }
    public function feedback()
    {

        return [
            'email.required' => 'O campo de e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um endereço de e-mail válido.',
            'email.unique' => 'Este endereço de e-mail já está cadastrado.',
            'email.max' => 'O endereço de e-mail não pode ter mais de :max caracteres.',
        ];
    }
}
