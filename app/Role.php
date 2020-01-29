<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public static function findByString($str){
        $sl = strtolower($str);
        return Role::where('slug',$sl)->first();
    }
}
