<style>
.hDivBox{ width:100% !important;}
#loadDayObFlexigrid tr{ height:25px;}
#loadMonthObFlexigrid tr{height:25px;}
#loadYearObFlexigrid tr{height:25px;}
</style>
<script>

    Cufon.replace('h1, h2, h3, h4');

</script>

<h2 style="margin:20px 0;"><?php echo isset($name['NAME']) ? $name['NAME'] : trans("No name", 1); ?></h2>

<div id="tabs_global">

    <div id="tabs_detail_ob">

        <ul>

            <li><a tabid="0" name="<?php echo $code; ?>" href="#tabs_ob_Daily"><?php trans('Daily'); ?></a></li>

            <li><a tabid="1" class="detail-ob-monthly" name="<?php echo $code; ?>" href="#tabs_ob_Monthly"><?php trans('Monthly'); ?></a></li>
           <!-- <li><a tabid="6" class="detail-ob-quaterly" name="<?php echo $code; ?>" href="#tabs_ob_Quaterly"><?php trans('Quaterly'); ?></a></li>-->


            <li><a tabid="2" class="detail-ob-yearly" name="<?php echo $code; ?>" href="#tabs_ob_Yearly"><?php trans('Yearly'); ?></a></li>


            <li><a tabid="3" name="<?php echo $code; ?>" href="#tabs_ob_Constituents"><?php trans('Constituents'); ?></a></li>

            <li><a tabid="4" name="<?php echo $code; ?>" href="#tabs_ob_Rules"><?php trans('factsheet'); ?></a></li>

            <li><a tabid="5" name="<?php echo $code; ?>" href="#tabs_ob_Publications"><?php trans('Publications'); ?></a></li>

        </ul>

        <div id="tabs_ob_Daily" class="loadDayOb">
            <script>ifrc.loadDayOb('<?php echo $code; ?>');</script>
        </div>

        <div id="tabs_ob_Monthly" class="loadMonthOb">
            <script>ifrc.loadMonthOb('<?php echo $code; ?>');</script>

        </div>


         <!--<div id="tabs_ob_Quaterly" class="loadQuaterOb">
           <script>ifrc.loadQuaterOb('<?php echo $code; ?>');</script>
        </div>-->

        <div id="tabs_ob_Yearly" class="loadYearOb">
            <script>ifrc.loadYearOb('<?php echo $code; ?>');</script>
        </div>

        <div id="tabs_ob_Constituents">

            <div style="background-color:1px dotted #CCCCCC; width:100%;">

                <div id="laptrinh"></div>

                <div class="compo_paging"></div>

            </div>

        </div>


        <div id="tabs_ob_Rules" class="loadRulesOb">
            <script>ifrc.loadRulesOb('<?php echo $code; ?>');</script>
        </div>

        <div id="tabs_ob_Publications" class="loadPublicOb">
            <script>ifrc.loadPublicOb('<?php echo $code; ?>');</script>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        $('#tabs_detail_ob').tabs({
            activate: function(e, ui) {
                console.log(e);
            }
        });
        $('#tabs_global').fadeIn();
        $('#tabs_detail_ob').css({'width': '99%'});
        $('#tabs_ob_Constituents').css({'width': '99%'});
        $('#tabs_ob_Rules').css({'width': '99%'});
        $('#tabs_ob_Publications').css({'width': '99%'});
    });

    ifrc.loadcompo('<?php echo $code; ?>', 0);

</script>