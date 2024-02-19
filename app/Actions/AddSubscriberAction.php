<?php

namespace App\Actions;

use App\Repositories\SubscriberRepository;

class AddSubscriberAction
{
    public function __construct(
        protected SubscriberRepository $subscriberRepository
    ) { }

    public function execute(array $params)
    {
        return $this->subscriberRepository->add($params);
    }
}
