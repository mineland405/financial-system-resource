<?php

namespace Mineland405\FinancialSystemResource\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MemberPackage extends Model
{
    use HasFactory;

    protected $connection = 'mysql_main';

    protected $table = 'member_packages';

    /**
     * Belong to member
     */
    public function member()
    {
        return $this->hasOne(Member::class, 'id', 'member_id');
    }

    /**
     * Belong to package
     */
    public function package()
    {
        return $this->hasOne(Package::class, 'id', 'package_id');
    }

    /**
     * Has many orders:
     * 1 Buy new package order
     * Many extend package order
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }
}
