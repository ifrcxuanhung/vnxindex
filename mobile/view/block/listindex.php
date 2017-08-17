<section class="section resume_section even" id="resume">
    <!--div id="resume_buttons"> <a  id="resume_link" href="print.html"><span class="label">Print</span><span class="icon-print icon"></span></a> <a  id="resume_link_download"><span class="label">Download</span><span class="icon-download icon"></span></a> </div-->
    <div class="section_header resume_section_header">
        <input type="text" id="search-index" name="search-index" placeholder="<?php echo $data['trans']->getTranslate('quick_search'); ?>" style="position: absolute; width: 30%; margin-top: 13px; z-index: 99; display: none; font-size: 14px;" />
        <h2 class="section_title resume_section_title">
            <a href="#">
                <span class="icon icon-align-left"></span>
                <span class="section_name"><?php echo $data['trans']->getTranslate('list_of_indexes'); ?></span>
            </a>
            <span class="section_icon"></span>
        </h2>
    </div>
    <div class="section_body resume_section_body" id="listindex">
        <ul id="portfolio_iso_filters">
            <?php foreach($data['all'] as $alldata){?>
                <li index='tab_<?php echo $alldata['provider']['provider']; ?>' category='listindex'><a class='index' href="#"><?php echo
                        $data['trans']->getTranslate($alldata['provider']['provider']); ?></a></li>
            <?php }?>

        </ul>
        <?php
       // echo "<pre>";print_r($data['all']);exit;
        foreach($data['all'] as $alldata){?>
            <div class="list_tabs tab_<?php echo $alldata['provider']['provider']; ?> tab_first wrapper resume_wrapper">
                <!--VNX-->

                <?php

                //echo "<pre>";print_r($alldata['sub_type']);exit;
                $count = 0;
                foreach ($alldata['sub_type'] as $keyALL => $valueALL) {
                    if(isset($valueALL['SUB_TYPE']) && $valueALL['SUB_TYPE'] != '') {
                        ?>
                        <div class="category resume_category resume_category_1 <?php echo $count == 0 ? "first" : ""; ?> <?php echo $count % 2 == 0 ? "even" : "odd"; ?>">
                            <div class="category_header resume_category_header">
                                <h3 class="category_title ctitle"><span
                                            class="category_title_icon aqua <?php //echo $listColor[array_rand($listColor, 1)];
                                            ?>"></span><?php echo $data['trans']->getTranslate($valueALL['SUB_TYPE']); ?>
                                </h3>
                            </div>
                            <div class="category_body resume_category_body">
                                <?php
                                $subCount = 0;
                                foreach ($valueALL['detail'] as $subKey => $subValue) {
                                    ?>
                                    <article class="post resume_post resume_post_1 <?php echo $subCount == 0 ? "first" : ""; ?> <?php echo $subCount % 2 == 0 ? "even" : "odd"; ?>even">
                                        <div class="post_header resume_post_header">
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td width="60%">
                                                        <h4 class="post_title"><a href="<?php echo BASE_URL?>indice/code/<?php echo $subValue['CODE']; ?>"><?php echo strtoupper($subValue['SHORTNAME']); ?></a></h4>
                                                    </td>
                                                    <td width="20%" style="text-align: right;"><h4><font style="color: #fff;"><?php echo $subValue['close'] == 0 ? "n.a." : number_format($subValue['close'], 2, '.', ','); ?></font></h4></td>
                                                    <td style="text-align: right;"><h4><font style="color: <?php echo $subValue['dvar'] < 0 ? "#ff492a" : "#92dd4b"; ?>"><?php echo $subValue['close'] == 0 ? "n.a." : number_format($subValue['dvar']*100, 2, '.', ',') . " %"; ?></font></h4></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </article>
                                    <?php
                                    $subCount++;
                                }
                                ?>
                            </div>
                            <!-- .category_body -->
                        </div>
                        <?php
                    }else{ ?>
                        <div class="category resume_category resume_category_1 <?php echo $count == 0 ? "first" : ""; ?> <?php echo $count % 2 == 0 ? "even" : "odd"; ?>">
                            <div class="category_header resume_category_header">
                                <h3 class="category_title ctitle"><span
                                            class="category_title_icon aqua <?php //echo $listColor[array_rand($listColor, 1)];
                                            ?>"></span>ALL
                                </h3>
                            </div>
                            <div class="category_body resume_category_body">
                                <?php
                                $subCount = 0;
                                foreach ($valueALL['detail'] as $subKey => $subValue) {
                                    ?>
                                    <article class="post resume_post resume_post_1 <?php echo $subCount == 0 ? "first" : ""; ?> <?php echo $subCount % 2 == 0 ? "even" : "odd"; ?>even">
                                        <div class="post_header resume_post_header">
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td width="60%">
                                                        <h4 class="post_title"><a href="<?php echo BASE_URL?>indice/code/<?php echo $subValue['CODE']; ?>"><?php echo strtoupper($subValue['SHORTNAME']); ?></a></h4>
                                                    </td>
                                                    <td width="20%" style="text-align: right;"><h4><font style="color: #fff;"><?php echo $subValue['close'] == 0 ? "n.a." : number_format($subValue['close'], 2, '.', ','); ?></font></h4></td>
                                                    <td style="text-align: right;"><h4><font style="color: <?php echo $subValue['dvar'] < 0 ? "#ff492a" : "#92dd4b"; ?>"><?php echo $subValue['close'] == 0 ? "n.a." : number_format($subValue['dvar']*100, 2, '.', ',') . " %"; ?></font></h4></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </article>
                                    <?php
                                    $subCount++;
                                }
                                ?>
                            </div>
                            <!-- .category_body -->
                        </div>

                    <?php }
                    $count++;
                }
                ?>






            </div>
        <?php }?>


        <!-- /wrapper -->
        <!-- /wrapper -->
    </div>
    <!-- /section_body -->
</section>