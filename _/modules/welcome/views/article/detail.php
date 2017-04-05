<div id="content" role="main" class="right-sidebar">
    <div id="sidebar">
    
    
    
        <div id="popular_posts-3" class="widget widget_popular_posts">
            <?php echo $actualites; ?>
        </div> 

        <?php
        echo $newsletter;
        ?>                   
    </div>
    <div id="main">
        <div class="main_content">
            <div class="breadcrumb">
                <a href="<?php echo base_url(); ?>" class="lnk_home"><?php trans('Home'); ?></a>                    
                <a title="" href="<?php echo base_url(); ?>page/index/<?php echo $page['current']['code']; ?>.html"><?php echo @$page['current']['name']; ?></a>
                <span><?php echo @$data['current']['title']; ?></span>
            </div>

            <article class="post-1 post type-post status-publish format-standard hentry category-blog-category category-posts-with-image tag-blog tag-hello"
                     id="post-1">

                <div class="header-styled">
                    <h2><?php echo $data['current']['title']; ?></h2>
                </div>

                <div class="page_list">
                    <?php if (is_file($data['current']['image']) && $data['current']['image'] != "assets/images/no-image.jpg") { ?>
                        <div class="pic_page_list">
                            <img src="<?php echo image_thumb($data['current']['image'], 200, 175,0); ?>" class="bdr_pages_list featured" />     
                            <div class="actions">
                                <a class="view photo" title="<?php echo $data['current']['title']; ?>" href="<?php echo base_url() . $data['current']['image']; ?>"
                                   data-rel="prettyPhoto"><?php trans('view');?></a>
                                <a href="#" class="share"><?php trans('share');?></a>
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
                            $data['current']['description'] = str_replace('/assets/upload/images/pdf','/pdf',$data['current']['description']);
                            $string = explode("<hr />", $data['current']['description']);
                            ?>
                            <h4><?php echo str_replace(array('<p>', '</p>'), '', $string[0]); ?></h4><?php echo @$string[1]; ?>

                        </div>
                    <?php } else { ?>
                        <div class="info_page_list" style="width: 100%;">
                            <?php
                            $data['current']['description'] = str_replace('/assets/upload/images/pdf','/pdf',$data['current']['description']);
                            $string = explode("<hr />", $data['current']['description']);
                            ?>
                            <h4><?php echo $string[0]; ?></h4><?php echo @$string[1]; ?>
                        </div>
                    <?php } ?>
                </div>
                
                    <?php 
                        
                        if($cate_id == 101 || $cate_id == "index")
                        {
                            echo "<div class='compare-chart'>".$compare_chart."</div>";
                        }
                        
                    ?>
                
                <div class="entry-content addcl_content">
                    <p><?php echo $data['current']['long_description']; ?></p>
                </div>
                <div class="detail_up_bot">
                    <time datetime="<?php echo $data['current']['date_modified']; ?>" pubdate class="updated">
                        <?php echo $data['current']['date_modified']; ?>
                    </time>

                    <?php
                    $path_parts = pathinfo(@$data['current']['url']);
                    $a = array('docs', 'doc', 'xls', 'jpg', 'pdf');
                    if (!empty($path_parts) && isset($path_parts['extension'])) {
                        if (in_array($path_parts['extension'], $a, true)) {
                            ?>
                            <span class="pic_fot_detail">
                                <a href="<?php echo $data['current']['url']; ?>"
                                   title="<?php echo $data['current']['url']; ?>" TARGET="_blank">
                                    <img src="<?php echo base_url(); ?>assets/templates/welcome/images/<?php echo $path_parts['extension'] ?>.png" /></a>
                            </span>
                            <?php
                        } else if ($data['current']['url'] != '') {
                            ?>
                            <span class="pic_fot_detail">
                                <a href="<?php echo $data['current']['url']; ?>" TARGET="_blank"
                                   title="<?php echo $data['current']['url']; ?>">
                                    <img src="<?php echo base_url(); ?>assets/templates/welcome/images/IE.png" /></a>
                            </span>
                            <?php
                        }
                    }
                    ?>                               
                </div>                           
                <div class="clear"></div>
            </article>                                        
            <div class="clear"></div>
        </div>
    </div>
</div>