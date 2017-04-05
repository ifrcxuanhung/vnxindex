<script type="text/javascript">
    $(document).ready(function() {
		

        $(".comparebox").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '<?php echo base_url() ?>ajax',
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

        ifrc.loadDayObFlexigrid('<?php echo $code; ?>');
    });
</script>
<div style="width: 50%;float: left">
    <table id="loadDayObFlexigrid"></table>
</div>
<div class="compareto" style="width: 50%;float: left">
    <label class="label-compare"><?php echo trans('COMPARE TO') ?> : </label>
    <input type="text" value="" class="selectNameCompareDay comparebox" name="selectNameCompare"/>
    <button class="btn-compare-month" onclick="ifrc.chartcompare('123','<?php echo $code; ?>','chart-Day','day','selectNameCompareDay','rebase_day')"><?php echo trans('Compare'); ?></button>
    <div id="chart-Day" style="width:610px;">
    </div>
    <div class="jschart">
         <?= $chart ?>
    </div>
</div>
