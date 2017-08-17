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
            <li index='tab_<?php echo ($alldata['provider']['provider'] == 'IFRC')?'VNX':$alldata['provider']['provider']; ?>' category='listindex'><a class='index' href="#"><?php echo ($alldata['provider']['provider'] == 'IFRC')?'VNX':
			$data['trans']->getTranslate($alldata['provider']['provider']); ?></a></li>
        <?php }?>
           
        </ul>
        <?php foreach($data['all'] as $alldata){?>
       <div class="list_tabs tab_<?php echo ($alldata['provider']['provider'] == 'IFRC')?'VNX':$alldata['provider']['provider']; ?> tab_first wrapper resume_wrapper">
       	<!--VNX-->
        <?php if($alldata['provider']['provider'] == 'IFRC'){?>

        	<?php
            
            $countVNX = 0;
            $listVNX = array();
            foreach ($data['vnx'] as $vnx) {
                $listVNX[$vnx['SUB_TYPE']][] = $vnx;
            }
            unset($data['vnx']);
            $last_update = (isset($listVNX['Benchmark'][0]['date']) && $listVNX['Benchmark'][0]['date'] != "") ? $listVNX['Benchmark'][0]['date'] : isset($listVNX['BlueChips'][0]['date'])? $listVNX['BlueChips'][0]['date'] : '' ;
            echo "<div class='last-update'>" . $data['trans']->getTranslate('last_update') . ": <span>$last_update</span></div>";
            foreach ($listVNX as $keyVNX => $valueVNX) {
                ?>
                <div class="category resume_category resume_category_1 <?php echo $countVNX == 0 ? "first" : ""; ?> <?php echo $countVNX % 2 == 0 ? "even" : "odd"; ?>">
                    <div class="category_header resume_category_header">
                        <h3 class="category_title ctitle"><span class="category_title_icon aqua <?php //echo $listColor[array_rand($listColor, 1)]; ?>"></span><?php echo $data['trans']->getTranslate($keyVNX); ?></h3>
                    </div>
                    <div class="category_body resume_category_body">
                        <?php
                        $subCountVNX = 0;
                        foreach ($valueVNX as $subKeyVNX => $subValueVNX) {
                            ?>
                            <article class="post resume_post resume_post_1 <?php echo $subCountVNX == 0 ? "first" : ""; ?> <?php echo $subCountVNX % 2 == 0 ? "even" : "odd"; ?>even">
                                <div class="post_header resume_post_header">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td width="60%">
                                                <h4 class="post_title"><a href="<?php echo BASE_URL?>indice/code/<?php echo $subValueVNX['CODE']; ?>"><?php echo strtoupper($subValueVNX['SHORTNAME']); ?></a></h4>
                                            </td>
                                            <td width="20%" style="text-align: right;"><h4><font style="color: #fff;"><?php echo $subValueVNX['close'] == 0 ? "n.a." : number_format($subValueVNX['close'], 2, '.', ','); ?></font></h4></td>
                                            <td style="text-align: right;"><h4><font style="color: <?php echo $subValueVNX['dvar'] < 0 ? "#ff492a" : "#92dd4b"; ?>"><?php echo $subValueVNX['close'] == 0 ? "n.a." : number_format($subValueVNX['dvar'], 2, '.', ',') . " %"; ?></font></h4></td>
                                        </tr>
                                    </table>
                                </div>
                            </article>
                            <?php
                            $subCountVNX++;
                        }
                        ?>
                    </div>
                    <!-- .category_body --> 
                </div>
                <?php
                $countVNX++;
            }
            ?>
        <?php }?>
        
        <!--IFRCRESEARCH-->
        <?php if($alldata['provider']['provider'] == 'IFRCRESEARCH'){?>

        	<?php
            $countIFRCRESEARCH = 0;
            $listIFRCRESEARCH = array();
            foreach ($data['ifrcresearch'] as $ifrcresearch) {
                $listIFRCRESEARCH[$ifrcresearch['SUB_TYPE']][] = $ifrcresearch;
            }
            unset($data['ifrcresearch']);
            $last_update = (isset($listIFRCRESEARCH['Benchmark'][0]['date']) && $listIFRCRESEARCH['Benchmark'][0]['date'] != "") ? $listIFRCRESEARCH['Benchmark'][0]['date'] : $listIFRCRESEARCH['BlueChips'][0]['date'];
            echo "<div class='last-update'>" . $data['trans']->getTranslate('last_update') . ": <span>$last_update</span></div>";
            foreach ($listIFRCRESEARCH as $keyIFRCRESEARCH => $valueIFRCRESEARCH) {
                ?>
                <div class="category resume_category resume_category_1 <?php echo $countIFRCRESEARCH == 0 ? "first" : ""; ?> <?php echo $countIFRCRESEARCH % 2 == 0 ? "even" : "odd"; ?>">
                    <div class="category_header resume_category_header">
                        <h3 class="category_title ctitle"><span class="category_title_icon aqua"></span><?php echo $data['trans']->getTranslate($keyIFRCRESEARCH); ?></h3>
                    </div>
                    <div class="category_body resume_category_body">
                        <?php
                        $subCountIFRCRESEARCH = 0;
                        foreach ($valueIFRCRESEARCH as $subKeyIFRCRESEARCH => $subValueIFRCRESEARCH) {
                            ?>
                            <article class="post resume_post resume_post_1 <?php echo $subCountIFRCRESEARCH == 0 ? "first" : ""; ?> <?php echo $subCountIFRCRESEARCH % 2 == 0 ? "even" : "odd"; ?>">
                                <div class="post_header resume_post_header">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td width="60%">
                                                <h4 class="post_title"><a href="<?php echo BASE_URL?>indice/code/<?php echo $subValueIFRCRESEARCH['CODE']; ?>"><?php echo strtoupper($subValueIFRCRESEARCH['SHORTNAME']); ?></a></h4>
                                            </td>
                                            <td width="20%" style="text-align: right;"><h4><font style="color: #fff;"><?php echo $subValueIFRCRESEARCH['close'] == 0 ? "n.a." : number_format($subValueIFRCRESEARCH['close'], 2, '.', ','); ?></font></h4></td>
                                            <td style="text-align: right;"><h4><font style="color: <?php echo $subValueIFRCRESEARCH['dvar'] < 0 ? "#ff492a" : "#92dd4b"; ?>"><?php echo $subValueIFRCRESEARCH['close'] == 0 ? "n.a." : number_format($subValueIFRCRESEARCH['dvar'], 2, '.', ',') . " %"; ?></font></h4></td>
                                        </tr>
                                    </table>
                                </div>
                            </article>
                            <?php
                            $subCountIFRCRESEARCH++;
                        }
                        ?>
                    </div>
                    <!-- .category_body -->
                </div>
                <?php
                $countIFRCRESEARCH++;
            }
            ?>
        <?php }?>
        <!--PVN-->
        <?php if($alldata['provider']['provider'] == 'PROVINCIAL'){?>

        <?php
            $countPVN = 0;
            $listPVN = array();
            foreach ($data['pvn'] as $pvn) {
                $listPVN[$pvn['SUB_TYPE']][] = $pvn;
            }
            unset($data['pvn']);
            $last_update = (isset($listPVN['Benchmark'][0]['date']) && $listPVN['Benchmark'][0]['date'] != "") ? $listPVN['Benchmark'][0]['date'] : isset($listPVN['BlueChips'][0]['date'])? $listPVN['BlueChips'][0]['date'] : '';
            echo "<div class='last-update'>" . $data['trans']->getTranslate('last_update') . ": <span>$last_update</span></div>";
            foreach ($listPVN as $keyPVN => $valuePVN) {
                ?>
                <div class="category resume_category resume_category_1 <?php echo $countPVN == 0 ? "first" : ""; ?> <?php echo $countPVN % 2 == 0 ? "even" : "odd"; ?>">
                    <div class="category_header resume_category_header">
                        <h3 class="category_title ctitle"><span class="category_title_icon aqua <?php //echo $listColor[array_rand($listColor, 1)]; ?>"></span><?php echo $data['trans']->getTranslate($keyPVN); ?></h3>
                    </div>
                    <div class="category_body resume_category_body">
                        <?php
                        $subCountPVN = 0;
                        foreach ($valuePVN as $subKeyPVN => $subValuePVN) {
                            ?>
                            <article class="post resume_post resume_post_1 <?php echo $subCountPVN == 0 ? "first" : ""; ?> <?php echo $subCountPVN % 2 == 0 ? "even" : "odd"; ?>">
                                <div class="post_header resume_post_header">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td width="60%">
                                                <h4 class="post_title"><a href="<?php echo BASE_URL?>indice/code/<?php echo $subValuePVN['CODE']; ?>"><?php echo strtoupper($subValuePVN['SHORTNAME']); ?></a></h4>
                                            </td>
                                            <td width="20%" style="text-align: right;"><h4><font style="color: #fff;"><?php echo $subValuePVN['close'] == 0 ? "n.a." : number_format($subValuePVN['close'], 2, '.', ','); ?></font></h4></td>
                                            <td style="text-align: right;"><h4><font style="color: <?php echo $subValuePVN['dvar'] < 0 ? "#ff492a" : "#92dd4b"; ?>"><?php echo $subValuePVN['close'] == 0 ? "n.a." : number_format($subValuePVN['dvar'], 2, '.', ',') . " %"; ?></font></h4></td>
                                        </tr>
                                    </table>
                                </div>
                            </article>
                            <?php
                            $subCountPVN++;
                        }
                        ?>
                    </div>
                    <!-- .category_body -->
                </div>
                <?php
                $countPVN++;
            }
            ?>



        <?php }?>


        <!--P_CURRENCY-->

        <?php if($alldata['provider']['provider'] == 'IFRCCURRENCY'){?>

        <?php }?>

         <?php if($alldata['provider']['provider'] == 'OTHERS'){?>

        <?php }?>
       		
       
       
        </div>
        <?php }?>
        
        
        <!-- /wrapper --> 
        <!-- /wrapper --> 
    </div>
    <!-- /section_body --> 
</section>