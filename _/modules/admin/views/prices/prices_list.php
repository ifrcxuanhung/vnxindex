<style type="text/css">
.dataTables_scrollHeadInner{
        background: -moz-linear-gradient(center top , #CCCCCC, #A4A4A4) repeat scroll 0 0 transparent;
    border-color: white #999999 #828282 #DDDDDD;
    border-style: solid;
    border-width: 1px;
    color: white;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.7);
}
.dataTables_scrollHeadInner table{
    display: block !important;
    margin-top: -1px;
    height:38px;
}
</style>
<section class="grid_12">
    <div class="block-border">
        <form class="block-content form-table-ajax" id="" method="post" action="">
            <h1><?php trans('mn_prices'); ?></h1>

            <table id="vndb_prices_final" class="table table-prices-list table-ajax" table="vndb_prices_final" cellspacing="0" width="100%" style="display: table">
                <thead>
                    <tr>
                        <th width="7%" scope="col" sType="string" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('ticker'); ?>
                        </th>
                        <th width="7%" scope="col" sType="string" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('market'); ?>
                        </th>
                        <th width="12%" scope="col" sType="date" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('date') ?>
                        </th>
                        <th width="12%" scope="col" sType="numeric" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('shli') ?>
                        </th>
                        <th width="11%" scope="col" sType="numeric" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('shou') ?>
                        </th>
                        <th width="11%" scope="col" sType="numeric" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('pref') ?>
                        </th>
                        <th width="11%" scope="col" sType="numeric" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('pcei') ?>
                        </th>
                        <th width="10%" scope="col" sType="numeric" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('pflr') ?>
                        </th>
                        <th width="15%" scope="col" sType="numeric" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('popn') ?>
                        </th>
                        <th width="15%" scope="col" sType="numeric" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('phgh') ?>
                        </th>
                        <th width="15%" scope="col" sType="numeric" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('plow') ?>
                        </th>
                        <th width="15%" scope="col" sType="numeric" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('pbase') ?>
                        </th>
                        <th width="15%" scope="col" sType="numeric" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('pavg') ?>
                        </th>   
                        <th width="15%" scope="col" sType="numeric" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('pcls') ?>
                        </th> 
                        <th width="15%" scope="col" sType="numeric" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('vlm') ?>
                        </th>
                        <th width="15%" scope="col" sType="numeric" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('trn') ?>
                        </th>  
                        <th width="15%" scope="col" sType="numeric" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('last') ?>
                        </th>  
                        <th width="15%" scope="col" sType="numeric" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('adj_pcls') ?>
                        </th>
                        <th width="15%" scope="col" sType="numeric" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('adj_coeff') ?>
                        </th> 
                        <th width="15%" scope="col" sType="numeric" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('dividend') ?>
                        </th> 
                        <th width="15%" scope="col" sType="numeric" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('rt') ?>
                        </th> 
                        <th width="15%" scope="col" sType="numeric" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('rtd') ?>
                        </th> 
                        <th width="5%" scope="col" style="text-align: center"><?php trans('actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
            </table>
        </form>
    </div>
</section>