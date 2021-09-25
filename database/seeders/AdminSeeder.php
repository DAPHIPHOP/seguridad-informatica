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
        $user=new User();
        $user->name='Deybi Arroyo';
        $user->email='super_admin';
        $user->password=Hash::make('123456789Ab@');
        $user->save();

        $user->assignRole('Admin');

    }
}
