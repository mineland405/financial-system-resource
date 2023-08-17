<?php

namespace Mineland405\FinancialSystemResource\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Mineland405\FinancialSystemResource\Models\Package;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            ['type' => '5000', 'code' => 'S5P1',  'name' => 'Gói 1',  'quantity' => 1,	'price' =>  1000,	'first_yr_server_fee' => 50,   'next_yrs_server_fee' => 250],		
            ['type' => '5000', 'code' => 'S5P2',  'name' => 'Gói 2',  'quantity' => 5,	'price' =>  700,	'first_yr_server_fee' => 50,   'next_yrs_server_fee' => 250],		
            ['type' => '5000', 'code' => 'S5P3',  'name' => 'Gói 3',  'quantity' => 20,	'price' =>  600,	'first_yr_server_fee' => 50,   'next_yrs_server_fee' => 250],		
            ['type' => '5000', 'code' => 'S5P4',  'name' => 'Gói 4',  'quantity' => 60,	'price' =>  500,	'first_yr_server_fee' => 50,   'next_yrs_server_fee' => 250],		
            ['type' => '5000', 'code' => 'S5P5',  'name' => 'Gói 5',  'quantity' => 100,	'price' =>  400,	'first_yr_server_fee' => 50,   'next_yrs_server_fee' => 250],		
            ['type' => '5000', 'code' => 'S5P6',  'name' => 'Gói 6',  'quantity' => 300,	'price' =>  250,	'first_yr_server_fee' => 50,   'next_yrs_server_fee' => 250],		
            ['type' => '5000', 'code' => 'S5P7',  'name' => 'Gói 7',  'quantity' => 500,	'price' =>  200,	'first_yr_server_fee' => 50,   'next_yrs_server_fee' => 250],		
            ['type' => '2000', 'code' => 'S2P1',  'name' => 'Gói 1',  'quantity' => 1,	'price' =>  500,	'first_yr_server_fee' => 50,   'next_yrs_server_fee' => 150],		
            ['type' => '2000', 'code' => 'S2P2',  'name' => 'Gói 2',  'quantity' => 5,	'price' =>  400,	'first_yr_server_fee' => 50,   'next_yrs_server_fee' => 150],		
            ['type' => '2000', 'code' => 'S2P3',  'name' => 'Gói 3',  'quantity' => 20,	'price' =>  350,	'first_yr_server_fee' => 50,   'next_yrs_server_fee' => 150],		
            ['type' => '2000', 'code' => 'S2P4',  'name' => 'Gói 4',  'quantity' => 60,	'price' =>  300,	'first_yr_server_fee' => 50,   'next_yrs_server_fee' => 150],		
            ['type' => '2000', 'code' => 'S2P5',  'name' => 'Gói 5',  'quantity' => 100,	'price' =>  250,	'first_yr_server_fee' => 50,   'next_yrs_server_fee' => 150],		
            ['type' => '2000', 'code' => 'S2P6',  'name' => 'Gói 6',  'quantity' => 300,	'price' =>  200,	'first_yr_server_fee' => 50,   'next_yrs_server_fee' => 150],		
            ['type' => '2000', 'code' => 'S2P7',  'name' => 'Gói 7',  'quantity' => 500,	'price' =>  150,	'first_yr_server_fee' => 50,   'next_yrs_server_fee' => 150],
        ];

        foreach($rows as $row) {
            Package::create($row);
        }
    }
}
