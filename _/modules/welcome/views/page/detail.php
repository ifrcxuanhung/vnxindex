<?php showBlock('slide_top'); ?>
<div id="content" role="main" class="right-sidebar">
    <div id="sidebar">
        <div id="popular_posts-3" class="widget widget_popular_posts">
            <h3><?php echo $data['info']['curent']['name']; ?></h3>
            <ul>
                <?php
                if ($data['list']['curent']) {
                    foreach ($data['list']['curent'] as $k => $v1) {
                        ?>
                        <li>
                            <a href="<?php echo WEBSITE_URL; ?>articles/<?php echo $v1['code_cate_news']; ?>.html#<?php echo $v1['id_news']; ?>" title="<?php echo $v1['title']; ?>"><?php echo $v1['title']; ?></a>
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

        <?php
        showBlock('newsletter', $data);
        ?>
    </div>
    <div id="main">
        <div class="main_content">
            <div class="breadcrumb">
                <a href="<?php echo WEBSITE_URL; ?>" class="lnk_home"><?php echo $data['mtran']->get_translates('Home'); ?></a>                           
                <a title="" href="<?php echo WEBSITE_URL; ?>articles/<?php echo $data['article']['curent']['code_cate_news']; ?>.html"><?php echo $data['articles']['curent']['catename']; ?></a>
                <span><?php echo $data['article']['curent']['title']; ?></span>
            </div>

            <article class="post-1 post type-post status-publish format-standard hentry category-blog-category category-posts-with-image tag-blog tag-hello"
                     id="post-1">

                <div class="header-styled">
                    <h2><?php echo $data['article']['curent']['title']; ?></h2>
                </div>

                <div class="page_list">
                    <?php if ($data['article']['curent']['images'] != '') { ?>
                        <div class="pic_page_list">            
                            <img src="<?php echo WEBSITE_URL; ?>Public/thump.php?src=<?php echo $data['article']['curent']['images']; ?>&w=175" class="bdr_pages_list featured" />
                            <div class="actions">
                                <a class="view photo" title="<?php echo $data['article']['curent']['title']; ?>" href="<?php echo $data['article']['curent']['images']; ?>"
                                   data-rel="prettyPhoto"><?php trans('view'); ?></a>
                                <a href="#" class="share"><?php trans('share'); ?></a>
                                <div class="share_wrapper">
                                    <div class="share_icons">
                                        <a target="_blank" href="http://facebook.com"><img src="<?php echo $template_url; ?>images/icon-facebook.png" alt="Facebook" /></a>
                                        <a target="_blank" href="http://plus.google.com"><img src="<?php echo $template_url; ?>images/icon-googleplus.png" alt="Google Plus" /></a>
                                        <a target="_blank" href="http://www.twitter.com"><img src="<?php echo $template_url; ?>images/icon-twitter.png" alt="Twitter" /></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="info_page_list">
                            <?php
                            $string = explode("<hr />", $data['article']['curent']['intro']);
                            ?>
                            <h4><?php echo $string[0]; ?></h4><?php echo $string[1]; ?>

                        </div>
                    <?php } else { ?>
                        <div class="info_page_list" style="width: 100%;">
                            <?php
                            $string = explode("<hr />", $data['article']['curent']['intro']);
                            ?>
                            <h4><?php echo $string[0]; ?></h4><?php echo $string[1]; ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="entry-content addcl_content">
                    <p><?php echo $data['article']['curent']['content']; ?></p>
                </div>
                <div class="detail_up_bot">
                    <time datetime="<?php echo $data['article']['curent']['dates']; ?>" pubdate class="updated">
                        <?php echo $data['article']['curent']['dates']; ?>
                    </time>

                    <?php
                    $path_parts = pathinfo($data['article']['curent']['url']);
                    $a = array('docs', 'doc', 'xls', 'jpg', 'pdf');
                    if (in_array($path_parts['extension'], $a, true)) {
                        ?>
                        <span class="pic_fot_detail">
                            <a href="<?php echo $data['article']['curent']['url']; ?>"
                               title="<?php echo $data['article']['curent']['url']; ?>" TARGET="_blank">
                                <img src="<?php echo WEBSITE_URL; ?>templates/images/<?php echo $path_parts['extension'] ?>.png" /></a>
                        </span>
                        <?php
                    } else if ($data['article']['curent']['url'] != '') {
                        ?>
                        <span class="pic_fot_detail">
                            <a href="<?php echo $data['article']['curent']['url']; ?>" TARGET="_blank"
                               title="<?php echo $data['article']['curent']['url']; ?>">
                                <img src="<?php echo WEBSITE_URL; ?>templates/images/IE.png" /></a>
                        </span>
                    <?php } ?>
                </div>

                <div class="clear"></div>
            </article>                 

            <div class="clear"></div>
        </div>
    </div>
</div>