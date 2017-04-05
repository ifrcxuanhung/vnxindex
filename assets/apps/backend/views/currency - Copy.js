define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var currencyListView = Backbone.View.extend({
            // el: $(".main-container"),
            el: $(document),
            initialize: function(){
            },
            events: {
                "click .btn-cancel": "cancel",
                "click #export": "goTo",
                "click a.getNameCurrency": "CompareCurrency"
            },
            
            goTo: function(event){
                var $this = $(event.currentTarget);
                var $table = $($this).parent().parent("#tab-global").children("ul.tabs").children("li.current").children("a").attr('id');
                var $arr_table = $table.split('_');
                var $filter =  $($this).parent().parent("#tab-global").children("div#select_current").children("select").val();
                var $arr_filter = $filter.split('/');
                var where = new Array();
                var order = new Array();
                var tmp_where_1 = {
                    expr1: 'SUBSTRING(code,4,3)',
                    op: '=',
                    expr2: $arr_filter[0]
                };
                var tmp_where_2 = {
                    expr1: 'SUBSTRING(code,7,3)',
                    op: '=',
                    expr2: $arr_filter[1]
                };
                where = [tmp_where_1, tmp_where_2];
                //where.push(tmp_where);
                var filter = '';
                if($('#currency_' + $arr_table[2]).length == 1){
                    var oSettings = $('#currency_' + $arr_table[2]).dataTable().fnSettings();
                }
                if(typeof oSettings != 'undefined'){
                    filter = oSettings.oPreviousSearch.sSearch;
                }
                if(filter != ''){
                    var headers = new Array();
                    $.each(oSettings.aoColumns, function(key, item){
                        if(item.sName != ''){
                            headers.push(item.sName);
                        }
                    });
                    tmp_where = {
                        sSearch: filter,
                        headers: headers
                    }
                    where.push(tmp_where);
                }
                exportTable4($table, where, new Object, new Object);
            },
        
            index: function(){
                $(document).ready(function(){     
                    $('#currency-name').hide();
                    $('#compare-currency').hide();
                    var ids;                    
                    if(check_file_exists($base_url + 'assets/language/datatables/' + $lang + '.txt')){
                        $file = $base_url + 'assets/language/datatables/' + $lang + '.txt';
                    }else{
                        $file = $base_url + 'assets/language/datatables/eng.txt';
                    }
                    if(typeof oTable != 'undefined'){
                        $("#table-mdata").dataTable().fnDestroy();
                    }
                    var url = location.href;
                    oTable = $('#vndb_curr_country').dataTable({
                        "oLanguage":{
                            "sUrl": $file
                        },
                        "bRetrieve": true,
                        "scrollable": true,
                        "bPaginate": false,
                        "sScrollY": "300px",
                        "bScrollCollapse": true,                      
                        "aaSorting": [],
                        "bServerSide": true,
                        "sAjaxSource": url,
                        "fnServerData": function(sSource, aoData, fnCallback, oSettings) {
                            $.ajax( {
                                "dataType": 'json',
                                "type": "POST",
                                "url": sSource,
                                "data": aoData,
                                success: function(rs){
                                    ids = rs.my_id;
                                    fnCallback(rs);
                                }
                            });

                        },
                        "aoColumns": [
                        {
                            // "mData": "curr_code",
                            "sType": "string",
                            "swidth": "5%",
                            "sClass": "string",
                            "sName": "curr_code"
                        },
                        {
                            // "mData": "curr_name",
                            "sType": "string",
                            "swidth": "10%",
                            "sClass": "string",
                            "sName": "curr_name"
                        },
                        {
                            // "mData": "domain",
                            "sType": "string",
                            "swidth": "5%",
                            "sClass": "string",
                            "sName": "domain"
                        },
                        {
                            // "mData": "country",
                            "sType": "string",
                            "swidth": "5%",
                            "sClass": "string",
                            "sName": "country"
                        },
                        {
                            "sType": "string",
                            "swidth": "5%",
                            "sClass": "string",
                            "sName": "compare"
                        }
                        ],
                        "sPaginationType": "full_numbers",
                        //sDom: '<"block-controls"<"controls-buttons"p>>rti<"block-footer clearfix"lf>',
                        sDom: '<"block-controls"<"export-buttons"><"controls-buttons"p><"my-buttons">>rti<"block-footer clearfix"lf>',

                        /* Callback to apply template setup*/
                        fnDrawCallback: function()
                        {
                            // this.parent().applyTemplateSetup();
                            $(this).slideDown(200);
                            $(".with-tip").tip();
                            $("#vndb_cpaction_final_filter").append(" <button class='btn-filter'>Filter</button>");
                            var html = '<div style="float: right">' +
                            '</div>' +
                            '<div style="clear: left;"></div>';
                            $(".my-buttons").html(html);
                            html = '<ul class="controls-buttons"><li>' +
                            '<a style="cursor: pointer" action="export" class="with-tip" type="button">' + trans('bt_export') + '</a>'+
                            '</li></ul>';
                            $(".export-buttons").html(html);
                            $("#custom-date").datepicker({
                                dateFormat: 'yy-mm-dd',
                                onSelect: function(selected){
                                    $(location).attr('href', $admin_url + 'currency/index/' + selected);
                                }
                            });
                            oTable.fnSetFilteringPressEnter();
                        },
                        fnInitComplete: function()
                        {
                            // this.parent().applyTemplateSetup();
                            $(this).slideDown(200);
                        // $(".table-report").siblings(".block-controls").children().remove();
                        // $(".table-report").siblings(".block-footer").remove();
                        // $(".table-report").siblings(".message").remove();

                        }
                    });
                });
            },

            cancel: function(event){
                var $this = $(event.currentTarget);
                var $id = $($this).closest("section").attr("id");
                $('#'+$id).hide();
            },

            CompareCurrency:function(event){
                var $this = $(event.currentTarget);
                $("#tabs" ).tabs();
                $('#currency-main').hide();
                $('#currency-name').hide();
                $('#compare-currency').show();
                var $data_currency = $this.attr('id');
                var $arr_curr = $data_currency.split('/');
                var $table = 'idx_currency_day';
                $.ajax({
                    url: $admin_url+"currency/get_name_currency_2",
                    type: 'post',
                    data: 'curr='+$arr_curr[0],
                    async: false,
                    success: function(rs){
                        rs = JSON.parse(rs);
                        var option = "<select name='select_currency' class='select_current'>";
                        $.each(rs, function(i, val) {
                            if(val == $data_currency){
                                option += "<option value='"+val+"' selected>"+val+"</option>";
                            }else{
                                option += "<option value='"+val+"'>"+val+"</option>";
                            }
                        });
                        option += "</select>";
                        $("#select_current").html(option);
                    }
                });
                currencyListView.table_filter($table,$arr_curr[0],$arr_curr[1],'day');
                currencyListView.chart_filter($table,$arr_curr[0],$arr_curr[1]);
                $(".get_table").on("click", function() {
                    var $data_currenct =  $('.select_current').val();
                    var $current = $data_currenct.split('/');
                    $table = $(this).attr("id");
                    var $data_filter = $(this).attr('href');
                    var $filter = $data_filter.replace("#", "");
                    currencyListView.table_filter($table,$current[0],$current[1],$filter);
                    currencyListView.chart_filter($table,$current[0],$current[1]);
                });

                $('.select_current').change( function() {
                    var $data_currenct = $(this).attr('value');
                    var $current = $data_currenct.split('/');
                    var $data_filter = $(".current").find('a').attr('href');
                    var $filter = $data_filter.replace("#", "");
                    currencyListView.table_filter($table,$current[0],$current[1],$filter);
                    currencyListView.chart_filter($table,$current[0],$current[1]);
                });
            
            },

            table_filter:function($table,$curr1,$curr2,$filter){
                if(typeof oTable != "undefined"){
                    $("#currency_"+$filter).dataTable().fnDestroy();
                }
                oTable = $("#currency_"+$filter).dataTable({
                    "aaSorting": [],
                    "sAjaxSource": $admin_url+"currency/get_compare_currency",
                    "fnServerData": function(sSource, aaData, fnCallback, oSetting){
                        aaData.push(
                        {
                            name: 'table',
                            value: $table
                        },
                        {
                            name: 'curr1',
                            value: $curr1
                        },
                        {
                            name: 'curr2',
                            value: $curr2
                        }
                        );
                        $.ajax({
                            dataType: "JSON",
                            url: sSource,
                            type: "POST",
                            data: aaData,
                            success: function(rs){
                                data = rs;
                                $("#lean_overlay").hide();
                                fnCallback(rs);
                            }
                        });
                    },
                    "aoColumns": [
                    {
                        "mData": "currency",
                        "sType": "string",
                        "sClass": "string"
                    },
                    {
                        "mData": "date",
                        "sType": "string",
                        "sClass": "string"
                    },
                    {
                        "mData": "close",
                        "sType": "numeric",
                        "sClass": "numeric"
                    },
                    ],
                    "bRetrieve": true,
                    "scrollable": true,
                    "bPaginate": false,
                    "sScrollY": "180px",
                    "bScrollCollapse": true,
                    "bProcessing": false,
                    sDom: '<"block-controls"<"controls-buttons"p>>rti<"block-footer clearfix"lf>',
                    fnDrawCallback: function()
                    {
                        $("#idx-currency").attr("style", "");
                        $("#idx-currency").css("display", "table");
                        $('.block-controls').remove();
                        $('.block-content').css("padding-top", "0");
                    /* this.parent().applyTemplateSetup(); */
                    },
                    fnInitComplete: function()
                    {
                        $("#idx-currency").attr("style", "");
                        $("#idx-currency").css("display", "table");
                        $('.block-controls').remove();
                        $('.block-content').css("padding-top", "0");
                        div_id = "#" + $(this).attr("id") + "_wrapper";
                        $(div_id + " .dataTables_scrollHeadInner").css({
                            "background": "-moz-linear-gradient(center top , #CCCCCC, #A4A4A4) repeat scroll 0 0 transparent",
                            "border-top": "1px solid white"
                        });
                        $(div_id + " .dataTables_scroll th").css("border-top", "none");
                        $("section").css("margin-bottom", 0);
                        $(this).children("th:last-child").css("border-right", "none");
                    /* this.parent().applyTemplateSetup(); */
                    }
                });
            },

            chart_filter:function($table,$curr1,$curr2){
                $.ajax({
                    url: $admin_url + 'currency/get_data_for_chart',
                    type: 'post',
                    data: 'table='+$table+'&curr1='+$curr1+'&curr2='+$curr2,
                    async: false,
                    success: function(data){
                        data = JSON.parse(data);
                        var multiplies = data[0][2];
                        if(multiplies == 0){
                            multiplies = ''; 
                        }else{
                            multiplies = ' ( * ' + multiplies +' )'; 
                        }
                        $('#container').highcharts('StockChart', {
                            chart: {
                                height: 400,
                                type: 'line'
                            },
                        
                            credits: {
                                enabled: false
                            },

                            rangeSelector : {
                                enabled: false,
                                selected : 1
                            },

                            title : {
                                text : $curr1+'/'+ $curr2
                            },

                            tooltip: {
                                style: {
                                    width: '200px'
                                },
                                valueDecimals: 4
                            },

                            xAxis: {
                                type: 'date'
                            },
                        
                            yAxis : {
                                title : {
                                    text : 'Close'+multiplies
                                }
                            },

                            exporting: {
                                buttons: {
                                    contextButton: {
                                        menuItems: null,
                                        onclick: function() {
                                            this.exportChart();
                                        }
                                    }
                                }
                            },

                            series : [{
                                name : $curr1+' to '+$curr2,
                                data : data,
                                id : 'dataseries'
                            }]
                        });
                    }
                });
            },
        
            render: function(){
                if(typeof this[$app.action] != 'undefined'){
                    new this[$app.action];
                }
            }
        });
        return currencyListView = new currencyListView;
    });