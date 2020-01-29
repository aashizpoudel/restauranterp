<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    //
    protected $fillable = ['category_id', 'name','slug', 'components', 'notes', 'description', 'price' ,'vat', 'is_offer', 'is_special', 'status'];
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function images(){
        return $this->hasMany('App\Food_Image', 'food_id');
    }

    public function delete(){
        foreach($this->images as $image){
            $image->delete();
        }

    }
}
