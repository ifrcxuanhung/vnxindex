<script type="text/javascript">
    $(document).ready(function() {  
        ifrc.loadYearCompareFlexigrid('<?= $code_from; ?>','<?= $code_to; ?>');
    });
</script>
<div style="width: 50%;float: left;">
    <table id="loadYearCompareFlexigrid" ></table>
</div>
<div class="compareto" style="width:50%">    
    <div id="chart-Year" style="width:610px;">
    </div>
    <div class="jschart">
        <?php echo $chart ?>
    </div>
</div>
