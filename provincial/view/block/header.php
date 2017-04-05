<header role="banner" class="site_header" id="header">
    <div class="flag_lang1">
        <div id="profile_photo">
            <a href="http://ifrcindex.com" target="_blank"><img alt="Intelligent Financial Research & Consulting" src="<?php echo BASE_URL; ?>template/images_post/logo_ifrc12.png"/></a>
        </div>
        <div class="title_website" style="float: right; width: 50%;"><img style="width: 100%;" src="<?php echo TEMPLATE_URL ?>images_post/title.png" />
           <div>This website is optimised for landscape display</div>
        </div>
    </div>
    <div class="social_links">
        <a style="text-decoration: none;" href="<?php echo BASE_URL; ?>" title="<?php echo $data['trans']->getTranslate('home_page'); ?>"><strong style="color: #4CA5D0;"><?php echo strtoupper($data['trans']->getTranslate('home_page')); ?></strong></a>
        | <a style="text-decoration: none;" href="http://vnxindex.com"  target="_blank" title="<?php echo $data['trans']->getTranslate('vnxindex_com'); ?>"><strong  style="color: #4CA5D0;"><?php echo strtoupper($data['trans']->getTranslate('vnxindex_com')); ?></strong></a>
    </div>

    <div class="flag_lang" style="float: left; margin-left: 116px; position: absolute;">
        <ul>      
            <?php
            foreach ($language as $key => $value)
            {
                $active = ($value['code'] == $_SESSION['LANG_CURRENT']) ? "class='active'" : "";
                ?>
                <li <?php echo $active ?>>
                    <a langcode="<?php echo $value['code'] ?>" onclick="changeLanguage('<?php echo $value['code'] ?>')" href="javascript: void(0);">
                        <img width="20" height="15" src="<?php echo PARENT_URL . 'assets/templates/backend/images/icons/flags/' . $value['code'] . '.png' ?>"/>
                    </a>
                </li>
                <?php
            }
            ?>
            <!--<div id="profile_photo">
                <a href="<?php echo $data['trans']->getTranslate('provincial_href'); ?>" target="_blank"> <img src="<?php echo BASE_URL; ?>template/images_post/logo-partners.png"/></a>
            </div>-->
        </ul>
    </div>
    

    
</header>