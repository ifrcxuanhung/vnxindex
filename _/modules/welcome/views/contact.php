<div id="content" role="main" class="right-sidebar">
    <div id="sidebar">                    
        <div id="popular_posts-3" class="widget widget_popular_posts">
            <?php echo $actualites; ?>
        </div>
        <!-- start slider partners and sponsors -->
        <div id="portfolio-2" class="widget widget_portfolio">
            <?php echo $partner_right; ?>
        </div>
        <!-- end slider partners and sponsors -->
        <div>
            <?php echo $newsletter; ?>
        </div>
    </div>

    <div id="main">
        <div class="main_content">
            <div class="breadcrumb">
                <a href="<?php echo base_url(); ?>" class="lnk_home"><?php trans('home'); ?></a>
                <span><?php trans('contact'); ?></span>
            </div>
            <article class="post" id="post-201">
                <h2 class="entry-title"><?php trans('contact'); ?></h2>

                <div class="entry fix_cl_subtle">

                    <?php echo $contact; ?>
                    <p>&nbsp;</p>

                    <form action="" class="contact-form" method="post" name="contactForm" id="contactForm">
                        <div class="form clearfix">
                            <p>
                                <label for="name"><?php trans('your_name'); ?></label>
                                <input type="text" id="name" name="name" class="required" value="" />
                            </p>
                            <p class="last">
                                <label for="email"><?php trans('your_email_address'); ?></label>
                                <input type="text" id="email" name="email" class="required email" value="<?php echo isset($input['email']) ? $input['email'] : NULL; ?>" />                   
                            </p>
                            <p>
                                <label for="message"><?php trans('your_message'); ?></label>
                                <textarea id="message" name="message" rows="5"
                                          cols="15"><?php echo isset($input['message']) ? $input['message'] : NULL; ?></textarea>
                            </p>
                            <p>
                                <label for="captcha"><?php trans('captcha'); ?></label>               
                                <input type="captcha" id="captcha" name="captcha" class="fix_w_txt" style="width:140px; float: left" />
                                <img style="height: 26px;" src="<?php echo base_url(); ?>captcha" />
                            </p>
                            <?php
                            if (isset($error) && !empty($error))
                            {
                                echo '<p><label><font color="red">' . $error . '</font></label></p>';
                            }
                            ?>
                            <div class="alignright">
                                <p class="form-submit">
                                    <input type="submit" name="submit" value="<?php trans('Submit'); ?>" style="line-height:0px;" />
                                </p>
                                <input type="hidden" name="contact_to_2626" value="<?php echo $config['contact_email']; ?>" />
                            </div>
                        </div>
                    </form>

                </div>
            </article>
        </div>
    </div>
</div>
<script src="<?php echo template_url(); ?>js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        /**
         *validate form contact
         *
         **/
        jQuery("#contactForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                captcha: 'required',
                name: 'required',
                message: 'required'
            },
            messages: {
                loginEmail: {
                    required: "",
                    email: ""
                },
                name: ''
            },
            submitHandler: function(form) {
                jQuery(form).submit();
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent());
            }
        });
    });
</script>