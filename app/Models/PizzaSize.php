<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class PizzaSize extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
    ];

    public function toppings(): MorphMany
    {
        return $this->morphMany(Topping::class, 'model');
    }

    protected function label(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->name.' (RM '.number_format($this->price, 2).')',
        );
    }
}
