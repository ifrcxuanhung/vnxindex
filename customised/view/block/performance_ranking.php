

<section class="section resume_section even" id="performance_section">
    <div class="section_header resume_section_header">
        <h2 class="section_title resume_section_title<?php echo $classH2; ?>">
            <a href="#">
                <span class="icon icon-briefcase"></span>
                <span class="section_name"><?php echo $data['trans']->getTranslate('performance_ranking'); ?></span>
            </a>
            <span class="section_icon"></span>
        </h2>
    </div>
    <div class="section_body resume_section_body" <?php echo $sessionBody; ?>>
        
        <div class='last-update'><?php echo $data['trans']->getTranslate('last_update'); ?>: <span style='color: #FFA500;'><?php echo $lastUpdate[0]['date']; ?></span></div>
        <!--ul id="performance_fliter">
            <?php
            $pages = (int) (count($data['performance']) / 25);
            $pages += count($data['performance']) % 25 > 0 ? 1 : 0;
            for ($i = 1; $i <= $pages; $i++)
            {
                if ($i == 1)
                {
                    echo "<li index='page_{$i}'><a class='index current' href='javascript: void(0);'>{$i}</a></li>";
                }
                else
                {
                    echo "<li index='page_{$i}'><a class='index' href='javascript: void(0);'>{$i}</a></li>";
                }
            }
            ?>
        </ul-->
        <?php
        $limit = 0;
        for ($i = 1; $i <= $pages; $i++)
        {
            $limit += 25;
            ?>
        <div class="list_tabs page_<?php echo $i; ?> <?php echo $i == 1 ? "tab_first" : ""; ?> wrapper resume_wrapper" style="margin-top: 35px;">
                <div class="category resume_category first even">
                    <div class="category_header resume_category_header">
                        <table style="width: 100%;">
                            <tr>
                                <td width="5%" style="text-align: left;">
                                    <h3 class="category_title"><?php echo $data['trans']->getTranslate('nr'); ?></h3>
                                <td>
                                <td style="text-align: left;">
                                    <h3 class="category_title"><?php echo $data['trans']->getTranslate('index'); ?></h3>
                                <td>
                                <td width="20%" style="text-align: right;">
                                    <h3 class="category_title"><?php echo $data['trans']->getTranslate('close'); ?></h3>
                                </td>
                                <td width="15%" style="text-align: right;">
                                    <a href="javascript: void(0);" class="sort-mtd<?php echo $sortMTD; ?>" style="text-decoration: none;"><h3 class="category_title"><?php echo $data['trans']->getTranslate('mtd'); ?> %</h3></a>
                                </td>
                                <td width="15%" style="text-align: right;">
                                    <a href="javascript: void(0);" class="sort-ytd<?php echo $sortYTD; ?>" style="text-decoration: none;"><h3 class="category_title"><?php echo $data['trans']->getTranslate('ytd'); ?> %</h3></a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="category_body resume_category_body">
                        <?php
                        $countPerformance = 0;
                        foreach ($data['performance'] as $keyPerformance => $performance)
                        {
                            if ($keyPerformance == $limit)
                            {
                                break;
                            }
                            ?>
                            <article class="post resume_post resume_post_1 <?php echo $countPerformance == 0 ? "first" : ""; ?> <?php echo $countPerformance % 2 == 0 ? "even" : "odd"; ?>">
                                <div class="post_header resume_post_header">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td width="10%" style="text-align: left;">
                                                <h4 class="post_title"><?php echo $keyPerformance + 1; ?></h4>
                                            </td>
                                            <td style="text-align: left;">
                                                <h4 class="post_title"><a href="<?php echo BASE_URL ?>index/code/<?php echo $performance['CODE']; ?>"><?php echo $performance['SHORTNAME']; ?></a></h4>
                                            </td>
                                            <td width="15%" style="text-align: right;">
                                                <h4 class="post_title"><?php echo number_format($performance['close'], 2, '.', ','); ?></h4>
                                            </td>
                                            <td width="15%" style="text-align: right;">
                                                <h4 class="post_title"><font style="color: <?php echo number_format($performance['varmonth'], 2, '.', ',') >= 0 ? "#92dd4b" : "#ff492a"; ?>;"><?php echo number_format($performance['varmonth'], 2, '.', ','); ?> %</font></h4>
                                            </td>
                                            <td width="15%" style="text-align: right;">
                                                <h4 class="post_title"><font style="color: <?php echo number_format($performance['varyear'], 2, '.', ',') >= 0 ? "#92dd4b" : "#ff492a"; ?>;"><?php echo number_format($performance['varyear'], 2, '.', ','); ?> %</font></h4>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </article>
                            <?php
                            unset($data['performance'][$keyPerformance]);
                            $countPerformance++;
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

    </div>
    <!-- /section_body --> 
</section>