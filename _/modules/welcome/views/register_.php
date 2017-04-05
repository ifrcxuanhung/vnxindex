<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv = "Content-Type" content = "text/html; charset=utf-8" />
        <title>Update Information</title>
        <link rel = "stylesheet" href = "<?php echo base_url(); ?>assets/bundles/sendmail/css/style.css" type = "text/css" />
        <link rel = "stylesheet" href = "<?php echo base_url(); ?>assets/bundles/sendmail/css/theme-1.css" type = "text/css" /> <!--theme file - can be changed-->
        <!--js files-->

        <script type='text/javascript' src='<?php echo base_url(); ?>assets/bundles/jquery-1.7.2.min.js'></script>
        <script type = "text/javascript" src = "<?php echo base_url(); ?>assets/bundles/jquery.form.js"></script>
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
        </style>
        <!-- /js files -->
    </head>

    <body onload="$('#body').show();">
        <noscript>Please enable Javascript!</noscript>
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
                    <div class="two-fifth pull-three last"></div>
                    <div class="removemargin"></div>
                    <!-- SECTION 5 -->

                    <!-- Sponsors -->

                    <div class="sponsors">
                        <img height="60px" src="<?php echo base_url(); ?>assets/bundles/sendmail/images/ifrc.jpg ?>" alt="" id="logo3" />
                    </div>
                    <!-- /Sponsors -->

                    <!-- /SECTION 5 -->

                    <!-- SECTION 4 -->
                    <h2>Register</h2>
                    <div class="contact-form fx_wd_resform">
                        <!-- Contact Form -->
                        <div class="form-wraper fx_wd_resform" id="register-form">
                            <h3></h3>
                            <form id="register" name="register" class="form"  action="" method="post">
                                <div class="left_resform">
                                    <div class="field">
                                        <label><font style="color: black;">First name</font></label>
                                        <input type="text" name="first_name"  value="<?php echo isset($input['first_name']) ? $input['first_name'] : ''; ?>" class="fix_wd_txt_right" />
                                    </div>
                                    <div class="field">
                                        <label><font style="color: black;">Last name</font></label>
                                        <input type="text" name="last_name"  value="<?php echo isset($input['last_name']) ? $input['last_name'] : ''; ?>" class="fix_wd_txt_right" />
                                    </div>
                                    <div class="field">
                                        <label><font style="color: black;">Phone</font></label>
                                        <input type="text" name="phone"  value="<?php echo isset($input['phone']) ? $input['phone'] : ''; ?>" class="fix_wd_txt_right" />
                                    </div>
                                    <div class="field">
                                        <label><font style="color: black;">Address</font></label>
                                        <input type="text" name="address"  value="<?php echo isset($input['address']) ? $input['address'] : ''; ?>" class="fix_wd_txt_right" />
                                    </div>
                                    <div class="field">
                                        <label><font style="color: black;">Company</font></label>
                                        <input type="text" name="company"  value="<?php echo isset($input['company']) ? $input['company'] : ''; ?>" class="fix_wd_txt_right" />
                                    </div>
                                    <div class="field">
                                        <label><font style="color: black;">Gender</font></label>&nbsp;&nbsp;
                                        <input type="radio" name="gender" value="Mr" class="required" checked /> Mr 
                                        <input type="radio" name="gender" value="Mrs" class="required" /> Mrs 
                                        <input type="radio" name="gender" value="Ms" class="required" /> Ms
                                    </div>
                                    <div class="field"><img src="<?php echo base_url(); ?>captcha" /><label><font style="color: black">Captcha</font> *</label>
                                        <input type="text" style="width: 130px; float: left;" name="security_code" class="<?php echo isset($input['security_code']) ? 'error' : NULL; ?>" />
                                        <div class="error"></div>
                                    </div>
                                </div>
                                <div class="right_resform"> 
                                    <div class="field">
                                        <label><font style="color: black;">Password</font> *</label>
                                        <input type="password" name="password" id="password" value="<?php echo isset($input['password']) ? $input['password'] : ''; ?>" class="required fix_wd_txt" />
                                        <div class="error"></div>
                                    </div>
                                    <div class="field half-size">
                                        <label><font style="color: black;">Re-password</font> *</label>
                                        <input type="password" name="password2" id="password2" value="<?php echo isset($input['password2']) ? $input['password2'] : ''; ?>" class="required fix_wd_txt" />
                                        <div class="error"></div>
                                    </div>
                                    <div style="padding-right:40px;"><b><font style="color: red;">*</font> Champs obligatoires</b></div>
                                </div>
                                <div class="clear">&nbsp;</div>
                                <div class="bt_resform" align="center">
                                    <input type="submit" name="submit" value="Enregistrer" />
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
        $(document).ready(function(){
        /**
         *validate form contact
         *
         **/
            $.validator.addMethod("password_match", function(){
                return $("#password").val() == $("#password2").val();
            });
            $.validator.addMethod("check_user_exist", function(){
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
                    success: function(rs){
                        if(rs == 0){
                            check = false;
                        }else{
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
                    security_code:'required',
                    password:'required',
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
        });
    </script>
</div>
</body>
</html>