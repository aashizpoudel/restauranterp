<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable=['name', 'slug', 'status', 'is_offer'];

    public function images(){
        return $this->hasMany('App\Category_Image', 'category_id');
    }

    public function foods(){
        return $this->hasMany('App\Food');
    }


    public function delete(){
        foreach($this->foods as $food){
            $food->delete();
        }

        foreach($this->images as $image){
            $image->delete();
        }
    }
}
