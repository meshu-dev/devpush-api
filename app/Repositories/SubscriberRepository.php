<?php

namespace App\Repositories;

use App\Models\Subscriber;

class SubscriberRepository
{
    public function add(array $params): Subscriber
    {
        return Subscriber::create($params);
    }
}