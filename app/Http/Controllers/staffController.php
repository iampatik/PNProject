<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Student;
use App\Model\User;
use Illuminate\Support\Str;
use App\Model\WeeklyTask;
use App\Model\Staff;
use App\Model\Tasks;


class StaffController extends Controller
{

    public function manualShuffle(Request $request)
    {
        $random = Str::random(40);
        foreach ($request as $task) {
            DB::beginTransaction();
            try {
                $weeklyTask = new WeeklyTask([
                    'id' => $random,
                    'taskID' => $task->id,
                    'StudentID' => $task->studentID,
                    'Coordinator' => $task->coordinator,
                    'MakerID' => session('id'),
                    'Center' => $task->center
                ]);

                $weeklyTask->save();
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
            }
        }

    }


    public function autoGenerateTask($batch, $center)
    {
        $randomID = Str::random(20);
        $student = new Student();
        $tasks1 = new Tasks();
        $week = new WeeklyTask();

        $tasks = $tasks1->getTasks($center);
        $students = $student->getBatchArray($batch);
        $taskList = array();

        for ($i = 0; $i < count($tasks); $i++) { //count the number of tasks in the center
            $coordinator = $students[array_rand($students)]['UserID']; //randomly select a coordinator
            $students = $this->removeFromArray($coordinator, $students); // remove the coordinator from the array to avoid duplication
            $id = $tasks[$i]['TaskName']; //get the taskname

            if ($tasks[$i]['Difficulty'] == "Hard") { // if the tasking is labeled as hard
                $boysRequired = round($tasks[$i]['NoOfStudents'] * .25); //get the number of boys required
                if ($students[array_search($coordinator, array_column($students, 'UserID'))]['Gender'] == 'Male') { //if the coordinator is a boy
                    $boysRequired--; //minus the boys required because the coordinator is already a boy
                }
                for ($j = 1; $j <= $tasks[$i]['NoOfStudents'] - 1; $j++) { //count the number of students required for each task
                    if ($boysRequired != 0) { //if boys required is not yet zero
                        while (true) { //while true to make sure a male will be chosen
                            $member = $students[array_rand($students)]['UserID'];
                            if ($students[array_search($member, array_column($students, 'UserID'))]['Gender'] == "Male") {
                                $boysRequired--;
                                array_push($taskList, array($randomID, $id, $member, $coordinator, $tasks[$i]['Center']));
                                $students = $this->removeFromArray($member, $students);
                                break;
                            }
                        }
                    } else {
                        while (true) {
                            $member = $students[array_rand($students)]['UserID'];
                            if ($students[array_search($member, array_column($students, 'UserID'))]['Gender'] != "Male") {
                                $students = $this->removeFromArray($member, $students);
                                array_push($taskList, array($randomID, $id, $member, $coordinator, $tasks[$i]['Center']));
                                break;
                            }
                        }
                    }
                }
            } else {
                for ($j = 0; $j < $tasks[$i]['NoOfStudents'] - 1; $j++) {
                    $member = $students[array_rand($students)]['UserID'];
                    array_push($taskList, array($randomID, $id, $member, $coordinator, $tasks[$i]['Center']));
                    $students = $this->removeFromArray($coordinator, $students);
                }
            }
            array_push($taskList, array($randomID, $id, $coordinator, $coordinator, $tasks[$i]['Center']));
        }
        $week->insertTask($taskList);
        return $week->getAllWeeklyTasks();
    }

    public function trial($center)
    {
        $student = new Tasks();
        return $student->getTasks($center);
    }

    public function getAllUsers()
    {
        return User::all();
    }

    public function getAllStaff()
    {
        return Staff::all();
    }

    public function getTasks($center)
    {
        $tasks = new Tasks();
        return $tasks->getTasks($center);
    }

    public function getAllStudentsByBatch($batch)
    {
        $student = new Student();
        $batch = $student->getAllStudentsByBatch($batch);
        return gettype($batch);
    }

    public function removeFromArray($value, $array)
    {
        if (($key = array_search($value, $array)) !== false) {
            unset($array[$key]);
        }
        return $array;
    }

}