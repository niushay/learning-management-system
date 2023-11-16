<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Insert one admin user at first
        $admin_id = DB::table('users')->insertGetId([
            "username" => "root",
            "full_name" => "Super Admin",
            "email" => "admin@score-crm.com",
            'email_verified_at' => now(),
            "password" => Hash::make("password"),
            "remember_token" => Str::random(10),
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $user = User::find($admin_id);
        $user->assignRole(User::ROLES[0]);
    }
}
