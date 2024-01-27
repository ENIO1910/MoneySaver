/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
// @ts-ignore
window.Pusher = Pusher;

const echo: Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost: import.meta.env.VITE_PUSHER_HOST,
    // wsHost: 'localhost',
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: false,
    encrypted: true,
    enabledTransports: ['ws', 'wss'],
});

console.log('test')

echo.channel('channel-name')
    .listen('Test', (e: any): void => {
        console.log('test channel');
    });

echo.private('user.1')
    .listen('Test', (e: any): void => {
        console.log('test channel');
    });

echo.join('online-users')
    .here((users: any) => {
        console.log('użytkownicy aktualnie online', users)
    })
    .joining((user: any) => {
        console.log('użytkownik dołączył', user)
    })
    .leaving((user: any) => {
        console.log('użytkownik opuścił', user)
    })
    .listen('UserOnlineStatusChanged', (e: any): void => {
        console.log('TEST online-users listen event', e);
    });
