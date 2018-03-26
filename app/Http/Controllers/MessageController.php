<?php

namespace App\Http\Controllers;

use App\Message;
use App\Events\sendMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        return view('chat.index');
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
        if(($id - 25) <= 1){
            $id = 1;
        } else {
            $id = $id - 25;
        }

        $chatMessage = Message::with('user')
            ->where('id', '>=', $id)
            ->latest()
            ->get();

        return $chatMessage->reverse()->values();

    }
}
