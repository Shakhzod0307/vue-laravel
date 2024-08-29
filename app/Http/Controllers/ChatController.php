<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::whereNot('id',auth()->id())->get();
        return response()->json([
            'data'=>$users
        ]);
    }

    public function index2(User $user)
    {
        return Message::query()
            ->where(function ($query) use ($user) {
                $query->where('sender_id', auth()->id())
                    ->where('receiver_id', $user->id);
            })
            ->orWhere(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                    ->where('receiver_id', auth()->id());
            })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function show(User $user)
    {
        return view('chat', [
            'user' => $user
        ]);
    }

    public function sendMessage(Request $request, User $user)
    {
        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'text' => $request->input('message')
        ]);

        broadcast(new MessageSent($message));

        return response()->json($message);
    }

}
