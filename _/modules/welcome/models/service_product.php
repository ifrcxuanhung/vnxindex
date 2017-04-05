<?php
$tong = count($list['curent']);
$count = 0;
if ($list['curent']) {
    foreach ($list['curent'] as $key => $value) {
        $count++;
        $string = explode("<hr />", $value['intro']);
        if ($count % 3 == 0) {
            ?>                                          <div class="portfolio_item last">
                <div class="thumb">
                    <a title="<?php echo $value['title']; ?>" href="<?php echo $value['images']; ?>"
                       data-rel="prettyPhoto"><img class="featured" src="<?php echo WEBSITE_URL; ?>/Public/thumb.php?src=<?php echo $value['images']; ?>&w=273" title="<?php echo $value['title']; ?>" alt="<?php echo $value['title']; ?>" /></a>
                    <div class="actions">
                        <a class="view photo" title="<?php echo $value['title']; ?>" href="<?php echo $value['images']; ?>"
                           data-rel="prettyPhoto">View</a>
                        <a href="#" class="share">Share</a>
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
                        <a href="<?php echo WEBSITE_URL; ?>/articles/<?php echo $value['code_cate_news'] . '/' . unicode_convert($value['title']) . '-' . $value['newsid']; ?>.html"><?php echo $value['title']; ?></a>
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
                ?>                                        <div class="portfolio_item">
                    <div class="thumb">
                        <a title="<?php echo $value['title']; ?>" href="<?php echo $value['images']; ?>" data-rel="prettyPhoto">
                            <img class="featured" src="<?php echo WEBSITE_URL; ?>/Public/thumb.php?src=<?php echo $value['images']; ?>&w=273" title="<?php echo $value['title']; ?>" alt="<?php echo $value['title']; ?>" />
                        </a>
                        <div class="actions">
                            <a class="view photo" title="<?php echo $value['title']; ?>" href="<?php echo $value['images']; ?>"
                               data-rel="prettyPhoto">View</a>
                            <a href="#" class="share">Share</a>
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
                            <a href="<?php echo WEBSITE_URL; ?>/articles/<?php echo $value['code_cate_news'] . '/' . unicode_convert($value['title']) . '-' . $value['newsid']; ?>.html"><?php echo $value['title']; ?></a>
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
    ?>