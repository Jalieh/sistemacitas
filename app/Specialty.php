<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Specialty extends Model
{
    use Notifiable;

    protected $fillable = [
        'name',
    ];
}

