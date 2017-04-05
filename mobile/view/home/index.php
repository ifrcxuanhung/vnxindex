<?php
    $setting = setting();
    $width = (isset($setting['mvnx_width']) && $setting['mvnx_width'] != "") ? "style='width: {$setting['gwc_width']}'" : "";
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <?php echo $this->block->head() ?>
    </head>
    <body class="home blog dark">
        <div class="switherHead"></div>
        <div class="colored">
            <div class="blue"></div>
            <div class="aqua"></div>
            <div class="green"></div>
            <div class="yellow"></div>
            <div class="red"></div>
        </div>
        <div class="hfeed site" id="page" <?php echo $width ?>>
            <?php echo $this->block->header() ?>
            <div id="main" >
                <div class="content_area" id="primary">
                    <div role="main" class="site_content" id="content">
                        <?php echo $this->block->profile() ?>
                        <div id="mainpage_accordion_area"> 
                            <!-- LIST OF INDEXES -->
                            <?php //echo $this->block->listindex() ?>
                            <!-- /LIST OF INDEXES-->

                            <!-- PERFORMANCE RANKING -->
                            <!--div id="performance">
                                <?php //echo $this->block->performance_ranking() ?>
                            </div-->
                            <!-- /PERFORMANCE RANKING--> 

                            <!-- DOCUMENTATION -->
                            <?php //echo $this->block->documentation() ?>
                            <!-- /DOCUMENTATION --> 
                            
                            <!-- ARTICLE -->
                            <?php // echo $this->block->home_article() ?>
                            <!-- /ARTICLE -->
                            
                            <!-- MEDIA -->
                            <?php //echo $this->block->home_media() ?>
                            <!-- /MEDIA -->
							
							<!--OUR WEBSITE-->
							<?php //echo $this->block->our_website() ?>
							<!--/OUR WEBSITE-->

                            <!-- CONTACTS -->
                            <?php //echo $this->block->contact() ?>
                            <!-- /CONTACT --> 
                            
                            <?php
                            //print_R($listBlock);exit;
							foreach ($listBlock as $keyBlock => $valueBlock)
                            {
                                
								if($valueBlock['query'] != ""){
									$where = $this->block->GetBetween("where", "order by", $valueBlock['query']);
									$arr = explode('order by', $valueBlock['query']);
									$sort = str_replace(";","",isset($arr[1]) ? $arr[1] :'');
								}else {
									$sort = ' clean_order asc';
									$where = '(1=1)';
								}
								if($valueBlock['layout']=='articles') 
								$this->block->catelog($valueBlock['category'], $where, $sort, $valueBlock['title']);
								else if($valueBlock['layout']=='media&publications'){ 
								$this->block->listpublications($valueBlock['category'], $valueBlock['query'], $valueBlock['title']);
								}
								else if($valueBlock['layout']=='index') 
								$this->block->listindex($valueBlock['category'], $valueBlock['query'], $valueBlock['title']);
								else if($valueBlock['layout']=='performance'){
                           ?>
                           <div id="performance">
                                <?php $this->block->performance_ranking($valueBlock['category'], $valueBlock['query'], $valueBlock['title']); ?>
                            </div>
                           
                           <?php  
								//$this->block->performance_ranking($valueBlock['category'], $valueBlock['query'], $valueBlock['title']);
								}else if($valueBlock['layout']=='documentation') 
								$this->block->documentation($valueBlock['category'], $valueBlock['query'], $valueBlock['title']);
								else if($valueBlock['layout']=='contact') 
								 echo $this->block->contact();
							}                           
                            ?>
                        </div>
                        <!-- #mainpage_accordion_area --> 
                    </div>
                    <!-- #content --> 
                </div>
                <!-- #primary --> 
            </div>
            <!-- #main -->
            <?php echo $this->block->footer() ?>
        </div>
        <!-- #page --> 

        <?php echo $this->block->script() ?>
        <script>
            jQuery(document).ready(function(){
                var type = window.location.hash.substr(1);
                if(type == 'resume')
                {
                    if(jQuery("#resume").hasClass('open') == false)
                    {
                        jQuery("#resume").addClass('open');
                        jQuery("#resume .section_title").addClass('current');
                        jQuery("#resume .section_body").css("display", "block");
                        window.location.hash = 'resume';
                    }
                }
            });
            
        </script>
    </body>
</html>
