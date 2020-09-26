var idleTime = 0;

$(document).ready(function () {

    "use strict";

    /***********************************
     HOME 
     **********************************/

    setInterval(timerIncrement, 60000);

    $(this).mousemove(function () {
        idleTime = 0;
    });

    $(this).keypress(function () {
        idleTime = 0;
    });

    $('[data-toggle="tooltip"]').tooltip();

    $(document).on("mousedown", "[data-ripple]", function (e) {
        var $self = $(this);
        if ($self.is(".btn-disabled")) {
            return;
        }
        if ($self.closest("[data-ripple]")) {
            e.stopPropagation();
        }
        var initPos = $self.css("position"),
                offs = $self.offset(),
                w = Math.min(this.offsetWidth, 160),
                h = Math.min(this.offsetHeight, 160),
                x = e.pageX - offs.left,
                y = e.pageY - offs.top,
                $ripple = $('<div/>', {class: "ripple", appendTo: $self});

        if (!initPos || initPos == "static") {
            $self.css({position: "relative"});
        }
        $('<div/>', {
            class: "rippleWave",
            css: {
                background: $self.data("ripple"),
                width: h,
                height: h,
                left: x - (h / 2),
                top: y - (h / 2)
            },
            appendTo: $ripple,
            one: {
                animationend: function () {
                    $ripple.remove();
                }
            }
        });
    });

    if ($('#home-register').length) {
        $('#home-register .select-type').select2({
            minimumResultsForSearch: -1,
            dropdownParent: $('#home-register')
        });

        $('#home-register').submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                email: {required: true, email: true},
                password: {required: true, minlength: 8}
            },
            submitHandler: function () {
                $('#home-register #loader').fadeIn();
                $('#home-register .alert').fadeOut();
                $('#home-register button').prop('disabled', true);
                var form = document.getElementById('home-register');
                var fd = new FormData(form);
                $.ajax({
                    url: base_url + 'home/register',
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data == 'success') {
                            window.location = base_url + 'dashboard';
                        } else if (data == 'type_fail') {
                            $('.select2-selection--single').css('border-color', '#ad0000');
                        } else {
                            $('.select2-selection--single').css('border-color', '#ccc');
                            $('#home-register .alert').html(data).fadeIn();
                        }
                        $('#home-register #loader').fadeOut();
                        $('#home-register button').prop('disabled', false);
                    }
                });
                return false;
            }
        });
    }

    $(document).on('click', '#resend-link', function (e) {
        e.preventDefault();
        $.post(base_url + 'home/activation_key', function (data) {
            if (data == 'success') {
                new PNotify({title: 'Success', delay: 1000, text: 'Verification email has been successfully resent.', type: 'success'});
            }
        });
    });

    $(document).on('click', '#resend-link-home', function (e) {
        e.preventDefault();
        var id = $('#resend-id').text();
        $.post(base_url + 'dashboard/activation_key', {resend_id: id}, function (data) {
            if (data == 'success') {
                new PNotify({title: 'Success', delay: 2000, text: 'Verification link successfully sent to your email.', type: 'success'});
            }
        });
    });

    if ($('#contactus').length) {
        $('#contactus').submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                name: {required: true},
                email: {required: true, email: true},
                msg: {required: true},
                subject: {required: true}
            },
            submitHandler: function () {
                $('#contactus #img-loader').fadeIn();
                $('#contactus .alert').fadeOut();
                var name = $('#contactus #contact_name').val();
                var email = $('#contactus #contact_email').val();
                var sub = $('#contactus #contact_subject').val();
                var msg = $('#contactus #contact_msg').val();
                $.post(base_url + 'contact_us', {name: name, email: email, sub: sub, msg: msg}, function (data) {
                    if (data == 'success') {
                        new PNotify({title: 'Success', delay: 1000, text: 'Thank you for your submission. We will get back with you shortly', type: 'success'});
                        document.getElementById("contactus").reset();
                        $('#contact').modal('hide');
                    } else {
                        $('#contactus .alert').html(data).fadeIn();
                    }
                    $('#contactus #loader').fadeOut();
                });
                return false;
            }
        });
    }

    if ($('#login-header-form').length) {
        $('#login-header-form').submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                login_email: {required: true, email: true},
                login_pass: {required: true}
            },
            submitHandler: function () {
                $('#login-header-form #loader').fadeIn();
                $('#login-header-form .alert').fadeOut();
                $('#login-header-form .alert-reset').remove();
                var email = $('#login_email').val();
                var password = $('#login_pass').val();
                $.post(base_url + 'login', {email: email, pass: password}, function (data) {
                    if (data == 'error') {
                        $('#login-header-form .alert').text('Validation error occured.').fadeIn();
                    }
                    if (data == 'success') {
                        window.location = base_url + 'dashboard';
                    }
                    if (data == 'not_active') {
                        window.location = base_url;
                    }
                    if (data == 'invalid') {
                        $('#login-header-form .alert').text('Invalid credentials.').fadeIn();
                    }
                    $('#login-header-form #loader').fadeOut();
                });
                return false;
            }
        });
    }

    if ($('#login-form').length) {
        $('#login-form').submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                email: {required: true, email: true},
                password: {required: true}
            },
            submitHandler: function () {
                $('#login-form #loader').fadeIn();
                $('#login-form .alert').fadeOut().removeClass('alert-success').addClass('alert-danger');
                $('#login-form .alert-reset').remove();
                var email = $('#login_email_box').val();
                var password = $('#login_pass_box').val();
                $.post(base_url + 'login', {email: email, pass: password}, function (data) {
                    if (data == 'error') {
                        $('#login-form .alert').text('Validation error occured.').fadeIn();
                    }
                    if (data == 'success') {
                        window.location = base_url + 'dashboard';
                    }
                    if (data == 'not_active') {
                        $('#login-form .alert').html('Please activate your account by clicking on the verification link sent to your mail. <a id="resend-link">Re-send verification email</a>').fadeIn();
                    }
                    if (data == 'invalid') {
                        $('#login-form .alert').text('Invalid credentials.').fadeIn();
                    }
                    $('#login-form #loader').fadeOut();
                });
                return false;
            }
        });
    }

    if ($('#reset-form').length) {
        $('#reset-form').submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                reset_email: {required: true, email: true}
            },
            submitHandler: function () {
                $('#reset-form #img-loader').fadeIn();
                $('#reset-form .alert').fadeOut();
                var email = $('#reset-email').val();
                $.post(base_url + 'home/forgot_pwd', {email: email}, function (data) {
                    if (data == 'success') {
                        document.getElementById('reset-form').reset();
                        $('#reset-form .alert').removeClass('alert-danger').addClass('alert-info').text('Reset link sent to your email.').fadeIn();
                    } else if (data == 'not found') {
                        $('#reset-form .alert').removeClass('alert-info').addClass('alert-danger').text('Email id not linked with any account.').fadeIn();
                    } else {
                        $('#reset-form .alert').removeClass('alert-info').addClass('alert-danger').html(data).fadeIn();
                    }
                    $('#reset-form #img-loader').fadeOut();
                });
                return false;
            }
        });
    }

    if ($('#resetpwd-form').length) {
        $('#resetpwd-form').submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                password: {required: true, minlength: 8},
                password_re: {equalTo: "#password"}
            },
            submitHandler: function () {
                $('#resetpwd-form #loader').fadeIn();
                $('#resetpwd-form .alert').fadeOut();
                var pass = $('#password_re').val();
                var key = $('#password_re').attr('data-key');
                $.post(base_url + 'home/reset_password', {pass: pass, key: key}, function (data) {
                    $('#resetpwd-form #loader').fadeOut();
                    if (data == 'success') {
                        window.location = base_url + 'login';
                    } else if (data == 'invalid') {
                        $('#resetpwd-form .alert').text('Invalid reset key found.').fadeIn();
                    } else {
                        $('#resetpwd-form .alert').html(data).fadeIn();
                    }
                });
                return false;
            }
        });
    }


    $('#useremail').keyup(function () {
        $('#user_email_error').hide();
    });

    $("#forgot").click(function () {
        $('#log-in').hide();
        $('#forgot-pwd').show();
    });

    $("#forgot-mail-cancel-btn").click(function () {
        $('#log-in').show();
        $('#forgot-pwd').hide();
    });

    if ($('.content .right .card').length) {
        var timezone = tzdetect.matches()[0];
        $.ajax({
            type: "POST",
            url: base_url + 'home/set_timezone',
            data: 'timezone=' + timezone,
            success: function (data) {
                if(data == 'Asia/Calcutta' || data == 'Asia/Kolkata') {
                    setTimeout(function(){
                        $('#offer_home').modal('show');
                    }, 3000);
                }
            }
        });
    }
    
    /***********************************
     DASHBOARD 
     **********************************/
    
    if ($(window).width() > 767) {
        if ($('.home_sos').length) {
            var imgHeight = $('.home_sos .banner #home_sos_carousel').height();
            var actionHeight = $('.home_sos .action .background_2').outerHeight();
            $('.home_sos .background .content').height(imgHeight);
            $('.home_sos .action .content').height(actionHeight);
            $('.home_sos .background').fadeIn();
        }
    }
    
    if ($('.home_sos').length) {
        var height = 0;
        $('.home_sos .timeline_home #timeline .timeline_post').each(function() {
            var div_height = $(this).outerHeight();
            height = height + div_height;
        });
        $('.home_sos .timeline_home #timeline .overlay').height(height);
    }
    
    $(document).on("click", ".home_sos .timeline_home .block .overlay", function () {
        window.location = base_url + 'dashboard/timeline';
    });
    
    var definition = {"smile": {"title": "Smile", "codes": [":)", ":=)", ":-)"]}, "sad-smile": {"title": "Sad Smile", "codes": [":(", ":=(", ":-("]}, "big-smile": {"title": "Big Smile", "codes": [":D", ":=D", ":-D", ":d", ":=d", ":-d"]}, "cool": {"title": "Cool", "codes": ["8)", "8=)", "8-)", "B)", "B=)", "B-)", "(cool)"]}, "wink": {"title": "Wink", "codes": [":o", ":=o", ":-o", ":O", ":=O", ":-O", ";-)"]}, "crying": {"title": "Crying", "codes": [";(", ";-(", ";=("]}, "sweating": {"title": "Sweating", "codes": ["(sweat)", "(:|"]}, "speechless": {"title": "Speechless", "codes": [":|", ":=|", ":-|"]}, "kiss": {"title": "Kiss", "codes": [":*", ":=*", ":-*"]}, "tongue-out": {"title": "Tongue Out", "codes": [":P", ":=P", ":-P", ":p", ":=p", ":-p"]}, "blush": {"title": "Blush", "codes": ["(blush)", ":$", ":-$", ":=$", ":\">"]}, "wondering": {"title": "Wondering", "codes": [":^)"]}, "sleepy": {"title": "Sleepy", "codes": ["|-)", "I-)", "I=)", "(snooze)"]}, "dull": {"title": "Dull", "codes": ["|(", "|-(", "|=("]}, "in-love": {"title": "In love", "codes": ["(inlove)"]}, "evil-grin": {"title": "Evil grin", "codes": ["]:)", ">:)", "(grin)"]}, "talking": {"title": "Talking", "codes": ["(talk)"]}, "yawn": {"title": "Yawn", "codes": ["(yawn)", "|-()"]}, "puke": {"title": "Puke", "codes": ["(puke)", ":&", ":-&", ":=&"]}, "doh!": {"title": "Doh!", "codes": ["(doh)"]}, "angry": {"title": "Angry", "codes": [":@", ":-@", ":=@", "x(", "x-(", "x=(", "X(", "X-(", "X=("]}, "it-wasnt-me": {"title": "It wasn't me", "codes": ["(wasntme)"]}, "party": {"title": "Party!!!", "codes": ["(party)"]}, "worried": {"title": "Worried", "codes": [":S", ":-S", ":=S", ":s", ":-s", ":=s"]}, "mmm": {"title": "Mmm...", "codes": ["(mm)"]}, "nerd": {"title": "Nerd", "codes": ["8-|", "B-|", "8|", "B|", "8=|", "B=|", "(nerd)"]}, "lips-sealed": {"title": "Lips Sealed", "codes": [":x", ":-x", ":X", ":-X", ":#", ":-#", ":=x", ":=X", ":=#"]}, "hi": {"title": "Hi", "codes": ["(hi)"]}, "call": {"title": "Call", "codes": ["(call)"]}, "devil": {"title": "Devil", "codes": ["(devil)"]}, "angel": {"title": "Angel", "codes": ["(angel)"]}, "envy": {"title": "Envy", "codes": ["(envy)"]}, "wait": {"title": "Wait", "codes": ["(wait)"]}, "bear": {"title": "Bear", "codes": ["(bear)", "(hug)"]}, "make-up": {"title": "Make-up", "codes": ["(makeup)", "(kate)"]}, "covered-laugh": {"title": "Covered Laugh", "codes": ["(giggle)", "(chuckle)"]}, "clapping-hands": {"title": "Clapping Hands", "codes": ["(clap)"]}, "thinking": {"title": "Thinking", "codes": ["(think)", ":?", ":-?", ":=?"]}, "bow": {"title": "Bow", "codes": ["(bow)"]}, "rofl": {"title": "Rolling on the floor laughing", "codes": ["(rofl)"]}, "whew": {"title": "Whew", "codes": ["(whew)"]}, "happy": {"title": "Happy", "codes": ["(happy)"]}, "smirking": {"title": "Smirking", "codes": ["(smirk)"]}, "nodding": {"title": "Nodding", "codes": ["(nod)"]}, "shaking": {"title": "Shaking", "codes": ["(shake)"]}, "punch": {"title": "Punch", "codes": ["(punch)"]}, "emo": {"title": "Emo", "codes": ["(emo)"]}, "yes": {"title": "Yes", "codes": ["(y)", "(Y)", "(ok)"]}, "no": {"title": "No", "codes": ["(n)", "(N)"]}, "handshake": {"title": "Shaking Hands", "codes": ["(handshake)"]}, "skype": {"title": "Skype", "codes": ["(skype)", "(ss)"]}, "heart": {"title": "Heart", "codes": ["(h)", "<3", "(H)", "(l)", "(L)"]}, "broken-heart": {"title": "Broken heart", "codes": ["(u)", "(U)"]}, "mail": {"title": "Mail", "codes": ["(e)", "(m)"]}, "flower": {"title": "Flower", "codes": ["(f)", "(F)"]}, "rain": {"title": "Rain", "codes": ["(rain)", "(london)", "(st)"]}, "sun": {"title": "Sun", "codes": ["(sun)"]}, "time": {"title": "Time", "codes": ["(o)", "(O)", "(time)"]}, "music": {"title": "Music", "codes": ["(music)"]}, "movie": {"title": "Movie", "codes": ["(~)", "(film)", "(movie)"]}, "phone": {"title": "Phone", "codes": ["(mp)", "(ph)"]}, "coffee": {"title": "Coffee", "codes": ["(coffee)"]}, "pizza": {"title": "Pizza", "codes": ["(pizza)", "(pi)"]}, "cash": {"title": "Cash", "codes": ["(cash)", "(mo)", "($)"]}, "muscle": {"title": "Muscle", "codes": ["(muscle)", "(flex)"]}, "cake": {"title": "Cake", "codes": ["(^)", "(cake)"]}, "beer": {"title": "Beer", "codes": ["(beer)"]}, "drink": {"title": "Drink", "codes": ["(d)", "(D)"]}, "dance": {"title": "Dance", "codes": ["(dance)", "\o/", "\:D/", "\:d/"]}, "ninja": {"title": "Ninja", "codes": ["(ninja)"]}, "star": {"title": "Star", "codes": ["(*)"]}, "mooning": {"title": "Mooning", "codes": ["(mooning)"]}, "finger": {"title": "Finger", "codes": ["(finger)"]}, "bandit": {"title": "Bandit", "codes": ["(bandit)"]}, "drunk": {"title": "Drunk", "codes": ["(drunk)"]}, "smoking": {"title": "Smoking", "codes": ["(smoking)", "(smoke)", "(ci)"]}, "toivo": {"title": "Toivo", "codes": ["(toivo)"]}, "rock": {"title": "Rock", "codes": ["(rock)"]}, "headbang": {"title": "Headbang", "codes": ["(headbang)", "(banghead)"]}, "bug": {"title": "Bug", "codes": ["(bug)"]}, "fubar": {"title": "Fubar", "codes": ["(fubar)"]}, "poolparty": {"title": "Poolparty", "codes": ["(poolparty)"]}, "swearing": {"title": "Swearing", "codes": ["(swear)"]}, "tmi": {"title": "TMI", "codes": ["(tmi)"]}, "heidy": {"title": "Heidy", "codes": ["(heidy)"]}, "myspace": {"title": "MySpace", "codes": ["(MySpace)"]}, "malthe": {"title": "Malthe", "codes": ["(malthe)"]}, "tauri": {"title": "Tauri", "codes": ["(tauri)"]}, "priidu": {"title": "Priidu", "codes": ["(priidu)"]}};

    if ($('.material-menu').length) {
        $.emoticons.define(definition);
    }

    $('#arrowchat_mobiletab').text('WorthChat');

    if ($('.guidelines .faqs').length) {
        $('.guidelines .nano').nanoScroller();
    }

    if ($('.home_sos').length) {
        $('.home_sos .nano').nanoScroller();
        $('.home_sos .timeline_post .inner .timeline_post_action a').removeAttr('onclick');
    }

    $('[data-popup="tooltip"]').tooltip();

    $('[data-popup="popover"]').popover();

    if ($('.fancybox').length) {
        $(".fancybox").fancybox({
            helpers: {
                overlay: {
                    locked: false
                }
            }
        });
    }

    if ($('form').length) {
        $('form').attr('autocomplete', 'off');
    }

    if ($('#update_propic').length) {
        var roboCropApp2 = new RoboCrop();
        roboCropApp2.setColors('rgba(255, 255, 255, 0.9)', 'rgba(255, 255, 255, 0.9)');
        roboCropApp2.setDestiny('#crop');
        roboCropApp2.setCropArea(300, 300);
        $(document).on("click", ".btns-robocrop2 .btn-crop", function () {
            roboCropApp2.crop();
            $('.btn-flip-x, .btn-flip-y').show();
        });
        $(document).on("click", ".btns-robocrop2 .btn-flip-x", function () {
            roboCropApp2.flipX();
        });
        $(document).on("click", ".btns-robocrop2 .btn-flip-y", function () {
            roboCropApp2.flipY();
        });
        $(document).on("click", ".btns-robocrop2 .btn-invert", function () {
            roboCropApp2.invertDimensions();
        });
        $(document).on("change", '.btns-robocrop2 .btn-open input:file', function () {
            roboCropApp2.loadImage(this);
            $('.btn-flip-x, .btn-flip-y').hide();
        });
        $('#submit_propic').on('click', function () {
            $('#update_propic #loader').fadeIn();
            $('#submit_propic').prop('disabled', true);
            if ($('#crop').find('.resize-container').length != 0) {
                roboCropApp2.crop();
                var image = roboCropApp2.getImageBase64('png');
                $.post(base_url + 'dashboard/update_propic', {image: image}, function (data) {
                    if (data == 'success') {
                        location.reload();
                    } else {
                        $('#update_propic #loader').fadeOut();
                        $('#update_propic .alert').text(data).fadeIn();
                        $('#submit_propic').prop('disabled', false);
                    }
                });
            } else {
                $('#update_propic #loader').fadeOut();
                $('#update_propic .alert').text('Please select an Image').fadeIn();
                $('#submit_propic').prop('disabled', false);
            }
        });
    }

    if ($('#update_banner').length) {
        var roboCropApp3 = new RoboCrop();
        roboCropApp3.setColors('rgba(255, 255, 255, 0.9)', 'rgba(255, 255, 255, 0.9)');
        roboCropApp3.setDestiny('#crop_banner');
        roboCropApp3.setCropArea(500, 125);
        $(document).on("click", ".btns-robocrop2 .btn-crop", function () {
            roboCropApp3.crop();
            $('.btn-flip-x, .btn-flip-y').show();
        });
        $(document).on("click", ".btns-robocrop2 .btn-flip-x", function () {
            roboCropApp3.flipX();
        });
        $(document).on("click", ".btns-robocrop2 .btn-flip-y", function () {
            roboCropApp3.flipY();
        });
        $(document).on("click", ".btns-robocrop2 .btn-invert", function () {
            roboCropApp3.invertDimensions();
        });
        $(document).on("change", '.btns-robocrop2 .btn-open input:file', function () {
            roboCropApp3.loadImage(this);
            $('.btn-flip-x, .btn-flip-y').hide();
        });
        $('#submit_banner').on('click', function () {
            $('#update_banner #loader').fadeIn();
            $('#submit_banner').prop('disabled', true);
            if ($('#crop_banner').find('.resize-container').length != 0) {
                roboCropApp3.crop();
                var image = roboCropApp3.getImageBase64('png');
                $.post(base_url + 'dashboard/update_banner', {image: image}, function (data) {
                    if (data == 'error') {
                        $('#update_banner #loader').fadeOut();
                        $('#update_banner .alert').text(data).fadeIn();
                        $('#submit_banner').prop('disabled', false);
                    } else {
                        window.location = base_url + 'dashboard/profile/' + data;
                    }
                });
            } else {
                $('#update_banner #loader').fadeOut();
                $('#update_banner .alert').text('Please select an Image').fadeIn();
                $('#submit_banner').prop('disabled', false);
            }
        });
    }

    if ($(window).width() < 767) {
        if ($('.grp-more').length) {
            var imgWidth = $('.grp-more .col img').width();
            $('.grp-more .col img').height(imgWidth);
        }
    }

    if ($('.home_sos .timeline_home').length) {
        $('.home_sos video').mediaelementplayer({
            enableAutosize: true
        });
    }

    if ($('#job_end_date').length) {
        $('#job_end_date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            drops: 'up',
            opens: 'right',
            minDate: new Date(),
            parentEl: '#date_box',
            locale: {
                format: 'DD/MM/YYYY'
            }
        });

        $('#job_end_date').val('');
    }

    if ($('#date_input_update').length) {
        $('#date_input_update').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            drops: 'up',
            opens: 'right',
            minDate: '01/01/1950',
            maxDate: new Date(),
            parentEl: '#date_box',
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
    }

    if ($('#add_info').length) {
        $('#add_user_info').submit(function (e) {
            e.preventDefault();
        }).validate({
            ignore: [],
            rules: {
                fname: {required: true},
                lname: {required: true}
            },
            submitHandler: function () {
                $('#add_user_info #loader').fadeIn();
                $('#add_user_info .alert').fadeOut();
                $('#add_user_info .select2-selection--multiple').css('border-color', '#ccc');
                $('#add_user_info .select2-selection--single').css('border-color', '#ccc');
                var form = document.getElementById('add_user_info');
                $('#add_user_info .modal-footer .btn-primary').prop('disabled', true);
                var fd = new FormData(form);
                $.ajax({
                    url: base_url + 'dashboard/add_info',
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data == 'success') {
                            window.location = base_url + 'dashboard';
                        } else if (data == 'invalid_interest') {
                            $('#add_user_info .select_box .select2-selection--multiple').css('border-color', '#ad0000');
                        } else if (data == 'invalid_country') {
                            $('#add_user_info .country_box .select2-selection--single').css('border-color', '#ad0000');
                        } else if (data == 'invalid_gender') {
                            $('#add_user_info .gender_box .select2-selection--single').css('border-color', '#ad0000');
                        } else {
                            $('#add_user_info .alert').html(data).fadeIn();
                        }
                        $('#add_user_info #loader').fadeOut();
                        $('#add_user_info .modal-footer .btn-primary').prop('disabled', false);
                    }
                });
                return false;
            }
        });

        $('#add_org_info').submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                name: {required: true}
            },
            submitHandler: function () {
                $('#add_org_info .modal-footer .btn-primary').prop('disabled', true);
                $('#add_org_info #loader').fadeIn();
                $('#add_org_info .alert').fadeOut();
                $('#add_org_info .select_box .select2-selection--multiple').css('border-color', '#ccc');
                $('#add_org_info .country_box .select2-selection--single').css('border-color', '#ccc');
                var form = document.getElementById('add_org_info');
                var fd = new FormData(form);
                $.ajax({
                    url: base_url + 'dashboard/add_info',
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data == 'success') {
                            window.location = base_url + 'dashboard';
                        } else if (data == 'invalid_interest') {
                            $('#add_org_info .select_box .select2-selection--multiple').css('border-color', '#ad0000');
                        } else if (data == 'invalid_country') {
                            $('#add_org_info .country_box .select2-selection--single').css('border-color', '#ad0000');
                        } else {
                            $('#add_org_info .alert').html(data).fadeIn();
                        }
                        $('#add_org_info #loader').fadeOut();
                        $('#add_org_info .modal-footer .btn-primary').prop('disabled', false);
                    }
                });
                return false;
            }
        });

        $('.select_area').select2({
            tags: false,
            dropdownParent: $('.select_box')
        });

        $('.hobbies').select2({
            tags: true,
            dropdownParent: $('.hobbie_box')
        });

        $('.gender-select').select2({
            minimumResultsForSearch: -1,
            dropdownParent: $('.gender_box')
        });

        $('.job-select').select2({
            minimumResultsForSearch: -1,
            dropdownParent: $('.job_box')
        });

        $('.country-select').select2({
            dropdownParent: $('.country_box')
        });
    }
    
    if ($('#editor_blog').length) {
        $('#editor_blog').redactor({
            buttons: ['format', 'bold', 'italic', 'deleted', 'lists', 'image', 'link'],
            imageUpload: base_url + 'dashboard/submit_blog_image'
        });
    }
    
    $('.blog-page .add-blog-md').click(function () {
        $('.blog-page .blog_add').modal('show');
    });
    
    $(document).on('click', '#redactor-modal-box #redactor-modal #redactor-modal-body .redactor-modal-tab-area #redactor-modal-button-delete', function (e) {
        if ($('#redactor-modal-box #redactor-modal #redactor-image-preview').length) {
            var src = $('#redactor-modal-box #redactor-modal #redactor-image-preview img').attr('src');
            $.post(base_url + 'dashboard/delete_editor_image', {src: src}, function () {
                console.log('deleted..!!');
            });
        }
    });
    
    if ($('#add_blog_form').length) {
        $('#add_blog_form').submit(function (e) {
            e.preventDefault();
                $('#add_blog_form #loader').fadeIn();
                $('#add_blog_form .modal-footer .btn-primary').prop('disabled', true);
                var fd = new FormData();
                if ($('#blog_upload').length) {
                    var file_up = $('#blog_upload').get(0).files[0];
                    fd.append('file', file_up);
                }
                var other_data = $('#add_blog_form').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/submit_blog?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#add_blog_form #loader').fadeOut();
                        if (data == 'success') {
                            document.getElementById("add_blog_form").reset();
                            $('#add_blog_form .blog_tags').val('').trigger('change');
                            new PNotify({title: 'Success', delay: 1000, text: 'You have successfully posted the blog.', type: 'success'});
                            load_blog();
                            $('#add_blog_form .modal-footer .btn-primary').prop('disabled', false);
                            $('.blog-page .blog_add').modal('hide');
                            $('#form_alert').html(data).fadeOut();
                        } else {
                            $('#form_alert').html(data).fadeIn();
                            $('#add_blog_form .modal-footer .btn-primary').prop('disabled', false);
                        }
                    }
                });
        });

        $('.fab').hover(function () {
            $(this).toggleClass('active');
        });

        $('#delete_blog_form').submit(function (e) {
            e.preventDefault();
            var id = $('#blog_delete_id').val();
            var page_type = '';
            if ($('.blog-post-single').length) {
                page_type = 'single';
            }
            $.post(base_url + 'dashboard/delete_blog', {id: id, page_type: page_type}, function (data) {
                if (data == 'success') {
                    if (page_type == 'single') {
                        window.location = base_url + 'dashboard/blog';
                    } else {
                        new PNotify({title: 'Success', delay: 1000, text: 'You have successfully deleted the blog.', type: 'success'});
                        load_blog();
                        $('#modal_delete').modal('hide');
                    }
                }
            });
        });

        $('.blog_tags').select2({
            tags: true,
            allowClear: true
        });

        $('#update_blog_form').submit(function (e) {
            e.preventDefault();
            $('#update_blog_form #loader').fadeIn();
            var fd = new FormData();
            if ($('#blogupdate_upload').length) {
                var file_up = $('#blogupdate_upload').get(0).files[0];
                fd.append('file', file_up);
            }
            var other_data = $('#update_blog_form').serializeArray();
            $.each(other_data, function (key, input) {
                fd.append(input.name, input.value);
            });
            $.ajax({
                url: base_url + 'dashboard/update_blog?' + other_data,
                type: 'POST',
                data: fd,
                processData: false,
                contentType: false,
                success: function (data) {
                    $('#update_blog_form #loader').fadeOut();
                    if (data == 'success') {
                        if ($('.blog-post-single').length) {
                            location.reload();
                        } else {
                            new PNotify({title: 'Success', delay: 1000, text: 'You have successfully updated the blog.', type: 'success'});
                            load_blog();
                            $('#form_alert_update').fadeOut();
                            $('#modal_update').modal('hide');
                        }
                    } else {
                        $('#form_alert_update').html(data).fadeIn();
                    }
                }
            });
        });
    }

    if ($('.gallery_tags').length) {
        $('.gallery_tags').select2({
            tags: true,
            allowClear: true
        });
    }

    if ($('#add_gallery_image_form').length) {
        $('#add_gallery_image_form').submit(function (e) {
            e.preventDefault();
        }).validate({
            errorClass: 'validation-error',
            rules: {
                privacy: {required: true},
                'gallery_image_upload[]': {required: true, extension: "jpg|png|jpeg"}
            },
            messages: {
                'gallery_image_upload[]': {extension: 'Only jpg | png formats allowed'}
            },
            submitHandler: function () {
                $('#add_gallery_image_form #loader').fadeIn();
                $('#add_gallery_image_form .modal-footer .btn-primary').prop('disabled', true);
                var fd = new FormData();
                var filedata = document.getElementById("gallery_image_upload");
                var i = 0, len = filedata.files.length, file;
                for (; i < len; i++) {
                    file = filedata.files[i];
                    if (fd) {
                        fd.append('file' + i, file);
                    }
                }
                var other_data = $('#add_gallery_image_form').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/timeline_submit?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#add_gallery_image_form #loader').fadeOut();
                        if (data == 'error') {
                            $('#add_gallery_image_form #form_alert').text('Validation error occured. Please try again.').fadeIn();
                            $('#add_gallery_image_form .modal-footer .btn-primary').prop('disabled', false);
                        } else {
                            document.getElementById("add_gallery_image_form").reset();
                            $('#add_gallery_image_form .gallery_tags').val('').trigger('change');
                            new PNotify({title: 'Success', delay: 1000, text: 'Image successfully added to gallery.', type: 'success'});
                            load_gallery('img');
                            $('#add_gallery_image_form .modal-footer .btn-primary').prop('disabled', false);
                            $('#add_gallery_image').modal('hide');
                        }
                    }
                });
                return false;
            }
        });
    }

    if ($('#add_gallery_video_form').length) {
        $('#add_gallery_video_form').submit(function (e) {
            e.preventDefault();
        }).validate({
            errorClass: 'validation-error',
            rules: {
                privacy: {required: true},
                gallery_video_upload: {required: true, extension: "mp4"}
            },
            messages: {
                gallery_video_upload: {extension: 'Only mp4 format allowed'}
            },
            submitHandler: function () {
                $('#add_gallery_video_form #loader').fadeIn();
                $('#add_gallery_video_form .modal-footer .btn-primary').prop('disabled', true);
                var fd = new FormData();
                var file_up = $('#gallery_video_upload').get(0).files[0];
                fd.append('file', file_up);
                var other_data = $('#add_gallery_video_form').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/timeline_submit?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#add_gallery_video_form #loader').fadeOut();
                        if (data == 'error') {
                            $('#add_gallery_video_form #form_alert').text('Validation error occured. Please try again.').fadeIn();
                            $('#add_gallery_video_form .modal-footer .btn-primary').prop('disabled', false);
                        }
                        if (data == 'success') {
                            document.getElementById("add_gallery_video_form").reset();
                            $('#add_gallery_video_form .gallery_tags').val('').trigger('change');
                            new PNotify({title: 'Success', delay: 1000, text: 'Video successfully added to gallery.', type: 'success'});
                            load_gallery('vd');
                            $('#add_gallery_video_form .modal-footer .btn-primary').prop('disabled', false);
                            $('#add_gallery_video').modal('hide');
                        }
                    }
                });
                return false;
            }
        });
    }

    $('#delete_gallery_image_form').submit(function (e) {
        e.preventDefault();
        var id = $('#gallery_delete_img_id').val();
        $.post(base_url + 'dashboard/delete_user_timeline_post', {post_id: id}, function (data) {
            if (data == 'success') {
                $('#delete_gallery_form #loader').fadeIn();
                load_gallery('img');
                new PNotify({title: 'Success', delay: 1000, text: 'Image successfully deleted from gallery.', type: 'success'});
                $('#delete_gallery_image').modal('hide');
                $('#delete_gallery_form #loader').fadeOut();
            }
        });
    });

    $('#delete_gallery_video_form').submit(function (e) {
        e.preventDefault();
        var id = $('#gallery_delete_vd_id').val();
        $.post(base_url + 'dashboard/delete_user_timeline_post', {post_id: id}, function (data) {
            if (data == 'success') {
                $('#delete_gallery_video #loader').fadeIn();
                load_gallery('vd');
                new PNotify({title: 'Success', delay: 1000, text: 'Video successfully deleted from gallery.', type: 'success'});
                $('#delete_gallery_video').modal('hide');
                $('#delete_gallery_video #loader').fadeOut();
            }
        });
    });

    $(document).on('click', '#grid .grid-item .view_post', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-post-id');
        $.post(base_url + 'dashboard/gallery_singleview', {post_id: id}, function (data) {
            if (data != '') {
                $('.home #timeline .main').html('');
                $('.profile #timeline .main').html('');
                $('#gallery_post').html(data);
                $('#gallery_post').find('.modal-title').html($.emoticons.replace($('#gallery_post').find('.modal-title').text()));
                $('#gallery_post').find('.content').html($.emoticons.replace($('#gallery_post').find('.content').text()));
                setTimeout(function () {
                    $('#gallery_post .gallery-video').mediaelementplayer({
                        enableAutosize: true
                    });
                }, 80);
                load_comment('timeline', id);
                $('#gallery_post').modal('show');
            }
        });
    });

    if ($('#search_form').length) {
        $('#search_form').validate({
            errorClass: 'error',
            rules: {
                key: {required: true}
            },
            messages: {
                key: 'Please type something you want to search for!'
            },
            submitHandler: function (form) {
                form.submit();
            }
        });

        $('#search_form #search_input').keyup(function () {
            if (this.value.length < 2) {
                $('.search .box .result').hide();
            } else {
                $('.search .box .result').fadeIn().html('');
                $.post(base_url + 'dashboard/ajax_search', {key: this.value}, function (data) {
                    if (data != '') {
                        $('.search .box .result').html(data);
                    }
                });
            }
        });
    }

    if ($('#search_list').length) {
        $('#search_list .toggle_action').on('click', function () {
            $(this).parent().toggleClass('open');
        });

        $('body').on('click', function (e) {
            if (!$('#search_list .toggle_action').is(e.target) && $('#search_list .toggle_action').has(e.target).length == 0 && $('.open').has(e.target).length == 0) {
                $('#search_list .toggle_action').parent().removeClass('open');
            }
        });
    }

    $(".profile-list a").click(function () {
        $(".profile-list a").removeClass('selected');
        $(this).addClass('selected');
    });

    $(".list-group-home a").click(function () {
        $(".list-group-home a").removeClass('selected');
        $(this).addClass('selected');
    });

    if ($('#add_group_form').length) {
        $('.group_tags').select2({
            tags: true,
            allowClear: true
        });

        $('#add_group_form').submit(function (e) {
            e.preventDefault();
        }).validate({
            errorClass: 'validation-error',
            rules: {
                title: {required: true},
                desc: {required: true},
                group_upload: {extension: "jpg|png|jpeg"}
            },
            messages: {
                group_upload: {extension: 'Only jpg | png formats allowed'}
            },
            submitHandler: function () {
                $('#add_group_form #loader').fadeIn();
                $('#add_group_form .modal-footer .btn-primary').prop('disabled', true);
                var fd = new FormData();
                var file_up = $('#group_upload').get(0).files[0];
                fd.append('file', file_up);
                var other_data = $('#add_group_form').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/add_group?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#add_group_form #loader').fadeOut();
                        if (data == 'error') {
                            $('#add_group_form #form_alert').text('Validation error occured. Please try again.').fadeIn();
                            $('#add_group_form .modal-footer .btn-primary').prop('disabled', false);
                        } else {
                            load_group('created');
                            document.getElementById("add_group_form").reset();
                            $('#add_group_form .group_tags').val('').trigger('change');
                            new PNotify({title: 'Success', delay: 1000, text: 'Group successfully created.', type: 'success'});
                            $('#add_group_form .modal-footer .btn-primary').prop('disabled', false);
                            $('#add_group').modal('hide');
                        }
                    }
                });
                return false;
            }
        });
    }

    $('#delete_group_form').submit(function (e) {
        e.preventDefault();
        var id = $('#delete_group_id').val();
        $.post(base_url + 'dashboard/delete_group', {id: id}, function (data) {
            if (data == 'success') {
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully deleted the group.', type: 'success'});
                load_group('created');
                $('#delete_group').modal('hide');
            }
        });
    });

    if ($('#update_group_form').length) {
        $('#update_group_form').submit(function (e) {
            e.preventDefault();
        }).validate({
            errorClass: 'validation-error',
            rules: {
                title: {required: true},
                desc: {required: true},
                group_upload: {extension: "jpg|png|jpeg"}
            },
            messages: {
                group_upload: {extension: 'Only jpg | png formats allowed'}
            },
            submitHandler: function () {
                $('#update_group_form #loader').fadeIn();
                var fd = new FormData();
                var file_up = $('#groupupdate_upload').get(0).files[0];
                fd.append('file', file_up);
                var other_data = $('#update_group_form').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/update_group?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#update_group_form #loader').fadeOut();
                        if (data == 'error') {
                            $('#update_group_form #form_alert_update').text('Validation error occured. Please try again.').fadeIn();
                        }
                        if (data == 'success') {
                            new PNotify({title: 'Success', delay: 1000, text: 'You have successfully updated the group.', type: 'success'});
                            load_group('created');
                            $('#update_group').modal('hide');
                        }
                    }
                });
                return false;
            }
        });
    }

    $(document).on('click', '.comment .has-feedback .comment_btn', function (e) {
        e.preventDefault();
        var type_id = $(this).attr('data-type-id');
        var comment = $('.comment .has-feedback .comment_input[data-type-id = ' + type_id + ']').val();
        var type = $('.comment .has-feedback .comment_input[data-type-id = ' + type_id + ']').attr('data-comment-type');
        var count = parseInt($('.comment_count[data-id = ' + type_id + '] span').text()) + 1;
        if (comment != '') {
            $.post(base_url + 'dashboard/add_comment', {type: type, type_id: type_id, comment: comment}, function (data) {
                if (data == 'success') {
                    $('.comment .has-feedback .comment_input').val('');
                    $('.comment_count[data-id = ' + type_id + '] span').text(count);
                    load_comment(type, type_id);
                    $('.comment .has-feedback .comment_input[data-type-id = ' + type_id + ']').css('border-color', '#ccc');
                    new PNotify({title: 'Success', delay: 1000, text: 'You have successfully posted a comment.', type: 'success'});
                }
            });
        } else {
            $('.comment .has-feedback .comment_input[data-type-id = ' + type_id + ']').css('border-color', '#ad0000');
        }
    });

    $(document).on('keypress', '.comment .comment_input', function (e) {
        if (e.which == 13) {
            e.preventDefault();
            var type_id = $(this).attr('data-type-id');
            var comment = $('.comment .has-feedback .comment_input[data-type-id = ' + type_id + ']').val();
            var type = $('.comment .has-feedback .comment_input[data-type-id = ' + type_id + ']').attr('data-comment-type');
            var count = parseInt($('.comment_count[data-id = ' + type_id + '] span').text()) + 1;
            if (comment != '') {
                $.post(base_url + 'dashboard/add_comment', {type: type, type_id: type_id, comment: comment}, function (data) {
                    if (data == 'success') {
                        $('.comment .has-feedback .comment_input').val('');
                        $('.comment_count[data-id = ' + type_id + '] span').text(count);
                        load_comment(type, type_id);
                        $('.comment .has-feedback .comment_input[data-type-id = ' + type_id + ']').css('border-color', '#ccc');
                        new PNotify({title: 'Success', delay: 1000, text: 'You have successfully posted a comment.', type: 'success'});
                    }
                });
            } else {
                $('.comment .has-feedback .comment_input[data-type-id = ' + type_id + ']').css('border-color', '#ad0000');
            }
            return false;
        }
    });
    
    $(document).on('click', '.blog-page .blog-post-meta .comment_count', function (e) {
        e.preventDefault();
        $(window).scrollTop($('.blog-page .comment').offset().top);
        $('.comment .has-feedback .comment_input').css('border-color', '#ad0000');
    });
    
    $(document).on('click', '.post .post-single .post-meta .comment_count', function (e) {
        e.preventDefault();
        $(window).scrollTop($('.post .post-single .comment').offset().top);
        $('.comment .has-feedback .comment_input').css('border-color', '#ad0000');
    });

    $(document).on('keypress', '.comment-block .comment-reply .comment_child_input', function (e) {
        if (e.which == 13) {
            e.preventDefault();
            var parent_id = $(this).attr('data-parent-id');
            add_child_comment(parent_id);
            return false;
            alert(2);
        }
    });

    if ($('.grp_tags').length) {
        $('.grp_tags').select2({
            tags: true,
            allowClear: true
        });
    }

    if ($('#add_grp_photo').length) {
        $('#add_grp_photo').submit(function (e) {
            e.preventDefault();
        }).validate({
            errorClass: 'validation-error',
            rules: {
                'grp_photo_upload[]': {required: true, extension: "jpg|png|jpeg"}
            },
            messages: {
                'grp_photo_upload[]': {extension: 'Only jpg | png formats allowed'}
            },
            submitHandler: function () {
                $('#add_grp_photo #loader').fadeIn();
                $('#add_grp_photo .modal-footer .btn-primary').prop('disabled', true);
                var fd = new FormData();
                var filedata = document.getElementById("grp_photo_upload");
                var i = 0, len = filedata.files.length, file;
                for (; i < len; i++) {
                    file = filedata.files[i];
                    if (fd) {
                        fd.append('file' + i, file);
                    }
                }
                var other_data = $('#add_grp_photo').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/group_timeline_submit?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#add_grp_photo #loader').fadeOut();
                        if (data == 'error') {
                            $('#add_grp_photo #form_alert').text('Validation error occured. Please try again.').fadeIn();
                            $('#add_grp_photo .modal-footer .btn-primary').prop('disabled', false);
                        } else {
                            document.getElementById("add_grp_photo").reset();
                            $('#add_grp_photo .grp_tags').val('').trigger('change');
                            new PNotify({title: 'Success', delay: 1000, text: 'You have successfully posted to the group timeline.', type: 'success'});
                            load_grp_timeline(data);
                            $('#add_grp_photo .modal-footer .btn-primary').prop('disabled', false);
                            $('#timeline_grp_photo').modal('hide');
                        }
                    }
                });
                return false;
            }
        });
    }

    if ($('#add_grp_video').length) {
        $('#add_grp_video').submit(function (e) {
            e.preventDefault();
        }).validate({
            errorClass: 'validation-error',
            rules: {
                grp_video_upload: {required: true, extension: "mp4"}
            },
            messages: {
                grp_video_upload: {extension: 'Only mp4 format allowed'}
            },
            submitHandler: function () {
                $('#add_grp_video #loader').fadeIn();
                $('#add_grp_video .modal-footer .btn-primary').prop('disabled', true);
                var fd = new FormData();
                var file_up = $('#grp_video_upload').get(0).files[0];
                fd.append('file', file_up);
                var other_data = $('#add_grp_video').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/group_timeline_submit?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#add_grp_video #loader').fadeOut();
                        if (data == 'error') {
                            $('#add_grp_photo #form_alert').text('Validation error occured. Please try again.').fadeIn();
                            $('#add_grp_video .modal-footer .btn-primary').prop('disabled', false);
                        } else {
                            document.getElementById("add_grp_video").reset();
                            $('#add_grp_video .grp_tags').val('').trigger('change');
                            new PNotify({title: 'Success', delay: 1000, text: 'You have successfully posted to the group timeline.', type: 'success'});
                            load_grp_timeline(data);
                            $('#add_grp_video .modal-footer .btn-primary').prop('disabled', false);
                            $('#timeline_grp_video').modal('hide');
                        }
                    }
                });
                return false;
            }
        });
    }

    if ($('#add_grp_file').length) {
        $('#add_grp_file').submit(function (e) {
            e.preventDefault();
        }).validate({
            errorClass: 'validation-error',
            rules: {
                title: {required: true},
                grp_file_upload: {required: true, extension: "pdf|txt|doc|docx|xlsx|xls|csv|ppt|pptx"}
            },
            messages: {
                grp_file_upload: {extension: 'Only pdf | txt | doc| docx | xlsx | xls | csv | ppt | pptx formats allowed'}
            },
            submitHandler: function () {
                $('#add_grp_file #loader').fadeIn();
                $('#add_grp_file .modal-footer .btn-primary').prop('disabled', true);
                var fd = new FormData();
                var file_up = $('#grp_file_upload').get(0).files[0];
                fd.append('file', file_up);
                var other_data = $('#add_grp_file').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/group_timeline_submit?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#add_grp_file #loader').fadeOut();
                        if (data == 'error') {
                            $('#add_grp_file #form_alert').text('Validation error occured. Please try again.').fadeIn();
                            $('#add_grp_file .modal-footer .btn-primary').prop('disabled', false);
                        } else {
                            document.getElementById("add_grp_file").reset();
                            $('#add_grp_file .grp_tags').val('').trigger('change');
                            new PNotify({title: 'Success', delay: 1000, text: 'You have successfully posted to the group timeline.', type: 'success'});
                            load_grp_timeline(data);
                            $('#add_grp_file .modal-footer .btn-primary').prop('disabled', false);
                            $('#timeline_grp_file').modal('hide');
                        }
                    }
                });
                return false;
            }
        });
    }

    $('#load_map').on('click', function () {
        setTimeout(function () {
            $('#map').locationpicker({
                location: {
                    latitude: 46.15242437752303,
                    longitude: 2.7470703125
                },
                inputBinding: {
                    locationNameInput: $('#map_input')
                },
                enableAutocomplete: true,
                onchanged: function (currentLocation, radius, isMarkerDropped) {
                    var cord = currentLocation.latitude + ',' + currentLocation.longitude;
                    $('#map_cordinates').val(cord);
                }
            });

        }, 180);
    });

    if ($('#add_grp_location').length) {
        $('#add_grp_location').submit(function (e) {
            e.preventDefault();
        }).validate({
            errorClass: 'validation-error',
            rules: {
                title: {required: true},
                map_input: {required: true}
            },
            messages: {
                map_input: 'Enter a location'
            },
            submitHandler: function () {
                $('#add_grp_location #loader').fadeIn();
                $('#add_grp_location .modal-footer .btn-primary').prop('disabled', true);
                var fd = new FormData();
                var other_data = $('#add_grp_location').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/group_timeline_submit?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#add_grp_location #loader').fadeOut();
                        if (data == 'error') {
                            $('#add_grp_location #form_alert').text('Validation error occured. Please try again.').fadeIn();
                            $('#add_grp_location .modal-footer .btn-primary').prop('disabled', false);
                        } else {
                            document.getElementById("add_grp_location").reset();
                            $('#add_grp_location .grp_tags').val('').trigger('change');
                            new PNotify({title: 'Success', delay: 1000, text: 'You have successfully posted to the group timeline.', type: 'success'});
                            load_grp_timeline(data);
                            $('#add_grp_location .modal-footer .btn-primary').prop('disabled', false);
                            $('#timeline_grp_location').modal('hide');
                        }
                    }
                });
                return false;
            }
        });
    }

    if ($('#timeline_grp').length) {
        $('#timeline_grp').submit(function (e) {
            e.preventDefault();
            $('.group .timeline_form #loader-home').fadeIn();
            var val = $('#timeline_grp .grp_message').val();
            if (val != '') {
                $.post(base_url + 'dashboard/group_timeline_submit', {grp_message: val, submit_type: 'grp_thought'}, function (data) {
                    if (data != 'error') {
                        document.getElementById("timeline_grp").reset();
                        $('#timeline_grp .grp_message').css('border-color', '#ccc');
                        load_grp_timeline(data);
                        new PNotify({title: 'Success', delay: 1000, text: 'You have successfully posted to the group timeline.', type: 'success'});
                    }
                });
            } else {
                $('#timeline_grp .grp_message').attr('placeholder', 'Type something here!');
            }
            $('.group .timeline_form #loader-home').fadeOut();
        });
    }

    if ($('#delete_grp_post_form').length) {
        $('#delete_grp_post_form').submit(function (e) {
            e.preventDefault();
            var grp_id = $('#delete_grp_post #delete_group_id').val();
            var post_id = $('#delete_grp_post #delete_post_id').val();
            $.post(base_url + 'dashboard/delete_group_timeline_post', {grp_id: grp_id, post_id: post_id}, function (data) {
                if (data == 'success') {
                    new PNotify({title: 'Success', delay: 1000, text: 'You have successfully deleted the post.', type: 'success'});
                    $('.group #timeline .timeline_post[data-post-id = ' + post_id + ']').remove();
                    $('#delete_grp_post').modal('hide');
                    if (!$('.group #timeline .timeline_post').length) {
                        $('.group .profile-main #load_more').hide();
                    }
                }
            });
        });
    }

    if ($('#leave_grp_form').length) {
        $('#leave_grp_form').submit(function (e) {
            e.preventDefault();
            var grp_id = $('#leave_grp_form #leave_group_id').val();
            var type = $('#leave_grp_form #leave_group_type').val();
            $.post(base_url + 'dashboard/cancel_grp', {cancel_id: grp_id}, function (data) {
                if (data == 'success') {
                    if (type == 1) {
                        new PNotify({title: 'Success', delay: 1000, text: 'You have successfully left the group.', type: 'success'});
                        $('.group .twPc-button').html('');
                        $('.group .twPc-button').html('<button onclick="join_group(' + grp_id + ', 1)" data-ripple class="btn shadow"><i class="ion-plus"></i> Join</button>');
                    }
                    if (type == 2) {
                        load_group('joined');
                    }
                    $('#leave_group').modal('hide');
                    $('.group .profile-main, .group #timeline_grp_photo, .group #timeline_grp_video, .group #timeline_grp_file, .group #timeline_grp_location, .group #delete_grp_post').remove();
                }
            });
        });
    }

    if ($('#delete_group_mem_form').length) {
        $('#delete_group_mem_form').submit(function (e) {
            e.preventDefault();
            var id = $('#delete_group_mem_form #delete_group_mem_id').val();
            var type = $('#delete_group_mem_form #delete_group_mem_type').val();
            remove_grp_member(id, type);
            $('#delete_group_mem').modal('hide');
        });
    }

    if ($('#leave_conn_form').length) {
        $('#leave_conn_form').submit(function (e) {
            e.preventDefault();
            var id = $('#leave_conn_form #leave_conn_id').val();
            var type = $('#leave_conn_form #leave_conn_type').val();
            delete_req(id, type);
            $('#leave_conn').modal('hide');
        });
    }

    if ($('#block_conn_form').length) {
        $('#block_conn_form').submit(function (e) {
            e.preventDefault();
            var id = $('#block_conn_form #block_conn_id').val();
            var type = $('#block_conn_form #block_conn_type').val();
            block_connection(id, type);
            $('#block_conn').modal('hide');
        });
    }

    if ($('#unblock_conn_form').length) {
        $('#unblock_conn_form').submit(function (e) {
            e.preventDefault();
            var id = $('#unblock_conn_form #unblock_conn_id').val();
            var type = $('#unblock_conn_form #unblock_conn_type').val();
            delete_req(id, type);
            $('#unblock_conn').modal('hide');
        });
    }

    if ($('.post_tags').length) {
        $('.post_tags').select2({
            tags: true,
            allowClear: true
        });
    }

    if ($('#add_timeline_photo').length) {
        $('#add_timeline_photo').submit(function (e) {
            e.preventDefault();
        }).validate({
            errorClass: 'validation-error',
            rules: {
                privacy: {required: true},
                'timeline_photo_upload[]': {required: true, extension: "jpg|png|jpeg"}
            },
            messages: {
                'timeline_photo_upload[]': {extension: 'Only jpg | png formats allowed'}
            },
            submitHandler: function () {
                $('#add_timeline_photo #loader').fadeIn();
                $('#add_timeline_photo .modal-footer .btn-primary').prop('disabled', true);
                var fd = new FormData();
                var filedata = document.getElementById("timeline_photo_upload");
                var i = 0, len = filedata.files.length, file;
                for (; i < len; i++) {
                    file = filedata.files[i];
                    if (fd) {
                        fd.append('file' + i, file);
                    }
                }
                var other_data = $('#add_timeline_photo').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/timeline_submit?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#add_timeline_photo #loader').fadeOut();
                        if (data == 'error') {
                            $('#add_timeline_photo #form_alert').text('Validation error occured. Please try again.').fadeIn();
                            $('#add_timeline_photo .modal-footer .btn-primary').prop('disabled', false);
                        }
                        if (data == 'success') {
                            document.getElementById("add_timeline_photo").reset();
                            $('#add_timeline_photo .post_tags').val('').trigger('change');
                            new PNotify({title: 'Success', delay: 1000, text: 'You have successfully posted to your timeline.', type: 'success'});
                            load_trendingfeed();
                            $('#add_timeline_photo .modal-footer .btn-primary').prop('disabled', false);
                            $('#timeline_photo').modal('hide');
                        }
                    }
                });
                return false;
            }
        });
    }

    if ($('#add_timeline_video').length) {
        $('#add_timeline_video').submit(function (e) {
            e.preventDefault();
        }).validate({
            errorClass: 'validation-error',
            rules: {
                privacy: {required: true},
                timeline_video_upload: {required: true, extension: "mp4"}
            },
            messages: {
                timeline_video_upload: {extension: 'Only mp4 format allowed'}
            },
            submitHandler: function () {
                $('#add_timeline_video #loader').fadeIn();
                $('#add_timeline_video .modal-footer .btn-primary').prop('disabled', true);
                var fd = new FormData();
                var file_up = $('#timeline_video_upload').get(0).files[0];
                fd.append('file', file_up);
                var other_data = $('#add_timeline_video').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/timeline_submit?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#add_timeline_video #loader').fadeOut();
                        if (data == 'error') {
                            $('#add_timeline_video #form_alert').text('Validation error occured. Please try again.').fadeIn();
                            $('#add_timeline_video .modal-footer .btn-primary').prop('disabled', false);
                        }
                        if (data == 'success') {
                            document.getElementById("add_timeline_video").reset();
                            $('#add_timeline_video .post_tags').val('').trigger('change');
                            new PNotify({title: 'Success', delay: 1000, text: 'You have successfully posted to your timeline.', type: 'success'});
                            load_trendingfeed();
                            $('#add_timeline_video .modal-footer .btn-primary').prop('disabled', false);
                            $('#timeline_video').modal('hide');
                        }
                    }
                });
                return false;
            }
        });
    }

    if ($('#add_timeline_file').length) {
        $('#add_timeline_file').submit(function (e) {
            e.preventDefault();
        }).validate({
            errorClass: 'validation-error',
            rules: {
                title: {required: true},
                privacy: {required: true},
                timeline_file_upload: {required: true, extension: "pdf|txt|doc|docx|xlsx|xls|csv|ppt|pptx"}
            },
            messages: {
                timeline_file_upload: {extension: 'Only pdf | txt | doc| docx | xlsx | xls | csv | ppt | pptx formats allowed'}
            },
            submitHandler: function () {
                $('#add_timeline_file #loader').fadeIn();
                $('#add_timeline_file .modal-footer .btn-primary').prop('disabled', true);
                var fd = new FormData();
                var file_up = $('#timeline_file_upload').get(0).files[0];
                fd.append('file', file_up);
                var other_data = $('#add_timeline_file').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/timeline_submit?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#add_timeline_file #loader').fadeOut();
                        if (data == 'error') {
                            $('#add_timeline_file #form_alert').text('Validation error occured. Please try again.').fadeIn();
                            $('#add_timeline_file .modal-footer .btn-primary').prop('disabled', false);
                        }
                        if (data == 'success') {
                            document.getElementById("add_timeline_file").reset();
                            $('#add_timeline_file .post_tags').val('').trigger('change');
                            new PNotify({title: 'Success', delay: 1000, text: 'You have successfully posted to your timeline.', type: 'success'});
                            load_trendingfeed();
                            $('#add_timeline_file .modal-footer .btn-primary').prop('disabled', false);
                            $('#timeline_file').modal('hide');
                        }
                    }
                });
                return false;
            }
        });
    }

    if ($('#add_timeline_location').length) {
        $('#add_timeline_location').submit(function (e) {
            e.preventDefault();
        }).validate({
            errorClass: 'validation-error',
            rules: {
                title: {required: true},
                privacy: {required: true},
                map_input: {required: true}
            },
            messages: {
                map_input: 'Enter a location and click on search'
            },
            submitHandler: function () {
                $('#add_timeline_location #loader').fadeIn();
                $('#add_timeline_location .modal-footer .btn-primary').prop('disabled', true);
                var fd = new FormData();
                var other_data = $('#add_timeline_location').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/timeline_submit?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#add_timeline_location #loader').fadeOut();
                        if (data == 'error') {
                            $('#add_timeline_location #form_alert').text('Validation error occured. Please try again.').fadeIn();
                            $('#add_timeline_location .modal-footer .btn-primary').prop('disabled', false);
                        } else {
                            document.getElementById("add_timeline_location").reset();
                            $('#add_timeline_location .post_tags').val('').trigger('change');
                            new PNotify({title: 'Success', delay: 1000, text: 'You have successfully posted to your timeline.', type: 'success'});
                            load_trendingfeed();
                            $('#add_timeline_location .modal-footer .btn-primary').prop('disabled', false);
                            $('#timeline_location').modal('hide');
                        }
                    }
                });
                return false;
            }
        });
    }

    if ($('#timeline_main').length) {
        $('#timeline_main').submit(function (e) {
            e.preventDefault();
            $('.news_feed_form #loader-home').fadeIn();
            var val = $('#timeline_main .timeline_message').val();
            if (val != '') {
                $.post(base_url + 'dashboard/timeline_submit', {message: val, submit_type: 'timeline_thought'}, function (data) {
                    if (data != 'error') {
                        document.getElementById("timeline_main").reset();
                        $('#timeline_main .timeline_message').css('border-color', '#ccc');
                        load_trendingfeed();
                        new PNotify({title: 'Success', delay: 1000, text: 'You have successfully posted to your timeline.', type: 'success'});
                    }
                });
            } else {
                $('#timeline_main .timeline_message').attr('placeholder', 'Type something here!');
            }
            $('.news_feed_form #loader-home').fadeOut();
        });
    }

    if ($('#delete_timeline_post_form').length) {
        $('#delete_timeline_post_form').submit(function (e) {
            e.preventDefault();
            var post_id = $('#delete_timeline_post_form #delete_post_id').val();
            $.post(base_url + 'dashboard/delete_user_timeline_post', {post_id: post_id}, function (data) {
                if (data == 'success') {
                    new PNotify({title: 'Success', delay: 1000, text: 'You have successfully deleted the post.', type: 'success'});
                    $('#timeline .timeline_post[data-post-id = ' + post_id + ']').remove();
                    $('#delete_timeline_post').modal('hide');
                    if (!$('#timeline .timeline_post').length) {
                        $('#newsfeed #load_more').hide();
                    }
                    if ($('.recent_act').length) {
                        $('.recent_act #timeline').html('<h4 class="no_error">No post to show.</h4>')
                    }
                    if (!$('.profile-main #timeline .timeline_post').length) {
                        $('.profile-main #load_more').hide();
                        $('.profile-main .profile-head').text('No timeline to show!');
                    }
                }
            });
        });
    }

    if ($('#timeline_post_privacy').length) {
        $('#timeline_post_privacy').submit(function (e) {
            e.preventDefault();
            var fd = new FormData();
            var other_data = $('#timeline_post_privacy').serializeArray();
            $.each(other_data, function (key, input) {
                fd.append(input.name, input.value);
            });
            $.ajax({
                url: base_url + 'dashboard/timeline_privacy?' + other_data,
                type: 'POST',
                data: fd,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data == 'success') {
                        new PNotify({title: 'Success', delay: 1000, text: 'You have successfully updated the privacy.', type: 'success'});
                        $('#timeline_privacy').modal('hide');
                    }
                }
            });
        });
    }

    if ($('.profile_update').length) {
        $('#update_user_info').submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                fname: {required: true},
                lname: {required: true},
                address: {required: true},
                city: {required: true},
                state: {required: true},
                country: {required: true},
                prof: {required: true},
                mobile: {required: true, number: true, minlength: 10},
                desc: {required: true},
                facebook: {url: true},
                linkedin: {url: true},
                twitter: {url: true},
                google: {url: true}
            },
            submitHandler: function () {
                $('.profile_update .form-actions #loader').fadeIn();
                var fd = new FormData();
                var other_data = $('#update_user_info').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/update_user_info',
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('.profile_update .form-actions #loader').fadeOut();
                        if (data == 'error') {
                            $('.profile_update #personal #form_alert').text('Validation error occured. Please try again.').fadeIn();
                        }
                        if (data == 'success') {
                            window.location = base_url + 'dashboard/profile_update';
                        }
                    }
                });
                return false;
            }
        });

        $('#update_org_info').submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                name: {required: true},
                address: {required: true},
                city: {required: true},
                website: {url: true},
                state: {required: true},
                country: {required: true},
                about: {required: true},
                tel: {required: true, number: true, minlength: 10},
                fax: {number: true},
                facebook: {url: true},
                linkedin: {url: true},
                twitter: {url: true},
                google: {url: true}
            },
            submitHandler: function () {
                $('.profile_update .form-actions #loader').fadeIn();
                var fd = new FormData();
                var other_data = $('#update_org_info').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/update_org_info',
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('.profile_update .form-actions #loader').fadeOut();
                        if (data == 'error') {
                            $('.profile_update #personal #form_alert').text('Validation error occured. Please try again.').fadeIn();
                        }
                        if (data == 'success') {
                            window.location = base_url + 'dashboard/profile_update';
                        }
                    }
                });
                return false;
            }
        });

        $('.profile_update .select_area').select2({
            tags: false,
            dropdownParent: $('.select_box')
        });

        $('.profile_update .hobbies').select2({
            tags: true,
            dropdownParent: $('.hobbie_box')
        });

        $('.profile_update .country-select').select2({
            dropdownParent: $('.country_box')
        });

        $('.profile_update .gender-select').select2({
            minimumResultsForSearch: -1,
            dropdownParent: $('.gender_box')
        });

        $('.profile_update .job-select').select2({
            minimumResultsForSearch: -1,
            dropdownParent: $('.job_box')
        });
    }

    if ($('#update_password').length) {
        $('#update_password').submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                pass: {required: true},
                new_pass: {required: true},
                re_pass: {equalTo: "#new_password"}
            },
            messages: {
                re_pass: 'Please retype the same password'
            },
            submitHandler: function () {
                $('#update_password #loader').fadeIn();
                var form = document.getElementById('update_password');
                var fd = new FormData(form);
                $.ajax({
                    url: base_url + 'dashboard/profile_settings_update',
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#update_password #loader').fadeOut();
                        if (data == 'error') {
                            $('#update_password #form_alert').addClass('alert-danger').text('Previous password do not match.').fadeIn();
                        }
                        if (data == 'success') {
                            window.location = base_url + 'login?status=success';
                        }
                    }
                });
                return false;
            }
        });
    }

    $('#update-email').on('click', function (e) {
        e.preventDefault();
        var email = $('#new_email').val();
        if (email != '') {
            var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
            if (!pattern.test(email)) {
                new PNotify({title: 'Error', delay: 1000, text: 'Please enter a valid email ID', type: 'error'});
            } else {
                $.post(base_url + 'dashboard/profile_settings_update', {email: email}, function (data) {
                    if (data == 'success') {
                        window.location = base_url + 'dashboard/profile_update';
                    }
                    if (data == 'error') {
                        new PNotify({title: 'Error', delay: 1000, text: 'Email ID already exists', type: 'error'});
                    }
                });
            }
        } else {
            new PNotify({title: 'Error', delay: 1000, text: 'Please enter your new email ID', type: 'error'});
        }
    });

    $('#settings .privacy-item').change(function () {
        if ($(this).is(':checked')) {
            var value = $(this).val();
            var type = $(this).attr('data-type');
            $.post(base_url + 'dashboard/profile_settings_update', {type: type, value: value}, function (data) {
                if (data == 'success') {
                    if (type == 'jobportal') {
                        location.reload();
                    } else {
                        new PNotify({title: 'Success', delay: 1000, text: 'Privacy successfully updated.', type: 'success'});
                    }
                }
                if (type == 'connection_deny' && value == 0) {
                    $('#settings .conn_list').fadeIn();
                }
                if (type == 'connection_deny' && value == 1) {
                    $('#settings .conn_list').fadeOut();
                }
            });
        }
    });

    if ($('.navbar-right .notifications').length) {
        setInterval(function () {
            load_new_notification();
        }, 10000);

        $(".navbar-right .notifications .dropdown-menu .media-container ul li").sort(sort_notifications).appendTo('.navbar-right .notifications .dropdown-menu .media-container ul');
    }

    if ($('.navbar-right .req_notifications').length) {
        setInterval(function () {
            load_new_connection_req();
        }, 11000);
    }

    $('.navbar-right .notifications .btn-notification').click(function () {
        $(this).find('.bubble').fadeOut();
        $.post(base_url + 'dashboard/remove_notification_alert', function (data) {
            if (data == 'success') {
                console.log('save the world!');
            }
        });
    });

    $('.navbar-right .req_notifications .btn-notification').click(function () {
        $(this).find('.bubble').fadeOut();
        $.post(base_url + 'dashboard/remove_req_notification_alert', function (data) {
            if (data == 'success') {
                console.log('save the world!');
            }
        });
    });

    if ($('.recent-act').length) {
        setInterval(function () {
            load_recent_act();
        }, 20000);

        $('.recent-act .nano').nanoScroller();
    }

    if ($('.notification-block').length) {
        $('.notification-block .streamline .sl-item').sort(sort_notifications).appendTo('.notification-block .streamline');
    }

    if ($('#add_post_form').length) {
        $('#add_post_form .country-select').select2({
            dropdownParent: $('.country-block')
        });

        $('.post-search .country-search').select2({
            dropdownParent: $('.country_search_box')
        });

        $('#add_post_form .type_select').select2({
            minimumResultsForSearch: -1,
            dropdownParent: $('.type-box')
        });

        $('#add_post_form .select_post_area').select2({
            minimumResultsForSearch: -1,
            dropdownParent: $('.category-box')
        });

        $('#add_post_form .post_tags').select2({
            tags: true
        });

        $('#add_post_form').submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                title: {required: true},
                post_desc: {required: true},
                post_img_up: {extension: "jpg|png|jpeg"},
                post_video_up: {extension: "mp4"}
            },
            messages: {
                post_img_up: 'Only jpg | png formats allowed',
                post_video_up: 'Only mp4 format allowed'
            },
            submitHandler: function () {
                $('#add_post_form #loader').fadeIn();
                $('#add_post_form .modal-footer .btn-primary').prop('disabled', true);
                var fd = new FormData();
                var img_up = document.getElementById('post_img_up');
                var i = 0, len = img_up.files.length, file;
                for (; i < len; i++) {
                    file = img_up.files[i];
                    if (fd) {
                        fd.append('file' + i, file);
                    }
                }
                var video_up = $('#post_video_up').get(0).files[0];
                fd.append('Video', video_up);
                var other_data = $('#add_post_form').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/submit_post?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#add_post_form #loader').fadeOut();
                        if (data == 'success') {
                            document.getElementById("add_post_form").reset();
                            $('#add_listing .post_tags').val('').trigger('change');
                            $('#add_listing .country-select').val('0').trigger('change');
                            $('#add_listing .select_post_area').val('1,1').trigger('change');
                            $('#add_listing .type_select').val('').trigger('change');
                            new PNotify({title: 'Success', delay: 1000, text: 'You have successfully added an SOS.', type: 'success'});
                            load_ads();
                            setTimeout(function () {
                                $('.listing .nav-tabs-solid li, .listing .social .tab-pane').removeClass('active');
                                $('.listing .nav-tabs-solid .dropdown, .listing .social #ad_tab').addClass('active');
                            }, 100);
                            $('#form_alert').hide();
                            $('#add_post_form .modal-footer .btn-primary').prop('disabled', false);
                            $('#add_listing').modal('hide');
                        } else {
                            $('#form_alert').html(data).fadeIn();
                            $('#add_post_form .modal-footer .btn-primary').prop('disabled', false);
                        }
                    }
                });
                return false;
            }
        });
    }
    
    if ($('.add_post_form_two').length) {
        $('.add_post_form_two .type_select').select2({
            minimumResultsForSearch: -1,
            dropdownParent: $('.type_select_box')
        });
        
        $('.add_post_form_two .post_tags').select2({
            tags: true,
            dropdownParent: $('.post_tags_box')
        });
        
        $('.add_post_form_two .country-select').select2({
            dropdownParent: $('.country_box_two')
        });
        
        $('.add_post_form_two').submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                title: {required: true},
                post_desc: {required: true},
                terms: {required: true}, 
                post_img_up: {extension: "jpg|png|jpeg"},
                post_video_up: {extension: "mp4"}
            },
            messages: {
                post_img_up: 'Only jpg | png formats allowed',
                post_video_up: 'Only mp4 format allowed'
            },
            submitHandler: function () {
                $('.add_post_form_two #loader').fadeIn();
                $('.add_post_form_two .modal-footer .btn-primary').prop('disabled', true);
                var fd = new FormData();
                var img_up = document.getElementById('post_img_up_two');
                var i = 0, len = img_up.files.length, file;
                for (; i < len; i++) {
                    file = img_up.files[i];
                    if (fd) {
                        fd.append('file' + i, file);
                    }
                }
                var video_up = $('#post_video_up_two').get(0).files[0];
                fd.append('Video', video_up);
                var other_data = $('.add_post_form_two').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/submit_post_upgrade?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('.add_post_form_two #loader').fadeOut();
                        if (data == 'success') {
                            document.getElementById("add_post_form").reset();
                            $('.add_post_form_two .post_tags').val('').trigger('change');
                            $('.add_post_form_two .type_select').val('').trigger('change');
                            new PNotify({title: 'Success', delay: 1000, text: 'You have successfully added an SOS.', type: 'success'});
                            $('.add_listing_two .alert-danger').hide();
                            $('.add_post_form_two .modal-footer .btn-primary').prop('disabled', false);
                            $('.add_listing_two').modal('hide');
                        } else {
                            $('.add_listing_two .alert-danger').html(data).fadeIn();
                            $('.add_listing_two .modal-footer .btn-primary').prop('disabled', false);
                        }
                    }
                });
                return false;
            }
        });
    }
    
    if ($('#update_post_form').length) {
        $('#update_post_form').submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                title: {required: true},
                post_desc: {required: true},
                post_img_up: {extension: "jpg|png|jpeg"},
                post_video_up: {extension: "mp4"}
            },
            messages: {
                post_img_up: 'Only jpg | png formats allowed',
                post_video_up: 'Only mp4 format allowed'
            },
            submitHandler: function () {
                $('#update_post_form #loader').fadeIn();
                var page_type = $('#post_update').attr('data-page');
                var fd = new FormData();
                var img_up = document.getElementById('post_update_img_up');
                var i = 0, len = img_up.files.length, file;
                for (; i < len; i++) {
                    file = img_up.files[i];
                    if (fd) {
                        fd.append('file' + i, file);
                    }
                }
                var video_up = $('#post_update_video_up').get(0).files[0];
                fd.append('Video', video_up);
                var other_data = $('#update_post_form').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/update_post?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#post_update #loader').fadeOut();
                        if (data == 'error') {
                            $('#update_post_form #form_alert_update').text('Validation error occured. Please fill in all the fields and try again.').fadeIn();
                        }
                        if (data == 'success') {
                            if (page_type == 'single') {
                                location.reload();
                            } else {
                                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully updated the SOS.', type: 'success'});
                                load_ads();
                                $('#update_post_form #form_alert_update').hide();
                                $('#post_update').modal('hide');
                            }
                        }
                    }
                });
                return false;
            }
        });
    }

    $('#delete_post_form').submit(function (e) {
        e.preventDefault();
        $('#post_delete #loader').fadeIn();
        var id = $('#post_delete #post_id').val();
        var page_type = $('#post_delete #post_page').val();
        $.post(base_url + 'dashboard/delete_post', {id: id, page_type: page_type}, function (data) {
            if (data == 'success') {
                if (page_type == 'single') {
                    window.location = base_url + 'dashboard/worthact_initiatives';
                } else {
                    new PNotify({title: 'Success', delay: 1000, text: 'You have successfully deleted the SOS.', type: 'success'});
                    $('.listing #listing_table .ad[data-post = ' + id + ']').remove();
                    $('#post_delete').modal('hide');
                    $('#post_delete #loader').fadeOut();
                    if (!$('#listing_table .ad').length) {
                        $('#ad_tab #load_more').hide();
                        $('#ad_tab #listing_table').html('<h4 class="no_ads">No SOS to show. <a class="add-job-md trans" data-toggle="modal" data-target="#add_listing">Add new</a></h4>');
                    }
                    if (!$('.profile-main .listing .ad').length) {
                        $('.profile-main #load_more').hide();
                        $('.profile-main .profile-head').text('No SOS to show!');
                    }
                }
            }
        });
    });

    $('#add_post_action').submit(function (e) {
        e.preventDefault();
        $('#add_post_action #loader').fadeIn();
        var id = $('#add_post_action #post_action_id').val();
        var desc = $('#add_post_action #post_action_desc').val();
        var post_id = $('#add_post_action #post_action_id').attr('data-id');
        $.post(base_url + 'dashboard/post_actions', {post_id: post_id, action_id: id, desc: desc}, function (data) {
            if (data == 'success') {
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully submitted your action for the SOS.', type: 'success'});
                $('#modal_actions').modal('hide');
                $('#add_post_action #loader').fadeOut();
                document.getElementById("add_post_action").reset();
            }
        });
    });

    $('#acc_listing .list-group .sub-cat-item').click(function (e) {
        e.preventDefault();
        var cat_id = $(this).attr('data-cat-id');
        $('#acc_listing .list-group .sub-cat-item').removeClass('checked');
        $(this).addClass('checked');
        $('.listing #listing_table').attr('data-cat-id', cat_id);
        $('.listing #info .readmore').show();
        $('.listing #info .main_data').css('height', '500px');
        load_ads();
        load_post_related_users(cat_id);
        load_post_related_data(cat_id);
        $('.listing .nav-tabs-solid .actions span').text('Your Possibilities');
        setTimeout(function () {
            $('.listing .nav-tabs-solid li, .listing .social .tab-pane').removeClass('active');
            $('.listing .nav-tabs-solid .info, .listing .social #info').addClass('active');
            $('.listing #info #read_less_info').hide();
            $('#read_more_info').removeClass('level_2');
        }, 100);
    });

    $('#read_full_info').click(function () {
        $('.listing #info .main_data').css('height', 'auto');
        $('.listing #info .readmore').hide();
        $('.listing #info #read_less_info').show();
        $('.listing #user').css('margin-top', '20px');
    });

    $('#read_less_info').click(function () {
        $('.listing #info .readmore').show();
        $('.listing #info .main_data').css('height', '500px');
        $('.listing #user').css('margin-top', '55px');
        $(this).hide();
    });

    $('#read_more_info').click(function () {
        if ($(this).hasClass('level_2')) {
            $('.listing #info .main_data').css('height', 'auto');
            $('.listing #info .readmore').hide();
            $('.listing #user').css('margin-top', '20px');
            $('.listing #info #read_less_info').show();
            $(this).removeClass('level_2');
        } else {
            $('.listing #info .main_data').css('height', '700');
            $(this).addClass('level_2');
        }
    });

    if ($('.post-single .comment').length) {
        $(".fancybox").fancybox({
            helpers: {
                overlay: {
                    locked: false
                }
            }
        });
        $('video,audio').mediaelementplayer({
            enableAutosize: true
        });
    }

    if ($('.recent_act').length) {
        $(".fancybox").fancybox({
            helpers: {
                overlay: {
                    locked: false
                }
            }
        });
        $('video,audio').mediaelementplayer({
            enableAutosize: true
        });
    }

    if ($('#update_propic').length) {
        $('#delete_propic_form').submit(function (e) {
            e.preventDefault();
        }).validate({
            submitHandler: function () {
                $('#delete_propic_form #loader').fadeIn();
                $.ajax({
                    url: base_url + 'dashboard/delete_propic',
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#delete_propic_form #loader').fadeOut();
                        if (data == 'success') {
                            window.location.reload();
                        }
                    }
                });
                return false;
            }
        });
    }

    if ($('#update_banner').length) {
        $('#delete_banner_form').submit(function (e) {
            e.preventDefault();
        }).validate({
            submitHandler: function () {
                $('#delete_banner_form #loader').fadeIn();
                $.ajax({
                    url: base_url + 'dashboard/delete_banner',
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#delete_banner_form #loader').fadeOut();
                        if (data) {
                            window.location = base_url + 'dashboard/profile/' + data;
                        }
                    }
                });
                return false;
            }
        });
    }

    if ($('.job-listing').length) {
        $('.country-search').select2({
            dropdownParent: $('.country_search_box')
        });

        $('#job_user_level').select2();

        $('#job_user_type').select2();

        $('.experience-select').select2({
            minimumResultsForSearch: -1
        });

        $('#job_cat').select2({
            dropdownParent: $('.cat_box')
        });

        $('#job_cat_form').select2({
            dropdownParent: $('.cat_form_box')
        });

        $('.country-select').select2();

        $('.job_tags').select2({
            tags: true,
            allowClear: true,
            dropdownParent: $('.search_tag_box')
        });

        $('.place-ad').click(function () {
            if ($('#adtype').is(":visible")) {
                $('#adtype').css('display', 'none');
            } else {
                $('#adtype').css('display', 'block');
            }
        });

        $('#add_job_form').submit(function (e) {
            e.preventDefault();
        }).validate({
            errorClass: 'validation-error',
            rules: {
                title: {required: true},
                job_desc: {required: true},
                job_end_date: {required: true},
                job_email: {email: true},
                job_website: {url: true},
                'job_img_up[]': {extension: "jpg|png|jpeg"}
            },
            messages: {
                'job_img_up[]': {extension: 'Only jpg | png formats allowed'},
                job_website: {url: "URL format should be like http://example.com/.."}
            },
            submitHandler: function () {
                $('#add_job_form #loader').fadeIn();
                $('#add_job_form .alert').fadeOut();
                $('#add_job_form .modal-footer .btn-primary').prop('disabled', true);
                var fd = new FormData();
                var filedata = document.getElementById("job_img_up");
                if (filedata != null) {
                    var i = 0, len = filedata.files.length, file;
                    for (; i < len; i++) {
                        file = filedata.files[i];
                        if (fd) {
                            fd.append('file' + i, file);
                        }
                    }
                }
                var other_data = $('#add_job_form').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/submit_job?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#add_job_form #loader').fadeOut();
                        if (data == 'success') {
                            document.getElementById("add_job_form").reset();
                            $('#add_job_form .job_tags').val('').trigger('change');
                            $('#add_job_form #job_cat_form').val('0').trigger('change');
                            $('#add_job_form #job_user_level').val('0').trigger('change');
                            $('#add_job_form #job_user_type').val('0').trigger('change');
                            $('#add_job_form #country').val('0').trigger('change');
                            new PNotify({title: 'Success', delay: 1000, text: 'You have successfully posted your job.', type: 'success'});
                            manage_jobs();
                            $('#add_job_form .modal-footer .btn-primary').prop('disabled', false);
                            $('#post_job').modal('hide');
                        } else {
                            $('#add_job_form .alert').html(data).fadeIn();
                            $('#add_job_form .modal-footer .btn-primary').prop('disabled', false);
                        }
                    }
                });
                return false;
            }
        });

        $('#delete_job_form').submit(function (e) {
            e.preventDefault();
            $('#delete_job_form #loader').fadeIn();
            var id = $('#delete_job_form #job_delete_id').val();
            $.post(base_url + 'dashboard/delete_job', {id: id}, function (data) {
                if (data == 'success') {
                    new PNotify({title: 'Success', delay: 1000, text: 'You have successfully deleted the job post.', type: 'success'});
                    $('#joblist-tab #listing_table .job[data-job = ' + id + ']').remove();
                    $('#delete_job').modal('hide');
                    $('#delete_job #loader').fadeOut();
                    if (!$('#joblist-tab #listing_table .job').length) {
                        $('#joblist-tab #listing_table').html('<h4 class="no_results">No job post added. <a class="trans" data-toggle="modal" data-target="#post_job">Add now</h4><a/></h4>');
                    }
                }
            });
        });

        $('#update_job_form').submit(function (e) {
            e.preventDefault();
        }).validate({
            errorClass: 'validation-error',
            rules: {
                title: {required: true},
                job_desc: {required: true},
                job_end_date: {required: true},
                job_email: {email: true},
                job_website: {url: true},
                'job_update_img_up[]': {extension: "jpg|png|jpeg"}
            },
            messages: {
                'job_update_img_up[]': {extension: 'Only jpg | png formats allowed'}
            },
            submitHandler: function () {
                $('#update_job_form #loader').fadeIn();
                var fd = new FormData();
                var filedata = document.getElementById("job_update_img_up");
                if (filedata != null) {
                    var i = 0, len = filedata.files.length, file;
                    for (; i < len; i++) {
                        file = filedata.files[i];
                        if (fd) {
                            fd.append('file' + i, file);
                        }
                    }
                }
                var other_data = $('#update_job_form').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/update_job?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#update_job_form #loader').fadeOut();
                        if (data == 'success') {
                            new PNotify({title: 'Success', delay: 1000, text: 'You have successfully updated your job post.', type: 'success'});
                            manage_jobs();
                            $('#job_update').modal('hide');
                        } else {
                            $('#job_update .alert').html(data).fadeIn();
                        }
                    }
                });
                return false;
            }
        });

        $('#job_search_home').submit(function (e) {
            e.preventDefault();
        }).validate({
            submitHandler: function (form) {
                var country = $('#job_search_home #country').val();
                var cat = $('#job_search_home #job_cat').val();
                if (cat == '') {
                    $('#job_search_home .cat_box .select2-selection--single').css('border-color', '#ad0000');
                } else {
                    $('#job_search_home .cat_box .select2-selection--single').css('border-color', '#ddd');
                }
                if (country == '') {
                    $('#job_search_home .country_search_box .select2-selection--single').css('border-color', '#ad0000');
                } else {
                    $('#job_search_home .country_search_box .select2-selection--single').css('border-color', '#ddd');
                }
                if (cat != '' && country != '') {
                    window.location = base_url + 'dashboard/joblisting/jobs/' + cat + '/' + country;
                }
            }
        });

        $('#candidate_search_home').submit(function (e) {
            e.preventDefault();
        }).validate({
            submitHandler: function (form) {
                var country = $('#candidate_search_home #country').val();
                var cat = $('#candidate_search_home #job_cat').val();
                if (cat == '') {
                    $('#candidate_search_home .cat_box .select2-selection--single').css('border-color', '#ad0000');
                } else {
                    $('#candidate_search_home .cat_box .select2-selection--single').css('border-color', '#ddd');
                }
                if (country == '') {
                    $('#candidate_search_home .country_search_box .select2-selection--single').css('border-color', '#ad0000');
                } else {
                    $('#candidate_search_home .country_search_box .select2-selection--single').css('border-color', '#ddd');
                }
                if (cat != '' && country != '') {
                    window.location = base_url + 'dashboard/joblisting/candidates/' + cat + '/' + country;
                }
            }
        });

        $('#job_search').submit(function (e) {
            e.preventDefault();
        }).validate({
            submitHandler: function () {
                $('.top-nav-tab #loader').fadeIn();
                $('#job_search .alert').fadeOut().removeClass('alert-info').addClass('alert-danger');
                var fd = new FormData();
                var other_data = $('#job_search').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/job_search',
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data == 'no_result') {
                            $('#job_search .alert').removeClass('alert-danger').addClass('alert-info').text('No results found.').fadeIn();
                        } else if (data == 'error') {
                            $('#job_search .alert').text('Select both country and category').fadeIn();
                        } else {
                            $('#joblist-tab #listing_table').html('');
                            $('#joblist-tab #listing_table').html(data);
                            $('.job-search .job_tags').val('').trigger('change');
                            $('.job-search #country').val('').trigger('change');
                            $('.job-search #job_cat').val('').trigger('change');
                        }
                        $('.top-nav-tab #loader').fadeOut();
                    }
                });
                return false;
            }
        });

        $('#candidate_search').submit(function (e) {
            e.preventDefault();
        }).validate({
            submitHandler: function () {
                $('#candidate_search .alert').fadeOut().removeClass('alert-info').addClass('alert-danger');
                var fd = new FormData();
                var other_data = $('#candidate_search').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/candidates_search',
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data == 'no_result') {
                            $('#candidate_search .alert').removeClass('alert-danger').addClass('alert-info').text('No results found.').fadeIn();
                        } else if (data == 'error') {
                            $('#candidate_search .alert').text('Select both country and category').fadeIn();
                        } else {
                            $('#joblist-tab #listing_table').html('');
                            $('#joblist-tab #listing_table').html(data);
                            $('#joblist-tab #load_more').hide();
                            $('#candidate_search .job_tags').val('').trigger('change');
                            $('#candidate_search #country').val('').trigger('change');
                            $('#candidate_search #job_cat').val('').trigger('change');
                        }
                    }
                });
                return false;
            }
        });

        $('#cv_update_form').submit(function (e) {
            e.preventDefault();
        }).validate({
            errorClass: 'validation-error',
            rules: {
                post: {required: true},
                company: {required: true},
                job_cv_up: {extension: "pdf|txt|docx|doc|txt"}
            },
            messages: {
                job_cv_up: {extension: 'Only pdf | docx | doc | txt formats allowed'}
            },
            submitHandler: function () {
                $('#cv_update_form #loader').fadeIn();
                $('#cv_update_form .alert').fadeOut();
                $('#cv_update_form .modal-footer .btn-primary').prop('disabled', true);
                var fd = new FormData();
                var file_up = $('#job_cv_up').get(0).files[0];
                fd.append('file', file_up);
                var other_data = $('#cv_update_form').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/cv_head_update?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data == 'success') {
                            window.location.reload();
                        } else {
                            $('#cv_update_form .alert').fadeIn().html(data);
                            $('#cv_update_form .modal-footer .btn-primary').prop('disabled', false);
                        }
                    }
                });
                return false;
            }
        });

        $('#cv_job_form').submit(function (e) {
            e.preventDefault();
        }).validate({
            errorClass: 'validation-error',
            rules: {
                job_title: {required: true},
                objective: {required: true},
                monthly_salary: {required: true},
                last_salary: {required: true},
                notice: {required: true}
            },
            submitHandler: function () {
                $('#cv_job_form #loader').fadeIn();
                $('#cv_job_form .alert').fadeOut();
                $('#cv_job_form .modal-footer .btn-primary').prop('disabled', true);
                var fd = new FormData();
                var other_data = $('#cv_job_form').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/cv_job_update?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data == 'success') {
                            window.location.reload();
                        } else {
                            $('#cv_job_form .alert').fadeIn().html(data);
                            $('#cv_job_form .modal-footer .btn-primary').prop('disabled', false);
                        }
                    }
                });
                return false;
            }
        });

        $('#cv_personal_form').submit(function (e) {
            e.preventDefault();
        }).validate({
            errorClass: 'validation-error',
            rules: {
                age: {required: true, min: 14},
                nationality: {required: true},
                dependents: {required: true, min: 0}
            },
            submitHandler: function () {
                $('#cv_personal_form #loader').fadeIn();
                $('#cv_personal_form .alert').fadeOut();
                $('#cv_personal_form .modal-footer .btn-primary').prop('disabled', true);
                var fd = new FormData();
                var other_data = $('#cv_personal_form').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/cv_personal_update?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data == 'success') {
                            window.location.reload();
                        } else {
                            $('#cv_personal_form .alert').fadeIn().html(data);
                            $('#cv_personal_form .modal-footer .btn-primary').prop('disabled', false);
                        }
                    }
                });
                return false;
            }
        });

        $('#cv_experience_form').submit(function (e) {
            e.preventDefault();
        }).validate({
            errorClass: 'validation-error',
            rules: {
                title: {required: true},
                company: {required: true},
                responsibilities: {required: true}
            },
            submitHandler: function () {
                $('#cv_experience_form #loader').fadeIn();
                $('#cv_experience_form .alert').fadeOut();
                $('#cv_experience_form .modal-footer .btn-primary').prop('disabled', true);
                var fd = new FormData();
                var other_data = $('#cv_experience_form').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/cv_experience_update?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data == 'success') {
                            window.location.reload();
                        } else {
                            $('#cv_experience_form #loader').fadeOut();
                            $('#cv_experience_form .alert').fadeIn().html(data);
                            $('#cv_experience_form .modal-footer .btn-primary').prop('disabled', false);
                        }
                    }
                });
                return false;
            }
        });

        $('#cv_education_form').submit(function (e) {
            e.preventDefault();
        }).validate({
            errorClass: 'validation-error',
            rules: {
                title: {required: true},
                collage: {required: true},
                grade: {required: true}
            },
            submitHandler: function () {
                $('#cv_education_form #loader').fadeIn();
                $('#cv_education_form .alert').fadeOut();
                $('#cv_education_form .modal-footer .btn-primary').prop('disabled', true);
                var fd = new FormData();
                var other_data = $('#cv_education_form').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/cv_education_update?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data == 'success') {
                            window.location.reload();
                        } else {
                            $('#cv_education_form #loader').fadeOut();
                            $('#cv_education_form .alert').fadeIn().html(data);
                            $('#cv_education_form .modal-footer .btn-primary').prop('disabled', false);
                        }
                    }
                });
                return false;
            }
        });

        $('.job-listing .cv .info.list .row .delete_exp').click(function () {
            var id = $(this).attr('data-id');
            $('#delete_cv_exp #exp_id').val(id);
        });

        $('#delete_cv_exp_form').submit(function (e) {
            e.preventDefault();
        }).validate({
            submitHandler: function () {
                var id = $('#delete_cv_exp #exp_id').val();
                $('#delete_cv_exp_form #loader').fadeIn();
                $.post(base_url + 'dashboard/delete_cv_exp', {id: id}, function (data) {
                    if (data == 'success') {
                        $('#delete_cv_exp_form #loader').fadeOut();
                        new PNotify({title: 'Success', delay: 1000, text: 'You have successfully deleted the job experience.', type: 'success'});
                        $('.job-listing .cv .info.list .exp[data-id = ' + id + '], .job-listing .cv .alert-success').remove();
                        $('#delete_cv_exp').modal('hide');
                    }
                });
            }
        });

        $('.job-listing .cv .info.list .row .delete_edu').click(function () {
            var id = $(this).attr('data-id');
            $('#delete_cv_edu #edu_id').val(id);
        });

        $('#delete_cv_edu_form').submit(function (e) {
            e.preventDefault();
        }).validate({
            submitHandler: function () {
                var id = $('#delete_cv_edu #edu_id').val();
                $('#delete_cv_edu_form #loader').fadeIn();
                $.post(base_url + 'dashboard/delete_cv_edu', {id: id}, function (data) {
                    if (data == 'success') {
                        $('#delete_cv_edu_form #loader').fadeOut();
                        new PNotify({title: 'Success', delay: 1000, text: 'You have successfully deleted the education.', type: 'success'});
                        $('.job-listing .cv .info.list .edu[data-id = ' + id + '], .job-listing .cv .alert-success').remove();
                        $('#delete_cv_edu').modal('hide');
                    }
                });
            }
        });

        $('#submit_cv_propic').on('click', function () {
            $('#update_propic #loader').fadeIn();
            $('#submit_propic').prop('disabled', true);
            if ($('#crop').find('.resize-container').length != 0) {
                roboCropApp2.crop();
                var image = roboCropApp2.getImageBase64('png');
                $.post(base_url + 'dashboard/cv_propic', {image: image}, function (data) {
                    if (data == 'success') {
                        location.reload();
                    } else {
                        $('#update_propic #loader').fadeOut();
                        $('#update_propic .alert').text(data).fadeIn();
                        $('#submit_propic').prop('disabled', false);
                    }
                });
            } else {
                $('#update_propic #loader').fadeOut();
                $('#update_propic .alert').text('Please select an Image').fadeIn();
                $('#submit_cv_propic').prop('disabled', false);
            }
        });
    }

    if ($('.profile').length) {
        $(".fancybox").fancybox({
            helpers: {
                overlay: {
                    locked: false
                }
            }
        });
    }

    if ($('#invite_grp_mem_form').length) {
        $('#invite_grp_mem_form').submit(function (e) {
            e.preventDefault();
            $('#invite_grp_mem_form #loader').fadeIn();
            $('#invite_grp_mem_form .alert').fadeOut();
            var fd = new FormData();
            var other_data = $('#invite_grp_mem_form').serializeArray();
            $.each(other_data, function (key, input) {
                fd.append(input.name, input.value);
            });
            $.ajax({
                url: base_url + 'dashboard/send_grp_invitation?' + other_data,
                type: 'POST',
                data: fd,
                processData: false,
                contentType: false,
                success: function (data) {
                    $('#update_job_req_form #loader').fadeOut();
                    if (data == 'success') {
                        new PNotify({title: 'Success', delay: 1000, text: 'You have successfully sent the invitation.', type: 'success'});
                        $('#invite_grp_mem').modal('hide');
                    } else {
                        $('#invite_grp_mem_form .alert').text(data).fadeIn();
                    }
                    $('#invite_grp_mem_form #loader').fadeOut();
                }
            });
        });
    }

    $(document).on('click', '.view_like', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $.post(base_url + 'dashboard/get_liked_users', {id: id, type: type}, function (data) {
            if (data != '') {
                $('#user_likes .modal-body .row').html(data);
            } else {
                $('#user_likes .modal-body .row').html('<div class="alert alert-danger" role="alert">No users to show.</div>');
            }
            $('#user_likes').modal('show');
        });
    });

    $(document).on('click', '.view_dislike', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $.post(base_url + 'dashboard/get_disliked_users', {id: id, type: type}, function (data) {
            if (data != '') {
                $('#user_likes .modal-body .row').html(data);
            } else {
                $('#user_likes .modal-body .row').html('<div class="alert alert-danger" role="alert">No users to show!</div>');
            }
            $('#user_likes').modal('show');
        });
    });

    if ($('#user_likes').length) {
        $('#user_likes .modal-body').niceScroll({
            cursorcolor: '#777',
            cursorwidth: '5px'
        });
    }

    if ($('#share_post').length) {
        $('#share_post_form').submit(function (e) {
            e.preventDefault();
            var type_id = $('#share_post #share_post_id').val();
            var type = $('#share_post #share_post_type').val();
            var title = $('#share_post #share_post_title').val();
            $.post(base_url + 'dashboard/share_post', {type_id: type_id, type: type, title: title}, function (data) {
                if (type == 'newsfeed') {
                    if (data == 'success') {
                        new PNotify({title: 'Success', delay: 1000, text: 'You have successfully shared the post.', type: 'success'});
                        $('#share_post').modal('hide');
                        load_trendingfeed();
                    }
                }
                if (type == 'ad' || type == 'blog') {
                    if (data == 'success') {
                        new PNotify({title: 'Success', delay: 1000, text: 'You have successfully shared the ' + type + ' post.', type: 'success'});
                        $('#share_post').modal('hide');
                    }
                }
            });
        });
    }

    if ($('#contact_form').length) {
        $('#contact_form').submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                sub: {required: true},
                msg: {required: true}
            },
            submitHandler: function () {
                $('#contact_form #loader').fadeIn();
                $('#contact_form .alert').fadeOut();
                var sub = $('#contact_form #contact_sub').val();
                var msg = $('#contact_form #contact_msg').val();
                $.post(base_url + 'dashboard/contact', {sub: sub, msg: msg}, function (data) {
                    if (data == 'success') {
                        new PNotify({title: 'Success', delay: 1000, text: 'Thank you for your submission. We will get back with you shortly', type: 'success'});
                        document.getElementById("contact_form").reset();
                        $('#contact').modal('hide');
                    } else {
                        $('#contact_form .alert').text(data).fadeIn();
                    }
                    $('#contact_form #loader').fadeOut();
                });
                return false;
            }
        });
    }

    if ($('#report_form').length) {
        $('#report_form').submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                sub: {required: true},
                msg: {required: true}
            },
            submitHandler: function () {
                $('#report_form #loader').fadeIn();
                $('#report_form .alert').fadeOut();
                var sub = $('#report_form #report_sub').val();
                var msg = $('#report_form #report_msg').val();
                $.post(base_url + 'dashboard/report', {sub: sub, msg: msg}, function (data) {
                    if (data == 'success') {
                        new PNotify({title: 'Success', delay: 1000, text: 'Thank you for your submission.', type: 'success'});
                        document.getElementById("report_form").reset();
                        $('#report').modal('hide');
                    } else {
                        $('#report_form .alert').text(data).fadeIn();
                    }
                    $('#report_form #loader').fadeOut();
                });
                return false;
            }
        });
    }

    $('#letter_more').click(function () {
        $('.letter .content').css('height', 'auto');
        $('.letter .content').addClass('bg');
        $('#letter_more').hide();
        $('#letter_less').show();
    });

    $('#letter_less').click(function () {
        $('.letter .content').css('height', '175px');
        $('.letter .content').removeClass('bg');
        $('#letter_more').show();
        $('#letter_less').hide();
    });

    if ($('.home_sos .timeline_home').length || $('.payment-div').length || $('.csr_landing').length) {
        $('#player1').mediaelementplayer({
            enableAutosize: true
        });
        
        var timezone = tzdetect.matches()[0];
        $.ajax({
            type: "POST",
            url: base_url + 'dashboard/set_timezone',
            data: 'timezone=' + timezone,
            success: function () {
                console.log("Saving earth from "+ timezone +" \\(^_^)/");
                if(timezone == 'Asia/Calcutta' || timezone == 'Asia/Kolkata') {
                    setTimeout(function(){
                        $('#offer_home').modal('show');
                    }, 3000);
                }
            }
        });
    }

    if ($('#invite_email').length) {
        $('#invite_email .invite_tags').select2({
            tags: true
        });

        $('#invite_email .invite_type').select2({
            minimumResultsForSearch: -1
        });

        $('#invite_email_form').submit(function (e) {
            e.preventDefault();
            $('#invite_email_form #loader').fadeIn();
            $('#invite_email_form .alert').fadeOut();
            var email = $('#invite_email_form .invite_tags').val();
            var type = $('#invite_email_form .invite_type').val();
            var msg = $('#invite_email_form .invite_msg').val();
            $.post(base_url + 'dashboard/invitation', {email: email, type: type, msg: msg}, function (data) {
                if (data == 'success') {
                    document.getElementById("invite_email_form").reset();
                    $('#invite_email_form .invite_tags').val('').trigger('change');
                    $('#invite_email_form .invite_type').val('').trigger('change');
                    new PNotify({title: 'Success', delay: 1000, text: 'You have successfully sent the invitation.', type: 'success'});
                    $('#invite_email').modal('hide');
                } else {
                    $('#invite_email_form .alert').html(data).fadeIn();
                }
            });
            $('#invite_email_form #loader').fadeOut();
        });
    }

    $('.thumbnail .list-group-item').click(function () {
        $('.letter').hide();
    });

    $('.advisory_panel .block .read_more').click(function () {
        var id = $(this).attr('data-id');
        $('.advisory_panel .block[data-id = ' + id + '] .desc').css('height', 'auto');
        $(this).hide();
        $('.advisory_panel .block[data-id = ' + id + '] .read_less').show();
    });

    $('.advisory_panel .block .read_less').click(function () {
        var id = $(this).attr('data-id');
        $('.advisory_panel .block[data-id = ' + id + '] .desc').css('height', '150px');
        $(this).hide();
        $('.advisory_panel .block[data-id = ' + id + '] .read_more').show();
    });

    if ($('#career_submit').length) {
        $('#career_submit').submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                subject: {required: true},
                cover: {required: true},
                cv_upload: {required: true, extension: "pdf|doc|docx"}
            },
            messages: {
                cv_upload: {extension: 'Only pdf | doc | docx formats allowed'}
            },
            submitHandler: function () {
                $('#career_submit #loader').fadeIn();
                $('#career_submit .btn-primary').prop('disabled', true);
                var fd = new FormData();
                var file_up = $('#cv_upload').get(0).files[0];
                fd.append('file', file_up);
                var other_data = $('#career_submit').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/careers?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#career_submit #loader').fadeOut();
                        if (data == 'success') {
                            document.getElementById("career_submit").reset();
                            new PNotify({title: 'Success', delay: 1000, text: 'You have successfully applied for this post.', type: 'success'});
                            $('#career_submit .alert').fadeOut();
                        } else {
                            $('#career_submit .alert').html(data).fadeIn();
                        }
                        $('#career_submit .btn-primary').prop('disabled', false);
                    }
                });
                return false;
            }
        });
    }

    if ($('#csr_form_submit').length) {
        $('#csr_form_submit').submit(function (e) {
            e.preventDefault();
        }).validate({
            submitHandler: function () {
                $('#csr_form_submit #loader').css('opacity', '1');
                $('#csr_form_submit .alert').fadeOut();
                var fd = new FormData();
                var file_up_1 = $('#csr_form_upload_1').get(0).files[0];
                fd.append('file_1', file_up_1);
                var file_up_2 = $('#csr_form_upload_2').get(0).files[0];
                fd.append('file_2', file_up_2);
                var file_up_3 = $('#csr_form_upload_3').get(0).files[0];
                fd.append('file_3', file_up_3);
                var file_up_4 = $('#csr_form_upload_4').get(0).files[0];
                fd.append('file_4', file_up_4);
                var file_up_5 = $('#csr_form_upload_5').get(0).files[0];
                fd.append('file_5', file_up_5);
                var other_data = $('#csr_form_submit').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/submit_csr?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#csr_form_submit #loader').css('opacity', '0');
                        if (data == 'success') {
                            window.location = base_url + 'dashboard/csr';
                        } else {
                            $('#csr_form_submit .alert').text(data).fadeIn();
                        }
                    }
                });
                return false;
            }
        });
    }

    if ($('.adv-create').length) {
        $('.adv-create .page-select').select2({
            minimumResultsForSearch: -1,
            dropdownParent: $('.adv-create .page-block')
        });

        $('.adv-create .view-select').select2({
            minimumResultsForSearch: -1,
            dropdownParent: $('.adv-create .view-block')
        });

        $('.adv-create .country-select').select2({
            dropdownParent: $('.adv-create .country-block')
        });
    }

    $('.adv-create .blocks .box a').on('click', function () {
        document.getElementById('adv_add_form').reset();
        $('.adv-create #adv_add .day-select').val('').trigger('change');
        $('#adv_add .upload').hide();
        var id = $(this).attr('data-id');
        var country = $(this).attr('data-country');
        var page = $(this).attr('data-page');
        var view = $(this).attr('data-view');
        var name = $(this).attr('data-name');
        $.post(base_url + 'dashboard/get_block_details', {id: id}, function (data) {
            if (data != '') {
                $('#adv_add .price h2 span').text(data);
                $('#adv_add #block_id').val(id);
                $('#adv_add #country_code').val(country);
                $('#adv_add #page').val(page);
                $('#adv_add #viewport').val(view);
                $('#adv_add #name').val(name);
                $('#adv_add').modal('show');
            }
        });
    });

    $('#adv_add #day-select').on('change', function () {
        var num = $(this).find(":selected").val();
        $.post(base_url + 'dashboard/update_adv_price', {type: 'day', 'num': num}, function (data) {
            if (data != '') {
                $('#adv_add .price h2 span').text(data);
            }
        });
    });

    $('#adv_add .type_button').change(function () {
        if ($(this).is(':checked')) {
            var media_type = $(this).val();
            $.post(base_url + 'dashboard/update_adv_price', {type: 'format', 'media_type': media_type}, function (data) {
                if (data != '') {
                    $('#adv_add .price h2 span').text(data);
                    $('#adv_add .upload, #adv_add .action_name').hide();
                    $('#adv_add .' + media_type).show();
                }
            });
        }
    });


    if ($('#adv_add_form').length) {
        $('#adv_add_form').submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                days: {required: true},
                heading: {required: true},
                url: {url: true},
                adv_img_up: {extension: "jpg|png|jpeg|gif"},
                post_video_up: {extension: "mp4"},
                'adv_slider_up[]': {extension: "jpg|png|jpeg|gif"}
            },
            messages: {
                adv_img_up: 'Only jpg |png | jpeg | gif formats allowed',
                post_video_up: 'Only mp4 formats allowed',
                'adv_slider_up[]': 'Only jpg |png | jpeg | gif formats allowed'
            },
            submitHandler: function () {
                $('#adv_add_form #loader').fadeIn();
                $('#adv_add_form .btn-primary').prop('disabled', true);
                var fd = new FormData();
                var slider_up = document.getElementById('adv_slider_up');
                var i = 0, len = slider_up.files.length, file;
                for (; i < len; i++) {
                    file = slider_up.files[i];
                    if (fd) {
                        fd.append('slider' + i, file);
                    }
                }
                var video_up = $('#adv_video_up').get(0).files[0];
                fd.append('video', video_up);
                var img_up = $('#adv_img_up').get(0).files[0];
                fd.append('image', img_up);
                var other_data = $('#adv_add_form').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/book_adv_block?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#adv_add_form #loader').fadeOut();
                        if (data == 'success') {
                            window.location = base_url + 'dashboard/payment_adv';
                        } else {
                            $('#adv_add_form .alert').html(data).fadeIn();
                        }
                        $('#adv_add_form .btn-primary').prop('disabled', false);
                    }
                });
                return false;
            }
        });
    }

    if ($('.adv_block .media video').length) {
        $('.adv_block .media video').mediaelementplayer({
            hideVideoControlsOnLoad: true,
            alwaysShowControls: false,
            features: ['playpause', 'volume', 'fullscreen']
        });
        var mediaElement = $('.adv_block .media video');
        var player = new MediaElementPlayer(mediaElement);
        player.load();
    }

    $(document).on('click', '.adv_link', function () {
        var href = $(this).attr('data-href');
        window.open(href, '_blank');
    });

    $('.adv_block').hover(
            function () {
                if ($(this).find('video').length) {
                    var mediaElement = $(this).find('video');
                    var player = new MediaElementPlayer(mediaElement);
                    player.play();
                }
            }, function () {
        if ($(this).find('video').length) {
            var mediaElement = $(this).find('video');
            var player = new MediaElementPlayer(mediaElement);
            player.play();
            player.pause();
        }
    }
    );

    $(document).on({
        mouseenter: function () {
            if ($(this).find('video').length) {
                var mediaElement = $(this).find('video');
                var player = new MediaElementPlayer(mediaElement);
                player.play();
            }
        },
        mouseleave: function () {
            if ($(this).find('video').length) {
                var mediaElement = $(this).find('video');
                var player = new MediaElementPlayer(mediaElement);
                player.play();
                player.pause();
            }
        }
    }, '.adv_video');

    $('#referral_code').click(function () {
        $(this).remove();
        $.post(base_url + 'dashboard/generate_referral_code', function (data) {
            $('#offer_campaign #referral_code').remove();
            $('#offer_campaign .code_generated, #offer_campaign .block p').css('display', 'inline-block');
            $('#offer_campaign #print_code').text(data);
            $('#offer_campaign .block p #copy_code').attr('data-clipboard-text', 'www.worthact.com?r=' + data);
            $('#offer_campaign .block p span span').text(data);
        });
    });

    $('#copy_code').click(function () {
        new Clipboard('#copy_code');
        new PNotify({title: 'Success', delay: 1000, text: 'Reference URL copied to clipboard', type: 'success'});
    });

    $('#payment-form .pay').on('click', function (e) {
        e.preventDefault();
        var timezone = tzdetect.matches()[0];
        var amount = $('#amount').val();
        var type = $('#payment-form').attr('data-type');
        if (type == 'payment_comp') {
            if (timezone == 'Asia/Calcutta' || timezone == 'Asia/Kolkata') {
                if (amount != '' && amount > 4999) {
                    $('#payment-india').submit();               
                } else {
                    $('#payment-form #amount').css('border-color', '#ad0000');
                }
            } else {
                if (amount != '' && amount > 279) {
                    $('#payment-form #amount').css('border-color', '#ddd');
                    $('#payinfo').modal('show');
                    $('#payinfo .amt-paid').val(amount);
                } else {
                    $('#payment-form #amount').css('border-color', '#ad0000');
                }
            }
        } else {
            if (timezone == 'Asia/Calcutta' || timezone == 'Asia/Kolkata') {
                if (amount != '' && amount > 649) {
                    $('#payment-india').submit();
                } else {
                    $('#payment-form #amount').css('border-color', '#ad0000');
                }
            } else {
                if (amount != '' && amount > 9) {
                    $('#payment-form #amount').css('border-color', '#ddd');
                    $('#payinfo').modal('show');
                    $('#payinfo .amt-paid').val(amount);
                } else {
                    $('#payment-form #amount').css('border-color', '#ad0000');
                }
            }
        }
    });
    
    $('#add_listing .close').on('click', function (e) {
        e.preventDefault();
        $('#offer_campaign').modal('hide');

    });
    
    $('.offer_modal .refer, #link_camp').on('click', function (e) {
        e.preventDefault();
        $('#offer_campaign').modal('show');
    });
    
    $('#link_update').on('click', function (e) {
        e.preventDefault();
        window.location = base_url + 'dashboard/profile_update/3#payment-form';
    });
    
    $('.offer_modal .plant_tree').on('click', function (e) {
        e.preventDefault();
        $('.add_listing_two').modal('show');
    });
    
    $('#payment-form .plant_tree').on('click', function (e) {
        e.preventDefault();
        $('.add_listing_two').modal('show');
    });
    
    if ($('.mailer_template').length) {
        $('#editor').redactor({
            buttons: ['bold', 'italic', 'deleted', 'lists', 'link'],
            callbacks: {
                keydown: function() {
                    $('#editor_msg').html(this.code.get());
                },
                paste: function(html) {
                    $('#editor_msg').html(html);
                },
                init: function() {
                    $('#editor_msg').html(this.code.get());
                }
            }
        });
        var html = $('#content').redactor('code.get');
        console.log(html);
        $('#redactor-uuid-0').attr('ng-model', 'msg');
        $('#mail_temp .type').click(function() {
            if($(this).val() == 'comp') {
                var content = $('.mailer_template .dummy_text .comp').html();
                $('#editor').redactor('code.set', content);
                $('#editor_msg').html(content);
            } else {
                var content = $('.mailer_template .dummy_text .school').html();
                $('#editor').redactor('code.set', content);
                $('#editor_msg').html(content);
            }
        });
    }
    
    if ($('.seso_modal').length) {
        $('#add_seso_blog_form').submit(function (e) {
            e.preventDefault();
                $('#add_seso_blog_form #loader').fadeIn();
                $('#add_seso_blog_form .modal-footer .btn-primary').prop('disabled', true);
                var fd = new FormData();
                if ($('#blog_upload').length) {
                    var file_up = $('#blog_upload').get(0).files[0];
                    fd.append('file', file_up);
                }
                var other_data = $('#add_seso_blog_form').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/submit_seso_essay?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#add_seso_blog_form #loader').fadeOut();
                        if (data == 'success') {
                            window.location.reload();
                        } else {
                            $('#form_alert').html(data).fadeIn();
                            $('#add_seso_blog_form .modal-footer .btn-primary').prop('disabled', false);
                        }
                    }
                });
        });

        $('.tags').select2({
            tags: true,
            allowClear: true
        });
        
        $('.class_select').select2({
            minimumResultsForSearch: -1
        });
        
        $('#add_drawing').submit(function (e) {
            e.preventDefault();
        }).validate({
            errorClass: 'validation-error',
            rules: {
                age: {required: true},
                'timeline_photo_upload[]': {required: true, extension: "jpg|png|jpeg"}
            },
            messages: {
                'timeline_photo_upload[]': {extension: 'Only jpg | png formats allowed'}
            },
            submitHandler: function () {
                $('#add_drawing #loader').fadeIn();
                $('#add_drawing .modal-footer .btn-primary').prop('disabled', true);
                var fd = new FormData();
                var filedata = document.getElementById("timeline_photo_upload");
                var i = 0, len = filedata.files.length, file;
                for (; i < len; i++) {
                    file = filedata.files[i];
                    if (fd) {
                        fd.append('file' + i, file);
                    }
                }
                var other_data = $('#add_drawing').serializeArray();
                $.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                $.ajax({
                    url: base_url + 'dashboard/submit_seso_drawing?' + other_data,
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#add_drawing #loader').fadeOut();
                        if (data == 'success') {
                            window.location.reload();
                        } else {
                            $('#add_drawing #form_alert').html(data).fadeIn();
                            $('#add_drawing .modal-footer .btn-primary').prop('disabled', false);
                        }
                    }
                });
                return false;
            }
        });
    }
    
    $('#seso_contact').click(function(){
        $('#contact').modal('show');
    });
    
    $('#logout, #logout_m').click(function(){
        document.cookie = 'wa_i=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        document.cookie = 'wa_l=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        document.cookie = 'wa_t=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        document.cookie = 'wa_k=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        window.location = base_url + 'dashboard/logout';
    });
    
});

