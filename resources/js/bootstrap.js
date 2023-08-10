import "bootstrap";

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo";

// import Pusher from "pusher-js";
// Enable pusher logging - don't include this in production
// Pusher.logToConsole = true;

// var pusher = new Pusher("6c674ea590e0817e5b80", {
//     cluster: "ap1",
// });

// var channel = pusher.subscribe("orders");
// channel.bind("order_updated", function (data) {
//     alert(JSON.stringify(data));
// });
