import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

window.Echo.channel('chat').listen('.MessageSent', (e) => {
    console.log('MessageSent event received:', e);
    addMessage(e.message);
});

function addMessage(msg) {
    let box = document.getElementById('chat-box');
    console.log(msg);
    box.innerHTML += `
        <div>
            <b>${msg.user_id}</b>: ${msg.message}
        </div>
    `;

    box.scrollTop = box.scrollHeight;
}

// import axios from 'axios';
// import Echo from 'laravel-echo';
// import Pusher from 'pusher-js';

// window.axios = axios;

// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// /**
//  * Echo exposes an expressive API for subscribing to channels and listening
//  * for events that are broadcast by Laravel. Echo and event broadcasting
//  * allow your team to quickly build robust real-time web applications.
//  */

// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'reverb',
//     key: 'local',
//     wsHost: 'localhost',
//     wsPort: 8080,
//     forceTLS: false,
//     enabledTransports: ['ws'],
// });

// console.log('Echo Loaded:', window.Echo);

// window.Echo.channel('chat')
//     .listen('.MessageSent', (e) => {
//         console.log('Message received:', e);
//     });
