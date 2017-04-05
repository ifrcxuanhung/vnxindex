<script type="text/javascript">
    $(document).ready(function() {                           
        
        $( ".comparebox" ).autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: $base_url + 'ajax',
                    type: 'POST',
                    data: {
                        act: "getDataGlobalBoxHomeObs",
                        name: request.term
                    },
                    success: function(data) {
                        var $data = $.parseJSON(data);
                        response($data);
                    }
                });
            },
            minLength: 2
        });
        ifrc.loadYearObFlexigrid('<?php echo $code; ?>');
    });
</script>
<div style="width: 50%;float: left">
    <table id="loadYearObFlexigrid"></table>
</div>
<div class="compareto" style="width: 50%;float: left">
    <label class="label-compare"><?php echo trans('COMPARE TO'); ?> : </label>
    <input type="text" value="" class="selectNameCompareYear comparebox" name="selectNameCompare"/>
    <button class="btn-compare-year" onclick="ifrc.chartcompare('123','<?php echo $code; ?>','chart-Year','year','selectNameCompareYear','rebase_year')"><?php echo trans('Compare'); ?></button>
    <div id="chart-Year" style="width:610px;" >
    </div>
    <div class="jschart">
        <?= $chart ?>
    </div>
</div>