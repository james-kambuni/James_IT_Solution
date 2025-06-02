<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Mail\ContactReceived;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    
    public function create()
    {
        return view('contact');
    }
  public function index()
{
       $contacts = Contact::latest()->paginate(10);
    return view('admin.contacts.index', compact('contacts'));
}

    public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'email'      => 'required|email',
        'phone'      => 'nullable|string|max:20',
        'message'    => 'required|string',
    ]);

    $contact = Contact::create($request->all());

    // Send notification to admin (or your email)
    Mail::to('vkambuni@gmail.com')->send(new ContactReceived($contact));

    return redirect()->back()->with('success', 'Your message has been received. Thank you!');
}

}
