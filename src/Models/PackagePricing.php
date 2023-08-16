<?php

namespace Mineland405\FinancialSystemResource\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackagePricing extends Model
{
    use HasFactory;

    protected $table = 'package_pricing';

    protected $packageTable;

    public function __construct()
    {
        $this->packageTable = (new Package)->getTable();
    }

    protected static function booted(): void
    {
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('disabled', false);
        });

        if(_is_subdomain()) {
            static::addGlobalScope('master_ib', function (Builder $builder) {
                $builder->where('mib_id', _mib_page_id());
            });
        }
    }

    /**
     * ------------------------------------------------
     * Scopes
     * ------------------------------------------------
     */

    public function scopeIsActive()
    {
        return $this->whereNull('disabled_at');
    }

    /**
     * ------------------------------------------------
     * Relationships
     * ------------------------------------------------
     */

    /**
     * Relationship to package
     */
    public function package()
    {
        return $this->hasOne(Package::class, 'id', 'package_id');
    }

    /**
     * ------------------------------------------------
     * Funcs
     * ------------------------------------------------
     */

    public function getPackages()
    {
        return $this->from("$this->table as pp")
            ->rightJoin("$this->packageTable as p", "p.id", '=', 'pp.package_id')
            ->where("p.disabled", false)
            ->where('pp.disabled', false)
            ->whereNull("p.deleted_at")
            ->where('pp.mib_id', _mib_page_id())
            ->where('pp.price', '>', 0)
            ->select('p.*', 'pp.price AS price')
            // ->select('p.*', DB::raw("
            //     CASE
            //         WHEN COALESCE(pp.price, 0) = 0 THEN p.price
            //         WHEN COALESCE(pp.price, 0) <> 0 THEN pp.price
            //     END AS price
            //     "))
            ->get();
    }
}
