<section class="section portfolio_section odd" id="<?php echo $title_default; ?>">
    <div class="section_header portfolio_section_header">
        <h2 class="section_title portfolio_section_title">
            <a href="#<?php echo $title_default; ?>">
                <span class="icon icon-briefcase"></span>
                <span class="section_name"><?php echo $title; ?></span>
            </a>
            <span class="section_icon"></span>
        </h2>
    </div>
    <div class="section_body portfolio_section_body">
        <div class="portfolio_wrapper">
            <ul id="portfolio_iso_filters">
                <li><a class="document current" data-filter="*" href="#"><?php echo $data['trans']->getTranslate('all'); ?></a></li>
                <?php
				
                $list_documentation = $list_documentation['current'];
			
                foreach ($list_documentation as $key => $value)
                {
                    echo "<li><a class='document' data-filter='.{$value['clean_scat']}' href='#'>" . $data['trans']->getTranslate($value['clean_scat']) . "</a></li>";
                }
                ?>
            </ul>
            
            <div class="portfolio_items">
                <?php
                $code = basename($_SERVER['REQUEST_URI']);
				//globalwomenceo
								//VNXWMPRVND,VNXWM10PRVND,VNXWM25PRVND,GWCASNEWPRUSD,GWCTHAEWPRUSD,GWCSGPEWPRUSD,GWCPHLEWPRUSD,GWCMYSEWPRUSD,GWCVNMEWPRUSD
								//echo "<pre>";print_r($list_document);
                foreach ($list_document['current'] as $key => $value)
                {
						
                    $meta_keyword = 'document';
					
                    $arr_code = explode(',', $meta_keyword);
					
                    if ($code != '')
                    {
						
                       /* if ((in_array(strtoupper($code), $arr_code) || in_array(strtoupper('LOGISTIC'), $arr_code)) && $arr_code[0] != "")
                        {*/
							
							
                            $image = PARENT_URL . $value['images'];

                            if (substr($image, strlen($image) - 12, 12) == 'no-image.jpg')
                            {
                                $image = TEMPLATE_URL . 'images/no-image-large.jpg';
                            }
                            if (substr($value['file'], 0, 4) == 'http')
                            {
                                $link_file = $value['file'];
                            }
                            else
                            {
                                $link_file = PARENT_URL . $value['file'];
                            }
                            ?>
                            <article class="post portfolio_post portfolio_post_1 first even <?php echo $value['clean_scat'] ?>">
                                <div class="post_pic portfolio_post_pic"> <a class="w_hover img-link img-wrap" target='_blank' href="<?php echo $link_file ?>"> <span class="overlay"></span> <span class="link-icon"></span> <img src="<?php echo $image ?>" alt="<?php echo $value['title'] ?>" /> </a> </div>
                                <h4 class="post_title"><a href="portfolio.html"><?php echo $value['title'] ?></a></h4>
                                <h5 class="post_subtitle"><?php echo $value['clean_scat'] ?></h5>
                            </article>
                            <?php
                        //}
                    }
                    else
                    {
                        if ($arr_code[0] != '')
                        {

                            $image = PARENT_URL . $value['images'];

                            if (substr($image, strlen($image) - 12, 12) == 'no-image.jpg')
                            {
                                $image = TEMPLATE_URL . 'images/no-image-large.jpg';
                            }
                            if (substr($value['file'], 0, 4) == 'http')
                            {
                                $link_file = $value['file'];
                            }
                            else
                            {
                                $link_file = PARENT_URL . $value['file'];
                            }
                            ?>
                            <article class="post portfolio_post portfolio_post_1 first even <?php echo $value['clean_scat'] ?>">
                                <div class="post_pic portfolio_post_pic"> <a class="w_hover img-link img-wrap" target='_blank' href="<?php echo $link_file ?>"> <span class="overlay"></span> <span class="link-icon"></span> <img src="<?php echo $image ?>" alt="<?php echo $value['title'] ?>" /> </a> </div>
                                <h4 class="post_title"><a href="portfolio.html"><?php echo $value['title'] ?></a></h4>
                                <h5 class="post_subtitle"><?php echo $value['clean_scat'] ?></h5>
                            </article>
                            <?php
                        }
                    }
                }
                ?>
            </div>
            <div class="portfolio_iso_pages">
                <ul id="portfolio_iso_pages" style="float:right;">
                </ul>
                <!--div id="portfolio_iso_pages_2"> <?php echo $data['trans']->getTranslate('page'); ?> <span id="portfolio_iso_pages_current">1</span> <?php echo $data['trans']->getTranslate('of'); ?> <span id="portfolio_iso_pages_total"></span> </div-->
            </div>
        </div>
    </div>
    <!-- .section_body --> 
</section>