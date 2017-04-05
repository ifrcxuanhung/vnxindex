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
            <h1><?php trans('mn_indexlist'); ?></h1>
            <button style="position: absolute; right: 20px; top: 5px;" type="button" class="" onclick="window.location = '<?php base_url() . 'backend/indexlist' ?>'">ALL</button>
            <button style="position: absolute; right: 100px; top: 5px;" type="button" class="action-query">QUERY</button>                
                
            <ul class="tabs js-tabs mini-tabs">
                <li class="current"><a href="#tabs-indexes"><span style="vertical-align: top"><?php trans('indexes_list'); ?></span></a></li>
                <li><a href="#tabs-performance"><span style="vertical-align: top"><?php trans('performance_ranking '); ?></span></a></li>
            </ul>
            <div id="tabs-indexes">
                <table id="table-indexes" class="table sortable no-margin" cellspacing="0" style="width:100% !important; margin-top: -20px !important;">
                    <thead>
                        <tr>
                            <th style="width:300px"  scope="col" bSortable="true">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('index'); ?>
                            </th>
                            <th scope="col" bSortable="true" style="text-align: right;">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('close'); ?>
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
                    <?php
                    $i = 1;
                        foreach($indexes as $index)
                        {
                            $link_index = admin_url() . 'indexlist/detail/' . $index['CODE'];
                    ?>
                        <tr <?php echo $i++ % 2 == 0 ? "class='odd'" : "class='even'" ?>>
                            <td><a href="<?php echo $link_index ?>" target="_blank"><?php echo $index['SHORTNAME'] ?></a></td> 
                            <td style="text-align: right;"><?php echo number_format($index['close'], 2,'.', ',') ?></td>
                            <td style="text-align: right;"><span style="color: <?php echo $index['dvar'] < 0 ? "#ff492a" : "#3399CC"; ?>"><?php echo $index['close'] == 0 ? "n.a." : number_format($index['dvar'], 2) . " %"; ?></span></td>
                        </tr>
                    <?php
                        }
                    ?>
                         
                    </tbody>
                </table>
            </div>
            <div id="tabs-performance">
                <table class="table sortable no-margin" cellspacing="0" style="width:100% !important; margin-top: -20px !important;"  id="mod_news">
                    <thead>
                        <tr>
                            <th scope="col" width="" bSortable="true">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('nr'); ?>
                            </th>
                            <th scope="col" width="300px" bSortable="true">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('index'); ?>
                            </th>
                            <th scope="col" width="" bSortable="true" style="text-align: right;">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('close'); ?>
                            </th>
                            <th scope="col" width="" bSortable="true" style="text-align: right;">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('month%'); ?>
                            </th>
                            <th scope="col" width="" bSortable="true" style="text-align: right;">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('year%'); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            foreach($performances as $performance)
                            {
                                $link_index = admin_url() . 'indexlist/detail/' . $performance['CODE'];
                        ?>
                            <tr <?php echo $i % 2 == 0 ? "class='odd'" : "class='even'" ?>>
                                <td style="text-align: center;"><?php echo $i ?></td>
                                <td><a target="_blank" href="<?php echo $link_index ?>"><?php echo $performance['SHORTNAME'] ?></a></td>
                                <td style="text-align: right;"><?php echo number_format($performance['close'], 2,'.', ',') ?></td>
                                <td style="text-align: right;"><span style="color: <?php echo $performance['varmonth'] < 0 ? "#790000" : "#3399CC"; ?>"><?php echo number_format($performance['varmonth'], 2, '.', ','); ?> %</span></td>
                                <td style="text-align: right;"><span style="color: <?php echo $performance['varyear'] < 0 ? "#790000" : "#3399CC"; ?>"><?php echo number_format($performance['varyear'], 2, '.', ','); ?> %</span></td> 
                            </tr>
                        <?php
                            $i++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</section>