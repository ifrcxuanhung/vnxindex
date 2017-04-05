<style type="text/css">
#tabs_global .ui-widget-content{
    width:99% !important;
}
.flexigrid div.hDiv{
    background: #011129;
    height:30px;
}
.flexigrid div.hDiv table{
    border: none;
}
</style>

<script>

Cufon.replace('h1, h2, h3, h4');

</script>

<div id="tabs_global" style="z-index:0">

    <div id="tabs_detail_compare">

        <ul>

            <li><a tabid="1" class="detail-compare-monthly" name="" href="#tabs_compare_Monthly"><?= trans('Monthly'); ?></a></li>

            <li><a tabid="2" class="detail-compare-yearly" name="" href="#tabs_compare_Yearly"><?= trans('Yearly'); ?></a></li>

        </ul>


        <div id="tabs_compare_Monthly" class="loadMonthCompare">

            <script>ifrc.loadMonthCompare("<?= $code_from ?>","<?= $code_to ?>");</script>

        </div>

        <div id="tabs_compare_Yearly" class="loadYearCompare" >

            <script>ifrc.loadYearCompare("<?= $code_from ?>","<?= $code_to ?>");</script>

        </div>

    </div>

</div>

<script>

    $(document).ready(function() {

        var href2 = $(location).attr('href');

        href2=ifrc.explode('#',href2);
        $('#tabs_detail_compare').tabs({

            activate: function(e, ui) {

                console.log(e);

            }

        });
        $('#tabs_global').fadeIn();
		$('#tabs_detail_compare').css({'width':'100%'});
    });

    // ifrc.loadcompo('',0);

</script>