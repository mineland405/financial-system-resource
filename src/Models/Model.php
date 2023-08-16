<?php

namespace Mineland405\FinancialSystemResource\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Facades\Auth;

class Model extends BaseModel
{
    use HasFactory;

    protected $perPage = 50;

    public function scopeAsc($query, $column = 'id')
    {
        return $query->orderBy('created_at', 'asc')->orderBy($column, 'asc');
    }

    public function scopeDesc($query, $column = 'id')
    {
        return $query->orderBy('created_at', 'desc')->orderBy($column, 'desc');
    }

    public function scopeOfMasterPage($query)
    {
        if(is_admin())
            return $query;
        return $query->where('page_id', Auth::guard('master')->user()->hasMasterPage->id);
    }

    public function scopeOfMember($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }
}
