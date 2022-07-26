<?php

namespace Database\Seeders;

use App\Models\Users\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        // $this->call(UserSeeder::class);
        // $this->call(ProductoSeeder::class);
        // $this->call(ProductoValorSeeder::class);
        // $this->call(InformacionPersonalSeeder::class);

        // $user = User::find(1);
        // $user->assignRole('admin');

    }
}
