<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'alias',
        'title'
    ];

    /**
     * the business that belong to the category
     *
     * @return BelongsToMany
     */
    public function Business(): BelongsToMany
    {
        return $this->belongsToMany(Business::class, 'business_category', 'category_id', 'business_id');
    }
}
