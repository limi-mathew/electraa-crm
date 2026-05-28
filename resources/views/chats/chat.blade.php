<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
    @vite(['resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    .chat-container {
        display: flex;
        flex-direction: column;
        height: 75vh;
        background: white;
    }

    .chat-header {
        padding: 16px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: white;
        font-size: 18px;
        font-weight: 600;
        color: #111827;
    }

    .chat-box {
        flex: 1;
        overflow-y: auto;
        padding: 20px;
        background: #f9fafb;
    }

    .message {
        padding: 12px 16px;
        border-radius: 12px;
        margin-bottom: 12px;
        max-width: 80%;
        font-size: 14px;
        line-height: 1.5;
    }

    .me {
        background: #2563eb;
        color: white;
        margin-left: auto;
    }

    .other {
        background: white;
        color: #2563eb;
        border: 1px solid #dbeafe;
    }

    .chat-input {
        display: flex;
        gap: 10px;
        padding: 16px;
        border-top: 1px solid #e5e7eb;
        background: white;
    }

    .chat-input input {
        flex: 1;
        padding: 12px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        outline: none;
        font-size: 14px;
        background: white;
        color: black !important;
    }

    .chat-input button {
        background: #2563eb;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 10px;
        cursor: pointer;
    }

    .chat-input button:hover {
        background: #1d4ed8;
    }

    .close-btn {
        cursor: pointer;
        font-size: 18px;
        color: #6b7280;
    }
</style>
</head>
<body>

<div class="chat-container">

    <!-- Header -->
    <div class="chat-header">
        <span>Chat with {{ $customer->name }}</span>
        <span class="close-btn" onclick="closeChat()">×</span>
    </div>

    <!-- Messages -->
    <div class="chat-box" id="chat-box">
        @foreach($messages as $msg)
            <div class="message {{ $msg->user_id == auth()->id() ? 'me' : 'other' }}">
                {{ $msg->message }}
            </div>
        @endforeach
    </div>

    <!-- Input -->
    <div class="chat-input">
        <input type="hidden" id="receiver_id" value="{{ $customer->user_id }}">
        <input type="text" id="message" placeholder="Type message...">
        <input type="hidden" id="send_url" value="{{ route('chat.sendmessage') }}">
        <button type = "button"  id="sendBtn" >Send</button>
    </div>

</div>



</body>
</html>

