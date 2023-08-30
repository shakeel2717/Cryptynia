<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

        $user = new User();
        $user->name = $validated['name'];
        $user->username = strtolower($validated['username']);
        $user->email = strtolower($validated['email']);
        $user->password = Hash::make($request->password);
        $user->refer = $sponsor ?? "default";
        $user->mobile = $validated['code'] . $validated['mobile'];
        $user->country = $validated['country'];
        $user->save();
        info("User Created: " . $user->username);

        session(['password' => $validated['password']]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
