<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;


class Post extends Model
{
    protected $dates = ['published_at'];
    protected $fillable = ['title','slug','excerpt','body','published_at','category_id','image'];

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

    public function author(){
       return $this->belongsTo(User::class);
    }

    public function getDateAttribute(){
        return is_null($this->published_at)?'':$this->published_at->diffForHumans();
    }

    public function scopeLatestFirst($query){
        return $query->orderBy('created_at','desc');
    }

    public function scopePublished($query){
        return $query->where('published_at','<=',Carbon::now());
    }

    public function getBodyHtmlAttribute($value){
        return $this->body ? Markdown::ConvertToHtml(e($this->body)):NULL;
    }

    public function getExcerptHtmlAttribute($value){
        return $this->body ? Markdown::ConvertToHtml(e($this->excerpt)):NULL;
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function scopePopular($query){
        return $query->orderBy('view_count','desc');
    }

    public function getThumbUrlAttribute($value){
        $imageUrl = "";
        if(! is_null($this->image)){
            $ext = substr(strchr($this->image,'.'),1);
            $thumbnail = str_replace(".{$ext}","_thumb.{$ext}",$this->image);
            $imagePath = base_path()."/assets/img/".$thumbnail;
            if(file_exists($imagePath)) {
                $imageUrl= asset('assets/img/'.$thumbnail);
            }
        }

        return $imageUrl;
    }

    public function dateFormatted($showTimes=false){
        $format = 'd/m/Y';
        if($showTimes) $format = $format.'H:i:s';
        return $this->created_at->format($format);
    }

    public function publicationLabel(){
        if(! $this->published_at){
            return '<span class="label label-warning">Draft</span>';
        }elseif($this->published_at && $this->published_at->isFuture()){
            return '<span class="label label-info">Scheduler</span>';
        }else{
            return '<span class="label label-success">Published</span>';
        }
    }

    public function setPublishedAtAttribute($value){
        $this->attributes['published_at'] = $value ?:NULL;
    }

}
