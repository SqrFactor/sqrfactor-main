

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('notification-component',require('./components/notification-component.vue'));

//Notification for web header

const notificationApp = new Vue({
    el: '#notificationApp',
    data:{
        allNotifications: [], 
        msg: 'hello',
        
    },
    created(){
        axios.post('/notifications/get').then(response => {
            this.allNotifications = response.data;
            console.log(this.allNotifications);
        });
    }, 

    methods: {
            Open : false,
        }
});

