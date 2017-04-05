<section  class="section resume_section even" id="<?php echo $category ?>">
    <div class="section_header resume_section_header" style="position: relative;">
        <input type="text" id="search-<?php echo $category ?>" name="search-<?php echo $category ?>" category="<?php echo $category ?>" meta="<?php echo $meta_keyword ?>" class="quick-search-input" placeholder="<?php echo $data['trans']->getTranslate(CODE_CATE . '_quick_search'); ?>" />
        <button class="btn-closep" id="btn-<?php echo $category ?>" name="btn-<?php echo $category ?>" style="position:absolute; right:60px;top:14px;z-index:100; height:37px;background:transparent; font-weight: 300; color:#c4c4c4; display:none" category="<?php echo $category ?>">X</button>
        <h2 class="section_title resume_section_title">
            <a href="#<?php echo $meta_description ?>">
                <span class="icon icon-align-left"></span>
                <span class="section_name"><?php echo $title; ?></span>
            </a>
            <span class="section_icon"></span>
        </h2>
    </div>
    <div class="section_body resume_section_body research_publications">
        <?php
        $id = "download-with-confirm" ;
        ?>
        <div id="<?php echo $id ?>">
            <div class="content_<?php echo $category ?>">
                <?php
                foreach ($data['publications'] as $value) {
                    ?>
                    <article style="margin-bottom: 15px; padding-top: 15px; position: relative; min-height:60px" class="post resume_post resume_post_1 first">
                        <div class="post_header resume_post_header">
                            <div class="resume_period"> <span class="period_from"><?php echo $value['year'] ?></span> </div>                
                            <h4 style="padding-left: 20px; width: 90%;" class="post_title">
                                <span class="post_title_icon aqua"></span>
                                <?php
                                $file = "";
                                if (trim($value['file']) != "") {
                                    if (substr($value['file'], 0, 4) == "http") {
                                        $file = $value['file'];
                                    } else {
                                        $file = PARENT_URL . $value['file'];
                                    }
                                }else{
                                    if (substr($value['link'], 0, 4) == "http") {
                                        $link = $value['link'];
                                    } else {
                                        $link = PARENT_URL . $value['link'];
                                    }
                                }
                                $authors = (isset($value['author1'])&&$value['author1']!='' ? $value['author1'] : '').(isset($value['author2'])&&$value['author2']!='' ? ' - '.$value['author2'] : '').(isset($value['author3'])&&$value['author3']!='' ? ' - '.$value['author3'] : '').(isset($value['author4'])&&$value['author4']!='' ? ' - '.$value['author4'] : '');
                                ?>
                                <a href="<?php echo trim($value['file']) != "" ? $file : $link ?>" class="<?php echo 'disabled' ?>" target="_blank"><?php echo $value['title'] ?></a>
                            </h4>
                            <h5 class="post_subtitle"><?php echo isset($authors) ? $authors : '' ?></h5>              
                        </div>
                        <div style="width: 93%;" class="post_body resume_post_body">
                            <p style="padding-left:23px; font-weight: bold;">
                                <?php echo $value['journal'] ?>
                               <?php //echo $value['reference'] != "" ? ', ' . $value['reference'] : "" ?>
                            </p>
                            <?php echo $value['description'] != "" ? "<p style='padding-left:23px; padding-top: 5px;'>{$value['description']}</p>" : "" ?>
                            <?php
                            if (trim($value['file']) != "") {
                                if (substr($value['file'], 0, 4) == "http") {
                                    $file = $value['file'];
                                    $img = BASE_URL . '/template/images/link.png';
                                } else {
                                    $file = PARENT_URL . $value['file'];
                                    $img = BASE_URL . '/template/images/pdf.png';
                                }
                                ?>
                                <div class="download_file">
                                    <a href="<?php echo $file ?>" target="_blank"><img style="<?php echo ($file==''||$file==PARENT_URL? 'display:none' : '' ) ?>" title="<?php echo $value['title'] ?>" alt="Download" src="<?php echo $img; ?>"/></a>
                                </div>
                                <?php
                            }else {
                                if (substr($value['link'], 0, 4) == "http") {
                                    $link = $value['link'];
                                    $img = BASE_URL . '/template/images/link.png';
                                } else {
                                    $link = PARENT_URL . $value['link'];
                                    $img = BASE_URL . '/template/images/pdf.png';
                                }
                                ?>
                                <div class="download_file">
                                    <a href="<?php echo $link ?>" target="_blank"><img style="<?php echo ($link==''||$link==PARENT_URL? 'display:none' : '' ) ?>" title="<?php echo $value['title'] ?>" alt="Download" src="<?php echo $img; ?>"/></a>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </article>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
        if ($total > 1) {
            ?>
            <input type="hidden" name="query" value="<?php echo $meta_keyword ?>" />
            <ul description = "<?php echo $meta_description ?>" class="page page_<?php echo $category ?>" id="portfolio_iso_filters">
                <?php
                for ($i = 1; $i <= $total; $i++) {
                    $current = ($i == 1) ? "class='current'" : "";
                    echo '<li><a href="javascript:void(0)" ' . $current . '>' . $i . '</a></li>';
                }
                ?>
            </ul>
            <?php
        }
        ?>
    </div>
</section>
