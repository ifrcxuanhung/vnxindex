<style type="text/css">
#content h3 {color : #FF0000;}
#content h4 {color : #C82828;}
.facts td.name {background-color: #3399FF; padding:3px;}
.performance table thead th, .composition table thead th{
text-align:left;
border:1px;
}
.performance{position: relative;margin-top : 20px;}
.facts {
float: left;
}
.flexigrid div.hDiv th div{
    padding:3px 3px;
    color: yellow !important;
    font-size: 15px !important;
}
#tabs_ob_Daily{
    width: 99%;
}
#tabs_ob_Daily ul{
    width: 100%;
}
</style>
<div id="content" role="main" class="observatory-content">
    <div class="intro_copn">
        <div id="tabs_global">
         <h3><?php trans("report_market_month"); ?></h3>
         <div class="box_search_obs" style="width: 60%; float: right; text-align: right;">
            <div name="search_obs" style="float: right; text-align: right;">
                <div class="search_element" style="font-size: 12px;">
                    <?php trans('Date'); ?>: 
                    <select name="selectDate" class="selectDate" style=" padding: 2px 5px; font-size:11px">
                        <!--<option value="0" selected="selected" ><?php trans("ALL"); ?></option>-->
                        <?php foreach ($getdate['date'] as $date) { ?>
                            <option value="<?php echo $date->date; ?>"><?php echo strtoupper($date->date); ?></option>
                        <?php } ?>
                    </select>
                </div>
    
                <div class="search_element" style="font-size: 12px;">
                    <?php trans('Exchange'); ?>: 
                    <select name="selectProvider" class="selectProvider" style=" padding: 2px 5px;font-size:11px">
                        <option value="0" selected="selected" ><?php trans("ALL"); ?></option>
                        <?php foreach ($getexchange['exchange'] as $getexchange) { ?>
                            <option value="<?php echo $getexchange->exchange; ?>"><?php echo strtoupper($getexchange->exchange); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="search_element">     
                    <a onclick="ifrc.searchRpmarketmonthserch()" style="cursor: pointer; display: inline-block" width="66" ><img  src="<?php echo base_url() ?>templates/images/search.png" /></a>
                    <a onclick="ifrc.resetselectmkmonth()" style="cursor: pointer; display: inline-block" width="66" ><img  src="<?php echo base_url() ?>templates/images/reset.png"/></a>
                </div> 
            </div>
    </div>
            
        <div id="tabs_detail_ob">
            <ul>
                <li><a tabid="0" name="" href="#tabs_ob_Daily"><?php trans('Performances'); ?></a></li>
                <li><a tabid="1" name="" href="#tabs_ob_Daily2"><?php trans('Risk & Liquidity'); ?></a></li>
            </ul>
    
            <div  id="tabs_ob_Daily" class="searchRpmarketmonthnull">
                <div class="observatory">
                    <script>ifrc.searchRpmarketmonthnull();</script>
                </div>
                
            </div>
    
            <div id="tabs_ob_Daily2" class="searchRpmarketmonthnull_new">
                 <div class="observatory_new" style="color: #fff; margin-top: 10px;">
                <script>ifrc.searchRpmarketmonthnull_new();</script>
                 </div>
            </div>
    
            
        </div>
        
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#tabs_detail_ob').tabs({
            activate: function(e, ui) {
                console.log(e);
            }
        });
        $('#tabs_global').fadeIn();
        $('#tabs_detail_ob').css({'width': '99%'});
       // $('#tabs_ob_Constituents').css({'width': '99%'});
       // $('#tabs_ob_Rules').css({'width': '99%'});
        //$('#tabs_ob_Publications').css({'width': '99%'});
    });

    //ifrc.loadcompo('', 0);

</script>

