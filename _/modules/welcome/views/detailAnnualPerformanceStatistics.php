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

    <div id="tabs_detail_annual">

        <ul>
            <?php
            $i=1;
            foreach($year as $itemY){
              echo '<li><a tabid="'.$i.'" class="detail-annual-'.$itemY['year'].'" name="" href="#tabs_annual_'.$itemY['year'].'">'.trans($itemY['year'], 1).'</a></li>';
              $i++;
            }
            ?>
        </ul>
        <div class="container" style="width: 100%; float: left; clear: both; margin-top:20px">
            <div class="box_search_obs">
                <!--**********phần search observatoire **********************************************-->
                <div name="search_obs">
                    <form id="sform" style="width:98%; margin-right:2%">
                        <div style="float:right; margin-left:20px">
                            <button style="background:url(<?= base_url() ?>templates/images/search.png); width: 66px; height:28px; display:inline-block; cursor: pointer; border: none"></button>
                        </div>
                        <div style="float:right; margin-right:20px">
                            <label style="float:left; margin-right:10px; line-height:25px"><?= trans('Provider'); ?></label>
                            <select style="float:left" name="providerFilter">
                                <option value="all"><?= trans('All'); ?></option>
                                <?php
                                foreach($provider as $itemC){
                                    echo '<option value="'.$itemC['provider'].'">'.$itemC['provider'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div style="float:right; margin-right:20px">
                            <label style="float:left; margin-right:10px; line-height:25px"><?= trans('Type'); ?></label>
                            <select style="float:left" name="typeFilter">
                                <option value="all"><?= trans('All'); ?></option>
                                <option value="pr" selected="selected">PR</option>
                                <?php
                                foreach($type as $itemT){
                                    echo '<option value="'.$itemT['type'].'">'.$itemT['type'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div style="float:right; margin-right:20px">
                            <label style="float:left; margin-right:10px; line-height:25px"><?= trans('Currency'); ?></label>
                            <select style="float:left" name="currencyFilter">
                                <option value="all"><?= trans('All'); ?></option>
                                <option value="vnd" selected="selected">VND</option>
                                <?php
                                foreach($curr as $itemC){
                                    echo '<option value="'.$itemC['curr'].'">'.$itemC['curr'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div style="float:right; margin-right:20px">
                            <label style="float:left; margin-right:10px; line-height:25px"><?= trans('Sort'); ?></label>
                            <select style="float:left" name="sortFilter">
                                <option value="asc"><?= trans('ASC'); ?></option>
                                <option value="desc" selected="selected"><?= trans('DESC'); ?></option>
                            </select>
                        </div>

                    </form>
                </div>
                <!--**********hết phần search observatoire **********************************************-->
            </div>
        </div>
        <?php
            $i=1;
            foreach($year as $itemY){
        ?>
             <div id="tabs_annual_<?= $itemY['year'] ?>" class="loadAnnual<?= $itemY['year'] ?>">
                <script>ifrc.loadAnnualFlexigrid(<?= $itemY['year'] ?>);</script>
                <table id="loadAnnualFlexigrid<?= $itemY['year'] ?>" ></table>
            </div>
        <?php
            }
        ?>

    </div>

</div>

<script>

    $(document).ready(function() {

        var href2 = $(location).attr('href');
        href2=ifrc.explode('#',href2);
        $('#tabs_detail_annual').tabs({
            activate: function(e, ui) {
                console.log(e);
            }
        });
        $('#tabs_global').fadeIn();
		$('#tabs_detail_annual').css({'width':'100%'});

        $('#sform').submit(function (){
            $("table").each(function(){
                var id = $(this).attr('id');
                $("#"+id).flexOptions({newp: 1}).flexReload();
            });
            return false;
        });
    });

    // ifrc.loadcompo('',0);

</script>