<?php

namespace Mineland405\FinancialSystemResource\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql_main';

    protected $table = 'bank_accounts';
}
