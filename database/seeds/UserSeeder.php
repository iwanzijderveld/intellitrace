<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Insanetlabs\IntelliTrace\Models\IntelliTraceUser;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new IntelliTraceUser();
        $user->name = 'Admin';
        $user->username = 'admin';
        $user->password = Hash::make('admin');
        $user->save();
    }
}
