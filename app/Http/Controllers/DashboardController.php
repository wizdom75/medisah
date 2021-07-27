<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $sales = Sale::where('merchant_id', auth()->user()->merchant_id)->count();
       $revenue = Sale::where('merchant_id', auth()->user()->merchant_id)->sum('value');
       $average = ($revenue > 0 && $sales > 0) ? $revenue/$sales : 0;
       
       $sold = Sale::where('merchant_id', auth()->user()->merchant_id)->get();

       $total = 0;

       foreach ($sold as $sell) {
           $total += count(unserialize($sell->items));
       }
       
        return view('dashboard.index', [
            'sales' => $sales,
            'revenue' => $revenue,
            'average' =>$average,
            'total' => $total
        ]);
    }

    
}
