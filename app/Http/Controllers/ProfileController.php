<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile.index', [
            'user' => auth()->user(),
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->save();
        LogActivity(auth()->id(), 'User', __FUNCTION__, $user);


        return back()->with('success', 'Profile updated');
    }

    public function uploadAvatar(Request $request)
    {
        $userId = auth()->user()->id;

        if($request->hasFile('avatar')){
            // $ext = $request->file('avatar')->getClientOriginalExtension();
            // $filename_save = 'logo_'.$request->input('mid').'.'.$ext;
            $filename_save = "user-$userId.jpg";      
            $request->file('avatar')->storeAs('public/assets/images/users/', $filename_save);
            LogActivity(auth()->id(), 'User', __FUNCTION__, $filename_save);

            // $retailer->logo = 'public/images/retailers/'.$filename_save;
        }
    }
}
