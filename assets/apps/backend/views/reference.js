define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/caculation/report.html'
    ], function($, _, Backbone,reportTemplate){
        var $html='<div class="caculation-report"><img style="margin-left:180px" src="'+$template_url+'images/loading.gif"/></div>';
        var referenceView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){

            },

            events: {
                "click #save": "excute",
                "click #save1": "excute1",
                "click #save2": "excute2",
                "keypress #custom-date": "showCustomDate",
				"click #btn-save": "save",
				"click #btn-cancel": "cancel",
				"click .delete": "doDelete",
            	"click .export-buttons a": "goTo",
                "click .my-buttons div button": "goTo",
            },
			
			goTo: function(event){
                $("#lean_overlay").show(1, function(){
                    var $this = $(event.currentTarget);
                    var action = $($this).attr("action");
                    switch(action){
                        case 'export':
                            // var ids = $($this).attr('ids');
                            // exportTable('vndb_dividends_final', ids, ['id', 'notice', 'date_cnf', 'confirm']);
                            var where = new Array();
                            var order = new Array();
                            var url = location.href;
                            var urls = url.split('/');
                            url = urls[urls.length - 1];
                            var tmp_where = {
                                expr1: 'date',
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
    							case 'reference': tmp_order.type = 'ASC'; break;
                                default: tmp_where.expr2 = url; tmp_order.type = 'ASC'; break; 
                            }
                            where.push(tmp_where);
                            order.push(tmp_order);
    						/************************/
    						var tmp_order = {
                                value: 'yyyymmdd',
                                type: '',
                            }
                            switch(url){
                                case 'history': tmp_order.type = 'DESC'; break;
                                default: tmp_order.type = 'ASC'; break; 
                            }
                            where.push(tmp_where);
                            order.push(tmp_order);
    						
                            exportTable3('vndb_reference_final', location.href);
                        break;
                        default:
                            $(location).attr("href", $admin_url + "reference/index/" + action);
                        break;
                    }
                });
            },
			
			save: function(){
                var confirm = $("input[type='checkbox']:checked").val();
                $("#confirm").val((confirm === 'on') ? 1 : 0);
                if($)
                formReference.submit();
            },
			
			cancel: function(){
                location.href = $admin_url + 'reference/index/';
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
                        $(".table-reference-list").dataTable().fnDestroy();
                    }
                    var url = location.href;
                    oTable = $('.table-reference-list').dataTable({
                        "oLanguage":{
                            "sUrl": $file
                        },
                        "sScrollY": "340px",
                        "sScrollX": "100%",
                        // "sScrollXInner": "110%",
                        "bScrollCollapse": true,
                        "bPaginate": false,
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
                                  // "success": fnCallback
                                success: function(rs){
                                    fnCallback(rs);
                                }
                            });

                        },
                        "aoColumns": [
						{
                            "mData": "date",
                            "sType": "date",
                            "swidth": "25%",
							"sClass": "string",
                            "sName": "date"
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
                            "mData": "industry",
                            "sType": "string",
                            "swidth": "25%",
							"sClass": "string",
                            "sName": "industry"
                        },
                        {
                            "mData": "sector",
                            "sType": "string",
                            "swidth": "25%",
							"sClass": "string",
                            "sName": "sector"
                        },
                        {
                            "mData": "ipo",
                            "sType": "date",
                            "swidth": "25%",
							"sClass": "string",
                            "sName": "ipo"
                        },
                        {
                            "mData": "ipo_shli",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric",
                            "sName": "ipo_shli"
                        },
                        {
                            "mData": "ipo_shou",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric",
                            "sName": "ipo_shou"
                        },
                        {
                            "mData": "ftrd",
                            "sType": "date",
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "ftrd"
                        },
						{
                            "mData": "ftrd_cls",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric",
                            "sName": "ftrd_cls"
                        },
						{
                            "mData": "shli",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric",
                            "sName": "shli"
                        },
						{
                            "mData": "shou",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric",
                            "sName": "shou"
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
                        sDom: '<"block-controls"<"export-buttons"><"controls-buttons"p><"my-buttons">>rti',

                        /* Callback to apply template setup*/
                        fnDrawCallback: function()
                        {
                            // this.parent().applyTemplateSetup();
							$(this).slideDown(200);
							
							$(".with-tip").tip();
                            var html = '<div style="float: right">' +
                                            '<button action="history" class="with-tip" type="button">' + trans('bt_history') + '</button> ' +
                                            '<button action="today" class="with-tip red" type="button">' + trans('bt_today')  + '</button> ' +
                                            '<input type="text" name="custom-date" id="custom-date" /> ' +
                                        '</div>' +
                                        '<div style="clear: left;"></div>';
                            $(".my-buttons").html(html);
							  html = '<ul class="controls-buttons" style="margin-top:4px"><li>' +
                                    '<a style="cursor: pointer" action="export" class="with-tip" type="button">' + trans('bt_export') + '</a>'+
                                    '</li></ul>' +
                                    '<div style="clear: left;"></div>';
                            $(".export-buttons").html(html);
                            $("#custom-date").datepicker({
                                dateFormat: 'yy-mm-dd',
                                onSelect: function(selected){
                                    $(location).attr('href', $admin_url + 'reference/index/' + selected);
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
			
            showCustomDate: function(event){
                var $this = $(event.currentTarget);
                var $keycode = (event.keycode) ? event.keycode : event.which;
                var date = $($this).val();
                if($keycode == 13){
                    $(location).attr('href', $admin_url + 'reference/index/' + date);
                }
            },
			
            excute: function(e){
                $this = $(e.currentTarget);
                $("#file-daily").hide();
                referenceView.openModal('Reference Switch', $html, 400);
                var start = $("#startdate").val();
                referenceView.ref_switch(start);
            },
			
			doDelete:function(event){
                var $this=$(event.currentTarget);
                $.modal({
                content: 'Are you sure?',
                title: 'Delete',
                maxWidth: 2500,
                width: 400,
                buttons: {
                    'Yes': function(win) {
                        var id=$($this).attr("pid");
                        $.ajax({
                            type: "POST",
                            url: $admin_url+"reference/delete",
                            data: "id=" + id,
                            success: function(msg){
                                if(msg>=1){
                                    $($this).parents('tr').fadeOut('slow');
                                }
                            }
                        });
                    },
                    'Cancel': function(win) {
                        win.closeModal();
                    }
                }
            });
            $('.modal-window .block-content .block-footer').find('button:eq(1)').attr('class', 'red');
            },

            ref_switch: function(start){
                $.ajax({
                    url: $admin_url + 'reference/process_check_date',
                    data: 'date='+start,
                    type: 'post',
                    async: false,
                    success: function(data){
                        var datatemplate={};
                        datatemplate.report=JSON.parse(data);
                        var compiledTemplate = _.template( reportTemplate, datatemplate );
                        var date = datatemplate.report.date;
                        var key = datatemplate.report.key;
                        if(key != ''){
                            if(key == 'Yes'){
                                $('.caculation-report').html("<div class='button' style='width:97%; margin-bottom:10px; font-size:17px; font-weight:bold'>"
                                    +"<ul>"
                                    +"<li>Data of day "+date+"</li>"
                                    +"<li>Day: "+datatemplate.report.day+"</li>"
                                    +"<li>Daily: "+datatemplate.report.daily+"</li>"
                                    +"<li>History: "+datatemplate.report.history+"</li>"
                                    +"<li>Do you want continuous ?</li>"
                                    +"</ul>"
                                    +"</div>"
                                    +"<div class='button' style='width:37%'><button id='accept' style='float:left;margin-right:20%;'>Yes</button><button id='de-accept'>No</button></div>").fadeIn();
                                $('#accept').click(function(){
                                    //$('#lean_overlay').show('0',function(){
                                    $("#modal").remove();
                                    referenceView.openModal('Reference Switch', $html, 400);
                                    $("#modal").show(0, function(){
                                        $.ajax({
                                            url: $admin_url + 'reference/process_reference_switch',
                                            data: 'date=' + date + '&key=' + key,
                                            type: 'post',
                                            async: false,
                                            success: function(data){
                                                var datatemplate={};
                                                datatemplate.report=JSON.parse(data);
                                                var compiledTemplate = _.template( reportTemplate, datatemplate );
                                                $('.caculation-report').html(compiledTemplate).fadeIn();
                                            }
                                        });
                                    });
                                })
                                $('#de-accept').click(function(){
                                    window.location.href = $admin_url;
                                })
                            }else{
                                $(document).ready(function(){
                                    //$('#lean_overlay').show('0',function(){
                                    referenceView.openModal('Reference Switch', $html, 400);
                                    $("#modal").show(0, function(){
                                        $.ajax({
                                            url: $admin_url + 'reference/process_reference_switch',
                                            type: 'post',
                                            data: 'date=' + date + '&key=' + key,
                                            async: false,
                                            success: function(data){
                                                var datatemplate={};
                                                datatemplate.report=JSON.parse(data);
                                                var compiledTemplate = _.template( reportTemplate, datatemplate );
                                                $('.caculation-report').html(compiledTemplate).fadeIn();
                                            }
                                        });
                                    });
                                });
                            }
                        }else{
                            $('.caculation-report').html("<div class='button' style='width:97%; margin-bottom:10px; font-size:17px; font-weight:bold'>"
                                +"<ul>"
                                +"<li>Data of day "+date+"</li>"
                                +"<li>Day: "+datatemplate.report.day+"</li>"
                                +"</ul>"
                                +"</div>").fadeIn();
                        }
                    }
                });
            },
            openModal: function openModal($title,$content,$width)
            {
                $.modal({
                    content: $content,
                    title: $title,
                    maxWidth: 2500,
                    width: $width,
                    buttons: {
                        'Close': function(win) {
                            window.location.href = $admin_url;
                        }
                    }
                });
            },
            reference_switch: function(){
                $(document).ready(function(){
                    $("#startdate").datepicker({
                        maxDate: 0,
                        dateFormat: 'yy-mm-dd',
                        onSelect: function(selected){
                            $("#enddate").datepicker("option", "maxDate", selected);
                        }
                    });
                });
            },
            reference_all: function(){
                $(document).ready(function(){
                    $("#startdate").datepicker({
                        maxDate: 0,
                        dateFormat: 'yy-mm-dd',
                        onSelect: function(selected){
                            $("#startdate").datepicker("option", "maxDate", selected);
                        }
                    });
                });
            },
            excute2: function(e){
                $this = $(e.currentTarget);
                $("#file-daily").hide();
                referenceView.openModal('Reference All', $html, 400);
                var start = $("#startdate").val();
                $.ajax({
                    url: $admin_url + 'reference/process_check_date',
                    type: 'post',
                    data: 'date='+start,
                    async: false,
                    success: function(data){
                        var datatemplate={};
                        datatemplate.report=JSON.parse(data);
                        var compiledTemplate = _.template( reportTemplate, datatemplate );
                        var date = datatemplate.report.date;
                        var key = datatemplate.report.key;
                        if(key != ''){
                            if(key == 'Yes'){
                                $('.caculation-report').html("<div class='button' style='width:97%; margin-bottom:10px; font-size:17px; font-weight:bold'>Đã có dữ liệu ngày "+date+" , có muốn xóa dữ liệu cũ và ghi dữ liệu mới vào không?</div>"
                                    +"<div class='button' style='width:37%'><button id='accept' style='float:left;margin-right:20%;'>Yes</button><button id='de-accept'>No</button></div>").fadeIn();
                                $('#accept').click(function(){
                                    //$('#lean_overlay').show('0',function(){
                                    $("#modal").remove();
                                    referenceView.openModal('Reference All', $html, 400);
                                    $("#modal").show(0, function(){
                                        $.ajax({
                                            url: $admin_url + 'reference/process_reference_all',
                                            data: 'date=' + date + '&key=' + key,
                                            type: 'post',
                                            async: false,
                                            complete: function(){
                                                referenceView.ref_switch(date);
                                            }
                                        });
                                    });
                                })
                                $('#de-accept').click(function(){
                                    window.location.href = $admin_url;
                                })
                            }else{
                                $(document).ready(function(){
                                    //$('#lean_overlay').show('0',function(){
                                    referenceView.openModal('Reference All', $html, 400);
                                    $("#modal").show(0, function(){
                                        $.ajax({
                                            url: $admin_url + 'reference/process_reference_all',
                                            type: 'post',
                                            data: 'date=' + date + '&key=' + key,
                                            async: false,
                                            complete: function(){
                                                referenceView.ref_switch(date);
                                            }
                                        });
                                    });
                                });
                            }
                        }else{
                            $('.caculation-report').html("<div class='button' style='width:97%; margin-bottom:10px; font-size:17px; font-weight:bold'>"
                                +"<ul>"
                                +"<li>Data of day "+date+"</li>"
                                +"<li>Day: "+datatemplate.report.day+"</li>"
                                +"</ul>"
                                +"</div>").fadeIn();
                        }
                    }
                })
            },
            update_calendar: function(){
                $(document).ready(function(){
                    $("#startdate").datepicker({
                        maxDate: 0,
                        dateFormat: 'yy-mm-dd',
                        onSelect: function(selected){
                            $("#enddate").datepicker("option", "maxDate", selected);
                        }
                    });
                    $("#startdate").datepicker("setDate", new Date());
                });
            },
            excute1: function(e){
                $this = $(e.currentTarget);
                $("#update_calendar").hide();
                referenceView.openModal('Update Calendar', $html, 400);
                var start = $("#startdate").val();
                $.ajax({
                    url: $admin_url + 'reference/process_update_calendar',
                    data: 'date='+start,
                    type: 'post',
                    async: false,
                    success: function(rs){
                        var dataTemplate = {};
                        dataTemplate.report = JSON.parse(rs);
                        $('.caculation-report').html('<ul class="blocks-list">'
                            +"<li>"
                            +'<a href="#" class="float-left"><img width="16" height="16" src="'+$template_url+'images/icons/fugue/status.png"> '+dataTemplate.report.title+'</a>'
                            +'<ul class="tags float-right">'
                            +'<li class="tag-time">'+dataTemplate.report.time+' seconds</li>'
                            +"</ul>"
                            +"</li>"
                            +"<li>"
                            +'<a href="#" class="float-left"><img width="16" height="16" src="'+$template_url+'images/icons/fugue/status.png"> '+dataTemplate.report.task+'</a>'
                            +'<ul class="tags float-right">'
                            +'<li>'+dataTemplate.report.message+'</li>'
                            +"</ul>"
                            +"</li>"
                            +"</ul>").fadeIn();
                    }
                });
            },
            change: function(){
                if(window.confirm("Do you want to continue?")){
                    referenceView.openModal("REFERENCE CHANGE", $html, 400);
                    $("#modal").show(0, function(){
                        $.ajax({
                            url: $admin_url + 'reference/change',
                            async: false,
                            success: function(rs){
                                var dataTemplate = {};
                                dataTemplate.report = JSON.parse(rs);
                                var compiledTemplate = _.template(reportTemplate, dataTemplate);
                                $('.caculation-report').html(compiledTemplate).fadeIn();
                            }
                        });
                    });
                }
            },
            render: function(){
                if(typeof this[$app.action] != 'undefined'){
                    new this[$app.action];
                }
            }
        });
        return referenceView = new referenceView;
    });
