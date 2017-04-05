<div id="newsletter-2" class="widget widget_newsletter">
    <h3><?php trans('newsletter'); ?></h3>
    <span class="widget_icon"></span>
    <form class="simple-mail-collector-form" name="simple_mail_collector_form-2"
          method="post">
        <p><?php trans('join_our_monthly_newsletter_to_get_an_inside_look_at_how_we_make_things_happen'); ?></p>
        <input class="simple-mail-collector-email" type="text" id="simple-mail-collector-email-2"
               name="simple_mail_collector_email-2" value="<?php trans('your_email_address'); ?>" />
        <button type="button" class="simple-mail-collector-submit" id="simple-mail-collector-submit-2"
                name="simple_mail_collector_submit-2">
            <span><?php trans('Register'); ?></span>
        </button>
    </form>
    <div class="clear"></div>
</div>
<script>
    jQuery(document).ready(function() {
        jQuery('#simple-mail-collector-submit-2').click(function() {
            var $email = jQuery('#simple-mail-collector-email-2').val();
            if ($email != '<?php trans('your_email_address'); ?>') {

                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                if (!emailReg.test($email)) {
                    //alert("<?php echo trans('email_is_not_valid'); ?>");
                    showPopupMessage('<?php echo trans('email_is_not_valid'); ?>');
                } else {
                    jQuery.ajax({
                        type: "POST",
                        url: $base_url + 'home',
                        data: {email: $email}
                    }).done(function(msg) {
                        if (msg == 'ok') {
                            jQuery('#simple-mail-collector-email-2').val('<?php trans('your_email_address'); ?>');
                            //alert("<?php echo trans('you_are_currently_subscribed_to_our_newsletter'); ?>");
                            showPopupMessage('<?php echo trans('you_are_currently_subscribed_to_our_newsletter'); ?>');
                        } else {
                            //alert('<?php echo trans('email_is_exist_please_try_another'); ?>');
                            showPopupMessage('<?php echo trans('email_is_exist_please_try_another'); ?>');
                        }
                    });
                }
            } else {
                //alert('<?php echo trans('please_enter_email'); ?>');
                showPopupMessage('<?php echo trans('please_enter_email'); ?>');
            }
        });
    });
</script>