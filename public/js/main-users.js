/**
 * Created by HackerKernel on 28-07-2017.
 */
var base_url = $('body').attr('data-base') + "/";
var messageRef;
$(document).ready(function () {
    var env = "production";
    if (env === "development") {
        // Initialize Firebase
        var config = {
            apiKey: "AIzaSyCO65C1XwVxj6sv9RljdOx9isdDLqxsHHA",
            authDomain: "sqrfactor-2af5a.firebaseapp.com",
            databaseURL: "https://sqrfactor-2af5a.firebaseio.com",
            projectId: "sqrfactor-2af5a",
            storageBucket: "",
            messagingSenderId: "478497094644"
        };

        firebase.initializeApp(config);
        //Firebase init close
    } else {
        // Initialize production Firebase
        var config = {
            apiKey: "AIzaSyBc3_wSTuTuSRV-4WKAb9QioFmbVWHxSDk",
            authDomain: "sqrfactorindia.firebaseapp.com",
            databaseURL: "https://sqrfactorindia.firebaseio.com",
            projectId: "sqrfactorindia",
            storageBucket: "",
            messagingSenderId: "300238627144"
        };
        firebase.initializeApp(config);
        //Firebase init production close
    }

    fireDb = firebase.database();
    var messaging = firebase.messaging();
    var dbRef = firebase.database().ref();
    messageRef = dbRef.child('message');

    //sac


    var alertavail=document.getElementById('my-alert');
    if(alertavail){
       chnotifi(document.querySelector('#my-alert').value);
    }

    function chnotifi(fr) {
            $.ajax({
            url: '/parse/chnt',
            type: 'post',
            data: {
                
                data: 'notifications',
                from: fr
            },
            crossDomain: true,
            dataType: 'json',
            success: function(a) {
                a=a['allmsgs'];
                fullname = a['username'];
               
                if(a!='success'){
                document.querySelector('#chat-alert').innerHTML = (parseInt(a.length) );
                if(a.length>0)
                    $('#chat-alert').show();
                $.each(a, function(i, a) {

                        var avatar = base_url+'profile-picture/'+a.from_name;
                        b+='<li id="list-item-'+a.from+'">';
                        b+='<div class="media">';
                        b+='<img class="author-thumb" src="'+avatar+'" alt="author">';
                        b+='<div class="media-body">';
                        b+='<div class="notification-event">';
                        b+='<div><a href="'+base_url+'profile/detail/'+a.from_name+'" class="h6 notification-friend">'+fullname+'</a></div>';
                        b+='<p id="notify-body-'+a.from+'">'+a.body+'</p>';
                        b+='<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18" id="notify-time-'+a.from+'">'+timing(new Date(a.created_at))+'</time></span>';
                        b+='</div>';
                        b+='</div>';
                        b+='</div>';
                        b+='</li>';
                        }
                    );
                    $('.notification-list-only-header').prepend(b);
                }
                else{
                    document.querySelector('#chat-alert').innerHTML = (parseInt(0) );
                }
                var b='';
            },
            error:function(){
                alert("Error In loading notifications")
            }
        });
    }

    messageRef.on("child_added", function(a) {
        var from = a.val().from,
            to = a.val().to,
            from_name=a.val().from_name,
            to_name=a.val().to_name,
            message=a.val().message,
            date=a.val().date;

        // inbox user
        var ismsgpageopen=document.getElementById('from');
        var isallmsgpageopen=document.getElementById('all-msg-page');
        if(ismsgpageopen && !isallmsgpageopen){
                if (to == document.querySelector('#from').value) {
                        document.querySelector('.chat').innerHTML += (chatFirebase(a.val()))
                }
                // send message
                else if (from == document.querySelector('#from').value) {
                    document.querySelector('.chat').innerHTML += (chatFirebase(a.val()))
                }
                var c = $('.chat');
                var d = c[0].scrollHeight;
                c.scrollTop(d);
        }
        else if(isallmsgpageopen){
                if (to == document.querySelector('#from').value && from==uto) {
                    document.querySelector('.chat').innerHTML += (chatFirebase(a.val()));
                }
                else if(to == document.querySelector('#from').value){
                    $('.chat-alert-notify-'+from).show();
                    document.querySelector('.chat-alert-notify-'+from).innerHTML = (parseInt(document.querySelector('.chat-alert-notify-'+from).innerHTML) + 1)
                }
                else if (from == document.querySelector('#from').value && to==uto) {
                document.querySelector('.chat').innerHTML += (chatFirebase(a.val()))
                }
        }
        else{
            $.ajax({
                url: '/parse/getnotifi',
                type: "post",

                data: {
                      data: 'notification',
                      from: from,
                      to: to
                    },
                crossDomain: true,
                dataType: 'json',
                success: function(b) {
                    if (to == document.querySelector('#my-alert').value) {
                        $('#chat-alert').show();
                        var isalreadyplaced=document.getElementById('list-item-'+from);
                        if(isalreadyplaced){
                            document.querySelector('#notify-body-'+from).innerHTML=message;
                            document.querySelector('#notify-time-'+from).innerHTML=timing(new Date(date));
                        }
                        else{
                            document.querySelector('#chat-alert').innerHTML = (parseInt(document.querySelector('#chat-alert').innerHTML) + 1);
                            var b='';
                            var avatar=base_url+'profile-picture/'+from_name;
                            b+='<li id="list-item-'+from+'">';
                            b+='<div class="media">';
                            b+='<img class="author-thumb" src="'+avatar+'" alt="author">';
                            b+='<div class="media-body">';
                            b+='<div class="notification-event">';
                            b+='<div><a href="'+base_url+'profile/detail/'+from+'" class="h6 notification-friend">'+from+'</a></div>';
                            b+='<p id="notify-body-'+from+'">'+message+'</p>';
                            b+='<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18" id="notify-time-'+from+'">'+timing(new Date(date))+'</time></span>';
                            b+='</div>';
                            b+='<div class="more">';
                            b+='<svg class="olymp-little-delete">';
                            b+='<use xlink:href="../assets/icons/icons.svg#olymp-little-delete"></use>';
                            b+='</svg>';
                            b+='</div>';
                            b+='</div>';
                            b+='</div>';
                            b+='</li>';
                            $('.notification-list-only-header').prepend(b);
                        }
                    }
                },
                error:function(){
                    alert("EEEEError")
                }
            });
        }
        messageRef.child(a.key).remove()
    });

     function chatFirebase(a) {
        //console.log(a);
        var b = '';
        avatar=base_url+'profile-picture/'+a.from_name;
        if (a.from == document.querySelector('#from').value) {
            b = '<li '+'">' +'<div class="media">'+ '<img class="d-flex author-thumb" src="' + avatar + '"  alt="author">'+'<div class="media-body">'+'<div class="notification-event">'+'<div class="clearfix">'+'<a href="#" class="h6 notification-friend">'+a.from_name+'</a>'+'<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">'+timing(new Date(a.date))+'</time></span>'+'</div>'+'<span class="chat-message-item">'+urltag(htmlEntities(a.message))+'</span> </div>  </div>  </div>' + '</li>'
        } else {
            b = '<li '+'">' +'<div class="media">'+ '<img class="d-flex author-thumb" src="' + avatar + '"  alt="author">'+'<div class="media-body">'+'<div class="notification-event">'+'<div class="clearfix">'+'<a href="#" class="h6 notification-friend">'+a.from_name+'</a>'+'<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">'+timing(new Date(a.date))+'</time></span>'+'</div>'+'<span class="chat-message-item">'+urltag(htmlEntities(a.message))+'</span> </div>  </div>  </div>' + '</li>'
        }
        return b
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


    //hint
    $(".post-pagination").find('ul.pagination li').addClass('page-item');
    $(".post-pagination").find('ul.pagination li a').addClass('page-link');
    $(".post-pagination").find('ul.pagination li span').addClass('page-link');


    $(".hire_select").show();

    var open_model = $(".open_model").val();

    if (open_model == 'false') {
        $('#exampleModal').modal('show', {backdrop: 'static', keyboard: false})
    }


    $('#page_scroll_up').scrollTop(0);


    /*mobile verification model open*/

    if ($("#mobileVerification_model").val() == 'true') {
        $("#myModalkkk").modal('show');
        $(".data_message_alert").attr('data-message-alert', 'false');
    }


    //  hire register
    $("input[name='registerOption']").click(function () {
        var val = $(this).val();
        $(".registerOption_value").attr('value', val);


        if (val == 'hire') {
            $('.hire_select').show();
            $('.work_select').hide();
            $(".user_type_value").attr('value', 'hire_individual');


        }
        else if (val == 'work') {
            $(".user_type_value").attr('value', 'work_individual');
            $('.hire_select').hide();
            $('.work_select').show();


        }


    });

    //  hire register
    $("select[name='user_type']").change(function () {
        var val = $(this).val();
        $(".user_type_value").attr('value', val);

        if (val !== null && val !== "") {
            $(".errors_profile_update").hide();
        }
        else {
            $(".errors_profile_update").show();
        }
    });


    /*update email*/


    $("input[name=email]").keyup(function () {
        var val = $(this).val();

        if (val !== null && val !== "") {
            $(this).next('p.errors_profile_update').hide();
        }
        else {
            $(this).next('p.errors_profile_update').show();
        }

    });

    $(".profile_email_update").click(function () {

        var email = $("input[name='email']").val();

        $.ajax({
            type: "POST",
            url: "/parse/profile-email-update",
            data: {"email": email},
            beforeSend: function () {
                $("#spinner").show();
            },
            success: function (data) {
                $("#spinner").hide();
                if (data.errors) {
                    if (data.errors.email !== null && data.errors.email !== "" && data.errors.email !== undefined) {
                        $("input[name='email']").next('p.errors_profile_update').show().html(data.errors.email);
                    }

                }
                else {
                    window.location.href = '/profile';
                }
            },
            error: function (xhr, statusText, errorThrown) {
                $("#spinner").hide();
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops!", "Something went wrong", "error");
                }
            }
        });

    });

    /*profile update*/

    $("input[name=user_name]").on('keyup', function () {
        var user_name = $(this).val();
        $.ajax({
            type: "POST",
            url: "/parse/full-name-auth",
            data: {"user_name": user_name},
            success: function (data) {
                if (data.errors) {
                    if (data.errors.user_name != null && data.errors.user_name != "" && data.errors.user_name != undefined) {
                        $("input[name='user_name']").next('p.error_bag').show().html(data.errors.user_name[0]);
                        $("input[name='user_name']").next('p.error_bag').show();
                    } else {
                        $("input[name='user_name']").next('p.error_bag').show();
                    }
                }
                else {
                    $("input[name='user_name']").next('p.error_bag').hide();
                    $("input[name='user_name']").next('p.error_bag').next('p.suggestion').hide();
                }

                if (data.suggestion != null && data.suggestion != "" && data.suggestion != undefined && user_name.length > 0) {
                    $("input[name='user_name']").next('p.error_bag').next('p.suggestion').show().html('Suggestion: ' + data.suggestion);
                }
                else {
                    $("input[name='user_name']").next('p.error_bag').next('p.suggestion').hide();
                }
            },
            error: function (xhr, statusText, errorThrown) {
                /*  alert(xhr.status);*/
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops!", "Something went wrong", "error");
                }
            }
        });

    });


    $("body").on('click', '.profile_update', function () {
        var user_name = $("#user_name_social").val();
        var email = $("#email_social").val();
        var mobile_number = $("#mobile_number_social").val();
        var user_type = $("#user_type_value").val();
        var registerOption = $("#registerOption_value").val();

        $.ajax({
            type: "POST",
            url: "/parse/profile-social-update",
            data: {
                "user_name": user_name,
                "email": email,
                "mobile_number": mobile_number,
                "user_type": user_type,
                "registerOption": registerOption
            },
            beforeSend: function () {
                /* NProgress.start();*/
                $("#spinner").show()
            },
            success: function (data) {
                $("#spinner").hide();
                if (data.errors) {
                    if (data.errors.user_name != null && data.errors.user_name != "" && data.errors.user_name != undefined) {
                        $("#user_name_social").next('p.error_bag').show().html(data.errors.user_name);

                    }
                    if (data.errors.email != null && data.errors.email != "" && data.errors.email != undefined) {
                        $("#email_social").next('p.error_bag').show().html(data.errors.email);

                    }

                    if (data.errors.mobile_number != null && data.errors.mobile_number != "" && data.errors.mobile_number != undefined) {
                        $("#mobile_number_social").next('p.error_bag').show().html(data.errors.mobile_number);

                    }
                }
                else {
                    //success
                    swal({
                        text: "Updated successfully!",
                        type: "success",
                        title: "Success",
                        confirmButtonText: "ok"
                    }).then(function () {
                        $("#exampleModal").modal('hide');
                        window.location.href = base_url + 'profile/edit?simple=true'; //Will take you to login.
                    });

                }
            },
            error: function (xhr, statusText, errorThrown) {
                $("#spinner").hide();
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops..", "Something went wrong.Try again later or contact support", "error");
                }
            }

        });

    });


    // on change country
    $('select[name="country"]').change(function () {

        var country = $(this).val();

        if (country != "0") {
            $.ajax({
                type: "POST",
                url: "/parse/country",
                data: {"country": country},
                success: function (data) {
                    $('.selectpicker.city').selectpicker('deselectAll');
                    $('.selectpicker.city').selectpicker('val', '0');

                    $('.selectpicker.state').html(data);


                    $('.selectpicker.state').selectpicker('refresh');
                    $('.errors_country').hide();
                },
                error: function (xhr, statusText, errorThrown) {
                    /*  alert(xhr.status);*/
                    if (xhr.status == '401') {
                        window.location.href = base_url + 'login'; //Will take you to login.
                    } else {
                        swal("Oops!", "Something went wrong", "error");
                    }
                }
            });
        }

    });

    // on change country
    $("select[name='state']").change(function () {


        var state = $(this).val();

        if (state != "0") {
            $.ajax({
                type: "POST",
                url: "/parse/state",
                data: {"state": state},

                success: function (data) {

                    $('.selectpicker.city').html(data);
                    $('.selectpicker.city').selectpicker('refresh');
                    $('.errors_state').hide();

                },
                error: function (xhr, statusText, errorThrown) {
                    /*  alert(xhr.status);*/
                    if (xhr.status == '401') {
                        window.location.href = base_url + 'login'; //Will take you to login.
                    } else {
                        swal("Oops!", "Something went wrong", "error");
                    }
                }
            });
        }

    });

    $("select[name='city']").change(function () {
        $('.errors_city').hide();
    });


    $(".types_of_firm_company").change(function () {
        var val = $(this).val();
        $(".types_of_firm_company_value").attr('value', val);
        $(".firm_or_company").show();
    });


    /*post save*/

    $('#post_description').keyup(function () {
        var val = $(this).val();
        if (val !== null) {
            $(this).removeAttr('style');
        }
        else {
            $(this).attr('style', 'border-bottom: 1px solid red;');
        }
    });


    $(".post_ad_save_data").click(function () {
        var formElement = document.querySelector("#post_ad_form");
        var formData = new FormData(formElement);

        $.ajax({
            type: "POST",
            url: base_url + "parse/post",
            data: formData,
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,
            beforeSend: function () {
                NProgress.start();
            },
            success: function (data) {
                NProgress.done();
                NProgress.remove();
                if (data.errors) {
                    if (data.errors.description !== null && data.errors.description !== "" && data.errors.description !== undefined) {
                        $('.errors_post_description').html(data.errors.description).show();
                    }
                }
                else {
                    $('#post_description').val("");
                    $('.errors_post_description').hide();

                    $("input[name='image_value']").val("");
                    $("#target_image_cropper").removeAttr('src');
                    $("#upload").val("");


                    if ($('#newsfeed-items-grid .ui-block:nth-child(1)').html() == undefined) {
                        $('#newsfeed-items-grid').html(data);
                    } else {
                        $('#newsfeed-items-grid .ui-block:nth-child(1)').before(data);
                    }

                    $(".remove_image").hide();
                    removeImageFromCroper("demo");
                }
            },
            error: function (xhr, statusText, errorThrown) {
                NProgress.done();
                NProgress.remove();
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops!", "Something went wrong", "error");
                }
            }

        });
    });


    $('.add-more').on('click', function (e) {

        e.preventDefault();
        var add_filed_image = '<div class="row form-group append_div">\n' +
            '                            <label class="col-lg-3 col-form-label h6">Image</label>\n' +
            '                            <div class="col-lg-7">\n' +
            '                                <div class="form-group mb-0">\n' +
            '                                    <input type="file"  class="form-control" {{--placeholder="Attachment"--}} {{--style="background-color: transparent;"--}} name="image[]" id="image[]">\n' +
            '                                    <span class="input-group-addon"><i class="fa fa-paperclip" style="font-size: 18px;"></i></span>\n' +
            '                                </div>\n' +
            '                            </div>\n' +
            '                            <div class="col-lg-2">\n' +
            '                                <a href="javascript:void(0)" class="link-inverse form-text mt-3 remove_field_image" ><u>Remove -</u></a>\n' +
            '                            </div>\n' +
            '                        </div>';
        $("#add_filed_image").after(add_filed_image);

        $(".remove_field_image").on('click', function () {
            $(this).parents('.append_div').remove();

        });
    });


    $(".click-prize-and-wards").on('click', function (e) {


        e.preventDefault();

        var add_field = '<div class="row form-group remove-prize-and-awards ">\n' +
            '                            <label class="col-lg-3 col-form-label h6">Prize & Awards</label>\n' +
            '                            <div class="col-lg-7">\n' +
            '                                <div class="form-group label-floating mb-0">\n' +
            '                                    <label class="control-label">Prize description</label>\n' +
            '                                    <textarea class="form-control" name="prize_and_awards[]" id="prize_and_awards[]"></textarea>\n' +
            '                                </div>\n' +
            '                            </div>\n' +
            '                            <div class="col-lg-2">\n' +
            '                                <a href="javascript:void(0)" class="link-inverse form-text mt-3 remove_prize_and_wards" ><u>Remove -</u></a>\n' +
            '                            </div>\n' +
            '                        </div>';

        $("#add_prize_and_wards").after(add_field);

        $(".remove_prize_and_wards").on('click', function () {
            /* console.log($(this).parents('.remove-prize-and-awards').remove());*/


        });


    });

    /*add-more-Jury*/

    $(".add-more-jury").on('click', function () {


        var add_more = '<div class="row form-group remove-div-more-jury">\n' +
            '                            <label class="col-lg-3 col-form-label h6">Jury</label>\n' +
            '                            <div class="col-lg-7">\n' +
            '                                <div class="form-group label-floating mb-0">\n' +
            '                                    <label class="control-label">Jury Name</label>\n' +
            '                                    <input name="jury_name[]" id="jury_name[]" class="form-control" placeholder="" type="text">\n' +
            '                                </div>\n' +
            '                            </div>\n' +
            '                            <div class="col-lg-2">\n' +
            '                                <a href="javascript:void(0)" class="link-inverse form-text mt-3 remove-more-jury"><u>Remove -</u></a>\n' +
            '                            </div>\n' +
            '                        </div>';

        $(".append-more-jury").after(add_more);
        $(".remove-more-jury").on("click", function () {
            $(this).parents('.remove-div-more-jury').remove();
        });
    });


    /*Association*/

    $(".add_association_with").on('click', function () {
        var data_html = '<div class="row form-group mb-4 remove_dive_association_with">\n' +
            '                            <label class="col-lg-3 col-form-label h6">Association With</label>\n' +
            '                            <div class="col-lg-7">\n' +
            '                                <div class="form-group">\n' +
            '                                    <select class="form-control" id="association[]" name="association[]">\n' +
            '                                        <option value="" selected disabled>Associate name</option>\n' +
            '                                        <option value="\n' +
            'Indian Institute of Architects">\n' +
            'Indian Institute of Architects</option>\n' +
            '                                        <option value="Gwalior Municipal Corporation">Gwalior Municipal Corporation</option>\n' +
            '                                    </select>\n' +
            '                                </div>\n' +
            '                                <div class="form-group mb-0">\n' +
            '                                    <input type="file"  class="form-control" name="image[]" id="image[]" placeholder="Associate Logo" style="background-color: transparent;">\n' +
            '                                    <span class="input-group-addon"><i class="fa fa-paperclip" style="font-size: 18px;"></i></span>\n' +
            '                                </div>\n' +
            '                                <a href="javascript:void(0)" class="link-inverse form-text mt-3 remove_association_with"><u >Remove -</u></a>\n' +
            '                            </div>\n' +
            '                        </div>';

        $(".append_association_with").after(data_html);

        $(".remove_association_with").on("click", function () {
            $(this).parents('.remove_dive_association_with').remove();

        })

    });

    $("#occupation_other").on('click', function () {


        if ($(this).prop('checked')) {
            $("#append_occupation_other_div").show();
        }
        else {
            $("#append_occupation_other_div").hide();
            $("#other_name").val("");
            $("p.error_other").hide();
        }


    });


    $("#other_name_add").click(function () {
        /*console.log($("#other_name").val() == " ");*/
        if ($("#other_name").val() == "") {
            /*console.log("empty")*/
            $("p.error_other").show().html('Field is required.');
        }
        else {
            /* console.log("not empty")*/
            var othre_value = $("#other_name").val();

            $("#checkbox_append").before('<label>\n' +
                '\t<input name="occupation[]" class="remove_other_field" type="checkbox" value="' + othre_value + '" checked>\n' +
                '\t<span class="checkbox-material">\n' +
                '\t\t<span class="check"></span>\n' +
                '\t</span>' + othre_value +
                '</label>&nbsp;&nbsp;&nbsp;&nbsp;');

            $("#occupation_other").prop('checked', false);
            $("#append_occupation_other_div").hide();
            $("#other_name").val("");
            $("p.error_other").hide();
        }

    });

    /*add more image in event*/

    $(".add-more-event-image").on('click', function () {

        var image_html = ' <div class="row form-group remove_div_event_image">\n' +
            '                            <label class="col-lg-3 col-form-label h6">Image</label>\n' +
            '                            <div class="col-lg-7">\n' +
            '                                <div class="form-group mb-0">\n' +
            '                                    <input type="file" readonly class="form-control" name="image[]" style="background-color: transparent;">\n' +
            '                                    \n' +
            '                                    <span class="input-group-addon"><i class="fa fa-paperclip" style="font-size: 18px;"></i></span>\n' +
            '                                </div>\n' +
            '                            </div>\n' +
            '                            <div class="col-lg-2">\n' +
            '                                <a href="javascript:void(0)" class="link-inverse form-text mt-3 remove-more-event-image"><u>Remove -</u></a>\n' +
            '                            </div>\n' +
            '                        </div>';

        /*append html*/
        $("#append_image_html").after(image_html);
        /*remove html*/
        $(".remove-more-event-image").on('click', function () {
            $(this).parents('.remove_div_event_image').remove();

        });

    });

    /*job Skills*/

    $(".add_job_skills").on("click", function () {
        var job_skills = '<div class="row form-group remove_append_job_skills" >\n' +
            '                            <label class="col-lg-3 col-form-label h6">Skills</label>\n' +
            '                            <div class="col-lg-7">\n' +
            '                                <input class="form-control" name="skills[]" placeholder="Add skills you are looking for" type="text">\n' +
            '\n' +
            '                            </div>\n' +
            '                            <div class="col-lg-2">\n' +
            '                                <a href="javascript:void(0)" class="link-inverse form-text mt-3 remove_job_skills"><u>Remove -</u></a>\n' +
            '                            </div>\n' +
            '                        </div>';

        $("#append_job_skills").after(job_skills);

        /*remove div*/
        $(".remove_job_skills").click(function () {

            $(this).parents('.remove_append_job_skills').remove();

        });

    });

    /*educational qualification*/

    $(".add_educational_qualification").on('click', function () {
        var educational_qualification_html = ' <div class="row form-group remove_div_educational_qualification">\n' +
            '                            <label class="col-lg-3 col-form-label h6">Educational Qualification</label>\n' +
            '                            <div class="col-lg-7">\n' +
            '                                <input class="form-control" placeholder="Add qualification" type="text" name="educational_qualification[]">\n' +
            '\n' +
            '                            </div>\n' +
            '                            <div class="col-lg-2">\n' +
            '                                <a href="javascript:void(0)" class="link-inverse form-text mt-3 remove_educational_qualification"><u>Remove -</u></a>\n' +
            '                            </div>\n' +
            '                        </div>';

        $("#append_educational_eualification").after(educational_qualification_html);

        $(".remove_educational_qualification").on('click', function () {

            $(this).parents('.remove_div_educational_qualification').remove();

        });

    });

    /*model open change profile pic*/


    $('#myModalChangeProfile').on('hidden.bs.modal', function () {
        $('#profile').val("");
    });


    $("#geocomplete").keyup(function () {
        var val = $(this).val();
        if (val != "") {
            $(this).next('p.errors').hide();
        }
        else {
            $(this).next('p.errors').show();
        }
    });

    $("#geocomplete").on("focusout", function () {
        //find address geocomplete
        $("#geocomplete").trigger("geocode");
    });

    $(".design_post.helo").click(function (e) {
        e.preventDefault();

        var target_val = $("#target_banner_image").attr('src');
        var image_val = $("#src_banner_image").val();

        var lat = $("input[name='lat']").val();
        var lng = $("input[name='lng']").val();
        var formatted_address = $("input[name='formatted_address']").val();

        $('.design-success').hide();
        $("#design_title").next('.help-block.title').find('strong').hide();
        $('.editable').next('.help-block.description').find('strong').hide();
        var title = $("#design_title").val();
        var description = $('.editable').html().split('<div class="medium-insert-buttons"')[0];
        var post_type = $('.post_type').attr('post-type');
        var description_short = $("#description_short").val();

        $.ajax({
            type: "POST",
            url: "/parse/design-parse",
            data: {
                "title": title,
                "description": description,
                "post_type": post_type,
                "target_val": target_val,
                "banner_image": image_val,
                "lat": lat,
                "lng": lng,
                "formatted_address": formatted_address,
                'description_short': description_short
            },
            beforeSend: function () {
                NProgress.start();
            },
            success: function (data) {
                NProgress.done();
                NProgress.remove();

                navigate('#scroll_refrence');
                if (data.return == false) {
                    console.log(data.errors);
                    if (data.errors.description != undefined) {
                        $('.editable').next('.help-block.description').find('strong').text(data.errors.description[0]);
                        $('.editable').next('.help-block.description').find('strong').show();
                    }
                    if (data.errors.title != undefined) {
                        $("#design_title").next('.help-block.title').find('strong').text(data.errors.title[0]);
                        $("#design_title").next('.help-block.title').find('strong').show();
                    }
                    if (data.errors.banner_image != undefined) {
                        $("#src_banner_image").next('.help-block.banner_image').find('strong').text(data.errors.banner_image[0]);
                        $("#src_banner_image").next('.help-block.banner_image').find('strong').show();
                    }

                    if (data.errors.formatted_address != undefined) {
                        $("#geocomplete").next('p.errors').show().html(data.errors.formatted_address);
                    }

                    if (data.errors.description_short != undefined) {
                        $('#description_short').next('.help-block.description_short').find('strong').text(data.errors.description[0]);
                        $('#description_short').next('.help-block.description_short').find('strong').show();
                    }


                } else {
                    if (data.oneFormData) {
                        $("#oldTitle").val(data.oneFormData.title);
                        $("#oldDescription").val(data.oneFormData.description);
                        $("#oldBanner_image").val(data.oneFormData.banner_image);
                        $("#oldType").val(data.oneFormData.type);
                        $("#formatted_address").val(data.oneFormData.formatted_address);
                        $("#lat").val(data.oneFormData.lat);
                        $("#lng").val(data.oneFormData.lng);
                        $("#oldDescription_short").val(data.oneFormData.description_short)
                    }

                    //hide deisng post 1 & show 2
                    $("#design-post-1").hide();
                    $("#design-post-2").show();
                }
            },
            error: function (xhr, statusText, errorThrown) {
                NProgress.done();
                NProgress.remove();
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops..", "Oops! Something went wrong. Try again later", "error");
                }
            }
        });
    });


    $(".design_post_edit").click(function (e) {
        e.preventDefault();

        var target_val = $("#target_banner_image").attr('src');
        var image_val = $("#src_banner_image").val();

        var lat = $("input[name='lat']").val();
        var lng = $("input[name='lng']").val();
        var formatted_address = $("input[name='formatted_address']").val();

        $('.design-success').hide();
        $("#design_title").next('.help-block.title').find('strong').hide();
        $('.editable').next('.help-block.description').find('strong').hide();
        var title = $("#design_title").val();
        var description = $('.editable').html().split('<div class="medium-insert-buttons"')[0];
        var post_type = $('.post_type').attr('post-type');
        var description_short = $("#description_short").val();

        $.ajax({
            type: "POST",
            url: "/parse/design-parse",
            data: {
                "title": title,
                "description": description,
                "post_type": post_type,
                "target_val": target_val,
                "banner_image": image_val,
                "lat": lat,
                "lng": lng,
                "formatted_address": formatted_address,
                'description_short': description_short
            },
            beforeSend: function () {
                NProgress.start();
            },
            success: function (data) {
                NProgress.done();
                NProgress.remove();
                if (data.return == false) {
                    console.log(data.errors);
                    if (data.errors.description != undefined) {
                        $('.editable').next('.help-block.description').find('strong').text(data.errors.description[0]);
                        $('.editable').next('.help-block.description').find('strong').show();
                    }
                    if (data.errors.title != undefined) {
                        $("#design_title").next('.help-block.title').find('strong').text(data.errors.title[0]);
                        $("#design_title").next('.help-block.title').find('strong').show();
                    }
                    if (data.errors.banner_image != undefined) {
                        $("#src_banner_image").next('.help-block.banner_image').find('strong').text(data.errors.banner_image[0]);
                        $("#src_banner_image").next('.help-block.banner_image').find('strong').show();
                    }

                    if (data.errors.formatted_address != undefined) {
                        $("#geocomplete").next('p.errors').show().html(data.errors.formatted_address);
                    }

                    if (data.errors.description_short != undefined) {
                        $('#description_short').next('.help-block.description_short').find('strong').text(data.errors.description[0]);
                        $('#description_short').next('.help-block.description_short').find('strong').show();
                    }


                } else {
                    if (data.oneFormData) {
                        $("#oldTitle").val(data.oneFormData.title);
                        $("#oldDescription").val(data.oneFormData.description);
                        $("#oldBanner_image").val(data.oneFormData.banner_image);
                        $("#oldType").val(data.oneFormData.type);
                        $("#formatted_address").val(data.oneFormData.formatted_address);
                        $("#lat").val(data.oneFormData.lat);
                        $("#lng").val(data.oneFormData.lng);
                        $("#oldDescription_short").val(data.oneFormData.description_short)
                    }

                    //hide deisng post 1 & show 2
                    $("#design-post-1").hide();
                    $("#design-post-2").show();
                }
            },
            error: function (xhr, statusText, errorThrown) {
                NProgress.done();
                NProgress.remove();
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops..", "Oops! Something went wrong. Try again later", "error");
                }
            }
        });
    });

    /*post article*/

    $(".article_post.helo").click(function (e) {
        e.preventDefault();

        var image_val = $("#image_val").val();
        $('.design-success').hide();
        $("#design_title").next('.help-block.title').find('strong').hide();
        $('.editable').next('.help-block.description').find('strong').hide();
        var title = $("#design_title").val();
        var description = $('.editable').html().split('<div class="medium-insert-buttons"')[0];
        var post_type = $('.post_type').attr('post-type');
        var description_short = $("#description_short").val();

        $.ajax({
            type: "POST",
            url: "/parse/article-parse",
            data: {
                "title": title,
                "description": description,
                "post_type": post_type,
                "banner_image": image_val,
                'description_short': description_short,
            },
            beforeSend: function () {
                NProgress.start();
            },
            success: function (data) {
                NProgress.done();
                NProgress.remove();
                if (data.return == false) {
                    console.log(data.errors);
                    if (data.errors.description != undefined) {
                        $('.editable').next('.help-block.description').find('strong').text(data.errors.description[0]);
                        $('.editable').next('.help-block.description').find('strong').show();
                    }
                    if (data.errors.title != undefined) {
                        $("#design_title").next('.help-block.title').find('strong').text(data.errors.title[0]);
                        $("#design_title").next('.help-block.title').find('strong').show();
                    }
                    if (data.errors.banner_image != undefined) {
                        $("#image_val").next('.help-block.banner_image').find('strong').text(data.errors.banner_image[0]);
                        $("#src_banner_image").next('.help-block.banner_image').find('strong').show();
                    }

                    if (data.errors.description_short != undefined) {
                        $("#description_short").next('.help-block.description_short').find('strong').text(data.errors.description_short[0]);
                        $("#description_short").next('.help-block.description_short').find('strong').show();
                    }

                } else if (data.return == true) {
                    window.location.href = '/profile';
                }
            },
            error: function (xhr, statusText, errorThrown) {
                NProgress.done();
                NProgress.remove();
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops!", "Something went wrong", "error");
                }
            }
        });
    });

    $(".article_post_helo_edit").click(function (e) {
        e.preventDefault();

        var image_val = $("#image_val").val();

        $('.design-success').hide();
        $("#design_title").next('.help-block.title').find('strong').hide();
        $('.editable').next('.help-block.description').find('strong').hide();
        var title = $("#design_title").val();
        var description = $('.editable').html().split('<div class="medium-insert-buttons"')[0];
        var post_type = $('.post_type').attr('post-type');
        var description_short = $("#description_short").val();
        var slug = $("#post_article_slug").val();


        $.ajax({
            type: "POST",
            url: "/parse/article-edit",
            data: {
                "title": title,
                "description": description,
                "post_type": post_type,
                "banner_image": image_val,
                'description_short': description_short,
                'slug': slug
            },
            beforeSend: function () {
                NProgress.start();
            },
            success: function (data) {
                NProgress.done();
                NProgress.remove();
                if (data.return == false) {
                    console.log(data.errors);
                    if (data.errors.description != undefined) {
                        $('.editable').next('.help-block.description').find('strong').text(data.errors.description[0]);
                        $('.editable').next('.help-block.description').find('strong').show();
                    }
                    if (data.errors.title != undefined) {
                        $("#design_title").next('.help-block.title').find('strong').text(data.errors.title[0]);
                        $("#design_title").next('.help-block.title').find('strong').show();
                    }
                    if (data.errors.banner_image != undefined) {
                        $("#image_val").next('.help-block.banner_image').find('strong').text(data.errors.banner_image[0]);
                        $("#src_banner_image").next('.help-block.banner_image').find('strong').show();
                    }

                    if (data.errors.description_short != undefined) {
                        $("#description_short").next('.help-block.description_short').find('strong').text(data.errors.description_short[0]);
                        $("#description_short").next('.help-block.description_short').find('strong').show();
                    }

                } else if (data.return == true) {
                    showSweetMessage("Successfully Updated....", 'success');
                    window.location.href = '/news-feed';
                }
            },
            error: function (xhr, statusText, errorThrown) {
                NProgress.done();
                NProgress.remove();
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops!", "Something went wrong", "error");
                }

            }
        });
    });


    /* end post article*/


    /*mobile number*/


    $("input[name='otp']").keyup(function () {
        var val = $(this).val();

        if (val !== "") {
            $("p.errors_otp").hide();
            $(".verify_otp").removeAttr('disabled');
        }
        else {
            $("p.errors_otp").show();
            $(".verify_otp").attr('disabled', 'disabled');
        }
    });

    $(".verify_otp").on('click', function () {
        var otp = $("input[name='otp']").val();

        $.ajax({
            type: "POST",
            url: "/parse/verify-otp",
            data: {"otp": otp},
            beforeSend: function () {
                $("#spinner").show();
            },

            success: function (data) {
                $("#spinner").hide();

                if (data.errors) {
                    if (data.errors.otp !== null && data.errors.otp !== "" && data.errors.otp !== undefined) {
                        $("input[name='otp']").next("p.errors_otp").show().html(data.errors.otp);
                    }
                }
                if (data.messageVerifyOtp) {
                    $("input[name='otp']").next("p.errors_otp").show().html(data.messageVerifyOtp);


                }
                if (data.messageSuccessVerifyOtp) {
                    $('#myModalkkk').modal('hide');
                    $(".mobile_verify_model").attr('style', 'display:none')
                    $(".not_verified").text('Verified').removeAttr('style').addClass('green_color');
                }


            },
            error: function (xhr, statusText, errorThrown) {
                $("#spinner").hide();
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops!", "Something went wrong", "error");
                }
            }
        });


    });

    /*resent otp*/
    $(".resent_otp").on("click", function () {
        $.ajax({
            type: "POST",
            url: "/parse/resend-otp",
            data: {},
            beforeSend: function () {
                $("#spinner").show();
            },
            success: function (data) {
                $("#spinner").hide();
                $("input[name='otp']").val("");

                $("p.errors_otp").show().html(data.resentOtp);
                $(".verify_otp").attr('disabled', 'disabled');

            },
            error: function (xhr, statusText, errorThrown) {
                $("#spinner").hide();
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops..", "Oops! Something went wrong. Try again later", "error");
                }
            }
        });

    });

    /*open model*/

    var model_open_verification = $(".mobile_verify_model").attr('mobile-data');

    if (model_open_verification == 'n') {
        $('#myModalkkk').modal('show', {backdrop: 'static', keyboard: false});
    }

    $(".mobile_verify_model").on('click', function () {
        $('#myModalkkk').modal('show');

    });

    $('#myModalkkk').on('hidden.bs.modal', function () {
        // do something…
        $("input[name='otp']").val("");
    });

    $(".myModalkkkClode").click(function () {
        $("input[name='otp']").val("");
        $("input[name='otp']").next('p.errors_otp').hide();
        $(".verify_otp").attr('disabled', 'disabled');
    });


    /*if mobile number is empty in users table*/

    $("#mobile_number").keyup(function () {
        var val = $("#mobile_number").val();
        if (val !== "") {
            $("#mobile_number").next("p.errors_mobile_number").hide()
            $('.update_mobile_number').removeAttr('disabled');
        }
        else {
            $("#mobile_number").next("p.errors_mobile_number").show()
            $('.update_mobile_number').attr('disabled', 'disabled');
        }

    });


    /*short bio*/
    $(".short_bio_model").on('click', function () {
        $('#mobileShortBio').modal('show');
        var short_bio = $("#mobileShortBio").attr('data-short-bio');
        $(".short_bio_textarea").html(short_bio);
    });

    $(".short_bio_textarea").keyup(function () {
        var val = $(".short_bio_textarea").val();
        if (val != "") {
            $(".errors").hide();
        }
        else {
            $(".errors").show();
        }

    });


    $(".disabled_short_bio").on('click', function () {
        var val_short_bio = $(".short_bio_textarea").val();
        $.ajax({
            type: "POST",
            url: "/parse/short-bio",
            data: {"short_bio": val_short_bio},
            success: function (data) {
                if (data.errors) {
                    $(".errors").show().html(data.errors.short_bio);
                }
                else {
                    $('#mobileShortBio').modal('hide');

                    $(".short_bio_content").text(val_short_bio);

                    $(".errors").hide()
                }

            },
            error: function (xhr, statusText, errorThrown) {
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops!", "Something went wrong", "error");
                }
            }
        });
    });
    /*end short bio*/


    /*view_profile*/
    $(".view_profile").click(function () {
        var image_val = $(".view_profile").attr('src');
        $('#modelViewProfile').modal('show');

        $(".view_profile_pic_append").attr('src', image_val);
    });
    /* end view_profile*/


    /*work other detail*/
    $(".add_other_detail").on("click", function () {
        $(".alert.alert-success.other_detail_success").css('display', 'none');
        var other_detail_html = '<div class="row remove_other_detail_div" >\n' +
            '\n' +
            '\n' +
            '\n' +
            '                                    <div class="col-md-6">\n' +
            '                                    <div class="form-group label-floating">\n' +
            '                                        <label class="control-label">Awards</label>\n' +
            '                                        <input class="form-control" placeholder="" name="award[]" type="text" value=""><p class="errors" style="color: red;display: none;"></p>\n' +
            '\n' +
            '                                    </div>\n' +
            '                                </div>\n' +
            '                                <div class="col-md-6">\n' +
            '                                    <div class="form-group label-floating">\n' +
            '                                        <label class="control-label">Award Name </label>\n' +
            '                                        <input class="form-control" placeholder="" name="award_name[]" type="text" value=""><p class="errors" style="color: red;display: none;"></p>\n' +
            '\n' +
            '                                    </div>\n' +
            '                                </div>\n' +
            '                                <div class="col-md-6">\n' +
            '                                    <div class="form-group label-floating">\n' +
            '                                        <label class="control-label">Project Name</label>\n' +
            '                                        <input class="form-control" placeholder="" name="project_name[]" type="text" value=""><p class="errors" style="color: red;display: none;"></p>\n' +
            '\n' +
            '                                    </div>\n' +
            '                                </div>\n' +
            '\n' +
            '\n' +
            '                                 <div class="col-md-6">\n' +
            '                                    <div class="form-group label-floating">\n' +
            '                                        <label class="control-label">Services Offered </label>\n' +
            '                                        <input class="form-control" placeholder="" name="services_offered[]" type="text" value=""><p class="errors" style="color: red;display: none;"></p>\n' +
            '\n' +
            '                                    </div>\n' +
            '                                </div>\n' +
            '\n' +
            '                                <div class="col-md-12">\n' +
            '                                    <button type="button" class="pull-right remove_other_detail btn btn-secondary btn-sm font-weight-bold">Remove</button>\n' +
            '                                </div>\n' +
            '                                <br />\n' +
            '                                <br />\n' +
            '                                <hr />\n' +
            '                            </div>\n';


        $(".row.other_detail").after(other_detail_html);

        $(".remove_other_detail").on('click', function () {
            $(this).parents(".remove_other_detail_div").remove();
            $(".alert.alert-success.other_detail_success").css('display', 'none');
        })

    });

    // Save Other details
    $(".other_detail_save").on('click', function () {
        var formElement = document.querySelector("#other_detail_form");
        var formData = new FormData(formElement);

        $.ajax({
            type: "POST",
            url: "/parse/work-other-detail",
            data: formData,
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,
            beforeSend: function () {
                NProgress.start();
                $(".other_detail_save").attr('disabled', 'disabled');
            },
            success: function (data) {
                NProgress.done();
                NProgress.remove();
                $(".other_detail_save").removeAttr('disabled');

                swal({
                    title: "Success",
                    text: "Other details updated successfully",
                    type: "success",
                    confirmButtonText: "ok"
                }).then(function () {
                    window.location.href = "/profile/edit/other-details?val=success";
                });
            },
            error: function (xhr, statusText, errorThrown) {
                NProgress.done();
                NProgress.remove();
                $(".other_detail_save").removeAttr('disabled');

                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else if (xhr.status == '422') {
                    $("#other_detail_form").find("p.errors").hide();

                    var response = $.parseJSON(xhr.responseText);

                    //get number of rows
                    var rows = $("#other_detail_form").find(".row");

                    $.each(response, function (index, value) {
                        for (var i = 0; i < rows.length; i++) {
                            if (index == "award." + i) {
                                $(rows[i]).find("input[name='award[]']").parent().find("p.errors").show().html(value);
                            }

                            if (index == "award_name." + i) {
                                $(rows[i]).find("input[name='award_name[]']").parent().find("p.errors").show().html(value);
                            }

                            if (index == "project_name." + i) {
                                $(rows[i]).find("input[name='project_name[]']").parent().find("p.errors").show().html(value);
                            }

                            if (index == "services_offered." + i) {
                                $(rows[i]).find("input[name='services_offered[]']").parent().find("p.errors").show().html(value);
                            }
                        }
                    });
                } else {
                    swal("Oops..", "Something went wrong", "error");
                }
            }
        });
    });

    $(".remove_this_other_detail").on('click', function () {
        $(this).parents(".other_detail_div_remove").remove();
    });


    /* end work other detail*/

    /*work professional detail*/
    $(".add_work_professional_detail").on("click", function () {
        $(".work_professional_success").hide();

        var work_professional_detail_html = '<div class="row work_professional_detail_remove_div">\n' +
            '\n' +
            '\n' +
            '                                <div class="col-md-6">\n' +
            '                                    <div class="form-group label-floating">\n' +
            '                                        <label class="control-label">Role*</label>\n' +
            '                                        <input class="form-control" placeholder="" type="text" value="" name="role[]"><p class="errors" style="color: red;display: none;"></p>\n' +
            '\n' +
            '                                    </div>\n' +
            '                                </div>\n' +
            '\n' +
            '                                <div class="col-md-6">\n' +
            '                                    <div class="form-group label-floating">\n' +
            '                                        <label class="control-label">Company/Firm Or College/University*</label>\n' +
            '                                        <input class="form-control" placeholder="" name="company_firm_or_college_university[]" type="text" value=""><input type="hidden" class="type" value="" name="company_firm_or_college_university_type[]"><input type="hidden" class="id" value="" name="company_firm_or_college_university_id[]"><ul class="account-settings ajax_search college college-company"></ul><p class="errors" style="color: red;display: none;"></p>\n' +
            '\n' +
            '                                    </div>\n' +
            '                                </div>\n' +
            '\n' +
            '\n' +
            '\n' +
            '                                <div class="col-md-6">\n' +
            '                                    <div class="form-group label-floating">\n' +
            '                                        <label class="control-label">Start Date</label>\n' +
            '                                        <input class="form-control datetimepicker_start_date" id="hello1" placeholder=""  value="" type="text" name="start_date[]" ><p class="errors" style="color: red;display: none;"></p>\n' +
            '\n' +
            '                                    </div>\n' +
            '                                </div>\n' +
            '\n' +
            '\n' +
            '\n' +
            '                                <div class="col-md-6">\n' +
            '                                    <div class="form-group label-floating is-select">\n' +
            '                                        <label class="control-label">End Date of Working Currently</label>\n' +
            '                                        <input class=" form-control datetimepicker_end_date" name="end_date_of_working_currently[]"    placeholder="" type="text" value=""><p class="errors" style="color: red;display: none;"></p>\n' +
            '\n' +
            '                                    </div>\n' +
            '\n' +
            '                                </div>\n' +
            '                                 <div class="col-md-6">\n' +
            '                                    <div class="form-group label-floating">\n' +
            '                                        <label class="control-label">Salary/Stripend</label>\n' +
            '                                        <input class="form-control" placeholder="" name="salary_stripend[]" type="text" value=""><p class="errors" style="color: red;display: none;"></p>\n' +
            '\n' +
            '                                    </div>\n' +
            '                                </div>\n' +
            '\n' +
            '                                <div class="col-md-6">\n' +
            '                                    <div class="form-group label-floating">\n' +
            '\n' +
            '                                        <button type="button" class="pull-right remove_work_professional_detail btn btn-secondary btn-sm font-weight-bold">Remove</button>\n' +
            '\n' +
            '                                    </div>\n' +
            '                                </div>\n' +
            '                            </div>';

        $(".work_professional_detail").after(work_professional_detail_html);

        $(".remove_work_professional_detail").on("click", function () {
            $(this).parents('.work_professional_detail_remove_div').remove();
            $(".work_professional_success").hide();
        });
    });


    /*
     * Save work professional Details
     * */

    $(".save_work_professional_details").click(function () {
        var formElement = document.querySelector("#professional_detail_form");
        var formData = new FormData(formElement);

        $.ajax({
            type: "POST",
            url: "/parse/work-professional-details",
            data: formData,
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,
            beforeSend: function () {
                NProgress.start();
                $(".save_work_professional_details").attr('disabled', 'disabled');
            },
            success: function (data) {
                NProgress.done();
                NProgress.remove();

                $(".save_work_professional_details").removeAttr('disabled');

                swal({
                    title: "Success",
                    text: "Professional Details Updated successfully",
                    type: "success",
                    confirmButtonText: 'ok'
                }).then(function () {
                    window.location.href = '/profile/edit/professional-details?val=success';
                });
            },
            error: function (xhr, statusText, errorThrown) {
                NProgress.done();
                NProgress.remove();
                $(".save_work_professional_details").removeAttr('disabled');

                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else if (xhr.status == '422') {
                    //hide old fields
                    $("#professional_detail_form").find("p.errors").hide();

                    //validations
                    var response = $.parseJSON(xhr.responseText);

                    //get count of number of rows
                    var rows = $("#professional_detail_form").find(".row");

                    $.each(response, function (index, value) {
                        //i am starting from 1 because First row in professional detail mai phela colum multiple wala ny hai
                        for (var i = 0; i < rows.length; i++) {
                            console.log(i);
                            var j = i + 1;
                            if (index == "role." + i) {
                                $(rows[j]).find("input[name='role[]']").parent().find("p.errors").show().html(value);
                            }

                            if (index == "company_firm_or_college_university." + i) {
                                $(rows[j]).find("input[name='company_firm_or_college_university[]']").parent().find("p.errors").show().html(value);
                            }

                            if (index == "start_date." + i) {
                                $(rows[j]).find("input[name='start_date[]']").parent().find("p.errors").show().html(value);
                            }

                            if (index == "end_date_of_working_currently." + i) {
                                $(rows[j]).find("input[name='end_date_of_working_currently[]']").parent().find("p.errors").show().html(value);
                            }

                            if (index == "salary_stripend." + i) {
                                $(rows[j]).find("input[name='salary_stripend[]']").parent().find("p.errors").show().html(value);
                            }
                        }
                    });

                } else {
                    swal("Oops..", "Something went wrong.", "error");
                }
            }
        });
    });

    $(".remove_this_professional_detail").on('click', function () {
        $(this).parents(".professional_detail_div_remove").remove();
    });

    /* end work professional detail*/

    $(".project_part").click(function () {
        var project_part_val = $(this).attr('data-project_part')
        $("#project_part_val").val(project_part_val);
        $('.errors_project_parterrors').hide();
    });

    $(".college_part").click(function () {
        var college_part_val = $(this).attr('data-college_part')
        $("#college_part_val").val(college_part_val);
        $('.errors_project_college').hide();
    });

    $("#src_banner_image").change(function () {
        $(this).next('p.errors').hide();
    });

    //save Design
    $(".designPostModalSave").click(function () {
        var formElement = document.querySelector("#designPostModalForm");
        var formData = new FormData(formElement);

        $.ajax({
            type: "POST",
            url: "/parse/design-parse-2",
            data: formData,
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,
            beforeSend: function () {
                $("#spinner").show();
                $(".designPostModalModalSave").attr('disabled', 'disabled');
            },
            success: function (data) {
                //hide all the error fields
                $('p.errors').hide();
                $("#spinner").hide();
                if (data.errors) {
                    navigate('#scroll_refrence');

                    if (data.errors.status !== null && data.errors.status !== "" && data.errors.status !== undefined) {
                        $('.status_errors_design').show().html(data.errors.status);
                    }

                    if (data.errors.building_program !== null && data.errors.building_program !== "" && data.errors.building_program !== undefined) {
                        $('.building_program_errors_design').show().html(data.errors.building_program);
                    }

                    if (data.errors.select_design_type !== null && data.errors.select_design_type !== "" && data.errors.select_design_type !== undefined) {
                        $('.select_design_type_errors_design').show().html(data.errors.select_design_type);
                    }

                    if (data.errors.start_year !== null && data.errors.start_year !== "" && data.errors.start_year !== undefined) {
                        $('.start_year_errors_design').show().html(data.errors.start_year);
                    }

                    if (data.errors.end_year !== null && data.errors.end_year !== "" && data.errors.end_year !== undefined) {
                        $('.end_year_errors_design').show().html(data.errors.end_year);
                    }

                    if (data.errors.total_budget !== null && data.errors.total_budget !== "" && data.errors.total_budget !== undefined) {
                        $('#total_budget').next('p.errors').show().html(data.errors.total_budget);
                    }

                    if (data.errors.inr !== null && data.errors.inr !== "" && data.errors.inr !== undefined) {
                        $('.inr_errors_design').show().html(data.errors.inr);
                    }

                    if (data.errors.location !== null && data.errors.location !== "" && data.errors.location !== undefined) {
                        $('#location').next('p.errors').show().html(data.errors.location);
                    }

                    if (data.errors.project_part !== null && data.errors.project_part !== "" && data.errors.project_part !== undefined) {
                        $('.errors_project_parterrors').show().html(data.errors.project_part);
                    }

                    if (data.errors.competition_link !== null && data.errors.competition_link !== "" && data.errors.competition_link !== undefined) {
                        $('#competition_link').next('p.errors').show().html(data.errors.competition_link);
                    }

                    if (data.errors.tags !== null && data.errors.tags !== "" && data.errors.tags !== undefined) {
                        $('#tags').next('p.errors').show().html(data.errors.tags);
                    }

                    if (data.errors.banner_image !== null && data.errors.banner_image !== "" && data.errors.banner_image !== undefined) {
                        $('.src_banner_image').show().html(data.errors.banner_image);
                    }
                }
                else {
                    $("#designPostModal").modal('hide');
                    window.location.href = '/profile';
                }
            },
            error: function (xhr, statusText, errorThrown) {
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops..", "Something went wrong.Try again later or contact support", "error");
                }
                $("#spinner").hide();
            }
        });
    });


    //save Design
    $(".designPostModalSave_edit").click(function () {
        var formElement = document.querySelector("#designPostModalForm");
        var formData = new FormData(formElement);

        $.ajax({
            type: "POST",
            url: "/parse/design-parse-2-edit",
            data: formData,
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,
            beforeSend: function () {
                $("#spinner").show();
                $(".designPostModalModalSave").attr('disabled', 'disabled');
            },
            success: function (data) {
                //hide all the error fields
                $('p.errors').hide();

                $("#spinner").hide();
                if (data.errors) {

                    if (data.errors.status !== null && data.errors.status !== "" && data.errors.status !== undefined) {
                        $('.status_errors_design').show().html(data.errors.status);
                    }

                    if (data.errors.building_program !== null && data.errors.building_program !== "" && data.errors.building_program !== undefined) {
                        $('.building_program_errors_design').show().html(data.errors.building_program);
                    }

                    if (data.errors.select_design_type !== null && data.errors.select_design_type !== "" && data.errors.select_design_type !== undefined) {
                        $('.select_design_type_errors_design').show().html(data.errors.select_design_type);
                    }

                    if (data.errors.start_year !== null && data.errors.start_year !== "" && data.errors.start_year !== undefined) {
                        $('.start_year_errors_design').show().html(data.errors.start_year);
                    }

                    if (data.errors.end_year !== null && data.errors.end_year !== "" && data.errors.end_year !== undefined) {
                        $('.end_year_errors_design').show().html(data.errors.end_year);
                    }

                    if (data.errors.total_budget !== null && data.errors.total_budget !== "" && data.errors.total_budget !== undefined) {
                        $('#total_budget').next('p.errors').show().html(data.errors.total_budget);
                    }

                    if (data.errors.inr !== null && data.errors.inr !== "" && data.errors.inr !== undefined) {
                        $('.inr_errors_design').show().html(data.errors.inr);
                    }

                    if (data.errors.location !== null && data.errors.location !== "" && data.errors.location !== undefined) {
                        $('#location').next('p.errors').show().html(data.errors.location);
                    }

                    if (data.errors.project_part !== null && data.errors.project_part !== "" && data.errors.project_part !== undefined) {
                        $('.errors_project_parterrors').show().html(data.errors.project_part);
                    }

                    if (data.errors.competition_link !== null && data.errors.competition_link !== "" && data.errors.competition_link !== undefined) {
                        $('#competition_link').next('p.errors').show().html(data.errors.competition_link);
                    }

                    if (data.errors.tags !== null && data.errors.tags !== "" && data.errors.tags !== undefined) {
                        $('#tags').next('p.errors').show().html(data.errors.tags);
                    }

                    if (data.errors.banner_image !== null && data.errors.banner_image !== "" && data.errors.banner_image !== undefined) {
                        $('.src_banner_image').show().html(data.errors.banner_image);
                    }
                }
                else {
                    $("#designPostModal").modal('hide');
                    window.location.href = '/profile';
                }
            },
            error: function (xhr, statusText, errorThrown) {
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops..", "Something went wrong.Try again later or contact support", "error");
                }
                $("#spinner").hide();
            }
        });
    });

    /**/
    $(".add_work_education_details").click(function () {
        var work_education_details_html = ' <div class="row work_education_details_remove_div">\n' +
            '                                <div class="col-md-6">\n' +
            '                                    <div class="form-group label-floating">\n' +
            '                                        <label class="control-label">Course*</label>\n' +
            '                                        <input class="form-control" placeholder="" value="" name="course[]" type="text"> <p class="errors" style="color: red;display: none;"></p>\n' +
            '\n' +
            '                                    </div>\n' +
            '                                </div>\n' +
            '\n' +
            '                                <div class="col-md-6">\n' +
            '                                    <div class="form-group label-floating">\n' +
            '                                        <label class="control-label">Collge/University*</label>\n' +
            '                                        <input class="form-control" placeholder="" value="" name="college_university[]" type="text"><input type="hidden" class="id" name="college_university_id[]" value=""><ul class="account-settings ajax_search college college-company"> </ul><p class="errors" style="color: red;display: none;"></p>\n' +
            '\n' +
            '                                    </div>\n' +
            '                                </div>\n' +
            '                                <div class="col-md-6">\n' +
            '                                    <div class="form-group label-floating hello">\n' +
            '                                        <label class="control-label">Year Of Admission*</label>\n' +
            '                                        <input class="form-control year_of_admission" placeholder="" value="" name="year_of_admission[]" type="text" id="year_of_admission"><p class="errors" style="color: red;display: none;"></p>\n' +
            '\n' +
            '                                    </div>\n' +
            '                                </div>\n' +
            '\n' +
            '\n' +
            '                                <div class="col-md-6">\n' +
            '                                    <div class="form-group label-floating hello">\n' +
            '                                        <label class="control-label">Year Of Graduation*</label>\n' +
            '                                        <input class="form-control year_of_graduation" placeholder="" value="" name="year_of_graduation[]" id="year_of_graduation" type="text"><p class="errors" style="color: red;display: none;"></p>\n' +
            '\n' +
            '                                    </div>\n' +
            '                                </div>\n' +
            '                                <div class="col-md-12">\n' +
            '                                    <button type="button" class="pull-right remove_work_education_details btn btn-secondary btn-sm font-weight-bold">Remove</button>\n' +
            '                                </div>\n' +
            '\n' +
            '                                <hr style="width:100%;">\n' +
            '\n' +
            '                            </div>';

        $(".work_education_details").after(work_education_details_html);

        $(".remove_work_education_details").click(function () {
            $(this).parents(".work_education_details_remove_div").remove();

        });

    });

    $("input[name='course[]']").add("input[name='college_university[]']").add("input[name='year_of_admission[]']").add("input[name='year_of_graduation[]']").on('keyup', function () {
        var value = $(this).val();
        if (value != "") {
            $(this).next('p.errors').hide();
        }
        else {
            $(this).next('p.errors').hide();
        }

    });

    /*
     * Save Work Indivual Education Details
     * */
    $(".work_education_details_save").click(function () {
        var formElement = document.querySelector("#work_education_details_form");
        var formData = new FormData(formElement);

        $.ajax({
            type: "POST",
            url: "/parse/work-education-detail",
            data: formData,
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,
            beforeSend: function () {
                NProgress.start();
                $(".work_education_details_save").attr('disabled', 'disabled');
            },
            success: function (data) {
                NProgress.done();
                NProgress.remove();
                $(".work_education_details_save").removeAttr('disabled');

                swal({
                    title: 'Success',
                    text: "Education Details Updated successfully",
                    type: 'success',
                    confirmButtonText: 'Ok'
                }).then(function () {
                    window.location.href = '/profile/edit/professional-details?val=success';
                });
            },
            error: function (xhr, statusText, errorThrown) {
                NProgress.done();
                NProgress.remove();
                $(".work_education_details_save").removeAttr('disabled');

                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else if (xhr.status == '422') {
                    //hide field
                    $("#work_education_details_form").find("p.errors").hide();

                    //validation
                    var response = $.parseJSON(xhr.responseText);
                    //get the number of rows inflated on dom
                    var numberOfRows = $("#work_education_details_form").find(".row");
                    $.each(response, function (index, value) {
                        for (var i = 0; i < numberOfRows.length; i++) {
                            if (index == "course." + i) {
                                $(numberOfRows[i]).find("input[name='course[]']").parent().find("p.errors").show().html(value);
                            }

                            if (index == "college_university." + i) {
                                $(numberOfRows[i]).find("input[name='college_university[]']").parent().find("p.errors").show().html(value);
                            }

                            if (index == "year_of_admission." + i) {
                                $(numberOfRows[i]).find("input[name='year_of_admission[]']").parent().find("p.errors").show().html(value);
                            }

                            if (index == "year_of_graduation." + i) {
                                $(numberOfRows[i]).find("input[name='year_of_graduation[]']").parent().find("p.errors").show().html(value);
                            }
                        }
                    });
                } else {
                    swal('Oops...', 'Something went wrong!', 'error');
                }
            }
        });
    });

    $(".remove_this_education_details").click(function () {
        $(this).parents('.work_education_details_remove_div').remove();
    });

    /**/

    /*add_email*/
    $(".add_email").click(function () {
        var item = $('#work_individual_basic_form').find('.remove_email_div').length + 1;
        var email_html = '<div class="row remove_email_div">\n' +
            '    <div class="col-md-6">\n' +
            '        <div class="form-group label-floating">\n' +
            '            <label class="control-label">Email *</label>\n' +
            '            <input class="form-control email_search item' + item + '" placeholder="" value="" name="email[]" type="text"  >\n' +
            '\n' +
            '<p class="errors_email" style="color: red;display: none;"></p>\n' +
            '\n' +
            '        </div>\n' +
            '    </div>\n' +
            '    <div class="col-md-6">\n' +
            '        <button type="button" class="remove_email btn btn-secondary btn-sm font-weight-bold">Remove</button>\n' +
            '    </div>\n' +
            '\n' +
            '</div>';

        $(".append_email_html").after(email_html);

        $(".remove_email").click(function () {
            $(this).parents(".remove_email_div").remove();
            $(".save_work_individual").removeAttr('disabled');
        });

    });


    $('body').on('keyup', '.email_search', function () {
        // this handler will work even for dynamically created <li>
        var email = $(this).val();
        var helo = $(this)[0].className;
        var thisElement = helo.split(" ").join('.');
        console.log(thisElement);
        $.ajax({
            type: "POST",
            url: "/parse/email-add",
            data: {"email": email},

            success: function (data) {
                if (data.errors) {
                    if (data.errors.email != null && data.errors.email != "" && data.errors.email != undefined) {
                        console.log('success');
                        $("." + thisElement).next().show('p').html(data.errors.email);
                        $(".save_work_individual").attr('disabled', 'disabled');
                        $(".email_save").attr('disabled', 'disabled');
                    } else {
                        console.log('fail');
                        $("." + thisElement).next().hide('p');
                        $(".save_work_individual").removeAttr('disabled');
                        $(".email_save").removeAttr('disabled');
                    }
                }
                else {
                    $("." + thisElement).next().hide('p');
                    $(".save_work_individual").removeAttr('disabled');
                    $(".email_save").removeAttr('disabled');

                }

            },
            error: function (xhr, statusText, errorThrown) {
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops!", "Something went wrong", "error");
                }
            }

        });

    });

    $(".remove_email").click(function () {
        var id = $(this).attr('data-id');
        var class_css = $("#getClass").attr('data-class');


        console.log(id);
        $.ajax({
            type: "POST",
            url: "/parse/remove-email",
            data: {"id": id, "class_css": class_css},
            beforeSend: function () {
                NProgress.start();
            },
            success: function (data) {
                NProgress.done();
                NProgress.remove();
                $('.' + class_css).remove();
                $("#messageSuccess").css('display', 'none');
                $("#removeEmail").fadeIn();
            },
            error: function (xhr, statusText, errorThrown) {
                NProgress.done();
                NProgress.remove();
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops!", "Something went wrong", "error");
                }
            }
        });


    });
    /*end add_email*/

    //Design Upload

    //show COmpleted project link input
    $("#project_part_yes").change(function () {
        if ($(this).prop("checked")) {
            //show input
            $("#competition_link_container").show();
        } else {
            //hide input
            $("#competition_link_container").hide();
        }
    });

    //hide completed project link input
    $("#project_part_no").change(function () {
        if ($(this).prop("checked")) {
            //hide input
            $("#competition_link_container").hide();
        } else {
            //show input
            $("#competition_link_container").show();
        }
    });


    //show COmpleted project link input colege part
    $("#college_part_yes").change(function () {
        if ($(this).prop("checked")) {
            //show input
            $("#competition_link_container_college_part").show();
        } else {
            //hide input
            $("#competition_link_container_college_part").hide();
        }
    });

    //hide completed project link input college part
    $("#college_part_no").change(function () {
        if ($(this).prop("checked")) {
            //hide input
            $("#competition_link_container_college_part").hide();
        } else {
            //show input
            $("#competition_link_container_college_part").show();
        }
    });



    $(".header-search-form-input-msg").on('keyup', function () {
        var searchval = $(this).val();
        if (searchval.length > 1) {
            $.ajax({
                type: "POST",
                url: "/parse/search-msg",
                data: {"search": searchval,
                        "from":document.querySelector('#from').value},
                success: function (data) {
                    if (data != 0) {
                        $('.header-search.account-settings.ajax_search-msg').html(data);
                    } else {
                        $('.header-search.account-settings.ajax_search-msg').html("");
                    }
                },
                error: function (xhr, statusText, errorThrown) {
                    /*  alert(xhr.status);*/
                    if (xhr.status == '401') {
                        window.location.href = base_url + 'login'; //Will take you to login.
                    } else {
                        swal("Oops!", "Something went wrong", "error");
                    }
                }
            });
        } else {
            $('.header-search.account-settings.ajax_search-msg').html("");
        }
    });




    $(".header-search-form-input").on('keyup', function () {
        var searchval = $(this).val();
        if (searchval.length > 1) {
            $.ajax({
                type: "POST",
                url: "/parse/search",
                data: {"search": searchval},
                success: function (data) {
                    if (data != 0) {
                        $('.header-search.account-settings.ajax_search').html(data);
                    } else {
                        $('.header-search.account-settings.ajax_search').html("");
                    }
                },
                error: function (xhr, statusText, errorThrown) {
                    /*  alert(xhr.status);*/
                    if (xhr.status == '401') {
                        window.location.href = base_url + 'login'; //Will take you to login.
                    } else {
                        swal("Oops!", "Something went wrong", "error");
                    }
                }
            });
        } else {
            $('.header-search.account-settings.ajax_search').html("");
        }
    });

    $("input[name='first_name']").add("input[name='last_name']").add("input[name='aadhar_id']").add("input[name='pin_code']").add("textarea[name='short_bio']").add("input[name='address']").add("textarea[name='describe_yourself']").add("input[name='facebook_link']").add("input[name='twitter_link']").add("input[name='linkedin_link']").add("input[name='instagram_link']").on('keyup', function () {

        if ($(this).val() != "") {
            $(this).next('p.errors').hide();
        }
        else {
            $(this).next('p.errors').show();
        }
    });

    $("#date_of_birth").on('focus', function () {
        if ($(this).val() != "") {
            $(this).next('p.errors').hide().html();
        } else {
            $(this).next('p.errors').show().html();
        }
    }).on('focusout', function () {
        if ($(this).val() != "") {
            $(this).next('p.errors').hide().html();
        } else {
            $(this).next('p.errors').show().html();
        }
    });

    $("select[name='gender']").on('change', function () {
        if ($(this).val() != "") {
            $(".gender_errors").hide();
        }
        else {
            $(".gender_errors").show();
        }
    });

    /*
     * Save Work Individual Basic Details
     * */
    $(".save_work_individual").on('click', function () {
        var formElement = document.querySelector("#work_individual_basic_form");
        var formData = new FormData(formElement);
        $.ajax({
            type: "POST",
            url: "/parse/work-individual-basic",
            data: formData,
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,
            beforeSend: function () {
                NProgress.start();
            },
            success: function (data) {
                NProgress.done();
                NProgress.remove();
                if (data.errors) {
                    if (data.errors.first_name != null && data.errors.first_name != "" && data.errors.first_name != undefined) {
                        $("input[name='first_name']").next('p.errors').show().html(data.errors.first_name);
                    }
                    if (data.errors.last_name != null && data.errors.last_name != "" && data.errors.last_name != undefined) {
                        $("input[name='last_name']").next('p.errors').show().html(data.errors.last_name);
                    }
                    if (data.errors.gender != null && data.errors.gender != "" && data.errors.gender != undefined) {
                        $(".gender_errors").show().html(data.errors.gender);
                    }
                    if (data.errors.date_of_birth != null && data.errors.date_of_birth != "" && data.errors.date_of_birth != undefined) {
                        $("input[name='date_of_birth']").next('p.errors').show().html(data.errors.date_of_birth);
                    }
                    if (data.errors.aadhar_id != null && data.errors.aadhar_id != "" && data.errors.aadhar_id != undefined) {
                        $("input[name='aadhar_id']").next('p.errors').show().html(data.errors.aadhar_id);
                    }

                    if (data.errors.address != null && data.errors.address != "" && data.errors.address != undefined) {
                        $("input[name='address']").next('p.errors').show().html(data.errors.address);
                    }
                    if (data.errors.pin_code != null && data.errors.pin_code != "" && data.errors.pin_code != undefined) {
                        $("input[name='pin_code']").next('p.errors').show().html(data.errors.pin_code);
                    }

                    if (data.errors.country != null && data.errors.country != "" && data.errors.country != undefined) {
                        $('.errors_country').show().html(data.errors.country);
                    }
                    if (data.errors.state != null && data.errors.state != "" && data.errors.state != undefined) {
                        $('.errors_state').show().html(data.errors.state);
                    }
                    if (data.errors.city != null && data.errors.city != "" && data.errors.city != undefined) {
                        $('.errors_city').show().html(data.errors.city);
                    }
                    if (data.errors.short_bio != null && data.errors.short_bio != "" && data.errors.short_bio != undefined) {
                        $("textarea[name='short_bio']").next('p.errors').show().html(data.errors.short_bio);
                    }
                    if (data.errors.describe_yourself != null && data.errors.describe_yourself != "" && data.errors.describe_yourself != undefined) {
                        $("textarea[name='describe_yourself']").next('p.errors').show().html(data.errors.describe_yourself);
                    }

                    if (data.errors.facebook_link != null && data.errors.facebook_link != "" && data.errors.facebook_link != undefined) {
                        $("input[name='facebook_link']").next('p.errors').show().html(data.errors.facebook_link);
                    }

                    if (data.errors.linkedin_link != null && data.errors.linkedin_link != "" && data.errors.linkedin_link != undefined) {
                        $("input[name='linkedin_link']").next('p.errors').show().html(data.errors.linkedin_link);
                    }
                    if (data.errors.twitter_link != null && data.errors.twitter_link != "" && data.errors.twitter_link != undefined) {
                        $("input[name='twitter_link']").next('p.errors').show().html(data.errors.twitter_link);
                    }

                    if (data.errors.instagram_link != null && data.errors.instagram_link != "" && data.errors.instagram_link != undefined) {
                        $("input[name='instagram_link']").next('p.errors').show().html(data.errors.instagram_link);
                    }
                }
                else {
                    swal({
                        title: 'Success',
                        text: "Basic Details Updated successfully",
                        type: 'success',
                        confirmButtonText: 'Ok'
                    }).then(function () {
                        window.location.href = '/profile/edit/education-details?val=success';
                    })
                }
            },
            error: function (xhr, statusText, errorThrown) {
                NProgress.done();
                NProgress.remove();
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal(
                        'Oops...', 'Something went wrong!', 'error'
                    );
                }
            }
        });
    });

    /*add more email*/
    $(".add_more_email").click(function () {
        $("#addMoreEmail").modal('show');

        $("#messageSuccess").css('display', 'none');
        $("#removeEmail").fadeOut();
    });

    $(".add_email_model").click(function () {
        var item = $('#add_more_email_form').find('.remove_email_model_div').length + 1;
        var email_html = '<div class="row remove_email_model_div">\n' +
            '                    <div class="col-md-9">\n' +
            '                        <div class="form-group label-floating">\n' +
            '                            <label class="control-label">Enter Email </label>\n' +
            '                            <input type="text" name="email[]" class="form-control email_search item' + item + '" >\n' +
            '                            <p class="errors_email" style="color: red;display: none;"></p>\n' +
            '                        </div>\n' +
            '                    </div>\n' +
            '\n' +
            '                    <div class="col-md-3">\n' +
            '\n' +
            '\n' +
            '                            <button type="button" class="remove_email_model btn btn-secondary btn-sm font-weight-bold">Remove</button>\n' +
            '\n' +
            '                    </div>\n' +
            '                </div>';

        $(".add_email_model_div").after(email_html);

        $(".remove_email_model").click(function () {
            $(this).parents('.remove_email_model_div').remove();
            $(".email_save.hello").removeAttr('disabled');
        });

    });

    $(".email_save.hello").click(function () {


        var formElement = document.querySelector("#add_more_email_form");
        var formData = new FormData(formElement);

        $.ajax({
            type: "POST",
            url: "/parse/add-more-email",
            data: formData,
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,

            beforeSend: function () {
                $("#spinner").show();
                $(".email_save.hello").attr('disabled', 'disabled');
            },

            success: function (data) {
                $("#spinner").hide();
                $(".email_save.hello").removeAttr('disabled');
                $("#addMoreEmail").modal('hide');

                window.location.href = '/profile/edit?val=success';


            },

            error: function (xhr, statusText, errorThrown) {
                $("#spinner").hide();
                $(".email_save.hello").removeAttr('disabled');
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops!", "Something went wrong", "error");
                }
            }
        });


    });
    /*end more email*/


    $("body").on('click', '.follow_', function () {
        var to_user = $(this).attr('data-id');
        var thisElement = $(this);
        $.ajax({
            type: "POST",
            url: "/parse/follow",
            data: {"to_user": to_user},
            success: function (data) {
                if (data.return == true) {
                    thisElement.html('Following');
                    $(".following_count").html(data.following_count);
                    $(".follower_count").html(data.follower_count);

                    //add follow notification to firebase
                    var to_notification_id = to_user;
                    var name = "";
                    if (data.from_user.first_name != null && data.from_user.last_name != null) {
                        name = data.from_user.first_name + " " + data.from_user.last_name;
                    } else {
                        name = data.from_user.name;
                    }

                    var dataToSave = {
                        from_user: {
                            id: data.from_user.id,
                            email: data.from_user.email,
                            name: name,
                            username: data.from_user.user_name,
                        },
                        body: "started following you",
                        type: "follow",
                        created_at: new Date().getTime(),
                    };

                    saveNotification(to_notification_id, dataToSave);
                }
                else if (data.return == false) {
                    thisElement.html('Follow');
                    $(".following_count").html(data.following_count);
                    $(".follower_count").html(data.follower_count);
                }
            },
            error: function () {
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops!", "Something went wrong", "error");
                }
            }
        })


    });


    /*
     Method to add likes
     */

    $("body").on('click', '.like_', function () {
        var likeable_id = $(this).parents('.data_this').attr('data-id');
        var likeable_type = $(this).parents('.data_this').attr('data-type');
        var class_name = $(this).parents('.data_this').attr('data-class');


        $.ajax({
            type: "POST",
            url: "/parse/like",
            data: {"likeable_id": likeable_id, "likeable_type": likeable_type},

            success: function (data) {
                if (data.return == 'true') {

                    $('.' + class_name).find('span.like').html(data.count + ' ' + 'Like');
                    $('.' + class_name).find('.hk_like_post').addClass('like_color');


                    //add notification to firebase
                    var to_notification_id = data.post.user_id;
                    var name = "";
                    if (data.from_user.first_name != null && data.from_user.last_name != null) {
                        name = data.from_user.first_name + " " + data.from_user.last_name;
                    } else {
                        name = data.from_user.name;
                    }

                    var dataToSend = {
                        from_user: {
                            id: data.from_user.id,
                            email: data.from_user.email,
                            name: name,
                            username: data.from_user.user_name,
                        },
                        post: {
                            id: data.post.id,
                            type: data.post.type,
                            slug: data.post.slug
                        },
                        body: "liked your " + data.post.type,
                        type: "like_post",
                        created_at: new Date().getTime()
                    };

                    saveNotification(to_notification_id, dataToSend);
                } else {

                    $('.' + class_name).find('span.like').html(data.count + ' ' + 'Like').parent().removeClass('like_color');
                    $('.' + class_name).find('.hk_like_post').removeClass('like_color');


                }
            },
            error: function (xhr, statusText, errorThrown) {
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops!", "Something went wrong", "error");
                }
            }
        })

    });

    /*comments*/

    $("textarea[name='comment_text']").on('keyup', function () {
        var val = $(this).val();
        var comment_text_class_parents = $(this).parents('.comment-form.media');
        if (val != "") {
            $(this).next('p.errors').hide();
        }
        else {
            $(this).next('p.errors').show();
        }

    });

    /*comment dom*/

    $("body").on('keyup', "textarea[name='comment_text']", function () {

        var val = $(this).val();
        var comment_text_class_parents = $(this).parents('.comment-form.media');

        if (val != "") {
            $(this).next('p.errors').hide();
        }
        else {
            $(this).next('p.errors').show();
        }

    });


    /*
     * Add Comment on your post
     * */


    $("body").on('click', '.comment_', function () {


        var commentable_id = $(this).parents('.data_this').attr('data-id');
        var class_name = $(this).parents('.data_this').attr('data-class');
        var comment_text = $(this).parents('.comment-form.media').find('.comment_text').val();
        var comment_text_class = $(this).parents('.comment-form.media');
        var hhhhh1 = $(".avatar.profile_change_append").attr('src');
        var is_shared = $(this).parents('.data_this').attr('data-is-shared');


        $.ajax({
            type: "POST",
            url: "/parse/comments",
            data: {
                "commentable_id": commentable_id,
                "comment_text": comment_text,
                "is_shared": is_shared
            },
            beforeSend: function () {
                $(comment_text_class).next('.comment_').attr('disabled', 'disabled');
            },

            success: function (data) {
                $(comment_text_class).next('.comment_').removeAttr('disabled');
                if (data.errors) {

                    if (data.errors.comment_text != null && data.errors.comment_text != "" && data.errors.comment_text != undefined) {
                        $(comment_text_class).find('.comment_text').next('p.errors').show().html(data.errors.comment_text);
                    }
                }
                else {

                    if (data.return == 'true') {


                        $(comment_text_class).find('.comment_text').val("");

                        /*image profile url*/
                        var variable2 = hhhhh1.substring(0, 5);

                        if (variable2 == 'https') {
                            var image_urll = data.user.profile;
                        }
                        else {
                            var image_urll = base_url + data.user.profile;
                        }


                        if (data.user.first_name != null && data.user.first_name != null) {
                            var full_name = data.user.first_name + " " + data.user.last_name;
                        } else if (data.user.name != null) {
                            var full_name = data.user.name;
                        }

                        /*uc first in jquery*/

                        var full_name = full_name.toLowerCase().replace(/\b[a-z]/g, function (letter) {
                            return letter.toUpperCase();
                        });


                        /*comment count*/
                        $('.' + class_name).find('.comment_count').html(data.comment_count + " " + "Comments");


                        var comment_li_last_insert = '<li class="this' + data.comment.id + '  comment_li comment" data-post-id="' + data.comment.commentable_id + '" data-class="this' + data.comment.id + '" data-id="' + data.comment.id + '" data-type="comments">\n' +
                            '                                    <div class="post__author author vcard inline-items comment">\n' +
                            '                                        <img src="' + image_urll + '" class="profile_change_append" alt="">\n' +
                            '                                        <div class="author-date">\n' +
                            '                                            <a class="h6 post__author-name fn" href="' + base_url + 'profile">' + full_name + ' </a>\n' +
                            '                                            <div class="post__date">\n' +
                            '                                                <time class="published" datetime="2017-03-24T18:18">\n' +
                            '                                                    ' + data.created_at + '\n' +
                            '                                                </time>\n' +
                            '                                            </div>\n' +
                            '                                        </div>\n' +
                            '                                        <div class="more">\n' +
                            '<svg class="olymp-three-dots-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="' + base_url + 'assets/icons/icons.svg#olymp-three-dots-icon"></use></svg><ul class="more-dropdown"><li><a href="javascript:void(0)" class="delete_post_comment">Delete</a></li></ul>\n' +
                            '                                        </div>\n' +
                            '                                    </div>\n' +
                            '                                   \n' +
                            '                                   <p class="break-word-text"> ' + data.comment.body + '</p>\n' +
                            '                                    \n' +
                            '                                    <a href="javascript:void(0)" class="post-add-icon inline-items like_comment  hk_like">\n' +
                            '                                        <i class="fa fa-caret-up"></i>\n' +
                            '                                    </a>\n' +
                            '                                        <span class="like-comment uses_like_comments pointer hk-margin hk_like">0 Like</span>\n' +

                            '                                </li>';
                        var li_length = $('.' + class_name + ' ul.comments-list li').length;
                        console.log(li_length);
                        if (li_length == 0) {

                            $('.' + class_name).find('.comments-list.hello').html(comment_li_last_insert);

                        }
                        else {
                            $('.' + class_name).find('.comments-list.hello.comment-li li.comment:nth-last-child(1)').after(comment_li_last_insert);


                        }
                        //save notification on firebase
                        var to_notification_id = data.post.user_id;
                        var name = "";
                        if (data.comment.user.first_name != null && data.comment.user.last_name != null) {
                            name = data.comment.user.first_name + " " + data.comment.user.last_name;
                        } else {
                            name = data.comment.user.name;
                        }

                        var dataToSend = {
                            from_user: {
                                id: data.comment.user.id,
                                email: data.comment.user.email,
                                name: name,
                                username: data.comment.user.user_name,
                            },
                            post: {
                                id: data.post.id,
                                type: data.post.type,
                                slug: data.post.slug
                            },
                            body: "commented on your post",
                            type: "comment",
                            created_at: new Date().getTime(),
                        };

                        saveNotification(to_notification_id, dataToSend);
                    } else if (data.return == 'false') {
                        console.log("something went wrong.");
                    }
                }
            },
            error: function (xhr, statusText, errorThrown) {
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops!", "Something went wrong", "error");
                }
            }


        });

    });

    /*search user*/

    $(".search_friend").on('keyup', function () {
        var search_type = $(this).attr('data-search_type');
        var user_id = $(this).attr('data-user_id');
        var val_name = $(this).val();
        if (val_name.length > 1) {
            $.ajax({
                type: "POST",
                url: "/parse/search-follow-friend",
                data: {"search_type": search_type, "user_id": user_id, "val_name": val_name},
                success: function (data) {
                    $('.follow-search-data.php').hide();
                    $('.follow-search-data.js').show().html(data);
                },
                error: function (xhr, statusText, errorThrown) {
                    if (xhr.status == '401') {
                        window.location.href = base_url + 'login'; //Will take you to login.
                    } else {
                        swal("Oops!", "Something went wrong", "error");
                    }
                }
            });

        } else {
            $('.follow-search-data.php').show();
            $('.follow-search-data.js').hide();
        }
    });


    $("body").on('click', '.hentry.post strong.title-post,.hentry.post .image_frame ,.hentry.post table.table.table-condensed ,.more-comments-post', function () {
        var thisParentsClass = $(this).parents('.data_this');
        var thisPost_id = $(thisParentsClass).attr('data-id');
        var thisPost_slug = $(thisParentsClass).attr('data-post_slug');
        var is_shared = $(thisParentsClass).attr('data-is-shared');
        var usersPostId = $(thisParentsClass).attr('data-users_post_id');


        $.ajax({
            type: "POST",
            url: "/parse/post-view",
            data: {
                "post_id": thisPost_id,
                "post_slug": thisPost_slug,
                "is_shared": is_shared,
                "usersPostId": usersPostId
            },

            beforeSend: function () {
                NProgress.start();
            },
            success: function (data) {
                NProgress.done();
                NProgress.remove();
                $(".PostData_").html(data);

                $('#socialModal').modal('show');
            },
            error: function (xhr, statusText, errorThrown) {
                NProgress.done();
                NProgress.remove();
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops!", "Something went wrong", "error");
                }
            }
        });


    });


    $(".counter_text").on('keyup', function () {
        var val = $(this).val();
        var maxlenght = $(this).attr('maxlength');
        var remaning = maxlenght - val.length;
        var showWords = maxlenght + '/' + remaning;

        $(this).next('p.errors').next('p.errors_counter').show().html(showWords);
    });


    // $(function () {

    $("#geocomplete").geocomplete({details: "form"})
        .bind("geocode:result", function (event, result) {
            $.log("Result: " + result.formatted_address);
        })
        .bind("geocode:error", function (event, status) {
            $.log("ERROR: " + status);
        })
        .bind("geocode:multiple", function (event, results) {
            $.log("Multiple: " + results.length + " results found");
        });

    $("#find").click(function () {
        $("#geocomplete").trigger("geocode");
    });
    // });


    /*
     Function to add likes on comments
     */

    $("body").on("click", ".like_comment", function () {
        var likeable_id = $(this).parents('.comment_li').attr('data-id');
        var likeable_type = $(this).parents('.comment_li').attr('data-type');
        var class_name = $(this).parents('.comment_li').attr('data-class');
        $.ajax({
            type: "POST",
            url: "/parse/like",
            data: {"likeable_id": likeable_id, "likeable_type": likeable_type},

            success: function (data) {
                if (data.return == 'true') {
                    $('.' + class_name).find('span.like-comment').html(data.count + ' ' + 'Like');
                    $('.' + class_name).find('.hk_like').addClass('like_color');

                    //Add notification to firebase on like for comment
                    var to_notification_id = data.post.user_id;

                    var name = "";

                    if (data.from_user.first_name != null && data.from_user.last_name != null) {
                        name = data.from_user.first_name + " " + data.from_user.last_name;
                    } else {
                        name = data.from_user.name;
                    }

                    //data
                    var dataToPush = {
                        from_user: {
                            id: data.from_user.id,
                            email: data.from_user.email,
                            name: name,
                            username: data.from_user.user_name
                        },
                        post: {
                            id: data.post.id,
                            type: data.post.users_post.type,
                            slug: data.post.users_post.slug,
                        },
                        body: "liked your comment '" + data.post.body + "'",
                        type: "comment_like",
                        created_at: new Date().getTime(),
                    };

                    saveNotification(to_notification_id, dataToPush);
                } else {
                    $('.' + class_name).find('span.like-comment').html(data.count + ' ' + 'Like');
                    $('.' + class_name).find('.hk_like').removeClass('like_color');

                }
            },
            error: function (xhr, statusText, errorThrown) {
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops!", "Something went wrong", "error");
                }
            }
        });

    });


    /*croping profile image*/

    $(".author-thumb.loggedIn").click(function () {

        $('#myModalChangeProfile').modal('show');

        var image = $(".profile_change.profile_change_append").attr('src');


        $(".profile_image_append_on_model").attr('src', image).show();


    });

    var $cropping_profile_change = $('.demo_change_profile').croppie({
        url: '',
        viewport: {
            width: 150,
            height: 150
        }
    });

    $('#upload_change_profile').on('change', function () {
        readFile(this, 'demo_change_profile');
        $(".demo_change_profile").show();
        $(".profile_image_append_on_model").hide();
    });

    $('#cropResult_change_profile').click(function (ev) {

        var val = $('#upload_change_profile').val();
        if (val != "") {
            $cropping_profile_change.croppie('result', {
                type: 'base64'
            }).then(function (resp) {
                console.log(resp);

                $.ajax({
                    type: "POST",
                    url: "/parse/change-profile",
                    data: {"profile_image": resp},
                    beforeSend: function () {
                        $("#spinner").show();

                    },
                    success: function (data) {
                        $("#spinner").hide();
                        $("#myModalChangeProfile").modal('hide');
                        $(".profile_change_append").attr('src', base_url + data.profile_image)
                        $("#upload_change_profile").val("");
                        $(".demo_change_profile").hide();

                    },
                    error: function (xhr, statusText, errorThrown) {
                        $("#spinner").hide();
                        if (xhr.status == '401') {
                            window.location.href = base_url + 'login'; //Will take you to login.
                        } else {
                            swal("Oops!", "Something went wrong", "error");
                        }
                    }
                });


            });
        }
    });

    $("#cropCancel_change_profile").click(function () {
        $("#myModalChangeProfile").modal('hide');
        $("#upload_change_profile").val("");
        $(".demo_change_profile").hide();
    });


    /*croppin article banner*/

    $(".cropping_banner_article_open").click(function () {
        $("#cropBanner_article").modal('show');
    });

    var $cropping_banner_article = $('.demo_cropping_banner_article').croppie({
        url: '',
        viewport: {
            width: 700,
            height: 230
        }
    });

    $('#upload_cropping_banner_article').on('change', function () {
        readFile(this, 'demo_cropping_banner_article');
        $(".help-block.banner_image").hide();
    });

    $('#cropResult_cropping_banner_article').click(function (ev) {

        var val = $('#upload_cropping_banner_article').val();
        if (val != "") {
            $cropping_banner_article.croppie('result', {
                type: 'base64'
            }).then(function (resp) {
                console.log(resp);
                $("#cropBanner_article").modal('hide');
                $("#target_image_cropper").attr('src', resp).show();
                $("#image_val").val(resp);
            });
        }
    });

    $("#cropCancel_cropping_banner_article").click(function () {

        $("#cropBanner_article").modal('hide');
        $("#upload_cropping_banner_article").val("");
        removeImageFromCroper("demo_cropping_banner_article");
        $("#target_image_cropper").removeAttr('src').hide();
        $("#image_val").val("");


    });


    /*crapping banner design*/
    $(".cropping_banner_open").click(function () {
        $("#cropBanner_design").modal('show');
        $("#designPostModal").modal('hide');
    });

    var $cropping_banner_design = $('.demo_cropping_banner_design').croppie({
        url: '',
        viewport: {
            width: 700,
            height: 230
        }
    });


    $('#upload_cropping_banner_design').on('change', function () {
        readFile(this, 'demo_cropping_banner_design');
        $(".src_banner_image").hide();
    });

    $('#cropResult_cropping_banner_design').click(function (ev) {

        var val = $('#upload_cropping_banner_design').val();
        if (val != "") {
            $cropping_banner_design.croppie('result', {
                type: 'canvas',
                size: 'original'
            }).then(function (resp) {
                //console.log(resp);
                //console.log(resp);
                $("#cropBanner_design").modal('hide');

                $("#target_image_cropper").attr('src', resp).show();
                $("#image_val").val(resp);
                $('.design_post.helo').click();
                $(".remove_image").show();
            });
        }
    });

    $("#cropCancel_cropping_banner_design").click(function () {

        $("#cropBanner_design").modal('hide');
        $("#upload_cropping_banner_design").val("");
        removeImageFromCroper("demo_cropping_banner_design");
        $("#target_image_cropper").removeAttr('src').hide();
        $("#image_val").val("");
        $('.design_post.helo').click();

    });


    /*image craping*/

    $("#cropCancel").click(function () {
        $('#cropModal').modal('hide');
        $("#cropBanner").modal('hide');
        $(".target_image_cropper").attr('src', '');
        $("#upload").val("");
        $("#image_val").val("");
        removeImageFromCroper("demo");
    });

    /*post edit status*/

    /*image open*/


    /*image open*/

    $(".image_icon_open_status_edit").click(function () {
        $('#cropModal').modal('show');

        var image = $("#image_val").val();

        $("#cropModal").find('img.cr-image').attr('src', image);


    });

    $(".image_icon_open").click(function () {
        $('#cropModal').modal('show');

        var image = $("#image_val").val();

        $("#upload").val(image)


        /*removeImageFromCroper("demo");*/
    });


    var $helo = $('.demo').croppie({
        url: '',
        viewport: {
            width: 600,
            height: 400
        }
    });


    $('#upload').on('change', function () {
        readFile(this, 'demo');
    });


    $('#cropResult').click(function (ev) {

        var val = $('#upload').val();
        if (val != "") {
            $helo.croppie('result', {
                type: 'base64'
            }).then(function (resp) {
                console.log(resp);
                $('#cropModal').modal('hide');
                $("#cropBanner").modal('hide');
                $("#designPostModal").modal('show');
                $("#target_image_cropper").attr('src', resp).show();
                $("#image_val").val(resp);

                //removeImageFromCroper("demo");
                $(".remove_image").show();
            });
        }
    });


    function readFile(input, element) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.' + element).addClass('ready');
                $('.' + element).croppie('bind', {
                    url: e.target.result
                }).then(function () {
                    console.log('jQuery bind complete');
                });

            };
            reader.readAsDataURL(input.files[0]);
        }
        else {
            alert("Sorry - you're browser doesn't support the FileReader API");
        }
    }

    function removeImageFromCroper(element) {
        $('.' + element).croppie('bind', {
            url: ""
        }).then(function () {
            console.log('jQuery bind complete');
        });
    }


    $("body").on("keyup", "input[name='college_university[]']", function () {
        var thisElement = $(this);
        var college_university = $(this).val();
        console.log(college_university != "");
        $("input[name='college_university[]']").attr('data-after-focus', 'n');
        $(this).attr('data-after-focus', 'y');
        if (college_university.length > 1) {
            $.ajax({
                type: "POST",
                url: "/parse/college-university",
                data: {"college_university": college_university},
                success: function (data) {
                    console.log(data + "ma");
                    if (data != "") {


                        thisElement.parents('.form-group').find('.ajax_search.college.college-company').html(data);

                    }
                },
                error: function (xhr, statusText, errorThrown) {
                    /*  alert(xhr.status);*/
                    if (xhr.status == '401') {
                        window.location.href = base_url + 'login'; //Will take you to login.
                    }
                }
            });
        } else {
            thisElement.parents('.form-group ').find('.ajax_search.college.college-company').html("");
        }

    });

    $("body").on("keyup", "input[name='company_firm_or_college_university[]']", function () {
        var thisElement = $(this);
        $("input[name='company_firm_or_college_university[]']").attr('data-after-focus', 'n');
        $(this).attr('data-after-focus', 'y');
        var company_firm_or_college_university = $(this).val();
        if (company_firm_or_college_university.length > 1) {
            $.ajax({
                type: "POST",
                url: "/parse/company-firm",
                data: {"company_firm_or_college_university": company_firm_or_college_university},
                success: function (data) {
                    if (data != "") {
                        thisElement.parents('.form-group').find('.ajax_search.college.college-company').html(data);
                    }
                },
                error: function (xhr, statusText, errorThrown) {
                    /*  alert(xhr.status);*/
                    if (xhr.status == '401') {
                        window.location.href = base_url + 'login'; //Will take you to login.
                    } else {
                        swal("Oops!", "Something went wrong", "error");
                    }
                }
            });
        } else {
            thisElement.parents('.form-group ').find('.ajax_search.college.college-company').html("");
        }

    });

    $('body').click(function (evt) {
        if (!$(evt.target).is("input[name='college_university[]'],.ajax_search.college.college-company,.ajax_search.college.college-company li")) {
            $('.ajax_search.college.college-company').html("");
        }
    });

    $("body").on("click", "a.college_li_data", function () {
        var val = $(this).attr('data-college-name');
        var type = $(this).attr('data-type');
        var id = $(this).attr('data-id');
        $(this).parents('.form-group').find('input.form-control').val(val);
        $(this).parents('.form-group').find('input.type').val(type);
        $(this).parents('.form-group').find('input.id').val(id);

    });

    $("body").on("click", ".add_college", function () {
        $('#educationAddCollege').modal('show');
    });
    $("body").on("click", ".educationAddCollegeFeedSave", function () {
        var name = $("input[name='feed_college_name']").val();
        var email = $("input[name='feed_college_email']").val();
        var mobile = $("input[name='feed_college_mobile']").val();
        var type = $(this).attr('data-form-type');
        var table_primary_id = $('.form-group').find("input[data-after-focus='y']").attr('data-professionaldetail-id');

        $.ajax({
            type: "POST",
            url: "/parse/add-college-company-feed",
            data: {
                "feed_college_name": name,
                "feed_college_mobile": mobile,
                "feed_college_email": email,
                'type': type,
                'table_primary_id': table_primary_id
            },
            success: function (data) {
                $('p.errors').hide();
                if (data.return == false) {
                    for (var i = 0; i < data.errors_keys.length; i++) {
                        showError(data.errors_keys[i], data.errors[data.errors_keys[i]]);
                    }
                }
                if (data.return == true) {
                    $("input[name='feed_college_name']").val("");
                    $("input[name='feed_college_email']").val("");
                    $("input[name='feed_college_mobile']").val("")
                    $('.form-group').find("input[data-after-focus='y']").val(name);
                    $('#educationAddCollege').modal('hide');
                    showSweetMessage("Successfully Saved.", 'success');
                }
            }, error: function (xhr, statusText, errorThrown) {
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops!", "Something went wrong", "error");
                }
            }
        });
    });

    //fetch notification Count
    get_user_id = $("#user_id").val();
    NProgress.start();
    fireDb.ref("notification/" + get_user_id + "/unread").on("value", function (snapshot) {
        var count = snapshot.numChildren();
        $(".notification-badge").text(count);
        if (count > 0) {
            //remove badge
            $(".notification-badge").show();
        } else {
            $(".notification-badge").hide();
        }
        NProgress.done();
    });

    //Method to save notification to firebase db
    function saveNotification(to_notification_id, data) {
        //do not send notification. if Logged in user is the person to whom notification need to be send
        console.log(data);
        var loggedin_user = $("#user_id").val();
        if (loggedin_user != to_notification_id) {
            var push = fireDb.ref("notification/" + to_notification_id + "/all").push(data);
            //save notification id to unread colum
            fireDb.ref("notification/" + to_notification_id + "/unread/" + push.key).set({"unread": push.key});
        }
    }

    //Set as featured (add to portfolio & blueprint)
    $("body").on("click", ".select_as_featured", function () {
        var post_id = $(this).attr("data-post-id");
        var is_shared = $(this).attr("data-is-shared");
        var remove_form_featured = $(this).attr('data-portfolio-remove');

        $.ajax({
            type: "POST",
            url: base_url + "parse/portfolio",
            data: {"id": post_id},
            context: $(this),
            beforeSend: function () {
                NProgress.start();
            },
            success: function (data) {
                if (data.return) {
                    //success
                    if (data.type == "add") {
                        $(this).text("Remove from Featured");
                        //add notifications to all the follower about the post is added to portfolio
                        var post_obj = {
                            id: data.post.id,
                            type: data.post.type,
                            slug: data.post.slug
                        };

                        var post_type = data.post.type;

                        //
                        var name = "";
                        if (data.user.first_name != null && data.user.last_name != null) {
                            name = data.user.first_name + " " + data.user.last_name;
                        } else {
                            name = data.user.name;
                        }

                        var from_user_obj = {
                            id: data.user.id,
                            email: data.user.email,
                            name: name,
                            username: data.user.user_name,
                        };

                        //loop through followers
                        data.followers.forEach(function (data) {

                            //add notification to firebase
                            var to_notification_id = data.from_user;
                            var dataToSend = {
                                from_user: from_user_obj,
                                post: post_obj,
                                body: "added a new " + post_type + " to his portfolio",
                                type: "portfolio",
                                created_at: new Date().getTime()
                            };

                            saveNotification(to_notification_id, dataToSend);
                        });
                        $(".count_portfolio").html(data.count_portfolio);

                    } else if (data.type == 'remove') {
                        if (remove_form_featured == 'remove_form_featured') {
                            $(".count_portfolio").html(data.count_portfolio);
                            /* window.location.reload();*/
                            $(this).parents('.photo-album-item-wrap.remove-featured').remove();

                        }
                        else {
                            $(".count_portfolio").html(data.count_portfolio);
                            $(this).text("Select as Featured");
                        }


                    }

                    swal("Success", data.message, "success");
                } else {
                    //failure
                    swal("Oops..", data.message, "error");
                }
                NProgress.done();
                NProgress.remove();
            },
            error: function (xhr, statusText, errorThrown) {
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops..", "Something went wrong.Try again later or contact support", "error");
                }
                NProgress.done();
                NProgress.remove();
            }
        });
    });

    //Delete
    $("body").on("click", ".delete_post", function () {
        var post_id = $(this).attr("data-post-id");
        var users_post_id = $(this).attr("data-users_post_id");
        var is_shared = $(this).attr("data-is-shared");

        console.log(post_id + "/" + users_post_id + "/" + is_shared);

        swal({
            title: 'Are you sure,You want to delete this post',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then(function () {
            //delete it
            $.ajax({
                type: "POST",
                url: base_url + "parse/delete-post",
                data: {"id": post_id, "is_shared": is_shared, "users_post_id": users_post_id},
                context: $(this),
                beforeSend: function () {
                    NProgress.start();
                },
                success: function (data) {
                    if (data.return) {
                        //success
                        swal({
                            text: "Post delete successfully",
                            type: "success",
                            title: "Success",
                            confirmButtonText: "ok"
                        }).then(function () {
                            window.location.reload();
                        });

                    } else {
                        //error
                        swal("Oops..", "Unable to delete post", "error");
                    }
                    NProgress.done();
                    NProgress.remove();
                },
                error: function (xhr, statusText, errorThrown) {
                    if (xhr.status == '401') {
                        window.location.href = base_url + 'login'; //Will take you to login.
                    } else {
                        swal("Oops..", "Something went wrong.Try again later or contact support", "error");
                    }
                    NProgress.done();
                    NProgress.remove();
                }
            });
        });
    });


    //Delete post comment
    $("body").on("click", ".delete_post_comment", function () {
        var post_id = $(this).parents('.comment_li').attr("data-post-id");
        var comment_id = $(this).parents('.comment_li').attr("data-id");
        var this_element = $(this);


        swal({
            title: 'Are you sure, you want to delete this comment?',
            text: " You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then(function () {
            //delete it
            $.ajax({
                type: "POST",
                url: base_url + "parse/delete-post-comment",
                data: {"id": post_id, "comment_id": comment_id},
                context: $(this),
                beforeSend: function () {
                    NProgress.start();
                },
                success: function (data) {
                    if (data.return) {
                        //success
                        // swal({
                        //     text: "Post delete successfully",
                        //     type: "success",
                        //     title: "Success",
                        //     confirmButtonText: "ok"
                        // });
                        /*.then(function(){
                         /!*window.location.reload();*!/
                         });*/
                        $(this_element).parents('.data_this').find('.comment_count').html(data.postCommentsCount);
                        $(this_element).parents("li[data-type='comments']").remove();

                    } else {
                        //error
                        swal("Oops..", "Unable to delete post", "error");
                    }
                    NProgress.done();
                    NProgress.remove();
                },
                error: function (xhr, statusText, errorThrown) {
                    if (xhr.status == '401') {
                        window.location.href = base_url + 'login'; //Will take you to login.
                    } else {
                        swal("Oops..", "Something went wrong.Try again later or contact support", "error");
                    }
                    NProgress.done();
                    NProgress.remove();
                }
            });
        });
    });

    $("body").on('click', '.launching_soon', function () {
        swal({
            title: "Feature Launching soon",
            type: "success",
        });
    });

    $(".remove_image").on("click", function () {
        $(this).hide();
        $("#target_image_cropper").attr('src', '');
        $("#image_val").val("");
        removeImageFromCroper("demo");
        removeImageFromCroper("demo_cropping_banner_design");
    });


    $("body").on('click', '.post_status_save', function () {
        var post_slug = $("#post_slug").val();
        var image = $("#image_val").val();
        var description = $("#description").val();

        $.ajax({
            type: "POST",
            url: "/parse/post-status",
            data: {"post_slug": post_slug, "image": image, "description": description},
            beforeSend: function () {
                NProgress.start();
            },
            success: function (data) {
                NProgress.done();
                NProgress.remove();
                if (data.errors) {
                    if (data.errors.description != "" && data.errors.description != null && data.errors.description != undefined) {
                        $("p.errors").html(data.errors.description).show();
                    }
                }
                else {

                    swal("Success", "Updated successfully..", "success");
                    window.location.href = base_url + 'news-feed';
                }


            },


            error: function (xhr, statusText, errorThrown) {
                NProgress.done();
                NProgress.remove();
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to Google.
                } else {
                    swal("Oops..", "Something went wrong.Try again later or contact support", "error");
                }

            }
        });
    });


    $(".post-image-remove").on("click", function () {
        var post_slug = $(this).attr('data-post_slug');

        $.ajax({
            type: "POST",
            url: "/parse/post-image-remove",
            data: {"post_slug": post_slug},
            beforeSend: function () {
                NProgress.start();
            },
            success: function (data) {
                NProgress.done();
                NProgress.remove();
                showSweetMessage('Removed Successfully!', 'success');
                $(".post-image-remove").hide();
                $(".target_image_cropper").attr('src', '');

            }
        });
    })


    //status new image upload
    $("#status_image_picker").on("change", function () {
        selectAndShowImage("#status_image_picker", "#target_image_cropper", "#image_val");
        $(".remove_image").show();
    });

    // article image upload

    $("#article_image_picker").on("change", function () {
        selectAndShowImage("#article_image_picker", "#image_target", "#image_val");
        $(".remove_image").show();
        $("#hide_image").hide();
    });
    /*status image upload*/
    $("#upload_status_image").on("change", function () {
        selectAndShowImage("#upload_status_image", "#image_target", "#image_val");
        $("#target_image_cropper").hide();
        $(".post-image-remove.pull-right.remove_icon").hide();
    });

    /*
     * skip
     * **/
    $(".skip-btn").on('click', function () {
        var path = $(this).attr('data-path');


        swal({
            title: 'Are you sure?',
            text: "You want to skip this this !",
            showCancelButton: true,
            confirmButtonText: 'Yes, Skip it!'
        }).then(function () {
            //delete it
            $.ajax({
                type: "POST",
                url: base_url + "parse/skip-btn",
                data: {},
                context: $(this),
                beforeSend: function () {
                    NProgress.start();
                },
                success: function (data) {

                    if (data.status_msg == true) {
                        //success
                        swal({
                            text: "Skiped",
                            type: "success",
                            title: "Success",
                            confirmButtonText: "ok"
                        }).then(function () {
                            window.location.href = base_url + "news-feed"; //Will take you to Google.
                        });

                        $(".btn.btn-primary.pull-right.skip-btn").hide();

                    } else if (data.status_msg == false) {
                        //error
                        swal("Oops..", "Unable to skip this", "error");
                    }
                    NProgress.done();
                    NProgress.remove();
                },
                error: function (xhr, statusText, errorThrown) {
                    if (xhr.status == '401') {
                        window.location.href = base_url + 'login'; //Will take you to login.
                    } else {
                        swal("Oops..", "Something went wrong.Try again later or contact support", "error");
                    }
                    NProgress.done();
                    NProgress.remove();
                }
            });
        });

    });


    /*invite friend*/

    $("#inviteEmail").on('keyup', function () {
        var val = $(this).val();
        if (val != "") {
            $("#inviteEmail").next('p.errors').hide();
        }
        else {
            $("#inviteEmail").next('p.errors').show().html('The email field is required.');
        }


    });

    $(".invite_friend").on("click", function () {


        var email = $("#inviteEmail").val();
        var path = $(this).attr('data-path');


        //sent it
        $.ajax({
            type: "POST",
            url: base_url + "parse/invite-friend",
            data: {"email": email},
            context: $(this),
            beforeSend: function () {
                NProgress.start();
            },
            success: function (data) {
                console.log(data.errors + "/yogesh");
                if (data.errors) {
                    if (data.errors.email != null && data.errors.email != "" && data.errors.email != undefined) {
                        $("#inviteEmail").next('p.errors').show().html(data.errors.email);
                    }
                }
                else {
                    if (data.message == true) {
                        //success
                        swal({
                            text: "Invitation has been sent to " + email,
                            type: "success",
                            title: "Success",
                            confirmButtonText: "ok"
                        }).then(function () {
                            window.location.href = base_url + path; //Will take you to Google.
                        });
                    }
                    if (data.message == false) {
                        //success
                        swal({
                            text: "Already member!",
                            type: "info",
                            title: "Oops",
                            confirmButtonText: "ok"
                        }).then(function () {
                            window.location.href = base_url + path; //Will take you to Google.
                        });
                    }

                }
                NProgress.done();
                NProgress.remove();
            },
            error: function (xhr, statusText, errorThrown) {
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops..", "Something went wrong.Try again later or contact support", "error");
                }
                NProgress.done();
                NProgress.remove();
            }
        });


    });

    $(".member_profile_image").click(function () {

        $('#member_input_file').trigger('click');
    });

    //show & hide placeholder below medium editor
    $("body").on({
        click: function () {
            $(this).parent().find(".placeholder").hide();
        },
        focus: function () {
            $(this).parent().find(".placeholder").hide();
        },
        focusout: function () {
            $(this).parent().find(".placeholder").show();
        }
    }, ".editable.medium-editor-insert-plugin");


    /*var data_message_alert = $(".data_message_alert").attr('data-message-alert');
     var data_user_type = $(".data_message_alert").attr('data-user_type');
     if(data_message_alert == 'true')
     {
     swal({
     title: 'You need to fill some basic details!',
     type: 'info',
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
     confirmButtonText: ' Ok'
     }).then(function () {
     if(data_user_type == 'work_individual')
     {
     window.location.href = base_url + 'profile/edit?simple=true'; //Will take you to profile edit sime page.
     }else if(data_user_type == 'work_architecture_firm_companies' || data_user_type == 'work_architecture_organizations' || data_user_type == 'work_architecture_college')
     {
     window.location.href = base_url + 'profile/edit'; //Will take you to profile edit.
     }
     else
     {
     swal("Oops!", "Something went wrong", "error");
     }

     });


     }*/

    /*likes on post*/

    $("body").on("click", ".uses_like", function () {

        var post_slug = $(this).parents('.data_this').attr('data-post_slug');
        var post_id = $(this).parents('.data_this').attr('data-id');
        var is_shared = $(this).parents('.data_this').attr('data-is-shared');


        $.ajax({
            type: "POST",
            url: "/parse/users-post-like",
            data: {"post_slug": post_slug, "post_id": post_id, "is_shared": is_shared},
            success: function (data) {

                $(".user-post-likes-html").html(data);
                if ($(".user-post-likes-html input.postLikesUserss").val() == 0) {

                    $(".user-post-likes-html").html("<br><p class='text-center'>No likes found for this post. Be the first one to like this post</p>");
                }
                $('#usersLikeModal').modal('show');
                $('#socialModal').modal('hide');
            }
        });
    });

    /*users comments like*/
    $("body").on('click', '.uses_like_comments', function () {
        var comment_id = $(this).parents('.comment_li.comment').attr('data-id');


        $.ajax({
            type: "POST",
            url: "/parse/users-comments-like",
            data: {"comment_id": comment_id},
            success: function (data) {

                $(".user-post-likes-html").html(data);
                if ($(".user-post-likes-html input.postLikesUserss").val() == 0) {
                    $(".user-post-likes-html").html("<br><p class='text-center'>No likes found for this post. Be the first one to like this post</p>");
                }
                $('#usersLikeModal').modal('show');
                $('#socialModal').modal('hide');
            }
        });


    });


    //share post
    $("body").on("click", ".user_post_share_", function () {
        var post_slug = $(this).parents('.data_this').attr('data-post_slug');

        swal({
            title: 'Are you sure, you want to share this post ?',
            /* text: " You won't be able to revert this!",*/
            showCancelButton: true,
            confirmButtonText: 'Yes, share it!'
        }).then(function () {
            //delete it
            $.ajax({
                type: "POST",
                url: "/parse/user-post-share",
                data: {"post_slug": post_slug},

                beforeSend: function () {
                    NProgress.start();
                },
                success: function (data) {


                    if (data.status_msg == true) {
                        //success
                        swal({
                            text: "Post shared successfully",
                            type: "success",
                            title: "Success",
                            confirmButtonText: "ok"
                        }).then(function () {
                            window.location.reload();
                        });


                        /*  $(this_element).parents("li[data-type='comments']").remove();*/

                    }
                    else if (data.status_msg == false) {
                        swal({
                            text: "Post is already shared!",
                            type: "info",
                            title: "Oops!",
                            confirmButtonText: "ok"
                        })
                    }
                    /* else {
                     //error
                     swal("Oops..", "Unable to delete post", "error");
                     }*/
                    NProgress.done();
                    NProgress.remove();
                },
                error: function (xhr, statusText, errorThrown) {
                    if (xhr.status == '401') {
                        window.location.href = base_url + 'login'; //Will take you to login.
                    } else {
                        swal("Oops..", "Something went wrong.Try again later or contact support", "error");
                    }
                    NProgress.done();
                    NProgress.remove();
                }
            });
        });
    });

    //Infinte scroll functionality
    $("#newsfeed-load-more").click(function (e) {
        e.preventDefault();
        var counter = parseInt($("#newsfeed-counter").val()) + 1;
        $.ajax({
            url: base_url + "parse/news-feed?page=" + counter,
            beforeSend: function () {
                NProgress.start();
            },
            success: function (data) {
                NProgress.done();
                NProgress.remove();
                
                if (data != "") {
                    $("#newsfeed-items-grid").append(data);
                    $("#newsfeed-counter").val(counter);
                    $(".load-more-text").hide();
                }else{
                    $(".load-more-text").show();
                    $(".load-more-text").text("No news feed found");
                }
            }
        });
    });

    $("body").on('click', '.add-comment-btn', function () {

        var this_class = $(this).attr('data-textarea-post-id');
        console.log(this_class);

        $(".inline-comment-form." + this_class + " ").find("textarea").focus();

        return false;
    });

    //Infinte whatsred
    $("#whatsred-load-more").click(function (e) {
        e.preventDefault();
        var counter = parseInt($("#whatsred-counter").val()) + 1;
        $.ajax({
            url: base_url + "parse/whats-red?page=" + counter,
            beforeSend: function () {
                NProgress.start();
            },
            success: function (data) {
                NProgress.done();
                NProgress.remove();
                if (data != "") {
                    $("#newsfeed-items-grid").append(data);
                    $("#whatsred-counter").val(counter);
                     $(".load-more-text").hide();
                }else{
                    $(".load-more-text").show();
                    $(".load-more-text").text("No more feed found");
                }
            }
        });
    });

    //Notification open on click
    $('#web_notification_triger').click(function () {
        //Fetch Notifications
        NProgress.start();
        fireDb.ref("notification/" + get_user_id + "/all").limitToLast(10).on("value", function (snapshot) {
            if (snapshot.numChildren() > 0) {
                //clear old notifications from the list
                $(".notification-list.realtime-notification").html("");
                snapshot.forEach(function (childSnapshot) {
                    var data = childSnapshot.val();
                    console.log(data);
                    if (data.type == "comment" || data.type == 'like_post' || data.type == "comment_like") {
                        var html = '<li><div class="media"><img class="author-thumb" src="' + base_url + 'profile-picture/' + data.from_user.username + '" alt="author"><div class="media-body"><div class="notification-event"><div><a href="' + base_url + '/profile/detail/' + data.from_user.username + '" class="h6 notification-friend">' + data.from_user.name + '</a> ' + data.body + ' <a href="' + base_url + 'post/post-detail/' + data.post.slug + '" class="notification-link">' + data.post.type + '</a></div><span class="notification-date"><time class="entry-date updated">' + timeDifference(new Date().getTime(), data.created_at) + '</time></span></div><div class="more"><svg class="olymp-little-delete"><use xlink:href="../assets/icons/icons.svg#olymp-little-delete"></use></svg></div></div></div></li>';
                    } else if (data.type == "follow") {
                        var html = '<li><div class="media"><img class="author-thumb" src="' + base_url + 'profile-picture/' + data.from_user.username + '" alt="author"><div class="media-body"><div class="notification-event"><div><a href="' + base_url + '/profile/detail/' + data.from_user.username + '" class="h6 notification-friend">' + data.from_user.name + '</a> ' + data.body + '</div><span class="notification-date"><time class="entry-date updated">' + timeDifference(new Date().getTime(), data.created_at) + '</time></span></div><div class="more"><svg class="olymp-little-delete"><use xlink:href="../assets/icons/icons.svg#olymp-little-delete"></use></svg></div></div></div></li>';
                    } else if (data.type == "portfolio") {
                        var html = '<li><div class="media"><img class="author-thumb" src="' + base_url + 'profile-picture/' + data.from_user.username + '" alt="author"><div class="media-body"><div class="notification-event"><div><a href="' + base_url + '/profile/detail/' + data.from_user.username + '" class="h6 notification-friend">' + data.from_user.name + '</a> ' + data.body + ' <a href="' + base_url + 'portfolio/' + data.from_user.username + '" class="notification-link">' + data.post.type + '</a></div><span class="notification-date"><time class="entry-date updated">' + timeDifference(new Date().getTime(), data.created_at) + '</time></span></div><div class="more"><svg class="olymp-little-delete"><use xlink:href="../assets/icons/icons.svg#olymp-little-delete"></use></svg></div></div></div></li>';
                    }

                    $(".notification-list.realtime-notification").prepend(html);
                });
            } else {
                $(".notification-list.realtime-notification").html("<br><p class='text-center'>No Notifications</p>");
            }
            NProgress.done();
            NProgress.remove();
        });
        $(this).find('.more-dropdown').addClass('active-more-dropdown');
    });

    //Notification close
    $('body').on('click', function (e) {
        if (!$(e.target).is(".control-icon.more,.control-icon.more i,.control-icon.more .label-avatar,.active-more-dropdown,.active-more-dropdown div,.active-more-dropdown a,.active-more-dropdown h6,.active-more-dropdown ul,.active-more-dropdown img,.active-more-dropdown li,.active-more-dropdown img,.active-more-dropdown li,.active-more-dropdown svg,.active-more-dropdown time,time.entry-date")) {
            fireDb.ref("notification/" + get_user_id + "/unread").remove();
            $('.active-more-dropdown').removeClass('active-more-dropdown');
        }
    });

    //Fetch all notification only when we are on notification page
    if (base_url + "notification" == window.location.href) {
        //get all notification for all notification page
        fireDb.ref("notification/" + get_user_id + "/all").once("value", function (snapshot) {
            if (snapshot.numChildren() > 0) {
                $(".notification-list.all-notification").html("");
                snapshot.forEach(function (childSnapshot) {
                    var data = childSnapshot.val();

                    if (data.type == "comment" || data.type == 'like_post' || data.type == "comment_like") {
                        var html = '<li><div class="author-thumb"><img src="' + base_url + 'profile-picture/' + data.from_user.username + '" alt="author"> </div><div class="notification-event"><a href="' + base_url + 'profile-picture/' + data.from_user.username + '" class="h6 notification-friend">' + data.from_user.name + '</a> ' + data.body + ' <a href="' + base_url + 'post/post-detail/' + data.post.slug + '" class="notification-link">' + data.post.type + '</a> <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">' + timeDifference(new Date().getTime(), data.created_at) + '</time></span></div><span class="notification-icon"><svg class="olymp-comments-post-icon"><use xlink:href="icons/icons.svg#olymp-comments-post-icon"></use></svg></span><div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg><svg class="olymp-little-delete"><use xlink:href="icons/icons.svg#olymp-little-delete"></use></svg></div></li>';
                    } else if (data.type == "follow") {
                        var html = '<li><div class="author-thumb"><img src="' + base_url + 'profile-picture/' + data.from_user.username + '" alt="author"> </div><div class="notification-event"><a href="' + base_url + 'profile-picture/' + data.from_user.username + '" class="h6 notification-friend">' + data.from_user.name + '</a> ' + data.body + ' <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">' + timeDifference(new Date().getTime(), data.created_at) + '</time></span></div><span class="notification-icon"><svg class="olymp-comments-post-icon"><use xlink:href="icons/icons.svg#olymp-comments-post-icon"></use></svg></span><div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg><svg class="olymp-little-delete"><use xlink:href="icons/icons.svg#olymp-little-delete"></use></svg></div></li>';
                    } else if (data.type == "portfolio") {
                        var html = '<li><div class="author-thumb"><img src="' + base_url + 'profile-picture/' + data.from_user.username + '" alt="author"> </div><div class="notification-event"><a href="' + base_url + 'profile-picture/' + data.from_user.username + '" class="h6 notification-friend">' + data.from_user.name + '</a> ' + data.body + ' <a href="' + base_url + 'portfolio/' + data.from_user.username + '" class="notification-link">' + data.post.type + '</a> <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">' + timeDifference(new Date().getTime(), data.created_at) + '</time></span></div><span class="notification-icon"><svg class="olymp-comments-post-icon"><use xlink:href="icons/icons.svg#olymp-comments-post-icon"></use></svg></span><div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg><svg class="olymp-little-delete"><use xlink:href="icons/icons.svg#olymp-little-delete"></use></svg></div></li>';
                    }

                    $(".notification-list.all-notification").prepend(html);
                });
            }
        });
    }


    /*
     * Competition
     * */

    $('body').on("click", ".remove-jury-div", function () {
        var item = $(this).attr('data-jury-index');
        $(".jury-div-" + item).remove();
    });


    $("#jury-add-more").click(function () {
        var index = $('.jury-div').length + 1;
        $(".jury-div").last().after(`<div class="jury-div form-group jury-div-${index}">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="text" class="form-group" placeholder="Full Name" name="jury_fullname[]">
                                                <ul class="account-settings ajax_search competitions-jury"></ul>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-group" placeholder="Firm/Company/College name" name="jury_firm_company[]">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="text" class="form-group" placeholder="Email address" name="jury_email[]">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-group" placeholder="Contact number" name="jury_contact[]">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="file" name="jury_logo[]">
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="javascript:void(0)" class="link-inverse form-text mt-3 remove-jury-div" data-jury-index="${index}"><u>Remove -</u></a>
                                            </div>
                                        </div>
                                        
                                        <input type="hidden" name="jury_id[]"/>
                                    </div>`);
    });

    $('body').on("click", ".remove-award-div", function () {

        var item = $(this).attr('data-award-index');

        $(".append-div-award-" + item).remove();

    });

    $("#add-more-awards").click(function () {

        var compeition_length = $(".awards-div").find(".compeition-append").length;


        if (compeition_length <= 2) {
            $(".awards-div").append(`<div class="col-lg-7 offset-lg-3 append-div-award">
                                    <div class="row compeition-append">
                                        <div class="col-sm-4">
                                        <select class="form-control selectpicker" data-placeholder="Award type" name="award_type[]">
                                                    <option value="1_prize">1st prize</option>
                                                    <option value="2_prize">2nd prize</option>
                                                    <option value="3_prize">3rd prize</option>                                                   
                                                </select>
                                             
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Award Amount" type="text" name="award_amount[]">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <select class="form-control selectpicker" data-placeholder="Award Currency" name="award_currency[]">
                                                    <option value="USD">USD</option>
                                                    <option value="INR">INR</option>
                                                </select>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                         <div class="col-sm-12">
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Add more details of the award/prize for the competition" type="text" name="award_extra[]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <a href="javascript:void(0)" class="link-inverse form-text mt-3 remove-award" ><u>Remove -</u></a>
                                </div>
                               `);

        } else {
            $(".awards-div").append(`<div class="col-lg-7 offset-lg-3 append-div-award">
                                    <div class="row compeition-append">
                                        <div class="col-sm-4">
                                            <input class="form-control" placeholder="Award Type" type="text" name="award_type[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Award Amount" type="text" name="award_amount[]">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <select class="form-control selectpicker" data-placeholder="Award Currency" name="award_currency[]">
                                                    <option value="USD">USD</option>
                                                    <option value="INR">INR</option>
                                                </select>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                         <div class="col-sm-12">
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Add more details of the award/prize for the competition" type="text" name="award_extra[]">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <a href="javascript:void(0)" class="link-inverse form-text mt-3 remove-award" ><u>Remove -</u></a>
                                </div>
                                `);

        }


        $('.selectpicker').selectpicker('refresh');
    });

    $("body").on("click", ".remove-award", function () {
        var parent = $(this).parents(".col-lg-2");
        parent.prev().remove();
        parent.remove();
    });

    $('#competition_type').change(function () {
        var value = $(this).val();
        if (value == 'paid') {
            $('.paid-registration').show();
            $('.payement-div').show();
        } else {
            $('.paid-registration').hide();
            $('.payement-div').hide();
            $('.row.url').hide();
        }

    });
    var is_paid = $(".is_paid").val();
    if (is_paid == 'paid') {
        $(".paid-registration").show();
    }


    $('.reg_form').click(function () {
        var type = $(this).val();
        if (type == 'oth') {
            $('.url').show();
            $('#label-warn').hide();
        } else {
            $('.url').hide();
            $('#label-warn').show();

        }
    });

    $("#form-1-submit").click(function () {
        $("#form-1").hide();
        $("#form-2").show();
        $("html, body").animate({scrollTop: 0}, "slow");
    });

    $("#add-more-registration-last-minute").click(function () {
        $(this).parent().parent().find(".registration-type-container")
            .append(`<div class="registration-type-child row form-group">
                                                <div class="col-sm-6">
                                                    <input type="text" placeholder="Registration Type" name="early_bird_registration_type[]">
                                                </div>
                                                <div class="col-sm-3">
                                                    <select class="form-control selectpicker" name="early_bird_registration_currency[]">
                                                        <option value="USD">USD</option>
                                                        <option value="INR">INR</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" placeholder="Amount" name="early_bird_registration_amount[]">
                                                </div>
                                            </div>`);

        //refresh select & date picker
        $('.selectpicker').selectpicker('refresh');

        setDatepiker($(".datepicker"));
    });

    $("#add-more-registration-advance").click(function () {
        $(this).parent().parent().find(".registration-type-container").append(`<div class="registration-type-child row form-group">
                                                <div class="col-sm-6">
                                                    <input type="text" placeholder="Registration Type" name="advance_registration_type[]">
                                                </div>
                                                <div class="col-sm-3">
                                                    <select class="form-control selectpicker" name="advance_registration_currency[]">
                                                        <option value="USD">USD</option>
                                                        <option value="INR">INR</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" placeholder="Amount" name="advance_registration_amount[]">
                                                </div>
                                            </div>`);

        //refresh select & date picker
        $('.selectpicker').selectpicker('refresh');

        setDatepiker($(".datepicker"));
    });

    $("#add-more-registration-early-bird").click(function () {
        $(this).parent().parent().find(".registration-type-container").append(`<div class="registration-type-child row form-group">
                                                <div class="col-sm-6">
                                                    <input type="text" placeholder="Registration Type" name="early_bird_registration_type[]">
                                                </div>
                                                <div class="col-sm-3">
                                                    <select class="form-control selectpicker" name="early_bird_registration_currency[]">
                                                        <option value="USD">USD</option>
                                                        <option value="INR">INR</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" placeholder="Amount" name="early_bird_registration_amount[]">
                                                </div>
                                            </div>`);

        //refresh select & date picker
        $('.selectpicker').selectpicker('refresh');

        setDatepiker($(".datepicker"));
    });


    $("#add-more-partner").click(function () {
        $(".partners-div-container").last().after(`<div class="partners-div-container form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text" class="form-group" placeholder="Name" name="partner_name[]">
                                            <ul class="account-settings ajax_search competitions-jury competitions-partner"></ul>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-group" placeholder="Website" name="partner_website[]">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text" class="form-group" placeholder="Email address" name="partner_email[]">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-group" placeholder="Contact number" name="partner_contact[]">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group mb-0 is-empty">
                                                <input type="file" name="partner_logo[]">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="javascript:void(0)" class="link-inverse form-text mt-3 remove-partner-tigger"><u>Remove -</u></a>
                                        </div>
                                    </div>
                                    <input type="hidden" name="partner_id[]">
                                    </div>`);
    });

    $("body").on("click", ".remove-partner-tigger", function () {
        $(this).parents(".partners-div-container").remove();
    });

    $("#competition_type").change(function () {
        var selected = $(this).find("option:selected").val();
    });

    $("#competition-form").submit(function (e) {
        e.preventDefault();
        var formElement = document.querySelector("#competition-form");
        var formData = new FormData(formElement);

        //comp berif & Honourable mentions medium editor
        var berif = $("#competition_brief").html().split('<div class="medium-insert-buttons"')[0];
        var honourable_mentions = $(".honourable-mentions").html().split('<div class="medium-insert-buttons"')[0];

        formData.append("competition_brief", berif);
        formData.append("honourable_mentions", honourable_mentions);

        $.ajax({
            type: "POST",
            url: base_url + "parse/competition-save",
            data: formData,
            contentType: false,
            cache: false,
            context: $(this),
            processData: false,
            beforeSend: function () {
                NProgress.start();
                $("#competition-form :input").prop("disabled", true);
            },
            success: function (data) {
                NProgress.done();
                NProgress.remove();
                $("#competition-form :input").prop("disabled", false);
                if (data.return) {
                    $(this).trigger("reset");

                    window.location = base_url + "competition/" + data.slug;
                } else {
                    //Parse alert
                    var errorkey = data.error_keys[0];
                    swal(
                        'Oops!',
                        data.error[errorkey][0],
                        'error'
                    );
                }
            },
            error: function () {
                NProgress.done();
                NProgress.remove();
                $("#competition-form :input").prop("disabled", false);
                swal("Oops!", "Something went wrong. Try again later", "error");
            }
        });
    });


    /*competition edit*/

    $("#competition-form-edit").submit(function (e) {

        e.preventDefault();
        var formElement = document.querySelector("#competition-form-edit");
        var formData = new FormData(formElement);

        //comp berif & Honourable mentions medium editor
        var berif = $("#competition_brief").html().split('<div class="medium-insert-buttons"')[0];
        var honourable_mentions = $(".honourable-mentions").html().split('<div class="medium-insert-buttons"')[0];

        formData.append("competition_brief", berif);
        formData.append("honourable_mentions", honourable_mentions);

        $.ajax({
            type: "POST",
            url: base_url + "parse/competition-save",
            data: formData,
            contentType: false,
            cache: false,
            context: $(this),
            processData: false,
            beforeSend: function () {
                NProgress.start();
                $("#competition-form :input").prop("disabled", true);
            },
            success: function (data) {
                NProgress.done();
                NProgress.remove();
                $("#competition-form :input").prop("disabled", false);
                if (data.return) {
                    $(this).trigger("reset");

                    window.location = base_url + "competition/" + data.slug;
                } else {
                    //Parse alert
                    var errorkey = data.error_keys[0];
                    swal(
                        'Oops!',
                        data.error[errorkey][0],
                        'error'
                    );
                }
            },
            error: function () {
                NProgress.done();
                NProgress.remove();
                $("#competition-form :input").prop("disabled", false);
                swal("Oops!", "Something went wrong. Try again later", "error");
            }
        });
    });

    $("#form-back").click(function () {
        $("#form-1").show();
        $("#form-2").hide();
        $("html, body").animate({scrollTop: 0}, "slow");
    });

    $("body").on("keyup", "input[name='jury_fullname[]']", function () {
        var jory_name = $(this).val();
        var this_element = $(this);

        if (jory_name.length > 0) {
            $.ajax({
                type: "POST",
                url: base_url + "parse/search/competitions-jury",
                data: {"search": jory_name},
                success: function (data) {
                    this_element
                        .next('.account-settings.ajax_search.competitions-jury')
                        .html(data);
                }
            });
        } else {
            this_element
                .next('.account-settings.ajax_search.competitions-jury')
                .html("");
        }
    });

    $("body").on("click", ".add_Jury", function () {
        var jury_id = $(this).attr("data-jury-id");
        var jury_email = $(this).attr("data-jury-email");
        var jury_mobile = $(this).attr("data-jury-mobile");
        var jury_name = $(this).attr("data-jury-fullname");

        var parents = $(this).parents(".jury-div.form-group");
        //Add jury_id
        parents.find('input[type="hidden"][name="jury_id[]"]').val(jury_id);

        // //Hide Inputs
        // parents.find('input[name="jury_fullname[]"]').val(jury_name).prop("disabled", true);
        // parents.find('input[name="jury_email[]"]').val(jury_email).prop("disabled", true);
        // parents.find('input[name="jury_contact[]"]').val(jury_mobile).prop("disabled", true);
        // parents.find('input[name="jury_firm_company[]"]').val("").prop("disabled", true);
        // parents.find('input[name="jury_logo[]"]').val("").prop("disabled", true);
        parents.find('input[name="jury_fullname[]"]').val(jury_name);
        parents.find('input[name="jury_email[]"]').val(jury_email);
        parents.find('input[name="jury_contact[]"]').val(jury_mobile);
        parents.find('input[name="jury_firm_company[]"]').val("");
        parents.find('input[name="jury_logo[]"]').val("");

        $(".account-settings.ajax_search.competitions-jury").html("");
    });

    $("body").on("keyup", "input[name='partner_name[]']", function () {
        var jory_name = $(this).val();
        var this_element = $(this);

        if (jory_name.length > 0) {
            $.ajax({
                type: "POST",
                url: base_url + "parse/search/competitions-partner",
                data: {"search": jory_name},
                success: function (data) {
                    this_element
                        .next('.account-settings.ajax_search.competitions-jury.competitions-partner')
                        .html(data);
                }
            });
        } else {
            this_element
                .next('.account-settings.ajax_search.competitions-jury.competitions-partner')
                .html("");
        }
    });

    $("body").on("focusin", "input", function () {
        if ($(this).attr('name') != 'partner_name[]') {
            $("input[name='partner_name[]']").next('.account-settings.ajax_search.competitions-jury.competitions-partner')
                .html("");
        }
        console.log($(this).attr('name'));
        if ($(this).attr('name') != 'jury_fullname[]') {
            $("input[name='jury_fullname[]']").next('.account-settings.ajax_search.competitions-jury')
                .html("");
        }
    });


    $("body").on("click", ".add_partner", function () {
        var jury_id = $(this).attr("data-partner-id");
        var jury_email = $(this).attr("data-partner-email");
        var jury_mobile = $(this).attr("data-partner-mobile");
        var jury_name = $(this).attr("data-partner-fullname");
        var parents = $(this).parents(".partners-div-container.form-group");
        //Add jury_id
        parents.find('input[type="hidden"][name="partner_id[]"]').val(jury_id);

        //Hide Inputs
        // parents.find('input[name="partner_name[]"]').val(jury_name).prop("disabled", true);
        // parents.find('input[name="partner_website[]"]').prop("disabled", true);
        // parents.find('input[name="partner_email[]"]').val(jury_email).prop("disabled", true);
        // parents.find('input[name="partner_contact[]"]').val(jury_mobile).prop("disabled", true);
        // parents.find('input[name="partner_logo[]"]').val("").prop("disabled", true);

        parents.find('input[name="partner_name[]"]').val(jury_name);
        parents.find('input[name="partner_website[]"]');
        parents.find('input[name="partner_email[]"]').val(jury_email);
        parents.find('input[name="partner_contact[]"]').val(jury_mobile);
        parents.find('input[name="partner_logo[]"]').val("");


        $(".account-settings.ajax_search.competitions-jury.competitions-partner").html("");
    });

    /*add-more-attach-documents*/
    $("body").on("click", ".attach-more-documents", function () {
        var html_element = '<br/> <div class="row attach-documents_remove">\n' +
            '                                            <div class="col-sm-6">\n' +
            '                                                <div class="form-group mb-0 is-empty">\n' +
            '                                                    <input type="file" name="attach_documents[]">\n' +
            '                                                </div>\n' +
            '                                            </div>\n' +
            '                                            <div class="col-sm-6">\n' +
            '                                                <a href="javascript:void(0)" class="link-inverse form-text mt-3 attach-documents-remove" ><u>Remove -</u></a>\n' +
            '                                            </div>\n' +
            '                                        </div>';


        $('div.attach-documents_append div.row:nth-child(1)').after(html_element);

    });

    $("body").on("click", ".attach-documents-remove", function () {
        $(this).parents('.attach-documents_remove').remove();
    });

    /*
     * Competition wall
     *
     * */
    $("#user_competition_wall_form").submit(function (e) {
        e.preventDefault();
        var form = document.querySelector("#user_competition_wall_form");
        var formData = new FormData(form);

        $.ajax({
            type: "POST",
            url: base_url + "parse/competition/wall/question/add",
            data: formData,
            contentType: false,
            cache: false,
            context: $(this),
            processData: false,
            beforeSend: function () {
                NProgress.start();
                $("#user_competition_wall_form :input").prop("disabled", true);
            },
            success: function (data) {
                NProgress.done();
                NProgress.remove();

                $("#user_competition_wall_form :input").prop("disabled", false);

                console.log(data);
                if (data.return) {
                    $(this).trigger("reset");

                    window.location.reload();
                } else {
                    //Parse alert
                    var errorkey = data.errors_keys[0];
                    swal(
                        'Oops!',
                        data.errors[errorkey][0],
                        'error'
                    );
                }
            },
            error: function () {
                NProgress.done();
                NProgress.remove();
                $("#user_competition_wall_form :input").prop("disabled", false);
                swal("Oops!", "Something went wrong. Try again later", "error");
            }
        });
    });

    $("#user_competition_ann_form").submit(function (e) {
        e.preventDefault();
        var form = document.querySelector("#user_competition_ann_form");
        var formData = new FormData(form);

        $.ajax({
            type: "POST",
            url: base_url + "parse/competition/wall/announcement/add",
            data: formData,
            contentType: false,
            cache: false,
            context: $(this),
            processData: false,
            beforeSend: function () {
                NProgress.start();
                $("#user_competition_ann_form :input").prop("disabled", true);
            },
            success: function (data) {
                NProgress.done();
                NProgress.remove();

                $("#user_competition_ann_form :input").prop("disabled", false);
                if (data.return) {
                    $(this).trigger("reset");

                    window.location.reload();
                } else {
                    //Parse alert
                    var errorkey = data.errors_keys[0];
                    swal(
                        'Oops!',
                        data.errors[errorkey][0],
                        'error'
                    );
                }
            },
            error: function () {
                NProgress.done();
                NProgress.remove();
                $("#user_competition_ann_form :input").prop("disabled", false);
                swal("Oops!", "Something went wrong. Try again later", "error");
            }
        });
    });

    $(".comment-form.media").submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            context: $(this),
            url: base_url + "parse/competition/wall/question/comment/add",
            data: $(this).serialize(),
            beforeSend: function () {
                NProgress.start();
            },
            success: function (data) {
                NProgress.done();
                NProgress.remove();

                console.log(data);
                if (data.return) {

                    var fullname;
                    if (data.data.user.first_name == null && data.data.user.last_name == null) {
                        fullname = data.data.user.name;
                    } else {
                        fullname = data.data.user.first_name + " " + data.data.user.last_name;
                    }

                    $(this).parents(".collapse.show").find(".comments-list").append(`<li><div class="post__author author vcard inline-items">
                                                    <img src="${base_url + data.data.user.profile}" alt="">

                                                    <div class="author-date">
                                                        <a class="h6 post__author-name fn"
                                                           href="${base_url}profile/detail/${data.data.user.slug}">${fullname}</a>
                                                        <div class="post__date">
                                                            <time class="published" datetime="2017-03-24T18:18">
                                                                just now
                                                            </time>
                                                        </div>
                                                    </div>

                                                    <a href="#" class="more">
                                                        <svg class="olymp-three-dots-icon">
                                                            <use xlink:href="{{asset('/assets/icons/icons.svg#olymp-three-dots-icon')}}"></use>
                                                        </svg>
                                                    </a>

                                                </div>

                                                <p>${data.data.comment}</p>
                                            </li>`);

                    $(this).trigger("reset");
                } else {
                    //Parse alert
                    var errorkey = data.errors_keys[0];
                    swal(
                        'Oops!',
                        data.errors[errorkey][0],
                        'error'
                    );
                }
            },
            error: function () {
                NProgress.done();
                NProgress.remove();
                swal("Oops!", "Something went wrong. Try again later", "error");
            }
        });
    });

    $('.edit-question').click(function () {
        var question_id = $(this).attr('data-id-qus');
        var qus_text = $(this).attr('data-question');
        var subject = $(this).attr('data-subject-qus');


        swal({
            title: 'Edit the question',
            html: '<div><input class="swal2-input" type="text" id="sweet_qus" value="' + qus_text + '"></div>',
            showCancelButton: true,
            confirmButtonText: 'Submit',
            showLoaderOnConfirm: true,
            preConfirm: function (text) {
                return new Promise(function (resolve, reject) {
                    setTimeout(function () {
                        if (text == '') {
                            swal.showValidationError('Please fill the question.')
                        }
                        resolve()
                    }, 2000)
                })
            },
            allowOutsideClick: false
        }).then(function (text) {
            var new_description = $('#sweet_qus').val();
            $.ajax({
                url: base_url + "parse/competition/wall/question/update",
                type: "POST",
                context: $(this),
                data: {
                    subject: subject,
                    description: new_description,
                    question_id: question_id
                },
                success: function (resp) {
                    swal("Done!", "It was succesfully updated!", "success");
                    window.location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal("Error updated!", "Please try again", "error");
                }
            });

        })

    });

    $('.delete-question').click(function () {
        var question_id = $(this).attr('data-delete-id');

        $.ajax({
            url: base_url + "parse/competition/wall/question/delete",
            type: "POST",
            context: $(this),
            data: {
                question_id: question_id
            },
            success: function (resp) {
                swal("Done!", "It was succesfully deleted!", "success");
                window.location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error deleted!", "Please try again", "error");
            }
        });


    })

    $('.edit-comment').click(function () {
        var comment_id = $(this).attr('data-id-comment');
        var comment_text = $(this).attr('data-comment');

        swal({
            title: 'Edit comment',
            html: '<div><input class="swal2-input" type="text" id="sweet_comment" value="' + comment_text + '"></div>',
            showCancelButton: true,
            confirmButtonText: 'Submit',
            showLoaderOnConfirm: true,
            preConfirm: function (text) {
                return new Promise(function (resolve, reject) {
                    setTimeout(function () {
                        if (text == '') {
                            swal.showValidationError('Please fill the comment.')
                        }
                        resolve()
                    }, 2000)
                })
            },
            allowOutsideClick: false
        }).then(function (text) {
            var new_comment = $('#sweet_comment').val();

            $.ajax({
                url: base_url + "parse/competition/wall/question/comment/update",
                type: "POST",
                context: $(this),
                data: {
                    comment_description: new_comment,
                    comment_id: comment_id,
                },
                success: function (resp) {
                    swal("Done!", "It was succesfully updated!", "success");
                    window.location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal("Error updated!", "Please try again", "error");
                }
            });

        })

    });

    $('.delete-comment').click(function () {
        var comment_id = $(this).attr('data-delete-comment-id');
        $.ajax({
            url: base_url + "parse/competition/wall/question/comment/delete",
            type: "POST",
            context: $(this),
            data: {
                comment_id: comment_id
            },
            success: function (resp) {
                swal("Done!", "It was succesfully deleted!", "success");
                window.location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error deleted!", "Please try again", "error");
            }
        });


    })

    $('.more-comments').click(function () {
        if ($(this).hasClass('hide-comments')) {
            $('.comments-list').css({"max-height": "270px", "overflow-y": "hidden"});
            $(this).text('View more comments + ');
            $(this).removeClass("hide-comments");
        } else {
            $('.comments-list').css({"max-height": "100%", "transition": "max-height 1s"});
            $(this).text('less comments - ');
            $(this).addClass("hide-comments");

        }
    });

    /*
     *
     * Competition Participation
     * */

    $("body").on("keyup", "input[name='participate[]']", function () {
        var jory_name = $(this).val();
        var this_element = $(this);

        if (jory_name.length > 0) {
            $.ajax({
                type: "POST",
                url: base_url + "parse/search/participate",
                data: {"search": jory_name},
                success: function (data) {
                    this_element
                        .next('.people-search')
                        .html(data);
                }
            });
        } else {
            this_element
                .next('.people-search')
                .html("");
        }
    });

    $("body").on("click", ".add_participate", function () {
        var participate_id = $(this).attr("data-participate-id");
        var participate_name = $(this).attr("data-participate-fullname");

        if ($(this).parents('.form-group.label-floating').find("input[name='participate_id[]']").html() != undefined) {
            $(this).parents('.form-group.label-floating').find("input[name='participate[]']").val(participate_name);
            $(this).parents('.form-group.label-floating').find("input[name='participate_id[]']").val(participate_id);
        } else {
            $(this).parents('.form-group.label-floating').find("input[name='mentor[]']").val(participate_name);
            $(this).parents('.form-group.label-floating').find("input[name='mentor_id[]']").val(participate_id);
        }

        $(this).parent().html("");
    });

    /*
     * Method to call when user participate in competition button
     * */
    $('.participate_in_competition').click(function () {
        $.ajax({
            type: "POST",
            url: base_url + "parse/competition/participate-check-exist",
            data: {
                "competition_id": $("#competition_id").val()
            },
            beforeSend: function () {
                showNProgress();
            },
            success: function (data) {
                hideNProgress();
                if (data.return) {
                    $('#compition-modal').modal('show');
                } else {
                    if (data.code == "1") {
                        //fill in profile details
                        swal({
                            html: "<h4>Please complete your <a href='" + base_url + "profile/edit'>education detail</a> to participate in this competition</h4>"
                        });
                    } else {
                        swal({
                            html: "<h4>" + data.message + "</h4>"
                        });
                    }
                }
            },
            error: function (xhr, statusText, errorThrown) {
                hideNProgress();
                if (xhr.status == '401') {
                    swal({
                        text: "Please Login or Register on the platform to participate in the Competition",
                        showCancelButton: true,
                        confirmButtonText: 'Login',
                        cancelButtonText: 'Register'
                    }).then((result) => {
                        if(result){
                            window.location = base_url + "login";
                        }
                    }
                ).
                    catch((result) => {
                        if(result == "cancel"
                )
                    {
                        window.location = base_url + "register";
                    }
                })
                    ;
                } else {
                    showSomethingWentWrongAlert(xhr);
                }


            }
        });
    });

    $('#participate_btn').click(function () {
        formElementpraticpate = document.querySelector("#participate-form");
        var formData = new FormData(formElementpraticpate);

        $.ajax({
            type: "POST",
            url: base_url + "parse/post/participate-data",
            data: formData,
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,
            beforeSend: function () {
                showNProgress();
                showSpinnerLoader();
            },
            success: function (data) {
                hideNProgress();
                hideSpinnerLoader();
                if (data.return) {
                    //succes
                    swal("Hurray!", "You have successfully participated in this competition. Please submit your design", "success");

                    //hide Modal
                    $('#compition-modal').modal('hide');
                } else {
                    //error
                    var errorkey = data.errors_keys[0];
                    swal(
                        'Oops!',
                        data.errors[errorkey][0],
                        'error'
                    );
                }
            },
            error: function (xhr, statusText, errorThrown) {
                hideNProgress();
                hideSpinnerLoader();
                showSomethingWentWrongAlert(xhr);
            }

        });


    });

    /* /!*remove jory*!/
     $("body").on("click","#jury-remove" ,function(){
     alert("hhh")

     });*/

    $("body").on("keyup", "input[name='mentor[]']", function () {
        var jory_name = $(this).val();
        var this_element = $(this);

        if (jory_name.length > 0) {
            $.ajax({
                type: "POST",
                url: base_url + "parse/search/participate",
                data: {"search": jory_name},
                success: function (data) {
                    this_element
                        .next('.people-search')
                        .html(data);
                }
            });
        } else {
            this_element
                .next('.people-search')
                .html("");
        }
    });

    /*
     * Submit design in competition
     * */
    $("#submit_design_in_competition").click(function (e) {
        e.preventDefault();

        var href = $(this).attr("href");

        $.ajax({
            type: "POST",
            url: base_url + "parse/competition/participate-check-exist",
            data: {
                "competition_id": $("#competition_id").val()
            },
            beforeSend: function () {
                showNProgress();
            },
            success: function (data) {
                hideNProgress();
                if (data.code == 2) {
                    window.location = href;
                } else if (data.code == 1) {
                    swal("Oops!", data.message, "error");
                } else {
                    window.location = href;
                    //swal("Oops!", "Please first participate in this competition in order to submit design", "error");
                }
            },
            error: function (xhr, statusText, errorThrown) {
                hideNProgress();
                showSomethingWentWrongAlert(xhr);
            }
        });
    });

    /*
     *
     * Submit competition designs
     * */
    $("#design_use_sqrfactor_editor").click(function () {
        $("#design_pdf").hide();
        $("#design_editor").show();
    });

    $("#design_upload_pdf").click(function () {
        $("#design_pdf").show();
        $("#design_editor").hide();
    });

    $("#competition_submit_design").submit(function (e) {
        e.preventDefault();
        var form = document.querySelector("#competition_submit_design");
        var formData = new FormData(form);

        var body = $("#design_body").html().split('<div class="medium-insert-buttons"')[0];

        formData.append("design_body", body);

        $.ajax({
            type: "POST",
            url: base_url + "parse/competition/submission/design-save",
            data: formData,
            contentType: false,
            cache: false,
            context: $(this),
            processData: false,
            beforeSend: function () {
                $("#competition_submit_design :input").prop("disabled", true);
                showNProgress();
            },
            success: function (data) {
                hideNProgress();

                $("#competition_submit_design :input").prop("disabled", false);

                if (data.return) {
                    $(this).trigger("reset");

                    swal({
                        title: 'Hurray!',
                        text: "Your design submitted successfully",
                        type: 'success'
                    });

                } else {
                    //Parse alert
                    var errorkey = data.error_keys[0];
                    swal(
                        'Oops!',
                        data.error[errorkey][0],
                        'error'
                    );
                }
            },
            error: function (xhr) {
                hideNProgress();
                $("#competition_submit_design :input").prop("disabled", false);
                showSomethingWentWrongAlert(xhr);
            }
        });
    });


    /*competition submission design edit by manoj */

    $("#competition_submit_design_edit").submit(function (e) {
        e.preventDefault();
        var form = document.querySelector("#competition_submit_design_edit");
        var formData = new FormData(form);

        var body = $("#design_body").html().split('<div class="medium-insert-buttons"')[0];

        formData.append("design_body", body);

        $.ajax({
            type: "POST",
            url: base_url + "parse/competition/submission/design-edit",
            data: formData,
            contentType: false,
            cache: false,
            context: $(this),
            processData: false,
            beforeSend: function () {
                $("#competition_submit_design_edit :input").prop("disabled", true);
                showNProgress();
            },
            success: function (data) {
                hideNProgress();

                $("#competition_submit_design_edit :input").prop("disabled", false);

                if (data.return) {
                    $(this).trigger("reset");

                    swal({
                        title: 'Hurray!',
                        text: "Your design submitted successfully",
                        type: 'success'
                    });

                } else {
                    //Parse alert
                    var errorkey = data.error_keys[0];
                    swal(
                        'Oops!',
                        data.error[errorkey][0],
                        'error'
                    );
                }
            },
            error: function (xhr) {
                hideNProgress();
                $("#competition_submit_design_edit :input").prop("disabled", false);
                showSomethingWentWrongAlert(xhr);
            }
        });
    });

    /*
     * sort option competition submission select picker
     * */
    $("#competition_submission_selectpicker").change(function () {
        var competition_id = $("#competition_id").val();
        var type = $(this).find("option:selected").val();
        getCompetitionSubmissionHTML(competition_id, type);
    });

    /*like code by manojhacks*/
    $("body").on('click', '.submisson-like', function () {
        var like_id = $(this).attr('data-likable-id');
        $.ajax({
            type: "POST",
            context: $(this),
            url: base_url + "parse/competition/submission/like",
            data: {"like_id": like_id},
            success: function (data) {
                console.log(data['count']);
                if (data['count'] == 1 || data['count'] == 0) {
                    $(this).siblings('.like-count').text('' + data['count'] + ' Like');
                } else {
                    $(this).siblings('.like-count').text('' + data['count'] + ' Likes');
                }

                $(this).siblings('.like-count').toggleClass("like_color");
                $(this).toggleClass("like_color");
            }

        });

    });

    /*view like modal by manoj*/

    $("body").on("click", ".view-like-modal", function () {


        var post_id = $(this).attr('data-like-id');

        $.ajax({
            type: "POST",
            url: base_url + "parse/submission-post-like",
            data: {"post_id": post_id},
            success: function (data) {

                $(".user-post-likes-html").html(data);

                //console.log($(".user-post-likes-html input.postLikesUserss").val());
                if ($(".user-post-likes-html input.postLikesUserss").val() == 0 || data == 'false') {

                    $(".user-post-likes-html").html("<br><p class='text-center'>No likes found for this post. Be the first one to like this post</p>");
                }
                $('#usersLikeModal').modal('show');
                $('#socialModal').modal('hide');
            }
        });
    });

    /*modal detail competition */
    $("body").on("click", ".competitionModal-detail", function () {
        var submission_id = $(this).attr('data-submission-id');

        $.ajax({
            type: "POST",
            url: base_url + "parse/users-submission-detail",
            data: {"submission_id": submission_id},
            success: function (data) {
                if (data != 'false') {
                    $('.submission-detail').html(data);
                    $('#competitionModal').modal('show');
                } else {
                    $('.submission-detail').html("no data found");
                    $('#competitionModal').modal('show');
                }
            }
        });
    });

    /*comment reply*/
    $("body").on("click", "#comment-reply", function () {

        var submission_id = $(this).val();
        var comment_text = $('#comment-text').val();

        $.ajax({
            type: "POST",
            url: base_url + "parse/users-comment-add",
            data: {
                commentable_id: submission_id,
                body: comment_text,
            },
            success: function (data) {
                if ($('.append-comment li').html() != undefined) {
                    $('.append-comment li').first().prepend('' + data + '');
                    $('#comment-text').val("");
                } else {
                    $('.append-comment').html(data);
                    $('#comment-text').val("");
                }

            }
        });
    });

    //Don't allow user to select save code in two or more select box (Competition Results Submission)
    // $('select[name*="award_type[]"]').change(function () {
    //     // start by setting everything to enabled
    //     $('select[name*="award_type[]"] option').attr('disabled', false);

    //     // loop each select and set the selected value to disabled in all other selects
    //     $('select[name*="award_type[]"]').each(function () {
    //         var new_val = $(this);

    //         $('select[name*="award_type[]"]').not(new_val).find('option').each(function () {
    //             if ($(this).attr('value') == new_val.val())
    //                 $(this).attr('disabled', true);
    //         });
    //     });
    // });

    /*Competition Results Submission - AJAX*/
    $('#award-declare-btn').click(function () {
        var formElement = document.querySelector("#award-declare");
        var formData = new FormData(formElement);

        $.ajax({
            type: "POST",
            url: base_url + "parse/award-declare-add",
            data: formData,
            contentType: false,
            cache: false,
            context: $(this),
            processData: false,
            beforeSend: function () {
                $("#award-declare :input").prop("disabled", true);
                showNProgress();
            },
            success: function (data) {
                hideNProgress();
                $("#award-declare :input").prop("disabled", false);

                if (data.return) {
                    $("#award-declare").trigger("reset");

                    swal({
                        title: 'Success!',
                        text: "Your Declared result Successfully",
                        type: 'success'
                    });
                } else {
                    //Parse alert
                    var errorkey = data.errors_keys[0];
                    swal(
                        'Oops!',
                        data.errors[errorkey][0],
                        'error'
                    );
                }
            },
            error: function (xhr) {
                hideNProgress();
                $("#award-declare :input").prop("disabled", false);
                showSomethingWentWrongAlert(xhr);
            }
        });

    });

    /*Job apply*/
    $('#jobApply').click(function () {

        var userJobId = $('#user_job_id').val();

        swal({
            title: 'Are you sure,You want to Apply for job/internship',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonText: 'Yes, Apply it!'
        }).then(function () {
            //delete it
            $.ajax({
                type: "POST",
                url: base_url + "parse/apply-job",
                data: {"user_job_id": userJobId},
                context: $(this),
                beforeSend: function () {
                    NProgress.start();
                },
                success: function (data) {
                    if (data.return) {
                        //success
                        swal({
                            text: "You applied Successfully",
                            type: "success",
                            title: "Success",
                            confirmButtonText: "ok"
                        }).then(function () {
                            window.location.reload();
                        });

                    } else {
                        //error
                        swal("Oops..", data.message, "error");
                    }
                    NProgress.done();
                    NProgress.remove();
                },
                error: function (xhr, statusText, errorThrown) {
                    NProgress.done();
                    NProgress.remove();
                    showSomethingWentWrongAlert(xhr);
                }
            });
        });
    })
    /*view applicant*/
    $('#view-applicant').click(function () {

        $.ajax({
            type: "POST",
            url: base_url + "parse/view-applicant",
            contentType: false,
            cache: false,
            context: $(this),
            processData: false,
            success: function (data) {

                if (data.return) {
                    $('#applicant-modal').modal('show')
                    $('#applicant-detail').html(data)

                } else {
                    $('#applicant-modal').modal('show')
                    $('#applicant-detail').html(data)

                }
            },
            error: function (xhr, statusText, errorThrown) {
                hideNProgress();
                $('#applicant-modal').modal('hide')
                showSomethingWentWrongAlert(xhr);
            }
        });
    });

    $("body").on("click", ".open-input-file", function () {
        $(".file-upload").click();
    });

    /*title cover update*/
    $("body").on("click", ".title_cover_update", function () {


        var formElement = document.querySelector("#title_cover_form");
        var formData = new FormData(formElement);

        $.ajax({
            type: "POST",
            url: "/parse/title-cover-update",
            data: formData,
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,
            beforeSend: function () {
                /*$("#spinner").show();*/
            },
            success: function (data) {
                /*$("#spinner").hide();*/
                if (data.return) {
                    $("#editNameAndCover").modal('hide');

                    swal(
                        'Success',
                        'Updated successfully !',
                        'success'
                    ).then(function () {
                        location.reload();
                    });

                } else {
                    //Parse alert
                    var errorkey = data.error_keys[0];
                    swal(
                        'Oops!',
                        data.error[errorkey][0],
                        'error'
                    );
                }
            },
            error: function (xhr, statusText, errorThrown) {
                NProgress.done();
                NProgress.remove();
                showSomethingWentWrongAlert(xhr);
            }


        });
    });

    /*update jory*/
    $("body").on("click", ".Jury_update", function () {


        var formElement = document.querySelector("#Jury_update_form");
        var formData = new FormData(formElement);

        $.ajax({
            type: "POST",
            url: "/parse/Jury-update",
            data: formData,
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,
            beforeSend: function () {
                /*$("#spinner").show();*/
            },
            success: function (data) {
                /*$("#spinner").hide();*/
                if (data.return) {
                    $("#editJury").modal('hide');

                    swal(
                        'Success',
                        'Updated successfully !',
                        'success'
                    ).then(function () {
                        location.reload();
                    });

                } else {
                    //Parse alert
                    var errorkey = data.error_keys[0];
                    swal(
                        'Oops!',
                        data.error[errorkey][0],
                        'error'
                    );
                }
            },
            error: function (xhr, statusText, errorThrown) {
                NProgress.done();
                NProgress.remove();
                showSomethingWentWrongAlert(xhr);
            }


        });

    });

    /*Brief*/

    /*InAssociationwith_update*/
    $("body").on("click", ".InAssociationwith_update", function () {


        var formElement = document.querySelector("#InAssociationwith_update_form");
        var formData = new FormData(formElement);

        $.ajax({
            type: "POST",
            url: "/parse/in-association-with-update",
            data: formData,
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,
            beforeSend: function () {
                /*$("#spinner").show();*/
            },
            success: function (data) {
                /*$("#spinner").hide();*/
                if (data.return) {
                    $("#editJury").modal('hide');

                    swal(
                        'Success',
                        'Updated successfully !',
                        'success'
                    ).then(function () {
                        location.reload();
                    });

                } else {
                    //Parse alert
                    var errorkey = data.error_keys[0];
                    swal(
                        'Oops!',
                        data.error[errorkey][0],
                        'error'
                    );
                }
            },
            error: function (xhr, statusText, errorThrown) {
                NProgress.done();
                NProgress.remove();
                showSomethingWentWrongAlert(xhr);
            }


        });

    });

    $("body").on("click", ".downloadAttachment", function () {


        var formElement = document.querySelector("#downloadAttachment_form");
        var formData = new FormData(formElement);

        $.ajax({
            type: "POST",
            url: "/parse/download-attachment",
            data: formData,
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,
            beforeSend: function () {
                /*$("#spinner").show();*/
            },
            success: function (data) {
                /*$("#spinner").hide();*/
                if (data.return) {
                    $("#editJury").modal('hide');

                    swal(
                        'Success',
                        'Updated successfully !',
                        'success'
                    ).then(function () {
                        location.reload();
                    });

                } else {
                    //Parse alert
                    var errorkey = data.error_keys[0];
                    swal(
                        'Oops!',
                        data.error[errorkey][0],
                        'error'
                    );
                }
            },
            error: function (xhr, statusText, errorThrown) {
                NProgress.done();
                NProgress.remove();
                showSomethingWentWrongAlert(xhr);
            }


        });

    });


    /*title cover update*/
    $("body").on("click", ".brief_update", function () {
        //comp berif & Honourable mentions medium editor
        var berif = $("#competition_brief").html().split('<div class="medium-insert-buttons"')[0];
        var users_competition_slug = $("input[name='users_competition_slug']").val();


        $.ajax({
            type: "POST",
            url: "/parse/brief-update",
            data: {"berif": berif, "users_competition_slug": users_competition_slug},

            beforeSend: function () {
                /*$("#spinner").show();*/
            },
            success: function (data) {
                /*$("#spinner").hide();*/

                if (data.return) {
                    $("#editBrief").modal('hide');
                    swal(
                        'Success',
                        'Updated successfully !',
                        'success'
                    ).then(function () {
                        location.reload();
                    });

                } else {
                    //Parse alert
                    var errorkey = data.error_keys[0];
                    swal(
                        'Oops!',
                        data.error[errorkey][0],
                        'error'
                    );
                }
            },
            error: function (xhr, statusText, errorThrown) {
                NProgress.done();
                NProgress.remove();
                showSomethingWentWrongAlert(xhr);
            }


        });
    });

    /* eligibilityCriteria awardstherDetails update*/

    $("body").on("click", ".eligibilityCriteria_awardstherDetails_update", function () {

        //comp berif & Honourable mentions medium editor
        var honourable_mentions = $("#honourable_mentions").html().split('<div class="medium-insert-buttons"')[0];
        var users_competition_slug = $("input[name='users_competition_slug']").val();
        var eligibility_criteria = $("input[name='eligibility_criteria']").val();


        $.ajax({
            type: "POST",
            url: "/parse/eligibilityCriteria-awardstherDetails-update",
            data: {
                "honourable_mentions": honourable_mentions,
                "users_competition_slug": users_competition_slug,
                "eligibility_criteria": eligibility_criteria
            },

            beforeSend: function () {
                /*$("#spinner").show();*/
            },
            success: function (data) {
                /*$("#spinner").hide();*/
                if (data.return) {
                    $("#eligibilityCriteria_awardstherDetails").modal('hide');
                    swal(
                        'Success',
                        'Updated successfully !',
                        'success'
                    ).then(function () {
                        location.reload();
                    });

                } else {
                    //Parse alert
                    var errorkey = data.error_keys[0];
                    swal(
                        'Oops!',
                        data.error[errorkey][0],
                        'error'
                    );
                }
            },
            error: function (xhr, statusText, errorThrown) {
                NProgress.done();
                NProgress.remove();
                showSomethingWentWrongAlert(xhr);
            }


        });
    });

    /*event apply */

    $('#eventApply').click(function () {

        var eventId = $('#event-id').val();

        swal({
            title: 'Are you sure,You want to apply for the event',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonText: 'Yes, Apply it!'
        }).then(function () {
            //delete it
            $.ajax({
                type: "POST",
                url: base_url + "parse/apply-event",
                data: {"users_event_id": eventId},
                context: $(this),
                beforeSend: function () {
                    NProgress.start();
                },
                success: function (data) {
                    if (data.return) {
                        //success
                        swal({
                            text: "You applied Successfully",
                            type: "success",
                            title: "Success",
                            confirmButtonText: "ok"
                        }).then(function () {
                            window.location.reload();
                        });

                    } else {
                        //error
                        swal("Oops..", data.message, "error");
                    }
                    NProgress.done();
                    NProgress.remove();
                },
                error: function (xhr, statusText, errorThrown) {
                    NProgress.done();
                    NProgress.remove();
                    showSomethingWentWrongAlert(xhr);
                }
            });
        });
    })

    /*view event user*/

    $('#viewEventUser').click(function () {

        $.ajax({
            type: "POST",
            url: base_url + "parse/view-event-user",
            contentType: false,
            cache: false,
            context: $(this),
            processData: false,
            success: function (data) {

                if (data.return) {
                    $('#event-modal').modal('show')
                    $('#event-detail').html(data)

                } else {
                    $('#event-modal').modal('show')
                    $('#event-detail').html(data)

                }
            },
            error: function (xhr, statusText, errorThrown) {
                hideNProgress();
                $('#event-modal').modal('hide')
                showSomethingWentWrongAlert(xhr);
            }
        });
    });
    /*job itntern swal*/
    $('#job-intern').click(function () {

        swal("Oops..", "Individual Users cannot post Event or Job, please sign up as architecture firm, organization or Institute to post job or event");
    });

    /*submission delete*/

    $("body").on("click", ".delete_post_submission", function () {
        //comp berif & Honourable mentions medium editor
        var submission_id = $(this).attr('data-submission-post-id');


        $.ajax({
            type: "POST",
            url: "/parse/remove-submission",
            data: {"submission_id": submission_id},

            beforeSend: function () {
                /*$("#spinner").show();*/
            },
            success: function (data) {
                /*$("#spinner").hide();*/

                if (data.return) {

                    swal(
                        'Success',
                        'Submission deleted successfully !',
                        'success'
                    ).then(function () {
                        location.reload();
                    });

                } else {
                    //Parse alert
                    var errorkey = data.error_keys[0];
                    swal(
                        'Oops!',
                        data.error[errorkey][0],
                        'error'
                    );
                }
            },
            error: function (xhr, statusText, errorThrown) {
                NProgress.done();
                NProgress.remove();
                showSomethingWentWrongAlert(xhr);
            }


        });
    });

    /*message channel create*/
    /*
    $('#message').click(function () {
        var user_id = $(this).attr('data-attr-user-id');
        $.ajax({
            type: "POST",
            url: base_url + "/parse/channel",
            data: {"user_id": user_id},
            beforeSend: function () {
                showSpinnerLoader();
            },
            success: function (data) {
                hideSpinnerLoader();
                if (data) {
                   // console.log(data)
                    window.location.href = base_url + 'message/'+ data.channel;
                } else {
                    swal("Oops..", "Something went wrong", "error");
                }
            },
            error: function (xhr, statusText, errorThrown) {
                NProgress.done();
                NProgress.remove();
                showSomethingWentWrongAlert(xhr);
            }
            


        });

    });

    /*notification js*/
    // On load register service worker
    /*
    if ('serviceWorker' in navigator) {
        window.addEventListener("load", function () {
            navigator.serviceWorker.register(base_url+"js/firebase-messaging-sw.js").then(function (registration) {
                messaging.useServiceWorker(registration);
            }).then(function () {
                return messaging.requestPermission();
            }).then(function () {
                return messaging.getToken();
            }).then(function (token) {
                //save token to firebase
                var u = $("input[name='userid']").val();
                fireDb.ref("user/" + u).set({
                    token: token
                });
            }).catch(function (err) {
                alert("OOPS! Some error: " + err);
            });
        });
    }

    /*send messages chat code*/
    /*
    $('#chat_send').click(function () {
        var username = $.trim($("input[name='username']").val());
        var name = $("input[name='name']").val();
        var userid = $("input[name='userid']").val();
        var msg = $.trim($("#message-text").val());
        var userKey = $("input[name='channel']").val();
        var to_userid = $("input[name='to_userid']").val();

        if (msg != "") {
            userInsertMessage(userKey, username, name, userid, msg, to_userid);
        }
    });

    function userInsertMessage(userKey, username, name, userid, msg, to_userid) {
        var postDatamsg = {
            name: name,
            username: username,
            userid: userid,
            to_userid: to_userid,
            timestamp: new Date().getTime(),
            msg: msg
        };

        dbRef.child('channel')
            .child(userKey)
            .child('messages')
            .push()
            .set(postDatamsg);

        $("#message-text").val("");

        //Send Push notification
        fireDb.ref("user/" + to_userid).once("value", function (data) {
            var token = data.val().token;

            var settings = {
                "async": true,
                "crossDomain": true,
                "url": "https://fcm.googleapis.com/fcm/send",
                "method": "POST",
                "headers": {
                    "content-type": "application/json",
                    "authorization": "key=AIzaSyCCp6s8cn4I5dJU-l0nsMEFcx67maW8qNk"
                },
                "processData": false,
                "data": "{\"to\":\"" + token + "\",\"data\":{\"notification\":{\"body\":\"" + msg + "\",\"title\":\"New Message From "+username+"\",\"confirm\":\""+base_url+"message/"+userKey+"\",\"decline\":\""+base_url+"\"}},\"priority\":10}"
            };

            $.ajax(settings).done(function (response) {
                console.log(response);
                console.log("Notification sent");
            });
        });
    }

    var userKey = $("input[name='channel']").val();
    if(userKey != undefined){
        fireDb
            .ref('channel/' + userKey + '/' + 'messages')
            .on('value', function (msg) {
                var msgg = msg.val();
                var html = "";

                for (var key in msgg) {
                    html += `<li>
                                    <div class="media">
                                        <img class="d-flex author-thumb" src="${base_url}profile-picture/${msgg[key].username}"
                                             alt="author">
                                        <div class="media-body">
                                            <div class="notification-event">
                                                <div class="clearfix">
                                                    <a href="${base_url}profile/detail/${msgg[key].username}" class="h6 notification-friend">${msgg[key].name}</a>
                                                    <span class="notification-date"><time class="entry-date updated"
                                                                                          datetime="2004-07-24T18:18">${msgg[key].time}</time></span>
                                                </div>
                                                <span class="chat-message-item">${msgg[key].msg}</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>`;
                }


                $(".chat-message-field").html(html);

                $("#chat-div").scrollTop($("#chat-div")[0].scrollHeight);
            });
    }
    /*end here*/
    console.log($(document).width);


});

