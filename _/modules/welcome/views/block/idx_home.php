<table>
    <thead>
        <tr>
            <th>Category</th>
            <th style="text-align: right;">Data</th>
            <th style="text-align: right;">Records</th>
            <th style="text-align: right;">From</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (is_array($list)) {
            foreach ($list as $key => $item) {
                if ($item['level2'] == 0) {
                    ?>
                    <tr class="br_tp">
                        <td class="clr_tab_idx_home bg_idx_home"><?php echo $item['category']; ?></td>
                        <td class="clr_tab_idx_home bg_idx_home" style="color: #FFF !important; text-align: right;"><?php echo ($item['data'] != 0) ? number_format($item['data']) : ''; ?></td>
                        <td class="clr_tab_idx_home bg_idx_home" style="color: #FFF !important; text-align: right;"><?php echo ($item['records'] != 0) ? number_format($item['records']) : ''; ?></td>
                        <td class="clr_tab_idx_home bg_idx_home" style="color: #FFF !important; text-align: right;"><?php echo ($item['from'] != 0) ? $item['from'] : ''; ?></td>
                    </tr>
                    <?php
                } else {
                    ?>
                    <tr>
                        <td class="clr_tab_idx_home"><?php echo $item['category']; ?></td>
                        <td style="text-align: right;"><?php echo ($item['data'] != 0) ? number_format($item['data']) : trans('0'); ?></td>
                        <td style="text-align: right;"><?php echo ($item['records'] != 0) ? number_format($item['records']) : trans('0'); ?></td>
                        <td style="text-align: right;"><?php echo ($item['from'] != 0) ? $item['from'] : trans('0'); ?></td>
                    </tr>
                    <?php
                }
            }
        }
        ?>
    </tbody>
</table>