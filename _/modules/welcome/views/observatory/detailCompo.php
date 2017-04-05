<style>
.hung-cus th{ font-size:13px; line-height:20px;}
.flexigrid div.hDiv .right_text{ text-align:right;}
.hDiv td{ height: 26px;
    line-height: 24px;
    padding-top: 3px !important;}
</style>
<div style="background-color:1px dotted #CCCCCC; width:100%;">
<div class="flexigrid">
<div class="hDiv">

    <table width="100%" class="format-table hung-cus" cellspacing="0" cellpadding="0" border="0" style="font-size:11px">
        <thead>
            <tr style="font-size:12px;">
                <th  align="center" ><b><?php trans('No'); ?></b></th>
                <th align="left" ><b><?php trans('ISIN'); ?></b></th>
                <th  align="left" ><b><?php trans('Name'); ?></b></th>
                <th  align="left" ><b><?php trans('Currency'); ?></b></th>
                <th align="right" class="right_text"><b><?php trans('Shares'); ?></b></th>
                <th  align="right" class="right_text"><b><?php trans('Last'); ?></b></th>
                <th align="center"  class="right_text"><b><?php trans('Date'); ?></b></th>
                <th  align="right" class="right_text"><b><?php trans('Weight'); ?></b></th>
<!--                <th  align="right"  class="right_text"><b>--><?php //trans('YTD %'); ?><!--</b></th>-->
                <th  align="right" class="right_text"><b><?php trans('Info'); ?></b></th>
            </tr>
            </thead>
             <tbody>
            <?php
            $i = 1;
            if (isset($data))
            {
                /* find max weight */
                $result = array();
                foreach ($data as $findMax)
                {
                    $result[] = $findMax['weight'];
                }
                $maxWeight = @max($result);

                foreach ($data as $row)
                {

                    if ($i % 2 == 0)
                    {
                        ?>
                        <tr align="center" style=" font-size:11px;">
                            <?php
                        }
                        else
                        {
                            ?>
                        <tr class="odd" align="center" style=" font-size:11px;">
                        <?php } ?>
                        <td ><?php echo $i + $page; ?></td>
                        <td  align="left" style="padding-left:5px;"><?php echo $row['isin']; ?></td>
                        <td  align="left" style="padding-left:5px;"><?php echo $row['name']; ?></td>
                        <td  align="left" style="padding-left:5px;"><?php echo $row['curr']; ?></td>
                        <td  align="right" style="padding-right:5px;"><?php
                            if ($row['shares'] != NULL)
                            {
                                echo number_format($row['shares']);
                            }
                            ?></td>   
                        <td  align="right" style="padding-right:5px;"><?php
                            if ($row['last'] != NULL)
                            {
                                echo number_format(round($row['last'], 4), 2, '.', ',');
                            }
                            ?></td>
                        <td  align="right" style="padding-right:5px;"><?php echo $row['date']; ?></td>
                        <td  align="right" style="padding-right:5px;"><?php
                            if ($maxWeight > 0)
                            {
                                echo number_format($row['weight'], 2, '.', ',');
                            }
                            ?></td>
<!--                            <!-- <td  align="right" style="padding-right:5px;color: "><?php echo $row['perf'] < 0 ? "#ff492a" : "#92dd4b"; ?>;">
                            <?php if ($row['perf'] != NULL)
{
    echo number_format(round($row['perf'], 4), 2, '.', ',');
}
else
    echo '-';
?></td>-->
                            <td  align="right" >
                            <div > 
       
                            <a href="<?php echo base_url();?>report_stock/<?php echo $row['isin']; ?>" style="cursor:pointer" target="_blank"><img src="<?php echo base_url(); ?>templates/images/more.png"/> </a>
                             
    						</div>
                            </td>
                        <?php
                        echo "</tr>";
                        $i++;
                    }
                }
                ?>
        </tbody>
    </table>
    
    </div>
    </div>
</div>