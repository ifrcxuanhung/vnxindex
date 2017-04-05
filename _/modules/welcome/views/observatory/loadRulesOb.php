<div style="background-color:1px dotted #CCCCCC; width:100%;">
    <!-- End composition -->
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tbody>
            <tr>
                <td width="70%">
                    <table width="100%" class="format-table">
                        <tr style="height: 20px;">
                            <td height="20px" width="35%">&nbsp;<b><?php trans('Description'); ?></b></td>
                            <td height="20px" width="65%">&nbsp;<b><?php trans('Information'); ?></b></td>
                        </tr>
                        <tr class="odd">
                            <td width="35%">&nbsp;<a class="getarticle pointer"><?php trans('Full name'); ?></a></td>
                            <td width="65%"><?php echo $data['NAME'] ?></td>
                        </tr>
                        <tr>
                            <td width="35%">&nbsp;<a class="getarticle pointer"><?php trans('Short name'); ?></a></td>
                            <td width="65%"><?php echo $data['SHORTNAME'] ?></td>
                        </tr>
                        <tr class="odd" >
                            <td width="35%">&nbsp;<a class="getarticle pointer"><?php trans('Price or Total Return'); ?></a></td>
                            <td width="72%"><?php
                                if ($data['PRICE'] != '') {
                                    trans('PRICE_' . $data['PRICE']);
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <td width="35%">&nbsp;<a class="getarticle pointer"><?php trans('Currency'); ?></a></td>
                            <td width="65%"><?php echo $data['CURR'] ?></td>
                        </tr>
                        <tr class="odd" >
                            <td width="35%">&nbsp;<a class="getarticle pointer"><?php trans('Constituents number'); ?></a></td>
                            <td width="65%"><?php trans($data['NB']); ?></td>
                        </tr>
                        <tr>
                            <td width="35%">&nbsp;<a class="getarticle pointer"><?php trans('Weighting'); ?></a></td>
                            <td width="65%"><?php
                                if ($data['WEIGHTING'] != '') {
                                    trans('WEIGHTING_' . $data['WEIGHTING']);
                                }
                                ?></td>
                        </tr>
                        <tr class="odd" >
                            <td width="35%">&nbsp;<a class="getarticle pointer"><?php trans('Calculation frequency'); ?></a></td>
                            <td width="65%">
                                <?php
                                if ($data['FREQUENCY'] != '') {
                                    trans('FREQUENCY_' . $data['FREQUENCY']);
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <td width="35%">&nbsp;<a class="getarticle pointer"><?php trans('Capping'); ?></a></td>
                            <td width="65%">
                                <?php
                                if ($data['CAPPING'] != '') {
                                    trans($data['CAPPING']);
                                }
                                ?></td>
                        </tr>
                        <tr class="odd" >
                            <td width="35%">&nbsp;<a class="getarticle pointer"><?php trans('Qualification criteria'); ?></a></td>
                            <td width="65%"><?php
                                if ($data['CRITERIA'] != '') {
                                    trans('CRITERIA_' . $data['CRITERIA']);
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <td width="35%">&nbsp;<a class="getarticle pointer"><?php trans('Composition review'); ?></a></td>
                            <td width="65%"><?php
                                if ($data['REV_COMPO'] != '') {
                                    trans('REV_COMPO_' . $data['REV_COMPO']);
                                }
                                ?></td>
                        </tr>
                        <tr class="odd" >
                            <td width="35%">&nbsp;<a class="getarticle pointer"><?php trans('Shares review'); ?></a></td>
                            <td width="65%"><?php
                                if ($data['SHARES'] != '') {
                                    trans('SHARES_' . $data['SHARES']);
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <td width="35%">&nbsp;<a class="getarticle pointer"><?php trans('Free float review'); ?></a></td>
                            <td width="65%"><?php
                                if ($data['REV_FLOAT'] != '') {
                                    trans('REV_FLOAT_' . $data['REV_FLOAT']);
                                }
                                ?></td>
                        </tr>
<!--			<tr class="odd" >
                            <td width="35%">&nbsp;<a class="getarticle pointer">xoa <?php trans('Fast exit and entry'); ?></a></td>
                            <td width="65%"></td>
                        </tr>-->
                        <tr class="odd" >
                            <td width="35%">&nbsp;<a class="getarticle pointer"><?php trans('Free float banding'); ?></a></td>
                            <td width="65%"><?php
                                if ($data['ARR_FLOAT'] != '') {
                                    trans('ARR_FLOAT_' . $data['ARR_FLOAT']);
                                }
                                ?></td>
                        </tr>
<!--			<tr class="odd" >
                            <td width="35%">&nbsp;<a class="getarticle pointer">xoa<?php trans('Corporate actions'); ?></a></td>
                            <td width="65%"></td>
                        </tr>-->
<!--			<tr>
                            <td width="35%">&nbsp;<a class="getarticle pointer">xoa<?php trans('IPO inclusion'); ?></a></td>
                            <td width="65%"></td>
                        </tr>-->
                        <tr>
                            <td width="35%">&nbsp;<a class="getarticle pointer"><?php trans('Futures products'); ?></a></td>
                            <td width="65%"><?php trans($data['FUTURES']); ?></td>
                        </tr>
                        <tr class="odd" >
                            <td width="35%">&nbsp;<a class="getarticle pointer"><?php trans('Options products'); ?></a></td>
                            <td width="65%"><?php trans($data['OPTIONS']); ?></td>
                        </tr>
                        <tr>
                            <td width="35%">&nbsp;<a class="getarticle pointer"><?php trans('ETF products'); ?></a></td>
                            <td width="65%"><?php trans($data['ETF']); ?></td>
                        </tr>
                        <!--<tr class="odd" >
                            <td width="35%">&nbsp;<a class="getarticle pointer"><?php trans('Closing mechanism'); ?></a></td>
                            <td width="65%"></td>
                        </tr>-->
                        <tr class="odd" >
                            <td width="35%">&nbsp;<a class="getarticle pointer"><?php trans('Base value'); ?></a></td>
                            <td width="65%"><?php trans($data['BASE_VALUE']); ?></td>
                        </tr>
                        <tr>
                            <td width="35%">&nbsp;<a class="getarticle pointer"><?php trans('Base capitalisation'); ?></a></td>
                            <td width="65%"><?php trans($data['BASE_CAPI']); ?></td>
                        </tr>
                        <tr class="odd" >
                            <td width="35%">&nbsp;<a class="getarticle pointer"><?php trans('Base date'); ?></a></td>
                            <td width="65%"><?php trans($data['BASE_DATE']); ?></td>
                        </tr>
                        <tr>
                            <td width="35%">&nbsp;<a class="getarticle pointer"><?php trans('Historical since'); ?></a></td>
                            <td width="65%"><?php trans($data['HISTORY']); ?></td>
                        </tr>
                        <tr class="odd" >
                            <td width="35%">&nbsp;<a class="getarticle pointer"><?php trans('Launching date'); ?></a></td>
                            <td width="65%"><?php trans($data['LAUNCH']); ?></td>
                        </tr>
                        <tr>
                            <td width="35%">&nbsp;<?php trans('Website'); ?></td>
                            <td width="65%">
                                <?php
                                if ($data['WEBSITE'] != '') {
                                    $www = explode('/', $data['WEBSITE']);
                                    /* Tien moi them */
                                    if ($www[0] == 'http:' || $www[0] == 'https:') {
                                        $link = $data['WEBSITE'];
                                        $linkDisplay = $www[2];
                                    } else {
                                        $link = 'http://' . $data['WEBSITE'];
                                        $linkDisplay = $www[0];
                                    }
                                    /* end */
                                    ?>
                                                                                        <!--<a target="_blank" style="color:#4098f0" href="<?php echo $data['WEBSITE']; ?>"><?php echo $www['2']; ?></a>-->
                                    <a target="_blank" style="color:#4098f0" href="<?php echo $link ?>"><?php echo $linkDisplay; ?></a>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="30%" valign="top" >
                    <div style="margin-left:10px;">
                        <table width="100%" cellspacing="0" class="format-table" cellpadding="0"  border="0">
                            <tr style="height: 20px;">
                                <td height="20px" width="28%">&nbsp;<?php trans('CODE'); ?></td>
                                <td height="20px" width="72%">&nbsp;<?php echo $data['CODE'] ?></td>
                            </tr>
                            <tr class="odd" >
                                <td width="28%">&nbsp;<?php trans('ISIN'); ?></td>
                                <td width="72%">&nbsp;<?php echo $data['ISIN'] ?></td>
                            </tr>
                            <tr>
                                <td width="28%">&nbsp;<?php trans('Reuters'); ?></td>
                                <td width="72%">&nbsp;<?php
                                    if ($data['REUTERS'] != '') {
                                        echo '<a style="color:#4098f0" href="' . $config['idx_reuters'] . $data['REUTERS'] . '" target="_blank" >' . $data['REUTERS'] . '</a>';
                                    }
                                    ?></td>
                            </tr>
                            <tr class="odd" >
                                <td width="28%">&nbsp;<?php trans('Bloomberg'); ?></td>
                                <td width="72%">&nbsp;<?php
                                    if ($data['BLOOMBERG'] != '') {
                                        echo '<a style="color:#4098f0" href="' . $config['idx_bloomberg'] . $data['BLOOMBERG'] . ':IND" target="_blank" >' . $data['BLOOMBERG'] . '</a>';
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <td width="28%">&nbsp;<?php trans('Yahoo'); ?></td>
                                <td width="72%">&nbsp;<?php
                                    if ($data['YAHOO'] != '') {
                                        echo '<a style="color:#4098f0" href="' . $config['idx_yahoo'] . $data['YAHOO'] . '" target="_blank" >' . $data['YAHOO'] . '</a>';
                                    }
                                    ?></td>
                            </tr>
                            <tr class="odd" >
                                <td width="28%">&nbsp;<?php trans('Google'); ?></td>
                                <td width="72%">&nbsp;<?php
                                    if ($data['GOOGLE'] != '') {
                                        echo '<a style="color:#4098f0" href="' . $config['idx_google'] . $data['GOOGLE'] . '" target="_blank" >' . $data['GOOGLE'] . '</a>';
                                    }
                                    ?></td>
                            </tr>
                        </table>
                    </div>
                    <div style="margin-left:10px;">
                        <div class="table_linked">
                            <table width="100%" class="format-table"  cellspacing="0" cellpadding="0"  border="0">
                                <tr style="height:20px; font-weight:bold;">
                                    <td height="20px" colspan="2" >&nbsp;<?php trans('LINKED INDEXES'); ?></td>
                                </tr>
                                <?php
                                $i = 0;
                                if ($data['LINKED']) {
                                    foreach ($data['LINKED'] as $v) {
                                        $color = '';
                                        if ($i % 2 == 0) {
                                            $color = 'odd';
                                        }
                                        ?>
                                        <tr class="<?php echo $color; ?>" >
                                            <td colspan="2" >&nbsp;<a href="<?php echo base_url() . 'observatory/index/' . $v['CODE']; ?>"style="color:#4098f0" target="_blank"><?php echo $v['SHORTNAME'] ?></a></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>