<?php
if (isset($list['curent']) && $list['curent'] != "") {
    foreach ($list['curent'] as $key => $value) {
?>                   
<div class="all_offce last_br" style="width:100%">
    <div class="one_half">
        <h3><?php echo $value['title']; ?></h3>
        <?php echo $value['description']; ?>
    </div>
    <div class="one_half last">
        <div class="image_contact" style="background:none;">
            <img src="<?= base_url().$value['image']; ?>" style="width:35%; box-shadow: none; border:0px">
        </div>
    </div>
</div>
<?php   
    }
}
?>