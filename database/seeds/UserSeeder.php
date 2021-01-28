<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 1; $i <= 24; $i++){
            $random = Str::random(10);
            DB::table('users')->insert([
                'id' => $random,
                'FirstName' => $faker->username,
                'MiddleName' => $faker->username,
                'LastName' => $faker->username,
                'Suffix' => null,
                'Email' => $faker->unique()->safeEmail,
                'Password' => Str::random(5),
                'Gender' => 'Male',
                'remember_token' => Str::random(10),
            ]);

            DB::table('students')->insert([
                'UserID' => $random,
                'Batch' => 2020,
            ]);


        }
        for($i = 1; $i <= 48; $i++){
            $random = Str::random(10);
            DB::table('users')->insert([
                'id' => $random,
                'FirstName' => $faker->username,
                'MiddleName' => $faker->username,
                'LastName' => $faker->username,
                'Suffix' => null,
                'Email' => $faker->unique()->safeEmail,
                'Password' => Str::random(5),
                'Gender' => 'Female',
                'remember_token' => Str::random(10),
            ]);

            DB::table('students')->insert([
                'UserID' => $random,
                'Batch' => 2020,
            ]);
        }

        for($i = 0; $i<7; $i++){
            $random = Str::random(10);
            DB::table('users')->insert([
                'id' => $random,
                'FirstName' => $faker->username,
                'MiddleName' => $faker->username,
                'LastName' => $faker->username,
                'Suffix' => null,
                'Email' => $faker->unique()->safeEmail,
                'Password' => Str::random(5),
                'Gender' => 'Female',
                'remember_token' => Str::random(10),
            ]);

            DB::table('staff')->insert([
                'UserID' => $random,
                'Position' => 'Manager',
                'Team' => 'Education Team'
            ]);
        }


        
    }
}