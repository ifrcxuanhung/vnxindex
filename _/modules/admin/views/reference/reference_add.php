<style>
.block-controls{
    margin-bottom: 6px;
}
.blocks-list li{
    padding-top: 5px;
    padding-bottom: 5px;
}
textarea{
    font-size: 12px;
}
.message.error{
    clear: both;
    float: right;
    margin-top: 5px;
    width: 39%;
}
.grid_5{
	position:absolute;
	left:30%;	
}

</style>
<article class="no-margin">
    
    <section class="grid_5">
        <div class="block-border">
            <div class="block-content">
                <h1><?php trans('mn_reference'); ?></h1>
                <div class="block-controls">
                    <div class="fx_bt_indi ">
                    	<button id="btn-cancel" type="submit"><?php trans('bt_cancel'); ?></button>
                        <button id="btn-save" type="submit"><?php trans('bt_save'); ?></button>
                        <div style="clear: left;"></div>
                    </div>
                </div>
                <form id="formReference" name="formReference" action="" method="post" class="block-content form form_fx" style="min-height: auto">
                <?php if (isset($error) && $error != '') : ?>
                    <ul class="message error no-margin">
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
                    </ul>
                <?php endif;?>
                    <ul class="blocks-list">                    
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('ticker'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input readonly="readonly" type="text" class="full-width" name="ticker" id="ticker" value="<?php echo isset($input['ticker']) ? $input['ticker'] : NULL; ?>" />
                                </p>
                                <?php echo form_error('ticker', '<div class="message error">', '</div>'); ?>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('market'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input readonly="readonly" type="text" name="market" id="market" value="<?php echo isset($input['market']) ? $input['market'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('date'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input readonly="readonly" type="text" name="date" id="date" value="<?php echo isset($input['date']) ? $input['date'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('ipo'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="ipo" id="ipo" value="<?php echo isset($input['ipo']) ? $input['ipo'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('ipo_shli'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="ipo_shli" id="ipo_shli" value="<?php echo isset($input['ipo_shli']) ? $input['ipo_shli'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('ipo_shou'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="ipo_shou" id="ipo_shou" value="<?php echo isset($input['ipo_shou']) ? $input['ipo_shou'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('ftrd'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="ftrd" id="ftrd" value="<?php echo isset($input['ftrd']) ? $input['ftrd'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('ftrd_cls'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="ftrd_cls" id="ftrd_cls" value="<?php echo isset($input['ftrd_cls']) ? $input['ftrd_cls'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('shli'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="shli" id="shli" value="<?php echo isset($input['shli']) ? $input['shli'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('shou'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="shou" id="shou" value="<?php echo isset($input['shou']) ? $input['shou'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                    </ul>
                </form>

                
            </div></div>
    </section>

</article>