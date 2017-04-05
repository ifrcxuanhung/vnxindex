<?php
    //echo '<pre>';print_r($list_research);echo '</pre>';exit;
?>
<div class="list-research">
<h3 class="title-header"><?php trans('list_article_research') ?></h3>
<a class="add_research edit_info_user" href="<?php echo base_url().'researchers/user'?>"><?php trans('edit_infomation_user') ?></a>
<a class="add_research" href="<?php echo base_url().'researchers/add'?>"><?php trans('add') ?></a>
<a href="<?php echo base_url() . 'researchers/detail/'. $this->session->userdata('user_id');?>" class="add_research"><?php trans('back') ?></a>
<table border="1">
    <tr>
        <th width="5%">STT</th>
        <th width="25%">Title</th>
        <th width="30%">Description</th>
        <th width="5%">S-Order</th>
        <th width="5%">Status</th>
        <th width="10%">Option</th>
    </tr>
    <?php
        $i = 0; 
        foreach($list_research as $research)
        {
            $i++;
            
    ?>
        <tr>
            <td align="center"><?php echo $i ?></td>
            <td><?php echo $research['title'] ?></td>
            <td><?php echo $research['description'] ?></td>
            <td align="center"><?php echo $research['sort_order'] ?></td>
            <td align="center">
                <?php if($research['status'] == 1){?>
                    <a class='st-enable' href=''><?php trans('enable')?></a>
                <?php }else{ ?>
                    <a class='st-disable' href=''><?php trans('disable')?></a>
                <?php } ?>
            </td>
            <td align="center"><a class="bt-option" href="<?php echo base_url().'researchers/edit/'. $research['research_id']?>"><?php trans('edit') ?></a><a onclick="return confirm('<?php trans('you_sure_want_delete') ?>')" class="bt-option" href="<?php echo base_url().'researchers/delete/'. $research['research_id']?>"><?php trans('del') ?></a></td>
        </tr>
    
    <?php   
        }
    ?>
</table>

</div>
<script src="http://code.jquery.com/jquery-1.9.0.js"></script>
<script>
	$(document).ready(function(){

	});
</script>

