/* Sort Notifications */
function sort_notifications(a, b) {
    return ($(a).data('id')) < ($(b).data('id')) ? 1 : -1;
}

/* Filter Submodule For Grid */
function debounce(fn, threshold) {
    var timeout;
    return function debounced() {
        if (timeout) {
            clearTimeout(timeout);
        }
        function delayed() {
            fn();
            timeout = null;
        }
        timeout = setTimeout(delayed, threshold || 100);
    };
}

/* Validate User Email */
function validate_user_email(email) {
    $.post(base_url + 'home/validateemail', {email: email}, function (data) {
        if (data == 'invalid') {
            document.getElementById('register-email').value = '';
            new PNotify({title: 'Error', delay: 1000, text: 'Email id already taken.', type: 'error'});
        }
    });
}

/* Search */
function filter_search(type) {
    if (type == 'homeconn') {
        var filter = document.getElementById('home_conn').value, count = 0;
        $(".connection .col-outer").each(function () {
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
            } else {
                $(this).show();
                count++;
            }
        });
    }
    if (type == 'blockedconn') {
        var filter = document.getElementById('blockedconn').value, count = 0;
        $("#blocked_conn .col-outer").each(function () {
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
            } else {
                $(this).show();
                count++;
            }
        });
    }
    if (type == 'profileconn') {
        var filter = document.getElementById('profile_conn').value, count = 0;
        $(".profile-main #connection .main .col-outer").each(function () {
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
            } else {
                $(this).show();
                count++;
            }
        });
    }
    if (type == 'homegrp') {
        var filter = document.getElementById('home_grp').value, count = 0;
        $("#joinedgroups .col-outer").each(function () {
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
            } else {
                $(this).show();
                count++;
            }
        });
    }
    if (type == 'profilegrp') {
        var filter = document.getElementById('profile_grp').value, count = 0;
        $(".profile-main #pro_groups .main .col-outer").each(function () {
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
            } else {
                $(this).show();
                count++;
            }
        });
    }
    if (type == 'grpmembers') {
        var filter = document.getElementById('grp_members').value, count = 0;
        $(".group .profile-main #pro_groups .main .col-outer").each(function () {
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
            } else {
                $(this).show();
                count++;
            }
        });
    }
}

