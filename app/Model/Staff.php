<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table="staff";
    protected $fillable=[
        "UserID",
        "Position",
        "Team",
    ];

    public function createdTasks() //list down all created tasks
    {
        return $this->hasMany('WeeklyTask');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }
}