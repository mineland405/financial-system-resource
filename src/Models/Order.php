<?php

namespace ThanhHVV\FSResource\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Model;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql_main';

    protected $table = 'orders';

    protected $fillable = [
        'code',
        'user_id',
        'package_id',
        'package_type',
        'package_code',
        'package_name',
        'package_quantity',
        'package_price',
        'package_server_fee',
        'payment_method',
        'payment_expires_at',
        'status',
        'total',
    ];

    const STATUS = [
        'ordered' => 'Ordered', // Đang thực hiện
        'customer_paid' => 'Customer Paid', // Đang thực hiện
        'paid' => 'Paid', // Đang thực hiện
        'processing' => 'Processing', // Đang xử lý kỹ thuật
        'completed' => 'Completed', // Hoàn tất
        'cancelled' => 'Cancelled', // Không thành công
        'failed' => 'Payment Failed' // Không thành công
    ];

    const STATUS_DESCRIPTION = [
        'ordered' => 'Order Made', // Đã thực hiện mua hàng
        'customer_paid' => 'Manually paid through the bank', // Khách hàng đã thanh toán thủ công thông qua ngân hàng
        'paid' => 'Payment Confirmed', // Xác nhận đã thanh toán
        'processing' => 'The technical team has received and processed', // Đội ngũ kỹ thuật đã tiếp nhận xử lý
        'completed' => 'Order Completed', // Hoàn tất
        'cancelled' => 'Order Cancelled', // Không thành công
        'failed' => 'Order has expired' // Không thành công
    ];

    const PAYMENT_METHODS = [
        'manual' => 'Manual Transfer',
        'point' => 'Pay with Point'
    ];

    public function filter()
    {
        $query = $this;

        if(request()->filled('search')) {
            $query = $query->where(function($cond) {
                return $cond->where('code', 'LIKE', _search_text(request()->search))
                ->orWhere('package_code', 'LIKE', _search_text(request()->search))
                ->orWhere('package_name', 'LIKE', _search_text(request()->search));
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

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function package()
    {
        return $this->hasOne(Package::class, 'id', 'product_package_id');
    }

    public function statusTracking()
    {
        return $this->hasMany(OrderStatusTracking::class, 'order_id')->orderBy('id', 'asc');
    }

    public function masterPage()
    {
        return $this->hasOne(MasterPage::class, 'id', 'page_id')->whereNull('disabled_at')->whereNull('locked_at');
    }
}
