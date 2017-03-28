<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable

{
    use Notifiable, HasRoles;

    protected $fillable = [
        'name', 'lastname', 'birthdate', 'age', 'identification', 'gender', 'phone', 'mobile', 'address', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function fullName(){
        return $this->name . " " . $this->lastname;
    }
}