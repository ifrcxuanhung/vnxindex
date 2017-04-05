define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/caculation/report.html'
    ], function($, _, Backbone,reportTemplate){
        var $html='<div class="caculation-report"><img style="margin-left:180px" src="'+$template_url+'images/loading.gif"/></div>';
        var pricesView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){
                // openModal('Update Indexes', $html, 400);
            },
            events: {
                "click #save": "excute",
				"keypress #custom-date": "showCustomDate",
                "click #btn-save": "save",
				"click #btn-cancel": "cancel",
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
                        var max_date;
                        $.ajax({
                           url: $admin_url + 'prices/process_max_date',
                            success: function(rs){
                                max_date = rs;
								var where = new Array();
								var order = new Array();
								var url = location.href;
								var urls = url.split('/');
								url = urls[urls.length - 1];
								
								var tmp_where = {
									expr1: 'date',
									op: '',
									expr2: max_date
								};
								var tmp_order = {
									value: 'ticker',
									type: '',
								}
								switch(url){
									case 'history': tmp_where.op = '<'; tmp_order.type = 'ASC'; break;
									case 'today': tmp_where.op = ''; break;
									case 'index':
									case 'prices': tmp_where.op = '>='; tmp_order.type = 'ASC'; break;
									default: tmp_where.expr2 = url; break; 
								}
								where.push(tmp_where);
								order.push(tmp_order);
								/************************/
								var tmp_order = {
									value: 'date',
									type: '',
								}
								switch(url){
									case 'history': tmp_where.op = '<'; tmp_order.type = 'DESC'; break;
									case 'today': tmp_where.op = ''; break;
									case 'index':
									case 'prices': tmp_where.op = '>='; tmp_order.type = 'ASC'; break;
									default: tmp_where.expr2 = url; break; 
								}
								where.push(tmp_where);
								order.push(tmp_order);
								
								exportTable2('vndb_prices_final', where, order, ['notice', 'id', 'confirm']);
								}
							});
                    break;
                    default:
                        $(location).attr("href", $admin_url + "prices/index/" + action);
                    break;
                }
            },

            excute: function(e){
                $this = $(e.currentTarget);
				$("#file-daily").hide();
				pricesView.openModal('Prices Switch', $html, 400);
                var start = $("#startdate").val();
				$.ajax({
					url: $admin_url + 'prices/process_check_date',
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
									pricesView.openModal('Prices Switch', $html, 400);
									$("#modal").show(0, function(){
										$.ajax({
											url: $admin_url + 'prices/process_prices_switch',
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
									pricesView.openModal('Prices Switch', $html, 400);
									$("#modal").show(0, function(){
										$.ajax({
											url: $admin_url + 'prices/process_prices_switch',
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
            showCustomDate: function(event){
                var $this = $(event.currentTarget);
                var $keycode = (event.keycode) ? event.keycode : event.which;
                var date = $($this).val();
                if($keycode == 13){
                    $(location).attr('href', $admin_url + 'prices/index/' + date);
                }
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
                    oTable = $('.table-prices-list').dataTable({
                        "oLanguage":{
                            "sUrl": $file
                        },
                        "sScrollY": "340px",
                        "sScrollX": "100%",
                        // "sScrollXInner": "110%",
                        "bScrollCollapse": true,
                        "iDisplayLength": 10,
                        "iDisplayStart": 0,
                        "bPaginate": false,
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
                            "swidth": "25%",
							"sClass": "string"
                        },
                        {
                            "mData": "market",
                            "sType": "string",
                            "swidth": "25%",
							"sClass": "string"
                        },
                        {
                            "mData": "date",
                            "sType": "date",
                            "swidth": "25%",
							"sClass": "string"
                        },
                        {
                            "mData": "shli",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric"
                        },
                        {
                            "mData": "shou",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric"
                        },
                        {
                            "mData": "pref",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric"
                        },
                        {
                            "mData": "pcei",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric"
                        },
                        {
                            "mData": "pflr",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric"
                        },
                        {
                            "mData": "popn",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric"
                        },
                        {
                            "mData": "phgh",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric"
                        },
						{
                            "mData": "plow",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric"
                        },
						{
                            "mData": "pbase",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric"
                        },
						{
                            "mData": "pavg",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric"
                        },
						{
                            "mData": "pcls",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric"
                        },
						{
                            "mData": "vlm",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric"
                        },
                        {
                            "mData": "trn",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric"
                        },
						{
                            "mData": "last",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric"
                        },
                        {
                            "mData": "adj_pcls",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric"
                        },
                        {
                            "mData": "adj_coeff",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric"
                        },
                        {
                            "mData": "dividend",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric"
                        },
                        {
                            "mData": "rt",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric"
                        },
                        {
                            "mData": "rtd",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric"
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
							 html = '<ul class="controls-buttons" style="margin-top:3px"><li>' +
                                    '<a style="cursor: pointer" action="export" class="with-tip" type="button">' + trans('bt_export') + '</a>'+
                                    '</li></ul>' +
                                    '<div style="clear: left;"></div>';
                            $(".export-buttons").html(html);
                            $("#custom-date").datepicker({
                                dateFormat: 'yy-mm-dd',
                                onSelect: function(selected){
                                    $(location).attr('href', $admin_url + 'prices/index/' + selected);
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
                                url: $admin_url+"prices/delete",
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
			prices_switch: function(){
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
            render: function(){
                if(typeof this[$app.action] != 'undefined'){
                    new this[$app.action];
                }
            }
        });
        return pricesView = new pricesView;
    });
