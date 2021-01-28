<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Model\User;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $staff = User::select('id')->get();

        foreach($staff as $sta)
        {
            DB::table('students')->insert([
                'UserID' => $sta->id,
                'Position' => 'Manager',
                'Team' => 'Education Team'
            ]);
        }

        // for($i = 63; $i<70; $i++)
        // {
        //     DB::table('students')->insert([
        //         'UserID' => $staff[$i]->id,
        //         'Position' => 'Manager',
        //         'Team' => 'Education Team'
        //     ]);
        // }

    }
}