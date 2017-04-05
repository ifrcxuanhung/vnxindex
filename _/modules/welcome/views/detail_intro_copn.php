<?php
if (is_array($list) && $list['curent']) {
    $count = 0;
    foreach ($list['curent'] as $key => $value) {
        $count++;
?>
        <div class="detail_intro_copn">
<?php
            if ($count == 1) {?>
            <h2><?php echo $info['curent']['name']; ?></h2> <?php } ?>           
            <h3><?php echo $value['title']; ?></h3>
            <?php if ($value['images'] != '') { ?>
                    <div class="fl_copn">
                    	<img src="<?php echo image_thumb($value['image'], 144, 217); ?>" />
                    </div><?php echo $value['intro']; ?>
            <?php } else { ?>
            <p><?php echo $value['intro']; ?>
                        </p>
            <?php } ?>
            <span><strong><?php echo $value['content']; ?></strong></span>
        </div>
<?php
    }
}
?>