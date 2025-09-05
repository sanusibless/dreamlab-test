<?php 

namespace App\Services;

use App\Models\Contact;

class ContactService extends GeneralService {
    public function storeContact($name, $email, $subject, $message)
    {
        try {
            Contact::create([
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'message' => $message,
            ]);
            // Todo: Send Email
            return $this->serviceResponse(true, 'Message sent successfully');
        } catch (\Throwable $th) {
            $this->logError($th);
        }
        return $this->serviceResponse(false, 'Something went wrong');
    }
    public function getContacts() {
        return Contact::all();
    }
}