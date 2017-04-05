<style>
    .table-report {
        width: 100% !important;
    }
    .colx2-right{
        width: 60%;
    }
    button{
        margin-left: 15px;
    }

</style>
<article id="custom-hnx" class="fix_auto">
    <section class="grid_10">
        <div class="block-border">
            <div class="block-content">
                <h1>Dividend Daily Report</h1>
                <form action="#" class="block-content form form_fx">
                    <ul class="blocks-list">

                        <li>
                            <a href="#" class="float-left"><img src="<?php echo template_url(); ?>images/icons/fugue/status.png" width="16" height="16">Date</a>
                            <div class="columns">
                                <p class="colx2-right">
                                    <input type="text" name="startdate" id="startdate" value="" style="width: 60%"> <img width="16" height="16" src="<?php echo base_url(); ?>assets/templates/backend/images/icons/fugue/calendar-month.png">
                                    <button type="button" id="save">Execute</button>
                                </p>
                            </div>
                        </li>
                    </ul>
                </form>


            </div></div>
    </section>

</article>
<section class="grid_12">
    <div class="block-border">
        <form class="block-content form-table-ajax" id="" method="post" action="">
            <h1>REPORT</h1>

            <div class="custom-btn" style="display:none;float: right; z-index: 200; position: relative;">
                <div style="clear: left;"></div>
            </div>
            <table class="table table-report table-ajax sortable" cellspacing="0" width="100%" style="display: table">
                <thead>
                    <tr>
                        <th width="20%" scope="col" sType="date" bSortable="true">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('date_ex'); ?>
                        </th>
                        <th width="16%" scope="col" sType="string" bSortable="true">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('ticker'); ?>
                        </th>
                        <th width="16%" scope="col" sType="string" bSortable="true">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('market'); ?>
                        </th>
                        <th width="16%" scope="col" sType="formatted-num" bSortable="true">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('div'); ?>
                        </th>
                        <th width="16%" scope="col" sType="formatted-num" bSortable="true">
                            <span class="column-sort">
                                <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                            </span>
                            <?php trans('exc_info'); ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
        <?php
            if(is_array($dividends)){
                foreach($dividends as $item){
                    ?>
                    <tr>
                        <td><?php echo $item['date_ex']; ?></td>
                        <td><?php echo $item['ticker']; ?></td>
                        <td><?php echo $item['market']; ?></td>
                        <td><?php echo number_format($item['div_value']); ?></td>
                        <td><?php echo $item['exc_info']; ?></td>
                    </tr>
                    <?php
                }
            }
        ?>
                </tbody>
            </table>
        </form>
    </div>
</section>
