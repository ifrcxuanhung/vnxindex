<section class="grid_12">
    <div class="block-border">
        <form class="block-content form-table-ajax" id="" method="post" action="">
            <h1><?php trans('mn_language'); ?></h1>

            <div class="custom-btn" style="display:none;float: right; z-index: 200; position: relative;">
                <?php
                if (isset($list_category_selectbox) && is_array($list_category_selectbox)):
                    echo form_dropdown('category', unshift($list_category_selectbox, '0', 'Select categories (All) '), '', 'class="float-left margin-right padding-child-2-5"');
                endif;
                ?>
                <button onclick="$(location).attr('href','<?php echo admin_url() . 'language/add' ?>');" class="" type="button"><?php trans('bt_add'); ?></button>
                <div style="clear: left;"></div>
            </div>
            <div id="loading"><img src="<?php echo base_url() . 'assets/images/loading.gif' ;?>" /></div>
            <table class="table table-language-list table-ajax" cellspacing="0" width="100%" style="display: table">
                <thead>
                    <tr>
                        <th scope="col" sType="string" bSortable="true">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('name'); ?>
                        </th>
                        <th width="15%" scope="col" sType="string" bSortable="true">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('code') ?>
                        </th>
                        <th width="10%" scope="col" sType="string" bSortable="true">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('sort_order') ?>
                        </th>
                        <th width="10%" scope="col" sType="string" bSortable="true">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('status') ?>
                        </th>
                        <th width="15%" scope="col" class="table-actions" sType="" bSortable="false"><?php trans('actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </form>
    </div>
</section>