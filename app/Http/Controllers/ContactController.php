<?php

namespace App\Http\Controllers;

use App\Actions\SendMessageAction;
use App\Http\Requests\SendMessageRequest;

class ContactController extends Controller
{   
    public function sendMessage(SendMessageRequest $request, SendMessageAction $sendMessageAction)
    {
        return $sendMessageAction->execute($request->all());
    }
}
