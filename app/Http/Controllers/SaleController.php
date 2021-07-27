<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role === 'Superadmin') {
            return view('sales.index', [
                'sales' => Sale::orderBy('id', 'DESC')->paginate(10),
            ]); 
        }
        return view('sales.index', [
            'sales' => Sale::where('merchant_id', auth()->user()->merchant_id)->orderBy('id', 'DESC')->paginate(10),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return back()->with('success', 'Sale deleted');
    }
}
