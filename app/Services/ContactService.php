<?php 

namespace App\Services;

use App\Models\Contact;

class ContactService {
    public function storeContact($name, $email, $message) {
    }
    public function getContacts() {
        return Contact::all();
    }
}