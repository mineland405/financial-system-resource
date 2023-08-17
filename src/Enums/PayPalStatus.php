<?php 

namespace Mineland405\FinancialSystemResource\Enums;

enum PayPalStatus: string
{
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match($this) {
            self::PROCESSING => 'Processing',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
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
