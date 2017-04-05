<section id="resume" class="section resume_section even">

    <div class="section_header resume_section_header">
		<input type="text" id="search-index" name="search-index" placeholder="<?php echo $data['trans']->getTranslate('quick_search'); ?>" style="position: absolute; width: 30%; margin-top: 13px; z-index: 99; display: none; font-size: 14px; text-transform: uppercase;" />
        <h2 class="section_title portfolio_section_title">

            <a href="#">

                <span class="icon icon-align-left"></span>

                <span class="section_name"><?php echo isset($article['current']['0']['title']) ? $article['current']['0']['title'] : $data['trans']->getTranslate('our_website'); ?></span>

            </a>

            <span class="section_icon"></span>

        </h2>

    </div>

    <div class="section_body resume_section_body" style="display: none;">

        <div id="description"></div>

        <div style="clear: both; padding-top: 10px;" id="long_description">



            <ul class="our_website">

            <?php

                if(isset($data['article']))

                {

                    foreach($data['article'] as $art)

                    {

             ?>

                    <li>

                        <a class="img_ow" href="<?php echo $art['url'] ?>"><img src="<?php echo PARENT_URL . $art['image'] ?>" alt="<?php echo $art['title'] ?>" title="<?php echo $art['title'] ?>" /></a>

                        <h3 class="title_ow"><?php echo $art['title'] ?></h3>

                        <div class="des_ow"><?php echo $art['description'] ?></div>

                        <a class="link_ow" target="_blank" href="<?php echo $art['url'] ?>"><?php echo $art['url1'] ?></a>

                    </li>

             <?php  

                    }

                }

            ?>

            	

            </ul>

        </div>    

    </div>

</section>