// Filename: views/cpaction
define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var fundamentalListView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){
            },
            events: {
                "click #btn-save": "save",
		"click #btn-cancel": "cancel",
                "click .delete": "doDelete"
            },
			
            doDelete:function(event){
                var $this=$(event.currentTarget);
                if (confirm('Are you sure?')) {
                    var id=$($this).attr("pid");
                    $.ajax({
                        type: "POST",
                        url: $admin_url+"fundamental/delete",
                        data: "id=" + id,
                        success: function(msg){
                            if(msg>=1){
                                $($this).parents('tr').fadeOut('slow');
                            }
                        }
                    });
                }
            },

            save: function(){
                var confirm = $("input[type='checkbox']:checked").val();
                $("#confirm").val((confirm === 'on') ? 1 : 0);
                if($)
                formFundamental.submit();
            },
                    
            cancel: function(){
                location.href = $admin_url + 'fundamental/index/';
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
                    oTable = $('.table-fundamental-list').dataTable({
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
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "ticker"
                        },
                        {
                            "mData": "date",
                            "sType": "date",
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "date"
                        },
                        {
                            "mData": "code_data",
                            "sType": "string",
                            "swidth": "25%",
                            "sClass": "string",
                            "sName": "code_data"
                        },
                        {
                            "mData": "year",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric",
                            "sName": "year"
                        },
                        {
                            "mData": "fvalue",
                            "sType": "numeric",
                            "swidth": "25%",
                            "sClass": "numeric",
                            "sName": "fvalue"
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
                                        '</div>' +
                                        '<div style="clear: left;"></div>';
                            $(".my-buttons").html(html);
							 html = '<ul class="controls-buttons"><li>' +
                                    '<a style="cursor: pointer" action="export" class="with-tip" type="button">' + trans('bt_export') + '</a>'+
                                    '</li></ul>' +
                                    '<div style="clear: left;"></div>';
							 $(".export-buttons").html(html);
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
        return new fundamentalListView;
    });
