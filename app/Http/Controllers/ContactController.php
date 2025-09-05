<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(private ContactService $contactService)
    {
        
    }

    public function index() 
    {
        return inertia('Home/Contact');
    }

    public function storeContact(ContactRequest $request)
    {
        try {
            $this->contactService->storeContact($request->name, $request->email, $request->subject, $request->message);
            return back()->with('success', 'Message sent successfully');
        } catch (\Throwable $th) {
            $this->logError($th);
        }
        return back()->with('error', 'Something went wrong');
    }
}
