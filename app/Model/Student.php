<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Model\User;

class Student extends Model
{
    protected $table="students";
    protected $fillable=[
        "UserID",
        "Batch",
    ];

    public function weeklyTasks(){ //list down all task
        return $this->hasMany('WeeklyTask');
    }

    public function user()
    {
        return $this->belongsTo('User', 'UserID');
    }

    public function getAllStudentsByBatch($batch)
    {
        return DB::table('students')
            ->select('students.UserID', 'users.FirstName','users.LastName', 'users.Gender', 'students.Batch')
            ->leftJoin('users', 'students.UserID', '=', 'users.id')->where("Batch", $batch)
            ->get();
    }

    public function getBatchByMale($batch)
    {
        return DB::table('students')
            ->select('students.UserID', 'users.LastName','users.FirstName', 'users.Gender', 'students.Batch')
            ->leftJoin('users', 'students.UserID', '=', 'users.id')->where([["Batch", $batch], ["users.Gender", "Male"]])
            ->get();
    }

    public function getBatchByFemale($batch)
    {
        return DB::table('students')
            ->select('students.UserID', 'users.LastName','users.FirstName', 'users.Gender', 'students.Batch')
            ->leftJoin('users', 'students.UserID', '=', 'users.id')->where([["Batch", $batch], ["users.Gender", "Female"]])
            ->get();
    }
    
    public function getBatchArray($batch){
        $array = DB::table('students')
            ->select('students.UserID', 'users.LastName','users.FirstName', 'users.Gender', 'students.Batch')
            ->leftJoin('users', 'students.UserID', '=', 'users.id')->where("Batch", $batch)
            ->get();
        return json_decode(json_encode($array), true);
    }
}