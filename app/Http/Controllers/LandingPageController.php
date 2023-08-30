<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use App\Models\Post;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::get();
        return view('landing.index', compact('posts'));
    }


    public function about()
    {
        $posts = Post::get();
        return view('landing.about', compact('posts'));
    }

    public function contact()
    {
        return view('landing.contact');
    }


    public function privacy()
    {
        return view('landing.privacy');
    }


    public function terms()
    {
        return view('landing.terms');
    }

    public function disclaimer()
    {
        return view('landing.disclaimer');
    }

    public function contactStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);

        $contact = new ContactForm();
        $contact->name = $validatedData['name'];
        $contact->email = $validatedData['email'];
        $contact->phone = $validatedData['phone'];
        $contact->message = $validatedData['message'];
        $contact->save();

        return back()->with('success', 'Your message Sent Successfully');
        return view('landing.contact');
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
        //
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
