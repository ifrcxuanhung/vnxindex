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

        ifrc.loadMonthObFlexigrid('<?php echo $code; ?>');
    });
</script>
<div style="width: 50%;float: left">
	<table id="loadMonthObFlexigrid" style="height:200px;"></table>
    
</div>
<div class="compareto" style="width: 50%;float: left">
    <label class="label-compare"><?php echo trans('COMPARE TO') ?> : </label>
    <input type="text" value="" class="selectNameCompareMonth comparebox" name="selectNameCompare"/>
    <button class="btn-compare-month" onclick="ifrc.chartcompare('123','<?php echo $code; ?>','chart-month','month','selectNameCompareMonth','rebase_month')"><?php echo trans('Compare'); ?></button>
    <div id="chart-month" style="width:610px;">
    </div>
    <div class="jschart">
         <?php echo  $chart ?>
    </div>
</div>

