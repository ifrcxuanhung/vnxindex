<section  class="section resume_section even" id="research_publications">
    <div class="section_header resume_section_header">
        <h2 class="section_title resume_section_title">
            <a href="#">
                <span class="icon icon-align-left"></span>
                <span class="section_name"><?php echo $title; ?></span>
            </a>
            <span class="section_icon"></span>
        </h2>
    </div>
    <div class="section_body resume_section_body research_publications">
        <div id="download-with-confirm">
		<div class="content_research_publications">
            <?php
            foreach ($data['publications'] as $value)
            {
                ?>
                <article style="margin-bottom: 15px; padding-top: 15px; position: relative; min-height:60px" class="post resume_post resume_post_1 first">
                    <div class="post_header resume_post_header">
                        <div class="resume_period"> <span class="period_from"><?php echo $value['year'] ?></span> </div>                
                        <h4 style="padding-left: 20px; width: 90%;" class="post_title"><span class="post_title_icon aqua"></span><a href="javascript:void(0)"><?php echo $value['title'] ?></a></h4>
                        <h5 class="post_subtitle"><?php echo $value['authors'] ?></h5>              
                    </div>
                    <div style="width: 93%; text-align: justify;" class="post_body resume_post_body">
                        <p style="padding-left:23px"><?php echo $value['journal'] ?><?php echo $value['reference'] != "" ? ', ' . $value['reference'] : "" ?></p>               
                        <?php
                        if (trim($value['file']) != "")
                        {
                            $link = PARENT_URL . $data['trans']->getTranslate(CODE_CATE . '_download_path') . $value['file'];
                            ?>
                            <div class="download_file">
                                <a href="<?php echo $link ?>" target="_blank"><img title="<?php echo $value['title'] ?>" alt="Download" src="<?php echo BASE_URL ?>/template/images/pdf.png"/></a>
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
			if($total > 0)
			{
				
		?>
			<input type="hidden" name="query" value="<?php echo $meta_keyword ?>" />
			<ul class="page" id="portfolio_iso_filters">
			<?php
				for($i = 1; $i <= $total; $i++)
				{
					$current = ($i == 1) ? "class='current'" : "";
					echo '<li><a href="javascript:void(0)" '.$current.'>'.$i.'</a></li>';
				}
			?>
			</ul>
		<?php
			}
		?>
    </div>
</section>