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
    height:49px;
}
</style>
<section class="grid_12">
    <div class="block-border">
        <form class="block-content form-table-ajax" id="" method="post" action="">
            <h1><?php trans('mn_reference'); ?></h1>
          
            <table id="vndb_reference_final" class="table table-reference-list table-ajax" table="vndb_reference_final" cellspacing="0" width="100%" style="display: table">
                <thead>
                    <tr>
                        <th width="7%" scope="col" sType="string" bSortable="false">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('date'); ?>
                        </th>
                        <th width="7%" scope="col" sType="string" bSortable="false">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('ticker'); ?>
                        </th>
                        <th width="12%" scope="col" sType="string" bSortable="false">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('market') ?>
                        </th>
                        <th width="11%" scope="col" sType="string" bSortable="false">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('industry') ?>
                        </th>
                        <th width="11%" scope="col" sType="string" bSortable="false">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('sector') ?>
                        </th>
                        <th width="11%" scope="col" sType="string" bSortable="false">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('ipo') ?>
                        </th>
                        <th width="10%" scope="col" sType="string" bSortable="false">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('ipo_shli') ?>
                        </th>
                        <th width="15%" scope="col" sType="string" bSortable="false">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('ipo_shou') ?>
                        </th>
                        <th width="15%" scope="col" sType="string" bSortable="false">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('ftrd') ?>
                        </th>
                        <th width="15%" scope="col" sType="string" bSortable="false">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('ftrd_cls') ?>
                        </th>
                        <th width="15%" scope="col" sType="string" bSortable="false">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('shli') ?>
                        </th>
                        <th width="15%" scope="col" sType="string" bSortable="false">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('shou') ?>
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