//Method to get competition submission list cards
function getCompetitionSubmissionHTML(competition_id, type) {
    showNProgress();
    $("#html-dump").load(base_url + "parse/competition/submission/list?type=" + type + "&competition=" + competition_id, function () {
        hideNProgress();
    });
}

/*
 *
 * method to select image from input file & set its base64 value to img & inpu value for file upload
 * */
function selectAndShowImage(from_id, target_id, target_val_id) {
    var file = document.querySelector(from_id).files[0];
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function () {
        $(target_val_id).val(reader.result);
        $(target_id).attr("src", reader.result);
    };
    reader.onerror = function (error) {
        swal("Oops..", "Unable to read image", "error");
    };
}

function showSweetMessage(titlem, typem) {
    swal({
        title: titlem,
        type: typem,
    });
}

function uploadMediumImage() {
    var lastImageElement = $('.editable').find('.medium-insert-images:last').find('figure:last').find('img');
    var lastImage = $('.editable').find('.medium-insert-images:last').find('figure:last').find('img').attr('src');
    lastImageElement.attr('data-is-uploaded', 'n');
    //return;
    $.ajax({
        type: "POST",
        url: base_url + "parse/upload-medium-image",
        data: {"image": lastImage},
        beforeSend: function () {
            $("#spinner").show();
        },
        success: function (data) {
            lastImageElement.attr('data-is-uploaded', 'y');
            if ($('.editable').find('.medium-insert-images figure').find('img[data-is-uploaded="n"]').length == 0) {
                $("#spinner").hide();
            }
            lastImageElement.attr('src', data);
        },
        error: function (xhr, statusText, errorThrown) {
            $("#spinner").hide();
            showSomethingWentWrongAlert(xhr);
        }
    });
}


