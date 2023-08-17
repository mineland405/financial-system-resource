<?php

namespace Mineland405\FinancialSystemResource\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MemberPackage extends Model
{
    use HasFactory;

    protected $connection = 'mysql_main';

    protected $table = 'member_packages';

    public function member()
    {
        return $this->hasOne(Member::class, 'id', 'member_id');
    }

    public function package()
    {
        return $this->hasOne(Package::class, 'id', 'package_id');
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }
}