/* Load Blog */
function load_blog() {
    $('.blog-page .thumbnail #loader').fadeIn();
    $.post(base_url + 'dashboard/load_user_blog', function (data) {
        $('.blog-page .thumbnail #loader').fadeOut();
        $('.blog-page #grid').html('');
        $('.blog-page #grid').html(data);
        $('.blog-page .panel-post #load_more').show();
    });
}

/* Update Blog */
function update_blog(id) {
    $.post(base_url + 'dashboard/update_blog', {id: id}, function (data) {
        $('#modal_update .modal-body').html(data);
        setTimeout(function () {
            $("#editor_blog_update").redactor({
                buttons: ['format', 'bold', 'italic', 'deleted', 'lists', 'image', 'link'],
                imageUpload: base_url + 'dashboard/submit_blog_image'
            });
            $('.blog_tags').select2({
                tags: true
            });
        }, 180);
        $('#modal_update').modal('show');
    });
}

/* Delete Blog */
function delete_blog(id) {
    $('#blog_delete_id').val(id);
}

/* Scroll Blog Load */
function load_more_blog() {
    $('.blog-page .panel-post #load_more #loader').fadeIn();
    var id = $('.blog-page #grid .grid-item:last').attr('data-id');
    $.post(base_url + 'dashboard/load_user_blog', {last_id: id}, function (data) {
        $('.blog-page .panel-post #load_more #loader').fadeOut();
        if (data != '') {
            $('.blog-page #grid').append(data);
            $('.blog-page #grid .grid-item').each(function () {
                $(this).find('.blog-post-desc h4 a').html($.emoticons.replace($(this).find('.blog-post-desc h4 a').text()));
            });
        } else {
            $('.blog-page .panel-post #load_more').text('Finished').attr('onclick', '').unbind('click');
        }
    });
}

