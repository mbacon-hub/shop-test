<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        #Create admin
        /** @var User $admin */
        $admin = User::factory()->create([
            'email' => 'admin@shop.com'
        ]);

        $admin->assignRole('admin');

        #Creat users
        User::factory(mt_rand(10,16))->create();
    }
}
