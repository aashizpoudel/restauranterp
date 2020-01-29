<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addons_Food extends Model
{
    //
    protected $table = 'add_on_food';
    protected $fillable = ['food_id', 'add_on_id'];
 // singular name use gara belongsTo ra hasOne ma
    public function food(){
        return $this->belongsTo('App\Food');
    }
    public function add_on(){
        return $this->belongsTo('App\Add_on');
    }
    public function addons(){
        return $this->hasMany('App\Add_on');
    }
}
