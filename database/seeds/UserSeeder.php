<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'Juan Paulo Pineda',
            'position' => 'IT Specialist 2',
            'username' => 'jppineda',
            'password' => Hash::make('pmi12345'),
            'is_password_changed' => 1,
            'status' => 1,
            'user_level_id' => 1,
            'created_by' => 1,
            'last_updated_by' => 1,
            'logdel' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
