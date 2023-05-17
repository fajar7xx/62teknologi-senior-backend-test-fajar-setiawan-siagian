<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use HasFactory,
        SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'businesses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'alias',
        'name',
        'image_url',
        'is_closed',
        'url',
        'review_count',
        'rating',
        'lattitude',
        'longtitude',
        'price',
        'phone',
        'display_phone',
        'distance',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_closed'    => 'boolean',
        'review_count' => 'integer',
        'rating'       => 'double',
        'lattitude'    => 'double',
        'longtitude'   => 'double',
        'price'        => 'string',
        'distance'     => 'double',
    ];

    /**
     * Get the location associated with business
     *
     * @return HasOne
     */
    public function location(): HasOne
    {
        return $this->hasOne(Location::class, 'business_id');
    }

    /**
     * Category that belong to the business
     *
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'business_category', 'business_id', 'category_id');
    }

    /**
     * Transaction that belong to business
     *
     * @return BelongsToMany
     */
    public function transactions(): BelongsToMany
    {
        return $this->belongsToMany(Transaction::class, 'business_transaction', 'business_id', 'transaction_id');
    }

}
