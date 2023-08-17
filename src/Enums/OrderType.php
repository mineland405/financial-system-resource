<?php 

namespace Mineland405\FinancialSystemResource\Enums;

enum OrderType: string
{
    case NEW = 'new';
    case EXTEND = 'extend';

    public function label(): string
    {
        return match($this) {
            self::NEW => 'Buy new Package',
            self::EXTEND => 'Extend Package using time',
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
