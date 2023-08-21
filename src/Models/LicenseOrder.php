<?php

namespace Mineland405\FinancialSystemResource\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Mineland405\FinancialSystemResource\Enums\OrderPaymentMethod;
use Mineland405\FinancialSystemResource\Enums\OrderStatus;
use Mineland405\FinancialSystemResource\Enums\OrderStatusDescription;
use Mineland405\FinancialSystemResource\Enums\OrderType;

class LicenseOrder extends Model
{
    use HasFactory;

    protected $connection = 'mysql_main';

    protected $table = 'license_orders';

    protected $fillable = [
        'code',
        'member_id',
        'page_id',
        'license_order_id',
        'account_size',
        'price',
        'quantity',
        'payment_method',
        'type',
        'status',
        'total',
        'expires_at',
    ];

    public function filter()
    {
        $query = $this;

        if(request()->filled('search')) {
            $query = $query->where(function($cond) {
                return $cond->where('code', 'LIKE', _search_text(request()->search));
            });
        }

        // if($request->filled('name')) {
        //     $query = $query->where(function($cond) use ($request) {
        //         return $cond->where('first_name', 'LIKE', _search_text($request->name))->orWhere('last_name', 'LIKE', _search_text($request->name));
        //     });
        // }

        // if($request->filled('email')) {
        //     $query = $query->where('email', 'LIKE', _search_text($request->email));
        // }

        // if($request->filled('phone')) {
        //     $query = $query->where('phone', 'LIKE', _search_text($request->phone));
        // }

        // if($request->filled('status') && count($request->status) === 1) {
        //     if(in_array('active', $request->status)) {
        //         $query = $query->active();
        //     }
            
        //     if(in_array('disable', $request->status)) {
        //         $query = $query->disable();
        //     }
        // }

        return $query;
    }

    public function getExpiresAt()
    {
        return Carbon::now()->addDay();
    }

    /**
     * -------------------------------------------------------
     * Attributes
     * -------------------------------------------------------
     */

    public function getPaymentMethodLabelAttribute()
    {
        return OrderPaymentMethod::options()[$this->payment_method];
    }

    public function getTypeLabelAttribute()
    {
        return OrderType::options()[$this->type];
    }

    public function getStatusLabelAttribute()
    {
        return OrderStatus::options()[$this->status];
    }

    public function getStatusDescriptionAttribute()
    {
        return OrderStatusDescription::options()[$this->status];
    }

    public function getStatusGroupAttribute()
    {
        if(in_array($this->status, [OrderStatus::ORDERED->value, OrderStatus::CUSTOMER_PAID->value, OrderStatus::PAID->value]))
            return OrderStatus::ORDERED->value;
        if(in_array($this->status, [OrderStatus::PROCESSING->value]))
            return OrderStatus::PROCESSING->value;
        if(in_array($this->status, [OrderStatus::COMPLETED->value]))
            return OrderStatus::COMPLETED->value;
        if(in_array($this->status, [OrderStatus::CANCELLED->value, OrderStatus::FAILED->value]))
            return OrderStatus::FAILED->value;
    }

    /**
     * -------------------------------------------------------
     * Relationships
     * -------------------------------------------------------
     */

    public function member()
    {
        return $this->hasOne(Member::class, 'id', 'member_id');
    }

    public function statusTracking()
    {
        return $this->hasMany(OrderStatusTracking::class, 'order_id')->where('order_type', 'license')->orderBy('id', 'asc');
    }

    public function masterPage()
    {
        return $this->hasOne(MasterPage::class, 'id', 'page_id')->whereNull('disabled_at')->whereNull('locked_at');
    }

    /**
     * --------------------------------------------------------
     * Func
     * --------------------------------------------------------
     */
    public function store($data)
    {
        $record = $this->refresh();
        $record->member_id = Auth::user()->id;
        $record->page_id = _master_page_id(); 
        $record->license_order_id = $data->license_order_id ?? NULL; 
        $record->code = NULL; 
        $record->account_size = $data->account_size; 
        $record->quantity = $data->quantity; 
        $record->price = $data->price;
        $record->total = $data->total;
        $record->payment_method = $data->payment_method; 
        $record->status = $data->status ?? OrderStatus::PAID->value; 
        $record->type = $data->type;
        $record->expires_at = NULL; // Update when order COMPLETE
        $record->save(); 

        return $record;
    }
}