/* Scroll User Search Load */
function load_more_usersearch(key) {
    $('.search-list #load_more #loader').fadeIn();
    var id = $('.search-list .block:last').attr('data-id');
    $.post(base_url + 'dashboard/load_more_usersearch', {last_id: id, search: key}, function (data) {
        $('.search-list #load_more #loader').fadeOut();
        if (data != '') {
            $('.search-list .panel-body').append(data);
        } else {
            $('.search-list #load_more').text('Finished').attr('onclick', '').unbind('click');
        }
    });
}

/* Scroll Blog Search Load */
function load_more_blogsearch(key) {
    $('.search-list #load_more #loader').fadeIn();
    var id = $('.search-list .datablock:last').attr('data-id');
    $.post(base_url + 'dashboard/load_more_blogsearch', {last_id: id, search: key}, function (data) {
        $('.search-list #load_more #loader').fadeOut();
        if (data != '') {
            $('.search-list .panel-body').append(data);
        } else {
            $('.search-list #load_more').text('Finished').attr('onclick', '').unbind('click');
        }
    });
}

/* Scroll Post Search Load */
function load_more_postsearch(key) {
    $('.search-list #load_more #loader').fadeIn();
    var id = $('.search-list .datablock:last').attr('data-id');
    $.post(base_url + 'dashboard/load_more_postsearch', {last_id: id, search: key}, function (data) {
        $('.search-list #load_more #loader').fadeOut();
        if (data != '') {
            $('.search-list .panel-body').append(data);
        } else {
            $('.search-list #load_more').text('Finished').attr('onclick', '').unbind('click');
        }
    });
}

