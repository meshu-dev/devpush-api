<?php

namespace App\Repositories;

use App\Models\ContactMessage;

class ContacMessageRepository
{
    public function add(array $params): ContactMessage
    {
        return ContactMessage::create($params);
    }
}