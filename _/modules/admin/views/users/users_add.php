<form name="formLanguage" class="form" id="complex_form" method="post" action="">
    <section class="grid_12">
        <div class="block-border">
            <div class="block-content">
                <h1><?php trans($title); ?></h1>
                <div class="columns">
                    <div class="block-controls">
                        <ul class="controls-buttons">
                            <li></li>
                        </ul>
                        <div style="float: right; margin-right: 20px;" class="custom-btn">
                            <button type="submit"><?php trans('bt_save'); ?></button>
                            <button onclick="$(location).attr('href','<?php echo admin_url() . 'users' ?>');" type="button" class="red"><?php trans('bt_cancel'); ?></button>
                            <div style="clear: left;"></div>
                        </div>
                    </div>
                    <?php if (isset($message) && $message != '') : ?>
                        <ul class="message warning no-margin">
                            <li>
                                <?php echo $message; ?>
                            </li>
                            <li class="close-bt"></li>
                        </ul>
                    <?php endif; ?>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label required"><?php trans('group'); ?></span>
                            <span class="relative ">
                                <select name='group_id' class="full-width group_id">
                                    <?php
                                    if (isset($group) && $group != '') {
                                        if (is_array($group)) {
                                            foreach ($group as $item) {
                                                ?>
                                                <option value="<?php echo $item['id']; ?>" <?php if ($item['id'] == $group_id) echo 'selected'; ?>><?php echo $item['name']; ?></option>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <div class="colx2-left">
                            <p class="colx3-left inline-label margin-bottom-10">
                                <span class="label required"><?php trans('username'); ?></span>
                                <span class="relative ">
                                    <?php echo isset($username) == TRUE ? form_input($username) : ''; ?>
                                </span>
                            </p>

                            <p class="colx3-left inline-label margin-bottom-10">
                                <span class="label required"><?php trans('email'); ?></span>
                                <span class="relative ">
                                    <?php echo isset($email) == TRUE ? form_input($email) : ''; ?>
                                </span>
                            </p>

                            <p class="colx3-left inline-label margin-bottom-10">
                                <span class="label required"><?php trans('first_name'); ?></span>
                                <span class="relative ">
                                    <?php echo isset($first_name) == TRUE ? form_input($first_name) : ''; ?>
                                </span>
                            </p>

                            <p class="colx3-left inline-label margin-bottom-10">
                                <span class="label required"><?php trans('last_name'); ?>:</span>
                                <span class="relative ">
                                    <?php echo isset($last_name) == TRUE ? form_input($last_name) : ''; ?>
                                </span>
                            </p>

                            <p class="colx3-left inline-label margin-bottom-10">
                                <span class="label required"><?php trans('phone'); ?>:</span>
                                <span class="relative ">
                                    <?php echo isset($phone) == TRUE ? form_input($phone) : ''; ?>
                                </span>
                            </p>

                            <p class="colx3-left inline-label margin-bottom-10">
                                <span class="label required"><?php trans('password'); ?>:</span>
                                <span class="relative ">
                                    <?php echo isset($password) == TRUE ? form_input($password) : ''; ?>
                                </span>
                            </p>
                            <p class="colx3-left inline-label margin-bottom-10">
                                <span class="label required"><?php trans('confirm_password'); ?>:</span>
                                <span class="relative ">
                                    <?php echo isset($password_confirm) == TRUE ? form_input($password_confirm) : ''; ?>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>