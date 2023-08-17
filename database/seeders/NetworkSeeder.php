<?php

namespace Mineland405\FinancialSystemResource\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Mineland405\FinancialSystemResource\Models\Network;

class NetworkSeeder extends Seeder
{
    protected $i = 0;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->loop();
        
        Network::whereColumn('user_id', 'relate_user_id')->delete();
    }

    public function loop()
    {
        $this->i++;

        if($this->i >= 10)
            return;

        try {
            for ($i=0; $i < 10; $i++) { 
                Network::factory()->count(10)->create();
            }
        } catch (\Throwable $th) {
            $this->loop();
        }
    }
}
