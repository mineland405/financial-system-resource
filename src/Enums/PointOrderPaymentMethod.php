<?php 

namespace Mineland405\FinancialSystemResource\Enums;

enum PointOrderPaymentMethod: string
{
    case PAYPAL = 'paypal';
    case COINPAYMENTS = 'coinpayments';
    case OTHER = 'manual';

    public function label(): string
    {
        return match($this) {
            self::PAYPAL => 'PayPal',
            self::COINPAYMENTS => 'CoinPayments',
            self::OTHER => 'Other',
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
