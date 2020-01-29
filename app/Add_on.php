<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Add_on extends Model
{
    //
    protected $fillable=['name','slug', 'price', 'status'];

    public function images(){
        return $this->hasMany('App\Add_on_Image','addon_id');
    }



    public function delete(){
        foreach($this->images as $image){
            $image->delete();
        }

    }
}
