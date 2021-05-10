<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;

    protected $fillable = ['name',
        'interaction_type',
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


//    /**
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
//     */
//    public function option() {
//        return $this->belongsTo(Product::class);
//    }
}
