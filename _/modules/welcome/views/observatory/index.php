<script>
    $(document).ready(function() {
        var href2 = $(location).attr('href');
        href2 = ifrc.explode('#', href2);
        if (href2[1]) {
            ifrc.showDetailOb(href2[1]);
        }
        $('.q_search').focus(function() {
            ifrc.resetselect();
        });

        $(".q_search").autocomplete({
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

<?php if ($code) { ?>
            ifrc.showDetailOb('<?php echo $code; ?>');
<?php } ?>
    });
    $(window).bind("hashchange", function(e) {
        var href = $(location).attr('href');
        href = ifrc.explode('#', href);
        if (href[1]) {
            var code = href[1];
            ifrc.showDetailOb(code);
        }
    });
</script>
<div id="content" role="main" class="observatory-content">
    <div class="intro_copn width_intro">
        <div class="breadcrumb">
            <a href="<?php echo base_url(); ?>" class="lnk_home"><?php trans('Home'); ?></a>
            <span><?php echo trans('Observatoire_des_indices'); ?></span>
        </div>

        <div style="float:left; margin-top: 20px">
            <h2><?php trans('Observatoire_des_indices'); ?></h2>
            <h3><?php echo $total; ?> <?php trans('Indices_mondiaux'); ?></h3>
        </div>
        <div class="container" style="width: 100%; float: left; clear: both">
            <div class="box_search_obs">
                <!--**********phần search observatoire **********************************************-->
                <div name="search_obs">
                    <div class="search_element">
                        <label><?php trans('Type'); ?></label>
                        <select name="selectType" class="selectType" style=" padding: 2px 5px; margin-left:1px; font-size:11px">
                            <option value="0" selected="selected" ><?php trans("ALL"); ?></option>
                            <?php foreach ($data['Type'] as $vType) { ?>
                                <option value="<?php echo $vType; ?>"><?php echo strtoupper($vType); ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="search_element">
                        <label><?php trans('Category'); ?></label>
                        <select name="selectCode" class="selectCode" style=" padding: 2px 5px; margin-left:1px; font-size:11px">
                            <option value="0" selected="selected" ><?php trans("ALL"); ?></option>
                            <?php foreach ($data['subtype'] as $vCode) { ?>
                                <option value="<?php echo $vCode; ?>"><?php echo strtoupper($vCode); ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="search_element">
                        <label><?php trans('Provider'); ?></label>
                        <select name="selectProvider" class="selectProvider" style=" padding: 2px 5px; margin-left:1px; font-size:11px">
                            <option value="0" selected="selected" ><?php trans("ALL"); ?></option>
                            <?php foreach ($data['Provider'] as $vProvider) { ?>
                                <option value="<?php echo $vProvider; ?>"><?php echo strtoupper($vProvider); ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="search_element">
                        <label><?php trans('Coverage'); ?></label>
                        <select name="selectCoverage" class="selectCoverage" style=" padding: 2px 5px; margin-left:1px; font-size:11px; width:130px;">
                            <option value="0" selected="selected" ><?php trans("ALL"); ?></option>
                            <?php foreach ($data['Coverage'] as $vCoverage) { ?>
                                <option value="<?php echo $vCoverage; ?>"><?php echo strtoupper($vCoverage); ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="search_element">
                        <label><?php trans('Price'); ?></label>
                        <select name="selectPrice" class="selectPrice" style=" padding: 2px 5px; margin-left:1px; font-size:11px">
                            <option value="0" selected="selected" ><?php trans("ALL"); ?></option>
                            <?php foreach ($data['Price'] as $vPrice) { ?>
                                <option value="<?php echo $vPrice; ?>"><?php echo strtoupper($vPrice); ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="search_element">
                        <label><?php trans('Currency'); ?></label>
                        <select name="selectCurrency" class="selectCurrency" style=" padding: 2px 5px; margin-left:1px; font-size:11px">
                            <option value="0" selected="selected" ><?php trans("ALL"); ?></option>
                            <?php foreach ($data['Currency'] as $vCurrency) { ?>
                                <option value="<?php echo $vCurrency; ?>"><?php echo strtoupper($vCurrency); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="search_element">
                        <label><?php trans('Name'); ?></label>
                        <select name="selectName" class="selectName" style=" padding: 2px 5px; margin-left:1px; width:140px; font-size:11px">
                            <option value="0" selected="selected" ><?php trans("ALL"); ?></option>
                            <?php foreach ($data['SHORTNAME'] as $vName) { ?>
                                <option value="<?php echo $vName; ?>"><?php echo strtoupper($vName); ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="search_element clear_a">
                        <input type="text" placeholder="<?php trans('search'); ?>" class="q_search" style="margin-bottom:20px; font-size:14px; width:245px; height:15px;" name="q_search" onclick="this.value = ''" value=""/>
                        <a onclick="ifrc.searchObnull()" style="cursor: pointer; display: inline-block" width="66" ><img  src="<?php echo base_url() ?>templates/images/search.png"/></a>
                        <a onclick="ifrc.resetselect()" style="cursor: pointer; display: inline-block" width="66" ><img  src="<?php echo base_url() ?>templates/images/reset.png"/></a>
                    </div>

                </div>
                <!--**********hết phần search observatoire **********************************************-->
            </div>
        </div>
        <!-- Ket thuc container -->
        <div class="clear"></div>
        <!-- start main content -->
        <div class="observatory">
            <script>ifrc.searchObnull();</script>
        </div>
        <!-- end main content -->
        <!-- các tab content -->
        <div class="detail-observatoire"></div>
        <!-- hết các tab-->
        <!-- ############# Ket thuc Observatory ########### -->
    </div>


</div>