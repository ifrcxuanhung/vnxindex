<section class="section resume_section even" id="<?php echo utf8_convert_title($title_default); ?>">

    <div class="section_header resume_section_header">
        <h2 class="section_title resume_section_title">
            <a href="#<?php echo utf8_convert_title($title_default); ?>">
                <span class="icon icon-align-left"></span>
                <span class="section_name"><?php echo $title; ?></span>
            </a>
            <span class="section_icon"></span>
        </h2>
    </div>
    <div class="section_body resume_section_body">
        <div class="list_tabs tab_first wrapper resume_wrapper">
            <?php
                echo $data['article']['current'][0]['description'];
            ?>
            <div class="category_header resume_category_header">
                <table style="width: 100%; margin-top: 35px;">
                    <tr>
                        <td width="30%" style="text-align: left;">
                            <h3 class="category_title"><?php echo $data['trans']->getTranslate('country'); ?></h3>
                        </td>
                        <td width="15%" style="text-align: right;">
                            <h3 class="category_title"><?php echo $data['trans']->getTranslate('gwc_ref'); ?></h3>
                        </td>
                        <td width="15%" style="text-align: right;">
                            <h3 class="category_title"><?php echo $data['trans']->getTranslate('gwc_companies'); ?></h3>
                        </td>
                        <td width="15%" style="text-align: right;">
                            <h3 class="category_title"><?php echo $data['trans']->getTranslate('gwc_executives'); ?></h3>
                        </td>
                        <td width="10%" style="text-align: right;">
                            <h3 class="category_title"><?php echo $data['trans']->getTranslate('gwc_ceo'); ?></h3>
                        </td>
                        <td width="10%" style="text-align: right;">
                            <h3 class="category_title"><?php echo $data['trans']->getTranslate('gwc_women'); ?></h3>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="category_body resume_category_body">
                <?php
                $count = 0;
				$sum_ref = 0;
				$sum_com = 0;
				$sum_exe = 0;
				$sum_ceo = 0;
				$sum_wom = 0;
                
                foreach ($data['progress'] as $key => $value)
                {
					$sum_ref += $value['nb_ref'];
					$sum_com += $value['nb_company'];
					$sum_exe += $value['nb_execu'];
                    $sum_ceo += $value['nb_ceo'];
					$sum_wom += $value['nb_wm_ceo'];
                    
                    $link = BASE_URL . 'country/framer/' . $value['ccountry'];
                    ?>
                    <article class="post resume_post resume_post_1 <?php echo $count == 0 ? 'first' : ''; ?> even">
                        <div class="post_header resume_post_header">
                            <table style="width: 100%;">
                                <tr>
                                    <td width="30%">
                                        <h4 class="post_title" style="color: #4CA5D0;">
                                            <a href="<?php echo $link ?>"><?php echo $value['country'] ?></a>
                                        </h4>
                                    </td>
                                    <td width="15%" style="text-align: right;">
                                        <h4>
                                             <?php echo ($value['nb_ref'] != 0 ) ? number_format($value['nb_ref']) : "" ?>
                                        </h4>
                                    </td>
                                    <td width="15%" style="text-align: right;">
                                        <h4>
                                             <?php echo ($value['nb_company'] != 0 ) ? number_format($value['nb_company']) : "" ?>
                                        </div>
                                    </td>
                                    <td width="15%" style="text-align: right;">
                                        <h4>
                                             <?php echo ($value['nb_execu'] != 0 ) ? number_format($value['nb_execu']) : "" ?>
                                        </h4>
                                    </td>
                                    <td width="10%" style="text-align: right;">
                                        <h4>
                                              <?php echo ($value['nb_ceo'] != 0 ) ? number_format($value['nb_ceo']) : "" ?>
                                        </h4>
                                    </td>
                                    <td width="13%" style="text-align: right;">
                                        <h4>
                                             <?php echo ($value['nb_wm_ceo'] != 0 ) ? number_format($value['nb_wm_ceo']) : "" ?>
                                        </h4>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </article>
                    <?php
                    $count++;
                }
                ?>
            </div>
			<div class="category_header resume_category_header">
                <table style="width: 100%; margin-top: 35px;">
                    <tr>
                        <td width="30%" style="text-align: left;">
                            <h3 class="category_title"><?php echo $data['trans']->getTranslate('Total'); ?></h3>
                        </td>
                        <td width="15%" style="text-align: right;">
                            <h3 class="category_title"><?php  echo number_format($sum_ref) ?></h3>
                        </td>
                        <td width="15%" style="text-align: right;">
                            <h3 class="category_title"><?php echo number_format($sum_com) ?></h3>
                        </td>
                        <td width="15%" style="text-align: right;">
                            <h3 class="category_title"><?php echo number_format($sum_exe) ?></h3>
                        </td>
                        <td width="10%" style="text-align: right;">
                            <h3 class="category_title"><?php echo number_format($sum_ceo) ?></h3>
                        </td>
                        <td width="13%" style="text-align: right;">
                            <h3 class="category_title"><?php echo number_format($sum_wom) ?></h3>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </div>

</section>