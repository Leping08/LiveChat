<?php

namespace App\Http\Controllers\Api;

use App\Message;
use App\Events\sendMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index()
    {
        $chatMessage =  Message::with('user')
            ->latest()
            ->take(25)
            ->get();

        return $chatMessage->reverse()->values();
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
            'user_id' => 'required|integer'
        ]);

        $message = Message::create($request->all());

        $data = Message::with('user')->find($message->id);

        sendMessage::dispatch($data);

        return back();
    }

    public function history($id)
    {
        $messagesBack = 25;

        if(($id - $messagesBack) <= 1){
            $id = 1;
        } else {
            $id = $id - $messagesBack;
        }

        $chatMessage = Message::with('user')
            ->where('id', '>=', $id)
            ->latest()
            ->get();

        return $chatMessage->reverse()->values();
    }
}
