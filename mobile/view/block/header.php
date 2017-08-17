<header role="banner" class="site_header" id="header">
    <div class="flag_lang1">
       <div id="profile_photo">
            <a href="http://ifrcindex.com" target="_blank"><img alt="Intelligent Financial Research & Consulting" src="<?php echo BASE_URL; ?>template/images_post/logo_ifrc.png"/></a>
       </div>
    </div>
    <!--<div class="social_links">
        <ul>
            li class="rss"><a href="#" target="_blank" title="RSS">RSS</a></li>
                        <li class="lnkd"><a href="#" target="_blank" title="Linkedin">Linkedin</a></li
            <li class="home"><a href="<?php echo BASE_URL ?>" title="<?php echo $data['trans']->getTranslate('home'); ?>"><?php echo $data['trans']->getTranslate('home'); ?></a></li>

<li class="fb"><a href="#" target="_blank" title="Facebook">Facebook</a></li>
<li class="tw"><a href="#" target="_blank" title="Twitter">Twitter</a></li>
<li class="gplus"><a href="#" target="_blank" title="Google+">Google+</a></li>
<li class="drb"><a href="#" target="_blank" title="Dribbble">Dribbble</a></li>
<li class="vim"><a href="#" target="_blank" title="Vimeo">Vimeo</a></li>
<li class="pin"><a href="#" target="_blank" title="Pinterst">Pinterst</a></li>

            <li>
        </ul>
    </div>-->
    <div class="social_links">
     <a style="text-decoration: none;" href="http://m.vnxindex.com" title="<?php echo $data['trans']->getTranslate('home_page'); ?>"><?php echo strtoupper($data['trans']->getTranslate('home_page')); ?></a>
      | <a style="text-decoration: none;" href="http://vnxindex.com" title="<?php echo $data['trans']->getTranslate('full_website'); ?>"><?php echo strtoupper($data['trans']->getTranslate('full_website')); ?></a>
    </div>
    <div class="flag_lang" style="float: left; margin-left: 108px; position: absolute;">
        <ul>
            <?php
            foreach ($language as $key => $value)
            {
                $active = ($value['code'] == $_SESSION['LANG_CURRENT']) ? "class='active'" : "";
                ?>
                <li <?php echo $active ?>>
                    <a langcode="<?php echo $value['code'] ?>" onclick="changeLanguage('<?php echo $value['code'] ?>')" href="javascript: void(0);">
                        <img width="20" height="15" src="<?php echo PARENT_URL . 'assets/templates/welcome/global/img/flags/' . $value['code'] . '.png' ?>"/>
                    </a>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
<!--	<div style="float:right; margin-right:0px" id="profile_photo" class="profile_pt_r">-->
<!--		<a href="http://pvnindex.vn" target="_blank"> <img alt="Intelligent Financial Research & Consulting" src="--><?php //echo BASE_URL; ?><!--template/images_post/logo-partners.png"/></a>-->
<!--	</div>-->
</header>