<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('merchants.index', [
            'merchants' => Merchant::orderBy('id', 'DESC')->paginate(10),
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
        $request->validate([
            'name' => 'required|max:255',
            'merchant_domain' => 'required|max:255',
            'country' => 'required|max:255',
            'email' => 'required|email',
            'address_line_1' => 'required|max:255',
        ]);
        $merchant = new Merchant;
        $merchant->name = $request->input('merchant_name');
        $merchant->domain = $request->input('merchant_domain');
        $merchant->address_line_1 = $request->input('address_line_1');
        $merchant->address_line_2 = $request->input('address_line_2');
        $merchant->city = $request->input('city');
        $merchant->state = $request->input('state');
        $merchant->postcode = $request->input('postcode');
        $merchant->country = $request->input('country');
        $merchant->save();
        LogActivity(auth()->id(), 'Merchant', __FUNCTION__, $request);

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->role = $request->input('role');
        $user->job_title = $request->input('job_title');
        $user->password = Hash::make('secret');
        $user->merchant_id = $merchant->id;
        $user->save();
        LogActivity(auth()->id(), 'User', __FUNCTION__, $request);

        
        return back()->with('success', 'Merchant created');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merchant $merchant)
    {

        $merchant->name = $request->input('merchant_name');
        $merchant->address_line_1 = $request->input('address_line_1');
        $merchant->address_line_2 = $request->input('address_line_2');
        $merchant->city = $request->input('city');
        $merchant->state = $request->input('state');
        $merchant->postcode = $request->input('postcode');
        $merchant->country = $request->input('country');
        $merchant->save();
        LogActivity(auth()->id(), 'Merchant', __FUNCTION__, $request);


        $user = User::where('merchant_id', $merchant->id)->first();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->role = $request->input('role');
        $user->job_title = $request->input('job_title');
        $user->merchant_id = $merchant->id;
        $user->save();
        LogActivity(auth()->id(), 'User', __FUNCTION__, $request);


        return back()->with('success', 'Merchant updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merchant $merchant)
    {
        $merchant->delete();
        LogActivity(auth()->id(), 'Merchant', __FUNCTION__, $merchant);

        return back()->with('success', 'Merchant deleted');
    }
}
