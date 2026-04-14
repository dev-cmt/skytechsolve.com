<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\Contact;
use App\Models\User;
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
