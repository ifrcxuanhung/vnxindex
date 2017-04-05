<script type="text/javascript">
    $(document).ready(function() {
        ifrc.loadMonthCompareFlexigrid('<?= $code_from; ?>','<?= $code_to; ?>');
    });
</script>
<div style="width: 50%;float: left;">
    <table id="loadMonthCompareFlexigrid" ></table>
</div>
<div class="compareto" style="width:50%">
    <div id="chart-month" style="width:610px;">
    </div>
    <div class="jschart">
        <?php echo $chart ?>
    </div>
</div>
