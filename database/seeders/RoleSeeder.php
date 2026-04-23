<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    // isi data 3 role lewat seeder
    public function run(): void
    {
        // SQL
        // INSERT INTO roles (role) VALUES
        // ('admin'), ('seller'), ('buyer');
        DB::table('roles')->insert([
            ['role' => 'admin'],
            ['role' => 'seller'],
            ['role' => 'buyer'],
        ]);
    }
}
