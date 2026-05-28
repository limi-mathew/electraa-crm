<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Customer;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Customer $customer)
    {
        $messages = Message::where(function ($q) use ($customer) {
            $q->where('user_id', auth()->id())
                ->where('receiver_id', $customer->user_id);
        })
            ->orWhere(function ($q) use ($customer) {
                $q->where('user_id', $customer->user_id)
                    ->where('receiver_id', auth()->id());
            })
            ->orderBy('created_at')
            ->get();

        return view('chats.chat', [
            'messages' => $messages,
            'receiver_id' => $customer->user_id,
            'customer' => $customer,
        ]);

    }

    public function send(Request $request)
    {
        $msg = Message::create([
            'user_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($msg))->toOthers();

        return response()->json($msg);
    }
}
