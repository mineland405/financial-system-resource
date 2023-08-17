<?php

namespace Mineland405\FinancialSystemResource\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PointHistory extends Model
{
    use HasFactory;

    protected $connection = 'mysql_main';

    protected $table = 'point_histories';

    const SOURCE = [
        'recharge' => 'Mua qua giao dịch nạp tiền',
        'commission' => 'Nhận hoa hồng thông qua network',
        'cashback' => 'Giao dịch hoàn tiền',
        'pay' => 'Thanh toán mua hàng'
    ];

    const PAYPAL_STATUS = [
        'processing' => 'Processing',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ];

    const COINPAYMENTS_STATUS = [
        'created' => 'Created',
        'wait_for_funds' => 'Waiting For Funds',
        'funds_received' => 'Funds Received',
        'complete' => 'Complete',
        'cancelled' => 'Cancelled / Timed Out',
    ];

    /**
     * --------------------------------------------
     * Attributes
     * --------------------------------------------
     */

    public function getIsCommissionAttribute()
	{
		return $this->source === 'commission';
	}

    /**
     * --------------------------------------------
     * Relationships
     * --------------------------------------------
     */

    /**
     * Relationship to member users table by user_id
     */
    public function user()
    {
        return $this->hasOne(Member::class, 'id', 'user_id');
    }

    /**
     * Relationship to orders table by order_id
     */
    public function order()
    {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }

    /**
     * Relationship to point_orders table by point_order_id
     */
    public function networkUser()
    {
        return $this->hasOne(Member::class, 'id', 'network_user_id');
    }

    /**
     * --------------------------------------------
     * Funcs
     * --------------------------------------------
     */

    public function filter()
    {
        $userTable = (new Member)->getTable();

        // $orderTable
        $query = $this->join($userTable, "{$this->table}.user_id", "{$userTable}.id");

        if(request()->filled('search')) {
            $query = $query->where(function($cond) {
                return $cond->where('users.first_name', 'LIKE', _search_text(request()->search))
                ->orWhere('users.last_name', 'LIKE', _search_text(request()->search))
                ->orWhere('users.email', 'LIKE', _search_text(request()->search));
            });
        }

        return $query;
    }
}
