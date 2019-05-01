<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function getImageUrlAttribute($value){
        $imageUrl = "";
        if(! is_null($this->image)){
            $imagePath = base_path()."/assets/img/".$this->image;
            if(file_exists($imagePath)) {
                $imageUrl= asset('assets/img/'.$this->image);
            }
        }
        return $imageUrl;
    }
}
