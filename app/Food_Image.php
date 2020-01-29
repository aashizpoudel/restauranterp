<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Food_Image extends Model
{
    //
    protected $fillable=['food_id', 'user_id', 'location'];

    public function delete(){
        Storage::disk('uploads')->delete($this->location);
        return parent::delete();
    }

}
