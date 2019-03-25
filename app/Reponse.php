<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
