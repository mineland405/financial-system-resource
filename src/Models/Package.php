<?php

namespace Mineland405\FinancialSystemResource\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql_main';

    protected $table = 'packages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'code',
        'name',
        'quantity',
        'price',
        'first_yr_server_fee',
        'next_yrs_server_fee',
    ];

    /**
     * ----------------------------------------------
     * Attributes
     * ----------------------------------------------
     */

    public function getIsActiveAttribute()
    {
        return $this->disabled == 0;
    }

    /**
     * ----------------------------------------------
     * Relationships
     * ----------------------------------------------
     */

    /**
     * Get pricing of Master Page
     */
    public function packagePricing(): HasOne
    {
        return $this->hasOne(PackagePricing::class, 'package_id', 'id')->where('disabled', false)->where('page_id', _master_page_id());
    }

    /**
     * ----------------------------------------------
     * Funcs
     * ----------------------------------------------
     */

    public function filter()
    {
        $query = $this;

        if(request()->filled('search')) {
            $query = $query->where(function($cond) {
                return $cond->where('code', 'LIKE', _search_text(request()->search))
                ->orWhere('name', 'LIKE', _search_text(request()->search));
            });
        }

        return $query;
    }
}
