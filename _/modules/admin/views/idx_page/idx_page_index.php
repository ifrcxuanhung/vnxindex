<!--<div class="title_stk"><h1></h1></div>-->
<article class="">
    <!--section class="grid_12" id="specs">
      <div class="block-border">
        <form class="block-content form" id="table_form" method="post" action="">
          <h1><?php echo ($ref[0]['idx_name_sn2'] != false) ? $ref[0]['idx_name_sn2'] : NULL; ?></h1>
          <div class="no-margin">

            <table class="table sortable no-margin" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th scope="col" sType="numeric" bSortable="true" style="text-align: left; width: 10%;">
    <?php echo trans('last'); ?>
                      <span class="column-sort">
                          <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                          <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                      </span>
                  </th>
                  <th width="15%" scope="col" sType="numeric" bSortable="true" style="text-align: left;">
    <?php echo trans('%var'); ?>
                      <span class="column-sort">
                          <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                          <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                      </span>
                  </th>
                  <th width="10%" scope="col" sType="string" bSortable="true" style="text-align: right;">
    <?php echo trans('pclose'); ?>
                      <span class="column-sort">
                          <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                          <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                      </span>
                  </th>
                  <th scope="col" sType="numeric" bSortable="true" style="text-align: left; width: 10%;">
    <?php echo trans('change'); ?>
                      <span class="column-sort">
                          <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                          <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                      </span>
                  </th>
                  <th width="10%" scope="col" sType="string" bSortable="true" style="text-align: right;">
    <?php echo trans('%dvar'); ?>
                      <span class="column-sort">
                          <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                          <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                      </span>
                  </th>
                  <th width="15%" scope="col" sType="string" bSortable="true" style="text-align: right;">
    <?php echo trans('time'); ?>
                      <span class="column-sort">
                          <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                          <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                      </span>
                  </th>
                </tr>
              </thead>
              <tbody>
    <?php
    if (is_array($specs)) {
        foreach ($specs as $item) {
            $change = $item['idx_last'] - $item['idx_pclose'];
            ?>
                        <tr>
                          <td width="10%" style="text-align: left; vertical-align: middle;"><strong><?php echo number_format($item['idx_last'], 2); ?></strong></td>
                          <td width="30%" style="text-align: left; vertical-align: middle; <?php echo highlight_number($item['idx_var']); ?>"><?php echo number_format($item['idx_var'] * 100); ?></td>
                          <td width="10%" style="text-align: right; vertical-align: middle;"><?php echo number_format($item['idx_pclose']); ?></td>
                          <td width="10%" style="text-align: left; vertical-align: middle; <?php echo highlight_number($change); ?>"><?php echo number_format($change, 2); ?></td>
                          <td width="10%" style="text-align: right; vertical-align: middle; <?php echo highlight_number($item['idx_dvar']); ?>"><?php echo number_format($item['idx_dvar'] * 100); ?></td>
                          <td width="10%" style="text-align: right; vertical-align: middle;"><?php echo $item['times']; ?></td>
                        </tr>
            <?php
        }
    }
    ?>

              </tbody>
            </table>
          </div>
        </form>
      </div>
    </section-->
    <section class="grid_5" id="ref">
        <div class="block-border">
            <form class="block-content form" id="table_form" method="post" action="">
                <h1><?php trans('Idx_ref'); ?></h1>

                <div class="no-margin">
                    <table class="table sortable no-margin" cellspacing="0" width="100%" height="100">
                        <thead>
                            <tr>
                                <th width="20%" scope="col" sType="string" bSortable="true"><?php trans('idx_ref'); ?><span class="column-sort"> <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a> <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a> </span></th>
                                <th width="20%" scope="col" sType="string" bSortable="true"><?php trans('Detail'); ?><span class="column-sort"> <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a> <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a> </span> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (is_array($ref)) { ?>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('CODE'); ?></td>
                                    <td style="text-align: left; width: 20%;">
                                        <span><?php echo $ref[0]['idx_code']; ?></span>
                                        <ul id="history" code='<?php echo $ref[0]['idx_code']; ?>' class="keywords" style='cursor: pointer; float: right;' onclick="window.location.href=$admin_url + 'idx_history/index/<?php echo $ref[0]['idx_code']; ?>'">
                                            <li><?php trans('bt_history'); ?></li>
                                        </ul>
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('CURRENCY'); ?></td>
                                    <td style="text-align: left; width: 20%;"><?php echo $ref[0]['idx_curr']; ?></td>

                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('BASE'); ?></td>
                                    <td style="text-align: left; width: 20%;"><?php echo $ref[0]['idx_base']; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('DATE_BASE'); ?></td>
                                    <td style="text-align: left; width: 20%;">
                                        <span><?php echo $ref[0]['idx_dtbase']; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('TYPE'); ?></td>
                                    <td style="text-align: left; width: 20%;"><?php echo $ref[0]['idx_type']; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('MOTHER'); ?></td>
                                    <td style="text-align: left; width: 20%;"><a href="<?php echo admin_url(); ?>idx_page/index/<?php echo $ref[0]['idx_mother']; ?>"><?php echo $ref[0]['idx_mother'] . ' (' . $ref[0]['idx_name_sn'] . ')'; ?></a></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('CATEGORY'); ?></td>
                                    <td style="text-align: left; width: 20%;"><?php echo $ref[0]['idx_bbs']; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('CONSTITUENTS'); ?></td>
                                    <td style="text-align: left; width: 20%;"><?php echo $const; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('LINKED_INDEXES'); ?></td>
                                    <td style="text-align: left; width: 20%;">
                                        <span><?php echo $linked; ?></span>
                                        <ul id="info" code='<?php echo $ref[0]['idx_mother']; ?>' class="keywords" style='cursor: pointer; float: right;'>
                                            <li><?php trans('bt_info'); ?></li>
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
    <section class="grid_7">
        <div class="block-border">
            <form class="block-content form" id="table_form" method="post" action="">
                <h1><?php trans('stk_div'); ?></h1>
                <div class="no-margin">

                    <table class="table sortable no-margin" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="15%" scope="col" sType="string" bSortable="true" style="text-align: left;">
                                    <?php trans('Date'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th width="15%" scope="col" sType="string" bSortable="true" style="text-align: left;">
                                    <?php trans('stk_code'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th width="15%" scope="col" sType="formatted-num" bSortable="true" style="text-align: right;">
                                    <?php trans('stk_divnet'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th width="15%" scope="col" sType="formatted-num" bSortable="true" style="text-align: right;">
                                    <?php trans('stk_divgross'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (is_array($composition)) {
                                foreach ($composition as $item) {
                                    if ($item['code2'] != '') {
                                        ?>
                                        <tr>
                                            <td style="text-align: left;"><?php echo $item['exdate']; ?></td>
                                            <td class="with-tip" title="<?php echo $item['name1']; ?>" style="text-align: left;"><a href="<?php echo admin_url() . 'stk_page/index/' . $item['code2']; ?>"><?php echo $item['code2']; ?></a></td>
                                            <td style="text-align: right;"><?php echo number_format($item['stk_divnet']); ?></td>
                                            <td style="text-align: right;"><?php echo number_format($item['stk_divgross']); ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </section>
    <section class="grid_12">
        <div class="block-border">
            <form class="block-content form" id="table_form" method="post" action="">
                <h1><?php trans('Idx_ca'); ?></h1>
                <div class="no-margin">

                    <table class="table sortable no-margin" cellspacing="0" width="100%" height='200'>
                        <thead>
                            <tr>
                                <th width="15%" scope="col" sType="string" bSortable="true" style="text-align: left;">
                                    <?php trans('stk_code'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th width="15%" scope="col" sType="string" bSortable="true" style="text-align: right;">
                                    <?php trans('Date'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th width="15%" scope="col" sType="formatted-num" bSortable="true" style="text-align: right;">
                                    <?php trans('Shares'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th width="15%" scope="col" sType="numeric" bSortable="true" style="text-align: right;">
                                    <?php trans('Float'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th width="5%" scope="col" sType="numeric" bSortable="true" style="text-align: right;">
                                    <?php trans('Capp'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th width="25%" scope="col" sType="formatted-num" bSortable="true" style="text-align: right;">
                                    <?php trans('Adj_Close'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th width="10%" scope="col" sType="numeric" bSortable="true" style="text-align: right;">
                                    <?php trans('Intro'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (is_array($ca)) {
                                foreach ($ca as $item) {
                                    ?>
                                    <tr>
                                        <td style="text-align: left;"><a href="<?php echo admin_url() . 'stk_page/index/' . $item['stk_code']; ?>"><?php echo $item['stk_code']; ?></a></td>
                                        <td style="text-align: right;"><?php echo $item['dates']; ?></td>
                                        <td style="text-align: right;"><?php echo number_format($item['new_shares']); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($item['nxt_free_float']); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($item['nxt_capping']); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($item['adj_close']); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($item['intro']); ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </section>
    <section class="grid_12">
        <div class="block-border">
            <form class="block-content form" id="table_form" method="post" action="">
                <h1><?php trans('Idx_composition'); ?></h1>
                <div class="no-margin">

                    <table id="composition" class="table sortable no-margin export" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th scope="col" sType="string" bSortable="true" style="text-align: left; width: 10%;">
                                    <?php trans('stk_code'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <!--th width="15%" scope="col" sType="string" bSortable="true" style="text-align: left;">
                                <?php trans('stk_name'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th-->
                                <th scope="col" sType="formatted-num" bSortable="true" style="text-align: right; width: 10%;">
                                    <?php trans('price'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th width="10%" scope="col" sType="formatted-num" bSortable="true" style="text-align: right;">
                                    <?php trans('Shares'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>

                                <th width="15%" scope="col" sType="numeric" bSortable="true" style="text-align: right;">
                                    <?php trans('Capp'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>

                                <th width="25%" scope="col" sType="numeric" bSortable="true" style="text-align: right;">
                                    <?php trans('Float'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th width="10%" scope="col" sType="formatted-num" bSortable="true" style="text-align: right;">
                                    <?php trans('Market_cap'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th width="15%" scope="col" sType="numeric" bSortable="true" style="text-align: right;">
                                    <?php trans('WGT'); ?>
                                    <span class="column-sort" >
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>



                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (is_array($composition)) {
                                $temp = '';
                                foreach ($composition as $item) {
                                    if ($temp != $item['code1']) {
                                        $temp = $item['code1'];
                                        ?>
                                        <tr>
                                            <td width="10%" class="with-tip" title="<?php echo $item['name1']; ?>" style="text-align: left; vertical-align: middle;"><a href="<?php echo admin_url() . 'stk_page/index/' . $item['code1']; ?>"><?php echo $item['code1']; ?></a></td>
                                            <!--td style="text-align: left; vertical-align: middle;"><?php echo $item['name1']; ?></td-->
                                            <td width="10%" style="text-align: right; vertical-align: middle;"><?php echo number_format($item['stk_price']); ?></td>
                                            <td width="10%" style="text-align: right; vertical-align: middle;"><?php echo number_format($item['stk_shares_idx']); //number_format($item['stk_shares_idx']);  ?></td>
                                            <td width="10%" style="text-align: right; vertical-align: middle;"><?php echo number_format($item['stk_capp_idx'], $decimal['stk_capp_idx']); ?></td>
                                            <td width="10%" style="text-align: right; vertical-align: middle;"><?php echo number_format($item['stk_float_idx']); ?></td>
                                            <td width="10%" style="text-align: right; vertical-align: middle;"><?php echo number_format($item['stk_mcap_idx']); ?></td>
                                            <td width="10%" style="text-align: right; vertical-align: middle;"><?php echo number_format($item['stk_wgt'], 1); ?>0</td>

                                        </tr>
                                        <?php
                                    }
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </section>
    <div class="clear"></div>
</article>
