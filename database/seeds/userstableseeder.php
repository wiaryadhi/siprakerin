<?php

use Illuminate\Database\Seeder;
use App\User;

class userstableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'username'=> 'admin',
            'password'=> bcrypt('admin'),
            'privillage'=> 1
        ]);
    }
}
