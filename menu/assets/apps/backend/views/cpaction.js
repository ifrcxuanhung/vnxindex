// Filename: views/cpaction
define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/filter.html'
    ], function($, _, Backbone, filterTemplate){
        var cpactionListView = Backbone.View.extend({
            filters: new Object,
            tablehtml: "",
            el: $(document),
            initialize: function(){
            },
            events: {
                "click button.import": "import",
                "keypress #custom-date": "showCustomDate",
                "click #btn-save": "save",
				"click #btn-cancel": "cancel",
                "click input[type='checkbox']": "getCheckDate",
                "click .delete": "doDelete",
				"click .export-buttons a": "goTo",
                "click .my-buttons div button": "goTo",
                "click .btn-filter": "showBoxFilter",
                "change select.slt-filter": "selectFilter"
            },
            selectFilter: function(event){
                var $this = $(event.currentTarget);
                var action = $($this).attr("action");
                if(action == "market"){
                    action = "vndb_company.market";
                }
                cpactionListView.filters[action] = $($this).val();
                if(action == "ticker"){
                    $.ajax({
                        url: $admin_url + "general/getFilter",
                        type: "post",
                        data: {
                            columns: ["vndb_company.market"],
                            ticker: $($this).val(),
                            table: "vndb_cpaction_final"
                        },
                        success: function(rs){
                            rs = JSON.parse(rs);
                            if(rs.err == ""){
                                var data = rs.data;
                                var html = '<option value="all">All</option>';
                                $.each(data, function(key, item){
                                    $.each(item, function(key2, item2){
                                        value = item2 != null ? item2 : '';
                                        html += '<option value="' + value + '">' + value + '</option>';
                                    });
                                });
                                $("select[action='market']").html(html);
                            }
                        }
                    });
                }
            },
            
            showBoxFilter: function(){
                $.ajax({
                    url: $admin_url + "general/getFilter",
                    type: "post",
                    data: {
                        columns: ["evtname", "ticker", "vndb_company.market"],
                        table: "vndb_cpaction_final"
                    },
                    async: false,
                    success: function(rs){
                        rs = JSON.parse(rs);
                        if(rs.err == ""){
                            var dataTemplate = new Object;
                            dataTemplate.filter = rs.data;
                            html = _.template(filterTemplate, dataTemplate);
                        }
                        if($("#modal").length != 0 && $("#modal").text() != ""){
                            $("#modal").show();
                        }else{                            
                            $.modal({
                                title: trans('Filter'),
                                content: html,
                                buttons: {
                                    Search: function(win){
                                        filters = cpactionListView.filters;
                                        if(Object.keys(filters).length != 0){
                                            $("#vndb_cpaction_final_section").html(cpactionListView.tablehtml);
                                            cpactionListView.index(cpactionListView.filters);
                                            win.parent("#modal").hide();
                                        }
                                    },
                                    Cancel: function(win){
                                        win.closeModal();
                                    }
                                }
                            });
                            $(".txt-date").datepicker({
                                dateFormat: 'yy-mm-dd',
                                onSelect: function(selected){
                                    cpactionListView.filters[$(this).attr("name")] = selected;
                                }
                            });
                        }
                    }
                });
                
                return false;
            },
			
			goTo: function(event){
                var $this = $(event.currentTarget);
                var action = $($this).attr("action");
                switch(action){
                    case 'export':
                        // var ids = $($this).attr('ids');
                        // exportTable('vndb_dividends_final', ids, ['id', 'notice', 'date_cnf', 'confirm']);
                        var table = 'vndb_cpaction_final';
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
                            value: 'ticker',
                            type: '',
                        }
                        switch(url){
                            case 'history': tmp_where.op = '<'; tmp_order.type = 'ASC'; break;
                            case 'today': tmp_where.op = ''; break;
                            case 'index':
                            default: tmp_where.expr2 = url; break; 
                        }
                        where.push(tmp_where);
                        order.push(tmp_order);
						/************************/
						var tmp_order = {
                            value: 'date_ex',
                            type: '',
                        }
                        switch(url){
                            case 'history': tmp_where.op = '<'; tmp_order.type = 'DESC'; break;
                            case 'today': tmp_where.op = ''; break;
                            case 'index':
                            default: tmp_where.expr2 = url; break; 
                        }
                        where.push(tmp_where);
                        var filter = '';
                        if($('#' + table).length == 1){
                            var oSettings = $('#' + table).dataTable().fnSettings();
                        }else{
                            if($('.' + table).length == 1){
                                var oSettings = $('.' + table).dataTable().fnSettings();  
                            }
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
                        order.push(tmp_order);
						
                        exportTable2(table, where, order, ['notice', 'id', '', 'confirm']);
                    break;
                    default:
                        $(location).attr("href", $admin_url + "cpaction/index/" + action);
                    break;
                }
            },
			
            doDelete:function(event){
                var $this=$(event.currentTarget);
                if (confirm('Are you sure?')) {
                    var id=$($this).attr("pid");
                    $.ajax({
                        type: "POST",
                        url: $admin_url+"cpaction/delete",
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
                    $(location).attr('href', $admin_url + 'cpaction/index/' + date);
                }
            },

            import: function(event){
                var $this = $(event.currentTarget);
                var text = encodeURIComponent($("#cpaction-text").val());
                
                var market = $(".market:checked").val();
                $.ajax({
                    url: $admin_url + 'cpaction/import',
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
                $("#confirm").val((confirm === 'on') ? 1 : 0);
                if($)
                formcpaction.submit();
            },
                    cancel: function(){
                location.href = $admin_url + 'reference/index/';
            },

            index: function(filters){
                $(document).ready(function(){
                    cpactionListView.tablehtml = $("#vndb_cpaction_final_section").html();    
				 	var ids;                    
                    if(check_file_exists($base_url + 'assets/language/datatables/' + $lang + '.txt')){
                        $file = $base_url + 'assets/language/datatables/' + $lang + '.txt';
                    }else{
                        $file = $base_url + 'assets/language/datatables/eng.txt';
                    }
                    // if(typeof oTable != 'undefined'){
                    //     $("#table-mdata").dataTable().fnDestroy();
                    // }
                    var url = location.href;
                    oTable = $('.table-cpaction-list').dataTable({
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
                            if(typeof filters != "undefined"){
                                obj_tmp = new Object;
                                $.each(filters, function(name, value){
                                    obj_tmp[name] = value;
                                });
                                aoData.push({
                                    name: "myFilter",
                                    value: JSON.stringify(obj_tmp)
                                });
                            }
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
                            "mData": "evtname",
                            "sType": "string",
                            "swidth": "25%",
							"sClass": "string",
                            "sName": "evtname"
                        },
                        {
                            "mData": "ticker",
                            "sType": "string",
                            "swidth": "25%",
							"sClass": "string",
                            "sName": "ticker"
                        },
                        {
                            "mData": "market",
                            "sType": "string",
                            "swidth": "25%",
							"sClass": "string",
                            "sName": "market"
                        },
                        {
                            "mData": "date_ex",
                            "sType": "string",
                            "swidth": "25%",
							"sClass": "string",
                            "sName": "date_ex"
                        },
                        {
                            "mData": "date_eff",
                            "sType": "date",
                            "swidth": "25%",
							"sClass": "string",
                            "sName": "date_eff"
                        },
                        {
                            "mData": "ratio",
                            "sType": "numeric",
                            "swidth": "25%",
							"sClass": "numeric",
                            "sName": "ratio"
                        },
                        {
                            "mData": "sharesbef",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric",
                            "sName": "sharesbef"
                        },
                        {
                            "mData": "sharesadd",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric",
                            "sName": "sharesadd"
                        },
                        {
                            "mData": "sharesaft",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric",
                            "sName": "evtname"
                        },
						{
                            "mData": "oldns",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric",
                            "sName": "oldns"
                        },
						{
                            "mData": "newns",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric",
                            "sName": "newns"
                        },
						{
                            "mData": "eprice",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric",
                            "sName": "eprice"
                        },
						{
                            "mData": "prv_close",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric",
                            "sName": "prv_close"
                        },
                                			{
                            "mData": "right",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric",
                            "sName": "right"
                        },
                        {
                            "mData": "adjclose",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric",
                            "sName": "adjclose"
                        },
                        {
                            "mData": "adjcoeff",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric",
                            "sName": "adjcoeff"
                        },
                        {
                            "mData": "action",
                            "sType": "string",
                            "swidth": "25%",
							"sClass": "string"
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
                            $("#vndb_cpaction_final_filter").find(".btn-filter").remove();
                            $("#vndb_cpaction_final_filter").append(" <button class='btn-filter'>Advanced Search</button>").children("input").attr("placeholder", trans("quick_search"));
                            var html = '<div style="float: right">' +
                                            '<button action="history" class="with-tip" type="button">' + trans('bt_history') + '</button> ' +
                                            '<button action="today" class="with-tip red" type="button">' + trans('bt_today')  + '</button> ' +
                                            '<button action="future" class="with-tip" type="button">' + trans('bt_future') + '</button> ' +
                                            '<input type="text" name="custom-date" id="custom-date" /> ' +
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
                                    $(location).attr('href', $admin_url + 'cpaction/index/' + selected);
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
        return cpactionListView = new cpactionListView;
    });
