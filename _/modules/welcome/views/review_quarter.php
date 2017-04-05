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
.flexigrid .hDivBox{
    width: 100%;
}
.flexigrid div.hDiv th div{
    padding:3px 3px;
    color: yellow !important;
    font-size: 15px !important;
}
#observatoryTable{
    width: 100%;
}
#content h4 {
    color: yellow;
}
</style>

<div id="content" role="main" class="observatory-content">
    <div class="intro_copn">
        <div class="container" style="width: 40%; float: left;">
           <h3><?php trans("QUARTERLY INDEX REVIEW"); ?></h3>
           <h4 id="total_count"><?php echo $counts['count'];?> primary indexes</h4>
        </div>
        <div class="container" style="width: 18%; float: right; text-align: right;">
            <div class="box_search_obs">
                <!--**********ph?n search observatoire **********************************************-->
                <div name="search_obs">
                    
                    
                    <div class="search_element" style="font-size: 12px;">
                        <?php trans('Date'); ?>: 
                        <select name="selectDate" class="selectDate" style=" padding: 2px 5px; font-size:11px">
                           <!-- <option value="0" selected="selected" ><?php trans("ALL"); ?></option>-->
                            <?php 
							foreach ($getdates as $k=>$date) { 
								
							?>
                                <option value="<?php echo $date['reference']; ?>"><?php echo strtoupper($date['reference']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <div class="search_element">     
                        <a onclick="ifrc.searchReviewQuater()" style="cursor: pointer; display: inline-block" width="66" ><img  src="<?php echo base_url() ?>templates/images/search.png"/></a>
                       
                    </div>

                </div>
                <!--**********h?t ph?n search observatoire **********************************************-->
            </div>
        </div>
        <!-- Ket thuc container -->
        <div class="clear"></div>
        <!-- start main content -->
        <div class="observatory">
            <script>ifrc.searchReviewQuater();</script>
        </div>
        <!-- end main content -->
        <!-- ############# Ket thuc Observatory ########### -->
    </div>


</div>



