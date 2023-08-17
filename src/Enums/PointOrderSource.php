<?php 

namespace Mineland405\FinancialSystemResource\Enums;

enum PointOrderSource: string
{
    case RECHARGE = 'recharge';
    case COMMISSION = 'commission';
    case CASHBACK = 'cashback';
    case PAY = 'pay';

    public function label(): string
    {
        return match($this) {
            self::RECHARGE => 'Recharge Point into Wallet',
            self::COMMISSION => 'Receive commission through network member',
            self::CASHBACK => 'Cashback transaction',
            self::PAY => 'Purchase transaction',
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
