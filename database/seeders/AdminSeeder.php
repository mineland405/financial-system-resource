<?php

namespace Mineland405\FinancialSystemResource\Database\Seeders;

use Illuminate\Database\Seeder;
use Mineland405\FinancialSystemResource\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            [
                'first_name' => 'Senior',
                'last_name' => 'Administrator',
                'email' => 'admin@webmaster.com',
                'email_verified_at' => now(),
                'password' => bcrypt('abcd1234'),
            ]
        ];

        foreach($rows as $row) {
            Admin::create($row);
        }

        Admin::factory()->count(50)->create();
    }
}
