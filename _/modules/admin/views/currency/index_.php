<section class="grid_4">
    <div class="block-border">
        <div class="block-content">
            <h1><?php trans('mn_currency'); ?></h1>
            <div class="block-controls">
                <ul class="controls-buttons">
                    <li></li>
                    <li></li>
                </ul>
            </div>
            <ul id="menu" class="collapsible-list with-bg">
                <li class="closed list_help article-detail" id="idx_currency_day">
                    <b class="toggle"></b>
                    <span><a href="JavaScript: void(0)">idx_currency_day</a></span>
                </li>
                <li class="closed list_help article-detail" id="idx_currency_month">
                    <b class="toggle"></b>
                    <span><a href="JavaScript: void(0)">idx_currency_month</a></span>
                </li>
                <li class="closed list_help article-detail" id="idx_currency_year">
                    <b class="toggle"></b>
                    <span><a href="JavaScript: void(0)">idx_currency_year</a></span>
                </li>
            </ul>
        </div>
    </div>
</section>
<section id="reponse-detail" class="grid_8 <?= $table ?>" style="display: none;">
    <div class="block-border">
        <form class="block-content form-table-ajax" id="" method="POST" action="">
            <h1 id="title-currency"></h1>
                <table class="table table-ajax" id="idx-currency" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="25%" cope="col" sType="string" bSortable="true">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('code'); ?>
                            </th>
                            <th width="25%" scope="col" sType="string" bSortable="true">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('date'); ?>
                            </th>
                            <th scope="col" sType="string" bSortable="true">
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
</section>
<section id="currency-detail" class="grid_12" style="display: none; margin-top:10px">
    <div class="block-border">
        <form class="block-content form-table-ajax" id="" method="POST" action="">
        <h1 id="title-currency2"></h1>
        <table class="table table-ajax" id="idx-currency2" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="25%" cope="col" sType="string" bSortable="true">
                        <span class="column-sort">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                        </span>
                        <?php trans('curr_code'); ?>
                    </th>
                    <th width="25%" scope="col" sType="string" bSortable="true">
                        <span class="column-sort">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                        </span>
                        <?php trans('curr_name'); ?>
                    </th>
                    <th scope="col" sType="string" bSortable="true">
                        <span class="column-sort">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                        </span>
                        <?php trans('domain'); ?>
                    </th>
                    <th scope="col" sType="string" bSortable="true">
                        <span class="column-sort">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                        </span>
                        <?php trans('country'); ?>
                    </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        </form>
    </div>
</section>
<section id="compare-currency" class="grid_12" style="display: none; margin-top:10px">
    <div class="block-border">
        <form class="block-content form-table-ajax" id="" method="POST" action="">
        <h1 id="title-currency3"></h1>
        <table class="table table-ajax" id="idx-currency3" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="25%" cope="col" sType="string" bSortable="true">
                        <span class="column-sort">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                        </span>
                        <?php trans('from_curr'); ?>
                    </th>
                    <th width="25%" scope="col" sType="string" bSortable="true">
                        <span class="column-sort">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                        </span>
                        <?php trans('compare_curr'); ?>
                    </th>
                    <th width="25%" scope="col" sType="string" bSortable="true">
                        <span class="column-sort">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                        </span>
                        <?php trans('close'); ?>
                    </th>
                    <th width="25%" scope="col" sType="string" bSortable="true">
                        <span class="column-sort">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                        </span>
                        <?php trans('date'); ?>
                    </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        </form>
    </div>
</section>