<?php

namespace Mineland405\FinancialSystemResource\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Mineland405\FinancialSystemResource\Models\Member;
use Mineland405\FinancialSystemResource\Models\Network;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Mineland405\FinancialSystemResource\Models\RelationshipNetwork>
 */
class NetworkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Network::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $except = Network::all()->pluck('relate_member_id');
        return [
            'member_id' => Member::all()->random()->id,
            'relate_member_id' => Member::whereNotIn('id', $except)->get()->random()->id,
        ];
    }
}
