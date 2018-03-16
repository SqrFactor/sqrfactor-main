var config = {
    apiKey: "AIzaSyDYToUux5EuYTnfSdfJrnM09_sjCbNc1I0",
    authDomain: "zakupschat.firebaseapp.com",
    databaseURL: "https://zakupschat.firebaseio.com",
    projectId: "zakupschat",
    storageBucket: "zakupschat.appspot.com",
    messagingSenderId: "145927747855"
};

firebase.initializeApp(config);
var messaging = firebase.messaging();
var database = firebase.database();

// On load register service worker
if ('serviceWorker' in navigator) {
    window.addEventListener("load", function () {
        navigator.serviceWorker.register("firebase-messaging-sw.js").then(function (registration) {
            console.log('ServiceWorker registration successful with scope: ', registration.scope);
            messaging.useServiceWorker(registration);
        }).then(function () {
            return messaging.requestPermission();
        }).then(function () {
            return messaging.getToken();
        }).then(function (token) {
            console.log(token);
            //save token to firebase
            var u = $("#u").val();
            database.ref("user/"+u).set({
                token: token
            });
        }).catch(function (err) {
            console.log('ServiceWorker registration failed: ', err);
            alert("OOPS! Some error: " + err);
        });
    });
}

$(document).ready(function () {
    var u = $("#u").val();
    var messageRef = database.ref("messages");
    var counter = 0;
    messageRef.on("child_added",function (val) {
        if (counter == 0){
            $("#inner_div").html("");
        }
        counter++;
        //console.log(val.val());
        $("#inner_div").append("<p><b>"+val.val().from+"</b> - "+val.val().message+"</p>");
    });

    $("#button").click(function () {
        var textarea = $("#textarea").val();
        if(textarea.length > 0){
            messageRef.push().set({
                from: u,
                message: textarea
            });
            $("#textarea").val("");

            //get token bc
            var otherU;
            if (u == "user1"){
                otherU = "user2";
            }else{
                otherU = "user1";
            }
            database.ref("user/"+otherU).once("value",function (data) {
                var token = data.val().token;

                var settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": "https://fcm.googleapis.com/fcm/send",
                    "method": "POST",
                    "headers": {
                        "content-type": "application/json",
                        "authorization": "key=AIzaSyAUkQVkXTtXCDblWBJ2sKqR3HQcSJG8FtU"
                    },
                    "processData": false,
                    "data": "{\"to\":\""+token+"\",\"data\":{\"notification\":{\"body\":\""+textarea+"\",\"title\":\"New Message\",\"confirm\":\"https://developers.google.com/web/\",\"decline\":\"https://www.yahoo.com/\"}},\"priority\":10}"
                };

                $.ajax(settings).done(function (response) {
                    console.log(response);
                    alert("Notification send");
                });
            });
        }
    });
});