/* Scroll Group Search Load */
function load_more_groupsearch(key) {
    $('.search-list #load_more #loader').fadeIn();
    var id = $('.search-list .block:last').attr('data-id');
    $.post(base_url + 'dashboard/load_more_groupsearch', {last_id: id, search: key}, function (data) {
        $('.search-list #load_more #loader').fadeOut();
        if (data != '') {
            $('.search-list .panel-body').append(data);
        } else {
            $('.search-list #load_more').text('Finished').attr('onclick', '').unbind('click');
        }
    });
}

/* Delete Gallery */
function delete_gallery(id, type) {
    if (type == 'image') {
        $('#gallery_delete_img_id').val(id);
    }
    if (type == 'video') {
        $('#gallery_delete_vd_id').val(id);
    }
}

/* Load Gallery */
function load_gallery(type) {
    $('.thumbnail .list-group-home #loader').fadeIn();
    $('#gallery_img #load_more, #gallery_vd #load_more').hide();
    if (type == 'img') {
        $('#gallery_img #grid').html('');
        $.post(base_url + 'dashboard/gallery', {type: 'img'}, function (data) {
            var res = JSON.parse(data);
            var gallery = res['gallery'];
            if (gallery != '') {
                $('#gallery_img #grid').html(gallery);
                $('#gallery_img #load_more').css('display', 'block');
            } else {
                $('#gallery_img #load_more').hide();
            }
        });
    }
    if (type == 'vd') {
        $('#gallery_vd #grid').html('');
        $.post(base_url + 'dashboard/gallery', {type: 'vd'}, function (data) {
            var res = JSON.parse(data);
            var gallery = res['gallery'];
            if (gallery != '') {
                $('#gallery_vd #grid').html(gallery);
                $('#gallery_vd #load_more').css('display', 'block');
            } else {
                $('#gallery_vd #load_more').hide();
            }
        });
    }
    $('.thumbnail .list-group-home #loader').fadeOut();
}

/* Scroll Gallery Load */
function load_more_gallery(type) {
    if (type == 'img') {
        $('.home-body #gallery_img #load_more #loader').fadeIn();
        var id = $('.home-body #gallery_img #grid .grid-item:last').attr('data-id');
        $.post(base_url + 'dashboard/load_more_usergallery', {type: 'img', last_id: id}, function (data) {
            var res = JSON.parse(data);
            var gallery = res['gallery'];
            if (gallery != '') {
                $('.home-body #gallery_img #grid').append(data);
                $('.home-body #gallery_img #load_more #loader').fadeOut();
            } else {
                $('.home-body #gallery_img #load_more').text('Finished').attr('onclick', '').unbind('click');
            }
        });
    }
    if (type == 'vd') {
        $('.home-body #gallery_vd #load_more #loader').fadeIn();
        var id = $('.home-body #gallery_vd #grid .grid-item:last').attr('data-id');
        $.post(base_url + 'dashboard/load_more_usergallery', {type: 'vd', last_id: id}, function (data) {
            var res = JSON.parse(data);
            var gallery = res['gallery'];
            if (gallery != '') {
                $('.home-body #gallery_vd #grid').append(data);
                $('.home-body #gallery_vd #load_more #loader').fadeOut();
            } else {
                $('.home-body #gallery_vd #load_more').text('Finished').attr('onclick', '').unbind('click');
            }
        });
    }
}

/* Load Connection */
function load_connection(type) {
    $('.thumbnail .list-group-home #loader').fadeIn();
    if (type == 'all') {
        $.post(base_url + 'dashboard/connection', {type: type}, function (data) {
            var res = JSON.parse(data);
            var con = res['con'];
            if (con != '') {
                $('#allfriends .main').html(con);
            }
            $('.thumbnail .list-group-home #loader').fadeOut();
        });
    }
    if (type == 'blocked') {
        $('.profile_update #loader-home').fadeIn();
        $.post(base_url + 'dashboard/connection', {type: type}, function (data) {
            var res = JSON.parse(data);
            var con = res['con'];
            if (con != '') {
                $('#blocked_conn .main').html(con);
            }
            $('.profile_update #loader-home').fadeOut();
        });
    }
}

/* Load Followers */
function load_followers() {
    $('.thumbnail .list-group-home #loader').fadeIn();
    $.post(base_url + 'dashboard/connection', {type: 'followers'}, function (data) {
        var res = JSON.parse(data);
        var con = res['con'];
        if (con != '') {
            $('#allfollowers .main').html(con);
        }
        $('.thumbnail .list-group-home #loader').fadeOut();
    });
}

/* Send Connection Request */
function send_req(req_id, type) {
    $.post(base_url + 'dashboard/send_req', {req_id: req_id}, function (data) {
        if (data == 'success') {
            if (type == 0) {
                $('#search_list .frnd-menu[data-list-id = ' + req_id + '] li:eq(0)').remove();
                $('#search_list .frnd-menu[data-list-id = ' + req_id + ']').prepend('<li><a onclick="cancel_req(' + req_id + ', 0)" class="cancel_friend"><i class="ion-android-close"></i>Cancel Request</a></li>');
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully sent the request.', type: 'success'});
            }
            if (type == 1) {
                $('.profile .twPc-button').html('');
                $('.profile .twPc-button').html('<button onclick="cancel_req(' + req_id + ', 1)" data-ripple class="btn shadow"><i class="ion-android-close"></i> Cancel Request</button>');
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully sent the request.', type: 'success'});
            }
        }
    });
}

/* Send Connection Request */
function follow_user(req_id, type) {
    $.post(base_url + 'dashboard/follow_user', {req_id: req_id}, function (data) {
        if (data == 'success') {
            if (type == 0) {
                $('#search_list .frnd-menu[data-list-id = ' + req_id + '] li:eq(0)').remove();
                $('#search_list .frnd-menu[data-list-id = ' + req_id + ']').prepend('<li><a><i class="ion-android-done-all"></i>Following</a><li>');
                new PNotify({title: 'Success', delay: 1000, text: 'You are now following this connection.', type: 'success'});
            }
            if (type == 1) {
                $('.profile .twPc-button').html('');
                $('.profile .twPc-button').html('<div class="conn-action"><button data-ripple class="btn shadow btn_right"><i class="ion-android-done-all"></i> Following</button><div class="dropdown clearfix"><button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ion-android-more-vertical"></i></button><ul class="dropdown-menu dropdown-menu-right"><li><a onclick="delete_req(' + req_id + ', 4)">Unfollow</a></li></ul></div></div>');
                new PNotify({title: 'Success', delay: 1000, text: 'You are now following this connection.', type: 'success'});
            }
        }
    });
}

/* Cancel Connection Request */
function cancel_req(cancel_id, type) {
    $.post(base_url + 'dashboard/cancel_req', {cancel_id: cancel_id}, function (data) {
        if (data == 'success') {
            if (type == 0) {
                $('#search_list .frnd-menu[data-list-id = ' + cancel_id + '] li:eq(0)').remove();
                $('#search_list .frnd-menu[data-list-id = ' + cancel_id + ']').prepend('<li><a onclick="send_req(' + cancel_id + ', 0)" class="add_friend"><i class="ion-plus"></i>Connect</a></li>');
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully cancelled the request.', type: 'success'});
            }
            if (type == 1) {
                $('.profile .twPc-button').html('');
                $('.profile .twPc-button').html('<button onclick="send_req(' + cancel_id + ', 1)" data-ripple class="btn shadow"><i class="ion-plus"></i> Connect</button>');
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully cancelled the request.', type: 'success'});
            }
        }
    });
}

/* Accept Connection Request */
function accept_req(accept_id, type) {
    $.post(base_url + 'dashboard/accept_req', {accept_id: accept_id}, function (data) {
        if (data == 'success') {
            if (type == 0) {
                $('#search_list .frnd-menu[data-list-id = ' + accept_id + '] li:eq(0)').remove();
                $('#search_list .frnd-menu[data-list-id = ' + accept_id + '] li:eq(1)').remove();
                $('#search_list .frnd-menu[data-list-id = ' + accept_id + '] li:eq(2)').remove();
                $('#search_list .frnd-menu[data-list-id = ' + accept_id + ']').prepend('<li><a><i class="ion-android-done-all"></i>Connected</a></li>');
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully accepted the connection request.', type: 'success'});
            }
            if (type == 1) {
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully accepted the connection request.', type: 'success'});
                $('.connection .col-outer[data-id = ' + accept_id + ']').remove();
            }
            if (type == 2) {
                $('.profile .twPc-button').html('');
                $('.profile .twPc-button').html('<div class="conn-action"><button data-ripple class="btn shadow btn_right"><i class="ion-android-done-all"></i> Connected</button><div class="dropdown clearfix"><button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ion-android-more-vertical"></i></button><ul class="dropdown-menu dropdown-menu-right"><li><a onclick="set_leave_conn(' + accept_id + ', 1)" >Remove Connection</a></li><li><a onclick="set_block_conn(' + accept_id + ', 2)" >Block</a></li></ul></div></div>');
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully accepted the connection request.', type: 'success'});
            }
            if (type == 3) {
                $('.profile .twPc-button').html('');
                $('.profile .twPc-button').html('<div class="conn-action"><button data-ripple class="btn shadow btn_right"><i class="ion-android-done-all"></i> Connected</button><div class="dropdown clearfix"><button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ion-android-more-vertical"></i></button><ul class="dropdown-menu dropdown-menu-right"><li><a onclick="set_leave_conn(' + accept_id + ', 6)" >Remove Connection</a></li><li><a onclick="set_block_conn(' + accept_id + ', 2)" >Block</a></li></ul></div></div>');
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully accepted the connection request.', type: 'success'});
            }
        }
    });
}

/* Delete Connection Request */
function delete_req(delete_id, type) {
    $.post(base_url + 'dashboard/delete_req', {delete_id: delete_id}, function (data) {
        if (data == 'success') {
            if (type == 0) {
                $('#search_list .frnd-menu[data-list-id = ' + delete_id + '] li:eq(0)').remove();
                $('#search_list .frnd-menu[data-list-id = ' + delete_id + '] li:eq(1)').remove();
                $('#search_list .frnd-menu[data-list-id = ' + delete_id + '] li:eq(2)').remove();
                $('#search_list .frnd-menu[data-list-id = ' + delete_id + ']').prepend('<li><a onclick="send_req(' + delete_id + ', 0)" class="add_friend"><i class="ion-plus"></i>Connect</a></li>');
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully deleted the connection request.', type: 'success'});
            }
            if (type == 1) {
                $('.profile .twPc-button').html('');
                $('.profile .twPc-button').html('<button onclick="send_req(' + delete_id + ', 1)" data-ripple class="btn shadow"><i class="ion-plus"></i> Connect</button>');
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully removed the connection.', type: 'success'});
            }
            if (type == 2) {
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully deleted the connection request.', type: 'success'});
            }
            if (type == 3) {
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully unblocked the connection.', type: 'success'});
                $('#blocked_conn .col-outer[data-id = ' + delete_id + ']').remove();
            }
            if (type == 4) {
                $('.profile .twPc-button').html('');
                $('.profile .twPc-button').html('<button onclick="follow_user(' + delete_id + ', 1)" data-ripple class="btn shadow"><i class="ion-plus"></i> Follow</button>');
                new PNotify({title: 'Success', delay: 1000, text: 'You have unfollowed the connection.', type: 'success'});
            }
            if (type == 5) {
                $('.profile .twPc-button').html('');
                $('.profile .twPc-button').html('<button onclick="follow_user(' + delete_id + ', 1)" data-ripple class="btn shadow"><i class="ion-plus"></i> Follow</button>');
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully deleted the connection request.', type: 'success'});
            }
            if (type == 6) {
                $('.profile .twPc-button').html('');
                $('.profile .twPc-button').html('<button onclick="follow_user(' + delete_id + ', 1)" data-ripple class="btn shadow"><i class="ion-plus"></i> Follow</button>');
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully removed the connection.', type: 'success'});
            }
            if (type == 7) {
                $('#search_list .frnd-menu[data-list-id = ' + delete_id + '] li:eq(0)').remove();
                $('#search_list .frnd-menu[data-list-id = ' + delete_id + '] li:eq(1)').remove();
                $('#search_list .frnd-menu[data-list-id = ' + delete_id + '] li:eq(2)').remove();
                $('#search_list .frnd-menu[data-list-id = ' + delete_id + ']').prepend('<li><a onclick="follow_user(' + delete_id + ', 0)" class="add_friend"><i class="ion-plus"></i>Follow</a></li>');
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully deleted the connection request.', type: 'success'});
            }
            if (type == 8) {
                new PNotify({title: 'Success', delay: 1000, text: 'You have unfollowed the connection.', type: 'success'});
                load_followers();
            }
            $('.connection .col-outer[data-id = ' + delete_id + ']').remove();
        }
    });
}

