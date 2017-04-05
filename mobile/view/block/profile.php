<section class="section profile_section first odd" id="profile"> <!--a id="blog_page_link" href="blog-category-arhive.html"><span class="icon-pencil icon"></span><span class="label">Blog</span></a-->
    <div class="section_header profile_section_header opened">
        <h2 class="section_title profile_section_title vis"><a href="#"><span class="icon icon-user"></span><span class="section_name"><?php echo $data['trans']->getTranslate('vnx_indexes'); ?></span></a><span class="section_icon"></span></h2>
        <div id="profile_header">
            <div id="profile_user">
                <div id="profile_photo"><img src="<?php echo TEMPLATE_URL ?>images_post/logo_ifrc.png" alt="Intelligent Financial Research & Consulting" /></div>
                <div id="profile_name_area">
                    <div id="profile_name">
                        <h1 id="profile_title"><span class="firstname">IFRC</span></h1>
                        <h4 id="profile_position">Intelligent Financial <br />Research & Consulting</h4>
                    </div>
                </div>
            </div>
            <div id="profile_data">
                <div class="profile_row address"> <span class="th"><?php echo $data['trans']->getTranslate('Address'); ?>:</span><span class="td"><?php echo $data['trans']->getTranslate('Address_ifrc'); ?></span> </div>
                <div class="profile_row phone"> <span class="th"><?php echo $data['trans']->getTranslate('Phone'); ?>:</span><span class="td"><?php echo $data['trans']->getTranslate('Phone_ifrc'); ?></span> </div>
                <div class="profile_row email"> <span class="th"><?php echo $data['trans']->getTranslate('Email'); ?>:</span><span class="td">index@ifrc.fr</span> </div>
                <div class="profile_row website"> <span class="th"><?php echo $data['trans']->getTranslate('Website'); ?>:</span><span class="td"><a target="_blank" href="http://www.ifrcindex.com">wwww.ifrcindex.com</a></span> </div>
            </div>
        </div>
        <div id="profile_header">
            <div id="profile_user">
                <div id="profile_photo"><img src="<?php echo TEMPLATE_URL ?>images_post/logo-partners.png" height="10" alt="Petrovietnam Securities Incorporated" /></div>
                <div id="profile_name_area">
                    <div id="profile_name">
                        <h1 id="profile_title"><span class="firstname">PSI</span></h1>
                        <h4 id="profile_position">Petrovietnam Securities Incorporated</h4>
                    </div>
                </div>
            </div>
            <div id="profile_data">
                <div class="profile_row address"> <span class="th"><?php echo $data['trans']->getTranslate('Address'); ?>:</span><span class="td"><?php echo $data['trans']->getTranslate('Address_pvn'); ?></span> </div>
                <div class="profile_row phone"> <span class="th"><?php echo $data['trans']->getTranslate('Phone'); ?>:</span><span class="td"><?php echo $data['trans']->getTranslate('Phone_pvn'); ?></span> </div>
                <div class="profile_row email"> <span class="th"><?php echo $data['trans']->getTranslate('Email'); ?>:</span><span class="td">pvnindex@pvn.vn</span> </div>
                <div class="profile_row website"> <span class="th"><?php echo $data['trans']->getTranslate('Website'); ?>:</span><span class="td"><a target="_blank" href="http://www.pvnindex.vn">www.pvnindex.vn</a></span> </div>
            </div>
        </div>
    </div>
    <!--<hr />-->
    <div class="section_header section_body profile_section_body">
        <div class="proile_body"><?php echo is_array($data['info']) && isset($data['info']) ? $data['info']['curent'][0]['description'] . $data['info']['curent'][0]['long_description']: ''; ?></div>
    </div>
</section>