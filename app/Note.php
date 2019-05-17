<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //
    protected $fillable = ['label','user_id','title','color','note','image'];

    // protected $casts = [
    //     'image' => 'array'
    // ];
}
