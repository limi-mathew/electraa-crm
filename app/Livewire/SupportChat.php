<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SupportChat extends Component
{
    public $message = '';

    public $messages = [];

    public function mount()
    {
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $userId = auth()->id();

        $admin = User::role('Admin')->first();

        if (! $admin) {
            return;
        }

        $adminId = $admin->id;

        $this->messages = Message::where(function ($q) use ($userId, $adminId) {

            // customer -> admin
            $q->where('user_id', $userId)
                ->where('receiver_id', $adminId);

        })
            ->orWhere(function ($q) use ($userId, $adminId) {

                // admin -> customer
                $q->where('user_id', $adminId)
                    ->where('receiver_id', $userId);

            })
            ->orderBy('created_at')
            ->get();
    }

    public function sendMessage()
    {
        $admin = User::role('Admin')->first();

        if (! $admin) {
            return;
        }

        Message::create([
            'user_id' => Auth::id(),
            'receiver_id' => $admin->id, // admin
            'message' => $this->message,
        ]);

        $this->message = '';

        $this->loadMessages();
    }

    public function render()
    {

        return view('livewire.support-chat');
    }
}
