<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class WeeklyTask extends Model
{
    protected $table = 'weeklyTask';
    protected $fillable = [
        'TaskID',
        'StudentID',
        'Coordinator',
        'MakerID',
        'Center'
    ];

    public function tasks()
    {
        return $this->belongsTo('Tasks', 'TaskID');
    }

    public function student()
    {
        return $this->belongsTo('Student', 'StudentID');
    }

    public function staff()
    {
        return $this->belongsTo('Staff', 'MakerID');
    }

    public function insertTask($array)
    {
        DB::beginTransaction();
        try {
            for($i = 0; $i < count($array); $i++){
                $values = array('id' => $array[1][0], 'TaskID' => $array[$i][1], 
                'StudentID' => $array[$i][2], 'Coordinator' => $array[$i][3],
                'MakerID' => "Trial", 'Center' => $array[$i][4],
                'created_at' => Carbon::now());
                DB::table('weeklyTask')->insert($values);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function getAllWeeklyTasks()
    {
        return DB::table('weeklyTask')->get();
    }




}