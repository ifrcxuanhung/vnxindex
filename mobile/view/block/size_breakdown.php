<section class="section resume_section odd" id="size_breakdown">
    <div class="section_header resume_section_header">
        <h2 class="section_title resume_section_title">
            <a href="#size_breakdown">
                <span class="icon icon-align-left"></span>
                <span class="section_name"><?php echo $data['trans']->getTranslate('Size breakdown'); ?></span>
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
                    foreach($data['size_breakdown'] as $key => $value) {
                        $sum_weight = 0;
                        foreach($value as $w) {
                            $sum_weight += is_numeric($w['WEIGHT']) ? $w['WEIGHT'] : 0;
                        }
                    ?>
                    <div class="category_header resume_category_header">
                        <h3 class="category_title ctitle">
                            <span class="category_title_icon aqua"></span>
                            <?php echo $value[0]['SHORTNAME']; ?> (<?php echo count($data['size_breakdown'][$key]); ?>)
                            <span class="number-right"><?php echo number_format($sum_weight,2); ?> %</span>
                        </h3>
                    </div>
                    <?php
                    $i = 1;
                    foreach($value as $subValue) {
                        $link = BASE_URL . "company/code/" . $subValue['ISIN'];
                        ?>                         
                        <article class="post resume_post resume_post_1  <?php echo $i % 2 == 0 ? "even": "odd"; ?>">
                            <div class="post_header resume_post_header">
                                <table style="width: 100%; margin-top: -6px;">
                                    <tbody>
                                        <tr>
                                            <td width="10%" style="text-align: center;">
                                                <h4>
                                                    <?php echo $i++; ?>
                                                </h4>
                                            </td>
                                            <td width="15%">
                                                <h4 class="post_title">
                                                    <a href="<?php echo $link ?>"><?php echo $subValue['ISIN'] ?></a>
                                                </h4>
                                            </td>
                                            <td>
                                                <h4>
                                                 <?php echo $subValue['NAME'] ?>
                                                </h4>
                                            </td>
                                            <td width="12.5%" style="text-align: right;">
                                                <h4>
                                                    <font style="color: <?php echo $subValue['perf'] < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo number_format($subValue['perf'], 2, '.', ','); ?> %</font>
                                                </h4>
                                            </td>
                                            <td width="12.5%" style="text-align: right;">
                                                <h4>
                                                    <?php echo number_format($subValue['WEIGHT'],2); ?> %
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