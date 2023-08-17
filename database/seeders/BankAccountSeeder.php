<?php

namespace Mineland405\FinancialSystemResource\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Mineland405\FinancialSystemResource\Models\BankAccount;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            ['bank_name' => 'Ngân hàng Ngoại Thương Việt Nam (Vietcombank)', 'account_name' => 'Ho Viet Vu Thanh', 'account_number' => '0911000011958'],
            ['bank_name' => 'Ngân hàng TMCP Á Châu (ACB)', 'account_name' => 'Ho Viet Vu Thanh', 'account_number' => '23787797'],
        ];
        
        foreach($rows as $row) {
            BankAccount::create($row);
        }
    }
}
