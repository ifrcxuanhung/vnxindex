<style>
#ui-datepicker-div{
    z-index: 101 !important;
}
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
            <h1><?php trans('mn_cpaction'); ?></h1>
            <div id="vndb_cpaction_final_section">
                <table id="vndb_cpaction_final" class="table table-cpaction-list table-ajax" table="vndb_cpaction_final" cellspacing="0" width="100%" style="display: table">
                    <thead>
                        <tr>
                        	<th width="12%" scope="col" sType="string" bSortable="true">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                <?php trans('evtname') ?>
                            </th>
                            <th width="7%" scope="col" sType="numeric" bSortable="true">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                <?php trans('ticker'); ?>
                            </th>
                            <th width="7%" scope="col" sType="string" bSortable="true">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                <?php trans('market'); ?>
                            </th>
                            <th width="12%" scope="col" sType="numeric" bSortable="true">
                                
                                <?php trans('date_ex') ?>
                            </th>
                            <th width="11%" scope="col" sType="string" bSortable="true">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                <?php trans('date_eff') ?>
                            </th>
                            <th width="11%" scope="col" sType="string" bSortable="true">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                <?php trans('ratio') ?>
                            </th>
                            <th width="10%" scope="col" sType="string" bSortable="true">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                <?php trans('sharesbef') ?>
                            </th>
                            <th width="15%" scope="col" sType="string" bSortable="true">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                <?php trans('sharesadd') ?>
                            </th>
                            <th width="15%" scope="col" sType="string" bSortable="true">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                <?php trans('sharesaft') ?>
                            </th>
                            <th width="15%" scope="col" sType="string" bSortable="true">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                <?php trans('oldns') ?>
                            </th>
                            <th width="15%" scope="col" sType="string" bSortable="true">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                <?php trans('newns') ?>
                            </th>   
                            <th width="15%" scope="col" sType="string" bSortable="true">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                <?php trans('eprice') ?>
                            </th> 
                            <th width="15%" scope="col" sType="string" bSortable="true">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                <?php trans('prv_close') ?>
                            </th>
                            <th width="15%" scope="col" sType="string" bSortable="true">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                <?php trans('right') ?>
                            </th>
                            <th width="15%" scope="col" sType="string" bSortable="true">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                <?php trans('adjclose') ?>
                            </th>    
                            <th width="15%" scope="col" sType="string" bSortable="true">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                <?php trans('adjcoeff') ?>
                            </th>    
                            <th width="5%" scope="col" style="text-align: center"><?php trans('actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</section>