/* Block Connection */
function block_connection(block_id, type) {
    $.post(base_url + 'dashboard/block_connection', {block_id: block_id}, function (data) {
        if (data == 'success') {
            if (type == 0) {
                $('#search_list .frnd-menu[data-list-id = ' + block_id + '] li').remove();
                $('#search_list .frnd-menu[data-list-id = ' + block_id + ']').prepend('<li><a><i class="ion-android-warning"></i>Blocked</a></li>');
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully blocked the connection.', type: 'success'});
            }
            if (type == 1) {
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully blocked the connection.', type: 'success'});
                $('.connection .col-outer[data-id = ' + block_id + ']').remove();
            }
            if (type == 2) {
                window.location = base_url + 'dashboard/profile_update/4';
            }
        }
    });
}

/* Set Unfriend */
function set_leave_conn(id, type) {
    $('#leave_conn #leave_conn_id').val(id);
    $('#leave_conn #leave_conn_type').val(type);
    $('#leave_conn').modal('show');
}

/* Set Block */
function set_block_conn(id, type) {
    $('#block_conn #block_conn_id').val(id);
    $('#block_conn #block_conn_type').val(type);
    $('#block_conn').modal('show');
}

/* Set Unblock */
function set_unblock_conn(id, type) {
    $('#unblock_conn #unblock_conn_id').val(id);
    $('#unblock_conn #unblock_conn_type').val(type);
    $('#unblock_conn').modal('show');
}

/* Load Profile Timeline */
function load_profile_timeline(id) {
    $('.profile-main #gallery, .profile-main #connection, .profile-main #pro_groups, .profile-main #blog, .profile-main #listing, .profile-main #joblist-tab').hide();
    $('.profile-list #loader-profile').fadeIn();
    $.post(base_url + 'dashboard/profile_load', {id: id, type: 'timeline'}, function (data) {
        $('.profile-main #timeline .main').html('');
        if (data != '') {
            $('.profile-main .profile-head').text('Timeline');
            $('.profile-main .profile-body').show();
            $('.profile-main #timeline .main').html(data);
            $('.profile-main #timeline .main .timeline_post').each(function () {
                $(this).find('.timeline_post_title h4').html($.emoticons.replace($(this).find('.timeline_post_title h4').text()));
                $(this).find('.timeline_blog h4').html($.emoticons.replace($(this).find('.timeline_blog h4').text()));
                $(this).find('.timeline_post_content p').linkify({target: "_blank"});
            });
            setTimeout(function () {
                $(".fancybox").fancybox({
                    helpers: {
                        overlay: {
                            locked: false
                        }
                    }
                });
                $('video,audio').mediaelementplayer({
                    enableAutosize: true
                });
                $('.timeline_post_content p').shorten({
                    "showChars": 300,
                    "moreText": "See More",
                    "lessText": "Less"
                });
            }, 80);
            $('.profile-main #load_more').attr('data-type', 'timeline').show();
        } else {
            $('.profile-main #load_more, .profile-main .profile-body').hide();
            $('.profile-main .profile-head').text('No timeline to show!');
        }
        $('.profile-list #loader-profile').fadeOut();
    });
    $('.profile-main #timeline').show();
}

/* Load Profile Timeline */
function load_profile_post(id) {
    $('.profile-main #gallery, .profile-main #connection, .profile-main #pro_groups, .profile-main #blog, .profile-main #timeline, .profile-main #joblist-tab').hide();
    $('.profile-list #loader-profile').fadeIn();
    $.post(base_url + 'dashboard/profile_load', {id: id, type: 'post'}, function (data) {
        $('.profile-main #listing #listing_table').html('');
        if (data != '') {
            $('.profile-main .profile-head').text('WorthAct Initiatives');
            $('.profile-main #listing #listing_table').html(data);
            $('.profile-main #listing #listing_table .ad').each(function () {
                $(this).find('.content .title').html($.emoticons.replace($(this).find('.content .title').text()));
                $(this).find('.content .para').html($.emoticons.replace($(this).find('.content .para').text()));
            });
            $('.profile-main .profile-body').show();
            $('.profile-main #load_more').attr('data-type', 'post').show();
        } else {
            $('.profile-main #load_more, .profile-main .profile-body').hide();
            $('.profile-main .profile-head').text('No worthAct initiative posts to show!');
        }
        $('.profile-list #loader-profile').fadeOut();
    });
    $('.profile-main #listing').show();
}

/* Load Profile Timeline */
function load_profile_job(id) {
    $('.profile-main #gallery, .profile-main #connection, .profile-main #pro_groups, .profile-main #blog, .profile-main #timeline, .profile-main #listing').hide();
    $('.profile-list #loader-profile').fadeIn();
    $.post(base_url + 'dashboard/profile_load', {id: id, type: 'job'}, function (data) {
        $('.profile-main #joblist-tab #listing_table').html('');
        if (data != '') {
            $('.profile-main .profile-head').text('Jobs');
            $('.profile-main  #joblist-tab #listing_table').html(data);
            $('.profile-main .profile-body').show();
            $('.profile-main #load_more').attr('data-type', 'job').show();
        } else {
            $('.profile-main #load_more, .profile-main .profile-body').hide();
            $('.profile-main .profile-head').text('No job posts to show!');
        }
        $('.profile-list #loader-profile').fadeOut();
    });
    $('.profile-main #joblist-tab').show();
}

/* Load Profile Blog */
function load_profile_blog(id) {
    $('.profile-main #gallery, .profile-main #connection, .profile-main #pro_groups, .profile-main #timeline, .profile-main #listing, .profile-main #joblist-tab').hide();
    $('.profile-list #loader-profile').fadeIn();
    $.post(base_url + 'dashboard/profile_load', {id: id, type: 'blog'}, function (data) {
        $('.profile-main #blog #grid').html('');
        if (data != '') {
            $('.profile-main .profile-head').text('Blog');
            $('.profile-main #blog #grid').html(data);
            $('.profile-main #grid .grid-item').each(function () {
                $(this).find('.blog-post-desc h4 a').html($.emoticons.replace($(this).find('.blog-post-desc h4 a').text()));
            });
            $('.profile-main .profile-body').show();
            $('.profile-main #load_more').attr('data-type', 'blog').show();
        } else {
            $('.profile-main #load_more , .profile-main .profile-body').hide();
            $('.profile-main .profile-head').text('No blogs to show!');
        }
        $('.profile-list #loader-profile').fadeOut();
    });
    $('.profile-main #blog').show();
}

/* Load Profile Gallery Image */
function load_profile_gallery_image(id) {
    $('.profile-main #blog, .profile-main #connection, .profile-main #pro_groups, .profile-main #timeline, .profile-main #listing, .profile-main #joblist-tab').hide();
    $('.profile-list #loader-profile').fadeIn();
    $('.profile-main .profile-head').text('Photos');
    $.post(base_url + 'dashboard/profile_load', {id: id, type: 'gallery_img'}, function (data) {
        $('.profile-main #gallery #pro_img #grid').html('');
        $('.profile-main #gallery #pro_vd #grid').html('');
        if (data != '') {
            $('.profile-main #gallery #pro_img #grid').html(data);
            $('.profile-main .profile-body').show();
            setTimeout(function () {
                $(".fancybox").fancybox({
                    helpers: {
                        overlay: {
                            locked: false
                        }
                    }
                });
            }, 80);
            $('.profile-main #load_more').attr('data-type', 'gallery_img').show();
        } else {
            $('.profile-main #load_more, .profile-main .profile-body').hide();
            $('.profile-main .profile-head').text('No photos to show!');
        }
        $('.profile-list #loader-profile').fadeOut();
    });
    $('.profile-main #gallery').show();
}

/* Load Profile Gallery Video */
function load_profile_gallery_video(id) {
    $('.profile-main #blog, .profile-main #connection, .profile-main #pro_groups, .profile-main #timeline, .profile-main #listing, .profile-main #joblist-tab').hide();
    $('.profile-list #loader-profile').fadeIn();
    $('.profile-main .profile-head').text('Videos');
    $.post(base_url + 'dashboard/profile_load', {id: id, type: 'gallery_vd'}, function (data) {
        $('.profile-main #gallery #pro_img #grid').html('');
        $('.profile-main #gallery #pro_vd #grid').html('');
        if (data != '') {
            $('.profile-main #gallery #pro_vd #grid').html(data);
            $('.profile-main .profile-body').show();
            $('.profile-main #load_more').attr('data-type', 'gallery_vd').show();
        } else {
            $('.profile-main #load_more, .profile-main .profile-body').hide();
            $('.profile-main .profile-head').text('No videos to show!');
        }
        $('.profile-list #loader-profile').fadeOut();
    });
    $('.profile-main #gallery').show();
}

/* Load Profile Connection */
function load_profile_connection(id) {
    $('.profile-main #blog, .profile-main #gallery, .profile-main #load_more, .profile-main #pro_groups, .profile-main #timeline, .profile-main #listing, .profile-main #joblist-tab').hide();
    $('.profile-list #loader-profile').fadeIn();
    $.post(base_url + 'dashboard/profile_load', {id: id, type: 'connection'}, function (data) {
        $('.profile-main #connection .main').html('');
        if (data != '') {
            $('.profile-main .profile-head').text('Connections');
            $('.profile-main #connection .main').html(data);
            $('.profile-main .profile-body').show();
        } else {
            $('.profile-main .profile-head').text('No connections to show!');
            $('.profile-main .profile-body').hide();
        }
        $('.profile-list #loader-profile').fadeOut();
    });
    $('.profile-main #connection').show();
}

/* Load Profile Groups */
function load_profile_c_groups(id) {
    $('.profile-main #blog, .profile-main #gallery, .profile-main #load_more, .profile-main #connection, .profile-main #timeline, .profile-main #listing, .profile-main #joblist-tab').hide();
    $('.profile-main .profile-head').text('Groups Created');
    $('.profile-list #loader-profile').fadeIn();
    $.post(base_url + 'dashboard/profile_load', {id: id, type: 'group_c'}, function (data) {
        $('.profile-main #pro_groups .created').html('');
        $('.profile-main #pro_groups .joined').html('');
        if (data != '') {
            $('.profile-main #pro_groups .created').html(data);
            $('.profile-main .profile-body').show();
        } else {
            $('.profile-main .profile-head').text('No groups created!');
            $('.profile-main .profile-body').hide();
        }
        $('.profile-list #loader-profile').fadeOut();
    });
    $('.profile-main #pro_groups').show();
}

/* Load Profile Groups */
function load_profile_j_groups(id) {
    $('.profile-main #blog, .profile-main #gallery, .profile-main #load_more, .profile-main #connection, .profile-main #timeline, .profile-main #listing, .profile-main #joblist-tab').hide();
    $('.profile-main .profile-head').text('Groups Joined');
    $('.profile-list #loader-profile').fadeIn();
    $.post(base_url + 'dashboard/profile_load', {id: id, type: 'group_j'}, function (data) {
        $('.profile-main #pro_groups .joined').html('');
        $('.profile-main #pro_groups .created').html('');
        if (data != '') {
            $('.profile-main #pro_groups .joined').html(data);
            $('.profile-main .profile-body').show();
        } else {
            $('.profile-main .profile-head').text('No groups joined!');
            $('.profile-main .profile-body').hide();
        }
        $('.profile-list #loader-profile').fadeOut();
    });
    $('.profile-main #pro_groups').show();
}

/* Scroll Profile Load */
function load_more_profile(id) {
    $('.profile-main #load_more #loader').fadeIn();
    var type = $('.profile-main #load_more').attr('data-type');
    if (type == 'blog') {
        var last_id = $('.profile-main #blog #grid .grid-item:last').attr('data-id');
        $.post(base_url + 'dashboard/load_more_profileblock', {last_blog_id: last_id, user_id: id, type: 'blog'}, function (data) {
            $('.profile-main #load_more #loader').fadeOut();
            if (data != '') {
                $('.profile-main #blog #grid').append(data);
                $('.profile-main #grid .grid-item').each(function () {
                    $(this).find('.blog-post-desc h4 a').html($.emoticons.replace($(this).find('.blog-post-desc h4 a').text()));
                });
            } else {
                $('.profile-main #load_more').hide();
            }
        });
    }
    if (type == 'gallery_img') {
        var last_id = $('.profile-main #gallery #pro_img #grid .grid-item:last').attr('data-id');
        $.post(base_url + 'dashboard/load_more_profileblock', {last_gallery_id: last_id, user_id: id, type: 'gallery_img'}, function (data) {
            $('.profile-main #load_more #loader').fadeOut();
            if (data != '') {
                $('.profile-main #gallery #pro_img #grid').append(data);
            } else {
                $('.profile-main #load_more').hide();
            }
        });
    }
    if (type == 'gallery_vd') {
        var last_id = $('.profile-main #gallery #pro_vd #grid .grid-item:last').attr('data-id');
        $.post(base_url + 'dashboard/load_more_profileblock', {last_gallery_id: last_id, user_id: id, type: 'gallery_vd'}, function (data) {
            $('.profile-main #load_more #loader').fadeOut();
            if (data != '') {
                $('.profile-main #gallery #pro_vd #grid').append(data);
            } else {
                $('.profile-main #load_more').hide();
            }
        });
    }
    if (type == 'timeline') {
        var last_id = $('.profile-main #timeline .main .timeline_post:last').attr('data-id');
        $.post(base_url + 'dashboard/load_more_profileblock', {last_timeline_id: last_id, user_id: id, type: 'timeline'}, function (data) {
            $('.profile-main #load_more #loader').fadeOut();
            if (data != '') {
                $('.profile-main #timeline .main').append(data);
                $('.profile-main #timeline .main .timeline_post').each(function () {
                    $(this).find('.timeline_post_title h4').html($.emoticons.replace($(this).find('.timeline_post_title h4').text()));
                    $(this).find('.timeline_blog h4').html($.emoticons.replace($(this).find('.timeline_blog h4').text()));
                    $(this).find('.timeline_post_content p').linkify({target: "_blank"});
                });
                setTimeout(function () {
                    $(".fancybox").fancybox({
                        helpers: {
                            overlay: {
                                locked: false
                            }
                        }
                    });
                    $('video,audio').mediaelementplayer({
                        enableAutosize: true
                    });
                    $('.timeline_post_content p').shorten({
                        "showChars": 300,
                        "moreText": "See More",
                        "lessText": "Less"
                    });
                }, 80);
            } else {
                $('.profile-main #load_more').hide();
            }
        });
    }
    if (type == 'post') {
        var last_id = $('.profile-main #listing #listing_table .ad:last').attr('data-id');
        $.post(base_url + 'dashboard/load_more_profileblock', {last_post_id: last_id, user_id: id, type: 'post'}, function (data) {
            $('.profile-main #load_more #loader').fadeOut();
            if (data != '') {
                $('.profile-main #listing #listing_table').append(data);
                $('.profile-main #listing #listing_table .ad').each(function () {
                    $(this).find('.content .title').html($.emoticons.replace($(this).find('.content .title').text()));
                    $(this).find('.content .para').html($.emoticons.replace($(this).find('.content .para').text()));
                });
            } else {
                $('.profile-main #load_more').hide();
            }
        });
    }
    if (type == 'job') {
        var last_id = $('.profile-main #joblist-tab #listing_table .job:last').attr('data-id');
        $.post(base_url + 'dashboard/load_more_profileblock', {last_job_id: last_id, user_id: id, type: 'job'}, function (data) {
            $('.profile-main #load_more #loader').fadeOut();
            if (data != '') {
                $('.profile-main #joblist-tab #listing_table').append(data);
            } else {
                $('.profile-main #load_more').hide();
            }
        });
    }
}

/* Load Group */
function load_group(type) {
    $('.thumbnail .list-group-home #loader').fadeIn();
    if (type == 'created') {
        $.post(base_url + 'dashboard/load_group', {type: 'created'}, function (data) {
            var res = JSON.parse(data);
            var grp = res['grp'];
            $('#groups .main').html('');
            $('#groups .main').html(grp);
            $('.thumbnail .list-group-home #loader').fadeOut();
        });
    }
    if (type == 'joined') {
        $.post(base_url + 'dashboard/load_group', {type: 'joined'}, function (data) {
            var res = JSON.parse(data);
            var grp = res['grp'];
            $('#joinedgroups .main').html('');
            $('#joinedgroups .main').html(grp);
            $('.thumbnail .list-group-home #loader').fadeOut();
        });
    }
}

/* Update Group */
function update_group(id) {
    $.post(base_url + 'dashboard/update_group', {id: id}, function (data) {
        $('#update_group .modal-body').html(data);
        $('.group_tags').select2({
            tags: true
        });
        $('#update_group').modal('show');
    });
}

/* Delete Group */
function delete_group(id) {
    $('#delete_group #delete_group_id').val(id);
}

/* Update Group */
function invite_grp_mem(id) {
    $.post(base_url + 'dashboard/invite_grp_members', {id: id}, function (data) {
        $('#invite_grp_mem .modal-body').html(data);
        $('.invites').select2({
            tags: false
        });
        $('#invite_grp_mem').modal('show');
    });
}

/* Join Group */
function join_group(join_id, type) {
    $.post(base_url + 'dashboard/join_group', {join_id: join_id}, function (data) {
        if (data == 'success') {
            if (type == 0) {
                $('#search_list .grp-menu[data-list-id = ' + join_id + '] li:eq(0)').remove();
                $('#search_list .grp-menu[data-list-id = ' + join_id + ']').prepend('<li><a onclick="cancel_grp(' + join_id + ', 0)" class="cancel_group">Cancel Request <i class="ion-android-close"></i></a></li>');
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully sent a request to join the group.', type: 'success'});
            }
            if (type == 1) {
                $('.group .twPc-button').html('');
                $('.group .twPc-button').html('<button onclick="cancel_grp(' + join_id + ', 1)" data-ripple class="btn shadow"><i class="ion-android-close"></i> Cancel Request</button>');
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully sent a request to join the group.', type: 'success'});
            }
        }
    });
}

/* Accept Group */
function accept_group(join_id, type) {
    $.post(base_url + 'dashboard/accept_group', {accept_id: join_id}, function (data) {
        if (data == 'success') {
            if (type == 0) {
                $('#search_list .grp-menu[data-list-id = ' + join_id + '] li:eq(0)').remove();
                $('#search_list .grp-menu[data-list-id = ' + join_id + '] li:eq(1)').remove();
                $('#search_list .grp-menu[data-list-id = ' + join_id + ']').prepend('<li><a>Joined <i class="ion-android-done-all"></i></a><li>');
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully sent a request to join the group.', type: 'success'});
            }
            if (type == 1) {
                window.location = base_url + 'dashboard/group/' + join_id;
            }
        }
    });
}

/* Cancel Group Request */
function cancel_grp(cancel_id, type) {
    $.post(base_url + 'dashboard/cancel_grp', {cancel_id: cancel_id}, function (data) {
        if (data == 'success') {
            if (type == 0) {
                $('#search_list .grp-menu[data-list-id = ' + cancel_id + '] li:eq(0)').remove();
                $('#search_list .grp-menu[data-list-id = ' + cancel_id + ']').prepend('<li><a onclick="join_group(' + cancel_id + ', 0)" class="join_group">Join <i class="ion-plus"></i></a></li>');
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully cancelled the request.', type: 'success'});
            }
            if (type == 1) {
                $('.group .twPc-button').html('');
                $('.group .twPc-button').html('<button onclick="join_group(' + cancel_id + ', 1)" data-ripple class="btn shadow"><i class="ion-plus"></i> Join</button>');
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully cancelled the request.', type: 'success'});
            }
            if (type == 2) {
                load_group('joined');
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully cancelled the request.', type: 'success'});
            }
            if (type == 3) {
                $('#search_list .grp-menu[data-list-id = ' + cancel_id + '] li:eq(0)').remove();
                $('#search_list .grp-menu[data-list-id = ' + cancel_id + '] li:eq(1)').remove();
                $('#search_list .grp-menu[data-list-id = ' + cancel_id + ']').prepend('<li><a onclick="join_group(' + cancel_id + ', 0)" class="join_group">Join <i class="ion-plus"></i></a></li>');
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully cancelled the request.', type: 'success'});
            }
        }
    });
}

/* Leave Group */
function set_leave_group(id, type) {
    $('#leave_group #leave_group_id').val(id);
    $('#leave_group #leave_group_type').val(type);
}


/* Like Dislike */
function like_dislike(type, id) {
    if (type == 'ad') {
        var status = $('.listing #listing_table .post_like[data-id = ' + id + ']').attr('data-status');
        if (status == '0') {
            var count = parseInt($('.listing #listing_table .post_like[data-id = ' + id + '] span').text()) + 1;
            $('.listing #listing_table .post_like[data-id = ' + id + ']').attr('data-status', '1').addClass('liked');
            $('.listing #listing_table .post_like[data-id = ' + id + '] span').text(count);
            if ($('.listing #listing_table .post_dislike[data-id = ' + id + ']').hasClass('disliked')) {
                var count_dis = parseInt($('.listing #listing_table .post_dislike[data-id = ' + id + '] span').text()) - 1;
                $('.listing #listing_table .post_dislike[data-id = ' + id + '] span').text(count_dis);
                $('.listing #listing_table .post_dislike[data-id = ' + id + ']').attr('data-status', '0').removeClass('disliked');
            }
            $.post(base_url + 'dashboard/add_like_dislike', {type: 'ad', ad_id: id}, function () {});
        } else {
            var count = parseInt($('.listing #listing_table .post_like[data-id = ' + id + '] span').text()) - 1;
            $('.listing #listing_table .post_like[data-id = ' + id + ']').attr('data-status', '0').removeClass('liked');
            $('.listing #listing_table .post_like[data-id = ' + id + '] span').text(count);
            $.post(base_url + 'dashboard/remove_like_dislike', {type: 'ad', ad_id: id}, function () {});
        }
    }
    if (type == 'blog') {
        var status = $('.grid-item .blog-post-foot .blog_like[data-id = ' + id + ']').attr('data-status');
        if (status == '0') {
            var count = parseInt($('.grid-item .blog-post-foot .blog_like[data-id = ' + id + '] span').text()) + 1;
            $('.grid-item .blog-post-foot .blog_like[data-id = ' + id + ']').attr('data-status', '1').addClass('liked');
            $('.grid-item .blog-post-foot .blog_like[data-id = ' + id + '] span').text(count);
            $.post(base_url + 'dashboard/add_like_dislike', {type: 'blog', blog_id: id}, function () {});
        } else {
            var count = parseInt($('.grid-item .blog-post-foot .blog_like[data-id = ' + id + '] span').text()) - 1;
            $('.grid-item .blog-post-foot .blog_like[data-id = ' + id + ']').attr('data-status', '0').removeClass('liked');
            $('.grid-item .blog-post-foot .blog_like[data-id = ' + id + '] span').text(count);
            $.post(base_url + 'dashboard/remove_like_dislike', {type: 'blog', blog_id: id}, function () {});
        }
    }
    if (type == 'blog_inner') {
        var status = $('.panel-blog-single .blog-post-meta .blog_like').attr('data-status');
        if (status == '0') {
            var count = parseInt($('.panel-blog-single .blog-post-meta .blog_like span').text()) + 1;
            $('.panel-blog-single .blog-post-meta .blog_like').attr('data-status', '1').addClass('liked');
            $('.panel-blog-single .blog-post-meta .blog_like span').text(count);
            $.post(base_url + 'dashboard/add_like_dislike', {type: 'blog', blog_id: id}, function () {});
        } else {
            var count = parseInt($('.panel-blog-single .blog-post-meta .blog_like span').text()) - 1;
            $('.panel-blog-single .blog-post-meta .blog_like').attr('data-status', '0').removeClass('liked');
            $('.panel-blog-single .blog-post-meta .blog_like span').text(count);
            $.post(base_url + 'dashboard/remove_like_dislike', {type: 'blog', blog_id: id}, function () {});
        }
    }
    if (type == 'group') {
        var status = $('.group #timeline .timeline_post .group_like[data-id = ' + id + ']').attr('data-status');
        if (status == '0') {
            var count = parseInt($('.group #timeline .timeline_post .group_like[data-id = ' + id + '] span').text()) + 1;
            $('.group #timeline .timeline_post .group_like[data-id = ' + id + ']').attr('data-status', '1').addClass('liked');
            $('.group #timeline .timeline_post .group_like[data-id = ' + id + '] span').text(count);
            $.post(base_url + 'dashboard/add_like_dislike', {type: 'group', group_id: id}, function () {});
        } else {
            var count = parseInt($('.group #timeline .timeline_post .group_like[data-id = ' + id + '] span').text()) - 1;
            $('.group #timeline .timeline_post .group_like[data-id = ' + id + ']').attr('data-status', '0').removeClass('liked');
            $('.group #timeline .timeline_post .group_like[data-id = ' + id + '] span').text(count);
            $.post(base_url + 'dashboard/remove_like_dislike', {type: 'group', group_id: id}, function () {});
        }
    }
    if (type == 'thought' || type == 'location' || type == 'file' || type == 'image' || type == 'video' || type == 'timeline' || type == 'action') {
        var status = $('#timeline .timeline_post .post_like[data-id = ' + id + ']').attr('data-status');
        if (status == '0') {
            var count = parseInt($('#timeline .timeline_post .post_like[data-id = ' + id + '] span').text()) + 1;
            $('#timeline .timeline_post .post_like[data-id = ' + id + ']').attr('data-status', '1').addClass('liked');
            $('#timeline .timeline_post .post_like[data-id = ' + id + '] span').text(count);
            $.post(base_url + 'dashboard/add_like_dislike', {type: type, post_id: id}, function () {});
        } else {
            var count = parseInt($('#timeline .timeline_post .post_like[data-id = ' + id + '] span').text()) - 1;
            $('#timeline .timeline_post .post_like[data-id = ' + id + ']').attr('data-status', '0').removeClass('liked');
            $('#timeline .timeline_post .post_like[data-id = ' + id + '] span').text(count);
            $.post(base_url + 'dashboard/remove_like_dislike', {type: type, post_id: id}, function () {});
        }
    }
}

