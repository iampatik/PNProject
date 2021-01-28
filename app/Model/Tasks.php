<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Tasks extends Model
{
    protected $table='tasks';
    protected $fillable=[
        'TaskName',
        'Center',
        'Difficulty',
        'NoOfStudents'
    ];

    public function weeklyTask()
    {
        return $this->hasMany('WeeklyTask');
    }

    public function getTasks($center){
        $array = DB::table('tasks')->where('tasks.Center', $center)->get();
        return json_decode(json_encode($array), true);
    }



}