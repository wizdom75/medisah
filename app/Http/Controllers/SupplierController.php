<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role === 'Superadmin') {
            return view('suppliers.index', [
                'suppliers' => Supplier::orderBy('job_title', 'DESC')->paginate(10),
            ]); 
        }
        return view('suppliers.index', [
            'suppliers' => Supplier::where('merchant_id', auth()->user()->merchant_id)->orderBy('id', 'DESC')->paginate(10),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'address_line_1' => 'max:255',
            'address_line_2' => 'max:255',
            'city' => 'max:255',
            'postcode' => 'max:255',
            'contact_name' => 'max:255',
            'contact_email' => 'max:255',
            'contact_phone' => 'max:255',
        ]);
        $validated['merchant_id'] = auth()->user()->merchant_id ?? null;
        Supplier::create($validated);
        return back()->with('success', 'Supplier created');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'address_line_1' => 'max:255',
            'address_line_2' => 'max:255',
            'city' => 'max:255',
            'postcode' => 'max:255',
            'contact_name' => 'max:255',
            'contact_email' => 'max:255',
            'contact_phone' => 'max:255',
        ]);
        $supplier->update($validated);
        return back()->with('success', 'Supplier updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return back()->with('success', 'Supplier deleted');
    }
}
