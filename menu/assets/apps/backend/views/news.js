// Filename: views/news
define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var newsListView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){
            },
            events: {
                "click button.import": "import",
                "keypress #custom-date": "showCustomDate",
                "click #btn-save": "save",
                "click input[type='checkbox']": "getCheckDate",
                "click .export-buttons ul li a": "goTo",
                "click .my-buttons div button": "goTo",
                "click a.view-more": "viewMore"
            },

            viewMore: function(event){
                var $this = $(event.currentTarget);
                var text = $($this).attr("content");//.val();
                var header = $($this).attr('header');
                console.log(text);
                $("#event-dialog").html(text).dialog("option", "title", header);
                $("#event-dialog").html(text).dialog("open");

            },

            goTo: function(event){
                var $this = $(event.currentTarget);
                var action = $($this).attr("action");
                switch(action){
                    case 'add':
                        $(location).attr("href", $admin_url + "news/" + action);
                    break;
                    case 'export':
                        var where = new Array();
                        var order = new Array();
                        var url = location.href;
                        var urls = url.split('/');
                        url = urls[urls.length - 1];
                        var tmp_where = {
                            expr1: 'date_ann',
                            op: '',
                            expr2: '_date_now'
                        };
                        var tmp_order = {
                            value: 'date_ann',
                            type: '',
                        }
                        switch(url){
                            case 'history': tmp_where.op = '<'; tmp_order.type = 'DESC'; break;
                            case 'future': tmp_where.op = '>'; tmp_order.type = 'ASC'; break;
                            case 'today': tmp_where.op = ''; break;
                            case 'index': 
                            case 'news': tmp_where.op = '>='; tmp_order.type = 'DESC'; break;
                            default: tmp_where.expr2 = url; break; 
                        }
                        where.push(tmp_where);
                        var oSettings = $('#vndb_news_day_final').dataTable().fnSettings();
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
                        exportTable2('vndb_news_day_final', where, order, ['notice', 'id', 'date_cnf', 'confirm']);
                    break;
                    default:
                        $(location).attr("href", $admin_url + "news/index/" + action);
                    break;
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
                    $(location).attr('href', $admin_url + 'news/index/' + date);
                }
            },

            import: function(event){
                var $this = $(event.currentTarget);
                var text = encodeURIComponent($("#news-text").val());
                
                var market = $(".market:checked").val();
                $.ajax({
                    url: $admin_url + 'news/import',
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
                formnews.submit();
            },

            index: function(){
                $(document).ready(function(){
                    $("#event-dialog").dialog({
                        modal: true,
                        autoOpen: false,
                        closeOnEscape: true,
                        width: 500
                    });
                    var value_type = new Array();
                    $("input[type=checkbox].selAllChksInGroup").on("click.chkAll", function( event ){
                        $("#filter").removeAttr("ids");
                        $(this).parents('.block-content:eq(0)').find(':checkbox').prop('checked', this.checked);
                        value_type = new Array();
                        $.each($("input[name='stats-display[]']:checked"), function() {
                            value_type.push($(this).val());
                        });
                        $("#filter").attr("ids",value_type);
                    });
                    $("input[name='stats-display[]']").click(function() {
                        $("#filter").removeAttr("ids");
                        value_type = new Array();
                        $.each($("input[name='stats-display[]']:checked"), function() {
                            value_type.push($(this).val());
                        });
                        $("#filter").attr("ids",value_type);
                    });
                    $("#filter").click(function(){
                        var $data_value = $("#filter").attr("ids");
                        if($data_value.length != 0){
                            newsListView.table_filter($data_value);
                        }else{
                             $(".grid_8").hide();
                        }
                    });
                });
            },

            table_filter:function($data_value){
                $(".grid_8").show();
                if(check_file_exists($base_url + 'assets/language/datatables/' + $lang + '.txt')){
                    $file = $base_url + 'assets/language/datatables/' + $lang + '.txt';
                }else{
                    $file = $base_url + 'assets/language/datatables/eng.txt';
                }
                if(typeof oTable != 'undefined'){
                    $("#vndb_news_day_final").dataTable().fnDestroy();
                }
                oTable = $('.table-news-list').dataTable({
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
                    "sAjaxSource": $admin_url+"news/get_data_by_filter",
                    "fnServerData": function(sSource, aoData, fnCallback, oSettings) {
                        aoData.push(
                            {
                                name: 'value_type',
                                value: $data_value
                            }
                        );
                        $.ajax( {
                            "dataType": 'json',
                            "type": "POST",
                            "url": sSource,
                            "data": aoData,
                            success: function(rs){
                                fnCallback(rs);
                            }
                        });

                    },
                    "aoColumns": [
                        {
                            "mData": "ticker",
                            "sType": "string",
                            "sWidth": "7%",
                            "sClass": "string",
                            "sName": "ticker"
                        },
                        {
                            "mData": "market",
                            "sType": "string",
                            "sWidth": "4%",
                            "sClass": "string",
                            "sName": "market"
                        },
                        {
                            "mData": "date_ann",
                            "sType": "string",
                            "sWidth": "10%",
                            "sClass": "string",
                            "sName": "date_ann"
                        },
                        {
                            "mData": "new_type",
                            "sType": "string",
                            "sWidth": "14%",
                            "sClass": "string",
                            "sName": "new_type"
                        },
                        {
                            "mData": "evname",
                            "sType": "numeric",
                            "sWidth": "27%",
                            "sClass": "string",
                            "sName": "evname"
                        },
                        {
                            "mData": "content",
                            "sType": "string",
                            "sWidth": "70%",
                            "sClass": "string",
                            "sName": "content"
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
                                $(location).attr('href', $admin_url + 'news/index/' + selected);
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
            },

            // index: function(){
            //     $(document).ready(function(){
            //         $("#event-dialog").dialog({
            //             modal: true,
            //             autoOpen: false,
            //             closeOnEscape: true,
            //             width: 500
            //         });
            //         
            //     });
            // },

            test1: function(){
                console.log(123);
            },

            render: function(){
                if(typeof this[$app.action] != 'undefined'){
                    new this[$app.action];
                }
            }
        });
        return newsListView = new newsListView;
    });
