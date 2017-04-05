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
    height:25px;
}
</style>
<section class="grid_12" id="currency-main">
    <div class="block-border">
        <form class="block-content form-table-ajax" id="" method="post" action="">
            <h1><?php trans('mn_currency'); ?></h1>
            <table id="vndb_currency_ref" class="table table-currency-list table-ajax" table="vndb_currency_ref" cellspacing="0" width="100%" style="display: table">
                <thead>
                    <tr>
                        <th width="5%" scope="col" sType="string" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('curr_code') ?>
                        </th>
                        <th width="15%" scope="col" sType="numeric" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('curr_name'); ?>
                        </th>
                        <th width="5%" scope="col" sType="string" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('domain'); ?>
                        </th>
                        <th width="5%" scope="col" sType="string" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('country') ?>
                        </th>
                        <th width="5%" scope="col" sType="string" bSortable="true">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            <?php trans('compare') ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </form>
    </div>
</section>
<section id="compare-currency" class="grid_12" style="display: none;">
    <div class="block-border" style="float:left; width:100%">
        <div id="tab-global" class="tabs-content" style="width:44.8%;float:left; margin-right:20px; position:relative">
            <div style="position:absolute; top:5px; right:5%;"><button class="blue" id="export">Export</button></div>
            <div id="select_current" style="position:absolute; top:7px; right:20%;" class="form"></div>
            <ul class="tabs js-tabs same-height">
                <li><a href="#day" class="get_table" id="vndb_currency_day">Day</a></li>
                <li><a href="#month" class="get_table" id="vndb_currency_month">Month</a></li>
                <li><a href="#year" class="get_table" id="vndb_currency_year">Year</a></li>
            </ul>
            <div class="tabs-content">
                <div id="day" class="css_test">
                    <form class="block-content form-table-ajax" id="" method="POST" action="">
                    <table class="table table-ajax" id="currency_day" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="25%" scope="col" sType="string" bSortable="true">
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                    <?php trans('date'); ?>
                                </th>
                                <th width="25%" cope="col" sType="string" bSortable="true">
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                    <?php trans('currency'); ?>
                                </th>
                                <th width="25%" scope="col" sType="string" bSortable="true">
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                    <?php trans('close'); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    </form>
                </div>
                <div id="month" class="css_test">
                    <form class="block-content form-table-ajax" id="" method="POST" action="">
                    <table class="table table-ajax" id="currency_month" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="25%" scope="col" sType="string" bSortable="true">
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                    <?php trans('date'); ?>
                                </th>
                                <th width="25%" cope="col" sType="string" bSortable="true">
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                    <?php trans('currency'); ?>
                                </th>
                                <th width="25%" scope="col" sType="string" bSortable="true">
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                    <?php trans('close'); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    </form>
                </div>
                <div id="year" class="css_test">
                    <form class="block-content form-table-ajax" id="" method="POST" action="">
                    <table class="table table-ajax" id="currency_year" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="25%" scope="col" sType="string" bSortable="true">
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                    <?php trans('date'); ?>
                                </th>
                                <th width="25%" cope="col" sType="string" bSortable="true">
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                    <?php trans('currency'); ?>
                                </th>
                                <th width="25%" scope="col" sType="string" bSortable="true">
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                    <?php trans('close'); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <div id="chart" style="width:50%; float:left">
            <div id="container" style="width: 100%; height: 435px; margin: 0 auto"></div>
        </div>
    </div>
</section>
<style type="text/css">
    .css_test{
        height:auto !important;
    }
</style>