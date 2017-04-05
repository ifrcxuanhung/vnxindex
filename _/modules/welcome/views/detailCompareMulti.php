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
#chart-Year, #chart-Month{
    height: 437px;
    margin-top: 10px;
    width: 685px;
}
</style>

<script>

Cufon.replace('h1, h2, h3, h4');

</script>

<div id="tabs_global" style="z-index:0">

    <div id="tabs_detail_compare">

        <ul>

            <li><a tabid="1" class="detail-compare-monthly" name="" href="#tabs_compare_Monthly"><?php echo $data['mtran']->get_translates('Monthly', $data['nn']); ?></a></li>

            <li><a tabid="2" class="detail-compare-yearly" name="" href="#tabs_compare_Yearly"><?php echo $data['mtran']->get_translates('Yearly', $data['nn']); ?></a></li>

            <li><a tabid="3" class="detail-compare-chartofmonth" name="" href="#tabs_compare_chartofmonth"><?php echo $data['mtran']->get_translates('Chart of Month', $data['nn']); ?></a></li>

            <li><a tabid="4" class="detail-compare-chartofyear" name="" href="#tabs_compare_chartofyear"><?php echo $data['mtran']->get_translates('Chart of Year', $data['nn']); ?></a></li>

            <li><a tabid="5" class="detail-compare-factsheet" name="" href="#tabs_compare_factsheet"><?php echo $data['mtran']->get_translates('Factsheet', $data['nn']); ?></a></li>

        </ul>


        <div id="tabs_compare_Monthly" class="loadMonthCompareMulti">

            <script>ifrc.loadMonthCompareMulti("<?= $data['data'] ?>");</script>

        </div>

        <div id="tabs_compare_Yearly" class="loadYearCompareMulti" >

            <script>ifrc.loadYearCompareMulti("<?= $data['data'] ?>");</script>

        </div>

        <div id="tabs_compare_chartofmonth" class="loadChartofMonth" >

            <script>ifrc.loadChartofMonth("<?= $data['data_chart'] ?>");</script>

        </div>

        <div id="tabs_compare_chartofyear" class="loadChartofYear" >

            <script>ifrc.loadChartofYear("<?= $data['data_chart'] ?>");</script>

        </div>

        <div id="tabs_compare_factsheet" class="loadFactsheet" >

            <script>ifrc.loadFactsheet("<?= $data['data'] ?>");</script>

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