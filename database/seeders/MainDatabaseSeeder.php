<?php

namespace Mineland405\FinancialSystemResource\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainDatabaseSeeder extends Seeder
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
            MemberSeeder::class,
            PackageSeeder::class,
            OptionSeeder::class,
            BankAccountSeeder::class
        ]);

        DB::commit();
    }
}
