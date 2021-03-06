<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;

    protected $fillable = ['name',
        'interaction_type', 'is_optional', 'order', 'allow_multiple', 'default_product'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options() {
        return $this->hasMany(Product::class);
    }

    /**
     * @return mixed
     */
    public function interactionType() {
        return $this->belongsTo(interactionType::class);
    }

    /**
     * @return mixed
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_step', 'step_id', 'product_id');
    }


//    /**
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
//     */
//    public function option() {
//        return $this->belongsTo(Product::class);
//    }
}
