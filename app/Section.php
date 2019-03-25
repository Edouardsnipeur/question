<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($section){
            $section->questions()->delete();
        });
    }
}
