<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function owner()
    {
        return $this->hasMany(User::class);
    }
}
