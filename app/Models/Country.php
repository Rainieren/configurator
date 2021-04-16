<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name',
        'code',
        'phone_code',
    ];

    public function manufacturers()
    {
        return $this->hasMany(Manufacturer::class);
    }
}
