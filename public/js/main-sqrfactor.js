
$(document).ready(function () {
   /* NProgress.start();
    NProgress.done();
    NProgress.remove();*/

    $("#banner-sqr").modal('show');
    var base_url = $('body').attr('data-base') + "/";

    /*work single*/
    $("input[name='registerOption']").click();
    $('.work_select').show();
    $(".registerOption_value").attr('value', 'work');
    /*end*/

    $('.selectpicker').selectpicker('deselectAll');
    $('.selectpicker').selectpicker('val', '0');

    $(".hire_select").show();
    /*both*/
    /*$('.work_select').hide();*/
    $(".complete_registration").show();
    $(".complete_registration_only_register").hide();

    $(".or_hide_button").click(function () {
        $(".or_hide").show();
        $(".complete_registration_only_register").hide();

    });

    //  hire register
    $("input[name='registerOption']").click(function () {
        var val = $(this).val();
        $(".registerOption_value").attr('value', val);

        if (val == 'hire') {
            $('.hire_select').show();
            $('.work_select').hide();
            $('.social_button').show();
            $(".complete_registration").show();
            $(".or_hide").show();
            $(".complete_registration_only_register").hide()
            $(".one_input").hide()
            $(".firstName_lastName").show();
            $(".user_type_value").attr("value", "");


        }
        else if (val == 'work') {
            $('.hire_select').hide();
            $('.work_select').show();
            $('.social_button').show();
            $(".complete_registration").show();
            $(".or_hide").show();
            $(".complete_registration_only_register").hide()
            $(".one_input").hide()
            $(".firstName_lastName").show();
            $(".user_type_value").attr("value", "");


        }


    });
    $(".terms_and_conditions").click(function () {

        if ($(this).prop('checked') == true) {
            $(".terms_and_conditions_value").attr('value', 'yes')
            $(".terms_and_conditions11").hide();

        }
        else if ($(this).prop('checked') == false) {
            $(".terms_and_conditions_value").attr('value', 'no')
            $(".terms_and_conditions11").show();
        }
    });

    $('.hire_select_checked').change(function () {
        $('.selectpicker').selectpicker('deselectAll');
        $('.selectpicker').selectpicker('val', '0');

    });

    $(".firstName_lastName").show();

    $("select[name='user_type']").change(function () {
        var val = $(this).val();
        $(".user_type_value").attr('value', val);

        var helo1 = $('select[name="user_type"] option[value=' + val + ']').attr('data-name');
        $(".ddddd").html(helo1 + ' ' + 'Name');

        /*when select individuals*/
        if (val == 'hire_individual' || val == 'work_individual') {
            $(".social_button").show();
            $(".complete_registration").show();
            $(".or_hide").show();
            $(".firstName_lastName").show();
            $(".one_input").hide();
            $(".complete_registration_only_register").hide();
        }
        else {
            $(".social_button").hide();
            $(".complete_registration").hide();
            $(".complete_registration_only_register").show();
            $(".or_hide").hide();
            $(".firstName_lastName").hide();
            $(".one_input").show();


        }

        if (val !== null && val !== " ") {
            $(".registerOption_value_bag").hide();
            if (val == 'hire_individual' || val == 'work_individual') {
                $(".social_button").show();
            }
            else if (val !== 'hire_individual' || val !== 'work_individual') {
                $(".social_button").hide();
            }
        }
        else {
            $(".registerOption_value_bag").show().html('The field is required.');
        }

    });

    $("input[name='first_name']").add('input[name="last_name"]').add('input[name="last_name"]').add('input[name="password"]').add('input[name="email"]').add('input[name="password_confirmation"]').add(".dfgdfgfdgdfg").add('input[name="mobile_number"]').on('keyup', function () {
        var val = $(this).val();
        if (val !== null && val !== "") {
            $(this).next('p.error_bag').hide();


        }
        else {
            $(this).next('p.error_bag').show();
        }


    });


    $(".complete_registration").click(function () {
        $("input[name='user_name']").next('p.error_bag').next('p.suggestion').hide();

        $(".register_message").hide();

        var name = $(".dfgdfgfdgdfg").val();
        var user_name = $("input[name='user_name']").val();
        var first_name = $("input[name='first_name']").val();
        var last_name = $("input[name='last_name']").val();
        var password = $("input[name='password']").val();
        var password_confirmation = $("input[name='password_confirmation']").val();
        var terms_and_conditions = $(".terms_and_conditions_value").val();
        var email = $("input[name='email']").val();
        var user_type = $(".user_type_value").attr('value');
        var registerOption = $(".registerOption_value").val();
        var mobile_number = $("input[name='mobile_number']").val();
        var country = $("#country-name").val();
        $.ajax({
            type: "POST",
            url: "/parse/register",
            data: {
                "first_name": first_name,
                "last_name": last_name,
                "password": password,
                "terms_and_conditions": terms_and_conditions,
                "user_type": user_type,
                "registerOption": registerOption,
                "user_type": user_type,
                "email": email,
                "name": name,
                "country":country,
                "password_confirmation": password_confirmation,
                "mobile_number": mobile_number,
                "user_name": user_name
            },
            beforeSend: function () {
                NProgress.start();
                $(".complete_registration").addClass("disabled");
                $(".facebook_login").addClass("disabled");
                $(".google_login").addClass("disabled");
            },
            success: function (data) {
                NProgress.done();
                NProgress.remove();
                console.log(data);
                $(".complete_registration").removeClass("disabled");
                $(".facebook_login").removeClass("disabled");
                $(".google_login").removeClass("disabled");
                if (data.successMessage) {
                    var register_message = '<div class="alert alert-success"> <strong>Success!</strong> Please now active your account.</div>'

                    $(".register_message").show().html(register_message);
                    $("input[name='first_name']").val("");
                    $("input[name='last_name']").val("");
                    $("input[name='password']").val("");
                    $("input[name='password_confirmation']").val("");
                    $(".terms_and_conditions_value").val("");
                    $("input[name='email']").val("");
                    $(".dfgdfgfdgdfg").val("");
                    $("input[name='mobile_number']").val("");
                    $("input[name='user_name']").val("");

                    $('.selectpicker').selectpicker('deselectAll');
                    $('.selectpicker').selectpicker('val', '0');

                    document.getElementById("terms_and_conditions").checked = false;

                    swal("Success", "Please verify your email address. Activation link has been sent to your email address", "success");
                } else {
                    if (data.errors.first_name !== null && data.errors.last_name !== "" && data.errors.last_name !== undefined) {
                        $("input[name='first_name']").next('p.error_bag').show().html(data.errors.first_name);
                    }

                    if (data.errors.last_name !== null && data.errors.last_name !== "" && data.errors.last_name !== undefined) {
                        $("input[name='last_name']").next('p.error_bag').show().html(data.errors.last_name);
                    }
                    if (data.errors.password !== null && data.errors.password !== "" && data.errors.password !== undefined) {
                        $("input[name='password']").next('p.error_bag').show().html(data.errors.password);
                    }

                    if (data.errors.user_type !== null && data.errors.user_type !== "" && data.errors.user_type !== undefined) {
                        $(".registerOption_value_bag").show().html(data.errors.user_type);
                    }

                    if (data.errors.registerOption !== null && data.errors.registerOption !== "" && data.errors.registerOption !== undefined) {
                        $("input[name='registerOption']").next('p.error_bag').show().html(data.errors.registerOption);
                    }
                    if (data.errors.email !== null && data.errors.email !== "" && data.errors.email !== undefined) {
                        $("input[name='email']").next('p.error_bag').show().html(data.errors.email);
                    }

                    if (data.errors.terms_and_conditions !== undefined && data.errors.terms_and_conditions !== null && data.errors.terms_and_conditions !== "") {
                        $(".terms_and_conditions11").show().html(data.errors.terms_and_conditions);
                    }

                    if (data.errors.name !== null && data.errors.name !== "" && data.errors.name !== undefined) {
                        $(".dfgdfgfdgdfg").next('p.error_bag').show().html(data.errors.name);
                    }

                    if (data.errors.password_confirmation !== null && data.errors.password_confirmation !== "" && data.errors.password_confirmation !== undefined) {
                        $("input[name='password_confirmation']").next('p.error_bag').show().html(data.errors.password_confirmation);
                    }
                    if (data.errors.mobile_number !== null && data.errors.mobile_number !== "" && data.errors.mobile_number !== undefined) {
                        $("input[name='mobile_number']").next('p.error_bag').show().html(data.errors.mobile_number);
                    }

                    if (data.errors.user_name !== null && data.errors.user_name !== "" && data.errors.user_name !== undefined) {
                        $("input[name='user_name']").next('p.error_bag').show().html(data.errors.user_name[0]);
                        $("input[name='user_name']").next('p.error_bag').show();
                    }
                }
                // $(".register_message").show().html(register_message);
                // $("input[name='first_name']").val("");
                // $("input[name='last_name']").val("");
                // $("input[name='password']").val("");
                // $("input[name='password_confirmation']").val("");
                // $(".terms_and_conditions_value").val("");
                // $("input[name='email']").val("");
                // $(".dfgdfgfdgdfg").val("");
                // $("input[name='mobile_number']").val("");
                //
                //
                // $('.selectpicker').selectpicker('deselectAll');
                // $('.selectpicker').selectpicker('val', '0');
                //
                // document.getElementById("terms_and_conditions").checked = false;
            },
            error: function (xhr, statusText, errorThrown) {
                NProgress.done();
                NProgress.remove();
                $(".complete_registration").removeClass("disabled");
                $(".facebook_login").removeClass("disabled");
                $(".google_login").removeClass("disabled");
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops!", "Something went wrong", "error");
                }
            }
        });
    });


    $(".complete_registration_only_register").click(function () {


        $("input[name='user_name']").next('p.error_bag').next('p.suggestion').hide();

        $(".register_message").hide();

        var name = $(".dfgdfgfdgdfg").val();
        var user_name = $("input[name='user_name']").val();
        var password = $("input[name='password']").val();
        var password_confirmation = $("input[name='password_confirmation']").val();
        var terms_and_conditions = $(".terms_and_conditions_value").val();
        var email = $("input[name='email']").val();
        var user_type = $(".user_type_value").attr('value');
        var registerOption = $(".registerOption_value").val();
        var mobile_number = $("input[name='mobile_number']").val();

        $.ajax({
            type: "POST",
            url: "/parse/register2",
            data: {
                "password": password,
                "terms_and_conditions": terms_and_conditions,
                "user_type": user_type,
                "registerOption": registerOption,
                "user_type": user_type,
                "email": email,
                "name": name,
                "password_confirmation": password_confirmation,
                "mobile_number": mobile_number,
                "user_name": user_name
            },
            beforeSend: function () {
                NProgress.start();
                $(".complete_registration_only_register").addClass("disabled");
            },

            success: function (data) {
                NProgress.done();
                NProgress.remove();
                console.log(data);
                $(".complete_registration_only_register").removeClass("disabled");

                if (data.errors != undefined) {

                    if (data.errors.password !== null && data.errors.password !== "" && data.errors.password !== undefined) {
                        $("input[name='password']").next('p.error_bag').show().html(data.errors.password);
                    }

                    if (data.errors.user_type !== null && data.errors.user_type !== "" && data.errors.user_type !== undefined) {
                        $(".registerOption_value_bag").show().html(data.errors.user_type);
                    }

                    if (data.errors.registerOption !== null && data.errors.registerOption !== "" && data.errors.registerOption !== undefined) {
                        $("input[name='registerOption']").next('p.error_bag').show().html(data.errors.registerOption);
                    }
                    if (data.errors.email !== null && data.errors.email !== "" && data.errors.email !== undefined) {
                        $("input[name='email']").next('p.error_bag').show().html(data.errors.email);
                    }

                    if (data.errors.terms_and_conditions !== null && data.errors.terms_and_conditions !== "" && data.errors.terms_and_conditions !== undefined) {
                        $(".terms_and_conditions11").show().html(data.errors.terms_and_conditions);
                    }

                    if (data.errors.name !== null && data.errors.name !== "" && data.errors.name !== undefined) {
                        $(".dfgdfgfdgdfg").next('p.error_bag').show().html(data.errors.name);
                    }

                    if (data.errors.password_confirmation !== null && data.errors.password_confirmation !== "" && data.errors.password_confirmation !== undefined) {
                        $("input[name='password_confirmation']").next('p.error_bag').show().html(data.errors.password_confirmation);
                    }
                    if (data.errors.mobile_number !== null && data.errors.mobile_number !== "" && data.errors.mobile_number !== undefined) {
                        $("input[name='mobile_number']").next('p.error_bag').show().html(data.errors.mobile_number);
                    }

                    if (data.errors.user_name !== null && data.errors.user_name !== "" && data.errors.user_name !== undefined) {
                        $("input[name='user_name']").next('p.error_bag').show().html(data.errors.user_name[0]);
                        $("input[name='user_name']").next('p.error_bag').show();
                    }
                } else if (data.successMessage) {

                    var register_message = '<div class="alert alert-success"> <strong>Success!</strong> Please now active your account.</div>'

                    $(".register_message").show().html(register_message);

                    $("input[name='password']").val("");
                    $("input[name='password_confirmation']").val("");
                    $(".terms_and_conditions_value").val("");
                    $("input[name='email']").val("");
                    $(".dfgdfgfdgdfg").val("");
                    $("input[name='mobile_number']").val("");
                    $("input[name='user_name']").val("");


                    $('.selectpicker').selectpicker('deselectAll');
                    $('.selectpicker').selectpicker('val', '0');

                    document.getElementById("terms_and_conditions").checked = false;

                    swal("Success", "Please verify your email address. Activation link has been sent to your email address", "success");
                }
            },
            error: function (xhr, statusText, errorThrown) {
                NProgress.done();
                NProgress.remove();
                $(".complete_registration_only_register").removeClass("disabled");
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops!", "Something went wrong", "error");
                }
            }
        });
    });


    $("input[name='email']").add('input[name="password"]').on('keyup', function () {
        var val = $(this).val();
        if (val !== null && val !== "" && val !== undefined) {
            $(this).next('p.login_errors').hide()
        }
        else {
            $(this).next('p.login_errors').show()
        }
    })

    $(".remember_login").click(function () {
        if ($(this).prop('checked') == true) {
            $(".remember_login_value").attr('value', 'true');
        } else if ($(this).prop('checked') == false) {
            $(".remember_login_value").attr('value', 'false');
        }


    });

    $(".login_user").click(function () {
        var email = $(".email_login").val();
        var password = $(".password_login").val();
        var remember = $(".remember_login_value").val();

        $.ajax({
            type: "POST",
            url: "parse/login",
            data: {"email": email, "password": password, "remember": remember},
            beforeSend: function () {
                NProgress.start();
                $(".login_user").addClass("disabled");
                $(".facebook_login").addClass("disabled");
                $(".google_login").addClass("disabled");
            },
            success: function (data) {
                NProgress.done();
                NProgress.remove();
                $(".login_user").removeClass("disabled");
                $(".facebook_login").removeClass("disabled");
                $(".google_login").removeClass("disabled");

                if (data.errors) {
                    if (data.errors.email !== null && data.errors.email !== "" && data.errors.email !== undefined) {
                        $(".email_login").next('p.login_errors').show().html(data.errors.email);
                        $(".password_login").val("");
                    }

                    if (data.errors.password !== null && data.errors.password !== "" && data.errors.password !== undefined) {
                        $(".password_login").next('p.login_errors').show().html(data.errors.password);
                    }

                }
                else {
                    if (data.successMessage) {
                        if (data.successMessage.emailActiveLogin == true) {
                            var hghghgh = true;
                        }

                        if (data.successMessage.emailActiveLogin == false) {


                            var resentEmail = '<div class="alert alert-danger"><strong>Oops!</strong> Please active your account <a href="' + base_url + 'activate/resend?email=' + data.successMessage.email + '">Resend</a></div>'

                            $(".resentEmail").html(resentEmail)
                            $(".email_login").val("");
                            $(".password_login").val("");
                            console.log($(".remember_login_value").prop('checked') + 'yyy');

                            document.getElementById("optionsCheckboxes").checked = false;

                        }

                        if (hghghgh == true) {
                            window.location.href = '/news-feed';
                        }
                    }

                    if (data.errorFailed) {
                        $(".password_login").next('p.login_errors').show().html(data.errorFailed);
                        $(".password_login").val("");
                    }

                    if (data.errors) {
                        if (data.errors.email !== null && data.errors.email !== "" && data.errors.email !== undefined) {
                            $(".email_login").next('p.login_errors').show().html(data.errors.email);
                            $(".password_login").val("");
                        }

                        if (data.errors.password !== null && data.errors.password !== "" && data.errors.password !== undefined) {
                            $(".password_login").next('p.login_errors').show().html(data.errors.password);
                        }

                    }
                    else {
                        if (data.successMessage) {
                            if (data.successMessage.emailActiveLogin == true) {
                                var hghghgh = true;

                            }

                            if (data.successMessage.emailActiveLogin == false) {


                                var resentEmail = '<div class="alert alert-danger"><strong>Oops!</strong> Please active your account <a href="' + base_url + 'activate/resend?email=' + data.successMessage.email + '">Resend</a></div>'

                                $(".resentEmail").html(resentEmail)
                                $(".email_login").val("");
                                $(".password_login").val("");
                                console.log($(".remember_login_value").prop('checked') + 'yyy');

                            }
                        }

                        if (hghghgh == true) {
                            window.location.href = '/news-feed';
                        }
                    }
                }
            },
            error: function (xhr, statusText, errorThrown) {
                NProgress.done();
                NProgress.remove();
                $(".login_user").removeClass("disabled");
                $(".facebook_login").removeClass("disabled");
                $(".google_login").removeClass("disabled");
                if (xhr.status == '401') {
                    window.location.href = base_url + 'login'; //Will take you to login.
                } else {
                    swal("Oops!", "Something went wrong", "error");
                }
            }
        });
    });
    //Edited by John 12-4-18
    $('.email_login,.password_login').keypress(function(e){
        if(e.which == 13){//Enter key pressed
            $('.login_user').click();//Trigger search button click event
        }
    });
    // End of "Edited by John 12-4-18"

    $("#facebook_login_werning_signup").click(function () {
        swal({
            html:
            '<div class="swal2-content" style="display: block;"><br><h3> Please read carefully </h3>\n' +
            '<br>Only individual users can signing up  with social login.<br> If you\'re an Individual, click the link below<br><br><a href='+base_url+'login/facebook class="btn btn-primary">Continue with Facebook as Individual</a>\n' +
            '<div class="or"></div>If you are signing up as <br>Architecture Firm/Company (Service Providers) | College/University | Organization/Society/Company, <br>please register with the link below<br><br><a href='+base_url+'register class="btn btn-secondary">Register as Firm, College or Organization</a></div>',
            showCancelButton: false,
            showConfirmButton: false,
            showCloseButton: true,


        })
    });


    $("#google_werning_signup").click(function () {
        swal({
            html:
            '<div class="swal2-content" style="display: block;"><br><h3> Please read carefully </h3>\n' +
            '<br>Only individual users can sign up  with social login.<br> If you\'re an Individual, click the link below<br><br><a href='+base_url+'login/google class="btn btn-primary">Continue with Google as Individual</a>\n' +
            '<div class="or"></div>If you are signing up as <br>Architecture Firm/Company (Service Providers) | College/University | Organization/Society/Company, <br>please register with the link below<br><br><a href='+base_url+'register class="btn btn-secondary">Register as Firm, College or Organization</a></div>',
            showCancelButton: false,
            showConfirmButton: false,
            showCloseButton: true,
        })

    });

    $("#facebook_login_werning_login").click(function () {
        swal({
            html:
            '<div class="swal2-content" style="display: block;"><br><h3> Please read carefully </h3>\n' +
            '<br>Only individual users can login  with social login.<br> If you\'re an Individual, click the link below<br><br><a href='+base_url+'login/facebook class="btn btn-primary">Continue with Facebook as Individual</a>\n' +
            '<div class="or"></div>If you want to login  as <br>Architecture Firm/Company (Service Providers) | College/University | Organization/Society/Company, <br>please login with the link below<br><br><a href='+base_url+'login class="btn btn-secondary">Login as Firm, College or Organization</a></div>',
            showCancelButton: false,
            showConfirmButton: false,
            showCloseButton: true,
        })
    });

    $("#google_werning_login").click(function () {
        swal({
            html:
            '<div class="swal2-content" style="display: block;"><br><h3> Please read carefully </h3>\n' +
            '<br>Only individual users can login  with social login.<br> If you\'re an Individual, click the link below<br><br><a href='+base_url+'login/google class="btn btn-primary">Continue with Google as Individual</a>\n' +
            '<div class="or"></div>If you want to login  as <br>Architecture Firm/Company (Service Providers) | College/University | Organization/Society/Company, <br>please login with the link below<br><br><a href='+base_url+'login class="btn btn-secondary">Login as Firm, College or Organization</a></div>',
            showCancelButton: false,
            showConfirmButton: false,
            showCloseButton: true,
        })
    });
});