function timeDifference(current, previous) {

    var msPerMinute = 60 * 1000;
    var msPerHour = msPerMinute * 60;
    var msPerDay = msPerHour * 24;
    var msPerMonth = msPerDay * 30;
    var msPerYear = msPerDay * 365;

    var elapsed = current - previous;

    if (elapsed < msPerMinute) {
        if (Math.round(elapsed / 1000) == 0) {
            return "Just now";
        } else {
            return Math.round(elapsed / 1000) + ' seconds ago';
        }
    }

    else if (elapsed < msPerHour) {
        return Math.round(elapsed / msPerMinute) + ' minutes ago';
    }

    else if (elapsed < msPerDay) {
        return Math.round(elapsed / msPerHour) + ' hours ago';
    }

    else if (elapsed < msPerMonth) {
        return Math.round(elapsed / msPerDay) + ' days ago';
    }

    else if (elapsed < msPerYear) {
        return Math.round(elapsed / msPerMonth) + ' months ago';
    }

    else {
        return Math.round(elapsed / msPerYear) + ' years ago';
    }
}

/*types   warning,success,error*/
function showError(inputName, errorText) {
    $('input[name="feed_college_' + inputName + '"]').parent('.form-group').find('p.errors.feed_college_' + inputName + '').show().text(errorText);
}

