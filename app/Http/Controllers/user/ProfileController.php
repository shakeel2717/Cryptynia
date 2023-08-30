<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.profile.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'required|string',
            'country' => 'required|string',
        ]);

        // checking if the user change the mobile number
        if (auth()->user()->mobile != $validatedData['mobile']) {
            // User have changed the mobile number
            // checking if the number is already in used
            $mobileVerify = User::where('mobile', $validatedData['mobile'])->count();
            if ($mobileVerify > 0) {
                return back()->withErrors(['This Mobile Number is already in used, Please try different Mobil Number']);
            }
        }

        // updaing Profile Record
        $profile = User::find(auth()->user()->id);
        $profile->fname = $validatedData['fname'];
        $profile->lname = $validatedData['lname'];
        $profile->email = $validatedData['email'];
        $profile->mobile = $validatedData['mobile'];
        $profile->country = $validatedData['country'];
        $profile->save();

        return redirect()->route('user.kyc.index')->with('success', 'User Profile Updated Successfully');
    }

    public function password(Request $request)
    {
        $validatedData = $request->validate([
            'cpassword' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);

        if (Hash::check($validatedData['cpassword'], auth()->user()->password)) {
            // updating the user password
            $user = User::find(auth()->user()->id);
            $user->password = bcrypt($validatedData['password']);
            $user->save();
            // redirecting to the profile page
            return back()->with('success', 'Password updated successfully');
        } else {
            // redirecting to the profile page
            return back()->withErrors('Current password is incorrect');
        }

        return back()->with('success', 'Password updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
