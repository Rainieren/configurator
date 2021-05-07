<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class interactionType extends Model
{
    use HasFactory;

    /**
     * @return mixed
     */
    public function steps() {
        return $this->belongsTo(Step::class);
    }


    /**
     * @return mixed
     */
    public function products() {
        return $this->hasMany(Product::class);
    }
}
