<div id="content" role="main" class="right-sidebar">
    <div id="sidebar">
        <div id="subnav-3" class="widget widget_subnav pd_fix">
            <h3><?= $page['current']['name']; ?></h3>
            <ul>
                <?php
                if ($data['current']) {
                    foreach ($data['current'] as $key => $value2) {
                        ?>
                        <li class="page_item ">
                            <a href="#<?php echo $value2['article_id']; ?>"><?php echo $value2['title']; ?></a>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>

        <div id="popular_posts-3" class="widget widget_popular_posts">
            <?php echo $actualites; ?>
        </div>

        <?php echo $newsletter; ?>

    </div>
    <div id="main">
        <div class="main_content">
            <div class="breadcrumb">
                <a href="<?php echo base_url(); ?>" class="lnk_home"><?php trans('home'); ?></a>                           
                <span><?php echo $page['current']['name']; ?></span>
            </div>
            <article class="post" id="post-209">
                <h2 class="entry-title"><?php echo $page['current']['title']; ?></h2>
                <?php
                if (is_array($data['current'])) {
                    foreach ($data['current'] as $key => $value) {
                        $string = explode("<hr />", $value['description']);
                        ?>
                        <?php if (@$value['code_cate_news'] != 'literature') { ?>
                            <!-- start list -->
                            <div class="page_list">
                                <?php if ($value['image'] != '' && $value['image'] != "assets/images/no-image.jpg") { ?>
                                    <div class="pic_page_list">
                                        <a href="<?php echo base_url(); ?>article/index/<?php echo $value['category_code'] . '/' . strtolower(utf8_convert_url($value['title'])) .'.html'; ?>"><img src="<?php echo image_thumb($value['image'], "auto", 175); ?>" class="bdr_pages_list" /></a>
                                    </div>
                                    <div class="info_page_list">
                                        <a id="<?php echo $value['article_id']; ?>" name="<?php echo $value['article_id']; ?>"></a>
                                        <a href="<?php echo base_url(); ?>article/index/<?php echo $value['category_code'] . '/' . strtolower(utf8_convert_url($value['title'])) .'.html'; ?>"><h3><?php echo $value['title']; ?></h3></a>                            
                                        <h4><?php echo $string[0]; ?></h4><?php echo @$string[1]; ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="info_page_list" style="width: 100%;">
                                        <a id="<?php echo $value['article_id']; ?>" name="<?php echo $value['article_id']; ?>"></a>
                                        <a href="<?php echo base_url(); ?>article/index/<?php echo $value['category_code'] . '/' . strtolower(utf8_convert_url($value['title'])) .'.html'; ?>"><h3><?php echo $value['title']; ?></h3></a>                            
                                        <h4><?php echo $string[0]; ?></h4><?php echo @$string[1]; ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- end list -->
                            <div class="clear"></div>
                            <?php
                        } else {
                            ?>
                            <!-- start list -->
                            <div class="page_list page_list_fix">
                                <?php if (is_file($value['image']) && $value['image'] != "assets/images/no-image.jpg") { ?>
                                    <div class="pic_page_list">
                                        <a href="#"><img src="<?php echo image_thumb($value['image'], "auto", 175); ?>" class="bdr_pages_list" /></a>
                                    </div>
                                    <div class="info_page_list info_page_list_fix">
                                        <a id="<?php echo $value['article_id']; ?>" name="<?php echo $value['article_id']; ?>"></a>
                                        <a href="#"><h3><?php echo $value['title']; ?></h3></a>                            
                                        <h4><?php echo $string[0]; ?></h4><?php echo $string[1]; ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="info_page_list info_page_list_fix" style="width: 100%;">
                                        <a id="<?php echo $value['article_id']; ?>" name="<?php echo $value['article_id']; ?>"></a>
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
                                $path_parts = pathinfo(@$value['url']);
                                $a = array('docs', 'doc', 'xls', 'jpg', 'pdf');
                                if(!empty($path_parts) && isset($path_parts['extension'])){
                                    if (in_array($path_parts['extension'], $a, true)) {
                                        ?>
                                        <span class="pic_fot_detail">
                                            <a href="<?php echo $value['url']; ?>"
                                               title="<?php echo $value['url']; ?>" TARGET="_blank">
                                                <img src="<?php echo base_url(); ?>assets/templates/welcome/images/<?php echo $path_parts['extension'] ?>.png" /></a>
                                        </span>
                                        <?php
                                    } else if ($value['url'] != '') {
                                        ?>
                                        <span class="pic_fot_detail">
                                            <a href="<?php echo $value['url']; ?>" TARGET="_blank"
                                               title="<?php echo $value['url']; ?>">
                                                <img src="<?php echo base_url(); ?>assets/templates/welcome/images/IE.png" /></a>
                                        </span>
                                <?php 
                                    }
                                }
                                ?>                              
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