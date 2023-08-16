<?php

namespace Mineland405\FinancialSystemResource\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;

    protected $connection = 'mysql_main';

    protected $table = 'activity_logs';
    
    public function getDataDecodedAttribute()
    {
        return json_decode($this->data);
    }
}
