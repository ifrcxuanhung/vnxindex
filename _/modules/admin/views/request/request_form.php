<form name="formArticle" class="form" id="complex_form" method="post" action="">
    <section class="grid_12">
        <div class="block-border">
            <div class="block-content">
                <h1><?php trans('mn_newsletter'); ?></h1>
                <div class="columns">
                    <div class="block-controls">
                        <ul class="controls-buttons">
                            <li></li>
                        </ul>
                        <div style="float: right; margin-right: 20px;" class="custom-btn">
                            <button type="submit" name="ok" value="ok"><?php trans('bt_save'); ?></button>
                            <button class="red" class="" onclick="$(location).attr('href','<?php echo admin_url() . 'newsletter' ?>');" type="button"><?php trans('bt_cancel'); ?></button>
                            <div style="clear: left;"></div>
                        </div>
                    </div>
                    <?php if (isset($error) && $error != '') : ?>
                        <ul class="message warning no-margin">
                            <li>
                                <?php
                                if (is_array($error)):
                                    foreach ($error as $value):
                                        echo '<p>' . trans($value) . '</p>';
                                    endforeach;
                                else:
                                    echo trans($error);
                                endif;
                                ?>
                            </li>
                            <li class="close-bt"></li>
                        </ul>
                    <?php endif; ?>
                    
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('email'); ?></span>
                            <span class="relative">
                                <?php
                                if (isset($input['email']) == FALSE) : $input['email'] = '';
                                endif;
                                echo form_input('email', set_value('email', $input['email']), 'class="full-width"');
                                ?>
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('active'); ?></span>
                            <span class="relative ">
                                <?php
                                $options = array(
                                    '1' => 'Enable',
                                    '0' => 'Disable',
                                );
                                if (isset($input['active']) == FALSE) : $input['active'] = '';
                                endif;
                                echo form_dropdown('active', $options, set_value('active', $input['active']), 'class="full-width"');
                                ?>
                            </span>
                        </p>
                    </div>
                    <!--
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('time'); ?></span>
                            <span class="relative">
                                <?php
                                if (isset($input['time']) == FALSE) : $input['time'] = '';
                                endif;
                                echo form_input('time', set_value('time', $input['time']), 'class="full-width"');
                                ?>
                            </span>
                        </p>
                    </div>
                    -->
                </div>
            </div>
        </div>
    </section>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bundles/ckeditor/ckeditor.js"></script>