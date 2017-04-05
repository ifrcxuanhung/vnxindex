<style>
.export, .block-controls{
    margin-bottom: 0 !important;
    height: 27px;
}
.custom-btn1{
    float: right;
    margin-top: -5px;
}
ul.controls-buttons li a{
    margin: 0px;
}
</style>
<!--<div class="title_stk"><h1></h1></div>--> 	
<article class="">
    <section class="grid_5" id="ref">
        <div class="block-border">
            <form class="block-content form" id="table_form" method="post" action="">
                <h1><?php trans('References'); ?></h1>
                <ul class="custom-btn1 controls-buttons">
                        <li><a style="cursor: pointer" action="export" table="vndb_reference_final" ids="<?php echo $ref[0]['id']; ?>"><?php trans('btn_export'); ?></a></li>
                </ul>
                <div class="no-margin">
                    <table id="vndb_references_final" class="table no-margin sortable" cellspacing="0" width="100%" height="100" style="display: table">
                        <thead>
                            <tr>
                                <th width="20%" scope="col" sType="string"><?php trans('name_column'); ?><span class="column-sort"> <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a> <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a> </span></th>
                                <th width="20%" scope="col" sType="string"><?php trans('Detail'); ?><span class="column-sort"> <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a> <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a> </span> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (is_array($ref)) { ?>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('date'); ?></td>
                                    <td style="text-align: left; width: 20%;"><?php echo $ref[0]['date']; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('ticker'); ?></td>
                                    <td style="text-align: left; width: 20%;"><span class="with-tip" title="<?php echo $info['en_name']; ?>"><?php echo $ref[0]['ticker']; ?></span></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('name'); ?></td>
                                    <td style="text-align: left; width: 20%;"><?php echo $info['en_name']; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('market'); ?></td>
                                    <td style="text-align: left; width: 20%;"><?php echo $ref[0]['market']; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('industry'); ?></td>
                                    <td style="text-align: left; width: 20%;"><?php echo $info['industry']; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('ipo'); ?></td>
                                    <td style="text-align: left; width: 20%;"><?php echo $info['ipo']; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('ipo_shares'); ?></td>
                                    <td style="text-align: left; width: 20%;"><?php echo normalFormat($info['ipo_shares']); ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('ftrd'); ?></td>
                                    <td style="text-align: left; width: 20%;"><?php echo $info['ftrd']; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('shli'); ?></td>
                                    <td style="text-align: left; width: 20%;"><?php echo normalFormat($ref[0]['shli']); ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('shou'); ?></td>
                                    <td style="text-align: left; width: 20%;"><?php echo normalFormat($ref[0]['shou']); ?></td>
                                </tr>
								<tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('free_float'); ?></td>
                                    <td style="text-align: left; width: 20%;"><?php echo $ref[0]['value'] . '%'; ?></td>
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
    <section class="grid_7" id="div">
        <div class="block-border">
            <form class="block-content form" id="table_form" method="post" action="">
                <h1><?php trans('Dividends'); ?></h1>
                <?php
                    if(!empty($div)){
                        $ids = '';
                        foreach($div as $item){
                            if($ids == ''){
                                $ids = $item['id'];
                            }else{
                                $ids .= ',' . $item['id'];
                            }
                        }
                    }
                ?>
                <ul class="custom-btn1 controls-buttons">
                        <li><a style="cursor: pointer" action="export" table="vndb_dividends_final" ids="<?php echo $ref[0]['id']; ?>"><?php trans('btn_export'); ?></a></li>
                </ul>
                <div class="no-margin">
                    <table id="table-dividends" class="table sortable2 no-margin" cellspacing="0" width="100%" style="display: table">
                        <thead>
                            <tr>
                                <th sClass="string" scope="col" sType="formatted-num" bSortable="true" style="text-align: right;">
                                    <?php trans('date_ann'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th sClass="string" scope="col" sType="formatted-num" bSortable="true" style="text-align: right;">
                                    <?php trans('date_rec'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th sClass="string" scope="col" sType="formatted-num" bSortable="true" style="text-align: right;">
                                    <?php trans('date_pay'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th sClass="string" scope="col" sType="formatted-num" bSortable="true" style="text-align: right;">
                                    <?php trans('date_ex'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th sClass="string" scope="col" sType="formatted-num" bSortable="true" style="text-align: right;">
                                    <?php trans('pay_met'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th sClass="numeric" scope="col" sType="formatted-num" bSortable="true" style="text-align: right;">
                                    <?php trans('pay_yr'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th sClass="numeric" scope="col" sType="formatted-num" bSortable="true" style="text-align: right;">
                                    <?php trans('pay_per'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th sClass="numeric" scope="col" sType="formatted-num" bSortable="true" style="text-align: right;">
                                    <?php trans('dividends'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th sClass="string" scope="col" sType="formatted-num" bSortable="true" style="text-align: right;">
                                    <?php trans('yield'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (is_array($div)) {
                                foreach ($div as $item) {
                                    ?>
                                    <tr>
                                        <td><?php echo $item['date_ann']; ?></td>
                                        <td><?php echo $item['date_rec']; ?></td>
                                        <td><?php echo $item['date_pay']; ?></td>
                                        <td><?php echo $item['date_ex']; ?></td>
                                        <td><?php echo $item['pay_met']; ?></td>
                                        <td><?php echo $item['pay_yr']; ?></td>
                                        <td><?php echo $item['pay_per']; ?></td>
                                        <td><?php echo normalFormat($item['dividend']); ?></td>
                                        <td><?php echo is_numeric($item['yield']) ? number_format($item['yield'], 2) : $item['yield']; ?></td>
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
    <section class="grid_12" id="cp">
        <div class="block-border">
            <form class="block-content form" id="table_form" method="post" action="">
                <h1><?php trans('Corporate Actions'); ?></h1>
                <?php
                    if(!empty($cpa)){
                        $ids = '';
                        foreach($div as $item){
                            if($ids == ''){
                                $ids = $item['id'];
                            }else{
                                $ids = ',' . $item['id'];
                            }
                        }
                    }
                ?>
                <ul class="custom-btn1 controls-buttons">
                        <li><a style="cursor: pointer" action="export" table="vndb_cpaction_final" ids="<?php echo $ref[0]['id']; ?>"><?php trans('btn_export'); ?></a></li>
                </ul>
                <div class="no-margin">

                    <table id="vndb_cpaction_final" class="table sortable2 no-margin vndb_cpaction_final" page="vndb_page" tab="vndb_cpaction" pagination="false" cellspacing="0" width="100%" style="display: table">
                        <thead>
                            <tr>
                                <th sName="evtname" sClass="string" scope="col" sType="string" bSortable="true" style="text-align: left;">
                                    <?php trans('evtname'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th sName="date_ann" sClass="string" scope="col" sType="numeric" bSortable="true" style="text-align: right;">
                                    <?php trans('date_ann'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th sName="date_ex" sClass="string"scope="col" sType="numeric" bSortable="true" style="text-align: right;">
                                    <?php trans('date_ex'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th sName="date_eff" sClass="string" scope="col" sType="formatted-num" bSortable="true" style="text-align: right;">
                                    <?php trans('date_eff'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th sName="ratio" sClass="string" scope="col" sType="numeric" bSortable="true" style="text-align: right;">
                                    <?php trans('ratio'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th sName="sharestype" sClass="numeric" scope="col" sType="numeric" bSortable="true" style="text-align: right;">
                                    <?php trans('sharestype'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th sName="sharesbef" sClass="numeric" scope="col" sType="numeric" bSortable="true" style="text-align: right;">
                                    <?php trans('sharesbef'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th sName="sharesadd" sClass="numeric" scope="col" sType="numeric" bSortable="true" style="text-align: right;">
                                    <?php trans('sharesadd'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th sName="sharesaft" sClass="numeric" scope="col" sType="numeric" bSortable="true" style="text-align: right;">
                                    <?php trans('sharesaft'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th sName="pref" sClass="numeric" scope="col" sType="numeric" bSortable="true" style="text-align: right;">
                                    <?php trans('pref'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th sName="eprice" sClass="numeric" scope="col" sType="numeric" bSortable="true" style="text-align: right;">
                                    <?php trans('eprice'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th sName="prv_close" sClass="numeric" scope="col" sType="numeric" bSortable="true" style="text-align: right;">
                                    <?php trans('prv_close'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th sName="right" sClass="numeric" scope="col" sType="numeric" bSortable="true" style="text-align: right;">
                                    <?php trans('right'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th sName="adjclose" sClass="numeric" scope="col" sType="numeric" bSortable="true" style="text-align: right;">
                                    <?php trans('adjclose'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th sName="adjcoeff" sClass="numeric" scope="col" sType="numeric" bSortable="true" style="text-align: right;">
                                    <?php trans('adjcoeff'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                            </tr><div style="clear: both">&nbsp;</div>
                        </thead>
                        <tbody>
                            <?php
                            if (is_array($cpa)) {
                                // pre($cpa);die();
                                foreach ($cpa as $item) {
                                    ?>
                                    <tr>
                                        <td><?php echo $item['evtname']; ?></td>
                                        <td><?php echo $item['date_ann']; ?></td>
                                        <td><?php echo $item['date_ex']; ?></td>
                                        <td><?php echo $item['date_eff']; ?></td>
                                        <td><?php echo $item['ratio']; ?></td>
                                        <td><?php echo normalFormat($item['sharestype']); ?></td>
                                        <td><?php echo normalFormat($item['sharesbef']); ?></td>
                                        <td><?php echo normalFormat($item['sharesadd']); ?></td>
                                        <td><?php echo normalFormat($item['sharesaft']); ?></td>
                                        <td><?php echo normalFormat($item['pref']); ?></td>
                                        <td><?php echo normalFormat($item['eprice']); ?></td>
                                        <td><?php echo normalFormat($item['prv_close']); ?></td>
                                        <td><?php echo normalFormat($item['right']); ?></td>
                                        <td><?php echo normalFormat($item['adjclose']); ?></td>
                                        <td><?php echo normalFormat($item['adjcoeff']); ?></td>
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
                <h1><?php trans('prices'); ?></h1>
                <div class="no-margin">

                    <table id="vndb_prices_final" class="table table-prices-list table-ajax" table="vndb_prices_final" pagination="false" page="vndb_page" tab="vndb_prices" cellspacing="0" width="100%" style="display: table">
                        <thead>
                            <tr>
                                <th width="7%" scope="col" sType="string" bSortable="true">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    <?php trans('ticker'); ?>
                                </th>
                                <th width="7%" scope="col" sType="string" bSortable="true">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    <?php trans('market'); ?>
                                </th>
                                <th width="12%" scope="col" sType="date" bSortable="true">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    <?php trans('date') ?>
                                </th>
                                <th width="12%" scope="col" sType="numeric" bSortable="true">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    <?php trans('shli') ?>
                                </th>
                                <th width="11%" scope="col" sType="numeric" bSortable="true">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    <?php trans('shou') ?>
                                </th>
                                <th width="11%" scope="col" sType="numeric" bSortable="true">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    <?php trans('pref') ?>
                                </th>
                                <th width="11%" scope="col" sType="numeric" bSortable="true">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    <?php trans('pcei') ?>
                                </th>
                                <th width="10%" scope="col" sType="numeric" bSortable="true">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    <?php trans('pflr') ?>
                                </th>
                                <th width="15%" scope="col" sType="numeric" bSortable="true">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    <?php trans('popn') ?>
                                </th>
                                <th width="15%" scope="col" sType="numeric" bSortable="true">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    <?php trans('phgh') ?>
                                </th>
                                <th width="15%" scope="col" sType="numeric" bSortable="true">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    <?php trans('plow') ?>
                                </th>
                                <th width="15%" scope="col" sType="numeric" bSortable="true">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    <?php trans('pbase') ?>
                                </th>
                                <th width="15%" scope="col" sType="numeric" bSortable="true">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    <?php trans('pavg') ?>
                                </th>   
                                <th width="15%" scope="col" sType="numeric" bSortable="true">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    <?php trans('pcls') ?>
                                </th> 
                                <th width="15%" scope="col" sType="numeric" bSortable="true">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    <?php trans('vlm') ?>
                                </th>
                                <th width="15%" scope="col" sType="numeric" bSortable="true">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    <?php trans('trn') ?>
                                </th>  
                                <th width="15%" scope="col" sType="numeric" bSortable="true">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    <?php trans('last') ?>
                                </th>  
                                <th width="15%" scope="col" sType="numeric" bSortable="true">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    <?php trans('adj_pcls') ?>
                                </th>
                                <th width="15%" scope="col" sType="numeric" bSortable="true">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    <?php trans('adj_coeff') ?>
                                </th> 
                                <th width="15%" scope="col" sType="numeric" bSortable="true">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    <?php trans('dividend') ?>
                                </th> 
                                <th width="15%" scope="col" sType="numeric" bSortable="true">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    <?php trans('rt') ?>
                                </th> 
                                <th width="15%" scope="col" sType="numeric" bSortable="true">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    <?php trans('rtd') ?>
                                </th> 
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </section>
    <section class="grid_12">
        <div class="block-border">
            <form class="block-content form" id="table_form" method="post" action="">
                <h1><?php trans('news'); ?></h1>
                <div class="no-margin">

                    <table id="vndb_news_day_final" class="table table-prices-list table-ajax" table="vndb_news_day_final" cellspacing="0" width="100%" style="display: table">
                        <thead>
                            <tr>
                                <th width="7%" scope="col" sType="string" bSortable="true">
                                    <?php trans('ticker'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th width="5%" scope="col" sType="string" bSortable="true">
                                    <?php trans('market'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th width="7%" scope="col" sType="date" bSortable="true">
                                    <?php trans('date_ann') ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th width="13%" scope="col" sType="string" bSortable="true">
                                    <?php trans('news_type'); ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th width="26%" scope="col" sType="numeric" bSortable="true">
                                    <?php trans('evname') ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                                <th width="" scope="col" sType="numeric" bSortable="true">
                                    <?php trans('content') ?>
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </section>
    <div class="clear"></div>    
    <div id="event-dialog" style="font-size: 14px"></div>
</article>
