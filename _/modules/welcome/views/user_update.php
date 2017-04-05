<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv = "Content-Type" content = "text/html; charset=utf-8" />
        <title><?php trans('account_information'); ?></title>
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

        </style>
        <!-- /js files -->
    </head>

    <body onload="$('#body').show();">
        <noscript>Please enable Javascript!</noscript>
        <div id="body" style="display: none;">
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

                    <div class="content mr_top" >                    
                        <div class="contact-form fx_wd_resform" >
                            <!-- Contact Form -->
                            <div class="form-wraper fx_wd_resform" id="register-form" style="background:#24282B !important; border: 0px; color:#fff">
                                <h3></h3>
                                <form id="register" name="register" class="form"  action="" method="post">
                                    <div class="left_resform">
                                        <div class="field">
                                            <label><font style="color: #fff;"><?php trans('gender'); ?></font> *</label>
                                            <input type="radio" name="gender" value="Mr" class="required"<?php echo (!isset($input) || $input['gender'] == 'Mr') ? ' checked' : ''; ?> /> <?php trans('mr') ?> 
                                            <input type="radio" name="gender" value="Mrs" class="required"<?php echo (isset($input) && $input['gender'] == 'Mrs') ? ' checked' : ''; ?> /> <?php trans('mrs') ?> 
                                            <input type="radio" name="gender" value="Ms" class="required"<?php echo (isset($input) && $input['gender'] == 'Ms') ? ' checked' : ''; ?> /> <?php trans('ms') ?>
                                        </div>
                                        <div class="field">
                                            <label><font style="color: #fff;"><?php trans('e-mail'); ?></font> *</label>
                                            <input type="text" name="email"  value="<?php echo isset($input['email']) ? $input['email'] : ''; ?>" class="fix_wd_txt_right" />
                                            <div class="error"><label class="error"><?php echo isset($error) ? $error : ''; ?></label></div>
                                        </div>
                                        <div class="field">
                                            <label><font style="color: #fff;"><?php trans('first_name') ?></font> *</label>
                                            <input type="text" name="first_name"  value="<?php echo isset($input['first_name']) ? $input['first_name'] : ''; ?>" class="fix_wd_txt_right" />
                                        </div>
                                        <div class="field">
                                            <label><font style="color: #fff;"><?php trans('last_name') ?></font> *</label>
                                            <input type="text" name="last_name"  value="<?php echo isset($input['last_name']) ? $input['last_name'] : ''; ?>" class="fix_wd_txt_right" />
                                        </div>
                                        <div class="field">
                                            <label><font style="color: #fff;"><?php trans('birthday'); ?></font></label>&nbsp;&nbsp;
                                            <div style="padding-top: 8px; float: left">
                                            <?php
                                                
                                                $date = $input['date_birth'];
                                                $y = substr($date,0,4);
                                                $m = substr($date,5,2);
                                                $d = substr($date,8,2);
                                            ?>
                                                <select name="year" />
                                                <option value="0">yyyy</option>
                                                <?php for ($i = 2013; $i > 1932; $i--) { ?>
                                                    <option <?php if($y == $i) echo "selected='selected'"; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php } ?>
                                                </select> 
                                                <select name="month" />
                                                <option value="0">mm</option>
                                                <?php for ($i = 1; $i < 13; $i++) { ?>
                                                    <option <?php if($m == $i) echo "selected='selected'"; ?> value="<?php echo $i; ?>"><?php echo date('M', mktime(0, 0, 0, $i, 1)); ?></option>
                                                <?php } ?>
                                                </select> 
                                                <select name="day" />
                                                <option value="0">dd</option>
                                                <?php for ($i = 1; $i < 32; $i++) { ?>
                                                    <option <?php if($d == $i) echo "selected='selected'"; ?> value="<?php echo $i; ?>"><?php echo str_pad($i, 2, 0, STR_PAD_LEFT); ?></option>
                                                <?php } ?>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right_resform">
                                        <div class="field">
                                            <label><font style="color: #fff;"><?php trans('phone') ?></font></label>
                                            <input type="text" name="phone"  value="<?php echo isset($input['phone']) ? $input['phone'] : ''; ?>" class="fix_wd_txt_right" />
                                        </div>
                                        <div class="field">
                                            <label><font style="color: #fff;"><?php trans('address') ?></font></label>
                                            <input type="text" name="address"  value="<?php echo isset($input['address']) ? $input['address'] : ''; ?>" class="fix_wd_txt_right" />
                                        </div>
                                        <!--
                                        <div class="field">
                                            <label><font style="color: #fff;"><?php trans('company') ?></font></label>
                                            <input type="text" name="company"  value="<?php echo isset($input['company']) ? $input['company'] : ''; ?>" class="fix_wd_txt_right" />
                                        </div>
                                        -->
                                        <div class="field">
                                            <label><font style="color: #fff;"><?php trans('website') ?></font></label>
                                            <input type="text" name="website"  value="<?php echo isset($input['website']) ? $input['website'] : ''; ?>" class="fix_wd_txt_right" />
                                        </div>
                                        <div class="clear"></div>
                                        
                                    </div>
                                    <div class="bt_resform">
                                        <input type="submit" name="submit" value="<?php trans('update'); ?>" />
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
                            email: {
                                required: true,
                                email: true,
                            },
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