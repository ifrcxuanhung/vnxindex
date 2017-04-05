<style type="text/css">
input[type="text"], input[type="file"]{
    background: none repeat scroll 0 0 transparent;
    border: medium none;
    border-radius: 0 0 0 0;
    margin: 0 0 1px;
    padding: 0;
}
input[type="text"], input[type="file"]{
    padding-bottom: 0.583em;
}
input[type="text"], input[type="file"]{
    background: -moz-linear-gradient(center top , #D4D4D4, #EBEBEB 3px, white 27px) repeat scroll 0 0%, none repeat scroll 0 0 white;
    border: 1px solid #89BAD3;
    border-radius: 0.417em 0.417em 0.417em 0.417em;
    color: #333333;
    font-size: 1em;
    line-height: 1em;
    padding: 0.5em;
}
input[type="file"]{
    width:300px;
}

select {
    margin-right: 3%;
    width: 70%;
    width: 300px;
}
select {
    font-size: 1.083em;
    padding: 0.385em;
}
select, textarea {
    border: 1px solid #89BAD3;
    border-radius: 0.417em 0.417em 0.417em 0.417em;
    color: #333333;
    font-size: 1em;
    padding: 0.417em;
}
.dataTables_scroll{
    width:100%;
}
.dataTables_scrollHeadInner{
    background: -moz-linear-gradient(center top , rgb(204, 204, 204), rgb(164, 164, 164)) repeat scroll 0px 0px transparent; 
    border-top: 1px solid #999999;
    margin-top: -1px;
}
#vndb_documentation_filter, #vnfdb_methodogy_test_filter{
    float: left !important;
    width: 100%;
}
#vndb_documentation_filter input, #vnfdb_methodogy_test_filter input{
    width:100px;
    float:left;
    margin: 0 5px;
}
#vndb_documentation_filter input:focus, #vnfdb_methodogy_test_filter input:focus{
    width:300px;
}
#submit{
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background: -moz-linear-gradient(center top , white, #72C6E4 4%, #0C5FA5) repeat scroll 0 0 transparent;
    border-color: #50A3C8 #297CB4 #083F6F;
    border-image: none;
    border-radius: 0.333em 0.333em 0.333em 0.333em;
    border-style: solid;
    border-width: 1px;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.4);
    color: white;
    cursor: pointer;
    display: inline-block;
    font-size: 1.167em;
    font-weight: bold;
    line-height: 1.429em;
    padding: 0.286em 1em 0.357em;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.4);
}
.tabContents{
    margin-top:10px;
}
.choose_table{
    width:50%;
    float:left;
    margin: 0 0; 
}
.choose_table table tbody tr{
    height:30px;
}

.wrapper div:last-child div:first-child {
    -moz-border-radius-bottomleft:10px;
    -webkit-border-bottom-left-radius:10px;
    border-bottom-left-radius:10px
}

.wrapper div:last-child div:last-child {
    -moz-border-radius-bottomright:10px;
    -webkit-border-bottom-right-radius:10px;
    border-bottom-right-radius:10px
}

.wrapper{
    border-collapse: collapse; 
    display: table;
    width:100%;
}
.wrapper-tr{
    display: table-row;
}
.wrapper-tr .title{
    text-transform:uppercase;
    font-size: 1.5em;
    font-weight: bold;
    text-align: center;
    border-bottom: 1px solid #ccc; 
    color: #3399CC;
}
.wrapper-cell{
    display: table-cell;
    padding:10px;
    border-right: 1px solid #ccc;
    width: 33.3%;
}
.wrapper-cell:last-child{
    border-right: 1px solid #fff; 
}
.table tr{
    height:30px;
}
#upload_top, .upload_medium, #upload_bottom{
    margin-top:10px !important;
}
#upload_bottom, #select_bottom, #select_medium, #build_bottom{
    margin-top: 5px;
    text-align: center;
}
#select_medium, #select_bottom{
    width: 100%;
    float:left;
    margin-top: 10px;
}
#select_top{
    text-align: left;
    margin-bottom: 10px;
    margin-top: 10px;
}
#select_top ul {
    width:100%;
}
#select_top ul li{
    width:50%;
    float:left;
    margin-bottom: 5px;
}

