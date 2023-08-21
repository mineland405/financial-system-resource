<?php

namespace Mineland405\FinancialSystemResource\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    /**
     * --------------------------------------------------
     * Funcs
     * --------------------------------------------------
     */
    public function maxLicenseQty($accountSize)
    {
        // ID of member who owner current master page
        $pageOwnerId = MasterPage::where('page_id', _page_id())->first()->member_id;

        return $this->from($this->table . ' as mp')
            ->join((new Package)->getTable() . ' as p', 'mp.package_id', '=', 'p.id')
            ->where('mp.member_id', $pageOwnerId)
            ->where('mp.expires_at', '>', now())
            ->where('p.type', $accountSize)
            ->select(DB::raw('SUM(mp.available_quantity) as qty'))
            ->first()->qty ?? 0;
    }
}
