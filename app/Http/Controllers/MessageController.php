<?php

namespace App\Http\Controllers;

use App\Events\MessageDelivered;
use App\Events\NewMessage;
use App\Messege;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $messages = Messege::all();
        return view('messages.index', compact('messages'));
    }


    public function store(Request $request)
    {
        $message = \auth()->user()->messages()->create($request->all());
        broadcast(new NewMessage($message))->toOthers();
    }
}
