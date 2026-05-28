<?php

namespace Tests\Feature;

use App\Events\MessageSent;
use App\Models\Customer;
use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ChatControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_chat_index_loads_messages(): void
    {
        $user = User::factory()->create();

        $receiver = User::factory()->create();

        $customer = Customer::factory()->create([
            'user_id' => $receiver->id,
        ]);

        Message::factory()->create([
            'user_id' => $user->id,
            'receiver_id' => $receiver->id,
            'message' => 'Hello',
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('chat.index', $customer));

        $response->assertStatus(200);

        $response->assertViewIs('chats.chat');

        $response->assertViewHas('messages');

        $response->assertViewHas('customer');
    }

    public function test_send_message_successfully(): void
    {
        Event::fake();

        $user = User::factory()->create();

        $receiver = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->postJson(route('chat.sendmessage'), [
                'receiver_id' => $receiver->id,
                'message' => 'Test message',
            ]);

        $response->assertStatus(200);

        $response->assertJson([
            'message' => 'Test message',
        ]);

        $this->assertDatabaseHas('messages', [
            'user_id' => $user->id,
            'receiver_id' => $receiver->id,
            'message' => 'Test message',
        ]);

        Event::assertDispatched(MessageSent::class);
    }
}