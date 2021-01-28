<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table="users";
    protected $fillable=[
        'FirstName',
        'MiddleName',
        'LastName',
        'Suffix',
        'Email',
        'Password',
        'Gender',
    ];

    protected $hidden = [
        'Pssword', 'remember_token',
    ];

    public function student()
    {
        return $this->hasOne('Student');
    }

    public function staff()
    {
        return $this->hasOne('Staff');
    }

}