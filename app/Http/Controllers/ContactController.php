<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($request->all());
        return back()->with('success', 'تم إرسال رسالتك بنجاح!');
    }
    public function index()
{
    $contacts = \App\Models\Contact::latest()->get();

    return view('admin.contacts.index', compact('contacts'));
}

}
