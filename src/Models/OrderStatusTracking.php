<?php

namespace Mineland405\FinancialSystemResource\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Mineland405\FinancialSystemResource\Enums\OrderStatus;
use Mineland405\FinancialSystemResource\Enums\OrderStatusDescription;

class OrderStatusTracking extends Model
{
    use HasFactory;

    protected $connection = 'mysql_main';

    protected $table = 'order_status_tracking';

    protected $fillable = [
        'admin_id',
        'order_id',
        'status'
    ];

    /**
     * -------------------------------------------------------
     * Attributes
     * -------------------------------------------------------
     */
    public function getStatusLabelAttribute()
    {
        return OrderStatus::options()[$this->status];
    }

    public function getStatusDescriptionAttribute()
    {
        return OrderStatusDescription::options()[$this->status];
    }
}
