<section class="grid_12">
    <div class="block-border">
        <form class="form block-content" id="table_form" method="post" action="">
            <h1><?php trans('mn_Update_report'); ?></h1>
            <div class="no-margin">
                <table class="table sortable no-margin" cellspacing="0" footer="false" search="false" pagination="true" processing="false" width="100%">
                    <thead>
                        <tr>
                            <th width="40%" scope="col" sType="string" bSortable="true">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('File') ?>
                            </th>
                            <th width="40%" scope="col" bSortable="true">
                                <span class="column-sort">
                                    <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                    <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                </span>
                                <?php trans('Table') ?>
                            </th>
                            <th width="10%" scope="col" bSortable="false">
                                <?php trans('Empty'); ?>
                            </th>
                            <th width="10%" scope="col" bSortable="false" class="table-actions">
                                <?php trans('Actions'); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>rs_tables.txt</td>
                            <td>rs_tables</td>
                            <td style="text-align: center;">
                                <input type="checkbox" id="rs_tables" name="rs_tables" style="cursor: pointer;" />
                            </td>
                            <td>
                                <ul class="keywords" style="text-align: center;">
                                    <li class="green-keyword">
                                        <a href="javascript: void(0);" table="rs_tables"><?php trans("bt_upload"); ?></a>
                                    </li>
                               </ul>
                           </td>
                        </tr>
                        <tr>
                            <td>rs_contents.txt</td>
                            <td>rs_contents</td>
                            <td style="text-align: center;">
                                <input type="checkbox" id="rs_contents" name="rs_contents" style="cursor: pointer;" />
                            </td>
                            <td>
                                <ul class="keywords" style="text-align: center;">
                                    <li class="green-keyword">
                                        <a href="javascript: void(0);" table="rs_contents"><?php trans("bt_upload"); ?></a>
                                    </li>
                               </ul>
                           </td>
                        </tr>
                        <tr>
                            <td>rs_contents2.txt</td>
                            <td>rs_contents2</td>
                            <td style="text-align: center;">
                                <input type="checkbox" id="rs_contents2" name="rs_contents2" style="cursor: pointer;" />
                            </td>
                            <td>
                                <ul class="keywords" style="text-align: center;">
                                    <li class="green-keyword">
                                        <a href="javascript: void(0);" table="rs_contents2"><?php trans("bt_upload"); ?></a>
                                    </li>
                               </ul>
                           </td>
                        </tr>
                        <tr>
                            <td>rs_contents3.txt</td>
                            <td>rs_contents3</td>
                            <td style="text-align: center;">
                                <input type="checkbox" id="rs_contents3" name="rs_contents3" style="cursor: pointer;" />
                            </td>
                            <td>
                                <ul class="keywords" style="text-align: center;">
                                    <li class="green-keyword">
                                        <a href="javascript: void(0);" table="rs_contents3"><?php trans("bt_upload"); ?></a>
                                    </li>
                               </ul>
                           </td>
                        </tr>
                        <tr>
                            <td>rs_contents4.txt</td>
                            <td>rs_contents4</td>
                            <td style="text-align: center;">
                                <input type="checkbox" id="rs_contents4" name="rs_contents4" style="cursor: pointer;" />
                            </td>
                            <td>
                                <ul class="keywords" style="text-align: center;">
                                    <li class="green-keyword">
                                        <a href="javascript: void(0);" table="rs_contents4"><?php trans("bt_upload"); ?></a>
                                    </li>
                               </ul>
                           </td>
                        </tr>
                        <tr>
                            <td>rs_contents5.txt</td>
                            <td>rs_contents5</td>
                            <td style="text-align: center;">
                                <input type="checkbox" id="rs_contents5" name="rs_contents5" style="cursor: pointer;" />
                            </td>
                            <td>
                                <ul class="keywords" style="text-align: center;">
                                    <li class="green-keyword">
                                        <a href="javascript: void(0);" table="rs_contents5"><?php trans("bt_upload"); ?></a>
                                    </li>
                               </ul>
                           </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</section>
<script type="text/javascript">
    $( document ).ready(function() {
        $(".green-keyword a").click(function () {
            var table = $(this).attr("table");
            var empty = 0;
            if ($("input[name="+table+"]").prop('checked') === true) {
                empty = 1;
            }

            $.modal({
                content: '<label id="message" name="message">Are you sure?</label>',
                title: 'Confirmation',
                maxWidth: 2500,
                width: 400,
                buttons: {
                    'Yes': function(win) {
                        $("#message").html("Processing...");
                        $.ajax({
                            type: "POST",
                            url: $admin_url+"update_report/upload",
                            data: "table="+table+"&empty="+empty,
                            async: false,
                            success: function(msg) {
                                $("#message").html(msg);
                            }
                        });
                    },
                    'Close': function(win) {
                        win.closeModal();
                    }
                }
            });
            $('.modal-window .block-content .block-footer').find('button:eq(1)').attr('class', 'red');
        });
    });
</script>