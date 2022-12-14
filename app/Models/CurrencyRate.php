<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{

    use HasFactory;

    public const RATE_UP = 1;

    public const RATE_DOWN = 0;

    public static array $currencies = [
                            'AUD',
                            'AZN',
                            'GBP',
                            'AMD',
                            'BYN',
                            'BGN',
                            'BRL',
                            'HUF',
                            'HKD',
                            'DKK',
                            'USD',
                            'EUR',
                            'INR',
                            'KZT',
                            'CAD',
                            'KGS',
                            'CNY',
                            'MDL',
                            'NOK',
                            'PLN',
                            'RON',
                            'XDR',
                            'SGD',
                            'TJS',
                            'TRY',
                            'TMT',
                            'UZS',
                            'UAH',
                            'CZK',
                            'SEK',
                            'CHF',
                            'ZAR',
                            'KRW',
                            'JPY',
                            ];

    protected $fillable = [
        'currency_day_id',
        'currency_id',
        'num_code',
        'char_code',
        'nominal',
        'name',
        'value',
    ];

    public function day()
    {
        return $this->belongsTo(CurrencyDay::class, 'currency_day_id');
    }
}

