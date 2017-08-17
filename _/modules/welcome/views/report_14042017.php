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
    height:  22px!important;
}
.facts tr{
    height:  22px!important;
}
.performance tr{ 
    height:  23px!important;
}
.composition tr{ 
    height:  22px!important;
}
</style>

<div id="content" role="main" class="observatory-content">
<?php
	foreach ($report['nameindex'] as $nameindex){
?>
    <div class="nameindex" style="color: #007dc9; font-size: 30px;font-weight: bold; float: left;"><?php echo $nameindex->f2;?>
        <div class="clear"></div>       
    </div>
<?php  
	} 
?>
<div style="float: right ; width:50%">
    <div class=" clear_b" style=" float:left;font-size: 15px; width:  33%; padding-top: 6px;">
    	<?php trans('Month'); ?>:
        <select name="selectMonth" class="selectMonth" style=" padding: 2px 5px; font-size:12px" id="selectMonth">
            <!--<option value="0" selected="selected" ><?php trans("ALL"); ?></option>-->
            <?php foreach ($report['month'] as $month) { ?>
                <option value="<?php echo $month->yyyymm; ?>" <?php echo ($month->yyyymm==$month_rp ? 'selected="selected"' :  '') ?>><?php echo strtoupper($month->month); ?> </option>
            <?php } ?>
        </select>
    </div>
    <div class="boxsearch" style="float: right ; width:65%">
        <div class="search_element clear_b" style=" font-size: 15px;">
            <input type="text" placeholder="<?php trans('search'); ?>" class="q_search" style="margin-bottom:15px; font-size:14px; width:230px; height:15px;" name="q_search" onclick="this.value = ''" value=""/>
            <a onclick="ifrc.searchReport()" style="cursor: pointer; display: inline-block" width="66" ><img  style="height:28px; ;"src="<?php echo base_url() ?>templates/images/search.png"/></a>
            <a onclick="ifrc.resetselectrepoprt()" style="cursor: pointer; display: inline-block" width="66" ><img  src="<?php echo base_url() ?>templates/images/reset.png"/></a>
        </div>
    </div>
    <div class="clear"></div>
</div>
<?php
	foreach ($report['description'] as $description){
?>
    <!-- start company introduction  -->
    <div class="intro_copn" style="width: 97%;">
        <h5 style="line-height: 20px!important;"><?php echo $description->description; ?></h5>
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
					<tr class="" id="row7034">						
						<td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('code'); ?></strong></div></td>
						<td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->name;?></div></td>    
					</tr>
                    <tr class="erow" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('full_name'); ?></strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->full_name;?></div></td>
                    </tr>
                    <tr class="" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('pr_tr'); ?></strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->pr_tr;?></div></td>
                    </tr>
                    <tr class="erow" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('currency'); ?></strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->currency;?></div></td>
                    </tr>
                    <tr class="" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('nb_const'); ?></strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->nb_const;?></div></td>
                    </tr>
                    <tr class="erow" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('weighting'); ?></strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->weighting;?></div></td>
                    </tr>
                    <tr class="" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('calcul_freq'); ?></strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->calcul_freq;?></div></td>
                    </tr>
                    <tr class="erow" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('capping'); ?></strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->capping;?></div></td>
                    </tr>
                    <tr class="" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('q_criteria'); ?></strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->q_criteria;?></div></td>
                    </tr>
                    <tr class="erow" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('com_review'); ?></strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->com_review;?></div></td>
                    </tr>
                    <tr class="" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('sh_review'); ?></strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->sh_review;?></div></td>
                    </tr>
                    <tr class="erow" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('ff_review'); ?></strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->ff_review;?></div></td>
                    </tr>
                    <tr class="" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('ff_banding'); ?></strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->ff_banding;?></div></td>
                    </tr>
                    <tr class="erow" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('base_vl'); ?></strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->base_vl;?></div></td>
                    </tr>
                    <tr class="" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('base_date'); ?></strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->base_date;?></div></td>
                    </tr>
                    <tr class="erow" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('historical'); ?></strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->historical;?></div></td>
                    </tr>
                    <tr class="" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('launch'); ?></strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->launch;?></div></td>
                    </tr>
                    <tr class="erow" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('inter_code'); ?></strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->inter_code;?></div></td>
                    </tr>
                    <tr class="" id="row7034">
                        <td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('blg'); ?></strong></div></td>
                        <td align="right"><div style="text-align: left; width: 170px;"><?php echo $facts->blg;?></div></td>
                    </tr>
				<?php 
					}
				?>
                
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="clear"></div>       
</div>

