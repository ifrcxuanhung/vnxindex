<?php
    $setting = setting();
    $width = (isset($setting['gwc_width']) && $setting['gwc_width'] != "") ? "style='width: {$setting['gwc_width']}'" : "";
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
                            <div class="section_header profile_section_header opened">
                                <h2 class="section_title profile_section_title vis"><a href="#"><span class="icon icon-user"></span><span class="section_name"><?php echo $dataIndex[0]['SHORTNAME']; ?></span></a><span class="section_icon"></span></h2>
                                <div id="profile_header">
                                    <div id="profile_name_area">
                                        <div id="profile_name">
                                            <h4 id="profile_position" style="color: #FFA500;">
                                                <?php
                                                if (isset($dataIndexDescription[0]))
                                                {
                                                    echo $dataIndexDescription[0]['description'];
                                                }
                                                else
                                                {
                                                    echo $data['trans']->getTranslate('no_description');
                                                }
                                                ?>
                                            </h4>
                                        </div>
                                    </div>
                                    <div <?php echo $checkCurrency == false ? "" : "style='display: none;'"; ?>>
                                        
                                        <?php
                                        $listPR = array();
                                        $listTR = array();
                                        $listNR = array();
                                        foreach ($relatedIndexes as $keyRelatedIndexes => $valueRelatedIndexes)
                                        {
                                            switch ($valueRelatedIndexes['PRICE'])
                                            {
                                                case 'PR':
                                                    $listPR[] = $valueRelatedIndexes;
                                                    break;
                                                case 'TR':
                                                    $listTR[] = $valueRelatedIndexes;
                                                    break;
                                                case 'NR':
                                                    $listNR[] = $valueRelatedIndexes;
                                                    break;
                                                default:
                                                    break;
                                            }
                                        }
                                        ?>
                                        <table>
                                            <?php
                                            if (count($listPR) > 0)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo str_repeat('&nbsp;', 10); ?></td>
                                                    <td><h4><?php echo $data['trans']->getTranslate('prices'); ?></h4></td>
                                                    <td><?php echo str_repeat('&nbsp;', 10); ?></td>
                                                    <td>
                                                        <?php
                                                        foreach ($listPR as $keyListPR => $valueListPR)
                                                        {
                                                            ?>
                                                            <a class="none-decoration" href="<?php echo BASE_URL; ?>indice/code/<?php echo $valueListPR['CODE']; ?>"><?php echo strtoupper($data['trans']->getTranslate($valueListPR['CURR'])); ?></a>
                                                            <?php
                                                            echo $keyListPR < count($listPR) - 1 ? " | " : "";
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            if (count($listTR) > 0)
                                            {
                                                ?>
                                                <?php //echo "<pre>";print_r($_SERVER['REQUEST_URI']);exit;
												$request_code = explode('/',$_SERVER['REQUEST_URI']);
												$first_str = substr(end($request_code),0,3);
											//	$strpos = strpos(end($request_code),'EW');
												//echo $strpos;
											  
												if($first_str != 'GWC'){
													?>
													<tr>
														<td><?php echo str_repeat('&nbsp;', 10); ?></td>
														<td><h4><?php echo $data['trans']->getTranslate('total_return'); ?></h4></td>
														<td><?php echo str_repeat('&nbsp;', 10); ?></td>
														<td>
															<?php
															foreach ($listTR as $keyListTR => $valueListTR)
															{
																?>
																<a class="none-decoration" href="<?php echo BASE_URL; ?>indice/code/<?php echo $valueListTR['CODE']; ?>"><?php echo strtoupper($data['trans']->getTranslate($valueListTR['CURR'])); ?></a>
																<?php
																echo $keyListTR < count($listTR) - 1 ? " | " : "";
															}
															?>
														</td>
													</tr>
													<?php
												}
                                            }
                                            if (count($listNR) > 0)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo str_repeat('&nbsp;', 10); ?></td>
                                                    <td><h4><?php echo $data['trans']->getTranslate('net_return'); ?></h4></td>
                                                    <td><?php echo str_repeat('&nbsp;', 10); ?></td>
                                                    <td>
                                                        <?php
                                                        foreach ($listNR as $keyListNR => $valueListNR)
                                                        {
                                                            ?>
                                                            <a class="none-decoration" href="<?php echo BASE_URL; ?>indice/code/<?php echo $valueListNR['CODE']; ?>"><?php echo strtoupper($data['trans']->getTranslate($valueListNR['CURR'])); ?></a>
                                                            <?php
                                                            echo $keyListNR < count($listNR) - 1 ? " | " : "";
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div id="mainpage_accordion_area"> 
                            <!-- LIST OF INDEXES -->
                            <section class="section resume_section even open" id="resume">
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
                                        <?php echo $this->block->compare_chart($code) ?>
                                        <div class="category resume_category resume_category_1 first even">
                                            <div class="category_header resume_category_header">
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td width="30%"style="text-align: left;">
                                                            <h3 class="category_title"><?php echo $data['trans']->getTranslate('period'); ?></h3>
                                                        </td>
                                                        <td width="25%" style="text-align: center;">
                                                            <h3 class="category_title"><?php echo $data['trans']->getTranslate('date'); ?></h3>
                                                        </td>
                                                        <td width="25%" style="text-align: right;">
                                                            <h3 class="category_title"><?php echo $data['trans']->getTranslate('last'); ?></h3>
                                                        </td>
                                                        <td width="20%" style="text-align: right;">
                                                            <h3 class="category_title"><?php echo $data['trans']->getTranslate('_var'); ?></h3>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="category_body resume_category_body">
                                            <article class="post resume_post resume_post_1 first even">
                                                <div class="post_header resume_post_header">
                                                    <table style="width: 100%; margin-top: -6px;">
                                                        <tr>
                                                            <td width="30%"style="text-align: left;">
                                                                <h4 class="post_title"><?php echo $data['trans']->getTranslate('last_update'); ?></h4>
                                                            </td>
                                                            <td width="25%" style="text-align: center;">
                                                                <h4><?php echo $dataPerformance[0]['date']; ?></h4>
                                                            </td>
                                                            <td width="25%" style="text-align: right;">
                                                                <h4><?php echo $dataPerformance[0]['last'] > 0 ? number_format($dataPerformance[0]['last'], 2, '.', ',') : 'n.a.'; ?></h4>
                                                            </td>
                                                            <td width="20%" style="text-align: right;">
                                                                <h4><font style="color: <?php echo $dataPerformance[0]['var'] < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo $dataPerformance[0]['last'] > 0 ? number_format($dataPerformance[0]['var'], 2, '.', ',') . ' %' : 'n.a.'; ?></font></h4>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </article>
                                            <article class="post resume_post resume_post_1 odd">
                                                <div class="post_header resume_post_header">
                                                    <table style="width: 100%; margin-top: -6px;">
                                                        <tr>
                                                            <td width="30%"style="text-align: left;">
                                                                <h4 class="post_title"><?php echo $data['trans']->getTranslate('month_to_date'); ?></h4>
                                                            </td>
                                                            <td width="25%" style="text-align: center;">
                                                                <h4><?php echo $dataPerformance[0]['mtd_date']; ?></h4>
                                                            </td>
                                                            <td width="25%" style="text-align: right;">
                                                                <h4><?php echo $dataPerformance[0]['mtd_last'] > 0 ? number_format($dataPerformance[0]['mtd_last'], 2, '.', ',') : 'n.a.'; ?></h4>
                                                            </td>
                                                            <td width="20%" style="text-align: right;">
                                                                <h4><font style="color: <?php echo $dataPerformance[0]['mtd_var'] < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo $dataPerformance[0]['mtd_last'] > 0 ? number_format($dataPerformance[0]['mtd_var'], 2, '.', ',') . ' %' : 'n.a.'; ?></font></h4>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </article>
                                            <article class="post resume_post resume_post_1 even">
                                                <div class="post_header resume_post_header">
                                                    <table style="width: 100%; margin-top: -6px;">
                                                        <tr>
                                                            <td width="30%"style="text-align: left;">
                                                                <h4 class="post_title"><?php echo $data['trans']->getTranslate('year_to_date'); ?></h4>
                                                            </td>
                                                            <td width="25%" style="text-align: center;">
                                                                <h4><?php echo $dataPerformance[0]['ytd_date']; ?></a></h4>
                                                            </td>
                                                            <td width="25%" style="text-align: right;">
                                                                <h4><?php echo $dataPerformance[0]['ytd_last'] > 0 ? number_format($dataPerformance[0]['ytd_last'], 2, '.', ',') : 'n.a.'; ?></h4>
                                                            </td>
                                                            <td width="20%" style="text-align: right;">
                                                                <h4><font style="color: <?php echo $dataPerformance[0]['ytd_var'] < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo $dataPerformance[0]['ytd_last'] > 0 ? number_format($dataPerformance[0]['ytd_var'], 2, '.', ',') . ' %' : 'n.a.'; ?></font></h4>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </article>
                                            <article class="post resume_post resume_post_1 odd">
                                                <div class="post_header resume_post_header">
                                                    <table style="width: 100%; margin-top: -6px;">
                                                        <tr>
                                                            <td width="30%"style="text-align: left;">
                                                                <h4 class="post_title"><?php echo $data['trans']->getTranslate('52_weeks'); ?></h4>
                                                            </td>
                                                            <td width="25%" style="text-align: center;">
                                                                <h4><?php echo $dataPerformance[0]['52w_date']; ?></h4>
                                                            </td>
                                                            <td width="25%" style="text-align: right;">
                                                                <h4><?php echo $dataPerformance[0]['52w_last'] > 0 ? number_format($dataPerformance[0]['52w_last'], 2, '.', ',') : 'n.a.'; ?></h4>
                                                            </td>
                                                            <td width="20%" style="text-align: right;">
                                                                <h4><font style="color: <?php echo $dataPerformance[0]['52w_var'] < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo $dataPerformance[0]['52w_last'] > 0 ? number_format($dataPerformance[0]['52w_var'], 2, '.', ',') . ' %' : 'n.a.'; ?></font></h4>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </article>
                                            <article class="post resume_post resume_post_1 even">
                                                <div class="post_header resume_post_header">
                                                    <table style="width: 100%; margin-top: -6px;">
                                                        <tr>
                                                            <td width="30%"style="text-align: left;">
                                                                <h4 class="post_title"><?php echo $data['trans']->getTranslate('life'); ?></h4>
                                                            </td>
                                                            <td width="25%" style="text-align: center;">
                                                                <h4><?php echo $dataPerformance[0]['life_date']; ?></h4>
                                                            </td>
                                                            <td width="25%" style="text-align: right;">
                                                                <h4><?php echo $dataPerformance[0]['life_last'] > 0 ? number_format($dataPerformance[0]['life_last'], 2, '.', ',') : 'n.a.'; ?></h4>
                                                            </td>
                                                            <td width="20%" style="text-align: right;">
                                                                <h4><font style="color: <?php echo $dataPerformance[0]['life_var'] < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo $dataPerformance[0]['life_last'] > 0 ? number_format($dataPerformance[0]['life_var'], 2, '.', ',') . ' %' : 'n.a.'; ?></font></h4>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </article>
                                            
                                            <article class="post resume_post resume_post_1 odd">
                                                <div class="post_header resume_post_header">
                                                    <table style="width: 100%; margin-top: -6px;">
                                                        <tr>
                                                            <td width="30%"style="text-align: left;">
                                                                <h4 class="post_title"><?php echo $data['trans']->getTranslate('annualised_return'); ?></h4>
                                                            </td>
                                                            <td width="25%" style="text-align: center;">
                                                                <h4><?php echo $data['trans']->getTranslate('from'); ?> <?php echo $dataPerformance[0]['life_date']; ?></h4>
                                                            </td>
                                                            <td width="25%" style="text-align: right;">
                                                                <h4></h4>
                                                            </td>
                                                            <td width="20%" style="text-align: right;">
                                                                <h4><font style="color: <?php echo $dataPerformance[0]['annua'] < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo $dataPerformance[0]['life_last'] > 0 ? number_format($dataPerformance[0]['annua'], 2, '.', ',') . ' %' : 'n.a.'; ?></font></h4>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </article>
                                            
                                            <article class="post resume_post resume_post_1 odd" <?php echo count($dataPerformanceYear) > 0 ? "" : "style='display: none;'"; ?>>
                                                <div class="post_header resume_post_header">
                                                    <table style="width: 100%;">
                                                        <tr>
                                                            <td width="30%"style="text-align: left;">
                                                                <h3  class="category_title"><?php echo $data['trans']->getTranslate('year'); ?></h3>
                                                            </td>
                                                           <td width="25%" style="text-align: center;">
																<h3 class="category_title"><?php echo $data['trans']->getTranslate('date'); ?></h3>
                                                           </td>
                                                           <td width="25%" style="text-align: right;">
																<h3 class="category_title"><?php echo $data['trans']->getTranslate('last'); ?></h3>
                                                           </td>
                                                           <td width="20%" style="text-align: right;">
																<h3 class="category_title"><?php echo $data['trans']->getTranslate('_var'); ?></h3>
                                                           </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </article>
                                            <?php
                                            foreach ($dataPerformanceYear as $keyPerformanceYear => $valuePerformanceYear)
                                            {
                                                ?>
                                                <article class="post resume_post resume_post_1 <?php echo $keyPerformanceYear % 2 == 0 ? "even" : "odd"; ?>">
                                                    <div class="post_header resume_post_header">
                                                        <table style="width: 100%; margin-top: -6px;">
                                                            <tr>
                                                                <td width="30%"style="text-align: left;">
                                                                    <h4 class="post_title"><?php echo $data['trans']->getTranslate($valuePerformanceYear['year']); ?></h4>
                                                                </td>
                                                                <td width="25%" style="text-align: center;">
                                                                    <h4><?php echo $valuePerformanceYear['date']; ?></h4>
                                                                </td>
                                                                <td width="25%" style="text-align: right;">
                                                                    <h4><?php echo $valuePerformanceYear['close'] > 0 ? number_format($valuePerformanceYear['close'], 2, '.', ',') : 'n.a.'; ?></h4>
                                                                </td>
                                                                <td width="20%" style="text-align: right;">
                                                                    <h4><font style="color: <?php echo $valuePerformanceYear['perform'] < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo is_numeric($valuePerformanceYear['perform']) ? number_format($valuePerformanceYear['perform'], 2, '.', ',') . ' %' : 'n.a.'; ?></font></h4>
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
                            </section>
                           <section class="section resume_section even" id="composition" totalR="<?php echo count($dataComposition) ?>">
                                <div class="section_header resume_section_header">
                                    <input type="text" id="search-company" name="search-company" placeholder="<?php echo $data['trans']->getTranslate('vnxindex_quick_search_company'); ?>" style="position: absolute; width: 35%; margin-top: 13px; z-index: 99; display: none; font-size: 14px;" />
                                    <h2 class="section_title resume_section_title"><a href="#"><span class="icon icon-align-left"></span><span class="section_name"><?php echo $data['trans']->getTranslate('composition'); ?></span></a><span class="section_icon"></span></h2>
                                </div>
                                <div class="section_body resume_section_body">
                                    <div class="wrapper resume_wrapper">
                                        <div class="last-update-margin2"><?php echo $countcompo[0]['number']; ?> <?php echo $data['trans']->getTranslate('Stocks'); ?></div>
                                        <div class="last-update-margin"><?php echo $data['trans']->getTranslate('last_update'); ?>: <span><?php echo $lastUpdate[0]['date']; ?></span></div>
                                        <ul id="portfolio_iso_filters">
                                            <?php
                                            $pages = (int) (count($dataComposition) / 25);
                                            $pages += count($dataComposition) % 25 > 0 ? 1 : 0;
											
                                            echo "<li index='page_1' class='first'><a class='index current' href='#'>First</a></li>";
											echo "<li index='page_1' class='minus'><a class='index' href='#'><<</a></li>";
                                            for ($i = 1; $i <= $pages; $i++)
                                            {
                                                if ($i == 1)
                                                {
                                                    echo "<li class='number' index='page_{$i}'><a class='index current' href='#'>{$i}</a></li>";
                                                }
                                                else
                                                {
                                                    
                                                    $hide = $i > 10 ? ' style="display:none"' : '';
                                                    echo "<li class='number' index='page_{$i}' $hide><a class='index' href='#'>{$i}</a></li>";
                                                }
                                            }
											echo "<li index='page_1' class='add'><a class='index' href='#'>>></a></li>";
                                            echo "<li index='page_{$pages}' class='last'><a class='index' href='#'>Last</a></li>";
                                            ?>
                                        </ul>
                                        <?php
                                        $limit = 0;
                                        for ($i = 1; $i <= $pages; $i++)
                                        {
                                            $limit += 25;
                                            ?>
                                            <div class="list_tabs page_<?php echo $i; ?> <?php echo $i == 1 ? "tab_first" : "tab_".$i ; ?> wrapper resume_wrapper">
                                                <div class="category resume_category resume_category_1 first even">
                                                    <div class="category_header resume_category_header">
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td width="10%" style="text-align: center;">
                                                                    <h3 class="category_title"><?php echo $data['trans']->getTranslate('nr'); ?></h3>
                                                                </td>
                                                                <td width="15%" style="text-align: left;">
                                                                    <h3 class="category_title"><?php echo $data['trans']->getTranslate('ticker'); ?></h3>
                                                                </td>
                                                                <td width="50%" style="text-align: left;">
                                                                    <h3 class="category_title"><?php echo $data['trans']->getTranslate('name'); ?></h3>
                                                                </td>
                                                                 <td width="12.5%" style="text-align: right;">
                                                                    <h3 class="category_title"><?php echo $data['trans']->getTranslate('perf'); ?></h3>
                                                                </td>
                                                                <td width="12.5%" style="text-align: right;">
                                                                    <h3 class="category_title"><?php echo $data['trans']->getTranslate('weight'); ?></h3>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="category_body resume_category_body">
                                                        <?php
                                                        $countComposition = 0;
                                                        foreach ($dataComposition as $keyComposition => $composition)
                                                        {
                                                            if ($keyComposition == $limit)
                                                            {
                                                                break;
                                                            }
                                                            if ($countComposition % 2 == 0)
                                                            {
                                                                ?>
                                                                <article class="post resume_post resume_post_1 <?php echo $countComposition == 0 ? "first" : ""; ?> even">
                                                                    <div class="post_header resume_post_header">
                                                                        <table style="width: 100%; margin-top: -6px;">
                                                                            <tr>
                                                                                <td width="10%">
                                                                                    <h4 style="text-align: center;"><?php echo $keyComposition + 1; ?></h4>
                                                                                </td>
                                                                                <td width="15%" >
                                                                                    <!--<h4 style="text-align: left;" class="post_title">
                                                                                    <?php echo !$checkOther == false ? $composition['ISIN'] : "<a class='none-decoration' href='".BASE_URL."company/code/".$composition['ISIN']."'>".$composition['ISIN']."</a>"?>
                                                                                    </h4>-->
                                                                                    <h4 style="text-align: left;" class="post_title">
                                                                                    <a class='none-decoration' href='<?php echo BASE_URL."company/code/".$composition['ISIN']?>'><?php echo $composition['ISIN']?></a>
                                                                                    </h4>
                                                                                    
                                                                                </td>
                                                                                <td width="50%">
                                                                                    <h4 style="text-align: left;">
																					<?php echo $composition['NAME']; ?></h4>
                                                                                </td>
                                                                                <td width="12.5%">
                                                                                    <h4 style="text-align: right;"><font style="color: <?php echo $composition['perf'] < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo number_format($composition['perf'], 2, '.', ','); ?> %</font></h4>
                                                                                </td>
                                                                                <td width="12.5%" >
                                                                                    <h4 style="text-align: right;"><?php echo is_null($composition['WEIGHT']) ? '-' : (number_format($composition['WEIGHT'], 2, '.', ',').'%'); ?> </h4>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </article>
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                                ?>
                                                                <article class="post resume_post resume_post_1 odd">
                                                                    <div class="post_header resume_post_header">
                                                                        <table style="width: 100%; margin-top: -6px;">
                                                                            <tr>
                                                                                <td width="10%">
                                                                                    <h4 style="text-align: center;"><?php echo $keyComposition + 1; ?></h4>
                                                                                </td>
                                                                                <td width="15%" >
                                                                                    <!--<h4 style="text-align: left;" class="post_title">
                                                                                    <?php echo !$checkOther == false ? $composition['ISIN'] : "<a class='none-decoration' href='".BASE_URL."company/code/".$composition['ISIN']."'>".$composition['ISIN']."</a>"?>
                                                                                    </h4>-->
                                                                                    <h4 style="text-align: left;" class="post_title">
                                                                                    <a class='none-decoration' href='<?php echo BASE_URL."company/code/".$composition['ISIN']?>'><?php echo $composition['ISIN']?></a>
                                                                                    </h4>
                                                                                </td>
                                                                                <td width="50%">
                                                                                    <h4 style="text-align: left;"><?php echo $composition['NAME']; ?></h4>
                                                                                </td>
                                                                                <td width="12.5%">
                                                                                    <h4 style="text-align: right;"><font style="color: <?php echo $composition['perf'] < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo number_format($composition['perf'], 2, '.', ','); ?> %</font></h4>
                                                                                </td>
                                                                                <td width="12.5%">
                                                                                    <h4 style="text-align: right;"><?php echo is_null($composition['WEIGHT']) ? '-' : (number_format($composition['WEIGHT'], 2, '.', ',').'%'); ?></h4>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </article>
                                                                <?php
                                                            }
                                                            $countComposition++;
                                                            unset($dataComposition[$keyComposition]);
                                                        }
                                                        ?>
                                                    </div>
                                                    <!-- .category_body --> 
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <!-- /wrapper --> 
                                </div>
                                <!-- /section_body --> 
                            </section>
                            <!-- /LIST OF INDEXES--> 
                            <?php
                                if(!$checkOther)
                                {
                                    $code = basename($_SERVER['REQUEST_URI']);
                                    echo $this->block->sector_breakdown($code);
                                    echo $this->block->size_breakdown($code);
                                }
                                ?>
                            <div>
                                <!-- DOCUMENTATION -->
                                <?php echo $this->block->documentation($listBlockDocument[0]["category"],$listBlockDocument[0]["query"],$listBlockDocument[0]["title"]) ?>
                                <!-- /DOCUMENTATION --> 
                                <?php //echo $this->block->our_website() ?>
                                <!-- CONTACTS -->
                                <?php echo $this->block->contact() ?>
                                <!-- /CONTACT --> 
                            </div>
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
