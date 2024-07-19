<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Pizza extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function toppings(): MorphMany
    {
        return $this->morphMany(Topping::class, 'model');
    }

    /**
     * Get all of the sizes for the Pizza
     */
    public function sizes(): HasMany
    {
        return $this->hasMany(PizzaSize::class, 'pizza_id', 'id');
    }
}
