<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Auth;
use Exception;

class ProfileController extends Controller
{

    function __construct()
    {
        // if (!Auth::user()->isAdmin()) {
        //     return redirect('home');
        // };
        $this->middleware('is_data_complete');

    }
    /**
     * Show the profile
     *
     * @return \Illuminate\View\View
     */
    public function show($id = '')
    {
        throw new Exception("Error Processing Request", 404);
        

        $profile = $id ? Auth::user() : \App\User::find($id);

        return view('profile.index', compact('profile'));
    }

    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit', array(
            'departments' => \App\Department::all(),
            'statuses' => \App\Status::all(),
        ));
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
