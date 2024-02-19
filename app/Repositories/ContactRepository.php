<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository
{
    public function add(array $params): Contact
    {
        return Contact::create($params);
    }

    public function getByEmail(string $email): Contact|null
    {
        return Contact::where('email', $email)->first();
    }
}