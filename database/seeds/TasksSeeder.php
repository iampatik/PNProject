<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = array(
            array("Kitchen", "Center2", "Hard", 12),
            array("Dishwashing", "Center2", "Hard", 12),
            array("Dining", "Center2", "Hard", 12),
            array("Courtyard", "Center2", "Easy", 6),
            array("Front Garden", "Center2", "Easy", 6),
            array("Back Garden", "Center2", "Easy", 6),
            array("Laundry", "Center2", "Easy", 3),
            array("Windows 1","Center2", "Easy", 2),
            array("Windows 2","Center2", "Easy", 2),
            array("Computer Lab", "Center2", "Easy", 2),
            array("Hallway and Corridor","Center2", "Easy", 6),
            array("Office","Center2", "Easy", 1),
            array("Water Jag","Center2", "Easy", 1),
            array("Kettle","Center2", "Easy", 1),
        );
        
        for($i = 0; $i < count($tasks); $i++){
            $random = Str::random(10);
            DB::table('tasks')->insert([
                'id' => $random,
                'TaskName' => $tasks[$i][0],
                'Center' => $tasks[$i][1],
                'Difficulty' => $tasks[$i][2],
                'NoOfStudents' => $tasks[$i][3],
            ]);
        }
    }
}
