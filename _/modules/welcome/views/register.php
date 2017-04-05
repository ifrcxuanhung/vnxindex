<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv = "Content-Type" content = "text/html; charset=utf-8" />
        <title><?php trans('register'); ?></title>
        <link rel = "stylesheet" href = "<?php echo base_url(); ?>assets/bundles/sendmail/css/style.css" type = "text/css" />
        <link rel = "stylesheet" href = "<?php echo base_url(); ?>assets/bundles/sendmail/css/theme-1.css" type = "text/css" /> <!--theme file - can be changed-->
        <!--js files-->

        <script type='text/javascript' src='<?php echo base_url(); ?>assets/bundles/jquery-1.7.2.min.js'></script>
        <script type = "text/javascript" src = "<?php echo base_url(); ?>assets/bundles/jquery.form.js"></script>
        <script type = "text/javascript" src = "<?php echo base_url(); ?>assets/template/welcome/js/custom.js"></script>
        <script>
            var $base_url = "<?php echo base_url(); ?>";
        </script>
        <style>
            input[type="radio"]{
                margin-top: 12px;
            }
            div.field > label{
                width: 100px;
                text-align: left;
            }
            label.error{
                margin-left: 110px;
            }
            noscript{
                font-weight: bold;
                font-size: 50px;
                text-align: center;
                margin: auto;
                float: left;
                width: 100%;
                padding-top: 15%;
                color: red;
            }
            .fx_wd_resform {
                float: left;
                height: 100%;
                left: 0;
                position: fixed;
                top: 0;
                width: 100%;
            }
            .msg_reg_success{margin-top:20px; font-size:14px; color: white}
        </style>
        <!-- /js files -->
    </head>

    <body onload="$('#body').show();">
        <noscript><?php trans('please_enable_javascript'); ?>!</noscript>
        <div id="body" style="display: none">
            <div class="headline-wrapper">
                <div class="headline">
                    <div class="headline-inner">

                    </div>
                </div>
            </div>
            <!-- /Head Line -->

            <!-- Content Line -->
            <div class="contentline">
                <div class="clear_mr_top"></div>
                <div class="contentline-inner fixw">

                    <div class="content mr_top">
                        <div class="contact-form fx_wd_resform">
                            <!-- Contact Form -->
                            <div class="form-wraper fx_wd_resform" id="register-form" style="background:#24282B !important; border: 0px; color:#fff">
                                <h3></h3>
                                <form id="register" name="register" class="form"  action="" method="post">
                                    <div class="left_resform">                                    
                                        <div class="field">
                                            <label><font style="color: #fff;"><?php trans('email') ?></font> *</label>
                                            <input type="text" id="email" name="email" value="<?php echo isset($input['email']) ? $input['email'] : ''; ?>" class="required email fix_wd_txt" />
                                            <div class="error"></div>
                                        </div>
                                        <div class="field">
                                            <label><font style="color: #fff;"><?php trans('password'); ?></font> *</label>
                                            <input type="password" name="password" id="password" value="<?php echo isset($input['password']) ? $input['password'] : ''; ?>" class="required fix_wd_txt" />
                                            <div class="error"></div>
                                        </div>
                                        <div class="field half-size">
                                            <label><font style="color: #fff;"><?php trans('re-password'); ?></font> *</label>
                                            <input type="password" name="password2" id="password2" value="<?php echo isset($input['password2']) ? $input['password2'] : ''; ?>" class="required fix_wd_txt" />
                                            <div class="error"></div>
                                        </div>
                                        <div style="padding-right:40px;"><b><font style="color: red;">*</font> <?php trans('required_fields'); ?></b></div>
                                    </div>
                                    <div class="right_resform">
                                        <div class="field">
                                            <label><font style="color: #fff;"><?php trans('first_name'); ?></font></label>
                                            <input type="text" name="first_name"  value="<?php echo isset($input['first_name']) ? $input['first_name'] : ''; ?>" class="fix_wd_txt_right" />
                                        </div>
                                        <div class="field">
                                            <label><font style="color: #fff;"><?php trans('last_name'); ?></font></label>
                                            <input type="text" name="last_name"  value="<?php echo isset($input['last_name']) ? $input['last_name'] : ''; ?>" class="fix_wd_txt_right" />
                                        </div>
                                        <div class="field">
                                            <label><font style="color: #fff;"><?php trans('gender'); ?></font></label>&nbsp;&nbsp;
                                            <input type="radio" name="gender" value="Mr" class="required" checked /> <?php trans('mr'); ?> 
                                            <input type="radio" name="gender" value="Mrs" class="required" /> <?php trans('mrs'); ?> 
                                            <input type="radio" name="gender" value="Ms" class="required" /> <?php trans('ms'); ?>
                                        </div>
                                        <div class="field"><img src="<?php echo base_url(); ?>captcha" /><label><font style="color: #fff"><?php trans('captcha'); ?></font> *</label>
                                            <input type="text" style="width: 130px; float: left;" name="security_code" class="<?php echo isset($input['security_code']) ? 'error' : NULL; ?>" />
                                            <div class="error"></div>
                                        </div>
                                    </div>

                                    <div class="bt_resform field" style="margin-left:41%; margin-top: 30px">
                                        <input type="submit" name="submit" value="<?php trans('register'); ?>" />
                                        <input type="hidden" name="is_js" value="" />
                                    </div>
                                    <div class="clear">&nbsp;</div>
                                </form>
                            </div>
                            <!-- /Contact Form -->
                        </div>

                        <!-- /Contact Form -->
                    </div>

                    <div class="clear">&nbsp;</div>

                    <!-- /SECTION 4 -->
                </div>
            </div>
        </div>

        <!-- /Content Line -->

        <!-- Footer Line -->
        <!--div class="footerline">
            <div class="footerline-inner">
        
            </div>
        </div-->
        <!-- /Footer Line -->

        <script src="<?php echo base_url(); ?>assets/templates/welcome/js/jquery.validate.min.js" type="text/javascript"></script>    
        <script>
                $(document).ready(function() {
                    /**
                     *validate form contact
                     *
                     **/
                    $.validator.addMethod("password_match", function() {
                        return $("#password").val() == $("#password2").val();
                    });
                    $.validator.addMethod("check_user_exist", function() {
                        var email = $("#email").val();
                        var check;
                        $.ajax({
                            url: $base_url + 'account/check_valid_user',
                            type: 'post',
                            data: {
                                email: email,
                                id: '',
                            },
                            async: false,
                            success: function(rs) {
                                if (rs == 0) {
                                    check = false;
                                } else {
                                    check = true;
                                }
                            }
                        });
                        return check;
                    });
                    $("#register").validate({
                        onkeyup: false,
                        rules: {
                            email: {
                                required: true,
                                email: true,
                                check_user_exist: true
                            },
                            security_code: 'required',
                            password: 'required',
                            password2: 'password_match'
                        },
                        messages: {
                            email: {
                                required: 'Fill email',
                                email: 'Invalid email',
                                check_user_exist: 'User existed'
                            },
                            password: 'Fill password',
                            password2: 'Does not match password',
                            security_code: 'Fill security code'
                        },
                        errorPlacement: function(error, element) {
                            error.appendTo(element.parent().children("div.error"));
                        }
                    });
                    
                    $(function() {
                        test()
                        $(window).resize(function() {
                            test()
                        })//g?i hàm khi resize
                        function test() {
                            var windowWidth = $(window).width();
                            var windowHeight = $(window).height();
                            var widthPopup = $('.msg_reg_success').width();
                            var leftPopup = (windowWidth - widthPopup) / 2;
                            $('.msg_reg_success').css({"left": leftPopup});
                        }
                    });
                });
        </script>
        </div>
    </body>
</html>