
<form name="formLanguage" class="form" id="complex_form" method="post" action="">
    <section class="grid_12">
        <div class="block-border">
            <div class="block-content">
                <h1><?php trans('mn_service'); ?></h1>
                <div class="columns">
                    <div class="block-controls">
                        <ul class="controls-buttons">
                            <li></li>
                        </ul>
                        <div style="float: right; margin-right: 20px;" class="custom-btn">
                            <button type="submit"><?php trans('bt_save'); ?></button>
                            <button onclick="$(location).attr('href','<?php echo admin_url() . 'service' ?>');" type="button" class="red"><?php trans('bt_cancel'); ?></button>
                            <div style="clear: left;"></div>
                        </div>
                    </div>
                    <?php if (isset($error) && $error != '') : ?>
                        <ul class="message warning no-margin">
                            <li>
                                <?php
                                if (is_array($error)):
                                    foreach ($error as $value):
                                        echo '<p>' . $value . '</p>';
                                    endforeach;
                                else:
                                    echo $error;
                                endif;
                                ?>
                            </li>
                            <li class="close-bt"></li>
                        </ul>
                    <?php endif; ?>

                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label required"><?php trans('name'); ?></span>
                            <span class="relative ">
                                <input type="text" name="name"  value="<?php echo $input['name']; ?>" class="full-width">
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label required"><?php trans('alias'); ?></span>
                            <span class="relative ">
                                <input type="text" name="alias"  value="<?php echo $input['alias']; ?>" class="full-width">
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label required"><?php trans('right'); ?></span>                            
                            <span class="relative ">
                                <button class="small float-right margin-bottom-10 action-add-right" type="button"><img src="<?php echo template_url(); ?>images/icons/fugue/plus-circle-blue.png" width="16" height="16"> Add Right</button>                         
                            </span>
                            <?php
                            if(isset($input['right']) && is_array($input['right']) && count($input['right'])>0){
                                foreach ($input['right'] as $key => $value) {
                                    ?>
                                    <span class="service-right "><input type="text" name="right[]"  value="<?php echo $value; ?>" /><a class="action-remove-right" href="javascript:void(0)"><img src="<?php echo template_url(); ?>images/icons/fugue/cross-circle.png" width="16" height="16"> <span>Remove</span></a></span>
                                    <?php
                                }
                            }
                             ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>