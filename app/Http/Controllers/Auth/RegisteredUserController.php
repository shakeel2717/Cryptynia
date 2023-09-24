<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerify;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create($refer = 'default',): View
    {
        return view('auth.register', compact('refer'));
    }

    public function verifyEmail(Request $request)
    {
        $user = User::where('username', auth()->user()->username)->where('token', $request->otp)->first();
        if ($user == "") {
            return redirect()->back()->withErrors('Invalid OTP, Please Try again');
        }
        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('user.dashboard.index')->with('success', 'Your email has been verified');
    }

    public function resendverifyOtp(Request $request)
    {
        $token = str()->random(8);
        $user = User::find(auth()->user()->id);
        $user->token = $token;
        $user->save();

        Mail::to($user->email)->send(new EmailVerify($token));

        
        return redirect()->route('verification.notice')->with('success', 'Your OTP has been Sent Successfully');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:' . User::class],
            'username' => ['required', 'string', 'alpha_num', 'max:255', 'unique:' . User::class],
            'mobile' => ['required', 'numeric', 'unique:' . User::class],
            'code' => ['nullable', 'numeric'],
            'country' => ['required', 'string', 'max:255'],
            'refer' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $sponsor = null;


        if ($validated['refer'] != 'default') {
            // Checking if this refer is valid
            $sponsorQuery = User::where('username', $validated['refer'])->firstOrFail();
            info("Current Sponser is: " . $sponsorQuery->name);
            $sponsor = $sponsorQuery->username;
        }

        $token = str()->random(8);

        $user = new User();
        $user->name = $validated['name'];
        $user->username = strtolower($validated['username']);
        $user->email = strtolower($validated['email']);
        $user->password = Hash::make($request->password);
        $user->refer = $sponsor ?? "default";
        $user->token = $token;
        $user->mobile = $validated['code'] . $validated['mobile'];
        $user->country = $validated['country'];
        $user->save();
        info("User Created: " . $user->username);

        session(['password' => $validated['password']]);

        Mail::to($user->email)->send(new EmailVerify($token));

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
