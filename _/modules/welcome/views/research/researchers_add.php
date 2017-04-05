<?php
	
?>
<div class="add-research">
<h3 class="title-header">Thêm mới bài viết</h3>
    <?php $action = base_url() . 'researchers/add';?>

    <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="research_method" value="<?php echo  $this->router->fetch_method(); ?>"/>
        <input type="hidden" name="research_id" value="<?php echo (isset($detail_research['research_id']) && $detail_research['research_id'] != "" ) ? $detail_research['research_id'] : "" ?>" />
        <input class="submit-top" type="submit" name="save" value="<?php trans('save') ?>" />
        <!--
        <a class="add_research" href="<?php echo base_url().'researchers/rlist'?>"><?php trans('back') ?></a>
        -->
        <!--
        <p>
            <label>Category</label>
            
            <select name="category">
            <?php
                foreach($category as $k=>$v)
                {
                    if(isset($_POST['category']))
                    {
                        if($_POST['category'] == $v['category_id'])
                            $selected = "selected='selected'";
                        else
                            $selected = "";
                    } 
                    else
                    {
                        if(isset($detail_research['category_id']) && $detail_research['category_id'] == $v['category_id'])
                            $selected = "selected='selected'";
                        else
                            $selected = "";
                    }
                        
            ?>
                <option <?php echo $selected ?> value="<?php echo $v['category_id'] ?>"><?php echo $v['name'] ?></option>
            <?php
                }
            ?>
            </select>
        </p>
        -->
        <p>
            <label>Sort Order</label>
            <input type="text" name="sort_order" value="<?php echo (isset($_POST['sort_order'])) ? $_POST['sort_order'] : @$detail_research['sort_order'] ?>" />
        </p>
        <p>
            <label>Status</label>
            <select name="status">
            <?php  
                if(isset($_POST['status'])){
                    if($_POST['status'] == 1)
                        $ena = "selected = 'selected'";
                    else
                        $dis = "selected = 'selected'";
                }
                else{
                    if(isset($detail_research) && $detail_research['status'] == 1)
                        $ena = "selected = 'selected'";
                    else
                        $dis = "selected = 'selected'";
                }
            ?>
                <option <?php echo @$ena ?> value="1">Enable</option>
                <option <?php echo @$dis ?> value="0">Disable</option>
            </select>
        </p>
        
        <p>
            <label>Thời gian</label>
            Bắt đầu <input class="time" type="text" name="time_start" value="<?php echo (isset($_POST['time_start'])) ? $_POST['time_start'] : @$detail_research['time_start'] ?>" /> 
            Kết thúc <input class="time" type="text" name="time_end" value="<?php echo (isset($_POST['time_end'])) ? $_POST['time_end'] : @$detail_research['time_end'] ?>" />
        </p>
        <p>
            <label>Upload PDF</label>
            <input type="file" name="upload_file" />
        </p>
        <input type="hidden" name="upload_file_old" value="<?php echo @$detail_research['file_url'] ?>" />
        <?php
            if(@$detail_research['file_url'] != "")
            {
                $type_file = explode('.', $detail_research['file_url']);
                $type_file = $type_file[1];
        ?>
        <p class="file_upload">
            <img class="img_file" src="<?php echo base_url(). 'assets/upload/files/'. $type_file .'.png' ?>" /><span class="name_file"><?php echo $detail_research['file_url']; ?></span>
        </p>
        <?php
            }
        ?>
        
        <div class="more_description">
            <div class="tabs">
                <ul class="ul-tabs">
                <?php
                    $i = 0;
                    foreach($list_language as $key=>$lang)
                    {
                ?>
                    <li <?php echo ($i==0) ? "class='active'" : ""; ?>><a tabsIndex='cn-tabs-<?php echo $lang['code'] ?>' href="javascript:void(0);"><?php echo $lang['name'] ?></a></li>
                <?php
                    $i++;
                    }
                ?>
                </ul>
            </div>
            <div class="content-tabs">
                <?php
                    foreach($list_language as $key=>$lang){
                        $lang_code = $lang['code'];
                ?>
                <div class="cn-tabs cn-tabs-<?php echo $lang_code ?>">
                    <p>
                        <label>Title</label>
                        <input class="res-fullwidth" type="text" name="title-<?php echo $lang_code ?>" value="<?php echo (isset($_POST["title-$lang_code"])) ? $_POST["title-$lang_code"] : @$detail_research['more'][$lang_code]['title'] ?>" />
                    </p>
                    <!--
                    <p>
                        <label>Vị trí công việc</label>
                        <input class="res-fullwidth" type="text" name="position-job-<?php echo $lang_code ?>" value="<?php echo (isset($_POST["position-job-$lang_code"])) ? $_POST["position-job-$lang_code"] : @$detail_research['more'][$lang_code]['job_position'] ?>" />
                    </p>
                    -->
                    <p>
                        <label>Author</label>
                        <input class="res-fullwidth" type="text" name="author-<?php echo $lang_code ?>" value="<?php echo (isset($_POST["author-$lang_code"])) ? $_POST["author-$lang_code"] : @$detail_research['more'][$lang_code]['author'] ?>" />
                    </p>
                    <p>
                        <label>Journal / conference</label>
                        <input class="res-fullwidth" type="text" name="journal-conference-<?php echo $lang_code ?>" value="<?php echo (isset($_POST["journal-conference-$lang_code"])) ? $_POST["journal-conference-$lang_code"] : @$detail_research['more'][$lang_code]['journal_conference'] ?>" />
                    </p>
                    <p>
                        <label>Description</label><br />
                        <textarea id="description-<?php echo $lang_code ?>" name="description-<?php echo $lang_code ?>"><?php echo (isset($_POST["description-$lang_code"])) ? $_POST["description-$lang_code"] : @$detail_research['more'][$lang_code]['description'] ?></textarea>
                    </p>
                    <p>
                        <label>Long Description</label><br />
                        <textarea id="long-description-<?php echo $lang_code ?>" name="long-description-<?php echo $lang_code ?>"><?php echo (isset($_POST["long-description-$lang_code"])) ? $_POST["long-description-$lang_code"] : @$detail_research['more'][$lang_code]['long_description'] ?></textarea>
                    </p>
                </div>
                <?php } ?>

            </div>
        </div>
        <input type="submit" name="save" value="Save" />
    </form>
</div>
<script src="http://code.jquery.com/jquery-1.9.0.js"></script>
<script>
	$(document).ready(function(){
		$('.ul-tabs li a').click(function(){
			//alert('123456');
			$tabsIndex = $(this).attr('tabsIndex');
			$('ul.ul-tabs li').removeClass('active');
			$(this).parent().addClass('active');
			$('.cn-tabs').hide();
			$('.'+$tabsIndex).show();
		});
	});
</script>
<script type="text/javascript" src="<?php echo template_url() ?>js/ckeditor/ckeditor.js"></script>
<script>
    <?php
        foreach($list_language as $key=>$lang){
    ?>
        CKEDITOR.replace( 'description-<?php echo $lang['code']?>' );
        CKEDITOR.replace( 'long-description-<?php echo $lang['code']?>' );
    <?php } ?>
</script>
















