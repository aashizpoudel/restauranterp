<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Add_on_Image extends Model
{
    //
    protected $fillable=['addon_id', 'user_id', 'location'];

    public function delete(){
        Storage::disk('uploads')->delete($this->location);
        return parent::delete();
    }

}
