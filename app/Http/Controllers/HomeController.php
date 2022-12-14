<?php

namespace App\Http\Controllers;

use App\Models\CurrencyRate;

class HomeController extends Controller
{

    public function index()
    {
        $currencies = CurrencyRate::$currencies;

        return view('home', compact('currencies'));
    }

}
