<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Administrador01',
            'email' => 'andreluccunhaalmeida@gmail.com',
            'password' => bcrypt('12345678'),
            'admin' => true
        ]);

        /*User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'admin' => true,
        ]);

        User::factory(10)->create();*/
    }
}
