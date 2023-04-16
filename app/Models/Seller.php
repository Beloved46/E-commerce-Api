<?php

namespace App\Models;

use App\Models\Scopes\SelerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends User
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new SelerScope);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
