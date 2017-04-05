<style>
    .input_query{
        height: 100px;
        max-width: 97%;
        min-width: 97%;
        padding: 10px;
        width: 97%;   
    }
</style>
<section class="grid_12" style="z-index: 0;">
    <div class="block-border no-margin">
        <form class="block-content form" id="manufacturers_list_form" name="f1" method="post" action="">
            <h1><?php echo $code ?></h1> 
            <ul class="tabs js-tabs mini-tabs">
                <li class="current"><a href="#tabs-performance"><span style="vertical-align: top"><?php trans('performance'); ?></span></a></li>
                <li><a href="#tabs-composition"><span style="vertical-align: top"><?php trans('composition'); ?></span></a></li>
            </ul>
            <div id="tabs-performance">
                <table id="table-indexes" class="table sortable no-margin" cellspacing="0" style="width:100% !important; margin-top: -20px !important;">
                    <thead>
                        <tr>
                            <th style="width:100px"  scope="col" bSortable="true">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('Period'); ?>
                            </th>
                            <th scope="col" bSortable="true" style="text-align: center;">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('Date'); ?>
                            </th>
                            <th scope="col" bSortable="true" style="text-align: right;">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('Last'); ?>
                            </th>
                            <th scope="col" bSortable="true" style="text-align: right;">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('perf%'); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="even">
                            <td></td> 
                            <td style="text-align: center;"><?php echo $dataPerformance[0]['date'] ?></td>
                            <td style="text-align: right;"><?php echo $dataPerformance[0]['last'] > 0 ? number_format($dataPerformance[0]['last'], 2, '.', ',') : 'n.a.'; ?></td>
                            <?php
                                $col = $dataPerformance[0]['var'] < 0 ? "#790000" : "#3399CC";
                            ?>
                            <td style="text-align: right;"><span style="color: <?php echo $col ?>;" ><?php echo $dataPerformance[0]['last'] > 0 ? number_format($dataPerformance[0]['var'], 2, '.', ',') . ' %' : 'n.a.'; ?></span></td>
                        </tr>
                        <tr class="odd">
                            <td><?php trans('month_to_date') ?></td> 
                            <td style="text-align: center;"><?php echo $dataPerformance[0]['mtd_date']; ?></td>
                            <td style="text-align: right;"><?php echo $dataPerformance[0]['mtd_last'] > 0 ? number_format($dataPerformance[0]['mtd_last'], 2, '.', ',') : 'n.a.'; ?></td>
                            <?php
                                $col = $dataPerformance[0]['mtd_var'] < 0 ? "#790000" : "#3399CC";
                            ?>
                            <td style="text-align: right;"><span style="color: <?php echo $col ?>"><?php echo $dataPerformance[0]['mtd_last'] > 0 ? number_format($dataPerformance[0]['mtd_var'], 2, '.', ',') . ' %' : 'n.a.'; ?></span></td>
                        </tr>
                        <tr class="even">
                            <td><?php trans('year_to_date') ?></td> 
                            <td style="text-align: center;"><?php echo $dataPerformance[0]['ytd_date']; ?></td>
                            <td style="text-align: right;"><?php echo $dataPerformance[0]['ytd_last'] > 0 ? number_format($dataPerformance[0]['ytd_last'], 2, '.', ',') : 'n.a.'; ?></td>
                            <?php
                                $col = $dataPerformance[0]['ytd_var'] < 0 ? "#790000" : "#3399CC";
                            ?>
                            <td style="text-align: right;"><span style="color: <?php echo $col ?>"><?php echo $dataPerformance[0]['ytd_last'] > 0 ? number_format($dataPerformance[0]['ytd_var'], 2, '.', ',') . ' %' : 'n.a.'; ?></span></td>
                        </tr><tr class="odd">
                            <td><?php trans('52_weeks') ?></td> 
                            <td style="text-align: center;"><?php echo $dataPerformance[0]['52w_date']; ?></td>
                            <td style="text-align: right;"><?php echo $dataPerformance[0]['52w_last'] > 0 ? number_format($dataPerformance[0]['52w_last'], 2, '.', ',') : 'n.a.'; ?></td>
                            <?php
                                $col = $dataPerformance[0]['52w_var'] < 0 ? "#790000" : "#3399CC";
                            ?>
                            <td style="text-align: right;"><span style="color: <?php echo $col ?>"><?php echo $dataPerformance[0]['52w_last'] > 0 ? number_format($dataPerformance[0]['52w_var'], 2, '.', ',') . ' %' : 'n.a.'; ?></span></td>
                        </tr>
                        <tr class="even">
                            <td><?php trans('life') ?></td> 
                            <td style="text-align: center;"><?php echo $dataPerformance[0]['life_date']; ?></td>
                            <td style="text-align: right;"><?php echo $dataPerformance[0]['life_last'] > 0 ? number_format($dataPerformance[0]['life_last'], 2, '.', ',') : 'n.a.'; ?></td>
                            <?php
                                $col = $dataPerformance[0]['life_var'] < 0 ? "#790000" : "#3399CC";
                            ?>
                            <td style="text-align: right;"><span style="color: <?php echo $col ?>"><?php echo $dataPerformance[0]['life_last'] > 0 ? number_format($dataPerformance[0]['life_var'], 2, '.', ',') . ' %' : 'n.a.'; ?></span></td>
                        </tr>
                        
                    
                        <tr class="even">
                            <td><strong><?php trans('Year') ?></strong></td> 
                            <td style="text-align: center;"></td>
                            <td style="text-align: right;"></td>
                            <td style="text-align: right;"></td>
                        </tr>
                        <?php
                            $i = 1;
                            foreach ($dataPerformanceYear as $keyPerformanceYear => $valuePerformanceYear)
                            {
                        ?>
                        <tr <?php echo $i++ % 2 == 0 ? "class='odd'" : "class='even'"; ?>>
                            <td><?php echo $valuePerformanceYear['year'] ?></td> 
                            <td style="text-align: center;"><?php echo $valuePerformanceYear['date']; ?></td>
                            <td style="text-align: right;"><?php echo $valuePerformanceYear['close'] > 0 ? number_format($valuePerformanceYear['close'], 2, '.', ',') : 'n.a.'; ?></td>
                            <?php
                                $col = $valuePerformanceYear['perform'] < 0 ? "#790000" : "#3399CC";
                            ?>
                            <td style="text-align: right;"><span style="color: <?php echo $col ?>"><?php echo is_numeric($valuePerformanceYear['perform']) ? number_format($valuePerformanceYear['perform'], 2, '.', ',') . ' %' : 'n.a.'; ?></span></td>
                        </tr>
                        <?php
                            }
                        ?>
                        <!--
                        <tr class="even">
                            <td>VNX HSX</td> 
                            <td style="text-align: center;">2,763.66</td>
                            <td style="text-align: right;">2,763.66</td>
                            <td style="text-align: right;"><span style="color: #ff492a">-1.24 %</span></td>
                        </tr><tr class="odd">
                            <td>VNX HNX</td> 
                            <td style="text-align: center;">1,695.69</td>
                            <td style="text-align: right;">1,695.69</td>
                            <td style="text-align: right;"><span style="color: #ff492a">-3.04 %</span></td>
                        </tr>-->
                    </tbody>
                </table>
            </div>
            <div id="tabs-composition">
                <table class="table sortable no-margin" cellspacing="0" style="width:100% !important; margin-top: -20px !important;"  id="mod_news">
                    <thead>
                        <tr>
                            <th scope="col" bSortable="true">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('nr'); ?>
                            </th>
                            <th scope="col" bSortable="true">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('Ticker'); ?>
                            </th>
                            <th scope="col" width="200px" bSortable="true" style="text-align: left;">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('Name'); ?>
                            </th>
                            <th scope="col" width="" bSortable="true" style="text-align: right;">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('Weight'); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 1;
                        foreach ($dataComposition as $keyComposition => $composition)
                        {
                    ?>
                            <tr <?php echo $i % 2 == 0 ? "class='odd'" : "class='even'"; ?>>
                                <td style="text-align: center;"><?php echo $i ?></td>
                                <td><?php echo $composition['ISIN']; ?></td>
                                <td style="text-align: left;"><?php echo $composition['NAME']; ?></td>
                                <td style="text-align: right;"><?php echo number_format($composition['WEIGHT'], 2, '.', ','); ?> %</td> 
                            </tr>
                    <?php
                        $i++;
                        }
                    ?>
                    <!--
                            <tr class="odd">
                                <td style="text-align: center;">3</td>
                                <td>VNX HNX</td>
                                <td style="text-align: right;">1,695.69</td>
                                <td style="text-align: right;"><span style="color: #3399CC">17.98 %</span></td> 
                            </tr>
                            <tr class="even">
                                <td style="text-align: center;">2</td>
                                <td>VNX HSX</td>
                                <td style="text-align: right;">2,763.66</td>
                                <td style="text-align: right;"><span style="color: #3399CC">11.08 %</span></td> 
                            </tr><tr class="odd">
                                <td style="text-align: center;">3</td>
                                <td>VNX HNX</td>
                                <td style="text-align: right;">1,695.69</td>
                                <td style="text-align: right;"><span style="color: #3399CC">17.98 %</span></td> 
                            </tr>
                            <tr class="even">
                                <td style="text-align: center;">2</td>
                                <td>VNX HSX</td>
                                <td style="text-align: right;">2,763.66</td>
                                <td style="text-align: right;"><span style="color: #3399CC">11.08 %</span></td> 
                            </tr><tr class="odd">
                                <td style="text-align: center;">3</td>
                                <td>VNX HNX</td>
                                <td style="text-align: right;">1,695.69</td>
                                <td style="text-align: right;"><span style="color: #3399CC">17.98 %</span></td> 
                            </tr>
                            <tr class="even">
                                <td style="text-align: center;">2</td>
                                <td>VNX HSX</td>
                                <td style="text-align: right;">2,763.66</td>
                                <td style="text-align: right;"><span style="color: #3399CC">11.08 %</span></td> 
                            </tr><tr class="odd">
                                <td style="text-align: center;">3</td>
                                <td>VNX HNX</td>
                                <td style="text-align: right;">1,695.69</td>
                                <td style="text-align: right;"><span style="color: #3399CC">17.98 %</span></td> 
                            </tr>
                            <tr class="even">
                                <td style="text-align: center;">2</td>
                                <td>VNX HSX</td>
                                <td style="text-align: right;">2,763.66</td>
                                <td style="text-align: right;"><span style="color: #3399CC">11.08 %</span></td> 
                            </tr><tr class="odd">
                                <td style="text-align: center;">3</td>
                                <td>VNX HNX</td>
                                <td style="text-align: right;">1,695.69</td>
                                <td style="text-align: right;"><span style="color: #3399CC">17.98 %</span></td> 
                            </tr>
                            -->
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</section>