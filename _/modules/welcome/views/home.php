
<div id="main">
    <!-- start company introduction  -->
    <div class="intro_copn intro_home">
        <script>
            $(document).ready(function(){
                $('.view_brochure_art li img.thumbnails').click(function(){
                    $link = $(this).parent().attr('href');
                    window.open($link,'_blank');
                    return false;
                });
            });
        </script>
        <?php echo $detail_intro_copn; ?>
        <div class="clear"></div>
        <!--
<div class="bg_bt_ifrc_vnfdb"><a href="<?= base_url() ?>backend/vnfdb_demo" target="_blank">Demo</a></div>
<div class="tab_show_idx">
        <?php echo $idx_home; ?>
</div>
        -->
    </div>
    <div class='intro_copn'>
        <!-- INDEX -->
        <?php
        $this->load->view('box_International_Indexes', $data);
        ?>
        <!-- ./INDEX -->
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div class="main_content">
        <article class="post" id="post-246">
            <div class="entry">
                <section class="portfolios">
                    <script type="text/javascript">
                        $(function() {
                            $('.slides_763').slides({
                                generateNextPrev: true,
                                play: 5000,
                                preloadImage: 'images/loading.gif'
                            });
                        });
                    </script>
                    <h3 class="slides_title"><?php trans('nos_services___produits'); ?></h3>
                    <div class="slides_wrapper slides_763" >
                        <div class="slides_container portfolio_shortcode one_third">                                                            
                            <div style="width:100%">   
                                                              
                                <?php echo $service_product; ?>
                                <div class="clear"></div>
                            </div>                                 
                        </div>
                        <div class="clear"></div>        
                    </div>
                    <div class="clear"></div>
                </section>
            </div>
        </article>
    </div>
    <div class="clear"></div>

</div>


<div id="sidebar">    
    <div id="popular_posts-3" class="widget widget_popular_posts">
        <?php echo $compare_chart; ?>
    </div>
    <div id="popular_posts-3" class="widget widget_popular_posts">
        <?php echo $actualites; ?>
    </div>
    <!-- start slider partners and sponsors -->
    <?php
        if($partner_right != ''){
    ?>
        <div id="portfolio-2" class="widget widget_portfolio">
            <?php echo $partner_right; ?>
        </div>
    <?php
        }
    ?>
    <!-- end slider partners and sponsors -->
    <div>
        <?php echo $newsletter; ?>
    </div>    
</div>