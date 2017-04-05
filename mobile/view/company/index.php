<?php
    $setting = setting();
    $width = (isset($setting['mvnx_width']) && $setting['mvnx_width'] != "") ? "style='width: {$setting['gwc_width']}'" : "";
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <?php echo $this->block->head() ?>
    </head>
    <body class="home blog dark">
        <div class="switherHead"></div>
        <div class="colored">
            <div class="blue"></div>
            <div class="aqua"></div>
            <div class="green"></div>
            <div class="yellow"></div>
            <div class="red"></div>
        </div>
        <div class="hfeed site" id="page" <?php echo $width ?>>
            <?php echo $this->block->header() ?>
            <div id="main">
                <div class="content_area" id="primary">
                    <div role="main" class="site_content" id="content">
                        <div style="display: none;"><?php echo $this->block->profile() ?></div>
                        <section class="section profile_section first odd" id="profile">
                        <a class="style_bt" href="<?php echo BASE_URL ?>#resume"><?php echo $data['trans']->getTranslate('back'); ?></a>
                        
                            <div class="section_header profile_section_header opened">
                                <div style="margin-left: 70px;">
                                <input type="text" id="search-company" name="search-company" placeholder="<?php echo $data['trans']->getTranslate('quick_search'); ?>" style="position: absolute; width: 30%; margin-top: 13px; z-index: 99; display: none; font-size: 14px;" />
                                </div>
                                <h2 class="section_title profile_section_title vis">
                                    <a href="#">
                                        <span class="icon icon-align-left"></span>
                                        <span class="section_name"><?php echo $code; ?></span>
                                    </a>
                                    <span class="section_icon"></span>
                                </h2>
                                <div id="profile_header">
                                    <div id="profile_name_area">
                                        <div id="profile_name">
                                            <h4 id="profile_position">
                                                <table>
                                                    <tr>
                                                        <td><?php echo $data['trans']->getTranslate('name'); ?></td>
                                                        <td style="padding-left: 5px;">:</td>
                                                        <td style="padding-left: 5px;color: #FFA500;"><?php echo $dataCompany[0]['stk_name']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo $data['trans']->getTranslate('exchange'); ?></td>
                                                        <td style="padding-left: 5px;">:</td>
                                                        <td style="padding-left: 5px;color: #FFA500;"><?php echo $data['trans']->getTranslate($dataCompany[0]['stk_market']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo $data['trans']->getTranslate('currency'); ?></td>
                                                        <td style="padding-left: 5px;">:</td>
                                                        <td style="padding-left: 5px;color: #FFA500;"><?php echo $data['trans']->getTranslate($dataCompany[0]['curr_name']); ?></td>
                                                    </tr>
													<tr>
                                                        <td><?php echo $data['trans']->getTranslate('sector'); ?></td>
                                                        <td style="padding-left: 5px;">:</td>
                                                        <td style="padding-left: 5px;color: #FFA500;"><?php echo $data['trans']->getTranslate($dataCompany[0]['sec_name']); ?></td>
                                                    </tr>
													<tr>
                                                        <td><?php echo $data['trans']->getTranslate('country'); ?></td>
                                                        <td style="padding-left: 5px;">:</td>
                                                        <td style="padding-left: 5px;color: #FFA500;"><?php echo $data['trans']->getTranslate($dataCompany[0]['country']); ?></td>
                                                    </tr>
                                                </table>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div id="mainpage_accordion_area">
                            <section class="section resume_section first odd open" id="section_performance">
                                <div class="section_header resume_section_header">
                                    <h2 class="section_title resume_section_title current">
                                        <a href="#">
                                            <span class="icon icon-briefcase"></span>
                                            <span class="section_name"><?php echo $data['trans']->getTranslate('performance'); ?></span>
                                        </a>
                                        <span class="section_icon"></span>
                                    </h2>
                                </div>
                                <div class="section_body resume_section_body" style="display: block;">
                                    <div class="wrapper resume_wrapper">
                                        <?php echo $this->block->compare_chart_company($code) ?>
                                        <div class="category resume_category resume_category_1 first even">
                                            <div class="category_header resume_category_header">
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td width="50%"style="text-align: left;">
                                                            <h3 class="category_title" ><?php echo $data['trans']->getTranslate('year'); ?></h3>
                                                        </td>
                                                        <td width="25%" style="text-align: right;">
                                                            <h3 class="category_title"><?php echo $data['trans']->getTranslate('close'); ?> *</h3>
                                                        </td>
                                                        <td width="25%" style="text-align: right;">
                                                            <h3 class="category_title"><?php echo $data['trans']->getTranslate('_var'); ?> **</h3>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="category_body resume_category_body">
                                            <?php
                                            $countPerformance = 0;
                                            foreach ($dataPerformance as $keyPerformance => $valuePerformance)
                                            {
                                                ?>
                                                <article class="post resume_post resume_post_1 <?php echo $countPerformance == 0 ? 'first' : ''; ?> <?php echo $keyPerformance % 2 == 0 ? 'even' : 'odd'; ?>">
                                                    <div class="post_header resume_post_header">
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td width="50%"style="text-align: left;">
                                                                    <h4 style="margin-left: 15px;" class="post_title" ><?php echo $keyPerformance == count($dataPerformance) - 1 ? $valuePerformance['eoy'] : $valuePerformance['year']; ?></h4>
                                                                </td>
                                                                <td width="25%" style="text-align: right;">
                                                                    <h4><?php echo number_format($valuePerformance['close'], 0, '.', ','); ?></h4>
                                                                </td>
                                                                <td width="25%" style="text-align: right;">
                                                                    <h4>
                                                                        <font style="color: <?php echo number_format($valuePerformance['perf'], 2) < 0 ? '#ff492a' : '#92dd4b'; ?>"><?php echo is_numeric($valuePerformance['perf']) ? number_format($valuePerformance['perf'], 2, '.', ',') . ' %' : ''; ?></font>
                                                                    </h4>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </article>
                                                <?php
                                                $countPerformance++;
                                            }
                                            ?>
                                            * <?php echo $data['trans']->getTranslate('not_ajusted'); ?><br />
                                            ** <?php echo $data['trans']->getTranslate('adjusted_perf'); ?>
                                        </div>

                                    </div>

                            </section>
                            <section class="section resume_section even" id="section_membership">
                                <div class="section_header resume_section_header">
                                    <h2 class="section_title portfolio_section_title <?php echo $classH2; ?>">
                                        <a href="#">
                                            <span class="icon icon-align-left"></span>
                                            <span class="section_name"><?php echo $data['trans']->getTranslate('membership'); ?></span>
                                        </a>
                                        <span class="section_icon"></span>
                                    </h2>
                                </div>
                                <div class="section_body resume_section_body" <?php echo $sessionBody; ?>>
                                    <div class="wrapper resume_wrapper">
                                        <div class="category resume_category resume_category_1 first even">
                                            <div class="category_header resume_category_header">
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td width="10%" style="text-align: center;">
                                                            <h3 class="category_title"><?php echo $data['trans']->getTranslate('nr'); ?></h3>
                                                        </td>
                                                        <td style="text-align: left;">
                                                            <a href="javascript: void(0);" class="sort-index" sort="asc" style="text-decoration: none;">
                                                                <img src="<?php echo TEMPLATE_URL ; ?>images/<?php echo $sortIndex == ' sort-asc' ? 'asc-hover' : 'asc' ; ?>.png" style="position: absolute; z-index: 99; top: 23px;" />
                                                            </a>
                                                            <a href="javascript: void(0);" class="sort-index" sort="desc" style="text-decoration: none;">
                                                                <img src="<?php echo TEMPLATE_URL ; ?>images/<?php echo $sortIndex == ' sort-desc' ? 'desc-hover' : 'desc' ; ?>.png" style="position: absolute; z-index: 99; top: 48px;" />
                                                            </a>
                                                            <h3 class="category_title">
                                                                <font style="margin-left: 15px; color: #FFFFFF;"><?php echo $data['trans']->getTranslate('index'); ?></font>
                                                            </h3>
                                                        </td>
                                                        <td width="20%" style="text-align: left;">
                                                            <a href="javascript: void(0);" class="sort-ytd" sort="asc" style="text-decoration: none;">
                                                                <img src="<?php echo TEMPLATE_URL ; ?>images/<?php echo $sortYTD == ' sort-asc' ? 'asc-hover' : 'asc' ; ?>.png" style="position: absolute; z-index: 99; top: 23px;" />
                                                            </a>
                                                            <a href="javascript: void(0);" class="sort-ytd" sort="desc" style="text-decoration: none;">
                                                                <img src="<?php echo TEMPLATE_URL ; ?>images/<?php echo $sortYTD == ' sort-desc' ? 'desc-hover' : 'desc' ; ?>.png" style="position: absolute; z-index: 99; top: 48px;" />
                                                            </a>
                                                            <h3 class="category_title" style="text-align: right;">
                                                                <font style="color: #FFFFFF;"><?php echo $data['trans']->getTranslate('ytd_'); ?></font>
                                                            </h3>
                                                        </td>
                                                        <td width="20%" style="text-align: left;">
                                                            <a href="javascript: void(0);" class="sort-wgt" sort="asc" style="text-decoration: none;">
                                                                <img src="<?php echo TEMPLATE_URL ; ?>images/<?php echo $sortWGT == ' sort-asc' ? 'asc-hover' : 'asc' ; ?>.png" style="position: absolute; z-index: 99; top: 23px;" />
                                                            </a>
                                                            <a href="javascript: void(0);" class="sort-wgt" sort="desc" style="text-decoration: none;">
                                                                <img src="<?php echo TEMPLATE_URL ; ?>images/<?php echo $sortWGT == ' sort-desc' ? 'desc-hover' : 'desc' ; ?>.png" style="position: absolute; z-index: 99; top: 48px;" />
                                                            </a>
                                                            <h3 class="category_title" style="text-align: right;">
                                                                <font style="color: #FFFFFF;"><?php echo $data['trans']->getTranslate('wgt_'); ?></font>
                                                            </h3>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="category_body resume_category_body">
                                                <?php
                                                $countMembership = 0;
                                                foreach ($dataMembership as $keyMembership => $valueMembership)
                                                {
                                                    ?>
                                                    <article class="post resume_post resume_post_1 <?php echo $countMembership == 0 ? 'first' : ''; ?> <?php echo $keyMembership % 2 == 0 ? 'even' : 'odd'; ?>">
                                                        <div class="post_header resume_post_header">
                                                            <table style="width: 100%;">
                                                                <tr>
                                                                    <td width="10%" style="text-align: center; padding-left: 7px;">
                                                                        <h4><?php echo ++$countMembership; ?></h3>
                                                                    </td>
                                                                    <td style="text-align: left;">
                                                                        <h4 class="post_title"><a href="<?php echo BASE_URL?>indice/code/<?php echo $valueMembership['CODE']; ?>"><?php echo strtoupper($valueMembership['SHORTNAME']); ?></a></h3>
                                                                    </td>
                                                                    <td width="20%" style="text-align: right;">
                                                                        <h4><font style="color: <?php echo number_format($valueMembership['varyear'], 2) < 0 ? '#ff492a' : '#92dd4b'; ?>"><?php echo number_format($valueMembership['varyear'], 2, '.', ',') . ' %'; ?></font></h3>
                                                                    </td>
                                                                    <td width="20%" style="text-align: right;">
                                                                        <h4><?php echo number_format($valueMembership['WEIGHT'], 2, '.', ',') . ' %'; ?></h3>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </article>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <?php echo $this->block->contact() ?>
                        </div>
                        <!-- #mainpage_accordion_area --> 
                    </div>
                    <!-- #content --> 
                </div>
                <!-- #primary --> 
            </div>
            <!-- #main -->
            <?php echo $this->block->footer() ?>
        </div>
        <!-- #page --> 
        <?php echo $this->block->script() ?>
    </body>
</html>