fieldset:last-child, .fieldset:last-child {
    margin-bottom: 0;
}
.block-content .grey-bg {
    background-color: #E6E6E6;
}
fieldset, .fieldset {
    border: 1px solid #D9D9D9;
    border-radius: 0.25em 0.25em 0.25em 0.25em;
    margin-bottom: 1.667em;
    padding: 1em 1.667em 1.667em;
}
.grey-bg {
    background-color: #C1C8CB;
}

legend, .legend {
    margin-left: -0.833em;
}
legend, .legend, .mini-menu {
    background: -moz-linear-gradient(center top , #F8F8F8, #E7E7E7) repeat scroll 0 0 transparent;
    color: #666666;
}
.button, legend, .legend, .mini-menu {
    border: 1px solid white;
    border-radius: 0.417em 0.417em 0.417em 0.417em;
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.5);
    font-weight: normal;
    line-height: 1.333em;
    outline: 0 none;
    padding: 0.167em 0.5em 0.25em;
    text-decoration: none;
    text-shadow: none;
}
#data li, #tests li{
    margin-bottom: 10px;
}
#data input[type="checkbox"], #tests input[type="checkbox"]{
    margin-right: 10px;
}
</style>
<section class="grid_12">
    <div class="block-border">
        <div class="block-content">
            <h1><?php trans('mn_vnfdb'); ?></h1>
           <!--  <div class="block-controls">
                <ul class="controls-buttons">
                    <li><a href="#" title="Previous step"><img src="images/icons/fugue/navigation-180.png" width="16" height="16"></a></li>
                    <li><a href="#" title="Next step"><img src="images/icons/fugue/navigation.png" width="16" height="16"></a></li>
                </ul>
            </div> -->
            <!--?php
                $url = $this->uri->segment(4);
                pre($url);
            ?>-->
            <div id="tabContaier">
                <ol class="wizard-steps">
                    <li>
                        <a href="#tab1">
                            <span class="number">1<span class="status-ok"></span></span>
                            Documentation
                        </a>
                    </li>
                    <li>
                        <a href="#tab2">
                            <span class="number">2</span>
                            Data
                        </a>
                    </li>
                    <li>
                        <a href="#tab3">
                            <span class="number">3</span>
                            Methodology & Tests
                        </a>
                    </li>
                    <li>
                        <a href="#tab4">
                            <span class="number">4</span>
                            Calculation
                        </a>
                    </li>
                    <li>
                        <a href="#tab5">
                            <span class="number">5</span>
                            Results
                        </a>
                    </li>
                </ol>
            </div>
            <div class="tabDetails">
                <div id="tab1" class="tabContents">
                    <span class="number bigger">1</span>
                    <h2 class="bigger">Documentation</h2>
                    <form class="block-content form-table-ajax" id="" method="post" action="">
                        <table id="vndb_documentation" class="table table-events-list table-ajax" table="vndb_documentation" cellspacing="0" width="90%" style="display: table; ">
                            <thead>
                                <tr>
                                    <th scope="col" sType="string" bSortable="true">
                                    </th>
                                    <th scope="col" sType="string" bSortable="true">
                                        <span class="column-sort">
                                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                        </span>
                                        <?php trans('title'); ?>
                                    </th>
                                    <th scope="col" sType="string" bSortable="true">
                                        <span class="column-sort">
                                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                        </span>
                                        <?php trans('authors'); ?>
                                    </th>
                                    <th scope="col" sType="string" bSortable="true">
                                        <span class="column-sort">
                                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                        </span>
                                        <?php trans('journal') ?>
                                    </th>
                                    <th scope="col" sType="string" bSortable="true">
                                        <span class="column-sort">
                                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                        </span>
                                        <?php trans('reference') ?>
                                    </th>
                                    <th scope="col" sType="string" bSortable="true">
                                        <span class="column-sort">
                                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                        </span>
                                        <?php trans('date') ?>
                                    </th>
                                    <th scope="col" sType="string" bSortable="true">
                                        <?php trans('action') ?>
                                    </th>
                                    <th scope="col" sType="string" bSortable="true">
                                        <?php trans('recommendation') ?>
                                    </th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div id="tab2" class="tabContents">
                    <span class="number bigger">2</span>
                    <h2 class="bigger" style="margin-bottom:0px">Data</h2>
                    <div class="wrapper">
                        <div class="wrapper-tr">
                            <div class="wrapper-cell title" style="color:red">Upload Your Data</div>
                            <div class="wrapper-cell title" style="color:red">Select Data</div>
                            <div class="wrapper-cell title" style="color:red">Build Your Data</div>
                        </div>
                        <div class="wrapper-tr">
                            <div id="upload" class="wrapper-cell">
                                <fieldset class="grey-bg required">
                                    <legend>Select File</legend>
                                    <p><input type="file" name="file" /></p>
                                </fieldset>
								
								<fieldset class="grey-bg required">
                                    <legend>Period</legend>
                                   
                                
                                <div style="border-collapse: collapse; display: table; width:100%; margin-top:10px">
                                    <div style="display: table-row;">
                                        <div style="display: table-cell; padding:10px; text-align:center">
                                            <table class="table" cellspacing="0" width="80%">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>D1</th>
                                                        <th>D2</th>
                                                        <th>Dn</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td>Value1</td>
                                                        <td>Value2</td>
                                                        <td>Valuen</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <input type="radio" name="choose_table" />
                                        </div>
                                        <div style="display: table-cell; padding:10px; text-align:center">
                                            <table class="table" cellspacing="0" width="80%">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Code</th>
                                                        <th>Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td>D1</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>D2</td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <input type="radio" name="choose_table" />
                                        </div>
                                    </div>
                                </div>
                                <div class="upload_medium">
                                        Periodicity <select name="">
                                            <option value="daily">Daily</option>
                                            <option value="monthly">Monthly</option>
                                            <option value="quarterly">Quarterly</option>
                                            <option value="hardly">Hardly</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
								</fieldset>
                                    
                                <div id="upload_bottom">
                                    <button type="button">Execute</button>
                                    <button type="button">Save</button>
                                </div>
                            </div>
                            <div id="select" class="wrapper-cell">
                                <fieldset class="grey-bg required">
                                    <legend>Type</legend>
                                    <div id="select_top">
                                        <span style="position:relative; top:-10px; font-weight:bold; font-size:1em">Type</span>
                                        <ul>
                                            <li><input type="radio" name="type" value="economics"> Economics</li>
                                            <li><input type="radio" name="type" value="currencies"> Currencies</li>
                                            <li><input type="radio" name="type" value="equities"> Equities</li>
                                            <li><input type="radio" name="type" value="commodities"> Commodities</li>
                                            <li><input type="radio" name="type" value="bonds"> Bonds</li>
                                            <li><input type="radio" name="type" value="indexes"> Indexes</li>
                                        </ul>
                                    </div>
									<div id="select_medium">
                                    <button type="button" id="screener">Screener</button>
                                </div>
                                </fieldset>
                                
                                <div id="select_bottom">
                                    <fieldset class="grey-bg required">
                                        <legend>Selected Data</legend>
                                        <table class="table" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>From</td>
                                                    <td>To</td>
                                                    <td>Periodicity</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>VNI Index</td>
                                                    <td>2000-01-02</td>
                                                    <td>2013-07-31</td>
                                                    <td>D,M,Y</td>
                                                </tr>
                                                <tr>
                                                    <td>HNX Index</td>
                                                    <td>2005-01-02</td>
                                                    <td>2013-07-31</td>
                                                    <td>D,M,Y</td>
                                                </tr>
                                                <tr>
                                                    <td>TSE Index</td>
                                                    <td>2000-01-02</td>
                                                    <td>2013-07-31</td>
                                                    <td>D,M,Y</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </fieldset>
                                    <fieldset class="grey-bg required">
                                    <legend>Period</legend> 
                                        <div style="width:100%; float:left">Periodicity <select name="" style="width:70%">
                                            <option value="daily">Daily</option>
                                            <option value="monthly">Monthly</option>
                                            <option value="quarterly">Quarterly</option>
                                            <option value="hardly">Hardly</option>
                                            <option value="other">Other</option>
                                        </select>
                                        </div>
                                        <div style="width:100%; float:left; margin-top:10px"><div style="width:50%; float:left">
                                            <span>
                                            From <input id="custom-date2" class="date" type="text" value="" name="simple-calendar" style="width:50%">
                                            </span>
                                        </div>
                                        <div style="width:50%; float:left">
                                            <span>
                                            To <input id="custom-date1" class="date" type="text" value="" name="simple-calendar" style="width:50%">
                                            </span>
                                        </div>
                                    </fieldset>
                                    <div style="width:100%; float:left; text-align:center; margin-top:10px;">
                                        <button type="button">Excute</button>   
                                        <button type="button" id="save">Save</button>
                                    </div>
                                </div>

                            </div>
                            <div id="build" class="wrapper-cell">
                                <fieldset class="grey-bg required">
                                    <legend>Define Your Universe</legend>
                                    <p>
                                        <span style="margin-right:20px"><input id="simple-radio-1" type="radio" value="1" name="simple-radio">
                                        <label for="simple-radio-1">Constant Sample</label></span>
                                        <span><input id="simple-radio-1" type="radio" value="1" name="simple-radio">
                                        <label for="simple-radio-1">Dynamic Sample</label></span>
                                    </p>
                                </fieldset>
                                <fieldset class="grey-bg required">
                                    <legend>Factors</legend>
                                    <p>
                                        <span style="margin-right:20px"><input type="checkbox" value="">
                                        <label for="simple-required">1</label></span>
                                        <span><select name="" style="width:70%">
                                            <option value="">Capitalisation</option>
											<option value="">Fundamental</option>
											<option value="">Beta</option></span>
                                        </select>
                                    </p>
                                    <p>
                                        <span style="margin-right:20px"><input type="checkbox" value="">
                                        <label for="simple-required">2</label></span>
                                        <span><select name="" style="width:70%">
                                            <option value="">Beta</option></span>
                                        </select>
                                    </p>
                                </fieldset>
                                <fieldset class="grey-bg required">
                                    <legend>Number Of Quantiles</legend>
                                    <p>
                                        <select name="" style="width:80%">
                                            <option value="">2</option>
                                            <option value="">3</option>
                                            <option value="">4</option>
                                            <option value="">5</option>
                                            <option value="">6</option>
                                            <option value="">7</option>
                                            <option value="">8</option>
                                            <option value="">9</option>
                                            <option value="">10</option>
                                        </select>
                                    </p>
                                </fieldset>
                                <fieldset class="grey-bg required">
                                    <legend>Weighting</legend>
                                    <p>
                                        <span style="margin-right:20px"><input id="simple-radio-1" type="radio" value="1" name="simple-radio">
                                        <label for="simple-radio-1">Capitalisation Weighted</label></span>
                                        <span><input id="simple-radio-1" type="radio" value="1" name="simple-radio">
                                        <label for="simple-radio-1">Equally Weighted</label></span>
                                    </p>
                                </fieldset>
                                <fieldset class="grey-bg required">
                                    <legend>Period</legend>
                                    <p>
                                        <label for="simple-required" style="margin-right:20px">From</label>
                                        <span class="input-type-text margin-right relative">
                                            <input class="date" type="text" value="" name="simple-calendar">
                                        </span>
                                    </p>
                                    <p>
                                        <label for="simple-required" style="margin-right:35px">To</label>
                                        <span class="input-type-text margin-right relative">
                                            <input class="date" type="text" value="" name="simple-calendar">
                                        </span>
                                    </p>
                                </fieldset>
                                <div id="build_bottom">
                                    <button type="button">Execute</button>
                                    <button type="button">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab3" class="tabContents">
                    <span class="number bigger">3</span>
                    <h2 class="bigger">Methodology & Tests</h2>
                    <form class="block-content form-table-ajax" id="" method="post" action="">
                        <table id="vnfdb_methodogy_test" class="table table-events-list table-ajax" table="vnfdb_methodogy_test" cellspacing="0" width="90%" style="display: table; ">
                            <thead>
                                <tr>
                                    <th scope="col" sType="string" bSortable="true">
                                    </th>
                                    <th scope="col" sType="string" bSortable="true">
                                        <span class="column-sort">
                                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                        </span>
                                        <?php trans('topic'); ?>
                                    </th>
                                    <th scope="col" sType="string" bSortable="true">
                                        <span class="column-sort">
                                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                        </span>
                                        <?php trans('category'); ?>
                                    </th>
                                    <th scope="col" sType="string" bSortable="true">
                                        <span class="column-sort">
                                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                        </span>
                                        <?php trans('test') ?>
                                    </th>
									<th scope="col" sType="string" bSortable="true">
                                        <span class="column-sort">
                                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                        </span>
                                        <?php trans('type') ?>
                                    </th>
									<th scope="col" sType="string" bSortable="true">
                                        <span class="column-sort">
                                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                        </span>
                                        <?php trans('date') ?>
                                    </th>
                                    <th scope="col" sType="string" bSortable="true">
                                        <span class="column-sort">
                                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                        </span>
                                        <?php trans('action') ?>
                                    </th>
                                    <th scope="col" sType="string" bSortable="true">
                                        <span class="column-sort">
                                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                                        </span>
                                        <?php trans('difficulty') ?>
                                    </th>
                            </thead>
                            <tbody>
                    
                            </tbody>
                        </table>
                    </form>
                </div>
                <div id="tab4" class="tabContents">
                    <span class="number bigger">4</span>
                    <h2 class="bigger" style="margin-bottom:0px">Calculation</h2>
                    <div class="wrapper">
                        <div class="wrapper-tr">
                            <div class="wrapper-cell title" style="color:red">Data</div>
                            <div class="wrapper-cell title" style="color:red; border:0px"></div>
                            <div class="wrapper-cell title" style="color:red; border-left: 1px solid #CCCCCC;">Tests</div>
                        </div>
                        <div class="wrapper-tr">
                            <div id="data" class="wrapper-cell">
                                <ul>
                                    <div style="margin-bottom:40px">
                                        <li><input type="checkbox" name="data[]" checked="checked">VNI Index</li>
                                        <li><input type="checkbox" name="data[]">NIKKEI</li>
                                    </div>
                                    <div style="margin-bottom:40px">
                                        <li><input type="checkbox" name="data[]" checked="checked">VN Large Caps Tiercel</li>
                                        <li><input type="checkbox" name="data[]" checked="checked">VN Mid Caps Tiercel</li>
                                        <li><input type="checkbox" name="data[]" checked="checked">VN Small Caps Tiercel</li>
                                    </div>
                                    <div style="">
                                        <li><input type="checkbox" name="data[]" checked="checked">VN High Volatility Tiercel</li>
                                        <li><input type="checkbox" name="data[]" checked="checked">VN Medium Volatility Tiercel</li>
                                        <li><input type="checkbox" name="data[]" checked="checked">VN Low Volatility Tiercel</li>
                                    </div>
                                </ul>
                            </div>
                            <div class="wrapper-cell" style="position:relative; border:0px">
                                <button style="position:absolute; top:60%; left:45%" id="calculate">Calculate</button>
                            </div>
                            <div id="tests" class="wrapper-cell" style="border-left: 1px solid #CCCCCC;">
                                <ul>
                                    <li><input type="checkbox" name="tests[]" checked="checked">Runs Test</li>
                                    <li><input type="checkbox" name="tests[]" checked="checked">Unit roots tests</li>
                                    <li><input type="checkbox" name="tests[]" checked="checked">Variance Ratio tests</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab5" class="tabContents">
                    <span class="number bigger">5</span>
                    <h2 class="bigger" style="margin-bottom:0px">Result</h2>
                    <dl class="accordion" style="margin-top:20px">
                        <dt><span class="number">1</span>RUN TESTS</span></dt>
                        <dd>
                            <fieldset class="grey-bg required">
                                <table class="table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <td><b>Data</b></td>
                                            <td><b>Statistics</b></td>
                                            <td><b>Significance</b></td>
											<td style="width:50%"><b>Comment</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>VNI Index</td>
                                            <td>12,98</td>
                                            <td>**</td>
											<td></td>
                                        </tr>
                                        <tr>
                                            <td>VN Large Caps Tiercel</td>
                                            <td>12,98</td>
                                            <td>**</td>
											<td></td>
                                        </tr>
                                        <tr>
                                            <td>VN Mid Caps Tiercel</td>
                                            <td>12,98</td>
                                            <td>**</td>
											<td></td>
                                        </tr>
                                        <tr>
                                            <td>VN Small Caps Tiercel</td>
                                            <td>12,98</td>
                                            <td>**</td>
											<td></td>
                                        </tr>
                                        <tr>
                                            <td>VN High Volatility Tiercel</td>
                                            <td>12,98</td>
                                            <td>**</td>
											<td></td>
                                        </tr>
                                        <tr>
                                            <td>VN Medium Volatility Tiercel</td>
                                            <td>12,98</td>
                                            <td>**</td>
											<td></td>
                                        </tr>
                                        <tr>
                                            <td>VN Low Volatility Tiercel</td>
                                            <td>12,98</td>
                                            <td>**</td>
											<td></td>
                                        </tr>
										
                                    </tbody>
                                </table>
                            </fieldset>
                        </dd>
                        <dt><span class="number">2</span>UNIT ROOTS TESTS</span></dt>
                        <dd>
                            <fieldset class="grey-bg required">
                                <table class="table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <td><b>Data</b></td>
                                            <td><b>Statistics</b></td>
                                            <td><b>Significance</b></td>
											<td style="width:50%"><b>Comment</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>VNI Index</td>
                                            <td>12,98</td>
                                            <td>**</td>
											<td></td>
                                        </tr>
                                        <tr>
                                            <td>VN Large Caps Tiercel</td>
                                            <td>12,98</td>
                                            <td>**</td>
											<td></td>
                                        </tr>
                                        <tr>
                                            <td>VN Mid Caps Tiercel</td>
                                            <td>12,98</td>
                                            <td>**</td>
											<td></td>
                                        </tr>
                                        <tr>
                                            <td>VN Small Caps Tiercel</td>
                                            <td>12,98</td>
                                            <td>**</td>
											<td></td>
                                        </tr>
                                        <tr>
                                            <td>VN High Volatility Tiercel</td>
                                            <td>12,98</td>
                                            <td>**</td>
											<td></td>
                                        </tr>
                                        <tr>
                                            <td>VN Medium Volatility Tiercel</td>
                                            <td>12,98</td>
                                            <td>**</td>
											<td></td>
                                        </tr>
                                        <tr>
                                            <td>VN Low Volatility Tiercel</td>
                                            <td>12,98</td>
                                            <td>**</td>
											<td></td>
                                        </tr>
										
                                    </tbody>
                                </table>
                            </fieldset>
                        </dd>
                        <dt><span class="number">3</span>VARIANCE RATIO TESTS</span></dt>
                        <dd>
                            <fieldset class="grey-bg required">
                                <table class="table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <td><b>Data</b></td>
                                            <td><b>Statistics</b></td>
                                            <td><b>Significance</b></td>
											<td style="width:50%"><b>Comment</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>VNI Index</td>
                                            <td>12,98</td>
                                            <td>**</td>
											<td></td>
                                        </tr>
                                        <tr>
                                            <td>VN Large Caps Tiercel</td>
                                            <td>12,98</td>
                                            <td>**</td>
											<td></td>
                                        </tr>
                                        <tr>
                                            <td>VN Mid Caps Tiercel</td>
                                            <td>12,98</td>
                                            <td>**</td>
											<td></td>
                                        </tr>
                                        <tr>
                                            <td>VN Small Caps Tiercel</td>
                                            <td>12,98</td>
                                            <td>**</td>
											<td></td>
                                        </tr>
                                        <tr>
                                            <td>VN High Volatility Tiercel</td>
                                            <td>12,98</td>
                                            <td>**</td>
											<td></td>
                                        </tr>
                                        <tr>
                                            <td>VN Medium Volatility Tiercel</td>
                                            <td>12,98</td>
                                            <td>**</td>
											<td></td>
                                        </tr>
                                        <tr>
                                            <td>VN Low Volatility Tiercel</td>
                                            <td>12,98</td>
                                            <td>**</td>
											<td></td>
                                        </tr>
										
                                    </tbody>
                                </table>
                            </fieldset>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="dialog" title="Choose Sub Select"></div>
