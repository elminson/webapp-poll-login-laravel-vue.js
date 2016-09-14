<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
     protected $fillable = [
    	'id','id_question','answer'
    ];

}