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
</style>
<article class="no-margin">
    <section id="box-info" class="grid_5"<?php if(isset($input)) echo ' style="display: none;"'; ?>>
        <div class="block-border">
            <div class="block-content">
            <h1>Dividends</h1>
                <div class="block-controls">
                    <div class="fx_bt_indi ">
                        <input type="radio" name="market" class="market" value="HSX"<?php if(!isset($input['market']) || $input['market'] == 'HSX') echo ' checked'; ?> /> <b>HSX</b>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="market" class="market" value="HNX"<?php if(isset($input['market']) && $input['market'] == 'HNX') echo ' checked'; ?> /> <b>HNX</b>&nbsp;&nbsp;&nbsp;
                        <button type="button" class="import">>></button>
                        <div style="clear: left;"></div>
                    </div>
                    
                </div>
                <form class="block-content form form_fx" style="height: 550px">
                    <textarea name="dividends-text" id="dividends-text" style="height: 100%; width: 100%"><?php if(isset($input['notice'])) echo $input['notice']; ?></textarea>
                </form>
            </div>
        </div>
    </section>
    <section class="grid_1" style="margin-top: 15%">
    </section>
    <section id="box-detail" class="grid_5"<?php if(isset($input)) echo ' style="margin-left: 30%"'; ?>>
        <div class="block-border">
            <div class="block-content">
                <h1><?php trans('mn_dividends'); ?></h1>
                <div class="block-controls">
                    <div class="fx_bt_indi ">
                        <input type="checkbox" name="chk_confirm" <?php if(isset($input['confirm']) && $input['confirm'] == 1) echo 'checked'; ?>/> <b>Confirm</b>&nbsp;&nbsp;&nbsp;
                        <?php if(isset($input)){ ?><button id="btn-info" type="submit"><?php trans('bt_info'); ?></button><?php } ?>
                        <button id="btn-save" type="submit"><?php trans('bt_save'); ?></button>
                        <div style="clear: left;"></div>
                    </div>
                </div>
                <form id="formDividends" name="formDividends" action="" method="post" class="block-content form form_fx" style="min-height: 530px">
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
                            <input type="hidden" name="notice" id="notice" value="" />
                            <input type="hidden" name="confirm" id="confirm" value="" />
                            <input type="hidden" name="date_cnf" id="date_cnf" value="" />
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('ticker'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" class="full-width" name="ticker" id="ticker" value="<?php echo isset($input['ticker']) ? $input['ticker'] : NULL; ?>" />
                                </p>
                                <?php echo form_error('ticker', '<div class="message error">', '</div>'); ?>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('market'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="market" id="market" value="<?php echo isset($input['market']) ? $input['market'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('Announced_date'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="date_ann" id="date_ann" value="<?php echo isset($input['date_ann']) ? $input['date_ann'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('Ex-right_date'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="date_ex" id="date_ex" value="<?php echo isset($input['date_ex']) ? $input['date_ex'] : NULL; ?>" class="full-width">
                                </p>
                                <?php echo form_error('ticker', '<div class="message error">', '</div>'); ?>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('Record_date'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text"  class="full-width" name="date_rec" id="date_rec" value="<?php echo isset($input['date_rec']) ? $input['date_rec'] : NULL; ?>">
                                    <!-- <img width="16" height="16" src="<?php //echo template_url(); ?>images/icons/fugue/calendar-month.png"/> -->
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('Payment_method'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="pay_met" id="pay_met" value="<?php echo isset($input['pay_met']) ? $input['pay_met'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('Payment_date'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="date_pay" id="date_pay" value="<?php echo isset($input['date_pay']) ? $input['date_pay'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('Fiscal_year'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="pay_yr" id="pay_yr" value="<?php echo isset($input['pay_yr']) ? $input['pay_yr'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('period'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="pay_per" id="pay_per" value="<?php echo isset($input['pay_per']) ? $input['pay_per'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('Dividend_payout'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="dividend" id="dividend" value="<?php echo isset($input['dividend']) ? $input['dividend'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('Dividend_yield'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="yield" id="yield" value="<?php echo isset($input['yield']) ? $input['yield'] : NULL; ?>" class="full-width">
                                </p>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16"><?php trans('Status'); ?></a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="radio" name="status" id="status" value="D"<?php echo ((isset($input['status']) && $input['status'] == 'D')) ? ' checked' : NULL; ?> //> Done 
                                    <input type="radio" name="status" id="status" value="S"<?php echo (isset($input['status']) && $input['status'] == 'S') ? ' checked' : NULL; ?> //> Suspense 
                                    <input type="radio" name="status" id="status" value="C"<?php echo (isset($input['status']) && $input['status'] == 'C') ? ' checked' : NULL; ?> //> Cancel 
                                </p>
                            </div>
                        </li>
                    </ul>
                </form>

                
            </div></div>
    </section>

</article>