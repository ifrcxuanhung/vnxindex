<script>
    $(document).ready(function() {
        var href2 = $(location).attr('href');
        href2 = ifrc.explode('#', href2);
        if (href2[1]) {
            ifrc.showDetailOb(href2[1]);
        }
        $('.q_search').focus(function() {
            ifrc.resetselect();
        });

        $(".q_search").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: $base_url + 'ajax',
                    type: 'POST',
                    data: {
                        act: "getDataGlobalBoxHomeObs1",
                        name: request.term
                    },
                    success: function(data) {
                        var $data = $.parseJSON(data);
                        response($data);
                    }
                });
            },
            minLength: 2
        });
    });
</script>



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
#content h4 {
    color: yellow;
}
</style>

<div id="content" role="main" class="observatory-content">
    <div class="intro_copn">
        <div class="container" style="width: 40%; float: left;">
           <h3><?php trans("daily_indexes_report"); ?></h3>
          <h4 id="total_count"></h4>
        </div>
        <div class="container" style="width: 60%; float: right; text-align: right;">
            <div class="box_search_obs">
                <!--**********ph?n search observatoire **********************************************-->
                <div name="search_obs">
                     <div class="search_element" style="font-size: 12px;">
                     <?php trans('search'); ?>:
                         <input type="text" placeholder="<?php trans('search'); ?>" class="q_search" style=" padding: 2px 5px;font-size:11px;width:170px; height:15px;" name="q_search" onclick="this.value = ''" value=""/>
                    </div>
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
                        <?php trans('Provider'); ?>:
                        <select name="selectProvider" class="selectProvider" style=" padding: 2px 5px;font-size:11px">
                            <option value="0" selected="selected" ><?php trans("ALL"); ?></option>
                            <?php foreach ($getprovider['provider'] as $getprovider) { ?>
                                <option value="<?php echo $getprovider->provider; ?>"><?php echo strtoupper($getprovider->provider); ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="search_element" style="font-size: 12px;">
                        <?php trans('Currency'); ?>:
                        <select name="selectCurr" class="selectCurr" style=" padding: 2px 5px; font-size:11px">
                            <!--<option value="0" selected="selected" ><?php trans("VND"); ?></option>-->
                            <?php foreach ($getcurrency['curr'] as $curr) { ?>
                                <option value="<?php echo $curr->curr; ?>"><?php echo strtoupper($curr->curr); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="search_element" style="font-size: 12px;">
                        <?php trans('PR/TR'); ?>:
                        <select name="selectPrtr" class="selectPrtr" >
                           <!-- <option value="0" selected="selected" ><?php trans("ALL"); ?></option>-->
                            <?php foreach ($getPRTR['PRTR'] as $getPRTR) { ?>
                                <option value="<?php echo $getPRTR->idx_type; ?>"><?php echo strtoupper($getPRTR->PRTR); ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="search_element">
                        <a onclick="ifrc.searchRpnull()" style="cursor: pointer; display: inline-block" width="66" ><img  src="<?php echo base_url() ?>templates/images/search.png"/></a>
                        <a onclick="ifrc.resetselect1()" style="cursor: pointer; display: inline-block" width="66" ><img  src="<?php echo base_url() ?>templates/images/reset.png"/></a>
                        <!--<a onclick="ifrc.searchRpnull()" style="cursor: pointer; display: inline-block" width="66" ><span class="label label-sm label-danger">Go</span></a>
                        <a onclick="ifrc.resetselect1()" style="cursor: pointer; display: inline-block" width="66" ><span class="label label-sm label-danger">Reset</span></a>-->
                    </div>

                </div>
                <!--**********h?t ph?n search observatoire **********************************************-->
            </div>
        </div>
        <!-- Ket thuc container -->
        <div class="clear"></div>
        <!-- start main content -->
        <div class="observatory">
            <script>ifrc.searchRpnull();</script>
        </div>
        <!-- end main content -->
        <!-- ############# Ket thuc Observatory ########### -->
    </div>


</div>



