<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * the business that belong to the transaction
     *
     * @return BelongsToMany
     */
    public function Businesses(): BelongsToMany
    {
        return $this->belongsToMany(Business::class, 'business_transaction', 'transaction_id', 'business_id');
    }
}
