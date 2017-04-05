<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv = "Content-Type" content = "text/html; charset=utf-8" />
        <title><?php trans('change_password'); ?></title>
        <link rel = "stylesheet" href = "<?php echo base_url(); ?>assets/bundles/sendmail/css/style.css" type = "text/css" />
        <link rel = "stylesheet" href = "<?php echo base_url(); ?>assets/bundles/sendmail/css/theme-1.css" type = "text/css" /> <!--theme file - can be changed-->
        <!--js files-->

        <script type='text/javascript' src='<?php echo base_url(); ?>assets/bundles/jquery-1.7.2.min.js'></script>
        <script src="<?php echo base_url(); ?>assets/bundles/jquery-ui/jquery-ui-1.8.22.custom.min.js"></script>
        <script type = "text/javascript" src = "<?php echo base_url(); ?>assets/bundles/jquery.form.js"></script>
        <script>
            var $base_url = "<?php echo base_url(); ?>";
            var url = document.referrer;
            if (url === null || url == '') {
                url = $base_url;
            }
        </script>
        <style>
            input[type="radio"]{
                margin-top: 12px;
            }
            div.field > label{
                width: 106px;
                text-align: left;
            }
            label.error{
                margin-left: 110px;
            }
            .bt_resform{
                float: right;
                margin-right: 35%;
                margin-bottom: 25px;
            }
            .right_resform {
                float: none;
                height: auto;
                margin: auto;
                width: 400px;
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
                                    <div class="right_resform">
                                        <div class="field">
                                            <label><font style="color: #fff;"><?php trans('old_password'); ?></font></label>
                                            <input type="password" name="old-password" id="old-password" value="" class="fix_wd_txt" />
                                            <div class="error"><label class="error"><?php echo isset($error) ? $error : ''; ?></label></div>
                                        </div>
                                        <div class="field">
                                            <label><font style="color: #fff;"><?php trans('new_password'); ?></font></label>
                                            <input type="password" name="password" id="password" value="" class="fix_wd_txt" />
                                            <div class="error"></div>
                                        </div>
                                        <div class="field half-size">
                                            <label><font style="color: #fff;"><?php trans('retype_new_password') ?></font></label>
                                            <input type="password" name="password2" id="password2" value="" class="fix_wd_txt" />
                                            <div class="error"></div>
                                        </div>
                                    </div>
                                    <div class="clear">&nbsp;</div>
                                    <div class="bt_resform">
                                        <input type="submit" name="submit" value="<?php trans('change'); ?>" />
                                        <input type="hidden" name="is_js" value="" />
                                    </div>
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
                            password2: 'password_match'
                        },
                        messages: {
                            password2: 'Does not match password',
                        },
                        errorPlacement: function(error, element) {
                            error.appendTo(element.parent().children("div.error"));
                        }
                    });
                });
        </script>
        </div>
    </body>
</html>