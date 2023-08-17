<?php

namespace Mineland405\FinancialSystemResource\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterPage extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql_main';

    protected $table = 'mib_pages';

    /**
     * ----------------------------------------------
     * Scopes
     * ----------------------------------------------
     */

    public function scopeIsAvailable()
	{
		return $this->whereNull('disabled_at')->whereNull('locked_at');
	}

    public function scopeIsActive()
	{
		return $this->whereNull('disabled_at');
	}

	public function scopeIsUnlocked()
	{
		return $this->whereNull('locked_at');
	}

    /**
     * ----------------------------------------------
     * Attributes
     * ----------------------------------------------
     */

    public function getIsActiveAttribute()
	{
		return is_null($this->disabled_at) ? true : false;
	}

    public function getPageUrlAttribute()
	{
		return 'http://' . $this->page_id . "." . _url_non_protocol(config('app.url'));
	}

	public function getIsRemovedAttribute()
	{
		return is_null($this->deleted_at) ? false : true;
	}

	public function getIsLockedAttribute()
	{
		return is_null($this->locked_at) ? false : true;
	}

    /**
     * ----------------------------------------------
     * Relationships
     * ----------------------------------------------
     */

    public function owner()
    {
        return $this->hasOne(Member::class, 'id', 'user_id');
    }
}
