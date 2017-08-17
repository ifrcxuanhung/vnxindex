<?php 
if($perf_data != ""){
    $i = 0;
	foreach ($perf_data as $row):
?>
    <?php $bgcolor = ($i % 2 == 0) ? '#3f4b4d' : '#202626'; ?>
    <tr bgcolor="<?php echo $bgcolor; ?>" align="left" style=" font-size:11px; height:18px;" class="content">
		<?php
		if(strlen($row['SHORTNAME']) > 32){
			$name = trim(substr($row['SHORTNAME'], 0, 20))."...";
		}else{
			$name = $row['SHORTNAME'];
		}
		?>
        <td style="text-align: left; width: 230px" title="<?php echo $row['SHORTNAME']; ?>">&nbsp;<a href='<?= base_url() . 'performance/chart/' . $row['code'];?>'><?php echo $name; ?></a></td>
        <td rs='<?= $row['m1'] ?>' style="text-align: right; width: 45px;"><?php echo ($row['m1'] != NULL && $row['m1']/1 != 0) ? number_format($row['m1'], 2) : '-'; ?>&nbsp;</td>
        <td rs='<?= $row['m2'] ?>' style="text-align: right; width: 45px;">&nbsp;<?php echo ($row['m2'] != NULL && $row['m2']/1 != 0) ? number_format($row['m2'], 2) : '-'; ?>&nbsp;</td>
        <td rs='<?= $row['m3'] ?>' style="text-align: right; width: 45px;">&nbsp;<?php echo ($row['m3'] != NULL && $row['m3']/1 != 0) ? number_format($row['m3'], 2) : '-'; ?>&nbsp;</td>
        <td rs='<?= $row['m6'] ?>' style="text-align: right; width: 45px;">&nbsp;<?php echo ($row['m6'] != NULL && $row['m6']/1 != 0) ? number_format($row['m6'], 2) : '-'; ?>&nbsp;</td>
        <td rs='<?= $row['y1'] ?>' style="text-align: right; width: 45px;">&nbsp;<?php echo ($row['y1'] != NULL && $row['y1']/1 != 0) ?  number_format($row['y1'], 2) : '-'; ?>&nbsp;</td>
		<td rs='<?= $row['y2'] ?>' style="text-align: right; width: 45px;">&nbsp;<?php echo ($row['y2'] != NULL && $row['y2']/1 != 0) ?  number_format($row['y2'], 2) : '-'; ?>&nbsp;</td>
		<td rs='<?= $row['y3'] ?>' style="text-align: right; width: 45px;">&nbsp;<?php echo ($row['y3'] != NULL && $row['y3']/1 != 0) ?  number_format($row['y3'], 2) : '-'; ?>&nbsp;</td>
		<td rs='<?= $row['y4'] ?>' style="text-align: right; width: 45px;">&nbsp;<?php echo ($row['y4'] != NULL && $row['y4']/1 != 0) ?  number_format($row['y4'], 2) : '-'; ?>&nbsp;</td>
		<!--<td rs='<?= $row['y5'] ?>' style="text-align: right; width: 45px;">&nbsp;<?php //echo ($row['y5'] != NULL && $row['y5']/1 != 0) ?  number_format($row['y5'], 2) : '-'; ?>&nbsp;</td>		-->
        <td rs='<?= $row['ytd'] ?>' style="text-align: right; width: 45px;">&nbsp;<?php echo ($row['ytd'] != NULL && $row['ytd']/1 != 0) ? number_format($row['ytd'], 2) : '-'; ?>&nbsp;</td>
        <td rs='<?= $row['y' . ($year - 1)] ?>' style="text-align: right; width: 50px;">&nbsp;<?php echo ($row['y' . ($year - 1)] != NULL && $row['y' . ($year - 1)]/1 != 0) ? number_format($row['y' . ($year - 1)], 2) : '-'; ?>&nbsp;</td>
        <td rs='<?= $row['y' . ($year - 2)] ?>' style="text-align: right; width: 50px;">&nbsp;<?php echo ($row['y' . ($year - 2)] != NULL && $row['y' . ($year - 2)]/2 != 0) ? number_format($row['y' . ($year - 2)], 2) : '-'; ?>&nbsp;</td>
        <td rs='<?= $row['y' . ($year - 3)] ?>' style="text-align: right; width: 50px;">&nbsp;<?php echo ($row['y' . ($year - 3)] != NULL && $row['y' . ($year - 3)]/3 != 0) ? number_format($row['y' . ($year - 3)], 2) : '-'; ?>&nbsp;</td>
        <td rs='<?= $row['y' . ($year - 4)] ?>' style="text-align: right; width: 50px;">&nbsp;<?php echo ($row['y' . ($year - 4)] != NULL && $row['y' . ($year - 4)]/4 != 0) ? number_format($row['y' . ($year - 4)], 2) : '-'; ?>&nbsp;</td>

    </tr>
    <?php $i++; ?>
<?php 
	endforeach;
}
?>