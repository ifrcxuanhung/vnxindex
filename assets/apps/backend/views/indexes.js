// Filename: views/cpaction
define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var indexesListView = Backbone.View.extend({
            el: $(".main-container"),
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
            },
			
			goTo: function(event){
                var $this = $(event.currentTarget);
                var action = $($this).attr("action");
                switch(action){
                    case 'export':
                        // var ids = $($this).attr('ids');
                        // exportTable('vndb_dividends_final', ids, ['id', 'notice', 'date_cnf', 'confirm']);
                        var table = 'idx_sample';
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

            vietnam: function(){
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
                    oTable = $('.table-vietnam-list').dataTable({
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
                            "mData": "name",
                            "sType": "string",
                            "swidth": "30%",
							"sClass": "string",
                            "sName": "name"
                        },
                        {
                            "mData": "shortname",
                            "sType": "string",
                            "swidth": "25%",
							"sClass": "string",
                            "sName": "shortname"
                        },
                        {
                            "mData": "provider",
                            "sType": "string",
                            "swidth": "25%",
							"sClass": "string",
                            "sName": "provider"
                        },
                        {
                            "mData": "place",
                            "sType": "string",
                            "swidth": "25%",
							"sClass": "string",
                            "sName": "place"
                        },
                        {
                            "mData": "launch",
                            "sType": "date",
                            "swidth": "25%",
							"sClass": "string",
                            "sName": "launch"
                        },
                        {
                            "mData": "curr",
                            "sType": "string",
                            "swidth": "5%",
							"sClass": "string",
                            "sName": "curr"
                        },
                        {
                            "mData": "calcul",
                            "sType": "string",
                            "swidth": "5%",
                            "sClass": "string",
                            "sName": "calcul"
                        },
                        {
                            "mData": "frequency",
                            "sType": "string",
                            "swidth": "5%",
                            "sClass": "string",
                            "sName": "frequency"
                        },
                        {
                            "mData": "price",
                            "sType": "string",
                            "swidth": "5%",
                            "sClass": "string",
                            "sName": "price"
                        },
						{
                            "mData": "base_value",
                            "sType": "numeric",
                            "swidth": "10%",
                            "sClass": "numeric",
                            "sName": "base_value"
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
                            var html = '<div style="float: right">' +
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
                                    $(location).attr('href', $admin_url + 'indexes/vietnam/' + selected);
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
            international: function(){
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
                    oTable = $('.table-international-list').dataTable({
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
                            "mData": "name",
                            "sType": "string",
                            "swidth": "30%",
                            "sClass": "string",
                            "sName": "name"
                        },
                        {
                            "mData": "shortname",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "shortname"
                        },
                        {
                            "mData": "provider",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "provider"
                        },
                        {
                            "mData": "place",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "place"
                        },
                        {
                            "mData": "launch",
                            "sType": "date",
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "launch"
                        },
                        {
                            "mData": "curr",
                            "sType": "string",
                            "swidth": "5%",
                            "sClass": "string",
                            "sName": "curr"
                        },
                        {
                            "mData": "calcul",
                            "sType": "string",
                            "swidth": "5%",
                            "sClass": "string",
                            "sName": "calcul"
                        },
                        {
                            "mData": "frequency",
                            "sType": "string",
                            "swidth": "5%",
                            "sClass": "string",
                            "sName": "frequency"
                        },
                        {
                            "mData": "price",
                            "sType": "string",
                            "swidth": "5%",
                            "sClass": "string",
                            "sName": "price"
                        },
                        {
                            "mData": "base_value",
                            "sType": "numeric",
                            "swidth": "10%",
                            "sClass": "numeric",
                            "sName": "base_value"
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
                            var html = '<div style="float: right">' +
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
                                    $(location).attr('href', $admin_url + 'indexes/vietnam/' + selected);
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
            ifrc: function(){
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
                    oTable = $('.table-ifrc-list').dataTable({
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
                            "mData": "name",
                            "sType": "string",
                            "swidth": "30%",
                            "sClass": "string",
                            "sName": "name"
                        },
                        {
                            "mData": "shortname",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "shortname"
                        },
                        {
                            "mData": "provider",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "provider"
                        },
                        {
                            "mData": "place",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "place"
                        },
                        {
                            "mData": "launch",
                            "sType": "date",
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "launch"
                        },
                        {
                            "mData": "curr",
                            "sType": "string",
                            "swidth": "5%",
                            "sClass": "string",
                            "sName": "curr"
                        },
                        {
                            "mData": "calcul",
                            "sType": "string",
                            "swidth": "5%",
                            "sClass": "string",
                            "sName": "calcul"
                        },
                        {
                            "mData": "frequency",
                            "sType": "string",
                            "swidth": "5%",
                            "sClass": "string",
                            "sName": "frequency"
                        },
                        {
                            "mData": "price",
                            "sType": "string",
                            "swidth": "5%",
                            "sClass": "string",
                            "sName": "price"
                        },
                        {
                            "mData": "base_value",
                            "sType": "numeric",
                            "swidth": "10%",
                            "sClass": "numeric",
                            "sName": "base_value"
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
                            var html = '<div style="float: right">' +
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
                                    $(location).attr('href', $admin_url + 'indexes/vietnam/' + selected);
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
        return new indexesListView;
    });
