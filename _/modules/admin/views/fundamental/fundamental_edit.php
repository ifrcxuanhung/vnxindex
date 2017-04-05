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
                <h1><?php trans('mn_fundamental'); ?></h1>
                <div class="block-controls">
                    <div class="fx_bt_indi ">
                    	<button id="btn-cancel" type="submit"><?php trans('bt_cancel'); ?></button>
                        <button id="btn-save" type="submit"><?php trans('bt_save'); ?></button>
                        <div style="clear: left;"></div>
                    </div>
                </div>
                <form id="formFundamental" name="formFundamental" action="" method="post" class="block-content form form_fx" style="min-height: auto">
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
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('date'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="date" id="date" value="<?php echo isset($input['date']) ? $input['date'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('code_data'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="code_data" id="code_data" value="<?php echo isset($input['code_data']) ? $input['code_data'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('year'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="year" id="year" value="<?php echo isset($input['year']) ? $input['year'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('fvalue'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="fvalue" id="fvalue" value="<?php echo isset($input['fvalue']) ? $input['fvalue'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                    </ul>
                </form>

                
            </div></div>
    </section>

</article>