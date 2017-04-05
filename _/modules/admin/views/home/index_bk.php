<style type="text/css">
.font_device{
    font-size:12px;
    font-family: Arial,Helvetica,sans-serif;
}
</style>
<section class="grid_6">
    <div class="block-border">
        <div class="block-content fx_pdd">
            <!--h1>Database</h1-->
            <div class="infos fx_pd_bot">
                <h2 class="fx_pd_tle ">Database</h2>
            </div>
            <div class="block-controls">

            </div>
            <p class="grey"> </p>
            <table width="100%" class="br_top_frst_tab">
                <thead>
                    <tr>
                        <th width="35" class="th_frst_tab_home" style="text-align:left; padding-left:30px;">Title</th>
                        <th width="20" class="th_frst_tab_home" style="text-align:right; padding-right:20px;">Codes</th>
                        <th width="25" class="th_frst_tab_home" style="text-align:right; padding-right:20px;">Entries</th>
                        <th width="20" class="th_frst_tab_home" style="text-align:right; padding-right:10px;">From</th>
                    </tr>
                </thead>
            </table>
            <dl class="accordion">
            	
                <?php
                $group_id = $this->ion_auth->get_users_groups($this->ion_auth->user()->row()->user_id)->row()->id;
                foreach ($info as $item) {
                    $data_type[] = $item['type'];
                }
                $data_type_uni = array_unique($data_type);
                foreach ($data_type_uni as $type) {
                    foreach ($info as $item) {
                        if ($item['type'] == $type) {
                            $data_final[$type][] = $item;
                        }
                    }
                }
                $i = 0;
                foreach ($data_final as $key => $value) {
                    $i++;
                    /* search index having max entries */
                    $max_entries = $value[0]['entries'];
                    $max_key = 0;
                    foreach ($value as $k => $item) {
                        if($max_entries < $item['entries']) {
                            $max_entries = $item['entries'];
                            $max_key = $k;
                        }
                    }
                    ?>
                    <dt>
                    	<span class="number"><?php echo $i; ?></span>
                        <table width="95%" cellpadding="0" cellspacing="0" class="head_tab">
                          <thead>
                            <tr>
                              <th width="25%" style="text-align:left"><?= $key; ?></th>
                              <th width="20%" style="text-align:right; padding-right:0px"><?= number_format($value[$max_key]['stocks']); ?></th>
                              <th width="28.5%" style="text-align:right; padding-right:0px"><?= number_format($value[$max_key]['entries']); ?></th>
                              <th width="20.5%" style="text-align:right; padding-right:-10px"><?= str_replace('/','-',$value[$max_key]['from']); ?></th>
                            </tr>
                          </thead>
                        </table>
                    </dt>
                    <dd>
                        <table width="100%">
                            <?php
                            foreach ($value as $row) {
                                ?>
                                <tr>
                                    <td width="25%" class="fx_st_lst font_device">
                                        <strong>
                                            <?php
                                            if (check_service($group_id, $listServicesUser, 'admin')==FALSE) {
                                                $row['link']='';
                                            }
                                            if ($row['link'] != '') {
                                                echo "<a href='" . admin_url() . $row['link'] . "' class='fx_size'>" . $row['name'] . "</a>";
                                            } else {
                                                echo "<span class='fx_size'>" . $row['name'] . "</span>";
                                            }
                                            ?>
                                        </strong>
                                    </td>
                                    <td width="14%" class="fx_st_lst font_device" style="text-align:right">
                                        <?php
                                        if ($key != "Equities" && $key != "Commodities" && $key != "Bond") {
                                            //echo "Code:";
                                        } else {
                                            //echo "Stock:";
                                        }
                                        ?>
                                        <strong>
                                            <?php
                                            if ($row['stocks'] != 0) {
                                                echo number_format($row['stocks']);
                                            } else {
                                                echo '--';
                                            }
                                            ?>
                                        </strong>
                                    </td>
                                    <td width="1%">|</td>
                                    <td width="21%" class="fx_st_lst font_device" style="text-align:right">
                                        <?php
                                        if ($row['name'] != 'REFERENCE' && $row['name'] != 'REFERENCES') {
                                            ?>
                                            
                                            <strong>
                                                <?php
                                                if ($row['entries'] != 0) {
                                                    echo number_format($row['entries']);
                                                } else {
                                                    echo '--';
                                                }
                                                ?>
                                            </strong> 
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td width="1%">|</td>
                                    <td width="15%" class="fx_st_lst font_device" style="text-align:right">
                                        
                                        <strong>
                                            <?php
                                            if ($row['from'] != '0000-00-00' && $row['from'] != '') {
                                                $row['from'] = str_replace('/', '-', $row['from']);
                                                echo $row['from'];
                                            } else {
                                                echo '--';
                                            }
                                            ?>
                                        </strong>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </dd>
                    <?php
                }
                ?>
            </dl>
        </div>
    </div>
</section>

<section class="grid_6">
    <div class="block-border">
        <div class="block-content fx_pdd">
            <!--h1>Database</h1-->
            <div class="infos fx_pd_bot">
                <h2 class="fx_pd_tle ">Tests</h2>
            </div>
            <div class="block-controls">

            </div>
            <p class="grey"> </p>
            <dl class="accordion">
                <dt><span class="number">1</span> Statistical Properties of Assets returns<span class="fx_right">12 <span style="color:#666666">tests</span> </span></dt>
                <dd>
                    <table width="100%">
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Normality</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Linearity</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Independence</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>iid (Independence and identically distributed)</strong></td>

                        </tr>
                    </table>
                </dd>
                <dt><span class="number">2</span>The Predictability of Assets Returns<span class="fx_right">12 <span style="color:#666666">tests</span> </span></dt>
                <dd>
                    <table width="100%">
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Normality</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Linearity</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Independence</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>iid (Independence and identically distributed)</strong></td>

                        </tr>
                    </table>
                </dd>
                <dt><span class="number">3</span>Financial Markets Anomalies<span class="fx_right">12 <span style="color:#666666">tests</span> </span></dt>
                <dd>
                    <table width="100%">
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Normality</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Linearity</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Independence</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>iid (Independence and identically distributed)</strong></td>

                        </tr>
                    </table>

                </dd>
                <dt><span class="number">4</span>Event-Study Analysis<span class="fx_right">12 <span style="color:#666666">tests</span> </span></dt>
                <dd>
                    <table width="100%">
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Normality</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Linearity</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Independence</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>iid (Independence and identically distributed)</strong></td>

                        </tr>
                    </table>
                </dd>
                <dt><span class="number">5</span>Market Microstructure<span class="fx_right">12 <span style="color:#666666">tests</span> </span></dt>
                <dd>
                    <table width="100%">
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Normality</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Linearity</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Independence</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>iid (Independence and identically distributed)</strong></td>

                        </tr>
                    </table>
                </dd>
                <dt><span class="number">6</span>The Capital Asset Pricing Model<span class="fx_right">12 <span style="color:#666666">tests</span> </span></dt>
                <dd>
                    <table width="100%">
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Normality</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Linearity</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Independence</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>iid (Independence and identically distributed)</strong></td>

                        </tr>
                    </table>
                </dd>
                <dt><span class="number">7</span>Multifactor Pricing Models<span class="fx_right">12 <span style="color:#666666">tests</span> </span></dt>
                <dd>
                    <table width="100%">
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Normality</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Linearity</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Independence</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>iid (Independence and identically distributed)</strong></td>

                        </tr>
                    </table>
                </dd>
                <dt><span class="number">8</span>Portfolio Performance Evaluation<span class="fx_right">12 <span style="color:#666666">tests</span> </span></dt>
                <dd>
                    <table width="100%">
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Normality</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Linearity</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Independence</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>iid (Independence and identically distributed)</strong></td>

                        </tr>
                    </table>
                </dd>
                <dt><span class="number">9</span>Nonlinearities in Financial Data<span class="fx_right">12 <span style="color:#666666">tests</span> </span></dt>
                <dd>
                    <table width="100%">
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Normality</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Linearity</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Independence</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>iid (Independence and identically distributed)</strong></td>

                        </tr>
                    </table>
                </dd>
                <dt><span class="number">10</span> Data handling : High Frequency, Missing and Non Synchronous Data in Finance<span class="fx_right">12 <span style="color:#666666">tests</span> </span></dt>
                <dd>
                    <table width="100%">
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Normality</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Linearity</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Independence</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>iid (Independence and identically distributed)</strong></td>

                        </tr>
                    </table>
                </dd>
                <dt><span class="number">11</span>Derivatives (Options and Futures) Pricing<span class="fx_right">12 <span style="color:#666666">tests</span> </span></dt>
                <dd>
                    <table width="100%">
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Normality</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Linearity</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>Independence</strong></td>

                        </tr>
                        <tr>
                            <td class="fx_pd_tble_right"><strong>iid (Independence and identically distributed)</strong></td>

                        </tr>
                    </table>
                </dd>
            </dl>
        </div>
    </div>
</section>