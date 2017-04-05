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
    height:26px;
}
</style>
<section class="grid_12">
    <div class="block-border">
        <form class="block-content form-table-ajax" id="" method="post" action="">
            <h1><?php trans('mn_fundamental'); ?></h1>

            <table id="vndb_fundamental" class="table table-fundamental-list table-ajax" table="vndb_fundamental" cellspacing="0" width="100%" style="display: table">
                <thead>
                    <tr>
                        <th width="7%" scope="col" sType="numeric" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('ticker'); ?>
                        </th>
                        <th width="12%" scope="col" sType="numeric" bSortable="true">
                            
                            <?php trans('date') ?>
                        </th>
                        <th width="11%" scope="col" sType="string" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('code_data') ?>
                        </th>
                        <th width="11%" scope="col" sType="string" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('year') ?>
                        </th>
                        <th width="10%" scope="col" sType="string" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('fvalue') ?>
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
