<?php 
include_once "model/ifrc_article_model.php";
$alldata= array();
$int_article_model = new Ifrc_article_model();
$ldata_all = $int_article_model->get_article_by_cate_code_1($category,$where , $sort, '0,10');
$ldata_all = $ldata_all['current'];
//print_R($ldata_all);
//print_R($glossaryCate);exit;
?>

<section class="section resume_section even" id="<?php echo str_replace(' ','',$title_default) ?>">
    <div class="section_header resume_section_header" style="position: relative;">
    	<input type="hidden" id="where_<?php echo $category ?>" name="where_<?php echo $category ?>" value="<?php echo $where ?>" />
        <input type="hidden" id="sort_<?php echo $category ?>" name="sort_<?php echo $category ?>" value="<?php echo $sort ?>" />
        <?php if(count($ldata_all) > 1) { ?>
        <input type="text" id="search-<?php echo $category ?>" name="search-<?php echo $category ?>" placeholder="<?php echo $data['trans']->getTranslate('vnxindex_quick_search'); ?>" class="input-search" category="<?php echo $category ?>" />
        <button class="btn-close" id="btn-<?php echo $category ?>" name="btn-<?php echo $category ?>" style="position:absolute; right:62px;top:14px;z-index:100; height:37px;background:transparent; color:#c4c4c4; display:none" category="<?php echo $category ?>">X</button>
        <?php } ?>
		<h2 class="section_title resume_section_title">
			<a href="#<?php echo str_replace(' ','',$title_default) ?>">
				<span class="icon icon-align-left"></span>
				<span class="section_name"><?php echo $data['trans']->getTranslate($title);?></span>
			</a>
			<span class="section_icon"></span>
		</h2>
    </div>
    
    <div id="<?php echo $category ?>" class="section_body resume_section_body" style="padding:10px 35px 10px 10px;">
    	<?php if (count($glossaryCate) > 1) { ?> 
        <ul id="portfolio_iso_filters">
            <li index='tab_all' category='<?php echo $category ?>' sub_category=""><a class='index current' href="#"><?php echo $data['trans']->getTranslate('all'); ?></a></li>
            <?php
                $i = 0;
                foreach ($glossaryCate as $value) {
                    $name = $data['trans']->getTranslate($value['clean_scat']);
                    $str = substr($name,0,1);
                    $sub = substr($name,1,strlen($name));
            ?>
                <li index='tab_<?php echo $value['clean_scat'] ?>' category='<?php echo $value['clean_cat'] ?>' ><a class='index' href="#<?php echo $value['clean_scat'] ?>"><?php echo strtoupper($str).strtolower($sub) ?></a></li>
            <?php
                }
            ?>
        </ul>
        <?php } ?>
        <?php
        
        //print_R($ldata_all);exit;
        $sum = $int_article_model->count_article_cate1($category);
        $total = ceil($sum/10);
        
        foreach($glossaryCate as $value)
        {
            $subcategory_code = $value['clean_scat'];
            $ldata = $int_article_model->get_article_by_scate_code($category,$subcategory_code, $sort, '0,10');
          
            $listdata = $ldata['current'];
            $alldata[$value['clean_scat']] = $listdata;
        }
        //$alldata['ALL'] = $ldata_all;
   
        ?>
        
        <!--TAB ALL-->
            <div class="list_tabs tab_all tab_first wrapper resume_wrapper" id="tab_<?php echo $category ?>">
                <div class="category resume_category resume_category_1 first">
                    <div class="category_body resume_category_body_1">
                        <ul class="glossary" id="ul_<?php echo $category ?>">
                            <?php 
							$i = 0;
                            foreach($ldata_all as $key => $value)
                            {    
								 $url =  $value['url'];
								if (strpos($url,'http')!==FALSE||strpos($url,'https')!==FALSE) {
									$links = $url;
									$urlS = str_replace('http://','',str_replace('https://','',$url));
								} else {
									$links = BASE_URL.$url; 
									$urlS = str_replace('http://','',str_replace('https://','',$links));
								}
                                
                            ?>
                                 <li>
                                    
                                    <article style="margin-bottom: 15px; padding-top: 15px; position: relative; min-height:60px" class="post resume_post resume_post_1">
                                    	<div class="post_header resume_post_header">
                                    		<h4 style="padding-left: 20px; width: 100%;" class="post_title">
                                    			<span class="post_title_icon aqua"></span>
                                    			<a href="<?php echo (isset($value['url'])&&$value['url']!='' ? $links : '') ?>" target="_blank" class="<?php echo (isset($value['url'])&&$value['url']!='' ? '' : 'disabled') ?>"><?php echo $value['title'] ?></a>
                                    		</h4>           
                                    	</div>
                                        <?php if(basename($value['images']) != 'no-image.jpg' && basename($value['images']) != '') { ?>
                                        <div class="post_img" style="width: 20%; float: left; margin: 10px; position: relative;">
                                            <img style='width: 100%;' src='<?php echo PARENT_URL.$value['images'] ?>' alt='' title='' />
                                        </div>
                                        <?php } ?>
                                      
                                    	<div style="width: <?php echo (basename($value['images']) != 'no-image.jpg' && basename($value['images']) != '')? '75%' : '93%' ?>; margin-left: 20px; position: relative; float: left;" class="post_body resume_post_body">
                                   		   <?php echo $value['description'] != "" ? "<p style='padding-left:23px; padding-top: 5px;'>{$value['description']}</p>" : "" ?>
                                           <?php echo $value['long_description'] != "" ? "<p style='padding-left:23px; padding-top: 6px;'>{$value['long_description']}</p>" : "" ?>
                                    	   
                                            <?php if(isset($value['url'])&&$value['url']!=''){ ?>
                                                <a href="<?php echo (isset($value['url'])&&$value['url']!='' ? $links : '') ?>" target="_blank" class="<?php echo (isset($value['url'])&&$value['url']!='' ? '' : 'disabled') ?>"><?php echo $urlS ?></a>
                                             <?php } ?>
                                        </div>
                                    </article>
                                </li>
                                
                            <?php
                                
                            $i++;
							}
                            ?>
                        </ul>
                    
              
                    </div>
                    <!-- .category_body --> 
                </div>
                 <?php
			if($total > 1)
			{
				
		?>
			<ul description = "" class="pagenumber <?php echo 'page_'.$category ?>" id="portfolio_iso_filters" style="float: right!important;">
			<?php
                echo '<li><a class="disabled" href="javascript:void(0)" onclick="MyFunction(1,\''.$category.'\',\'\'); return false;" page="1"> First </a></li>';
				echo '<li><a class="disabled" cate_code="'.$category.'" sub_cate_code ="" href="javascript:void(0)" onclick="MyFunction(1,\''.$category.'\',\'\'); return false;"  return false;" page="0"> < </a></li>';
                for($i = 1; $i <= $total; $i++)
				{
				    if($i <= 10 ){
    					$current = ($i == 1) ? "class='current'" : "";
    					echo '<li><a href="javascript:void(0)" cate_code="'.$category.'" onclick="MyFunction('.$i.',\''.$category.'\',\'\'); return false;"  return false;" '.$current.' page="'.$i.'">'.$i.'</a></li>';
                    }
				}
                echo '<li><a cate_code="'.$category.'" sub_cate_code ="" href="javascript:void(0)" onclick="MyFunction(1,\''.$category.'\',\'\'); return false;"  page="2"> > </a></li>';
                echo '<li><a href="javascript:void(0)" onclick="MyFunction('.$total.',\''.$category.'\',\'\');return false;" page="'.$total.'"> Last </a></li>';
			?>
			</ul>
		<?php
			}
		?>
            </div>
        <!--END TAB ALL-->
        <?php
        //print_r($alldata);exit;
		if (count($glossaryCate) > 1) {
            foreach($alldata as $key => $value)
            {
                $sum = $int_article_model->count_article_scate($key,$category);
                $total = ceil($sum/10);
                
        ?>
        <div class="list_tabs wrapper resume_wrapper tab_<?php echo $key ?>" id="tab_<?php echo $key ?>">
                <div class="category resume_category resume_category_1">
                    <div class="category_body resume_category_body_1">
                    <ul class="glossary">
                    <?php  foreach ($value as $arr)
                    {
						 	$url =  $arr['url'];
							if (strpos($url,'http')!==FALSE||strpos($url,'https')!==FALSE) {
								$links = $url;
								$urlS = str_replace('http://','',str_replace('https://','',$url));
							} else {
								$links = BASE_URL.$url; 
								$urlS = str_replace('http://','',str_replace('https://','',$links));
							}
					?>
                       
                             <li>
                                
                                <article style="margin-bottom: 15px; padding-top: 15px; position: relative; min-height:60px" class="post resume_post resume_post_1">
                                	<div class="post_header resume_post_header">
                                		<h4 style="padding-left: 20px; width: 100%;" class="post_title">
                                			<span class="post_title_icon aqua"></span>
                                			<a href="<?php echo (isset($arr['url'])&&$arr['url']!='' ? $links : '') ?>" target="_blank" class="<?php echo (isset($arr['url'])&&$arr['url']!='' ? '' : 'disabled') ?>"><?php echo $arr['title'] ?></a>
                                		</h4>           
                                	</div>
                                    <?php if(basename($arr['images']) != 'no-image.jpg' && basename($arr['images']) != '') { ?>
                                    <div class="post_img" style="width: 20%; float: left; margin: 10px; position: relative;">
                                         <img style='width: 100%;' src='<?php echo PARENT_URL.$arr['images'] ?>' alt='' title='' />
                                    </div>
                                    <?php } ?>
                                  
                                	<div style="width:<?php echo (basename($arr['images']) != 'no-image.jpg' && basename($arr['images']) != '')? '75%' : '93%' ?>; margin-left: 20px; position: relative; float: left;" class="post_body resume_post_body">
                                		<?php echo $arr['description'] != "" ? "<p style='padding-left:23px; padding-top: 5px;'>{$arr['description']}</p>" : "" ?>
                                	    <?php echo $arr['long_description'] != "" ? "<p style='padding-left:23px; padding-top: 6px;'>{$arr['long_description']}</p>" : "" ?>
                                        
                                        <?php if(isset($arr['url'])&&$arr['url']!=''){ ?>
                                            <a href="<?php echo (isset($arr['url'])&&$arr['url']!='' ? $links : '') ?>" target="_blank" class="<?php echo (isset($arr['url'])&&$arr['url']!='' ? '' : 'disabled') ?>"><?php echo $urlS ?></a>
                                        <?php } ?>
                                    </div>
                                </article>
                            </li>
                    <?php } ?>
                        </ul>
                    
              
                    </div>
                    <!-- .category_body --> 
                </div>
                    <?php
			if($total > 1)
			{
				
                
		?>
			<ul description="" class="pagenumber <?php echo 'page_'.$category.'_'.$key ?>" id="portfolio_iso_filters"  style="float: right!important;">
			<?php
				echo '<li><a class="disabled" cate_code="'.$category.'" sub_cate_code ="'.$key.'" href="javascript:void(0)" onclick="MyFunction(1,\''.$category.'\',\''.$key.'\'); return false;" page="1"> First </a></li>';
				echo '<li><a class="disabled" cate_code="'.$category.'" sub_cate_code ="'.$key.'" href="javascript:void(0)" onclick="MyFunction(0,\''.$category.'\',\''.$key.'\'); return false;" page="0"> < </a></li>';
                for($i = 1; $i <= $total; $i++)
				{
				    if($i <= 10 ){
    					$current = ($i == 1) ? "class='current'" : "";
    					echo '<li><a cate_code="'.$category.'" sub_cate_code ="'.$key.'" href="javascript:void(0)" onclick="MyFunction('.$i.',\''.$category.'\',\''.$key.'\'); return false;" '.$current.' page="'.$i.'">'.$i.'</a></li>';
                    }
				}
                echo '<li><a cate_code="'.$category.'" sub_cate_code ="'.$key.'" href="javascript:void(0)" onclick="MyFunction(2,\''.$category.'\',\''.$key.'\'); return false;" page="2"> > </a></li>';
                echo '<li><a cate_code="'.$category.'" sub_cate_code ="'.$key.'" href="javascript:void(0)" onclick="MyFunction('.$total.',\''.$category.'\',\''.$key.'\'); return false;" page="'.$total.'"> Last </a></li>';
			?>
			</ul>
             
		<?php
			}
		?>
        </div>
        <?php
            }
		}
        ?>
        
        <!--END TAB-->
        </div>
  </section>
  
  
 