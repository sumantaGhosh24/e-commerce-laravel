<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::paginate(10);

        return view('admin.contacts', ['contacts' => $contacts]);
    }

    public function create()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => ['required', 'string', 'min:3', 'max:150'],
        ]);

        Contact::create([
            'message' => $request->message,
            'user_id' => $request->user()->id
        ]);

        return redirect()->route('contact.create')->with('message', 'Your review send!');
    }
}