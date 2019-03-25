<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function reponses()
    {
        return $this->hasMany(Reponse::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($question){
            $question->reponses()->delete();
        });
    }
}