<div class="intro_map">      
<!-- <img alt="March 2015" src="http://localhost/vnxindex/assets/upload/Config/test.png"> -->
<?php
	foreach ($report['namemonth'] as $namemonth){
?>
<h3><?php echo $namemonth->month;?></h3> 
<?php
}
?>
<div id="popular_posts-3" class="widget widget_popular_posts">
        <?php echo $compare_chart; ?>
    </div>
<div class="clear"></div>       
</div>

<div class="performance">        
<?php if($indcur =='INDCUR'){?>
    <div style="display: inline-block;width: 100%;" class="ifrc_index">
	<div class="flexigrid" style="width: auto;">
		<div class="hDiv">
			<div class="hDivBox">
				<table cellspacing="0" cellpadding="0">
					<thead>
					<tr>
					<th  style="width: 90px;"></th>
					<th style="width: 180px;"><strong>Year</strong></th>
					<th style="width: 370px;"><strong>End Date</strong></th>
					<th style="width: 300px;"><strong>Close</strong></th>
					<th style="width: 300px;"><strong>Performance</strong></th>
                    </tr>
					</thead>
				</table>
			</div>
		</div>
		
		<div class="bDiv" style="height: auto;">
			<table cellspacing="0" cellpadding="0" border="0" id="abs_global_TOP10_PERFORMANCEflexigrid" class="autoht">
				<tbody>
					<?php
					$i = 1; 
						foreach($report['performance_cur'] as $performance){
					?>
						<tr class="<?php if($i % 2 != 0) echo 'erow'?>" id="row7034">
							<td align="right"><div style="text-align: right; width: 15px;"></div></td>
							<td align="right"><div style="text-align: center; width: 40px;"><?php echo $performance->f1;?></div></td>
							<td align="right"><div style="text-align: right; width: 100px;"><?php echo $performance->f2;?></div></td>
							<td align="right"><div style="text-align: right; width: 95px;"><?php echo number_format($performance->f3,2);?></div></td>
							<td align="right"><div style="text-align: right; width: 100px; color:  <?php echo $performance->f4 < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo $performance->f4 != 0 ? number_format($performance->f4*100,2) : '';?></div></td>
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
<div class="clear"></div> 
<?php }
else {?>
<div style="display: inline-block;" class="ifrc_index">
	<div class="flexigrid" style="width: auto;">
		<div class="hDiv">
			<div class="hDivBox">
				<table cellspacing="0" cellpadding="0">
					<thead>
					<tr>
					<th align="left" colspan="3"><div style="text-align: left; width: 145px; margin-top: 4px;" class="sundefined"><h3>Performance</h3></div></th>
					<th align="left" colspan="5"><div style="text-align: right; width: 350px; margin-top: 6px; margin-left: 23px;" class="sundefined"><h3>Price indexes</h3></div></th>
					<th align="left" colspan="5"><div style="text-align: center; width: 310px; margin-top: 6px; margin-left: 23px;" class="sundefined"><h3>Total Return Indexes</h3></div></th>									
					</tr>
					<tr>
					<th align="right" axis="col1"><div style="text-align: right; width: 15px;" class="sundefined"></div></th>
					<th align="right" axis="col1"><div style="text-align: center; width: 40px;" class="sundefined"><strong>Year</strong></div></th>
					<th align="right" axis="col1"><div style="text-align: right; width: 100px;" class="sundefined"><strong>End Date</strong></div></th>
					<th align="right" axis="col1"><div style="text-align: right; width: 95px;" class="sundefined"><strong>Close</strong></div></th>
					<th align="right" axis="col1"><div style="text-align: right; width: 100px;" class="sundefined"><strong>VND</strong></div></th>
					<th align="right" axis="col1"><div style="text-align: right; width: 100px;" class="sundefined"><strong>EUR</strong></div></th>
					<th align="right" axis="col1"><div style="text-align: right; width: 100px;" class="sundefined"><strong>JPY</strong></div></th>
					<th align="right" axis="col1"><div style="text-align: right; width: 100px;" class="sundefined"><strong>USD</strong></div></th>
					<th align="right" axis="col1"><div style="text-align: right; width: 100px;" class="sundefined"><strong>Close</strong></div></th>
					<th align="right" axis="col1"><div style="text-align: right; width: 100px;" class="sundefined"><strong>VND</strong></div></th>
					<th align="right" axis="col1"><div style="text-align: right; width: 100px;" class="sundefined"><strong>EUR</strong></div></th>
					<th align="right" axis="col1"><div style="text-align: right; width: 100px;" class="sundefined"><strong>JPY</strong></div></th>
					<th align="right" axis="col1"><div style="text-align: right; width: 100px;" class="sundefined"><strong>USD</strong></div></th>				
					</tr>
					</thead>
				</table>
			</div>
		</div>
		
		<div class="bDiv" style="height: auto;">
			<table cellspacing="0" cellpadding="0" border="0" id="abs_global_TOP10_PERFORMANCEflexigrid" class="autoht">
				<tbody>
					<?php
					$i = 1; 
						foreach($report['performance'] as $performance){
					?>
						<tr class="<?php if($i % 2 != 0) echo 'erow'?>" id="row7034">
							<td align="right"><div style="text-align: right; width: 15px;"></div></td>
							<td align="right"><div style="text-align: center; width: 40px;"><?php echo $performance->f1;?></div></td>
							<td align="right"><div style="text-align: right; width: 100px;"><?php echo $performance->f2;?></div></td>
							<td align="right"><div style="text-align: right; width: 95px;"><?php echo number_format($performance->f3,2);?></div></td>
							<td align="right"><div style="text-align: right; width: 100px; color:  <?php echo $performance->f4 < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo $performance->f4 != 0 ? number_format($performance->f4*100,2) : '';?></div></td>
							<td align="right"><div style="text-align: right; width: 100px; color:  <?php echo $performance->f5 < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo $performance->f5 != 0 ? number_format($performance->f5*100,2) : '';?></div></td>
							<td align="right"><div style="text-align: right; width: 100px; color:  <?php echo $performance->f6 < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo $performance->f6 != 0 ? number_format($performance->f6*100,2) : '';?></div></td>
							<td align="right"><div style="text-align: right; width: 100px; color:  <?php echo $performance->f7 < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo $performance->f7 != 0 ? number_format($performance->f7*100,2) : '';?></div></td>
							<td align="right"><div style="text-align: right; width: 100px;"><?php echo $performance->f8 != 0 ? number_format($performance->f8,2) : '';?></div></td>
							<td align="right"><div style="text-align: right; width: 100px; color:  <?php echo $performance->f9 < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo $performance->f9 != 0 ? number_format($performance->f9*100,2) : '';?></div></td>
							<td align="right"><div style="text-align: right; width: 100px; color:  <?php echo $performance->f10 < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo $performance->f10 != 0 ? number_format($performance->f10*100,2) : '';?></div></td>
							<td align="right"><div style="text-align: right; width: 100px; color:  <?php echo $performance->f11 < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo $performance->f11 != 0 ? number_format($performance->f11*100,2) : '';?></div></td>
							<td align="right"><div style="text-align: right; width: 100px; color:  <?php echo $performance->f12 < 0 ? "#ff492a" : "#92dd4b"; ?>;"><?php echo $performance->f12 != 0 ? number_format($performance->f12*100,2) : '';?></div></td>
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
<?php }?>
  



<!--<div class="figures" style="width: 38%;">    -->    
<div class="facts" style="width: 38%;">
<h3>Figures</h3>        
<div style="display: inline-block; width: 100%;" class="ifrc_index">
	<div class="flexigrid" style="width: auto;">
		<div class="bDiv" style="height: auto;">
			<table cellspacing="0" cellpadding="0" border="0" id="abs_global_TOP10_PERFORMANCEflexigrid" class="autoht" style="width: 100% !important;">
				<tbody>
				<?php
				$i = 1; 
					foreach($report['figures'] as $figures){
				?>
                    <tr class="erow" id="row7034" style="height: 20px;">						
						<td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('idx_cap'); ?></strong></div></td>
						<td align="right"><div style="text-align: left; width: 170px;"><?php echo $figures->idx_cap != 0 ? number_format($figures->idx_cap,0) : '';?></div></td>    
					</tr>
                    <tr class="" id="row7034">						
						<td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('idx_div'); ?></strong></div></td>
						<td align="right"><div style="text-align: left; width: 170px;"><?php echo $figures->idx_div !=0 ? number_format( $figures->idx_div,0) : '';?></div></td>    
					</tr>
                    <tr class="erow" id="row7034">						
						<td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('min_cap'); ?></strong></div></td>
						<td align="right"><div style="text-align: left; width: 170px;"><?php echo $figures->min_cap !=0 ? number_format( $figures->min_cap,0) : '';?></div></td>    
					</tr>
                    <tr class="" id="row7034">						
						<td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('max_cap'); ?></strong></div></td>
						<td align="right"><div style="text-align: left; width: 170px;"><?php echo $figures->max_cap !=0 ? number_format($figures->max_cap,0) : '';?></div></td>    
					</tr>
                    <tr class="erow" id="row7034">						
						<td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('mean_cap'); ?></strong></div></td>
						<td align="right"><div style="text-align: left; width: 170px;"><?php echo $figures->mean_cap !=0 ? number_format( $figures->mean_cap,0) : '';?></div></td>    
					</tr>
                    <tr class="" id="row7034">						
						<td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('vola'); ?></strong></div></td>
						<td align="right"><div style="text-align: left; width: 170px;"><?php echo $figures->vola !=0 ? number_format( $figures->vola,2) : '';?></div></td>    
					</tr>
                    <tr class="erow" id="row7034">						
						<td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('beta'); ?></strong></div></td>
						<td align="right"><div style="text-align: left; width: 170px;"><?php echo $figures->beta !=0 ? number_format( $figures->beta,2) : '';?></div></td>    
					</tr>
                    <tr class="" id="row7034">						
						<td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('trk_error'); ?></strong></div></td>
						<td align="right"><div style="text-align: left; width: 170px;"><?php echo $figures->trk_error !=0 ? number_format( $figures->trk_error,2) : '';?></div></td>    
					</tr>
                    <tr class="erow" id="row7034">						
						<td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('div_yld'); ?></strong></div></td>
						<td align="right"><div style="text-align: left; width: 170px;"><?php echo $figures->div_yld !=0 ? number_format( $figures->div_yld,2) : '';?></div></td>    
					</tr>
                    <tr class="" id="row7034">						
						<td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('low_lv'); ?></strong></div></td>
						<td align="right"><div style="text-align: left; width: 170px;"><?php echo $figures->low_lv !=0 ? number_format( $figures->low_lv,2) : '';?></div></td>    
					</tr>
                    <tr class="erow" id="row7034">						
						<td align="right"><div style="text-align: left; width: 150px;"><strong><?php trans('high_lv'); ?></strong></div></td>
						<td align="right"><div style="text-align: left; width: 170px;"><?php echo $figures->high_lv !=0 ? number_format($figures->high_lv,2) : '';?></div></td>    
					</tr>

						<?php 
						$i++;
					}
				?>
				</tbody>
			</table>
		</div>
	</div>
    <h6 style="color: #93999d; font-size: 10px!important;">* Bn VND</h6>
</div>

<div class="clear"></div>       
</div>

<div class="composition" style="margin-top: 20px!important; width:60%;">        
<h3>Compositions (Top 10)</h3>        
<div style="display: inline-block; width:100%;" class="ifrc_index">
	<div class="flexigrid" style="width: auto;">
		<div class="hDiv">
			<div class="hDivBox">
				<table cellspacing="0" cellpadding="0">
					<thead>
					<tr>
					
					<th align="left" axis="col1"><div style="text-align: left; width: 60px;" class="sundefined"><strong>Code</strong></div></th>
					<th align="left" axis="col2"><div style="text-align: left; width: 300px;" class=""><strong>Name</strong></div></th>
					<th align="right" axis="col3"><div style="text-align: right; width: 100px;" class=""><strong>Capitalisation *</strong></div></th>
					<th align="right" axis="col4"><div style="text-align: right; width: 100px;" class=""><strong>Wgt %</strong></div></th>	
                    <th align="right" axis="col4"><div style="text-align: right; width: 80px;" class=""><strong>Perf %</strong></div></th>
                    <th align="right" axis="col4"><div style="text-align: right; width: 69px;" class=""><strong>Info</strong></div></th>				
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
						foreach($report['composition'] as $composition){
					?>
						<tr class="<?php if($i % 2 != 0) echo 'erow'?>" id="row7034">
							
							<td align="left"><div style="text-align: left; width: 60px;"><strong><?php echo $composition->stk_code;?></strong></div></td>
							<td align="left"><div style="text-align: left; width: 300px;"><?php echo $composition->stk_name;?></div></td>
							<td align="right"><div style="text-align: right; width: 100px;"><?php echo number_format($composition->stk_mcap,2);?></div></td>
							<td align="right"><div style="text-align: right; width: 100px;"><?php echo number_format($composition->stk_wgt,2);?></div></td>
                             <td align="right"><div style="text-align: right; width: 80px;color:  <?php echo $composition->perf < 0 ? "#ff492a" : "#92dd4b"; ?>;">
							<?php echo ($composition->perf != 0 && $composition->perf != NULL)?number_format($composition->perf,2):'-';?></div></td>
					       	<td align="right">
                               <div style="text-align: right; width: 69px;">
                                   <a style="cursor:pointer" href="<?php echo base_url(); ?>report_stock/<?php  echo $composition->stk_code ?>">
                                   <img src="<?php echo base_url(); ?>templates/images/more.png" style="height: 15.5px;"/></a>
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
        <?php foreach ($report['count'] as $count){?>
            <h6 style="color: #93999d; font-size: 11px!important;"><?php trans("Total")?>: <?php echo $count->count; ?> companies</h6> 
        <?php	} ?>
	</div>
</div>
<div class="clear"></div>       
</div>  
   <div class="clear"></div> 
</div><!--performance-->

</div>




