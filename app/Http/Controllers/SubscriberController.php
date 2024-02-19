<?php

namespace App\Http\Controllers;

use App\Actions\AddSubscriberAction;
use App\Http\Requests\AddSubscriberRequest;

class SubscriberController extends Controller
{   
    public function addSubscriber(AddSubscriberRequest $request, AddSubscriberAction $addSubscriberAction)
    {
        return $addSubscriberAction->execute($request->all());
    }
}
