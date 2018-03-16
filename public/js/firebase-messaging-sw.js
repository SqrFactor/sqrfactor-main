importScripts('https://www.gstatic.com/firebasejs/3.5.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/3.5.2/firebase-messaging.js');

firebase.initializeApp({
    'messagingSenderId': '300238627144'
});

const messaging = firebase.messaging();

self.addEventListener("install", function () {
    console.log("service worker installed");
});

self.addEventListener("notificationclick", function (event) {
    var eventURL = event.notification.data;
    event.notification.close();
    if (event.action === 'confirmAttendance') {
        clients.openWindow(eventURL.confirm);
    } else {
        //clients.openWindow(eventURL.decline);
    }
},false);

messaging.setBackgroundMessageHandler(function (payload) {
    const data = JSON.parse(payload.data.notification);
    const notificationTitle = data.title;
    const notificationOptions = {
        body: data.body,
        // icon: '/static/images/5/icons/android-icon-96x96.png',
        actions: [
            {action: 'confirmAttendance', title: 'View Message'},
            {action: 'cancel', title: 'Not Now'}
        ],
        // For additional data to be sent to event listeners, needs to be set in this data {}
        data: {confirm: data.confirm, decline: data.decline}
    };

    return self.registration.showNotification(notificationTitle, notificationOptions);
});