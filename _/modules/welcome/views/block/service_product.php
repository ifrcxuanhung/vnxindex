<?php
if (isset($list['curent'])) {
    $tong = count($list['curent']);
    $count = 0;
    if ($list['curent']) {
        foreach ($list['curent'] as $key => $value) {
            $count++;
            $string = explode("<hr />", $value['description']);
            if ($count % 4 == 0) {
                ?>                                          
                <div class="portfolio_item last">
                    <div class="thumb">
                        <a title="<?php echo $value['title']; ?>" href="<?php echo $value['image']; ?>"
                           data-rel="prettyPhoto"><img class="featured" src="<?php echo image_thumb($value['image'], 290, 187); ?>" title="<?php echo $value['title']; ?>" alt="<?php echo $value['title']; ?>" /></a>
                        <div class="actions">
                            <a class="view photo" title="<?php echo $value['title']; ?>" href="<?php echo base_url() . $value['image']; ?>"
                               data-rel="prettyPhoto"><?php trans('view'); ?></a>
                            <a href="#" class="share"><?php trans('share'); ?></a>
                            <div class="share_wrapper">
                                <div class="share_icons">
                                    <a target="_blank" href="http://www.facebook.com"><img src="<?php echo $template_url; ?>images/icon-facebook.png" alt="Facebook" /></a>
                                    <a target="_blank" href="http://plus.google.com"><img src="<?php echo $template_url; ?>images/icon-googleplus.png" alt="Google Plus" /></a>
                                    <a target="_blank" href="http://www.twitter.com"><img src="<?php echo $template_url; ?>images/icon-twitter.png" alt="Twitter" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio_detail">
                        <h4>
                            <a href="<?php echo base_url(); ?>article/index/<?php echo $value['category_code'] . '/' . strtolower(utf8_convert_url($value['title'])); ?>.html"><?php echo $value['title']; ?></a>
                        </h4>
                        <p>
                            <?php echo $string[0]; ?>
                        </p>
                    </div>
                </div>
                <?php if ($count < $tong) {
                    ?>
                    <div class="clear"></div>
                    </div>
                    <div style="width:100%">
                        <?php
                    }
                } else {
                    ?>                    
                    <div class="portfolio_item">
                        <div class="thumb">
                            <a title="<?php echo $value['title']; ?>" href="<?php echo $value['image']; ?>" data-rel="prettyPhoto">
                                <img class="featured" src="<?php echo image_thumb($value['image'], 290, 187); ?>" title="<?php echo $value['title']; ?>" alt="<?php echo $value['title']; ?>" />
                            </a>
                            <div class="actions">
                                <a class="view photo" title="<?php echo $value['title']; ?>" href="<?php echo base_url() . $value['image']; ?>"
                                   data-rel="prettyPhoto"><?php trans('view'); ?></a>
                                <a href="#" class="share"><?php trans('share'); ?></a>
                                <div class="share_wrapper">
                                    <div class="share_icons">
                                        <a target="_blank" href="http://www.facebook.com"><img src="<?php echo template_url(); ?>images/icon-facebook.png" alt="Facebook" /></a>
                                        <a target="_blank" href="http://plus.google.com"><img src="<?php echo template_url(); ?>images/icon-googleplus.png" alt="Google Plus" /></a>
                                        <a target="_blank" href="http://www.twitter.com"><img src="<?php echo template_url(); ?>images/icon-twitter.png" alt="Twitter" /></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portfolio_detail">
                            <h4>
                                <a href="<?php echo base_url(); ?>article/index/<?php echo $value['category_code'] . '/' . strtolower(utf8_convert_url($value['title'])); ?>.html"><?php echo $value['title']; ?></a>
                            </h4>
                            <p>
                                <?php echo $string[0]; ?>
                            </p>
                        </div>
                    </div>
                    <?php
                }
            }
        }
    }
    ?>