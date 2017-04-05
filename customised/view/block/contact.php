<section class="section contact_section even" id="contact">
    <div class="section_header contact_section_header">
        <h2 class="section_title contact_section_title"><a href="#"><span class="icon icon-envelope-alt"></span><span class="section_name"><?php echo $data['trans']->getTranslate('contacts'); ?></span></a><span class="section_icon"></span></h2>
    </div>
    <div class="section_body contact_section_body">
        <div id="googlemap_data">
            <div id="sc_googlemap" style="width:100%;height:294px;" class="sc_googlemap"></div>
            <div class="add_info">
                <div class="profile_row header "> <?php echo $data['trans']->getTranslate('Contact_info'); ?> </div>
                <div class="profile_row address"> <span class="th"><?php echo $data['trans']->getTranslate('Address'); ?></span><span class="td"></span> </div>
                <div class="profile_row phone"> <span class="th"><?php echo $data['trans']->getTranslate('Phone'); ?></span><span class="td"></span> </div>
                <div class="profile_row email"> <span class="th"><?php echo $data['trans']->getTranslate('Email'); ?></span><span class="td"></span> </div>
                <div class="profile_row website"> <span class="th"><?php echo $data['trans']->getTranslate('Website'); ?></span><span class="td"></span> </div>
            </div>
        </div>
        <div class="sidebar contact_sidebar"></div>
        <div class="contact_form">
            <div class="contact_form_data">
                <div class="sc_contact_form">
                    <div class="category_header resume_category_header">
                        <h3 class="category_title ctitle"><span class="category_title_icon aqua"></span><?php echo $data['trans']->getTranslate('Contact'); ?></h3>
                    </div>
                    <form id="contactForm" action="include/sendmail.php" method="post">
                        <div class="field">
                            <label class="required" for="sc_contact_form_username"><?php echo $data['trans']->getTranslate('Name'); ?></label>
                            <input type="text" name="username" id="sc_contact_form_username" />
                        </div>
                        <div class="field">
                            <label class="required" for="sc_contact_form_email"><?php echo $data['trans']->getTranslate('Email'); ?></label>
                            <input type="text" name="email" id="sc_contact_form_email" />
                        </div>
                        <div class="field message">
                            <label class="required" for="sc_contact_form_message"><?php echo $data['trans']->getTranslate('Your message'); ?></label>
                            <textarea name="message" id="sc_contact_form_message"></textarea>
                        </div>
                        <div class="field captcha">
                            <label class="required" for="sc_contact_form_message"><?php echo $data['trans']->getTranslate('Captcha'); ?></label>
                            <span id="captcha_image">
                                <img src="<?php echo BASE_URL; ?>captcha.php" />
                            </span>
                            <input type="text" name="captcha" id="sc_contact_form_captcha" />
                        </div>
                        <div class="button"> <a onclick="sendContact(document.getElementById('sc_contact_form_username').value, document.getElementById('sc_contact_form_email').value, document.getElementById('sc_contact_form_message').value, document.getElementById('sc_contact_form_captcha').value)" class="enter" href="javascript:void(0);"><span><?php echo $data['trans']->getTranslate('Submit'); ?></span></a> </div>
                    </form>
                    <div id="result" class="result sc_infobox"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- .section_body --> 
</section>
<script type="text/javascript">
    function sendContact(name, email, message, captcha)
    {
        var status = 0;
        if (name == "")
        {
            document.getElementById('result').innerHTML = "<span class='warning-msg'><?php echo $data['trans']->getTranslate('name_is_required'); ?></span>";
            return false;
        }
        else
        {
            if (email == "")
            {
                document.getElementById('result').innerHTML = "<span class='warning-msg'><?php echo $data['trans']->getTranslate('email_is_required'); ?></span>";
                return false;
            }
            else
            {
                if (!checkmail(email))
                {
                    document.getElementById('result').innerHTML = "<span class='warning-msg'><?php echo $data['trans']->getTranslate('email_is_not_valid'); ?></span>";
                    return false;
                }
                if (message == "")
                {
                    document.getElementById('result').innerHTML = "<span class='warning-msg'><?php echo $data['trans']->getTranslate('message_is_required'); ?></span>";
                    return false;
                }
                if (captcha == "")
                {
                    document.getElementById('result').innerHTML = "<span class='warning-msg'><?php echo $data['trans']->getTranslate('captcha_is_required'); ?></span>";
                    return false;
                }
                else
                {
                    document.getElementById('result').innerHTML = "";
                    status = 1;
                }
            }
        }

        if (status == 1)
        {
            document.getElementById('result').innerHTML = "<span><?php echo $data['trans']->getTranslate('sending_contact'); ?>...</span>";
            jQuery.ajax({
                url: BASE_URL + 'ajax/contact',
                type: 'post',
                data: {name: name, email: email, message: message, captcha: captcha},
                success: function(data) {
                    if (data == 1)
                    {
                        document.getElementById('result').innerHTML = "<span class='success-msg'><?php echo $data['trans']->getTranslate('send_contact_successfull'); ?></span>";
                        document.getElementById('sc_contact_form_username').value = "";
                        document.getElementById('sc_contact_form_email').value = "";
                        document.getElementById('sc_contact_form_message').value = "";
                        document.getElementById('sc_contact_form_captcha').value = "";
                    } else {
                        document.getElementById('result').innerHTML = "<span class='warning-msg'><?php echo $data['trans']->getTranslate('captcha_is_not_valid'); ?></span>";
                        document.getElementById('sc_contact_form_captcha').value = "";
                    }
                }
            });
        }


    }

    function checkmail(email) {
        var emailfilter = /^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i;
        var returnval = emailfilter.test(email);
        return returnval;
    }
</script>