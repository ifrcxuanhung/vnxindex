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
        <form class="block-content form" id="table_form" method="post" action="">
            <h1><?php trans('mn_Translate'); ?></h1>

            <div style="float: right; margin-right: 20px; padding-top: 4px;" class="custom-btn">
                <button onclick="$(location).attr('href', '<?php echo admin_url() . 'translate/add' ?>');" class="" type="button"><?php trans('bt_add'); ?></button>
                <div style="clear: left;"></div>
            </div>

            <div class="no-margin">
                <table class="table sortable no-margin" cellspacing="0" footer="false" search="true" pagination="false" page="translate" width="100%">
                    <thead>
                        <tr>
                            <th width="15%" scope="col" sType="string" bSortable="true">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('word') ?>
                            </th>
                            <?php
                            foreach ($list_language as $value) {
                                ?>
                                <th width="<?php echo (62 / count($value)); ?>%" scope="col" sType="string" bSortable="true">
                                    <span class="column-sort">
                                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                    </span>
                                    <?php trans($value['name']); ?>
                                </th>
                                <?php
                            }
                            ?>
                            <th width="15%" scope="col" class="table-actions"><?php trans('actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($list_translate != false)
                            foreach ($list_translate as $key => $value) {
                                ?>
                                <tr>
                                    <td style="text-align: left; width: 15%;"><?php echo cut_str($value['word'], 30, ' [...]'); ?></td>
                                    <?php
                                    foreach ($list_language as $item) {
                                        ?>
                                        <td style="text-align: left; width: <?php echo 62 / count($item); ?>%;"><?php echo isset($value['translate'][$item['code']]) ? cut_str($value['translate'][$item['code']], 55 / count($item), ' [...]') : ''; ?></td>
                                        <?php
                                    }
                                    ?>
                                    <td style="text-align: center; width: 15%;" class="table-actions" >
                                        <ul class="keywords">
                                            <li class="green-keyword">
                                                <a title="<?php trans('bt_edit'); ?>" class="with-tip" href="<?php echo admin_url() . 'translate/edit/' . $value['word']; ?>"><?php trans('bt_edit'); ?></a>
                                            </li>
                                            <li class="red_fx_keyword">
                                                <a title="<?php trans('bt_delete'); ?>"  class="with-tip delete" translate_word="<?php echo $value['word']; ?>" href="javascript:;"><?php trans('bt_delete'); ?></a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</section>
<script>
                    $(function() {
                        $(".delete").click(function() {
                            var $this = this
                            $.modal({
                                content: 'Are you sure?',
                                title: 'Delete',
                                maxWidth: 2500,
                                width: 400,
                                buttons: {
                                    'Yes': function(win) {
                                        var word = $($this).attr("translate_word");
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo admin_url() ?>translate/delete",
                                            data: "word=" + word,
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