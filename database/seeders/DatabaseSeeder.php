<?php

namespace Mineland405\FinancialSystemResource\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        
        $this->call([
            AdminSeeder::class,
        ]);

        DB::commit();
    }
}
