<form name="formLanguage" class="form" id="complex_form" method="post" action="">
    <section class="grid_12">
        <div class="block-border">
            <div class="block-content">
                <h1><?php trans($title); ?></h1>
                <div class="columns">
                    <div class="block-controls" style="height: 40px; padding-top: 10px; padding-bottom: 30px; margin-top: -34px;">
                        <ul class="controls-buttons">
                            <li></li>
                        </ul>
                        <div style="float: right; margin-right: 20px;" class="custom-btn">
                            <button type="submit"><?php trans('save'); ?></button>
                            <button onclick="$(location).attr('href','<?php echo admin_url() . 'setting' ?>');" type="button" class="red"><?php trans('cancel'); ?></button>
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
                            <span class="label required"><?php trans('group'); ?></span>
                            <span class="relative ">
                                <input type="text" name="group"  value="<?php echo $input['group']; ?>" class="full-width">
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label required"><?php trans('key'); ?></span>
                            <span class="relative ">
                                <input type="text" name="key"  value="<?php echo $input['key']; ?>" class="full-width">
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label required"><?php trans('value'); ?></span>
                            <span class="relative ">
                                <input type="text" name="value"  value="<?php echo $input['value']; ?>" class="full-width">
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>