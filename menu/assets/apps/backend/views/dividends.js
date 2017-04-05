// Filename: views/dividends
define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var dividendsListView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){
            },
            events: {
                "click button.import": "import",
                "keypress #custom-date": "showCustomDate",
                "click #btn-save": "save",
                "click input[type='checkbox']": "getCheckDate",
                "click .delete": "doDelete",
                "click .export-buttons ul li a": "goTo",
                "click .my-buttons div button": "goTo",
                "click #btn-info": "showInfo",
            },

            showInfo: function(){
                var style = $("#box-detail").attr("style");
                if(style != ""){
                    $("#box-detail").attr("style", "");
                }else{
                    $("#box-detail").attr("style", "margin-left: 30%");
                }
                $("#box-info").toggle();
            },

            goTo: function(event){
                var $this = $(event.currentTarget);
                var action = $($this).attr("action");
                switch(action){
                    case 'add':
                        $(location).attr("href", $admin_url + "dividends/" + action);
                    break;
                    case 'export':
                        // var ids = $($this).attr('ids');
                        // exportTable('vndb_dividends_final', ids, ['id', 'notice', 'date_cnf', 'confirm']);
                        var where = new Array();
                        var order = new Array();
                        var url = location.href;
                        var urls = url.split('/');
                        url = urls[urls.length - 1];
                        var tmp_where = {
                            expr1: 'date_ex',
                            op: '',
                            expr2: '_date_now'
                        };
                        var tmp_order = {
                            value: 'date_ex',
                            type: '',
                        }
                        switch(url){
                            case 'history': tmp_where.op = '<'; tmp_order.type = 'DESC'; break;
                            case 'future': tmp_where.op = '>'; tmp_order.type = 'ASC'; break;
                            case 'today': tmp_where.op = ''; break;
                            case 'index': 
                            case 'dividends': tmp_where.op = '>='; tmp_order.type = 'DESC'; break;
                            default: tmp_where.expr2 = url; break; 
                        }
                        where.push(tmp_where);
                        var oSettings = $('#vndb_dividends_final').dataTable().fnSettings();
                        var filter = oSettings.oPreviousSearch.sSearch;
                        
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
                        order.push(tmp_order);
                        exportTable2('vndb_dividends_final', where, order, ['notice', 'id', 'date_cnf', 'confirm']);
                    break;
                    default:
                        $(location).attr("href", $admin_url + "dividends/index/" + action);
                    break;
                }
            },

            doDelete:function(event){
                var $this=$(event.currentTarget);
                if (confirm('Are you sure?')) {
                    var id=$($this).attr("pid");
                    $.ajax({
                        type: "POST",
                        url: $admin_url+"dividends/delete",
                        data: "id=" + id,
                        success: function(msg){
                            if(msg>=1){
                                $($this).parents('tr').fadeOut('slow');
                            }
                        }
                    });
                }
            },

            getCheckDate: function(event){
                var $this = $(event.currentTarget);
                var check = $($this).val();
                if($($this).attr('checked')){
                    $("#date_cnf").val("now");
                }else{
                    $("#date_cnf").val("");
                }
                // if($($this).)
            },

            showCustomDate: function(event){
                var $this = $(event.currentTarget);
                var $keycode = (event.keycode) ? event.keycode : event.which;
                var date = $($this).val();
                if($keycode == 13){
                    $(location).attr('href', $admin_url + 'dividends/index/' + date);
                }
            },

            import: function(event){
                var $this = $(event.currentTarget);
                var text = encodeURIComponent($("#dividends-text").val());
                
                var market = $(".market:checked").val();
                $.ajax({
                    url: $admin_url + 'dividends/import',
                    type: 'post',
                    data: 'text=' + text + '&market=' + market,
                    async: false,
                    success: function(rs){
                        rs = JSON.parse(rs);
                        var data = rs.data;
                        $.each(data, function(k, value){
                            $("#" + k).val(value);
                        });
                    }
                })
            },

            save: function(){
                var confirm = $("input[type='checkbox']:checked").val();
                var text = $("#dividends-text").val();
                $("#notice").val(text);
                $("#confirm").val((confirm === 'on') ? 1 : 0);
                formDividends.submit();
            },

            index: function(){
                $(document).ready(function(){
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
                    oTable = $('.table-dividends-list').dataTable({
                        "oLanguage":{
                            "sUrl": $file
                        },
                        "sScrollX": "100%",
                        // "sScrollXInner": "110%",
                        "bScrollCollapse": true,
                        "iDisplayLength": 10,
                        "iDisplayStart": 0,
                        "bProcessing": true,
                        "bRetrieve": true,
                        "aaSorting": [],
                        "bAutoWidth": true,
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
                            "mData": "ticker",
                            "sType": "string",
                            "sWidth": "6%",
                            "sClass": "string",
                            "sName": "ticker"
                        },
                        {
                            "mData": "market",
                            "sType": "string",
                            "sWidth": "7%",
                            "sClass": "string",
                            "sName": "market"
                        },
                        {
                            "mData": "date_ex",
                            "sType": "string",
                            "sWidth": "9%",
                            "sClass": "string",
                            "sName": "date_ex"
                        },
                        {
                            "mData": "date_ann",
                            "sType": "string",
                            "sWidth": "12%",
                            "sClass": "string",
                            "sName": "date_ann"
                        },
                        {
                            "mData": "date_rec",
                            "sType": "date",
                            "sWidth": "10%",
                            "sClass": "string",
                            "sName": "date_rec"
                        },
                        {
                            "mData": "date_pay",
                            "sType": "date",
                            "sWidth": "10%",
                            "sClass": "string",
                            "sName": "date_pay"
                        },
                        {
                            "mData": "pay_met",
                            "sType": "string",
                            "sWidth": "12%",
                            "sClass": "string",
                            "sName": "pay_met"
                        },
                        {
                            "mData": "pay_yr",
                            "sType": "numeric",
                            "sWidth": "12%",
                            "sClass": "numeric",
                            "sName": "pay_yr"
                        },
                        {
                            "mData": "pay_per",
                            "sType": "numeric",
                            "sWidth": "12%",
                            "sClass": "numeric",
                            "sName": "pay_per"
                        },
                        {
                            "mData": "dividend",
                            "sType": "numeric",
                            "sWidth": "25%",
                            "sClass": "numeric",
                            "sName": "dividend"
                        },
                        {
                            "mData": "action",
                            "sType": "string",
                            "sWidth": "25%"
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

                            var html = '<div style="float: right; margin-top:-5px">' +
                                            '<button action="history" class="with-tip" type="button">' + trans('bt_history') + '</button> ' +
                                            '<button action="today" class="with-tip red" type="button">' + trans('bt_today')  + '</button> ' +
                                            '<button action="future" class="with-tip" type="button">' + trans('bt_future') + '</button> ' +
                                            '<input type="text" name="custom-date" id="custom-date" /> ' +
                                            '<button action="add" class="" type="button">' + trans('bt_add') + '</button>' +
                                        '</div>' +
                                        '<div style="clear: left;"></div>';
                            $(".my-buttons").html(html);
                            html = '<ul class="controls-buttons"><li>' +
                                    '<a style="cursor: pointer" action="export" class="with-tip" type="button">' + trans('bt_export') + '</a>'+
                                    '</li></ul>' +
                                    '<div style="clear: left;"></div>';
                            $(".export-buttons").html(html);
                            $("#custom-date").datepicker({
                                dateFormat: 'yy-mm-dd',
                                onSelect: function(selected){
                                    $(location).attr('href', $admin_url + 'dividends/index/' + selected);
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

            render: function(){
                if(typeof this[$app.action] != 'undefined'){
                    new this[$app.action];
                }
            }
        });
        return new dividendsListView;
    });
