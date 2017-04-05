<div id="content" role="main" class="right-sidebar">
    <div class="main_performance">
        <div class="breadcrumb">
            <a href="<?= base_url(); ?>" class="lnk_home"><?= trans('Home'); ?></a>
            <span><?= trans('Index Performance Calculator'); ?></span>
        </div>

        <div style="float:left; width:100%">
            <div style="float:left;">
                <h2><?= trans('Index Performance Calculator'); ?></h2>
            </div>
            <div style="float:right; padding:10px">
                <select onchange="ifrc.getPerfData(this.value,$(this),'auto')" id="perfUserName" name="SHORTNAME ASC">
                    <?php foreach ($date as $d): 
                        $year = substr($d['yyyymm'], 0, 4);
                        $month = substr($d['yyyymm'], 4);
                    ?>
                        <option value="<?php echo $d['yyyymm'] ?>"><?php echo $month."/".$year ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div id="tabs_detail_re" style="clear:both;border:1px solid #2B589E;">
            <ul>
                <!--<li><a tabid="1" href="#tabs-performance-selection" ><?= trans('Selection'); ?></a></li>-->
                <li><a tabid="0" href="#tabs_perf_ex" ><?= trans('Perf_Sheet'); ?></a></li>
            </ul>
            
            <div id="tabs_perf_ex">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <thead>
                        <tr bgcolor="#006BD7" style="padding-left:5px;font-weight:bold;font-size:12px; height:20px;">
                            <th style="height: 30px; text-align: left; width: 240px">
                    <div style="cursor: pointer; width: 100%" onclick="ifrc.getPerfData($('#perfUserName').val(),$(this),'manual')" name="SHORTNAME DESC">
                        <div style="float: left; margin-right: 3px;">&nbsp;Name </div>
                        <div style="float: left; padding-top: 3px;">
                            <a class="ascSort"></a>
                            <a class="descSort"></a>
                        </div>
                        <div style="clear: left"></div>
                    </div>
                    </th>
                    <th style="height: 30px; text-align: right; width: 45px;">
                    <div style="cursor: pointer; width: 100%" onclick="ifrc.getPerfData($('#perfUserName').val(),$(this),'manual')" name="m1 DESC">
                        <div style="float: right; margin-left: 3px;">1M&nbsp;</div>
                        <div style="float: right; padding-top: 3px;">
                            <a class="ascSort"></a>
                            <a class="descSort"></a>
                        </div>
                        <div style="clear: right"></div>
                    </div>
                    </th>
                    <th style="height: 30px; text-align: right; width: 45px;">
                    <div style="cursor: pointer; width: 100%" onclick="ifrc.getPerfData($('#perfUserName').val(),$(this),'manual')" name="m2 DESC">
                        <div style="float: right; margin-left: 3px;">2M&nbsp;</div>
                        <div style="float: right; padding-top: 3px;">
                            <a class="ascSort"></a>
                            <a class="descSort"></a>
                        </div>
                        <div style="clear: right"></div>
                    </div>
                    </th>
                    <th style="height: 30px; text-align: right; width: 45px;">
                    <div style="cursor: pointer; width: 100%" onclick="ifrc.getPerfData($('#perfUserName').val(),$(this),'manual')" name="m3 DESC">
                        <div style="float: right; margin-left: 3px;">3M&nbsp;</div>
                        <div style="float: right; padding-top: 3px;">
                            <a class="ascSort"></a>
                            <a class="descSort"></a>
                        </div>
                        <div style="clear: right"></div>
                    </div>
                    </th>
                    <th style="height: 30px; text-align: right; width: 45px;">
                    <div style="cursor: pointer; width: 100%" onclick="ifrc.getPerfData($('#perfUserName').val(),$(this),'manual')" name="m6 DESC">
                        <div style="float: right; margin-left: 3px; padding-top: 3px;">6M&nbsp;</div>
                        <div style="float: right; padding-top: 3px;">
                            <a class="ascSort"></a>
                            <a class="descSort"></a>
                        </div>
                        <div style="clear: right"></div>
                    </div>
                    </th>
                    <th style="height: 30px; text-align: right; width: 45px;">
                    <div style="cursor: pointer; width: 100%" onclick="ifrc.getPerfData($('#perfUserName').val(),$(this),'manual')" name="y1 DESC">
                        <div style="float: right; margin-left: 3px;">1Y&nbsp;</div>
                        <div style="float: right; padding-top: 3px;">
                            <a class="ascSort"></a>
                            <a class="descSort"></a>
                        </div>
                        <div style="clear: right"></div>
                    </div>
                    </th>
                    <th style="height: 30px; text-align: right; width: 45px;">
                    <div style="cursor: pointer; width: 100%" onclick="ifrc.getPerfData($('#perfUserName').val(),$(this),'manual')" name="y2 DESC">
                        <div style="float: right; margin-left: 3px;">2Y&nbsp;</div>
                        <div style="float: right; padding-top: 3px;">
                            <a class="ascSort"></a>
                            <a class="descSort"></a>
                        </div>
                        <div style="clear: right"></div>
                    </div>
                    </th>
                    <th style="height: 30px; text-align: right; width: 45px;">
                    <div style="cursor: pointer; width: 100%" onclick="ifrc.getPerfData($('#perfUserName').val(),$(this),'manual')" name="y3 DESC">
                        <div style="float: right; margin-left: 3px;">3Y&nbsp;</div>
                        <div style="float: right; padding-top: 3px;">
                            <a class="ascSort"></a>
                            <a class="descSort"></a>
                        </div>
                        <div style="clear: right"></div>
                    </div>
                    </th>
                    <th style="height: 30px; text-align: right; width: 45px;">
                    <div style="cursor: pointer; width: 100%" onclick="ifrc.getPerfData($('#perfUserName').val(),$(this),'manual')" name="y4 DESC">
                        <div style="float: right; margin-left: 3px;">4Y&nbsp;</div>
                        <div style="float: right; padding-top: 3px;">
                            <a class="ascSort"></a>
                            <a class="descSort"></a>
                        </div>
                        <div style="clear: right"></div>
                    </div>
                    </th>
                    <!--<th style="height: 30px; text-align: right; width: 45px;">
                    <div style="cursor: pointer; width: 100%" onclick="ifrc.getPerfData($('#perfUserName').val(),$(this),'manual')" name="y5 DESC">
                        <div style="float: right; margin-left: 3px;">5Y&nbsp;</div>
                        <div style="float: right; padding-top: 3px;">
                            <a class="ascSort"></a>
                            <a class="descSort"></a>
                        </div>
                        <div style="clear: right"></div>
                    </div>
                    </th>-->
                    <th style="height: 30px; text-align: right; width: 45px;">
                    <div style="cursor: pointer; width: 100%" onclick="ifrc.getPerfData($('#perfUserName').val(),$(this),'manual')" name="ytd DESC">
                        <div style="float: right; margin-left: 3px;">YTD&nbsp;</div>
                        <div style="float: right; padding-top: 3px;">
                            <a class="ascSort"></a>
                            <a class="descSort"></a>
                        </div>
                        <div style="clear: right"></div>
                    </div>
                    </th>
                    <th style="height: 30px; text-align: right; width: 50px;">
                    <div id='pre-year1' style="cursor: pointer; width: 100%" onclick="ifrc.getPerfData($('#perfUserName').val(),$(this),'manual')" name="y<?php echo date('Y') - 1; ?> DESC">
                        <div style="float: right; margin-left: 3px;"><?php echo date('Y') - 1; ?>&nbsp;</div>
                        <div style="float: right; padding-top: 3px;">
                            <a class="ascSort"></a>
                            <a class="descSort"></a>
                        </div>
                        <div style="clear: right"></div>
                    </div>
                    </th>
                    <th style="height: 30px; text-align: right; width: 50px;">
                    <div id='pre-year2' style="cursor: pointer; width: 100%" onclick="ifrc.getPerfData($('#perfUserName').val(),$(this),'manual')" name="y<?php echo date('Y') - 2; ?> DESC">
                        <div style="float: right; margin-left: 3px;"><?php echo date('Y') - 2; ?>&nbsp;</div>
                        <div style="float: right; padding-top: 3px;">
                            <a class="ascSort"></a>
                            <a class="descSort"></a>
                        </div>
                        <div style="clear: right"></div>
                    </div>
                    </th>
                    <th style="height: 30px; text-align: right; width: 50px;">
                    <div id='pre-year3' style="cursor: pointer; width: 100%" onclick="ifrc.getPerfData($('#perfUserName').val(),$(this),'manual')" name="y<?php echo date('Y') - 3; ?> DESC">
                        <div style="float: right; margin-left: 3px;"><?php echo date('Y') - 3; ?>&nbsp;</div>
                        <div style="float: right; padding-top: 3px;">
                            <a class="ascSort"></a>
                            <a class="descSort"></a>
                        </div>
                        <div style="clear: right"></div>
                    </div>
                    </th>
                    <th style="height: 30px; text-align: right; width: 50px;">
                    <div id='pre-year4' style="cursor: pointer; width: 100%" onclick="ifrc.getPerfData($('#perfUserName').val(),$(this),'manual')" name="y<?php echo date('Y') - 4; ?> DESC">
                        <div style="float: right; margin-left: 3px;"><?php echo date('Y') - 4; ?>&nbsp;</div>
                        <div style="float: right; padding-top: 3px;">
                            <a class="ascSort"></a>
                            <a class="descSort"></a>
                        </div>
                        <div style="clear: right"></div>
                    </div>
                    </th>
                    

                    </tr>
                    </thead>
                </table>
                <div style="width:100%;min-height: 18px; max-height: 300px; overflow-x: hidden; overflow-y: auto;">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody align='center'>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('#tabs_detail_re').tabs({
                                    selected: 1
                                });
                                ifrc.getPerfData($('#perfUserName').val(),$('#perfUserName'));
                            });
                        </script>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>	
</div>