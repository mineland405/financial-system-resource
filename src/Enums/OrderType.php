<?php 

namespace Mineland405\FinancialSystemResource\Enums;

enum OrderType: string
{
    case NEW = 'new';
    case EXTEND = 'extend';

    public function label(): string
    {
        return match($this) {
            self::NEW => 'Get New',
            self::EXTEND => 'Extend Using Date',
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
