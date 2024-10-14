<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    //
    public function currenview()
    {
        return view('admin.settings.Currency.index');
    }
}
