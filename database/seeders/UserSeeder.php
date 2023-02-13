<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>'$2y$10$b2Iq/g258lcwHCPfrqxODetq4x060X0SV6h17ET8kwTfsnoX6T1EG'
        ]);
    }
}
