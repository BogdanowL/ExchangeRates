<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyDay extends Model
{
    use HasFactory;

    public const DAY_COLUMN = 'day';

    protected $fillable = ['day'];

    public function rates()
    {
        return $this->hasMany(CurrencyRate::class, 'currency_day_id');
    }
}
