<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name',
        'price',
        'percentage_increase',
        'stock',
        'status',
        'visibility',
        'description',
        'thumbnail',
        'visualisation',
        'weight',
        'height',
        'length',
        'width',
        'url_key',
        'new_from',
        'new_to',
        'sku',
        'created_at',
        'updated_at',
        'user_id',
        'interaction_type_id',
        'sub_product_id',
        'manufacturer_id',
        'step_id',
        'configurable',
        'configurator_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function configurator()
    {
        return $this->belongsTo(Configurator::class, 'configurator_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function steps()
    {
        return $this->belongsToMany(Step::class, 'product_step', 'product_id', 'step_id')->orderBy('order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function step()
    {
        return $this->belongsTo(Step::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inputs()
    {
        return $this->hasMany(Input::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function interaction_type()
    {
        return $this->belongsTo(interactionType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function summaries()
    {
        return $this->belongsToMany(Summary::class, 'product_summary', 'product_id','summary_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function opties()
    {
        return $this->belongsToMany(Summary::class, 'summary_option', 'option_id', 'summary_id');
    }

}
