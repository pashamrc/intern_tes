<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::insert([
            [
                'user_id' => '16062026001',
                'name' => 'Budi',
                'email' => 'budi@gmail.com',
                'status' => 'NEW CUSTOMER',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => '16062026002',
                'name' => 'Andi',
                'email' => 'andi@gmail.com',
                'status' => 'LOYAL CUSTOMER',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}