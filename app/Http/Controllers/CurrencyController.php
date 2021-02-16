<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index(){

        $currencies =\App\Currency::with('baseCurrency')->paginate(15);
        return view('welcome',['currencies'=>$currencies]);
    }
    public function checkCurrency(Request $request){
//        dd($request->all());
    $currency = Currency::where('name','=',$request->cfrom)->pluck('rate')->first();
    $currencyto = Currency::where('name','=',$request->to)->pluck('rate')->first();
    $toDoller = 12/$currency * $currencyto;

    return response()->json(['success'=>'1','data'=>number_format($toDoller, 2)]);
    }
}
