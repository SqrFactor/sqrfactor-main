var avatar="http://3.bp.blogspot.com/-c8O1QI1Ty24/UikpRn-WYLI/AAAAAAAAJ0Y/hCd3SVMejGQ/s1600/1cc767a412f68bc6ff6f26b526c4ecfd.jpeg";
/* global $*/
var uto,uname;
window.onload = function() {
    finishNotification(document.querySelector('#from').value);
    userMysql(document.querySelector('#from').value);
}


function finishNotification(from){
    $.ajax({
        url: '/parse/delnotifi',
        type: "post",

        data: {
            data: 'notification',
            from: from,
        },
        crossDomain: true,
        dataType: 'json',
        success: function(a) {
            document.querySelector('#chat-alert').innerHTML = (0)
            $('#chat-alert').hide();
        },
        error:function(){
            alert("EEE")
        }
    });
}

$('body').on('click','.backAllUsers',function () {
    if($(document).width() < 550){
        $('.all_message_row .all-messages-list').removeClass('activee');
        $('.all_message_row .all-message-user-list').removeClass('inactivee');
    }
});

$('body').on('click', '.user', function() {
    console.log("sachin");

    $('.chat').html('');
    $('.user').removeClass("active");
    $(this).addClass("active");
    console.log($(document).width());
    if($(document).width() < 550){
        $('.all_message_row .all-messages-list').addClass('activee');
        $('.all_message_row .all-message-user-list').addClass('inactivee');
    }
    uto = $(this).attr('id');
    uname=$(this).attr('name');
    $('.chat-alert-notify-'+uto).hide();
    $('.chat-alert-notify-'+uto).html(0);
    var from=document.querySelector('#from').value;
    chatMysql(from,uto);
    return false
});

$('body').on('click', '.newuser', function() {
    console.log("sachinnnnnn");

    $('.chat').html('');
    $('.user').removeClass("active");
    $(this).addClass("active");
    console.log('2222222222');
    if($(document).width() < 550){
        $('.all_message_row .all-messages-list').addClass('activee');
        $('.all_message_row .all-message-user-list').addClass('inactivee');
    }
    uto = $(this).attr('id');
    uname=$(this).attr('name');
    $('.chat-alert-notify-'+uto).hide();
    $('.chat-alert-notify-'+uto).html(0);
    var from=document.querySelector('#from').value;
    
    console.log(from);
    console.log(uto);
    chatMysql(from,uto);
    console.log('finally');
    return false
});


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
 
            a = a['msg'];
            var b = '';
            $.each(a, function(i, a) {
                avatar=base_url+'profile-picture/'+a.from_name;
                if ((a.from == from) && (a.to == to)) {
                    b += '<li '+'">' +'<div class="media">'+ '<img class="d-flex author-thumb" src="' + avatar + '"  alt="author">'+'<div class="media-body">'+'<div class="notification-event">'+'<div class="clearfix">'+'<a href="#" class="h6 notification-friend">'+a.from_name+'</a>'+'<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">'+timing(new Date(a.created_at))+'</time></span>'+'</div>'+'<span class="chat-message-item">'+urltag(htmlEntities(a.body))+'</span> </div>  </div>  </div>' + '</li>'
                } else if((a.from == to) && (a.to == from)) {
                    b += '<li '+'">' +'<div class="media">'+ '<img class="d-flex author-thumb" src="' + avatar + '"  alt="author">'+'<div class="media-body">'+'<div class="notification-event">'+'<div class="clearfix">'+'<a href="#" class="h6 notification-friend">'+uname+'</a>'+'<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">'+timing(new Date(a.created_at))+'</time></span>'+'</div>'+'<span class="chat-message-item">'+urltag(htmlEntities(a.body))+'</span> </div>  </div>  </div>' + '</li>'
                }
            });

            $('.chat').prepend(b);
            var c = $('.chat');
            var d = c[0].scrollHeight;
            c.scrollTop(d);
            scrollToBottom($(".mCustomScrollbar.helo")); 
        }
    })
}



function userMysql(m) {
    $.ajax({
        url: '/parse/getallUsers',
        type: "post",
        data: {
            data: 'users',
            from: m
        },
        crossDomain: true,
        dataType: 'json',
        success: function(a) {
            var b = '';
            a=a['msg'];
            console.log(a);
            $.each(a, function(i, a) {
                if (a.id != m) {
                    avatar=base_url+'profile-picture/'+a.user_name;
                    b += '<li id="' + a.id + '" class="user"'+'name="'+a.user_name+'">';
                    b += '	<a href="#" class="clearfix">';
                    b += '<div class="author-thumb">';
                    b += '<img src="'+avatar+'" alt="author">';
                    b += '</div>';
                    b+='<div class="notification-event">';
                    b+='<a href="#" class="h6 notification-friend mb-1">'+a.user_name+'</a>';
                    if(a.body!=null)
                        b+='<span class="chat-message-item">'+a.body+'</span>';
                    else
                        b+='<span class="chat-message-item"></span>';
                    if(a.created_at!=null)
                        b+='<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">'+timing(new Date(a.created_at))+'</time></span>';
                    else
                        b+='<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18"></time></span>';
                    b += '<small class="chat-alert-notify-'+a.id+' label label-primary" style="position:absolute;  right: 8px;top: 27px;font-size: 10px; padding: 3px 5px; display: none;">0</small>';
                    b+='</div>';
                    b+='<span class="notification-icon">';
                    b+='<svg class="olymp-chat---messages-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#olymp-chat---messages-icon"></use></svg>';
                    b+='</span>';
                    b+='<div class="more">';
                    b+='<svg class="olymp-three-dots-icon">';
                    b+='<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#olymp-three-dots-icon"></use>';
                    b+='</svg>';
                    b+='</div>';
                    b+='</li>';
                }
            });
            $('.users-list').html(b);
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
            to: uto,
            from_name: document.querySelector('#from_name').value,
            to_name: uname,
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
                console.log(a['msg']);

    scrollToBottom($(".mCustomScrollbar.helo")); 
            }
        });
        document.querySelector('#message').value = '';
    } else {
        alert('Please fill atlease message!')
    }
}, false);
function scrollToBottom(element){ 
    console.log(element.height());
    element.scrollTop(element.prop("scrollHeight"));
}  
