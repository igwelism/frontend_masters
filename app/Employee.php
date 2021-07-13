<?php

namespace App;

use Illuminate\Foundation\Auth\User as Model;

class Employee extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'employee_password', 'remember_token'
    ];

    public function getAuthPassword()
    {
        return $this->employee_password;
    }
}
