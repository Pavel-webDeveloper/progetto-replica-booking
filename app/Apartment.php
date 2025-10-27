<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Apartment extends Model
{
    // generare lo slug
    protected static function boot()
    {
        parent::boot(); // chiama il boot della classe base Model

        static::creating(function ($appartamento) {
            $baseSlug = Str::slug($appartamento->titolo);
            $slug = $baseSlug;
            $count = 1;

            while (Apartment::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count++;
            }

            $appartamento->slug = $slug;
        });
    }

    public function images(){
        return $this->hasMany('App\Image');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }
}