function showNProgress() {
    NProgress.start();
}

function hideNProgress() {
    NProgress.done();
    NProgress.remove();
}

function showSomethingWentWrongAlert(xhr) {
    if (xhr.status == '401') {
        window.location.href = base_url + 'login'; //Will take you to login.
    } else {
        swal("Oops!", "Something went wrong. Try again later", "error");
    }
}

function hideError() {
    $('.form-group p.errors').hide();
}

// Method to open input file on click of an div
function openFileInput(id) {
    $(id).click();
}

function navigate(id) {
    $("html, body").animate({scrollTop: $(id).offset().top - 0}, 100);
}

function setDatepiker(date_select_field) {
    if (date_select_field.length) {
        var start = moment().subtract(29, 'days');

        date_select_field.daterangepicker({
            startDate: start,
            autoUpdateInput: false,
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
        date_select_field.on('focus', function () {
            $(this).closest('.form-group').addClass('is-focused');
        });
        date_select_field.on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY'));
            $(this).closest('.form-group').addClass('is-focused');
        });
        date_select_field.on('hide.daterangepicker', function () {
            if ('' === $(this).val()) {
                $(this).closest('.form-group').removeClass('is-focused');
            }
        });

    }
}

function showSpinnerLoader() {
    $("#spinner").show();
}

function hideSpinnerLoader() {
    $("#spinner").hide();
}

