<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Model\User;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $students = User::select('id')->get();

        for($i = 0; $i<62; $i++)
        {
            DB::table('students')->insert([
                'UserID' => $students[$i]->id,
                'Batch' => 2020,
            ]);
        }
    }
}