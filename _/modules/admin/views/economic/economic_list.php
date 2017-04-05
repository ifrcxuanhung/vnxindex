<style>
th:last-child{
    border-right: none !important;
    background-color: #A4A4A4;
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
    height:28px;
}
</style>
<section class="grid_12">
    <div class="block-border">
        <form class="block-content form-table-ajax" id="" method="post" action="">
            <h1><?php trans('mn_Economies'); ?></h1>

            <table id="vndb_economics_ref" class="sortable table table-economics-list table-ajax" pagination="false" footer="false" search="true" scroll="scrollable" table="vndb_economics_data" cellspacing="0" width="100%" style="display: table">
                <thead>
                    <tr>
                        <th width="5%" scope="col" sType="numeric" bSortable="true">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('code'); ?>
                        </th>
                        <th width="35%" scope="col" sType="string" bSortable="true">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('name'); ?>
                        </th>
                        <th width="" scope="col" sType="numeric" bSortable="true">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('info') ?>
                        </th>
                        <!-- <th width="5%" scope="col" style="text-align: center"><?php //trans('actions'); ?></th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(!empty($ecoms)){
                        foreach($ecoms as $ecom){
                            ?>                        
                    <tr>
                        <td><a href="<?= admin_url() . 'economic/data/' . $ecom['code'] ?>"><?= $ecom['code'] ?></a></td>
                        <td><?= $ecom['name'] ?></td>
                        <td><?= substr($ecom['description'], 0, 100) ?>...<a href="javascript:void(0)" content="<?= $ecom['description'] ?>" header="<?= trans('information') ?>" class="view-more">read more</a></td>
                    </tr>
                            <?php
                        }
                    }
                    ?>
                        
                    </tr>
                </tbody>
            </table>
            <div id="event-dialog" style="font-size: 14px"></div>
        </form>
    </div>
</section>