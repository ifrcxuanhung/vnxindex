<h3><?php trans('partner'); ?></h3>
<div id="slides_381">
    <div class="slides_nav"> <a href="javascript: void(0);" class="prev"></a> <a href="javascript: void(0);" class="next"></a> </div>
    <div class="slides_container">
            <?php
            if (isset($list['curent'])) {
                if ($list['curent']) {
                    foreach ($list['curent'] as $key => $value) {
                        echo '<div class="thumb">';
                        echo '<a href="' . image_thumb($value["image"], 130, 175) . '" data-rel="prettyPhoto" title="'. $value["title"] . '">';
                        echo '<img src="' . image_thumb($value["image"], 130, 175) . '" height="174" width="316" alt="">';
                        echo '</a>';
                        echo '</div>';
                    }
                }
            }
            ?>
    </div>
</div>
<script>
    $(document).ready(function() {
        jQuery(function() {
            jQuery('#slides_381').slides({
                generateNextPrev: false,
                preloadImage: '<?php echo base_url(); ?>assets/templates/welcome/images/loading.gif',
                generatePagination: false
            });
        });
    });
</script>