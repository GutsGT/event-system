<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    //Usando a variável $fillable, você indica qual variável pode receber inserções em massa,
    //caso deixe ela vazia, nenhum dado poderá receber alterações
    //Porém, se usar a variável $guarded, ao deixar ela vazia você informa que nenhum dos dados
    //é protegido contra inserções em massa, permitindo a edição a vontade dos dados.

    protected $guarded = [];

    protected $casts = [
        'items'=>'array'
    ];

    protected $dates = ['date'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function users(){
        return $this->belongsToMany('App\Models\User');
    }
}
