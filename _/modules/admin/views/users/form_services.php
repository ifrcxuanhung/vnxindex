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
                            <button onclick="$(location).attr('href', '<?php echo admin_url() . 'users' ?>');" type="button" class="red"><?php trans('bt_cancel'); ?></button>
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

                        <?php
                        if (isset($list_services) && is_array($list_services) && count($list_services) > 0):
                            echo '<dl class="accordion">';
                            foreach ($list_services as $key => $value):
                                ?>
                                <dt><span class="number"><?php echo $key; ?></span> <?php echo $value->name; ?></dt>
                                <dd>
                                    <table class="table" width="100%">
                                        <?php
                                        if (is_array($value->right) && count($value->right) > 0):
                                            foreach ($value->right as $k => $v):
                                                echo '<div class="columns">';
                                                $checked = '';
                                                $limit = '';
                                                $unlimit = '';
                                                $delay = '';
                                                if (isset($services[$value->services_code][$v]['limit']) && $services[$value->services_code][$v]['limit'] == 'unlimited') {
                                                    $unlimit = 'checked="checked"';
                                                }

                                                if (isset($services[$value->services_code][$v]['limit']) && $services[$value->services_code][$v]['limit'] == 'limit') {
                                                    $limit = 'checked="checked"';
                                                }

                                                if (isset($services[$value->services_code][$v]['delay']) && $services[$value->services_code][$v]['delay'] == 1) {
                                                    $delay = 'checked="checked"';
                                                }

                                                if (isset($services[$value->services_code][$v]['active']) && $services[$value->services_code][$v]['active'] == 1) {
                                                    $checked = 'checked="checked"';
                                                }
                                                ?>
                                                <tr><td>
                                                        <div style="float:left">
                                                            <input  type="hidden" name="services[<?php echo $value->services_code; ?>][<?php echo $v ?>][services_code]" class="datepicker" value="<?php echo $value->services_code; ?>">
                                                            <input  type="hidden" name="services[<?php echo $value->services_code; ?>][<?php echo $v ?>][type]" class="datepicker" value="user">
                                                            <?php
                                                            if (isset($id)) {
                                                                ?>
                                                                <input  type="hidden" name="services[<?php echo $value->services_code; ?>][<?php echo $v ?>][bind]" class="datepicker" value="<?php echo $id; ?>">
                                                            <?php } ?>
                                                            <input  type="hidden" name="services[<?php echo $value->services_code; ?>][<?php echo $v ?>][right]" class="datepicker" value="<?php echo $v; ?>">
                                                            <div style="float:left; margin-top:10px">
                                                                <input class="margin-left-10" type="checkbox" value="1"  name="services[<?php echo $value->services_code; ?>][<?php echo $v ?>][active]" <?php echo $checked; ?> /><label style="display:inline-block;text-align:left; margin-left:10px;width:70px"><?php echo $v; ?></label>
                                                            </div>
                                                            <div style="float:left; margin-left:15px">
                                                                <ul class="checkable-list">
                                                                    <li>
                                                                        <label  style="display:inline-block;width:40px;text-align:left">start</label>
                                                                        <input  type="text" name="services[<?php echo $value->services_code; ?>][<?php echo $v ?>][start]" class="datepicker" value="<?php echo isset($services[$value->services_code][$v]['start']) ? $services[$value->services_code][$v]['start'] : ''; ?>">
                                                                    </li>
                                                                    <li>
                                                                        <label style="display:inline-block;width:40px;text-align:left">end</label>
                                                                        <input  type="text" name="services[<?php echo $value->services_code; ?>][<?php echo $v ?>][end]" class="datepicker" value="<?php echo isset($services[$value->services_code][$v]['end']) ? $services[$value->services_code][$v]['end'] : ''; ?>">                                                    
                                                                        (yyyy-mm-dd)
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div style="float:left; margin-left:15px">
                                                                <div style="float:left;clear:both; margin-left:15px">
                                                                    <ul class="checkable-list">
                                                                        <li><input <?php echo $unlimit; ?> type="radio" name="services[<?php echo $value->services_code; ?>][<?php echo $v ?>][limit]" id="<?php echo $value->services_code; ?><?php echo $v ?>unlimited" value="unlimited"> <label for="<?php echo $value->services_code; ?><?php echo $v ?>unlimited" style="display:inline-block;width:40px;text-align:left">Unlimited</label></li>
                                                                        <li><input <?php echo $limit; ?> type="radio" name="services[<?php echo $value->services_code; ?>][<?php echo $v ?>][limit]" id="<?php echo $value->services_code; ?><?php echo $v ?>limit" value="limit"> <label for="<?php echo $value->services_code; ?><?php echo $v ?>limit" style="display:inline-block;width:40px;text-align:left">Limited</label>
                                                                            <input type="text" name="services[<?php echo $value->services_code; ?>][<?php echo $v ?>][limit_value]" value="<?php echo isset($services[$value->services_code][$v]['limit_value']) ? $services[$value->services_code][$v]['limit_value'] : ''; ?>" />
                                                                        </li>
                                                                        <li><input <?php echo $delay; ?> type="checkbox" name="services[<?php echo $value->services_code; ?>][<?php echo $v ?>][delay]" id="<?php echo $value->services_code; ?><?php echo $v ?>delay" value="1"> <label for="<?php echo $value->services_code; ?><?php echo $v ?>delay" style="display:inline-block;width:40px;text-align:left">Delay</label>
                                                                            <input type="text" name="services[<?php echo $value->services_code; ?>][<?php echo $v ?>][delay_value]" value="<?php echo isset($services[$value->services_code][$v]['delay_value']) ? $services[$value->services_code][$v]['delay_value'] : ''; ?>" />
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td></tr>
                                                <?php
                                                echo '</div>';
                                            endforeach;
                                            unset($k);
                                            unset($v);
                                        endif;
                                        echo '</table>';
                                        if (isset($value->sub_cate) && count($value->sub_cate) > 0) {
                                            echo '<dl class="accordion" style="margin-left:100px;">';
                                            foreach ($value->sub_cate as $sub => $vsub) {
                                                ?>
                                                <dt><span class="number"><?php echo $sub; ?></span> <?php echo $vsub->name; ?></dt>
                                                <dd>
                                                    <table class="table" width="100%">
                                                        <?php
                                                        if (is_array($vsub->right) && count($vsub->right) > 0):
                                                            foreach ($vsub->right as $ks => $vs):
                                                                $checked = '';
                                                                $limit = '';
                                                                $unlimit = '';
                                                                $delay = '';
                                                                if (isset($services[$vsub->services_code][$vs]['limit']) && $services[$vsub->services_code][$vs]['limit'] == 'unlimited') {
                                                                    $unlimit = 'checked="checked"';
                                                                }

                                                                if (isset($services[$vsub->services_code][$vs]['limit']) && $services[$vsub->services_code][$vs]['limit'] == 'limit') {
                                                                    $limit = 'checked="checked"';
                                                                }

                                                                if (isset($services[$vsub->services_code][$vs]['delay']) && $services[$vsub->services_code][$vs]['delay'] == 1) {
                                                                    $delay = 'checked="checked"';
                                                                }

                                                                if (isset($services[$vsub->services_code][$vs]['active']) && $services[$vsub->services_code][$vs]['active'] == 1) {
                                                                    $checked = 'checked="checked"';
                                                                }
                                                                echo '<div class="columns">';
                                                                ?>
                                                                <input  type="hidden" name="services[<?php echo $vsub->services_code; ?>][<?php echo $vs ?>][services_code]" class="datepicker" value="<?php echo $vsub->services_code; ?>">
                                                                <input  type="hidden" name="services[<?php echo $vsub->services_code; ?>][<?php echo $vs ?>][type]" class="datepicker" value="user">
                                                                <?php if (isset($id)) { ?>
                                                                    <input  type="hidden" name="services[<?php echo $vsub->services_code; ?>][<?php echo $vs ?>][bind]" class="datepicker" value="<?php echo $id; ?>">
                                                                <?php } ?>
                                                                <input  type="hidden" name="services[<?php echo $vsub->services_code; ?>][<?php echo $vs ?>][right]" class="datepicker" value="<?php echo $vs; ?>">
                                                                <tr><td>
                                                                        <div style="float:left">
                                                                            <div style="float:left; margin-top:10px">
                                                                                <input <?php echo $checked; ?> class="margin-left-10" type="checkbox" value="1" name="services[<?php echo $vsub->services_code; ?>][<?php echo $vs ?>][active]" /><label style="display:inline-block;text-align:left; margin-left:10px;width:100px"><?php echo $vs; ?></label>
                                                                            </div>
                                                                            <div style="float:left; margin-left:15px">
                                                                                <ul class="checkable-list">
                                                                                    <li>
                                                                                        <label  style="display:inline-block;width:40px;text-align:left">start</label>
                                                                                        <input  type="text" name="services[<?php echo $vsub->services_code; ?>][<?php echo $vs ?>][start]" class="datepicker" value="<?php echo isset($services[$vsub->services_code][$vs]['start']) ? $services[$vsub->services_code][$vs]['start'] : ''; ?>">
                                                                                    </li>
                                                                                    <li>
                                                                                        <label style="display:inline-block;width:40px;text-align:left">end</label>
                                                                                        <input  type="text" name="services[<?php echo $vsub->services_code; ?>][<?php echo $vs ?>][end]" class="datepicker"  value="<?php echo isset($services[$vsub->services_code][$vs]['end']) ? $services[$vsub->services_code][$vs]['end'] : ''; ?>">                                                    
                                                                                        (yyyy-mm-dd)
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div style="float:left; margin-left:15px">
                                                                                <div style="float:left;clear:both; margin-left:15px">
                                                                                    <ul class="checkable-list">
                                                                                        <li><input <?php echo $unlimit; ?> type="radio" name="services[<?php echo $vsub->services_code; ?>][<?php echo $vs ?>][limit]" id="<?php echo $vsub->services_code; ?><?php echo $vs ?>unlimited" value="unlimited"> <label for="<?php echo $vsub->services_code; ?><?php echo $vs ?>unlimited" style="display:inline-block;width:40px;text-align:left">Unlimited</label></li>
                                                                                        <li><input <?php echo $limit; ?> type="radio" name="services[<?php echo $vsub->services_code; ?>][<?php echo $vs ?>][limit]" id="<?php echo $vsub->services_code; ?><?php echo $vs ?>limit" value="limit"> <label for="<?php echo $vsub->services_code; ?><?php echo $vs ?>limit" style="display:inline-block;width:40px;text-align:left">Limited</label>
                                                                                            <input type="text" name="services[<?php echo $vsub->services_code; ?>][<?php echo $vs ?>][limit_value]" value="<?php echo isset($services[$vsub->services_code][$vs]['limit_value']) ? $services[$vsub->services_code][$vs]['limit_value'] : ''; ?>" />
                                                                                        </li>
                                                                                        <li><input <?php echo $delay ?> type="checkbox" name="services[<?php echo $vsub->services_code; ?>][<?php echo $vs ?>][delay]" id="<?php echo $vsub->services_code; ?><?php echo $vs ?>delay" value="1"> <label for="<?php echo $vsub->services_code; ?><?php echo $vs ?>delay" style="display:inline-block;width:40px;text-align:left">Delay</label>
                                                                                            <input type="text" name="services[<?php echo $vsub->services_code; ?>][<?php echo $vs ?>][delay_value]" value="<?php echo isset($services[$vsub->services_code][$vs]['delay_value']) ? $services[$vsub->services_code][$vs]['delay_value'] : ''; ?>" />
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td></tr>
                                                                <?php
                                                                echo '</div>';
                                                            endforeach;
                                                        endif;
                                                        ?>
                                                    </table>
                                                </dd>
                                                <?php
                                            }
                                            echo '</dl>';
                                        }
                                        ?>
                                </dd>
                                <?php
                            endforeach;
                            unset($key);
                            unset($value);
                            echo '</dl>';
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>