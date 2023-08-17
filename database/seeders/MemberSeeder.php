<?php

namespace Mineland405\FinancialSystemResource\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Mineland405\FinancialSystemResource\Models\Member;

class MemberSeeder extends Seeder
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
                'first_name' => 'Ho Viet',
                'last_name' => 'Vu Thanh',
                'email' => 'master1@webmaster.com',
                'email_verified_at' => now(),
                'password' => bcrypt('abcd1234'),
                'country' => 'VN',
                'timezone' => 'Asia/Ho_Chi_Minh',
                'language' => 'vi',
                'point' => 1000000,

                'referral_link' => _generate_referral_link(),
                'referral_code' => _generate_referral_code()
            ]
        ];

        foreach($rows as $row) {
            Member::create($row);
        }

        Member::factory()->count(100)->create();
    }
}
