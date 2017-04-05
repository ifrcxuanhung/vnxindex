
<form name="formLanguage" class="form" id="complex_form" method="post" action="">
    <section class="grid_12">
        <div class="block-border">
            <div class="block-content">
                <h1><?php trans('mn_services'); ?></h1>
                <div class="columns">
                    <div class="block-controls">
                        <ul class="controls-buttons">
                            <li></li>
                        </ul>
                        <div style="float: right; margin-right: 20px;" class="custom-btn">
                            <button type="submit"><?php trans('bt_save'); ?></button>
                            <button onclick="$(location).attr('href','<?php echo admin_url() . 'services' ?>');" type="button" class="red"><?php trans('bt_cancel'); ?></button>
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
                            <span class="label"><?php trans('parent'); ?></span>
                            <span class="relative">
                                <?php
                                if (isset($list_services) && is_array($list_services)):
                                    echo form_dropdown('parent_id', unshift($list_services, '0', 'none'), isset($input['parent_id']) ? $input['parent_id'] : NULL, 'class =full-width');
                                endif;
                                ?>
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('code_services'); ?></span>
                            <span class="relative">
                                <?php
                                echo form_input('services_code', isset($input['services_code']) ? $input['services_code'] : NULL);
                                ?>
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('sort_order'); ?></span>
                            <span class="relative">
                                <?php
                                echo form_input('sort_order', isset($input['sort_order']) ? $input['sort_order'] : NULL);
                                ?>
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('status'); ?></span>
                            <span class="relative ">
                                <?php
                                $options = array(
                                    '1' => 'Enable',
                                    '0' => 'Disable',
                                );
                                echo form_dropdown('status', $options, isset($input['status']) ? $input['status'] : NULL, 'class="full-width"');
                                ?>
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <div class="tabs-content">
                            <label class="float-left margin-right width150 required"><?php trans('name'); ?></label>
                            <input type="text" value="<?php echo isset($input['name']) ? $input['name'] : NULL; ?>" name="name"  class="full-width">
                            <div class="clear height10" style="margin-bottom: 20px"></div>

                            <label class="float-left margin-right width150"><?php trans('description_max_250_characters'); ?></label>
                            <textarea name="description"  class="full-width"><?php echo isset($input['description']) ? $input['description'] : NULL; ?></textarea>
                            <div class="clear height10" style="margin-bottom: 20px"></div>
                            <div class="clear height10"></div>
                        </div>
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