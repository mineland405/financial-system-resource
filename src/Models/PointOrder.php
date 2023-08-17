<?php

namespace Mineland405\FinancialSystemResource\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Mineland405\FinancialSystemResource\Enums\CoinPaymentsStatus;
use Mineland405\FinancialSystemResource\Enums\PayPalStatus;
use Mineland405\FinancialSystemResource\Enums\PointOrderPaymentMethod;
use Mineland405\FinancialSystemResource\Enums\PointOrderSource;

class PointOrder extends Model
{
    use HasFactory;

    protected $connection = 'mysql_main';

    protected $table = 'point_orders';

    /**
     * --------------------------------------------
     * Attributes
     * --------------------------------------------
     */

    public function getIsCommissionAttribute()
	{
		return $this->source == PointOrderSource::COMMISSION->value;
	}

    public function getPaypalStatusLabelAttribute()
	{
		return PayPalStatus::options()[$this->paypal_status] ?? NULL;
	}

    public function getCoinpaymentsStatusLabelAttribute()
	{
		return CoinPaymentsStatus::options()[$this->coinpayments_status] ?? NULL;
	}

    public function getPaymentMethodLabelAttribute()
	{
		return PointOrderPaymentMethod::options()[$this->payment_method] ?? NULL;
	}

    public function getSourceLabelAttribute()
	{
		return PointOrderSource::options()[$this->source];
	}


    /**
     * --------------------------------------------
     * Relationships
     * --------------------------------------------
     */

    /**
     * Relationship to members table by member_id
     */
    public function member()
    {
        return $this->hasOne(Member::class, 'id', 'member_id');
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
    public function networkMember()
    {
        return $this->hasOne(Member::class, 'id', 'network_member_id');
    }

    /**
     * --------------------------------------------
     * Funcs
     * --------------------------------------------
     */

    public function filter()
    {
        $memberTable = (new Member)->getTable();

        // $orderTable
        $query = $this->join($memberTable, "{$this->table}.member_id", "{$memberTable}.id");

        if(request()->filled('search')) {
            $query = $query->where(function($cond) {
                return $cond->where('members.first_name', 'LIKE', _search_text(request()->search))
                ->orWhere('members.last_name', 'LIKE', _search_text(request()->search))
                ->orWhere('members.email', 'LIKE', _search_text(request()->search));
            });
        }

        return $query;
    }
}
