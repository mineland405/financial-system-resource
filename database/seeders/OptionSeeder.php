<?php

namespace Mineland405\FinancialSystemResource\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        _set_option('commission_percent_f5', 5);
        _set_option('commission_percent_f4', 5);
        _set_option('commission_percent_f3', 5);
        _set_option('commission_percent_f2', 10);
        _set_option('commission_percent_f1', 25);
    }
}
