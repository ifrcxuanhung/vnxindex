<?php
    //echo $this->session->userdata('user_id');exit('xxxxxxxxxxxxx');
?>

<div id="main_resch">
    <!-- start list researchers  -->
    <div class="lst_resch">
    <div class="breadcrumb">
        <a href="#" class="lnk_home">Home</a>                           
        <span><?php trans('researchers') ?></span>
    </div>
    <h2><?php trans('researchers') ?></h2>
    <a class="btn_add_research" href="javascript:void(0);">Edit</a>
    	<table width="100%">
           <thead>
                <tr>
                  <th width="10%">Last Name</th>
                  <th width="10%">First Name</th>
                  <th width="8%">Nationality</th>
                  <th width="30%">University / Research Center</th>
                  <th width="40%">Speciality</th>
                  <th width="2%">Info</th>
                </tr>
           </thead>
           <tbody>
           <?php
                foreach($listResearch as $key=>$value)
                {
                    $link = base_url() .'researchers/detail/'. $value['id'] .'/'. utf8_convert_url($value['first_name']) .'-'. utf8_convert_url($value['last_name']); 
           ?>
           	<tr>
            	<td><?php echo $value['last_name'] ?></td>
                <td><?php echo $value['first_name'] ?></td>
                <td><?php echo $value['nationality'] ?></td>
                <td><?php echo $value['university'] ?></td>
                <td><?php echo $value['specialities'] ?></td>
                <td><a href="<?php echo $link ?>" class="bt_info"></a></td>
            </tr>
           <?php } ?>
           <!--
            <tr>
            	<td>Nulla facilisi</td>
                <td>Congue</td>
                <td>Adipiscing</td>
                <td>Lacinia iaculis magna</td>
                <td>Nec faucibus enim scelerisque</td>
                <td><a href="<?php echo base_url(); ?>researchers/detail" class="bt_info"></a></td>
            </tr>
            <tr>
            	<td>Lorem ipsum </td>
                <td>Dolor</td>
                <td>Amet</td>
                <td>Consectetur adipiscing elit</td>
                <td>Nulla vehicula feugiat</td>
                <td><a href="<?php echo base_url(); ?>researchers/detail" class="bt_info"></a></td>
            </tr><tr>
            	<td>Lorem ipsum </td>
                <td>Dolor</td>
                <td>Amet</td>
                <td>Consectetur adipiscing elit</td>
                <td>Nulla vehicula feugiat</td>
                <td><a href="<?php echo base_url(); ?>researchers/detail" class="bt_info"></a></td>
            </tr>
            <tr>
            	<td>Nulla facilisi</td>
                <td>Congue</td>
                <td>Adipiscing</td>
                <td>Lacinia iaculis magna</td>
                <td>Nec faucibus enim scelerisque</td>
                <td><a href="<?php echo base_url(); ?>researchers/detail" class="bt_info"></a></td>
            </tr>
            <tr>
            	<td>Lorem ipsum </td>
                <td>Dolor</td>
                <td>Amet</td>
                <td>Consectetur adipiscing elit</td>
                <td>Nulla vehicula feugiat</td>
                <td><a href="<?php echo base_url(); ?>researchers/detail" class="bt_info"></a></td>
            </tr>
            <tr>
            	<td>Nulla facilisi</td>
                <td>Congue</td>
                <td>Adipiscing</td>
                <td>Lacinia iaculis magna</td>
                <td>Nec faucibus enim scelerisque</td>
                <td><a href="<?php echo base_url(); ?>researchers/detail" class="bt_info"></a></td>
            </tr>
            <tr>
            	<td>Lorem ipsum </td>
                <td>Dolor</td>
                <td>Amet</td>
                <td>Consectetur adipiscing elit</td>
                <td>Nulla vehicula feugiat</td>
                <td><a href="<?php echo base_url(); ?>researchers/detail" class="bt_info"></a></td>
            </tr><tr>
            	<td>Lorem ipsum </td>
                <td>Dolor</td>
                <td>Amet</td>
                <td>Consectetur adipiscing elit</td>
                <td>Nulla vehicula feugiat</td>
                <td><a href="<?php echo base_url(); ?>researchers/detail" class="bt_info"></a></td>
            </tr>
            <tr>
            	<td>Nulla facilisi</td>
                <td>Congue</td>
                <td>Adipiscing</td>
                <td>Lacinia iaculis magna</td>
                <td>Nec faucibus enim scelerisque</td>
                <td><a href="<?php echo base_url(); ?>researchers/detail" class="bt_info"></a></td>
            </tr>
            -->
           </tbody>
        </table>
    </div>
    <div class="clear"></div>
</div>
<div class="popup_research">
    <div class="header_popup">
        <span class="close_popup"></span>
    </div>
    <iframe src="<?php echo base_url(); ?>researchers/user" ></iframe>
</div>
