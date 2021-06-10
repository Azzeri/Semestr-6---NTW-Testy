<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->email = "admin@uczelnia.pl";
        $admin->password = bcrypt('qwerty');
        $admin->privilege = 'admin';
        $admin->save();
    }
}
