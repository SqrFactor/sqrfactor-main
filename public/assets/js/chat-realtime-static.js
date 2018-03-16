/* global chatMysql*/
/* global $*/
/* global messageRef*/
window.onload = function() {
    chatMysql(document.querySelector('#from').value, document.querySelector('#to').value);
}




var avatar="http://3.bp.blogspot.com/-c8O1QI1Ty24/UikpRn-WYLI/AAAAAAAAJ0Y/hCd3SVMejGQ/s1600/1cc767a412f68bc6ff6f26b526c4ecfd.jpeg";

function chatMysql(from, to) {
    $.ajax({
        url: '/parse/getmessages',
        type: "post",

        data: {
            data: 'message',
            from: from,
            to: to
        },
        crossDomain: true,
        dataType: 'json',
        success: function(a) {
            a=a['msg'];
            var b = '';
            $.each(a, function(i, a) {
                avatar=base_url+'profile-picture/'+a.from_name;
                if ((a.from == document.querySelector('#from').value) && (a.to == document.querySelector('#to').value)) {
                    b += '<li '+'">' +'<div class="media">'+ '<img class="d-flex author-thumb" src="' + avatar + '"  alt="author">'+'<div class="media-body">'+'<div class="notification-event">'+'<div class="clearfix">'+'<a href="#" class="h6 notification-friend">'+document.querySelector('#from_name').value+'</a>'+'<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">'+timing(new Date(a.created_at))+'</time></span>'+'</div>'+'<span class="chat-message-item">'+urltag(htmlEntities(a.body))+'</span> </div>  </div>  </div>' + '</li>'
                } else if((a.from == document.querySelector('#to').value) && (a.to == document.querySelector('#from').value)){
                    b += '<li '+'">' +'<div class="media">'+ '<img class="d-flex author-thumb" src="' + avatar + '"  alt="author">'+'<div class="media-body">'+'<div class="notification-event">'+'<div class="clearfix">'+'<a href="#" class="h6 notification-friend">'+document.querySelector('#to_name').value+'</a>'+'<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">'+timing(new Date(a.created_at))+'</time></span>'+'</div>'+'<span class="chat-message-item">'+urltag(htmlEntities(a.body))+'</span> </div>  </div>  </div>' + '</li>'
                }
            });
            $('.chat').prepend(b);
            var c = $('.chat');
            var d = c[0].scrollHeight;
            c.scrollTop(d);
                scrollToBottom($(".mCustomScrollbar.scroll-bottom")); 
        }
    })
}




function htmlEntities(a) {
    return String(a).replace(/</g, '&lt;').replace(/>/g, '&gt;')
}

function timing(a) {
    var s = Math.floor((new Date() - a) / 1000),
        i = Math.floor(s / 31536000);
    if (i > 1) {
        return i + " yrs ago"
    }
    i = Math.floor(s / 2592000);
    if (i > 1) {
        return i + " mon ago"
    }
    i = Math.floor(s / 86400);
    if (i > 1) {
        return i + " dys ago"
    }
    i = Math.floor(s / 3600);
    if (i > 1) {
        return i + " hrs ago"
    }
    i = Math.floor(s / 60);
    if (i > 1) {
        return i + " min ago"
    }
    return (Math.floor(s) > 0 ? Math.floor(s) + " sec ago" : "just now")
}

function urltag(d, e) {
    var f = {
        link: {
            regex: /((^|)(https|http|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig,
            template: "<a href='$1' target='_BLANK'>$1</a>"
        },
        email: {
            regex: /([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9._-]+)/gi,
            template: '<a href=\"mailto:$1\">$1</a>'
        }
    };
    var g = $.extend(f, e);
    $.each(g, function(a, b) {
        d = d.replace(b.regex, b.template)
    });
    return d
}




document.querySelector('#send').addEventListener("click", function(h) {
    var a = new Date(),
        b = a.getDate(),
        c = (a.getMonth() + 1),
        d = a.getFullYear(),
        e = a.getHours(),
        f = a.getMinutes(),
        g = a.getSeconds(),
        date = d + '-' + (c < 10 ? '0' + c : c) + '-' + (b < 10 ? '0' + b : b) + ' ' + (e < 10 ? '0' + e : e) + ':' + (f < 10 ? '0' + f : f) + ':' + (g < 10 ? '0' + g : g);
    h.preventDefault();
    if (document.querySelector('#message').value != '') {
        var i = {
            "_token": "{{ csrf_token() }}",
            data: 'send',
            from: document.querySelector('#from').value,
            to: document.querySelector('#to').value,
            from_name: document.querySelector('#from_name').value,
            to_name: document.querySelector('#to_name').value,
            message: document.querySelector('#message').value,
            date: date
        };

        // push firebase
        messageRef.push(i);
        // insert mysql
        $.ajax({
            url: "/parse/submit-MSG",
            type: "POST",
            data: i,
            crossDomain: true,
            success: function(a){

                scrollToBottom($(".mCustomScrollbar.scroll-bottom")); 
                console.log(a['msg']);
            }
        });
        document.querySelector('#message').value = '';
    } else {
        alert('Please fill atlease message!')
    }
}, false);

function scrollToBottom(element){ 
    element.scrollTop(element.prop("scrollHeight"));
}  
