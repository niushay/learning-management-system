<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => User::ROLES[0], 'guard_name' => config('auth.defaults.guard')],
            ['name' => User::ROLES[1], 'guard_name' => config('auth.defaults.guard')],
            ['name' => User::ROLES[2], 'guard_name' => config('auth.defaults.guard')],
        ]);
    }
}