function gallery_like_dislike(type, id) {
    var status = $('#gallery_timeline .timeline_post .post_like[data-id = ' + id + ']').attr('data-status');
    if (status == '0') {
        var count = parseInt($('#gallery_timeline .timeline_post .post_like[data-id = ' + id + '] span').text()) + 1;
        $.post(base_url + 'dashboard/add_like_dislike', {type: type, post_id: id}, function (data) {
            if (data == 'success') {
                $('#gallery_timeline .timeline_post .post_like[data-id = ' + id + ']').attr('data-status', '1').addClass('liked');
                $('#gallery_timeline .timeline_post .post_like[data-id = ' + id + '] span').text(count);
            }
        });
    } else {
        var count = parseInt($('#gallery_timeline .timeline_post .post_like[data-id = ' + id + '] span').text()) - 1;
        $.post(base_url + 'dashboard/remove_like_dislike', {type: type, post_id: id}, function (data) {
            if (data == 'success') {
                $('#gallery_timeline .timeline_post .post_like[data-id = ' + id + ']').attr('data-status', '0').removeClass('liked');
                $('#gallery_timeline .timeline_post .post_like[data-id = ' + id + '] span').text(count);
            }
        });
    }
}

function comment_like(id) {
    var status = $('.comment .media-annotation .comment_like[data-id = ' + id + ']').attr('data-status');
    if (status == '0') {
        var count = parseInt($('.comment .media-annotation .comment_like[data-id = ' + id + '] span').text()) + 1;
        $('.comment .media-annotation .comment_like[data-id = ' + id + ']').attr('data-status', '1').addClass('liked');
        $('.comment .media-annotation .comment_like[data-id = ' + id + '] span').text(count);
        $.post(base_url + 'dashboard/add_comment_like', {comment_id: id}, function () {});
    } else {
        var count = parseInt($('.comment .media-annotation .comment_like[data-id = ' + id + '] span').text()) - 1;
        $('.comment .media-annotation .comment_like[data-id = ' + id + ']').attr('data-status', '0').removeClass('liked');
        $('.comment .media-annotation .comment_like[data-id = ' + id + '] span').text(count);
        $.post(base_url + 'dashboard/remove_comment_like', {comment_id: id}, function () {});
    }
}

/* Ad Dislike */
function ad_dislike(id) {
    var status = $('.listing #listing_table .post_dislike[data-id = ' + id + ']').attr('data-status');
    if (status == '0') {
        var count = parseInt($('.listing #listing_table .post_dislike[data-id = ' + id + '] span').text()) + 1;
        $.post(base_url + 'dashboard/add_like_dislike', {type: 'ad_dislike', ad_id: id}, function (data) {
            if (data == 'success') {
                $('.listing #listing_table .post_dislike[data-id = ' + id + ']').attr('data-status', '1').addClass('disliked');
                $('.listing #listing_table .post_dislike[data-id = ' + id + '] span').text(count);
                if ($('.listing #listing_table .post_like[data-id = ' + id + ']').hasClass('liked')) {
                    var count_like = parseInt($('.listing #listing_table .post_like[data-id = ' + id + '] span').text()) - 1;
                    $('.listing #listing_table .post_like[data-id = ' + id + '] span').text(count_like);
                    $('.listing #listing_table .post_like[data-id = ' + id + ']').attr('data-status', '0').removeClass('liked');
                }
            }
        });
    } else {
        var count = parseInt($('.listing #listing_table .post_dislike[data-id = ' + id + '] span').text()) - 1;
        $.post(base_url + 'dashboard/remove_like_dislike', {type: 'ad_dislike', ad_id: id}, function (data) {
            if (data == 'success') {
                $('.listing #listing_table .post_dislike[data-id = ' + id + ']').attr('data-status', '0').removeClass('disliked');
                $('.listing #listing_table .post_dislike[data-id = ' + id + '] span').text(count);
            }
        });
    }
}

/* Load Comment */
function load_comment(type, id) {
    $('.comment .comment-block').html('');
    $.post(base_url + 'dashboard/load_comment', {type: type, type_id: id}, function (data) {
        if (data != '') {
            if (type == 'blog') {
                $('.comment .comment-block').html(data);
                $('.comment .comment-block .comments').each(function () {
                    var comment = $.emoticons.replace($(this).find('.media-body p').text());
                    $(this).find('.media-body p').html(comment);
                });
            } else {
                $('.comment[data-id = ' + id + '] .comment-block').html(data);
                $('.comment[data-id = ' + id + '] .comment-block .comments').each(function () {
                    var comment = $.emoticons.replace($(this).find('.media-body p').text());
                    $(this).find('.media-body p').html(comment);
                });
            }
        }
    });
}

function load_comment_highlight(type, id, comment_id) {
    $('.comment .comment-block').html('');
    $.post(base_url + 'dashboard/load_comment', {type: type, type_id: id}, function (data) {
        if (data != '') {
            if (type == 'blog') {
                $('.comment .comment-block').html(data);
                $('.comment .comment-block .comments').each(function () {
                    var comment = $.emoticons.replace($(this).find('.media-body p').text());
                    $(this).find('.media-body p').html(comment);
                });
            } else {
                $('.comment[data-id = ' + id + '] .comment-block').html(data);
                $('.comment[data-id = ' + id + '] .comment-block .comments').each(function () {
                    var comment = $.emoticons.replace($(this).find('.media-body p').text());
                    $(this).find('.media-body p').html(comment);
                });
            }
            $('.comment .comment-block .comments[data-id = ' + comment_id + ']').css('border-right', '2px solid #fe5e3a');
            $(window).scrollTop($('.comment .comment-block #comment_' + comment_id).offset().top - 150);
        }
    });
}

/* Delete Comment */
function delete_comment(id, type_id) {
    if (type_id != '-1692') {
        var count = parseInt($('.comment_count[data-id = ' + type_id + '] span').text()) - 1;
    }
    $.post(base_url + 'dashboard/delete_comment', {comment_id: id}, function (data) {
        if (data == 'success') {
            if (type_id != '-1692') {
                $('.comment_count[data-id = ' + type_id + '] span').text(count);
            }
            $('.comment .comment-block .comments[data-id = ' + id + ']').remove();
            new PNotify({title: 'Success', delay: 1000, text: 'Comment successfully deleted.', type: 'success'});
        }
    });
}

/* Comment Reply */
function comment_reply(id) {
    $('.comment .comment-block .comments .comment-reply').html('');
    $('.comment .comment-block .comments[data-id = ' + id + '] .comment-reply').html('<div class="form-group has-feedback no-margin"><div class="input-group"><input name="comment" type="text" class="form-control input-xs comment_child_input" data-parent-id="' + id + '"  placeholder="Write a reply..."><div class="input-group-btn open"><button onclick="add_child_comment(' + id + ')" class="comment_btn" data-ripple><i class="ion-paper-airplane"></i></button></div></div></div>');
}

/* Add Child Comment */
function add_child_comment(id) {
    var comment = $('.comment .has-feedback .comment_child_input[data-parent-id = ' + id + ']').val();
    if (comment != '') {
        $.post(base_url + 'dashboard/add_child_comment', {parent_comment_id: id, comment: comment}, function (data) {
            if (data == 'success') {
                load_child_comment(id);
                $('.comment .comment-block .comments .comment-reply').html('');
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully posted a reply.', type: 'success'});
            }
        });
    } else {
        $('.comment .has-feedback .comment_child_input[data-parent-id = ' + id + ']').css('border-color', '#ad0000');
    }
}

/* Load Child Comment */
function load_child_comment(parent_id) {
    $('.comment .comment-block .comments[data-id = ' + parent_id + '] .comment-child').html('');
    $.post(base_url + 'dashboard/load_comment', {parent_id: parent_id}, function (data) {
        if (data != '') {
            $('.comment .comment-block .comments[data-id = ' + parent_id + '] .comment-child').html(data);
            $('.comment .comment-block .comments[data-id = ' + parent_id + '] .comment-child .comments').each(function () {
                var comment = $.emoticons.replace($(this).find('.media-body p').text());
                $(this).find('.media-body p').html(comment);
            });
        }
    });
}

function load_child_comment_highlight(parent_id, comment_id) {
    $('.comment .comment-block .comments[data-id = ' + parent_id + '] .comment-child').html('');
    $.post(base_url + 'dashboard/load_comment', {parent_id: parent_id}, function (data) {
        if (data != '') {
            $('.comment .comment-block .comments[data-id = ' + parent_id + '] .comment-child').html(data);
            $('.comment .comment-block .comments[data-id = ' + parent_id + '] .comment-child .comments').each(function () {
                var comment = $.emoticons.replace($(this).find('.media-body p').text());
                $(this).find('.media-body p').html(comment);
            });
            $('.comment .comment-block .comments[data-id = ' + comment_id + ']').css('border-right', '2px solid #fe5e3a');
            $(window).scrollTop($('.comment .comment-block #comment_' + comment_id).offset().top - 150);
        }
    });
}

/* Load Group Members */
function load_group_members(id, load) {
    $('.group .profile-main #timeline, .group .profile-main #load_more').hide();
    $('.profile-main .panel-heading').show();
    $('.group .profile-list #loader-profile').fadeIn();
    $('.profile-main .profile-head').text('Group Members');
    if (load == 'multiple') {
        $.post(base_url + 'dashboard/load_group_members', {grp_id: id, type: 'joined'}, function (data) {
            $('#members #grp_j .main').html('');
            if (data != '') {
                $('#members #grp_j .main').html(data);
                $('#members #grp_j p').hide();
            } else {
                $('#members #grp_j p').show();
            }
        });
        $.post(base_url + 'dashboard/load_group_members', {grp_id: id, type: 'new'}, function (data) {
            $('#members #grp_n .main').html('');
            if (data != '') {
                $('#members #grp_n .main').html(data);
                $('#members #grp_n p').hide();
            } else {
                $('#members #grp_n p').show();
            }
        });
    } else {
        $.post(base_url + 'dashboard/load_group_members', {grp_id: id, type: 'joined'}, function (data) {
            $('#members #grp_j .main').html('');
            if (data != '') {
                $('#members #grp_j .main').html(data);
                $('#members #grp_j p').hide();
            } else {
                $('.profile-main .profile-head').text('No Group Members to show!');
                $('#members #grp_members').hide();
            }
        });
    }
    $('.profile-list #loader-profile').fadeOut();
    $('.group .profile-main #pro_groups').show();
}

/* Accept Group Members */
function accept_grp_member(id) {
    $.post(base_url + 'dashboard/accept_grp_member', {user_id: id}, function (data) {
        if (data != '') {
            load_group_members(data, 'multiple');
            new PNotify({title: 'Success', delay: 1000, text: 'You have successfully accepted the request.', type: 'success'});
        }
    });
}

/* Set Remove Group Members */
function set_remove_grp_mem(id, type) {
    $('#delete_group_mem #delete_group_mem_id').val(id);
    $('#delete_group_mem #delete_group_mem_type').val(type);
    $('#delete_group_mem').modal('show');
}

/* Remove Group Members */
function remove_grp_member(id, type) {
    $.post(base_url + 'dashboard/remove_grp_member', {user_id: id}, function (data) {
        if (data != '') {
            load_group_members(data, 'multiple');
            if (type == 1) {
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully removed the member.', type: 'success'});
            } else {
                new PNotify({title: 'Success', delay: 1000, text: 'You have successfully deleted the request.', type: 'success'});
            }
        }
    });
}

/* Group Timeline */
function load_grp_timeline(id) {
    $('.group .profile-main #pro_groups, .group .profile-main .panel-heading').hide();
    $('.group .profile-list #loader-profile, .group .profile-main #load_more').fadeIn();
    $.post(base_url + 'dashboard/group_timeline', {grp_id: id}, function (data) {
        $('#timeline .main').html('');
        if (data != '') {
            $('#timeline .main').html(data);
            $('#timeline .main .timeline_post').each(function () {
                $(this).find('.timeline_post_title h4').html($.emoticons.replace($(this).find('.timeline_post_title h4').text()));
                $(this).find('.timeline_post_content p').html($.emoticons.replace($(this).find('.timeline_post_content p').text()));
                $(this).find('.timeline_post_content p').linkify({target: "_blank"});
            });
            $(".fancybox").fancybox({
                helpers: {
                    overlay: {
                        locked: false
                    }
                }
            });
            $('video').mediaelementplayer({
                enableAutosize: true
            });
        } else {
            $('.group .profile-main #load_more').hide();
        }
    });
    $('.profile-list #loader-profile').fadeOut();
    $('.group .profile-main #timeline').show();
}

/* Load More Group Timeline */
function loadmore_grp_timeline(grp_id) {
    $('.group .profile-main #load_more #loader').fadeIn();
    var id = $('.group .profile-main #timeline .timeline_post:last').attr('data-id');
    $.post(base_url + 'dashboard/group_timeline', {grp_id: grp_id, last_id: id}, function (data) {
        $('.group .profile-main #load_more #loader').fadeOut();
        if (data != '') {
            $('.group .profile-main #timeline .main').append(data);
            $('#timeline .main .timeline_post').each(function () {
                $(this).find('.timeline_post_title h4').html($.emoticons.replace($(this).find('.timeline_post_title h4').text()));
                $(this).find('.timeline_post_content p').html($.emoticons.replace($(this).find('.timeline_post_content p').text()));
                $(this).find('.timeline_post_content p').linkify({target: "_blank"});
            });
            $('video').mediaelementplayer({
                enableAutosize: true
            });
        } else {
            $('.group .profile-main #load_more').hide();
        }
    });
}

/* Delete Group Post */
function set_delete_grp_post(grp_id, post_id) {
    $('#delete_grp_post #delete_group_id').val(grp_id);
    $('#delete_grp_post #delete_post_id').val(post_id);
}

/* Delete Timeline Post */
function set_delete_timeline_post(post_id) {
    $('#delete_timeline_post #delete_post_id').val(post_id);
}

/* Timeline Privacy */
function get_timeline_post_privacy(post_id) {
    $.post(base_url + 'dashboard/timeline_privacy', {post_id: post_id}, function (data) {
        if (data == '0') {
            $('#timeline_privacy .p_one').attr('checked', 'checked');
        }
        if (data == '1') {
            $('#timeline_privacy .p_two').attr('checked', 'checked');
        }
        if (data == '2') {
            $('#timeline_privacy .p_three').attr('checked', 'checked');
        }
        $('#timeline_privacy #privacy_post_id').val(post_id);
    });
}

/* News Feed */
function load_newsfeed() {
    $('.home #timeline .trend_title').hide();
    $('.thumbnail .list-group-home #loader').fadeIn();
    $.post(base_url + 'dashboard/load_news_feed', function (data) {
        var res = JSON.parse(data);
        var feed = res['feed'];
        if (feed != '') {
            $('.newsfeed-body #timeline .main').html(feed);
            $('.newsfeed-body #timeline .main .timeline_post').each(function () {
                $(this).find('.timeline_post_title h4').html($.emoticons.replace($(this).find('.timeline_post_title h4').text()));
                $(this).find('.timeline_blog h4').html($.emoticons.replace($(this).find('.timeline_blog h4').text()));
                $(this).find('.timeline_post_content p').linkify({target: "_blank"});
            });
            $(".fancybox").fancybox({
                helpers: {
                    overlay: {
                        locked: false
                    }
                }
            });
            $('video').mediaelementplayer({
                enableAutosize: true
            });
            $('.timeline_post_content p').shorten({
                "showChars": 300,
                "moreText": "See More",
                "lessText": "Less"
            });
            $('#newsfeed #load_more').css('display', 'block');
            $('.letter').show();
        } else {
            $('#newsfeed #load_more').hide();
        }
    });
    $('.thumbnail .list-group-home #loader').fadeOut();
}

/* Load More News Feed */
function loadmore_newsfeed(load) {
    if (load == 'trend') {
        loadmore_trendingfeed();
    }
    if (load == 'news') {
        $('.newsfeed-body #load_more #loader').fadeIn();
        var id = $('.newsfeed-body #timeline .main .timeline_post:last').attr('data-id');
        $.post(base_url + 'dashboard/load_news_feed', {last_id: id}, function (data) {
            $('.newsfeed-body #load_more #loader').fadeOut();
            var res = JSON.parse(data);
            var feed = res['feed'];
            if (feed != '') {
                $('.newsfeed-body #timeline .main').append(feed);
                $('.newsfeed-body #timeline .main .timeline_post').each(function () {
                    $(this).find('.timeline_post_title h4').html($.emoticons.replace($(this).find('.timeline_post_title h4').text()));
                    $(this).find('.timeline_blog h4').html($.emoticons.replace($(this).find('.timeline_blog h4').text()));
                    $(this).find('.timeline_post_content p').linkify({target: "_blank"});
                });
                $('video').mediaelementplayer({
                    enableAutosize: true
                });
                $('.timeline_post_content p').shorten({
                    "showChars": 300,
                    "moreText": "See More",
                    "lessText": "Less"
                });
            } else {
                $('.newsfeed-body #load_more').text('Finished').attr('onclick', '').unbind('click');
            }
        });
    }
}

/* Trending Feed */
function load_trendingfeed() {
    $('.thumbnail .list-group-home #loader, .home #timeline .trend_title').fadeIn();
    $.post(base_url + 'dashboard/load_trending_feed', function (data) {
        var res = JSON.parse(data);
        var feed = res['feed'];
        if (feed != '') {
            $('.newsfeed-body #timeline .main').html(feed);
            $('.newsfeed-body #timeline .main .timeline_post').each(function () {
                $(this).find('.timeline_post_title h4').html($.emoticons.replace($(this).find('.timeline_post_title h4').text()));
                $(this).find('.timeline_blog h4').html($.emoticons.replace($(this).find('.timeline_blog h4').text()));
                $(this).find('.timeline_post_content p').linkify({target: "_blank"});
            });
            $(".fancybox").fancybox({
                helpers: {
                    overlay: {
                        locked: false
                    }
                }
            });
            $('video').mediaelementplayer({
                enableAutosize: true
            });
            $('#newsfeed #load_more').css('display', 'block');
            $('.letter').show();
        } else {
            $('#newsfeed #load_more').hide();
        }
    });
    $('.thumbnail .list-group-home #loader').fadeOut();
}

/* Load More News Feed */
function loadmore_trendingfeed() {
    $('.newsfeed-body #load_more #loader').fadeIn();
    var id = $('.newsfeed-body #timeline .main .timeline_post:last').attr('data-id');
    $.post(base_url + 'dashboard/load_trending_feed', {last_id: id}, function (data) {
        $('.newsfeed-body #load_more #loader').fadeOut();
        var res = JSON.parse(data);
        var feed = res['feed'];
        if (feed != '') {
            $('.newsfeed-body #timeline .main').append(feed);
            $('.newsfeed-body #timeline .main .timeline_post').each(function () {
                $(this).find('.timeline_post_title h4').html($.emoticons.replace($(this).find('.timeline_post_title h4').text()));
                $(this).find('.timeline_blog h4').html($.emoticons.replace($(this).find('.timeline_blog h4').text()));
                $(this).find('.timeline_post_content p').linkify({target: "_blank"});
            });
            $('video').mediaelementplayer({
                enableAutosize: true
            });
        } else {
            $('.newsfeed-body #load_more').text('Finished').attr('onclick', '').unbind('click');
        }
    });
}

/* Recent Activities */
function load_recent_act() {
    var id = $('.recent-act .panel-body .streamline .sl-item:first').attr('data-id');
    if (typeof id == 'undefined') {
        $.post(base_url + 'dashboard/latest_activities', {fetch_all: 'yes'}, function (data) {
            if (data != '') {
                if (data == 'session_expired') {
                    window.location = base_url;
                } else {
                    $('.recent-act .panel-body .streamline').html(data);
                }
            }
        });
    } else {
        $.post(base_url + 'dashboard/latest_activities', {first_id: id}, function (data) {
            if (data != '') {
                if (data == 'session_expired') {
                    window.location = base_url;
                } else {
                    $('.recent-act .panel-body .streamline').prepend(data);
                }
            }
        });
    }
}

/* Notifications */
function load_new_notification() {
    var grp_id = $('.navbar-right .notifications .dropdown-menu li.group:first').attr('data-id');
    var other_id = $('.navbar-right .notifications .dropdown-menu li.other:first').attr('data-id');
    var acc_grp_id = $('.navbar-right .notifications .dropdown-menu li.acc_group:first').attr('data-id');
    var inv_grp_id = $('.navbar-right .notifications .dropdown-menu li.inv_group:first').attr('data-id');
    var cmt_like_id = $('.navbar-right .notifications .dropdown-menu li.cmt_like:first').attr('data-id');
    if (typeof grp_id == 'undefined') {
        grp_id = 'all';
    }
    if (typeof other_id == 'undefined') {
        other_id = 'all';
    }
    if (typeof acc_grp_id == 'undefined') {
        acc_grp_id = 'all';
    }
    if (typeof inv_grp_id == 'undefined') {
        inv_grp_id = 'all';
    }
    if (typeof cmt_like_id == 'undefined') {
        cmt_like_id = 'all';
    }
    $.post(base_url + 'dashboard/new_notifications', {grp_id: grp_id, other_id: other_id, acc_grp_id: acc_grp_id, inv_grp_id: inv_grp_id, cmt_like_id: cmt_like_id}, function (data) {
        if (data != '') {
            if (data == 'session_expired') {
                window.location = base_url;
            } else {
                $('.navbar-right .notifications .dropdown-menu .media-container ul').prepend(data);
                $('.notifications .dropdown-menu .media-container').niceScroll({
                    cursorcolor: '#dcdcdc',
                    cursorwidth: '4px'
                });
                $('.navbar-right .notifications .bubble').fadeIn();
            }
        }
    });
    if ($('.navbar-right .notifications .dropdown-menu li').length > 5) {
        $('.navbar-right .notifications .dropdown-menu .media-container').css('height', '310px');
        $('.notifications .dropdown-menu .media-container').niceScroll({
            cursorcolor: '#dcdcdc',
            cursorwidth: '4px'
        });
    }
}

/* Notifications */
function load_new_connection_req() {
    var conn_id = $('.navbar-right .req_notifications .dropdown-menu li.conn:first').attr('data-id');
    var acc_conn_id = $('.navbar-right .req_notifications .dropdown-menu li.acc_conn:first').attr('data-id');
    if (typeof conn_id == 'undefined') {
        conn_id = 'all';
    }
    if (typeof acc_conn_id == 'undefined') {
        acc_conn_id = 'all';
    }
    $.post(base_url + 'dashboard/new_conn_req_notifications', {conn_id: conn_id, acc_conn_id: acc_conn_id}, function (data) {
        if (data != '') {
            if (data == 'session_expired') {
                window.location = base_url;
            } else {
                $('.navbar-right .req_notifications .dropdown-menu .media-container ul').prepend(data);
                $('.req_notifications .dropdown-menu .media-container').niceScroll({
                    cursorcolor: '#dcdcdc',
                    cursorwidth: '4px'
                });
                $('.navbar-right .req_notifications .bubble').fadeIn();
            }
        }
    });
    if ($('.navbar-right .req_notifications .dropdown-menu li').length > 5) {
        $('.navbar-right .req_notifications .dropdown-menu .media-container').css('height', '310px');
    }
}

/* Support Checklist */
function show_support_checklist(value) {
    if (value == 1) {
        $('#add_listing .sos_type_info, #post_update .sos_type_info').html('<div class="alert alert-info form-group" role="alert"><p><i class="ion-information-circled"></i> To announce a need or support - Posts/requests/articles by individuals/organisations who require assistance/advice/support from members/officials on any environment project(s) or socially relevant case(s).</p></div>');
        $('#add_listing .checklist, #post_update .checklist, #add_listing .contact_info, #post_update .contact_info').fadeIn();
    } else {
        $('#add_listing .sos_type_info, #post_update .sos_type_info').html('<div class="alert alert-info form-group" role="alert"><p><i class="ion-information-circled"></i> For those who perform worthy actions - Posts/articles by individuals/organisations who have successfully executed SOS actions on environment or social cases as a source of inspiration to others.</p></div>');
        $('#add_listing .checklist, #post_update .checklist, #add_listing .contact_info, #post_update .contact_info').fadeOut();
    }
}

/* Support Checklist */
function show_sos_desc(value) {
    if (value == 1) {
        $('#add_listing .sos_type_info').html('<div class="alert alert-info form-group" role="alert"><p><i class="ion-information-circled"></i> Provide details of location and upload pictures and videos of the good deed in your SOS post.</p></div>');
    } else {
        $('#add_listing .sos_type_info').html('<div class="alert alert-info form-group" role="alert"><p><i class="ion-information-circled"></i> Capture a screenshot of the online registration acknowledgement from Organ India, Parashar Foundation and upload the same in your SOS post.</p></div>');
    }
}

/* Support Description */
function action_Desc() {
    if ($('#add_listing .other_cb').is(":checked")) {
        $('#add_listing .action_desc').fadeIn();
    } else {
        $('#add_listing .action_desc').fadeOut();
    }
}

/* Update Support Description */
function update_action_Desc() {
    if ($('#post_update .other_cb').is(":checked")) {
        $('#post_update .action_desc').fadeIn();
    } else {
        $('#post_update .action_desc').fadeOut();
    }
}

