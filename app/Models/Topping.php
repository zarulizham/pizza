<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Topping extends Model
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

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    protected function label(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->name.' (+RM '.number_format($this->price, 2).')',
        );
    }
}
