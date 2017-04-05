<style>
#main-boxes{ width:100%;}
.col-md-6{
    width: 15.7%;
	float:left;
	min-height: 1px;
    padding-left: 0.4%;
    padding-right: 0.4%;
    position: relative;
	margin-left:1px;
	
}

.col-md-5{
    width: 17.9%;
	float:left;
	min-height: 1px;
    padding-left: 1%;
    padding-right: 1%;
    position: relative;
	margin-left:1px;
	
}
.col-md-4{
    width: 22.9%;
	float:left;
	min-height: 1px;
    padding-left: 1%;
    padding-right: 1%;
    position: relative;
	margin-left:1px;
	
}
.box-con4{ float:left; width:83%}
.col-md-3{
    width: 31.2%;
	float:left;
	min-height: 1px;
    padding-left: 1%;
    padding-right: 1%;
    position: relative;
	margin-left:1px;
	
}
.box-con3{ float:left; width:85%}
.col-md-2{
    width: 47.9%;
	float:left;
	min-height: 1px;
    padding-left: 1%;
    padding-right: 1%;
    position: relative;
	margin-left:1px;
	
}
.box-con{ float:left; width:100%}
</style>
<div class="container-bottomslider">
				<div id="main-boxes" class="row">
                
                
         <?php 
		 if(isset($article_bottomslider) && $article_bottomslider != ''){
			 $count = count($article_bottomslider);
	
			 foreach($article_bottomslider as $boxmenu){?>     
				<div class="col-md-<?php echo $count;?>">
					<div class="box-style-2">
						<a title="<?php echo $boxmenu['title']; ?>" href="<?php 
						if(strpos($boxmenu['url'],'http') == false )
							echo HOST.$boxmenu['url'];
						else echo  base_url().$boxmenu['url'];
						
						
						?>">
                        
						
							
                             <h2><?php echo $boxmenu['title']; ?></h2>
                             <?php if($boxmenu['images']){?>
                             <img alt="<?php echo $boxmenu['title']; ?>" src="http://intranet.ifrc.vn/<?php echo $boxmenu['images'];?>" width="32" height="32">
                             <div class="box-con<?php echo $count;?>"><?php echo $boxmenu['description'];?></div>
                             <?php }else{?>
							<div class="box-con"><?php echo $boxmenu['description'];?></div>
                            <?php }?>
						</a>
					</div>
				</div>
        <?php }}?>
        
     
    </div>
    </div>