<?php
if (is_array($list) && $list['curent']) {
    $count = 0;
    foreach ($list['curent'] as $key => $value) {
        $count++;
        ?>
        <div class="detail_intro_copn">
            <h2><?php echo $value['title']; ?></h2>
            <?php if ($value['image'] != '') { ?>
                <div class="pic_page_list">
                    <img class="bdr_pages_list featured" src="<?php echo image_thumb($value['image'], 200, 175,0); ?>">     
                    <div class="actions">
                        <a data-rel="prettyPhoto" href="<?php echo base_url() . $value['image'] ?>" title="" class="view photo">view</a>
                        <a class="share" href="#">share</a>
                        <div class="share_wrapper" style="display: none;">
                            <div class="share_icons">
                                <a href="http://facebook.com" target="_blank"><img alt="Facebook" src="<?php echo $template_url; ?>images/icon-facebook.png"></a>
                                <a href="http://plus.google.com" target="_blank"><img alt="Google Plus" src="<?php echo $template_url; ?>images/icon-googleplus.png"></a>
                                <a href="http://www.twitter.com" target="_blank"><img alt="Twitter" src="<?php echo $template_url; ?>images/icon-twitter.png"></a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php echo str_replace("<hr />", "", $value['description']); ?>
            <?php } else { ?>
                <p><?php echo str_replace("<hr />", "", $value['description']); ?>
                </p>
            <?php } ?>
            <span><strong><?php echo $value['long_description']; ?></strong></span>
        </div>
        <?php
    }
}

?>