<div id="dialog_2" title="Type Name"></div>
<script type="text/javascript">
    $(document).ready(function(){
        var allPanels = $('.accordion > dd').hide();
        $('.accordion > dt > a').click(function() {
            allPanels.slideUp();
            $(this).parent().next().slideDown();
            return false;
        });
        $("input[type=text].date").datepicker();
        $(".tabContents").hide(); // Ẩn toàn bộ nội dung của tab
        $(".tabContents:first").show(); // Mặc định sẽ hiển thị tab1
        $("#tabContaier ol li a").click(function(){ //Khai báo sự kiện khi click vào một tab nào đó
            var activeTab = $(this).attr("href");
            var number_current = $(this).find("span").html();
            $("#tabContaier ul li a").removeClass("active");
            $("#tabContaier ol li a").find("span").find("span").remove();
            $(this).addClass("active");
            $(this).find("span").html(number_current+'<span class="status-ok"></span>');
            $(".tabContents").hide(); 
            $(activeTab).fadeIn(); 
        });
        $(document).on("click","#screener", function(){
            var value = $("input[name=type]:checked").val();
            var sub_value = '';
            switch(value){
                case 'indexes':
                    sub_value = 'VietNam Indexes,Internation Indexes,IFRC Indexes,IFRC Observatory,ETF Screener';
                break;
                case 'equities':
                    sub_value = 'Reference,Dividends,Corporate Actions,Prices & Volume,Events,News,Risks,Fundamental';
                break;
                case 'currencies':
                    sub_value = 'Import Currency';
                break;
                case 'economics':
                    sub_value = 'dont know';
                break;
                case 'commodities':
                    sub_value = 'dont know';
                break;
                case 'bonds':
                    sub_value = 'dont know';
                break;
                default:
                    sub_value = '';
                break;
            }
            if(sub_value != ''){
                var html = '<ul style="width:100%; float:left">';
                var arr_value = sub_value.split(',');
                $.each( arr_value, function( key, value ) {
                    html += '<li style="float:left; width:50%"><input type="radio" name="sub_type" value="'+value.toLowerCase()+'"> '+value+'</li>';
                })
                html += '</ul>';
                $("#dialog").html(html);
                $("#dialog").dialog({
                    width: 350,
                    modal: true,
                    buttons: {
                        Cancel: function() {
                            $(this).dialog("close");
                        },
                        "Save": function() {
                            $(this).dialog("close");
                        },
                    },
                    close: function() {
                        $(this).dialog("close");
                    }
                });
            }
        });
        $("#save").click(function(){
            var html_3 = 'Name <input type="text" name="txtname" placeholder="Type Your Name" />';
            $("#dialog_2").html(html_3);
            $("#dialog_2").dialog({
                width: 350,
                modal: true,
                buttons: {
                    Cancel: function() {
                        $(this).dialog("close");
                    },
                    "Save": function() {
                        $(this).dialog("close");
                    },
                }
            });
        });
    });
</script>