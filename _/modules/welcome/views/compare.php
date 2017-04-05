<div id="content" role="main" class="observatory-content">
    <div class="intro_copn" style="width:97%">
        <div class="breadcrumb">
            <a href="<?= base_url(); ?>" class="lnk_home"><?= trans('Home'); ?></a>
            <span><?= trans('indexes_performance_comparison'); ?></span>
        </div>
        <div style="float:left; margin-top: 20px">
            <h2><?= trans('indexes_performance_comparison'); ?></h2>
            <p style="text-align: justify;font-size: 11pt;"><?= trans('description_indexes_comparison'); ?></p>
        </div>
        <label class="count_all_annual"><span><?php echo $count ?></span> <?= trans('count_indexes_comparison')?></label>
        <div class="container" style="width: 100%; float: left; clear: both">
            <div class="box_search_obs">
                <!--**********phần search observatoire **********************************************-->
                <div name="search_obs">
                    <div class="search_element" style="width:41%; margin-right:2%">
                        <label><?= trans('Index 1'); ?></label>
                        <input id="index_from" class="input_auto" value="" style="width:100%"/>
                    </div>

                    <div class="search_element" style="width:41%">
                        <label><?= trans('Index 2'); ?></label>
                        <input id="index_to" class="input_auto" value="" style="width:100%"/>
                    </div>

                    <div class="search_element" style="width:10%">
                        <label style="height:17px"></label>
                        <a style="cursor: pointer; display: inline-block" width="66" id="run" ><img  src="<?php echo base_url() ?>templates/images/search.png"/></a>
                    </div>

                </div>
                <!--**********hết phần search observatoire **********************************************-->
            </div>
        </div>
        <!-- Ket thuc container -->
        <div class="clear"></div>
        <div id="show_string_compare" style="width:100%; text-align:center; margin:10px 0px"></div>
        <!-- end main content -->
        <!-- các tab content -->
        <div class="detail-observatoire">

        </div>
        <!-- hết các tab-->
        <!-- ############# Ket thuc Observatory ########### -->
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function(){
        var data_indexes_php = <?= json_encode($data_index) ?>;
        var data_indexes = [];
        $.each(data_indexes_php, function(i, item){
            data_indexes.push(item.shortname);
        });
        $( ".input_auto" ).autocomplete({
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
        $("#run").click(function(){
            var name_from = $("#index_from").val();
            
            var name_to = $("#index_to").val();
            if(name_from !== "" && name_to !== ""){
                var html = "<h3 style='font-size:24px'>" + name_from + " vs " + name_to + "</h3>";
                $("#show_string_compare").html(html);
                ifrc.showDetailCompare(name_from, name_to);
            }
        });
    });
</script>