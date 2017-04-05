<section id="listindexes_section" class="section resume_section even">
    <div class="section_header resume_section_header">
        <h2 class="section_title resume_section_title">
            <a href="#">
                <span class="icon icon-align-left"></span>
                <span class="section_name"><?php echo $data['trans']->getTranslate('Sector breakdown'); ?></span>
            </a>
            <span class="section_icon"></span>
        </h2>
    </div>
    <div class="section_body resume_section_body">
        <div class="list_tabs page_1 tab_first wrapper resume_wrapper">
            <div class="category resume_category first even">
                <div class="category_header resume_category_header">
                   <table style="width: 100%;">
                        <tbody>
                            <tr>
                                <td width="10%" style="text-align: center;">
                                    <h3 class="category_title"><?php echo $data['trans']->getTranslate('nr'); ?></h3>
                                </td>
                                <td width="15%">
                                    <h3 class="category_title"><?php echo $data['trans']->getTranslate('ticker'); ?></h3>
                                </td>
                                <td style="text-align: left;">
                                    <h3 class="category_title"><?php echo $data['trans']->getTranslate('name'); ?></h3>
                                </td>
                                <td  width="12.5%" style="text-align: right;">
                                    <h3 class="category_title"><?php echo $data['trans']->getTranslate('perf'); ?></h3>
                                </td>
                                <td  width="12.5%" style="text-align: right;">
                                    <h3 class="category_title"><?php echo $data['trans']->getTranslate('weight'); ?></h3>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="category_body resume_category_body">
                    <?php
                        foreach($sector_daily as $sector)
                        {
                    ?>
                    <div class="category_header resume_category_header">
                        <h3 class="category_title title">
                            <span class="category_title_icon aqua"></span><?php echo $sector['sec_name'] ?> (<?php echo count($results[$sector['sector']]) ?>)
                            <span style="float:right; color:#FFF"><?php echo number_format($sector['weight'],2)?> %</span>
                        </h3>
                    </div>
                    <?php
                        $i = 1;
                        foreach($results[$sector['sector']] as $value)
                        {
                            $link = BASE_URL . 'company/code/' . $value['ISIN'];
                    ?>                         
                    <article class="post resume_post resume_post_1  even">
                        <div class="post_header resume_post_header">
                            <table style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td width="10%" style="text-align: center;">
                                            <h4>
                                                <?php echo $i++; ?>
                                            </h4>
                                        </td>
                                        <td width="15%">
                                            <h4 class="post_title">
                                                <a href="<?php echo $link ?>"><?php echo $value['ISIN'] ?></a>
                                            </h4>
                                        </td>
                                        <td>
                                            <h4>
                                                <font style="color: #FFF"><?php echo $value['name'] ?></font>
                                            </h4>
                                        </td>
                                        <td width="12.5%" style="text-align: right;">
                                            <h4>
                                                <font style="color: <?php echo $value['perf'] < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo number_format($value['perf'], 2, '.', ','); ?> %</font>
                                            </h4>
                                        </td>
                                        <td width="12.5%" style="text-align: right;">
                                            <h4>
                                                <?php echo number_format($value['WEIGHT'],2); ?> %
                                            </h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </article>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>