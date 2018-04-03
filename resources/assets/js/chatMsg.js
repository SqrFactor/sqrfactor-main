
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');
import Vue from 'vue'
// import VueChatScroll from 'vue-chat-scroll'
// Vue.use(VueChatScroll)

// import Toaster from 'v-toaster'
// import 'v-toaster/dist/v-toaster.css'
// Vue.use(Toaster, {timeout: 5000})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example-component', require('./components/ExampleComponent.vue'));
//Vue.component('message-component', require('./components/MessageComponent.vue'));

const chatApp = new Vue({
    el: '#chatApp',
    data: {
        msg:'Helloooo', 
        
        chat: {
            
        }, 
        typing:'',
        numberOfUsers: 0, 
        privateMsgs:[],
        singleMsgs:[],
        chatMsg:'',
        conID:'',
    },

     watch:{
        message(){
            Echo.private('chat')
                .whisper('typing', {
                    name: this.message
                });
        }
    },

    ready: function(){
        this.created();
    },

    created() {
    axios.get('http://localhost:8000/getMessages')
    .then(response => {
      console.log(response.data);
      console.log("private msg");// JSON responses are automatically parsed.
      this.privateMsgs = response.data;
      
      console.log(response.data[0].conversation_id)
      this.posts = response.data
    })
    .catch(e => {
     // this.errors.push(e)
    })
    },

    methods:{
        messages: function(id){
          console.log(id);
        axios.get('http://localhost:8000/getMessages/' + id)
    .then(response => {
      console.log(response.data);// JSON responses are automatically parsed.
      this.singleMsgs = response.data;
      this.conID = response.data[0].conversation_id;
      //this.posts = response.data
    })
    .catch(e => {
     // this.errors.push(e)
    })
    }, 

        inputHandler(e) {
          if (e.keyCode === 13 && !e.shiftKey) {
            e.preventDefault();
            this.sendMsg();
          }
        },   
       
        sendMsg(){
            let chat = this
            if(this.chatMsg){
                axios.post('http://localhost:8000/sendMessage', {
                    conID: this.conID,
                    chatMsg: this.chatMsg
                })
                .then(function(response){
                    console.log(response.data);

                    if(response.status === 200){
                        chat.singleMsgs = response.data;
                    }

                    chat.chatMsg=''

                 //    if(this.chatMsg.length != 0)
                 // this.chatMsg.push(this.singleMsgs);
            
                })


                //alert(this.conID);
                //alert(this.chatMsg);
            }
        }, 

        sendMgggggggg(){
          let chat = this
            if(this.chatMsg){
                axios.post('http://localhost:8000/sendMessage', {
                    conID: this.conID,
                    chatMsg: this.chatMsg
                })
            if(this.message.length != 0)
            this.chat.message.push(this.message);
            this.chat.user.push('you');
            this.chat.color.push('success');
            this.chat.time.push(this.getTime());
                    
            axios.post('/send', {
                message: this.message
              })
              .then(response=> {
                console.log(response);
                this.message =''
              })
              .catch(error=> {
                console.log(error);
              });
        }
  }
}
    
});
