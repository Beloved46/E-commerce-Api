<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Buyer extends User
{
    use HasFactory;

    public function tansactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
