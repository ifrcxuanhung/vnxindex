<h3><?php echo trans($info['curent']['name']); ?></h3>
<ul class="posts_list">
    <?php
    if ($list['curent']) {
        foreach ($list['curent'] as $key => $value) {
            $string = explode("<hr />", $value['description']);
            ?>
            <li>                         
                <a class="thumbnail" href="<?php echo base_url(); ?>article/index/<?php echo $value['category_code'] . '/' . strtolower(utf8_convert_url($value['title'])); ?>.html" rel="bookmark" title="<?php echo $value['title']; ?>">
                    <img src="<?php echo image_thumb($value['image'], 91, 65); ?>" class="attachment-65x65 wp-post-image" alt="<?php echo $value['title']; ?>" title="<?php echo $value['title']; ?>" />
                </a>
                <div class="post_extra_info fx_cl_title_right">
                    <a href="<?php echo base_url(); ?>article/index/<?php echo $value['category_code'] . '/' . strtolower(utf8_convert_url($value['title'])); ?>.html" rel="bookmark" title="<?php echo $value['title']; ?>"><strong><?php echo $value['title']; ?></strong></a>
                    <p><?php echo $string[0]; ?></p>
                </div>
                <div class="clear"></div>
            </li>
            <?php
        }
    }
    ?>
</ul>