<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $password=Hash::make('123456789');
        $user=new User();
        $user->name='Deybi';
        $user->last_name='Arroyo';
        $user->username='9999999999';
        $user->dni='9999999999';
        $user->email='deybi@gmail.com';
        $user->password=$password;
        $user->save();

        $user->passwords()->create(['password'=> $password]);

        $user->assignRole('Admin');

    }
}
