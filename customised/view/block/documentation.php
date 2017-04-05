<section class="section portfolio_section odd" id="portfolio">
    <div class="section_header portfolio_section_header">
        <h2 class="section_title portfolio_section_title"><a href="#"><span class="icon icon-briefcase"></span><span class="section_name"><?php echo $data['trans']->getTranslate('documentation'); ?></span></a><span class="section_icon"></span></h2>
    </div>
    <div class="section_body portfolio_section_body">
        <div class="portfolio_wrapper">
            <ul id="portfolio_iso_filters">
                <li><a class="document current" data-filter="*" href="#"><?php echo $data['trans']->getTranslate('all'); ?></a></li>
                <?php
                $list_documentation = $list_documentation['curent'];
                foreach ($list_documentation as $key => $value)
                {
                    echo "<li><a class='document' data-filter='.{$value['category_code']}' href='#'>" . $data['trans']->getTranslate($value['name']) . "</a></li>";
                }
                ?>
            </ul>
            <div class="portfolio_items">
                <?php
                $code = basename($_SERVER['REQUEST_URI']);
                $list_document = $list_document['curent'];
                //print_r($list_document);
                foreach ($list_document as $key => $value)
                {
                    $meta_keyword = $value['meta_keyword'];
                    $arr_code = explode(',', $meta_keyword);
                    //if (strtoupper($value['meta_keyword']) == strtoupper($code) || strtoupper($value['meta_keyword']) == 'ALL')
                    if ((in_array(strtoupper($code), $arr_code) || in_array(strtoupper('ALL'), $arr_code)) && ($arr_code[0] != ""))
                    {
                        /*
                        $image = $value['image'];
                        $image = str_replace('assets/upload/images/', '', $image);
                        $image = '355_250_' . $image;
                        $image = PARENT_URL . 'assets/upload/images/thumb/' . $image;
                        */
                        $image = PARENT_URL . $value['image'];

                        if (substr($image, strlen($image) - 12, 12) == "no-image.jpg")
                            $image = TEMPLATE_URL . 'images/no-image-large.jpg';

                        if (substr($value['file'], 0, 4) == 'http')
                            $link_file = $value['file'];
                        else
                            $link_file = PARENT_URL . $value['file'];
                        ?>
                        <article class="post portfolio_post portfolio_post_1 first even <?php echo $value['category_code'] ?>">
                            <div class="post_pic portfolio_post_pic"> <a class="w_hover img-link img-wrap" target='_blank' href="<?php echo $link_file ?>"> <span class="overlay"></span> <span class="link-icon"></span> <img src="<?php echo $image ?>" alt="<?php echo $value['title'] ?>" /> </a> </div>
                            <h4 class="post_title"><a href="portfolio.html"><?php echo $value['title'] ?></a></h4>
                            <h5 class="post_subtitle"><?php echo $value['catename'] ?></h5>
                        </article>
                        <?php
                    }
                }
                ?>
            </div>
            <div class="portfolio_iso_pages">
                <ul id="portfolio_iso_pages">
                </ul>
                <div id="portfolio_iso_pages_2"> <?php echo $data['trans']->getTranslate('page'); ?> <span id="portfolio_iso_pages_current">1</span> <?php echo $data['trans']->getTranslate('of'); ?> <span id="portfolio_iso_pages_total"></span> </div>
            </div>
        </div>
    </div>
    <!-- .section_body --> 
</section>