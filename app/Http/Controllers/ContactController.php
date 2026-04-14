<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\Contact;
use App\Models\Sale;

class ContactController extends Controller
{

    public function indexContact()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('backend.pages.contact.index', compact('contacts'));
    }

    public function showContact($id)
    {
        $contact = Contact::findOrFail($id);
        // Mark as read
        if (!$contact->is_seen) {
            $contact->update(['is_seen' => true]);
        }

        return view('backend.pages.contact.contact-show', compact('contact'));
    }

    public function destroyContact($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contact.index')->with('success', 'Contact deleted successfully.');
    }

    public function createSaleFromContact($id)
    {
        $contact = Contact::findOrFail($id);

        if (($contact->type ?? '') !== 'sale') {
            return redirect()->back()->with('error', 'Sale can only be created from sale contacts.');
        }

        if (Sale::where('contact_id', $contact->id)->exists()) {
            return redirect()->back()->with('warning', 'A sale record already exists for this contact.');
        }

        Sale::create([
            'contact_id' => $contact->id,
            'name' => $contact->name,
            'email' => $contact->email,
            'phone' => $contact->phone,
            'subject' => $contact->subject,
            'message' => $contact->message,
            'status' => 'new',
        ]);

        return redirect()->back()->with('success', 'Sale record created successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Frontend Contact Form Submissions
    |--------------------------------------------------------------------------
    */

    public function indexSubmissions()
    {
        $submissions = Submission::latest()->paginate(10);
        return view('backend.pages.contact.subscribers', compact('submissions'));
    }


}
