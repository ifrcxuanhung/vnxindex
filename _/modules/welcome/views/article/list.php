<?php showBlock('slide_top'); ?>
<div id="content" role="main" class="right-sidebar">
    <div id="sidebar">
        <div id="subnav-3" class="widget widget_subnav pd_fix">
            <h3><?php echo $data['info']['curent']['name']; ?></h3>
            <ul>
                <?php
                if ($data['list']['curent']) {
                    foreach ($data['list']['curent'] as $key => $value2) {
                        ?>
                        <li class="page_item ">
                            <a href="#<?php echo $value2['id_news']; ?>"><?php echo $value2['title']; ?></a>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>

        <div id="popular_posts-3" class="widget widget_popular_posts">
            <?php showBlock('product'); ?>
        </div>

        <div id="popular_posts-3" class="widget widget_popular_posts">
            <?php showBlock('actualites'); ?>
        </div>

        <?php showBlock('newsletter', $data); ?>

    </div>
    <div id="main">
        <div class="main_content">
            <div class="breadcrumb">
                <a href="<?php echo WEBSITE_URL; ?>" class="lnk_home"><?php trans('home'); ?></a>                           
                <span><?php echo $data['info']['curent']['name']; ?></span>
            </div>
            <article class="post" id="post-209">
                <h2 class="entry-title"><?php echo $data['info']['curent']['name']; ?></h2>

                <?php
                if ($data['list']['curent']) {
                    foreach ($data['list']['curent'] as $key => $value) {
                        $string = explode("<hr />", $value['intro']);
                        ?>
                        <!-- start list -->
                        <?php if ($value['code_cate_news'] != 'literature') { ?>
                            <div class="page_list">
                                <?php if ($value['images'] != '') { ?>
                                    <div class="pic_page_list">
                                        <a href="<?php echo WEBSITE_URL; ?>articles/<?php echo $value['code_cate_news'] . '/' . unicode_convert($value['title']) . '-' . $value['newsid']; ?>.html"><img src="<?php echo WEBSITE_URL; ?>/Public/thumb.php?src=<?php echo $value['images']; ?>&w=175" class="bdr_pages_list" /></a>
                                    </div>
                                    <div class="info_page_list">
                                        <a id="<?php echo $value['id_news']; ?>" name="<?php echo $value['id_news']; ?>"></a>
                                        <a href="<?php echo WEBSITE_URL; ?>articles/<?php echo $value['code_cate_news'] . '/' . unicode_convert($value['title']) . '-' . $value['newsid']; ?>.html"><h3><?php echo $value['title']; ?></h3></a>                            
                                        <h4><?php echo $string[0]; ?></h4><?php echo $string[1]; ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="info_page_list" style="width: 100%;">
                                        <a id="<?php echo $value['id_news']; ?>" name="<?php echo $value['id_news']; ?>"></a>
                                        <a href="<?php echo WEBSITE_URL; ?>articles/<?php echo $value['code_cate_news'] . '/' . unicode_convert($value['title']) . '-' . $value['newsid']; ?>.html"><h3><?php echo $value['title']; ?></h3></a>                            
                                        <h4><?php echo $string[0]; ?></h4><?php echo $string[1]; ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- end list -->
                            <div class="clear"></div>
                        <?php } else { ?>
                            <!-- start list -->
                            <div class="page_list page_list_fix">
                                <?php if ($value['images'] != '') { ?>
                                    <div class="pic_page_list">
                                        <!--/Public/thumb.php -->

                                        <a href="#"><img src="<?php echo WEBSITE_URL; ?>Public/thumb.php?src=<?php echo $value['images']; ?>&w=175" class="bdr_pages_list" /></a>

                                    </div>
                                    <div class="info_page_list info_page_list_fix">
                                        <a id="<?php echo $value['id_news']; ?>" name="<?php echo $value['id_news']; ?>"></a>
                                        <a href="#"><h3><?php echo $value['title']; ?></h3></a>                            
                                        <h4><?php echo $string[0]; ?></h4><?php echo $string[1]; ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="info_page_list info_page_list_fix" style="width: 100%;">
                                        <a id="<?php echo $value['id_news']; ?>" name="<?php echo $value['id_news']; ?>"></a>
                                        <a href="#"><h3><?php echo $value['title']; ?></h3></a>                            
                                        <h4><?php echo $string[0]; ?></h4><?php echo $string[1]; ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="entry-content addcl_content">
                                <p><?php echo $value['content']; ?></p>
                            </div>

                            <div class="detail_up_bot">
                                <time datetime="<?php echo $value['dates']; ?>" pubdate class="updated">
                                    <?php echo $value['dates']; ?>
                                </time>

                                <?php
                                $path_parts = pathinfo($value['url']);
                                $a = array('docs', 'doc', 'xls', 'jpg', 'pdf');
                                if (in_array($path_parts['extension'], $a, true)) {
                                    ?>
                                    <span class="pic_fot_detail">
                                        <a href="<?php echo $value['url']; ?>"
                                           title="<?php echo $value['url']; ?>" TARGET="_blank">
                                            <img src="<?php echo WEBSITE_URL; ?>templates/images/<?php echo $path_parts['extension'] ?>.png" /></a>
                                    </span>
                                    <?php
                                } else if ($value['url'] != '') {
                                    ?>
                                    <span class="pic_fot_detail">
                                        <a href="<?php echo $value['url']; ?>" TARGET="_blank"
                                           title="<?php echo $value['url']; ?>">
                                            <img src="<?php echo WEBSITE_URL; ?>templates/images/IE.png" /></a>
                                    </span>
                                <?php } ?>                               
                            </div>
                            <!-- end list -->
                            <div class="clear"></div>
                            <?php
                        }
                    }
                }
                ?>
            </article>
        </div>
    </div>
</div>