<div
    x-data="{ open: false }"
    style="
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 99999;
    "
>

    <!-- Chat Button -->
    <button
        @click="open = !open"
        style="
            background: #007bff;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 999px;
            border: none;
            cursor: pointer;
            font-size: 22px;
        "
    >
        💬
    </button>

    <!-- Chat Popup -->
    <div
        x-show="open"
        style="
            display:none;
            background:white;
            width:320px;
            height:450px;
            border:1px solid #ccc;
            border-radius:10px;
            margin-top:10px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
            overflow:hidden;
            display:flex;
            flex-direction:column;
        "
    >

        <!-- Header -->
        <div
            style="
                background:#007bff;
                color:white;
                padding:12px;
                font-weight:bold;
            "
        >
            Support Chat
        </div>

        <!-- Messages -->
        <div
            style="
                flex:1;
                padding:10px;
                overflow-y:auto;
                background:#f5f5f5;
            "
        >

            @forelse($messages as $msg)

                <div
                    style="
                        margin-bottom:10px;
                        text-align:
                        {{ $msg->user_id == auth()->id() ? 'right' : 'left' }};
                    "
                >

                    <span
                        style="
                            display:inline-block;
                            max-width:75%;
                            padding:10px;
                            border-radius:10px;
                            background:
                            {{ $msg->user_id == auth()->id()
                                ? '#007bff'
                                : '#e4e6eb' }};
                            color:
                            {{ $msg->user_id == auth()->id()
                                ? 'white'
                                : 'black' }};
                            word-wrap:break-word;
                        "
                    >
                        {{ $msg->message }}
                    </span>

                </div>

            @empty

                <div style="text-align:center;color:#888;">
                    No messages yet
                </div>

            @endforelse

        </div>

        <!-- Input Area -->
        <div
            style="
                padding:10px;
                border-top:1px solid #ddd;
                display:flex;
                gap:5px;
                background:white;
            "
        >

            <input
                type="text"
                wire:model="message"
                wire:keydown.enter="sendMessage"
                placeholder="Type message..."
                style="
                     background:#f1f1f1;
        padding:8px 12px;
        border-radius:10px;
        max-width:70%;
        color:#000;
                "
            >

            <button
                wire:click="sendMessage"
                style="
                    background:#007bff;
                    color:white;
                    border:none;
                    padding:10px 15px;
                    border-radius:5px;
                    cursor:pointer;
                "
            >
                Send
            </button>

        </div>

    </div>

</div>