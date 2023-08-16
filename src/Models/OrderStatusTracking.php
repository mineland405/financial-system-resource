<?php

namespace Mineland405\FinancialSystemResource\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
