<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devi extends Model
{
    public function suscriber()
    {
        return $this->belongsTo(Suscriber::class);
    }
}
