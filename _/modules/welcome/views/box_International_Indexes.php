<script>
    var $ = jQuery;
    $(function() {
        $('#tabs_global ul li a').css('text-transform', 'capitalize');
        $('#tabs_global').fadeIn();
        $('#tabs_global').tabs({
            selected: 0,
            show: function() {
                var status_idx = $("input[name='status-idx']").val();
                $('.ui-tabs-nav li').removeClass('ui-tabs-selected');
                <?php if(@$setting['PVN'] == 1){ ?>

                    if(status_idx == 1 )
                    {
                        /*Lan dau chay se hien thi tat ca data cua VNX va PVN*/
                        $("input[name='status-idx']").val('2');
                        $provider = " PROVIDER='IFRC' OR PROVIDER='PVN' ";

                        load($provider);
                        return false;
                    }
                    else
                    {
                        var $id = $('#tabs_global .ui-state-active a').attr('href');
                        var $name = $('#tabs_global .ui-state-active a').attr('name');
                        var $provider = " PROVIDER = '"+$name+"' ";
                        var $where = $provider;
                        ifrc.chuyendoi($id, $name, $where);
                        $('.ui-tabs-panel').hide();
                        $($id).show();
                    }
                <?php }else{ ?>

                    var $id = $('#tabs_global .ui-state-active a').attr('href');
                    var $name = $('#tabs_global .ui-state-active a').attr('name');
                    var $provider = " PROVIDER = '"+$name+"' ";
                    var $where = $provider;
                    ifrc.chuyendoi($id, $name, $where);
                    $('.ui-tabs-panel').hide();
                    $($id).show();
                <?php } ?>
            }
        });

        function load($provider)
        {
            var $id = $('#tabs_global .ui-state-active a').attr('href');
            var $name = $('#tabs_global .ui-state-active a').attr('name');
            var $where = $provider;
            ifrc.chuyendoi($id, $name, $where);
            $('.ui-tabs-nav li').removeClass('ui-state-active');
            $('.ui-tabs-panel').hide();
            $($id).show();
        }

        $('.ui-tabs-nav li a').click(function(){
            $('.ui-tabs-nav li').removeClass('ui-state-active');
            $(this).parent().addClass('ui-state-active');
        });


        $("#tabs_global .txtsearch").autocomplete({
            source: function(request, response) {
                $name = $('#tabs_global .ui-state-active a').attr('name');
                $.ajax({
                    url: $base_url + 'ajax',
                    type: 'POST',
                    data: {
                        act: "getDataGlobalBoxHome",
                        provider: $name,
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

    });
</script>
<h1 style="font-size:28px" ><?php echo number_format($data['total_global']['TOTAL']); ?>  <?php echo trans('Vietnam Indexes') ?></h1>
<div id="tabs_global">
<input type="hidden" name="status-idx" value="1" />
    <ul>
        <?php
        if (is_array($data['boxInternationalIndexes']))
            foreach ($data['boxInternationalIndexes'] as $k => $v) {
                if ($v['type'] != '') {
                    ?>
                    <li><a name="<?php echo $v['type']; ?>" href="#tabs_global_<?php echo str_replace(' ', '_', $v['type']); ?>"><?php echo ($v['type']=='TOP10_PERFORMANCE')?'Top 2017 PERFORMERS':trans($v['type']); ?></a></li>
                    <?php
                }
            }
        ?>
    </ul>
    <?php
    if (is_array($data['boxInternationalIndexes']))
        foreach ($data['boxInternationalIndexes'] as $k => $v) {
            if ($v['type'] != NULL) {
                ?>
                <div id="tabs_global_<?php echo str_replace(' ', '_', $v['type']); ?>">
                    <?php
                    if ($v['sub_type']) {
                        echo '<ul style="width:100%; float:left">';
                        if ($v['type'] != 'STRATEGY') {
                            foreach ($v['sub_type'] as $subType) {
                                if ($subType['SUB_TYPE'] != '') {
                                    ?>
                                    <li style="float: left; margin: 1px;"><a class="getSubData" onclick="ifrc.chuyendoiSub('#tabs_global_<?php echo str_replace(' ', '_', $v['type']); ?>', '<?php echo $v['type']; ?>', ' PROVIDER = \'<?php echo $v['type']; ?>\' ', '<?php echo $subType['SUB_TYPE']; ?>')" style="cursor:pointer; padding:5px; float: left" type="<?php echo $v['type']; ?>" subtype="<?php echo $subType['SUB_TYPE']; ?>" href="#"><?php trans($subType['SUB_TYPE']) ?></a></li>
                                    <?php
                                }
                            }
                        }
                        echo '</ul>';
                    }
                    ?>
                          <form style="float: left; width: 100%;" name="fifrc" action="" method="post" onsubmit="ifrc.seachhome('#tabs_global_<?php echo str_replace(' ', '_', $v['type']); ?>', ' PROVIDER = \'<?php echo $v['type']; ?>\' ', '<?php echo $v['type']; ?>');
                                          return false;">
                        <input type="hidden" name="type" value="Benchmark" />
                        <table class="boxselectleft fix_padd_search" width="100%" border="0" cellpadding="0" cellspacing="0" style="float: right;">
                            <tr>
                                <td width="92%" style="padding-right:0; text-align:right;">

                                <input style="float:right; margin-bottom: 3px;" onfocus="ifrc.resetselect2('boxselectleft')" name="txtsearch" class="txtsearch search_obs_home" type="text" value="<?php echo trans('search') ?>..." /></td>
                                <td width="8%" style="padding-left:0"><a onclick="ifrc.seachhome('#tabs_global_<?php echo str_replace(' ', '_', $v['type']); ?>', ' PROVIDER=\'<?php echo $v['type']; ?>\' ', '<?php echo $v['type']; ?>')" style="background:url(<?php echo base_url(); ?>templates/images/search.png) ; width: 66px; height:28px;display:inline-block;cursor: pointer" /></td>
                                <td width="">
                                    <div class="text_header" style="display: none;"><strong><?php trans('Coverage') ?></strong><br /><select name="selectPlace" class="selectPlace" onchange="ifrc.chuyendoi('#tabs_global_<?php echo str_replace(' ', '_', $v['type']); ?>', '<?php echo $v['type']; ?>', ' PROVIDER = \'<?php echo $v['type']; ?>\' ')" style="width:60px; margin-left:1px; font-size:11px">
                                            <option value="0" selected ><?php trans('ALL') ?></option>
                                            <?php foreach ($data['place'] as $vplace) { ?>
                                                <option value="<?php echo $vplace; ?>"><?php echo strtoupper($vplace); ?></option>
                                            <?php } ?>
                                        </select></div>
                                    <div class="text_header" style="display: none;"><strong>PR/TR</strong><br /><select name="selectPrice" class="selectPrice" onchange="ifrc.chuyendoi('#tabs_global_<?php echo str_replace(' ', '_', $v['type']); ?>', '<?php echo $v['type']; ?>', ' PROVIDER = \'<?php echo $v['type']; ?>\' ')" style="width:60px; margin-left:1px; font-size:11px">
                                            <option value="0" selected ><?php trans('ALL') ?></option>
                                            <?php foreach ($data['price'] as $vprice) { ?>
                                                <option value="<?php echo $vprice; ?>"><?php echo strtoupper($vprice); ?></option>
                                            <?php } ?>
                                        </select></div>
                                    <div class="text_header" style="display: none;"><strong><?php trans('Currency') ?></strong><br /><select name="selectCurr" class="selectCurr" onchange="ifrc.chuyendoi('#tabs_global_<?php echo str_replace(' ', '_', $v['type']); ?>', '<?php echo $v['type']; ?>', ' PROVIDER = \'<?php echo $v['type']; ?>\' ')" style="width:60px; margin-left:1px; font-size:11px">
                                            <option value="0" selected ><?php trans('ALL') ?></option>
                                            <?php foreach ($data['curr'] as $vcurr) { ?>
                                                <option value="<?php echo $vcurr; ?>"><?php echo strtoupper($vcurr); ?></option>
                                            <?php } ?>
                                        </select></div>
                                </td>

                            </tr>
                        </table>
                    </form><br/>
                    <div class="ifrc_index" style="display: inline-block"></div>
                </div>
                <?php
            }
        }
    ?>
</div>
<div class="last_update_obs_home">* <?php trans("Last update"); echo ": {$data['last_update']['date']}"; ?></div>
<div class="go_to_obs_home"><a href="<?php echo base_url(); ?>observatory"><?php trans('go_to_observatory'); ?></a></div>
