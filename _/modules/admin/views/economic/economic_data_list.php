<style>
    th:last-child{
        border-right: none !important;
    }
    .dataTables_scrollBody{
        height: none;
    }
</style>
<section class="grid_12">
    <div class="block-border">
        <form class="block-content form-table-ajax" id="" method="post" action="">
            <h1><?php trans('mn_Economies'); ?></h1>

            <table id="vndb_economics_data" class="sortable table table-economics-list table-ajax" scroll="scrollable" table="vndb_economics_data" cellspacing="0" width="100%" style="display: table">
                <thead>
                    <tr>
                        <th width="" scope="col" sType="numeric" bSortable="true">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('indcode') ?>
                        </th>
                        <th width="" scope="col" sType="string" bSortable="true">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('code_ctr'); ?>
                        </th>
                        <th width="" scope="col" sType="numeric" bSortable="true">
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
                            <?php trans('year') ?>
                        </th>
                        <th width="" scope="col" sType="numeric" bSortable="true">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('value') ?>
                        </th>
                        <th width="" scope="col" sType="numeric" bSortable="true">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('last_upd') ?>
                        </th>
                        <!-- <th width="5%" scope="col" style="text-align: center"><?php //trans('actions');  ?></th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($ecoms)) {                        
                        foreach ($ecoms as $ecom) {
                            ?>                        
                            <tr>
                                <td><?= $ecom['indcode'] ?></td>
                                <td><?= $ecom['code_ctr'] ?></td>
                                <td><?= $ecom['name'] ?></td>
                                <td style="text-align: right;"><?= $ecom['year'] ?></td>
                                <td style="text-align: right;"><?= $ecom['value'] ?></td>
                                <td><?= $ecom['last_upd'] ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>

                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</section>