/* Ads */
function load_ads() {
    $(".listing .top-nav-tab #loader_main").fadeIn();
    var cat_id = $('.listing #listing_table').attr('data-cat-id');
    var country = $('.listing #listing_table').attr('data-country');
    $.post(base_url + 'dashboard/load_post', {cat_id: cat_id, country: country}, function (data) {
        $('#listing_table').html('');
        if (data != '') {
            $('#listing_table').html(data);
            $('#listing_table .ad').each(function () {
                $(this).find('.content .title').html($.emoticons.replace($(this).find('.content .title').text()));
                $(this).find('.content .para').html($.emoticons.replace($(this).find('.content .para').text()));
            });
            $('video').mediaelementplayer({
                features: ['playpause', 'volume', 'fullscreen']
            });
            $(".listing .tabbable #load_more").css('display', 'block');
        } else {
            $('#listing_table').html('<h4 class="no_ads">No SOS to show. <a class="add-job-md trans" data-toggle="modal" data-target="#add_listing">Add new</a></h4>');
            $(".listing .tabbable #load_more").hide();
        }
        $(".listing .top-nav-tab #loader_main").fadeOut();
    });
}

/* Ad Related Users */
function load_post_related_users(cat_id) {
    $.post(base_url + 'dashboard/load_post_related_users', {cat_id: cat_id}, function (data) {
        $('#user .main').html('');
        if (data != '') {
            $('.listing #user').show();
            $('#user .main').html(data);
        } else {
            $('.listing #user').hide();
        }
    });
}

/* Ad Related Data */
function load_post_related_data(cat_id) {
    $.post(base_url + 'dashboard/load_post_related_data', {cat_id: cat_id}, function (data) {
        $('#info .main_data').html('');
        if (data != '') {
            var res = JSON.parse(data);
            var facts = res['facts'];
            var poss = res['poss'];
            $('#info .main_data').html(facts);
            $('.listing .nav-tabs-solid .actions').show();
            $('#actions .main').html(poss);
        }
    });
}

/* Filter Ads */
function filter_post(country_code) {
    $('.listing #listing_table').attr('data-country', country_code);
    load_ads();
}

/* Load More Ads */
function load_more_post() {
    $('.listing .tabbable #load_more #loader').fadeIn();
    var cat_id = $('.listing #listing_table').attr('data-cat-id');
    var country = $('.listing #listing_table').attr('data-country');
    var id = $('.listing #listing_table .ad:last').attr('data-id');
    $.post(base_url + 'dashboard/load_post', {last_id: id, cat_id: cat_id, country: country}, function (data) {
        if (data != '') {
            $('.listing #listing_table').append(data);
            $('#listing_table .ad').each(function () {
                $(this).find('.content .title').html($.emoticons.replace($(this).find('.content .title').text()));
                $(this).find('.content .para').html($.emoticons.replace($(this).find('.content .para').text()));
            });
            $('video').mediaelementplayer({
                features: ['playpause', 'volume', 'fullscreen']
            });
        } else {
            $('.listing .tabbable #load_more').text('Finished').attr('onclick', '').unbind('click');
        }
    });
    $('.listing .tabbable #load_more #loader').fadeOut();
}

/* Delete Ads */
function set_delete_post(id) {
    $('#post_delete #post_id').val(id);
}

/* Update Post */
function update_post(id) {
    $.post(base_url + 'dashboard/update_post', {id: id}, function (data) {
        $('#post_update .modal-body').html(data);
        setTimeout(function () {
            $('#post_update .country-select').select2();
            $('#post_update .type_select').select2();
            $('#post_update .select_post_area').select2();
            $('#post_update .post_tags').select2({
                tags: true
            });
        }, 180);
        $('#post_update').modal('show');
    });
}

/* Post Action */
function set_post_action(id, post_id, title) {
    $('#modal_actions #post_action_id').val(id);
    $('#modal_actions #post_action_id').attr('data-id', post_id);
    $('#modal_actions #cause-txt').html(title);
    $.post(base_url + 'dashboard/post_actions', {post_id: post_id}, function (data) {
        var res = JSON.parse(data);
        var name = res['username'].replace('"', '');
        name = name.replace('"', '');
        $('#modal_actions #name-txt').html(name);
        if (res['act_desc'] != '' && id == 8) {
            $('#modal_actions #act_desc').html(res['act_desc']);
            $('#modal_actions #name').html(name);
            $('#modal_actions #act').show();
        }
        $('#modal_actions').modal('show');
    });
}

/* Jobs */
function load_jobs() {
    $.post(base_url + 'dashboard/load_job', function (data) {
        $('#joblist-tab #listing_table').html('');
        if (data != '') {
            $('#joblist-tab #listing_table').html(data);
            $(".fancybox").fancybox({
                helpers: {
                    overlay: {
                        locked: false
                    }
                }
            });
            $(".job-description").shorten({
                "showChars": 300,
                "moreText": "See More",
                "lessText": "Less"
            });
            $('video').mediaelementplayer({
                features: ['playpause', 'volume', 'fullscreen']
            });
        } else {
            $('#joblist-tab #load_more').hide();
            $('#joblist-tab #listing_table').html('<h4 class="no_results">No list to show.</h4>');
        }
    });
    setTimeout(function () {
        $('.job-listing .row-center .load_job_loader').hide();
    }, 500);
}

/* Load More Jobs */
function load_more_jobs() {
    $('#joblist-tab #load_more #loader').fadeIn();
    var id = $('#joblist-tab #listing_table .job:last').attr('data-id');
    $.post(base_url + 'dashboard/load_job', {last_id: id}, function (data) {
        if (data != '') {
            $('#joblist-tab #listing_table').append(data);
            $('video').mediaelementplayer({
                features: ['playpause', 'volume', 'fullscreen']
            });
        } else {
            $('#joblist-tab #load_more').text('Finished').attr('onclick', '').unbind('click');
        }
    });
    $('#joblist-tab #load_more #loader').fadeOut();
}

/* Load Applied Jobs */
function applied_jobs() {
    $.post(base_url + 'dashboard/load_applied_jobs', function (data) {
        $('#joblist-tab #listing_table').html('');
        if (data != '') {
            $('#joblist-tab #listing_table').html(data);
            $(".fancybox").fancybox({
                helpers: {
                    overlay: {
                        locked: false
                    }
                }
            });
            $(".job-description").shorten({
                "showChars": 300,
                "moreText": "See More",
                "lessText": "Less"
            });
            $('video').mediaelementplayer({
                features: ['playpause', 'volume', 'fullscreen']
            });
            $('#joblist-tab #load_more').css('display', 'block');
        } else {
            $('#joblist-tab #load_more').hide();
            $('#joblist-tab #listing_table').html('<h4 class="no_results">You have not applied to any job posts. <a class="trans" href="' + base_url + 'dashboard/joblisting/all">View all jobs.</a></h4>');
        }
    });
    setTimeout(function () {
        $('.job-listing .row-center .load_job_loader').hide();
    }, 100);
}

/* Load More Applied Jobs */
function load_more_applied_jobs() {
    $('#joblist-tab #load_more #loader').fadeIn();
    var id = $('#joblist-tab #listing_table .job:last').attr('data-id');
    $.post(base_url + 'dashboard/load_applied_jobs', {last_id: id}, function (data) {
        if (data != '') {
            $('#joblist-tab #listing_table').append(data);
            $('video').mediaelementplayer({
                features: ['playpause', 'volume', 'fullscreen']
            });
        } else {
            $('#joblist-tab #load_more').text('Finished').attr('onclick', '').unbind('click');
        }
    });
    $('#joblist-tab #load_more #loader').fadeOut();
}

/* Load More Indeed Jobs */
function load_more_indeed_jobs() {
    $('#joblist-tab #load_more #loader').fadeIn();
    var pages = $('#joblist-tab #load_more').attr('data-pages');
    var page = $('#joblist-tab #load_more').attr('data-page');
    var cat = $('#joblist-tab #load_more').attr('data-cat');
    var country = $('#joblist-tab #load_more').attr('data-country');
    if(parseInt(page) == parseInt(pages) || parseInt(page) > parseInt(pages)) {
        $('#joblist-tab #load_more').text('Finished').attr('onclick', '').unbind('click').attr('data-pages', '').attr('data-page', '');
    } else {
        var nxt_page = parseInt(page) + 1;
        $.post(base_url + 'dashboard/load_more_indeed_jobs', {nxt_page: nxt_page, cat: cat, country: country}, function (data) {
            if (data != '') {
                $('#joblist-tab #load_more').remove();
                $('#joblist-tab #listing_table').append(data);
                $('#joblist-tab #load_more').attr('data-page', nxt_page);
            } else {
                $('#joblist-tab #load_more').text('Finished').attr('onclick', '').unbind('click').attr('data-pages', '').attr('data-page', '');
            }
        });
    }
    $('#joblist-tab #load_more #loader').fadeOut();
}

/* Load Applied Candidates */
function applied_candidates(job_id) {
    $.post(base_url + 'dashboard/load_applied_candidates/' + job_id, {job_id: job_id}, function (data) {
        $('#joblist-tab #listing_table').html('');
        if (data != '') {
            $('#joblist-tab #listing_table').html(data);
            $(".job-description").shorten({
                "showChars": 300,
                "moreText": "See More",
                "lessText": "Less"
            });
            $('video').mediaelementplayer({
                features: ['playpause', 'volume', 'fullscreen']
            });
        } else {
            $('#joblist-tab #listing_table').html('<h4 class="no_results">No candidates have applied to this job. <a class="trans" href="' + base_url + 'dashboard/joblisting/manage_jobs">Go back.</a></h4>');
        }
        $('#joblist-tab #load_more').hide();
    });
    setTimeout(function () {
        $('.job-listing .row-center .load_job_loader').hide();
    }, 500);
}

/* Load Shortlisted Candidates */
function shortlisted_candidates(job_id) {
    $.post(base_url + 'dashboard/load_shortlisted_candidates', {job_id: job_id}, function (data) {
        $('#joblist-tab #listing_table').html('');
        if (data != '') {
            $('#joblist-tab #listing_table').html(data);
            $(".job-description").shorten({
                "showChars": 300,
                "moreText": "See More",
                "lessText": "Less"
            });
            $('video').mediaelementplayer({
                features: ['playpause', 'volume', 'fullscreen']
            });
        } else {
            $('#joblist-tab #listing_table').html('<h4 class="no_results">You have not shortlisted any candidates for this job. <a class="trans" href="' + base_url + 'dashboard/joblisting/manage_jobs">Go back.</a></h4>');
        }
        $('#joblist-tab #load_more').hide();
    });
    setTimeout(function () {
        $('.job-listing .row-center .load_job_loader').hide();
    }, 500);
}

function shortlist_candidate(job_id, cand_id) {
    $.post(base_url + 'dashboard/shortlist_candidate', {job_id: job_id, cand_id: cand_id}, function (data) {
        if (data == 'success') {
            new PNotify({title: 'Success', delay: 1000, text: 'You have successfully shortlisted this candidate.', type: 'success'});
            $('#joblist-tab #listing_table .job[data-user-id = ' + cand_id + ']').remove();
            if (!$('#joblist-tab #listing_table .job').length) {
                $('#joblist-tab #listing_table').html('<h4 class="no_results">No candidates to show. <a class="trans" href="' + base_url + 'dashboard/joblisting/manage_jobs">Go back.</a></h4>');
            }
        }
    });
}

/* Delete Jobs */
function set_delete_job_post(id) {
    $('#delete_job #job_delete_id').val(id);
}

/* Update Job */
function update_job(id) {
    $.post(base_url + 'dashboard/update_job', {id: id}, function (data) {
        $('#job_update .modal-body').html(data);
        setTimeout(function () {
            $("#job_user_level, #job_user_type, #job_cat, .country-select").select2();
            $('.job_tags').select2({
                tags: true,
                allowClear: true
            });
            $('#job_update_end_date').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                drops: 'up',
                opens: 'right',
                minDate: new Date(),
                parentEl: '#date_update_box',
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });
        }, 180);
        $('#job_update').modal('show');
    });
}

/* Job Requests */
function load_candidates() {
    $.post(base_url + 'dashboard/load_candidates', function (data) {
        $('#joblist-tab #listing_table').html('');
        if (data != '') {
            $('#joblist-tab #listing_table').html(data);
            $(".job-description").shorten({
                "showChars": 300,
                "moreText": "See More",
                "lessText": "Less"
            });
            $('video').mediaelementplayer({
                features: ['playpause', 'volume', 'fullscreen']
            });
            $('#joblist-tab #load_more').css('display', 'block');
        } else {
            $('#joblist-tab #load_more').hide();
            $('#joblist-tab #listing_table').html('<h4 class="no_results">No list to show.</h4>');
        }
    });
    setTimeout(function () {
        $('.job-listing .row-center .load_job_loader').hide();
    }, 500);
}

/* Load More Jobs */
function load_more_candidates() {
    $('#joblist-tab #load_more #loader').fadeIn();
    var id = $('#joblist-tab #listing_table .job:last').attr('data-id');
    $.post(base_url + 'dashboard/load_candidates', {last_id: id}, function (data) {
        if (data != '') {
            $('#joblist-tab #listing_table').append(data);
            $('video').mediaelementplayer({
                features: ['playpause', 'volume', 'fullscreen']
            });
        } else {
            $('#joblist-tab #load_more').text('Finished').attr('onclick', '').unbind('click');
        }
    });
    $('#joblist-tab #load_more #loader').fadeOut();
}

/* Job Applocation */
function manage_jobs() {
    $.post(base_url + 'dashboard/load_my_job', function (data) {
        $('#joblist-tab #listing_table').html('');
        if (data != '') {
            $('#joblist-tab #listing_table').html(data);
            $(".job-description").shorten({
                "showChars": 300,
                "moreText": "See More",
                "lessText": "Less"
            });
            $('video').mediaelementplayer({
                features: ['playpause', 'volume', 'fullscreen']
            });
        } else {
            $('#joblist-tab #listing_table').html('<h4 class="no_results">No job post added. <a class="trans" data-toggle="modal" data-target="#post_job">Add now</h4><a/></h4>');
        }
    });
    setTimeout(function () {
        $('.job-listing .row-center .load_job_loader').hide();
    }, 500);
}

/* Share Post */
function set_share_post(type_id, type) {
    $('#share_post_id').val(type_id);
    $('#share_post_type').val(type);
    $('#share_post').modal('show');
}

/* Account Warning */
function account_warning_message() {
    swal({
        title: "Are you sure?",
        text: "You will be proceeding with a free account.",
        type: "warning",
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Yes',
        closeOnConfirm: false
    }).then(function () {
        window.location = base_url + 'dashboard/account_update';
    });
}

/* Support Invite Message */
function show_invite_box(value) {
    if (value == 2) {
        $('#invite_email .invite_box').show();
        $('#invite_email .preview_box').hide();
    } else {
        $('#invite_email .preview_box').show();
        $('#invite_email .invite_box').hide();
    }
}

/* SOS Message */
function sos_message(type) {
    var count = $('#ad_tab p.sos').attr('data-count');
    if (count == '0' || type == 'yes') {
        swal({
            title: "SOS",
            text: "The acronym SOS has many abbreviations; 'Save our Succor', 'Save our Souls', Save our Ship' and so on. The original use however, dates back to 1908 as an International Morse Code distress signal. We in WorthAct chose to give it the meaning, 'Save our Souls', as we believe that everyone and everything including our earth has a soul that cries out for help from the present stressfully polluted condition. Considering our daily busy life it is easy not to hear this cry for help. However, if you could stop for a moment, you might hear it. How would you respond?",
            type: "question",
            showCloseButton: true,
            showCancelButton: false,
            showConfirmButton: false
        });
        $('#ad_tab p.sos').attr('data-count', '1');
    }
}

/* Height Fix */
function set_height() {
    height = $(window).height() - 80;
    $('#chat_box').css('height', height + 'px');
}


/* Page Reload */
function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime > 20) {
        window.location.reload();
    }
}

/* CSR Upload Check */
function csr_upload_check(block) {
    if ($('.csr-form-body .box .block input[data-block = ' + block + ']').is(":checked")) {
        $('.csr-form-body .box .block .form-group[data-block = ' + block + ']').fadeIn();
    } else {
        $('.csr-form-body .box .block .form-group[data-block = ' + block + ']').fadeOut();
    }
}

/* CSR List */
function load_csr_list() {
    $('.top-nav-tab #loader').fadeIn();
    $.post(base_url + 'dashboard/load_csr_list', function (data) {
        $('#list .main').html('');
        if (data != '') {
            $('#list .main').html(data);
            $('#list #load_more').css('display', 'block');
        } else {
            $('#list #load_more').hide();
            $('#list .main').html('<h4 class="no_results">No list to show.</h4>');
        }
    });
    $('.top-nav-tab #loader').fadeOut();
}

/* Load More CSR List */
function load_more_csr_list() {
    $('.top-nav-tab #loader').fadeIn();
    var id = $('#list .main .col:last').attr('data-id');
    $.post(base_url + 'dashboard/load_csr_list', {last_id: id}, function (data) {
        if (data != '') {
            $('#list .main').append(data);
        } else {
            $('#list #load_more').text('Finished').attr('onclick', '').unbind('click');
        }
    });
    $('.top-nav-tab #loader').fadeOut();
}

/* CSR Process */
function load_csr_process() {
    $('.top-nav-tab #loader').fadeIn();
    $.post(base_url + 'dashboard/load_csr_process', function (data) {
        $('#process .main').html('');
        if (data != '') {
            $('#process .main').html(data);
            $('#process #load_more').css('display', 'block');
        } else {
            $('#process #load_more').hide();
            $('#process .main').html('<h4 class="no_results">No list to show.</h4>');
        }
    });
    $('.top-nav-tab #loader').fadeOut();
}

/* Load More CSR List */
function load_more_csr_process() {
    $('.top-nav-tab #loader').fadeIn();
    var id = $('#process .main .col:last').attr('data-id');
    $.post(base_url + 'dashboard/load_csr_process', {last_id: id}, function (data) {
        if (data != '') {
            $('#process .main').append(data);
        } else {
            $('#process #load_more').text('Finished').attr('onclick', '').unbind('click');
        }
    });
    $('.top-nav-tab #loader').fadeOut();
}

/* Account Warning */
function careers() {
    swal({
        text: "Please log in to view all the current openings.",
        type: "warning",
        showCloseButton: true,
        showCancelButton: false,
        showConfirmButton: false
    });
}

/* Page Block */
function page_block(country) {
    $('.adv-create .blocks h4, .adv-create .blocks .box').css('opacity', .3);
    $('.adv-create .page-block .page-select').val('').trigger('change');
    $('.adv-create .view-block .view-select').val('').trigger('change');
    $('.adv-create .blocks .box .avail span, .adv-create .blocks .box .on span').text('');
    $('.adv-create .blocks .box .avail, .adv-create .blocks .box a, .adv-create .blocks .box .booked, .adv-create .blocks .box .on').hide();
    $('.adv-create .page-block').attr('data-country', country);
    $('.adv-create .page-block').fadeIn();
    $('.adv-create .view-block').hide();
}

/* Viewport Block */
function viewport_block(page) {
    $('.adv-create .blocks h4, .adv-create .blocks .box').css('opacity', .3);
    $('.adv-create .view-block .view-select').val('').trigger('change');
    $('.adv-create .blocks .box .avail span, .adv-create .blocks .box .on span').text('');
    $('.adv-create .blocks .box .avail, .adv-create .blocks .box a, .adv-create .blocks .box .booked, .adv-create .blocks .box .on').hide();
    $('.adv-create .view-block').attr('data-page', page);
    $('.adv-create .view-block').fadeIn();
}

/* Ad Blocks */
function ad_blocks(view) {
    var page = $('.adv-create .view-block').attr('data-page');
    var country = $('.adv-create .page-block').attr('data-country');
    if (page != '' && view != '' && country != '') {
        $.post(base_url + 'dashboard/get_adv_blocks', {page: page, view: view, country: country}, function (data) {
            if (view == 1) {
                $('.adv-create .v2').hide();
                $('.adv-create .v1').show();
            } else {
                $('.adv-create .v1').hide();
                $('.adv-create .v2').show();
            }
            $('.adv-create .blocks h4').css('opacity', 1);
            var res = JSON.parse(data);
            for (var key in res) {
                if (res.hasOwnProperty(key)) {
                    $('.adv-create .blocks .box[data-id = ' + res[key].name + ']').css('opacity', 1);
                    if (res[key].status == 0) {
                        $('.adv-create .blocks .box[data-id = ' + res[key].name + '] .avail span').text('$' + res[key].price);
                        $('.adv-create .blocks .box[data-id = ' + res[key].name + '] a').attr('data-id', res[key].id);
                        $('.adv-create .blocks .box[data-id = ' + res[key].name + '] a').attr('data-country', country);
                        $('.adv-create .blocks .box[data-id = ' + res[key].name + '] a').attr('data-page', page);
                        $('.adv-create .blocks .box[data-id = ' + res[key].name + '] a').attr('data-view', view);
                        $('.adv-create .blocks .box[data-id = ' + res[key].name + '] a').attr('data-name', res[key].name);
                        $('.adv-create .blocks .box[data-id = ' + res[key].name + '] .avail, .adv-create .blocks .box[data-id = ' + res[key].name + '] a').fadeIn();
                    } else {
                        $('.adv-create .blocks .box[data-id = ' + res[key].name + '] .booked').fadeIn();
                        if (res[key].availability != '') {
                            $('.adv-create .blocks .box[data-id = ' + res[key].name + '] .on span').text(res[key].availability);
                            $('.adv-create .blocks .box[data-id = ' + res[key].name + '] .on').fadeIn();
                        }
                    }
                }
            }
        });
    }
}

/* Load Media */
function load_media() {
    $(".fancybox").fancybox({
        helpers: {
            overlay: {
                locked: false
            }
        }
    });
    $('video').mediaelementplayer({
        enableAutosize: true
    });
}

/* Job Search */
function load_job_search(cat, country) {
    $.post(base_url + 'dashboard/job_search', {job_cat: cat, country: country}, function (data) {
        if (data == '') {
            $('#joblist-tab #listing_table').html('<h4 class="no_results">No results found. <a class="trans" href="' + base_url + 'dashboard/joblisting/all">View all</a></h4>');
        } else {
            $('#joblist-tab #listing_table').html('');
            $('#joblist-tab #listing_table').html(data);
        }
    });
    setTimeout(function () {
        $('.job-listing .row-center .load_job_loader').hide();
    }, 500);
}

/* Job Cat */
function load_job_cat(cat) {
    $.post(base_url + 'dashboard/job_cat_search', {job_cat: cat}, function (data) {
        if (data == '') {
            $('#joblist-tab #listing_table').html('<h4 class="no_results">No jobs found. <a class="trans" href="' + base_url + 'dashboard/joblisting/all">View all</a></h4>');
        } else {
            $('#joblist-tab #listing_table').html('');
            $('#joblist-tab #listing_table').html(data);
        }
    });
    setTimeout(function () {
        $('.job-listing .row-center .load_job_loader').hide();
    }, 500);
}

/* Apply Job */
function apply_job(job_id) {
    $.post(base_url + 'dashboard/apply_job', {job_id: job_id}, function (data) {
        if (data == 'success') {
            new PNotify({title: 'Success', delay: 1000, text: 'You have successfully applied to this job.', type: 'success'});
            $('.job-listing #listing_table .job[data-job = ' + job_id + '] .quick-actions .apply_job').html('<i class="ion-checkmark-circled"></i><a class="no_pointer">Applied</a>').find('a').attr('onclick', '').unbind('click');
        }
    });
}

/* Candidates Search */
function load_candidates_search(cat, country) {
    $.post(base_url + 'dashboard/candidates_search', {job_cat: cat, country: country}, function (data) {
        if (data == 'no_result') {
            $('#joblist-tab #listing_table').html('<h4 class="no_results">No results found. <a class="trans" href="' + base_url + 'dashboard/joblisting/all_candidates">View all</a></h4>');
        } else {
            $('#joblist-tab #listing_table').html('');
            $('#joblist-tab #listing_table').html(data);
            $('#joblist-tab #load_more').hide();
        }
    });
    setTimeout(function () {
        $('.job-listing .row-center .load_job_loader').hide();
    }, 500);
}

/* Load WI */
function load_wi(cat_id) {
    $('#acc_listing .list-group li a[data-cat-id = ' + cat_id + ']').addClass('checked');
    $('.listing #listing_table').attr('data-cat-id', cat_id);
    $('.listing #info .readmore').show();
    $('.listing #info .main_data').css('height', '500px');
    load_ads();
    load_post_related_users(cat_id);
    load_post_related_data(cat_id);
    $('.listing .nav-tabs-solid .actions span').text('Your Possibilities');
    setTimeout(function () {
        $('.listing .nav-tabs-solid li, .listing .social .tab-pane').removeClass('active');
        $('.listing .nav-tabs-solid .info, .listing .social #info').addClass('active');
    }, 100);
    setTimeout(function () {
        $('.listing .row-center .load_wi_loader').hide();
        $('.listing .row-center .top-nav-tab, .listing .row-center .social').fadeIn();
    }, 1000);
}

/* Load SESO Group */
function load_seso_grp(grp) {
    $('.seso_list #load').fadeIn();
    $.post(base_url + 'seso/load_group', {grp: grp}, function (data) {
        if (data == '') {
            $('.seso_list #listing .box').html('<div class="alert alert-danger" role="alert"><h4 class="no_results">No results found.</h4></div>');
        } else {
            $('.seso_list #listing .box').html('');
            $('.seso_list #listing .box').html(data);
        }
    });
    $('.seso_list #load').fadeOut();
}

/* View SESO Essay */
function load_seso_essay(id) {
    $('.seso_list #listing .box .col[data-id = ' + id + '] .inner .action #box_loader').fadeIn();
    $.post(base_url + 'seso/load_seso_essay', {id: id}, function (data) {
        if (data != '') {
            $('#essay_content .modal-content').html(data);
            $('#essay_content').modal('show');
        }
    });
    $('.seso_list #listing .box .col[data-id = ' + id + '] .inner .action #box_loader').fadeOut();
}

/* View SESO Drawing */
function load_seso_drawing(id) {
    $('.seso_list #listing .box .col[data-id = ' + id + '] .inner .action #box_loader').fadeIn();
    $.post(base_url + 'seso/load_seso_drawing', {id: id}, function (data) {
        if (data != '') {
            $('#drawing_content .modal-content').html(data);
            $('.seso_list .modal .modal-body .media .fancybox').fancybox({
                helpers: {
                    overlay: {
                        locked: false
                    }
                }
            });
            $('#drawing_content').modal('show');
        }
    });
    $('.seso_list #listing .box .col[data-id = ' + id + '] .inner .action #box_loader').fadeOut();
}

/* SESO Poster */
function printPoster() {
    var printContents = document.getElementById('poster').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
