<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Kintamieji extends Model
{
    public $table = "kintamieji";

    protected $fillable = [
        'id',
        'mokestis',
        'nuolaida',
        'mokesciotagas',
        'indnuolaidostagas',
        'globalnuolaidostagas'


    ];
}