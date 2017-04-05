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
.fx_bt_indi{
    margin-top: 10px;
}
.colx2-right{
    width:70%;
}
.container_12 .grid_5{
    width: 60%;
}
</style>
<article class="no-margin">
    <section class="grid_1" style="margin-top: 15%">
    </section>
    <section id="box-detail" class="grid_5"<?php if(isset($input)) echo ' style="margin-left: 11%"'; ?>>
        <div class="block-border">
            <div class="block-content">
                <h1><?php trans('mn_Document_Paper'); ?></h1>
                <div class="block-controls">
                    <div class="fx_bt_indi ">
                        <button id="btn-save" type="submit"><?php trans('bt_save'); ?></button>
                        <div style="clear: left;"></div>
                    </div>
                </div>
                <form id="formPapers" name="formPapers" action="" method="post" class="block-content form form_fx" style="min-height: 300px">
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
                <?php endif; ?>
                    <ul class="blocks-list">                    
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('title'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" class="full-width" name="title" id="title" value="<?php echo isset($input['title']) ? $input['title'] : NULL; ?>" />
                                </p>
                                <?php echo form_error('title', '<div class="message error">', '</div>'); ?>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('journal'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="journal" id="journal" value="<?php echo isset($input['journal']) ? $input['journal'] : NULL; ?>" class="full-width">
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
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('month'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="month" id="month" value="<?php echo isset($input['month']) ? $input['month'] : NULL; ?>" class="full-width">
                                </p>
                                <?php echo form_error('month', '<div class="message error">', '</div>'); ?>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('volume'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text"  class="full-width" name="volume" id="volume" value="<?php echo isset($input['volume']) ? $input['volume'] : NULL; ?>">
                                    <!-- <img width="16" height="16" src="<?php //echo template_url(); ?>images/icons/fugue/calendar-month.png"/> -->
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('number'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="number" id="number" value="<?php echo isset($input['number']) ? $input['number'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('page'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="page" id="page" value="<?php echo isset($input['page']) ? $input['page'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('keywords'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="keywords" id="keywords" value="<?php echo isset($input['keywords']) ? $input['keywords'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('abstract'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <textarea name="abstract" id="abstract" style="height: 150px; width: 97%"><?php if(isset($input['abstract'])) echo $input['abstract']; ?></textarea>
                                </p>
                            </div>
                        </li>
                    </ul>
                </form>
            </div></div>
    </section>
</article>