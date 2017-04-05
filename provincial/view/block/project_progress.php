<section class="section resume_section even" id="resume">

    <div class="section_header resume_section_header">
        <h2 class="section_title resume_section_title">
            <a href="#">
                <span class="icon icon-align-left"></span>
                <span class="section_name"><?php echo $title; ?></span>
            </a>
            <span class="section_icon"></span>
        </h2>
    </div>
    <div class="section_body resume_section_body">
        <div class="list_tabs tab_first wrapper resume_wrapper">
            <div class="category_header resume_category_header">
                <table style="width: 100%; margin-top: 35px;">
                    <tr>
                        <td width="28%" style="text-align: left;">
                            <h3 class="category_title"><?php echo $data['trans']->getTranslate('country'); ?></h3>
                        </td>
                        <td width="18%" style="text-align: right;">
                            <h3 class="category_title"><?php echo $data['trans']->getTranslate('reference'); ?></h3>
                        </td>
                        <td width="16%" style="text-align: right;">
                            <h3 class="category_title"><?php echo $data['trans']->getTranslate('companies'); ?></h3>
                        </td>
                        <td width="18%" style="text-align: right;">
                            <h3 class="category_title"><?php echo $data['trans']->getTranslate('executices'); ?></h3>
                        </td>
                        <td width="20%" style="text-align: right;">
                            <h3 class="category_title"><?php echo $data['trans']->getTranslate('women ceo'); ?></h3>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="category_body resume_category_body">
                <?php
                $count = 0;
                foreach ($data['progress'] as $key => $value)
                {
                    ?>
                    <article class="post resume_post resume_post_1 <?php echo $count == 0 ? 'first' : ''; ?> even">
                        <div class="post_header resume_post_header">
                            <table style="width: 100%;">
                                <tr>
                                    <td width="28%">
                                        <h4 class="post_title" style="color: #4CA5D0;">
                                            <?php echo $value['country'] ?>
                                        </h4>
                                    </td>
                                    <td width="18%" style="text-align: right;">
                                        <div class="resume_period" style="color: #FFFFFF;">
                                             <?php echo number_format($value['nb_ref']) ?>
                                        </div>
                                    </td>
                                    <td width="16%" style="text-align: right;">
                                        <div class="resume_period" style="color: #FFFFFF;">
                                             <?php echo number_format($value['nb_company']) ?>
                                        </div>
                                    </td>
                                    <td width="18%" style="text-align: right;">
                                        <div class="resume_period" style="color: #FFFFFF;">
                                             <?php echo number_format($value['nb_execu']) ?>
                                        </div>
                                    </td>
                                    <td width="20%" style="text-align: right;">
                                        <div class="resume_period" style="color: #FFFFFF;">
                                             <?php echo number_format($value['nb_wm_ceo']) ?>
                                        </div>
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

        </div>

    </div>

</section>