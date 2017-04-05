<input id="hnx" type="hidden" value="<?php echo json_encode($hnx); ?>" />
<input id="vni" type="hidden" value="<?php echo json_encode($vni); ?>" />
<input id="code" type="hidden" value="<?php echo $icode; ?>" />
<div style="margin: 6px">
    <?php
    if($icode == "")
    {
    ?>
    <select style='width:250px' name="code">
        <?php
        if (!empty($sample)) {
            foreach ($sample as $code => $name) {
                ?>
                <option value="<?php echo $code; ?>"<?php echo ($code == 'VNX25PRVND') ? ' selected' : ''; ?>><?php echo $name; ?></option>
                <?php
            }
        }
        ?>
    </select>
    <button id="btn-compare" style="float: right; margin: -4px"><?php trans('compare'); ?></button>
    <?php
    }
    else
    {
    ?>
    <select style="display: none;" name="code">
        <?php
        if (!empty($sample)) {
            foreach ($sample as $code => $name) {
                ?>
                <option value="<?php echo $code; ?>"<?php echo ($code == $icode) ? ' selected' : ''; ?>><?php echo $name; ?></option>
                <?php
            }
        }
        ?>
    </select>
    <button style="display: none;" id="btn-compare" style="float: right; margin: -4px"><?php trans('compare'); ?></button>
    <?php } ?>

</div>
<div id="compare-chart" style="width: 100%; margin-top: 20px"></div>
<div class="last_update" style="position:absolute; bottom:30px; right:30px;"><?php echo date("Y-m-d",strtotime($date_last['date']));?></div>