<?php

namespace Mineland405\FinancialSystemResource\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Mineland405\FinancialSystemResource\Models\Member;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Mineland405\FinancialSystemResource\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('abcd1234'), // password
            'gender' => Arr::shuffle(['male', 'female'])[0],
            'remember_token' => Str::random(10),
            'country' => 'VN',
            'timezone' => 'Asia/Ho_Chi_Minh',
            'language' => 'vi',
            'referral_link' => _generate_referral_link(),
            'referral_code' => _generate_referral_code(),
            'point' => rand(0, 100000)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
