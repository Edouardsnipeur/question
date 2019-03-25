<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Suscriber extends Model
{
    use Notifiable;
    public function devis()
    {
        return $this->hasMany(Devi::class);
    }
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($suscriber){
            $suscriber->devis()->delete();
        });
    }
}
