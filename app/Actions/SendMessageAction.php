<?php

namespace App\Actions;

use App\Repositories\{ContactRepository, ContacMessageRepository};

class SendMessageAction
{
    public function __construct(
        protected ContactRepository $contactRepository,
        protected ContacMessageRepository $contacMessageRepository
    ) { }

    public function execute(array $params): bool
    {
        $contact = $this->contactRepository->getByEmail($params['email']);

        if (!$contact) {
            $contact = $this->contactRepository->add($params);
        }

        $contactMessage = [
            'contact_id' => $contact->id,
            'message'    => $params['message']
        ];

        $contactMessage = $this->contacMessageRepository->add($contactMessage);

        return $contactMessage ? true : false;
    }
}
