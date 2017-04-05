<section class="grid_6">
  <div class="block-border">
    <div class="block-content fx_pdd">
      <!--h1>Database</h1-->
      <div class="infos fx_pd_bot">
        <h2 class="fx_pd_tle ">Database</h2>
      </div>
      <div class="block-controls">
       
      </div>
      <p class="grey">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, </p>
      <dl class="accordion">
        <?php
            foreach($info as $item){
                $data_type[] = $item['type'];
            }
            $data_type_uni = array_unique($data_type);
            foreach($data_type_uni as $type){
                foreach($info as $item){
                    if($item['type'] == $type){
                        $data_final[$type][] = $item;
                    }
                }
            }
            $i = 0;
            foreach($data_final as $key => $value){
                $i++;
        ?>
        <dt><span class="number"><?= $i ?></span> <?= $key ?><!--<span class="fx_right">4,883,292 <span style="color:#666666">entries</span> | <span style="color:#666666">from</span> 1960</span>--></dt>
        <dd>
        	<table width="100%">
                <?php
                    foreach($value as $row){
                ?>
            	<tr>
                	<td width="31%" class="fx_st_lst">
                        <strong>
                            <?php
                                if($row['link'] != ''){
                                    echo "<a href='".admin_url().$row['link']."'>".$row['name']."</a>";
                                }else{
                                    echo $row['name'];
                                }
                            ?>
                        </strong>
                    </td>
                    <td width="20%" class="fx_st_lst" style="text-align:right">
                        <strong>
                            <?php
                                if($row['stocks'] != 0){
                                    echo number_format($row['stocks']);
                                }else{
                                    echo 'No Data';
                                }
                            ?>
                        </strong> 
                        <?php
                            if($key != "Equities" && $key != "Commodities" && $key != "Bond"){
                                echo "Code:";
                            }else{
                                echo "Stock:";
                            }
                        ?>
                    </td>
                    <td width="1%">|</td>
                    <td width="22%" class="fx_st_lst" style="text-align:right">
                        <?php
                            if($row['name'] != 'REFERENCE' && $row['name'] != 'REFERENCES' ){
                        ?>
                        <strong>
                            <?php
                                if($row['entries'] != 0){
                                    echo number_format($row['entries']);
                                }else{
                                    echo 'No Data';
                                }
                            ?>
                        </strong> entries
                        <?php
                            }
                        ?>
                    </td>
                    <td width="1%">|</td>
                    <td width="26%" class="fx_st_lst" style="text-align:right">from 
                        <strong>
                            <?php
                                if($row['from'] != '0000-00-00' && $row['from'] != ''){
                                    echo $row['from'];
                                }else{
                                    echo 'No Data';
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
        <h2 class="fx_pd_tle ">Test</h2>
      </div>
      <div class="block-controls">
       
      </div>
      <p class="grey">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, </p>
      <dl class="accordion">
        <dt><span class="number">1</span> Statistical Properties of Assets returns<span class="fx_right">12 <span style="color:#666666">test</span> </span></dt>
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
        <dt><span class="number">2</span>The Predictability of Assets Returns<span class="fx_right">12 <span style="color:#666666">test</span> </span></dt>
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
        <dt><span class="number">3</span>Financial Markets Anomalies<span class="fx_right">12 <span style="color:#666666">test</span> </span></dt>
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
        <dt><span class="number">4</span>Event-Study Analysis<span class="fx_right">12 <span style="color:#666666">test</span> </span></dt>
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
        <dt><span class="number">5</span>Market Microstructure<span class="fx_right">12 <span style="color:#666666">test</span> </span></dt>
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
        <dt><span class="number">6</span>The Capital Asset Pricing Model<span class="fx_right">12 <span style="color:#666666">test</span> </span></dt>
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
        <dt><span class="number">7</span>Multifactor Pricing Models<span class="fx_right">12 <span style="color:#666666">test</span> </span></dt>
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
        <dt><span class="number">8</span>Portfolio Performance Evaluation<span class="fx_right">12 <span style="color:#666666">test</span> </span></dt>
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
        <dt><span class="number">9</span>Nonlinearities in Financial Data<span class="fx_right">12 <span style="color:#666666">test</span> </span></dt>
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
        <dt><span class="number">10</span> Data handling : High Frequency, Missing and Non Synchronous Data in Finance<span class="fx_right">12 <span style="color:#666666">test</span> </span></dt>
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
        <dt><span class="number">11</span>Derivatives (Options and Futures) Pricing<span class="fx_right">12 <span style="color:#666666">test</span> </span></dt>
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