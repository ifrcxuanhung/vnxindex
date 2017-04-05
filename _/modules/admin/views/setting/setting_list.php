<style>
    .css_test {
        height: 32em !important;
    }
    div.dataTables_scroll { 
        clear: both; 
        margin-top: -1.667em;
    }
    .dataTables_scrollHeadInner{
        background: -moz-linear-gradient(center top , #CCCCCC, #A4A4A4) repeat scroll 0 0 transparent;
        border-color: white #999999 #828282 #DDDDDD;
        border-style: solid;
        border-width: 1px;
        color: white;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.7);
    }
    .dataTables_scrollHeadInner table{
        display: block !important;
        height: 50px;
        margin-top: -1px;
    }
    .tabs-content-info {
        height: auto !important;
    }

    .tabs-content {
        height: auto !important;
    }
</style>
<section class="grid_12">
    <div class="block-border">
        <form class="block-content form" id="table_form" method="post" action="" style="padding-top: 10px; height: 415px; margin-top: 20px;">
            <h1 style="top: -35px;"><?php trans('mn_setting'); ?></h1>

            <div style="float: right; margin-right: 20px; padding-top: 5px;" class="custom-btn">
                <button onclick="$(location).attr('href', '<?php echo admin_url() . 'setting/add' ?>');" style="float: left; height:30px;" type="button"><?php trans('bt_add'); ?></button>
                <div style="clear: left;"></div>
            </div>

            <div class="no-margin">
                <table class="table sortable no-margin" cellspacing="0" footer="false" search="true" pagination="false" page="setting" width="100%">
                    <thead>
                        <tr>
                            <th width="20%" scope="col" sType="string" bSortable="true">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('key'); ?>
                            </th>
                            <th scope="col" sType="string" bSortable="true">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('value'); ?>
                            </th>
                            <th width="12%" scope="col" sType="string" bSortable="true">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('group'); ?>
                            </th>
                            <th width="15%" scope="col" class="table-actions"><?php trans('actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($list_setting):
                            foreach ($list_setting as $value):
                                ?>
                                <tr>
                                    <td style="text-align: left; width: 20%;"><?php echo $value['key']; ?></td>
                                    <td style="text-align: left;"><?php echo $value['value']; ?></td>
                                    <td style="text-align: left; width: 12%;"><?php echo $value['group']; ?></td>
                                    <td style="text-align: center; width: 15%;">
                                        <ul class="keywords">
                                            <li class="green-keyword">
                                                <a href="<?php echo admin_url() . 'setting/edit/' . $value['setting_id']; ?>"><?php trans('bt_edit'); ?></a>
                                            </li>
                                            <li class="red_fx_keyword">
                                                <a class="delete" setting_id="<?php echo $value['setting_id']; ?>" href="javascript:;"><?php trans('bt_delete'); ?></a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</section>
<script>
                    $(function() {
                        $("a.delete").click(function() {
                            var $this = this
                            $.modal({
                                content: 'Are you sure?',
                                title: 'Delete',
                                maxWidth: 2500,
                                width: 400,
                                buttons: {
                                    'Yes': function(win) {
                                        var id = $($this).attr("setting_id");
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo admin_url() ?>setting/delete",
                                            data: "id=" + id,
                                            success: function(msg) {
                                                win.closeModal();
                                                if (msg >= 1) {
                                                    $($this).parents('tr').fadeOut('slow');
                                                }
                                            }
                                        });
                                    },
                                    'Cancel': function(win) {
                                        win.closeModal();
                                    }
                                }
                            });
                            $('.modal-window .block-content .block-footer').find('button:eq(1)').attr('class', 'red');
                        });
                    });
</script>