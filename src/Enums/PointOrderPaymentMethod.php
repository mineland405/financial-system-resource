<?php 

namespace Mineland405\FinancialSystemResource\Enums;

enum PointOrderPaymentMethod: string
{
    case PAYPAL = 'paypal';
    case COINPAYMENTS = 'coinpayments';

    public function label(): string
    {
        return match($this) {
            self::PAYPAL => 'PayPal',
            self::COINPAYMENTS => 'CoinPayments',
        };
    }

    public static function options() : array
    {
        return collect(self::cases())->mapWithKeys(fn (self $enum) => [
            $enum->value => $enum->label(),
        ])
        ->toArray();
    }
}
