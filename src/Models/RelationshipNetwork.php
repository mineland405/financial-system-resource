<?php

namespace Mineland405\FinancialSystemResource\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class RelationshipNetwork extends Model
{
    use HasFactory;

    protected $connection = 'mysql_main';

    protected $table = 'relationship_networks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'relate_user_id',
    ];

    public $timestamps = false;
}
