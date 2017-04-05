<style>
    .css_test {
        height: 32em !important;
    }
    div.dataTables_scroll { 
        clear: both; 
        margin-top: -1.667em;
    }
    .dataTables_scrollHeadInner{
        background: -moz-linear-gradient(center top , #B5B5B5, #757474) repeat scroll 0 0 transparent;
        border-color: white #999999 #828282 #DDDDDD;
        border-style: solid;
        border-width: 1px;
        color: white;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.7);
    }
    .dataTables_scrollHeadInner table{
        display: block !important;
        height: 50px;
        margin-top: -1px;
    }
    .tabs-content-info {
        height: auto !important;
    }

    .tabs-content {
        height: auto !important;
    }
</style>
<section class="grid_12">
    <div class="block-border">
        <form class="block-content form" id="table_form" method="post" action="">
            <h1><?php trans('mn_view') ?></h1>
            <div style="float: right; margin-right: 20px;" class="custom-btn">
                <!--button type="button" class="red" onclick="window.location='<?php echo admin_url(); ?>'"><?php trans('bt_cancel'); ?></button-->
                <div style="clear: left;"></div>
            </div>
            <div class="no-margin">
                <table class="table sortable no-margin" cellspacing="0" width="100%" footer="false" page="sysformat_showview" pagination="false" block="false">
                    <thead>
                        <tr>
                            <th width="20%" scope="col" sType="string" bSortable="true"><?php trans('table'); ?>
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                            </th>
                            <th scope="col" sType="string" bSortable="true"><?php trans('description'); ?>
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                            </th>
                            <th width="7%" scope="col" sType="string" bSortable="true"><?php trans('status'); ?>
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                            </th>
                            <th width="7%" scope="col" sType="string" bSortable="true"><?php trans('empty'); ?>
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                            </th>
                            <th width="15%" scope="col" class="table-actions" width='100'><?php trans('actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($content as $key => $value) {
                            ?>
                            <tr>
                                <td style="text-align: left; width: 20%;"><?php echo strtoupper($value['table']); ?></td>
                                <td style="text-align: left;"><?php echo $value['description']; ?></td>
                                <td style="text-align: left; width: 7%;"><?php echo $value['active']; ?></td>
                                <td style="text-align: left; width: 7%;"><?php echo $value['empty']; ?></td>
                                <td style="text-align: center; width: 15%;">
                                    <ul class="keywords">
                                        <li>
                                            <a class='action-view-all' table="<?php echo strtolower($value['table']); ?>" href='#'><?php trans('bt_view') ?></a>
                                            
                                        </li>
                                        <!--<li>
                                            <a class='action' table="<?php echo strtolower($value['table']); ?>" href='#'><?php trans('bt_view_sysformat') ?></a>
                                        </li>-->
                                    </ul>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</section>