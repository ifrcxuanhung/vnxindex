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
                        act: "getDataGlobalBoxHomeObs2",
                        name: request.term
                    },
                    success: function(data) {
                        var $data = $.parseJSON(data);
                        response($data);
                        //location.href($base_url + 'report');
                        //window.href = $base_url + 'report',;
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
.facts, .intro_map, .performance, .figures, .composition{position: relative;margin-top : 20px;}
.facts {
float: left;

}
.boxsearch, .nameindex {
    position: relative;
}
.intro_map {
float: right;
width: 60%;

}

.figures {
float:left;

}
.figures th{ 
    color: yellow !important;
    font-size: 15px !important;
}
.composition {
float:right;
margin-left: 10px;
}
.logo_index {
float:left;
margin-bottom: 10px;
}

.nameindex {
float:left;
margin:10px 10px 10px 10px;
}
.boxsearch{
    float:right;
    margin-right: 10px;
}
.performance th{ 
    color: yellow !important;
    font-size: 15px !important;
    
}
.composition th{ 
    color: yellow !important;
    font-size: 15px !important;
    
}
.ui-autocomplete {
	z-index:1000 !important;
}
.figures tr, .figures th{
    height:  26px!important;
}
.composition tr, .composition th{
    height:  25px!important;
}
.facts tr, .facts th{
    height:  24px!important;
}
</style>

<div id="content" role="main" class="observatory-content">
<?php
	foreach ($report['facts'] as $facts){
?>
    <div class="nameindex" style="color: #007dc9; font-size: 30px;font-weight: bold; float: left;"><?php echo $facts->name; ?>
        <div class="clear"></div>       
    </div>
<?php  
	} 
?>
<div style="float: right ; width:60%">
    <div class="boxsearch" style="float: right;margin-right: 0px !important;">
        <div class="search_element clear_b" style=" font-size: 15px;">
            <input type="text" placeholder="<?php trans('search'); ?>" class="q_search" style="margin-bottom:15px; font-size:14px; width:230px; height:15px;" name="q_search" onclick="this.value = ''" value=""/>
            <a onclick="ifrc.searchStockReport()" style="cursor: pointer; display: inline-block" width="66" ><img  style="height:28px; ;"src="<?php echo base_url() ?>templates/images/search.png"/></a>
            <a onclick="ifrc.resetselectrepoprt()" style="cursor: pointer; display: inline-block" width="66" ><img  src="<?php echo base_url() ?>templates/images/reset.png"/></a>
        </div>
    </div>
    <div class="clear"></div> 
</div> 
<?php
	foreach ($report['facts'] as $facts){
?>
    <!-- start company introduction  -->
    <div class="intro_copn" style="width: 97%;">        
        <h5 style="line-height: 20px!important; color:#a0a0a0"><?php echo $facts->fullname; ?></h5>
        <div class="clear"></div>        
    </div>
<?php  
	} // end foreach
?>


<div class="facts" style="width: 38%;">
<h3>Facts</h3>        

<div style="display: inline-block; width: 100%;" class="ifrc_index">
	<div class="flexigrid" style="width: auto;">
		<div class="bDiv" style="height: auto;">
			<table cellspacing="0" cellpadding="0" border="0" id="abs_global_TOP10_PERFORMANCEflexigrid" class="autoht" style="width: 100% !important;">
				<tbody>
                <?php
					foreach($report['facts'] as $facts){
				?>
                    <tr class="erow" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong>Code</strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->stk_code;?></div></td>
                    </tr>
                    <tr class="" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong>IPO</strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->ipo;?></div></td>
                    </tr>
                    <tr class="erow" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong>First traded price</strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->prices != 0 ? number_format($facts->prices,2) : '';?></div></td>
                    </tr>
                    <tr class="" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong>Exchange</strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->exchange;?></div></td>
                    </tr>
                    <tr class="erow" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong>Industry</strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->industry;?></div></td>
                    </tr>
                    
                    
				<?php 
					}
				?>
                
				</tbody>
			</table>
		</div>
	</div>
</div>        
<h3>Figures</h3>        

<div style="display: inline-block; width: 100%;" class="ifrc_index">
	<div class="flexigrid" style="width: auto;">
		<div class="bDiv" style="height: auto;">
			<table cellspacing="0" cellpadding="0" border="0" id="abs_global_TOP10_PERFORMANCEflexigrid" class="autoht" style="width: 100% !important;">
				<tbody>
                <?php
			//echo "<pre>";print_r($report['figures']);exit; 
					foreach($report['figures'] as $figures){
				?>
                    <tr class="erow" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong>Shares</strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $figures->shares != 0 ? number_format($figures->shares,0) : '';?></div></td>
                    </tr>
                    <tr class="" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong>Float (%)</strong></div></td>
                       <!--koco--> <td align="right"><div style="text-align: left; width: 170px;"><?php echo $figures->ff;?></div></td>
                    </tr>
                    <tr class="erow" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong>Capitalization</strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $figures->capi != 0 ? number_format($figures->capi,0) : '';?></div></td>
                    </tr>
                    <tr class="" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong>% capitalisation</strong></div></td>
                      <!--koco-->  <td align="right"><div style="text-align: left; width: 170px;"><?php echo $figures->wgt_capi != 0 ? number_format($figures->wgt_capi,6) : '';?></div></td>
                    </tr>
                    <tr class="erow" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong>Volatility (%)</strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $figures->volat != 0 ? number_format($figures->volat,2) : '';?></div></td>
                    </tr>
                    <tr class="" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong>Beta</strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $figures->beta != 0 ? number_format($figures->beta,2) : '';?></div></td>
                    </tr>
                    <tr class="erow" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong>Dividend yield (%) *</strong></div></td>
                       <!--koco--> <td align="right"><div style="text-align: left; width: 170px;"><?php echo $figures->di_yi != 0 ? number_format(100*($figures->di_yi),2) : '';?></div></td>
                    </tr>
                    <tr class="" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong>Turnover *</strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $figures->turn != 0 ? number_format($figures->turn,0) : '';?></div></td>
                    </tr>
                    <tr class="erow" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong>Trading ratio (%)*</strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $figures->trading;?></div></td>
                    </tr>
                    <tr class="" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong>Velocity (%)*</strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $figures->velocity;?></div></td>
                    </tr>
				<?php 
					}
				?>
                
				</tbody>
			</table>
		</div>
	</div>
     <h6 style="color: #93999d; font-size: 11px!important; position:absolute; bottom:-14px; right:10px;  margin-top:-3px;">* 12 last months</h6>
    <div style=" position:absolute; bottom:-14px; left:2px; margin-top:-3px;"> Last update: <span style="color:#FF0; font-size: 11px!important;"><?php echo $report['figures'][0]->date;?></span> </div>
      
</div>
<div class="clear"></div>       
</div>
<div class="intro_map">      
<div id="popular_posts-3" class="widget widget_popular_posts">
        
         <?php echo $compare_chart3; ?>
    </div>
<div class="clear"></div>       
</div>

<div class="performance">        
<div style="display: inline-block;width: 100%; margin-top:20px;" class="ifrc_index">
	<div class="flexigrid" style="width: auto;">
		<div class="hDiv">
			<div class="hDivBox">
				<table cellspacing="0" cellpadding="0">
					<thead>
					<tr>
					<th align="left" colspan="3"><div style="text-align: left; width: 145px; margin-top: 4px;" class="sundefined"><h3>Performance</h3></div></th>
					<th align="left" colspan="3"><div style="text-align: right; width: 350px; margin-top: 6px; margin-left: 23px;" class="sundefined"><h4>Performance %</h3></div></th>
					<th align="left" colspan="3"><div style="text-align: center; width: 310px; margin-top: 6px; margin-left: 23px;" class="sundefined"><h4>Dividend Yield %</h3></div></th>									
					</tr>
					<tr>
					<th align="right" axis="col1"><div style="text-align: right; width: 15px;" class="sundefined"></div></th>
					<th align="right" axis="col1"><div style="text-align: left; width: 60px;" class="sundefined"><strong>Year</strong></div></th>
					<th align="right" axis="col1"><div style="text-align: center; width: 96px;" class="sundefined"><strong>Year date</strong></div></th>
					<th align="right" axis="col1"><div style="text-align: right; width: 110px;" class="sundefined"><strong>Close **</strong></div></th>
					<th align="right" axis="col1"><div style="text-align: right; width: 150px;" class="sundefined"><strong>Company</strong></div></th>
					<th align="right" axis="col1"><div style="text-align: right; width: 150px;" class="sundefined"><strong>Sector ***</strong></div></th>
					<th align="right" axis="col1"><div style="text-align: right; width: 150px;" class="sundefined"><strong>Vietnam ****</strong></div></th>
					<th align="right" axis="col1"><div style="text-align: right; width: 150px;" class="sundefined"><strong>Company</strong></div></th>
					<th align="right" axis="col1"><div style="text-align: right; width: 150px;" class="sundefined"><strong>Sector **</strong></div></th>
					<th align="right" axis="col1"><div style="text-align: right; width: 150px;" class="sundefined"><strong>Vietnam ****</strong></div></th>				
					</tr>
					</thead>
				</table>
			</div>
		</div>
		
		<div class="bDiv" style="height: auto; width: 100%;">
			<table cellspacing="0" cellpadding="0" border="0" id="" class="autoht" style=" width: 100%;">
				<tbody>
					<?php
					$i = 1; 
						foreach($report['performance'] as $performance){
					?>
						<tr class="<?php if($i % 2 != 0) echo 'erow'?>" id="row7034">
							<td align="right"><div style="text-align: left; width: 15px;"></div></td>
							<td align="right"><div style="text-align: left; width: 60px;"><?php echo $performance->year;?></div></td>
							<td align="right"><div style="text-align: center; width: 96px;"><?php echo $performance->date;?></div></td>
							<td align="right"><div style="text-align: right; width: 110px;"><?php echo number_format($performance->adjclose,2);?></div></td>
							<td align="right"><div style="text-align: right; width: 150px; color:  <?php echo $performance->rt < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo $performance->rt != 0 ? number_format(100*($performance->rt),2) : '';?></div></td>
							<td align="right"><div style="text-align: right; width: 150px; color:  <?php echo $performance->rt_ind < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo $performance->rt_ind != 0 ? number_format(100*($performance->rt_ind),2) : '';?></div></td>
							<td align="right"><div style="text-align: right; width: 150px; color:  <?php echo $performance->rt_all < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo $performance->rt_all != 0 ? number_format(100*($performance->rt_all),2) : '';?></div></td>
							<td align="right"><div style="text-align: right; width: 150px; color:  <?php echo $performance->di_yi < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo $performance->di_yi != 0 ? number_format(100*($performance->di_yi),2) : '';?></div></td>
							<td align="right"><div style="text-align: right; width: 150px; color:  <?php echo $performance->di_yi_ind < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo $performance->di_yi_ind != 0 ? number_format(100*($performance->di_yi_ind),2) : '';?></div></td>
							<td align="right"><div style="text-align: right; width: 150px; color:  <?php echo $performance->di_yi_all < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo $performance->di_yi_all != 0 ? number_format(100*($performance->di_yi_all),2) : '';?></div></td>
						</tr>
							<?php 
							$i++;
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
    <table style="width: 100%;">
        <tr>
            <td style="width: 40%; text-align: left;"><h6 style="color: #93999d; font-size: 11px!important;">** Adjusted close</h6> </td>
            <td style="width: 60%; text-align: right;"><h6 style="color: #93999d; font-size: 11px!important;">
                *** <?php
					foreach($report['sector'] as $sector){
					   echo $sector->idx_name;
					   }
				?>
                
                 &nbsp; &nbsp; **** VNX All Share index</h6> </td> 
        </tr>
    </table>
      
</div>
<div class="clear"></div>       
</div>

<div class="figures" style="width: 38%; margin-top: 0px!important;">        
<h3>Membership</h3>        
<div style="display: inline-block; width: 100%;" class="ifrc_index">
	<div class="flexigrid" style="width: auto;width: 100%;">
        <div class="hDiv" style="width: 100%;">
			<div class="hDivBox" style="width: 100%;">
				<table cellspacing="0" cellpadding="0"  style="width: 100%;">
					<thead style="width: 100%;">
					<tr>
					<th align="right" axis="col1" style="text-align: left; width: 75%;" class="sundefined">Index Name</th>
					<th align="right" axis="col1" style="text-align: right; width: 20%;" class="sundefined">Weight %</th>
    	               <th align="right" axis="col1" style="text-align: right; width: 5%;" class="sundefined">Info</th>
					</tr>
					</thead>
				</table>
			</div>
		</div>
		<div class="bDiv" style="height: auto;">
			<table cellspacing="0" cellpadding="0" border="0" id="abs_global_TOP10_PERFORMANCEflexigrid" class="autoht" style="width: 100% !important;">
				<tbody>
				<?php
				$i = 1; 
					foreach($report['membership'] as $membership){
				?>
					<tr class="<?php if($i % 2 != 0) echo 'erow'?>" id="row7034">
						<td align="right"><div style="text-align: left; width: 75%;"><strong><?php echo $membership->stk_name;?></strong></div></td>
						<td align="right"><div style="text-align: right ;width: 20%; color:  <?php echo $membership->stk_wgt < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo $membership->stk_wgt !=0? number_format($membership->stk_wgt,2):'-'; echo ($membership->stk_wgt == ' Volatility' || $membership->stk_wgt == ' Tracking error') ? '%' : '';?></div></td>
                        <td align="right" style="text-align: right; width: 5%;">
                               <div >
                                   <a style="cursor:pointer" href="<?php echo base_url(); ?>report/<?php  echo $newformat;?>/<?php echo $membership->idx_code; ?>">
                                   <img style="text-align: right;" src="<?php echo base_url(); ?>templates/images/more.png"/></a>
                               </div>
                            </td>
                    </tr>
						<?php 
						$i++;
					}
				?>
				</tbody>
			</table>
            
		</div>
	</div>
</div>
<div class="last_update" style=" position:absolute; bottom:-20px; left:10px;">Last update: <span style="color:yellow;"><?php echo $last_get_report['date'];?></span></div>
<div class="clear"></div>       
</div>

<div class="composition" style="margin-top: 0px!important; width:60%;">        
<h3>Competitors (Top 10)</h3>        
<div style="display: inline-block; width:100%;" class="ifrc_index">
	<div class="flexigrid" style="width: auto;">
		<div class="hDiv">
			<div class="hDivBox">
				<table cellspacing="0" cellpadding="0">
					<thead>
					<tr>
					<th align="left" axis="col1"><div style="text-align: left; width: 60px;" class="sundefined"><strong>Code</strong></div></th>
					<th align="left" axis="col2"><div style="text-align: left; width: 340px;" class=""><strong>Name</strong></div></th>
					<th align="right" axis="col3"><div style="text-align: right; width: 80px;" class=""><strong>Capi. (Bn)</strong></div></th>
					<th align="right" axis="col4"><div style="text-align: right; width: 80px;" class=""><strong>MTD %</strong></div></th>
                    <th align="right" axis="col4"><div style="text-align: right; width: 80px;" class=""><strong>YTD %</strong></div></th>
					<th align="right" axis="col4"><div style="text-align: right; width: 70px;" class=""><strong>Info</strong></div></th>
                    </tr>
					</thead>
				</table>
			</div>
		</div>
		
		<div class="bDiv" style="height: auto;">
			<table cellspacing="0" cellpadding="0" border="0" id="" class="autoht">
				<tbody>
					<?php
					$i = 1; 
						foreach($report['competitor'] as $competitor){
					?>
						<tr class="<?php if($i % 2 != 0) echo 'erow'?>" id="row7034">
							
							<td align="left"><div style="text-align: left; width: 60px;"><strong><?php echo $competitor->code;?></strong></div></td>
							<td align="left"><div style="text-align: left; width: 340px;"><?php echo $competitor->name;?></div></td>
							<td align="right"><div style="text-align: right; width: 80px;"><?php echo number_format($competitor->capi/1000000000,0);?></div></td>
							<td align="right"><div style="text-align: right; width: 80px; color: <?php echo $competitor->mtd < 0 ? "#ff492a" : "#92dd4b"; ?>;;"><?php echo number_format(100*($competitor->mtd),2);?></div></td>
                            <td align="right"><div style="text-align: right; width: 80px;color:  <?php echo $competitor->ytd < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo number_format(100*($competitor->ytd),2);?></div></td>
                            <td align="right">
                               <div style="text-align: right; width: 68px;">
                                   <a style="cursor:pointer" href="<?php echo base_url(); ?>report_stock/<?php  echo $competitor->code ?>">
                                   <img src="<?php echo base_url(); ?>templates/images/more.png"/></a>
                               </div>
                            </td>
						</tr>
							<?php 
							$i++;
						}
					?>
				</tbody>
			</table>
            <input type="hidden" name="stock_code" id="stock_code" value="<?php echo $stock_code ?> " />
		</div>
	</div>
</div>
<div class="clear"></div>       
</div>  
</div>




