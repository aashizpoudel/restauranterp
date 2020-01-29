<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category_Image extends Model
{
    //
    protected $fillable=['category_id', 'user_id', 'location'];

    public function delete(){
        Storage::disk('uploads')->delete($this->location);
        return parent::delete();
    }
}
