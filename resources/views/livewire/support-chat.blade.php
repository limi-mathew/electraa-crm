<div
    x-data="{ open: false }"
    style="position: fixed; bottom: 20px; right: 20px; z-index: 99999"
>
    <!-- CHAT POPUP -->
    <div
        x-show="open"
        x-transition
        style="
            position: absolute;
            bottom: 75px;
            right: 0;

            width: 340px;
            height: 500px;

            background: white;
            border: 1px solid #ddd;
            border-radius: 12px;

            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);

            display: flex;
            flex-direction: column;

            overflow: hidden;
        "
    >
        <!-- HEADER -->
        <div
            style="
                background: #007bff;
                color: white;
                padding: 14px;
                font-weight: bold;

                display: flex;
                align-items: center;
                justify-content: space-between;

                flex-shrink: 0;
            "
        >
            <span>Support Chat</span>

            <button
                @click="open = false"
                style="
                    background: none;
                    border: none;
                    color: white;
                    font-size: 18px;
                    cursor: pointer;
                "
            >
                ✕
            </button>
        </div>
        <!-- MESSAGES -->
        <div
            style="
                flex: 1;

                overflow-y: auto;

                padding: 15px;

                background: #f5f7fb;

                display: flex;
                flex-direction: column;

                justify-content: flex-end;
            "
        >
            <div>
                @forelse ($messages as $msg)
                    <div
                        style="
                    margin-bottom: 12px;

                    display:flex;

                    justify-content:
                    {{ $msg->user_id == auth()->id()
                        ? 'flex-end'
                        : 'flex-start' }};
                "
                    >
                        <div
                            style="
                        max-width: 75%;

                        padding: 10px 14px;

                        border-radius: 14px;

                        word-break: break-word;

                        background:
                        {{ $msg->user_id == auth()->id()
                            ? '#007bff'
                            : '#e4e6eb' }};

                        color:
                        {{ $msg->user_id == auth()->id()
                            ? 'white'
                            : '#000' }};
                    "
                        >
                            {{ $msg->message }}
                        </div>
                    </div>

                @empty
                    <div
                        style="
                            height: 100%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: #888;
                        "
                    >
                        No messages yet
                    </div>

                @endforelse
            </div>
        </div>

        <!-- INPUT AREA -->
        <div
            style="
                padding: 10px;

                border-top: 1px solid #ddd;

                background: white;

                display: flex;
                align-items: center;
                gap: 8px;

                flex-shrink: 0;
                margin-top: auto;
            "
        >
            <input
                type="text"
                wire:model="message"
                wire:keydown.enter="sendMessage"
                placeholder="Type your message..."
                style="
                    flex: 1;

                    border: 1px solid #ccc;

                    padding: 10px 14px;

                    border-radius: 999px;

                    outline: none;

                    font-size: 14px;

                    background: #f8f8f8;
                    color: #000;
                "
            />

            <button
                wire:click="sendMessage"
                style="
                    background: #007bff;
                    color: white;

                    border: none;

                    padding: 10px 18px;

                    border-radius: 999px;

                    cursor: pointer;

                    font-weight: 600;
                "
            >
                Send
            </button>
        </div>
    </div>
    <!-- FLOATING BUTTON -->
    <button
        @click="open = !open"
        style="
            width: 60px;
            height: 60px;

            border-radius: 999px;

            border: none;

            background: #007bff;
            color: white;

            font-size: 24px;

            cursor: pointer;

            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        "
    >
        💬
    </button>
</div>
