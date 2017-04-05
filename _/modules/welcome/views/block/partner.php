<?php
if (isset($list['curent'])) {
    $tong = count($list['curent']);
    $count = 0;
    if ($list['curent']) {
        foreach ($list['curent'] as $key => $value) {
            $count++;
            $string = explode("<hr />", $value['description']);
            if ($count % 3 == 0) {
                ?>                                          
                <div class="portfolio_item last">
                    <div class="thumb">
                        <a title="<?php echo $value['title']; ?>" href="#"><img class="featured" src="<?php echo image_thumb($value['image'], 390, 273); ?>" title="<?php echo $value['title']; ?>" alt="<?php echo $value['title']; ?>" /></a>
                    </div>
                    <div class="portfolio_detail">
                        <h4>
                            <a href="<?php echo base_url(); ?>article/index/<?php echo $value['category_code'] . '/' . strtolower(utf8_convert_url($value['title'])); ?>.html"><?php echo $value['title']; ?></a>
                        </h4>
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
                            <a title="<?php echo $value['title']; ?>" href="#" >
                                <img class="featured" src="<?php echo image_thumb($value['image'], 390, 273); ?>" title="<?php echo $value['title']; ?>" alt="<?php echo $value['title']; ?>" />
                            </a>
                        </div>
                        <div class="portfolio_detail">
                            <h4>
                                <a href="<?php echo base_url(); ?>article/index/<?php echo $value['category_code'] . '/' . strtolower(utf8_convert_url($value['title'])); ?>.html"><?php echo $value['title']; ?></a>
                            </h4>
                        </div>
                    </div>
                    <?php
                }
            }
        }
    }
    ?>