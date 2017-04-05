<div style="background-color:1px dotted #CCCCCC; width:100%;">
    <table class="format-table" width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size:11px; height:15px;">
        <tbody>
            <tr style="font-size:12px;height:20px;" align="center">
                <td height="20px" width="5%"><b><?php trans('No'); ?></b></td>
                <td height="20px" width="15%" align="left">&nbsp;&nbsp;<b><?php trans('Date'); ?></b></td>
                <td height="20px" width="60%" align="left">&nbsp;&nbsp;<b><?php trans('Information'); ?></b></td>
                <td height="20px" width="20%" align="left">&nbsp;&nbsp;<b><?php trans('Format'); ?></b></td>
            </tr>
            <?php
            $i = 1;
            if ($data) {
                foreach ($data as $row) {
                    if ($i % 2 == 0) {
                        ?>
                        <tr align="center" style=" font-size:11px; height:18px">
                        <?php } else { ?>
                        <tr class="odd" align="center" style=" font-size:11px; height:18px">
                        <?php } ?>
                        <td width="5%"><?php echo $i; ?></td>
                        <td width="15%"><?php echo $row['DATE']; ?></td>
                        <td width="60%" align="left" style="padding-left:5px;"><?php echo $row['NAME']; ?></td>
                        <td height="22" width="20%" align="left" style="padding-left:5px;">&nbsp;&nbsp;<?php
                            if ($row['TYPE'] != "" && $row['URL'] != "") {
                                ?>
                                <a href="<?php echo strpos($row['URL'], "http://") !== false ? $row['URL'] : base_url() . $row['URL']; ?>" target="_blank" title="Click here to download"><img src="<?php echo base_url(); ?>templates/images/<?php echo strtolower($row['TYPE']); ?>.png" width="20" border="0"/></a>
                                <?php
                            }
                            ?></td>
                            <?php
                            echo "</tr>";
                            $i++;
                        }
                    } else {
                        echo '<tr class="odd" align="center" style=" font-size:11px; height:18px"><td colspan="4">No Result</td></tr>';
                    }
                    ?>
        </tbody>
    </table>
    <!-- End composition -->
</div>