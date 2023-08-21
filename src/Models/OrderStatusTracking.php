<?php

namespace Mineland405\FinancialSystemResource\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
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
        'order_type',
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

    /**
     * ---------------------------------------------------------
     * Func
     * ---------------------------------------------------------
     */
    public function insert($order, $type = 'package', $adminId = NULL)
    {
        $record = $this->refresh();
        $record->admin_id = $adminId;
        $record->order_id = $order->id;
        $record->status = $order->status;
        $record->order_type = $type;
        $record->save();
    }
}
