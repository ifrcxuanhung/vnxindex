// Filename: views/events
define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/caculation/report.html'
    ], function($, _, Backbone, reportTemplate){
        var eventsListView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){
            },
            events: {
                "click a.view-more": "viewMore",
                "click .export-buttons a": "export",
                // "keyup #vndb_economics_ref_filter input": "filter"
            },

            // filter: function(event){
            //     event.preventDefault();
            //     event.isPropagationStopped();
            //     return false;
            //     var $this = $(event.currentTarget);
            //     // var input = $($this).val();
            //     var id = "#" + $($this).parent().attr("id").replace("_filter", "");
            //     $(id).dataTable({bRetrieve: true}).fnDraw();
            //     // $(id).dataTable({bRetrieve: true}).fnMyFilter(input);
            // },

            export: function(event){
                $("#lean_overlay").show(100, function(){
                    var $this = $(event.currentTarget);
                    var table = $($this).attr("table");
                    if(table == "vndb_economics_ref"){
                        $.ajax({
                            url: $admin_url + 'sysformat/export',
                            type: 'get',
                            data: 'table=' + table,
                            async: false,
                            success: function(rs){
                                rs = JSON.parse(rs);
                                $("#lean_overlay").hide();
                                window.location.href = $admin_url + 'sysformat/download_file?file=' + rs.file + '&path=' + rs.path;
                            }
                        });
                    }
                    if(table == "vndb_economics_data"){
                        $.ajax({
                            url: location.href,
                            type: 'get',
                            data: 'table=' + table,
                            async: false,
                            success: function(sql){
                                $.ajax({
                                    url: $admin_url + 'economic/export',
                                    type: 'post',
                                    data: 'sql=' + sql,
                                    success: function(rs){
                                        rs = JSON.parse(rs);
                                        $("#lean_overlay").hide();
                                        window.location.href = $admin_url + 'sysformat/download_file?file=' + rs.file + '&path=' + rs.path;
                                    }
                                });
                                
                            }
                        });
                    }
                });
            },

            viewMore: function(event){
                var $this = $(event.currentTarget);
                var text = $($this).attr("content");//.val();
                var header = $($this).attr('header');
                console.log(text);
                $("#event-dialog").html(text).dialog("option", "title", header);
                $("#event-dialog").html(text).dialog("open");

            },
            
            doImportEconomic: function(){
                $.modal({
                    content: 'Are you sure?',
                    title: 'Import Economic',
                    maxWidth: 2500,
                    width: 400,
                    buttons: {
                        'Yes': function(win) {
                            win.closeModal();
                            $("#lean_overlay").show();
                            var start = new Date().getTime() / 1000;
                            $.ajax({
                                type: "POST",
                                url: $admin_url+"observatory/import_economics",
                                success: function(){
                                    $("#lean_overlay").hide();
                                    var end = new Date().getTime() / 1000;
                                    var time = [{
                                        "task": trans("bt_finish", 1), 
                                        "time": (end - start).toFixed(2)
                                    }];
                                    openModal(trans("mn_import_economics", 1), "<div class='import-economic-report'></div>", 400);
                                    var datatemplate={};
                                    datatemplate.report=time;
                                    var compiledTemplate = _.template( reportTemplate, datatemplate );
                                    $(".import-economic-report").html(compiledTemplate).fadeIn();
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

            data: function(){
                $(document).ready(function(){
                    $(".block-footer").remove();
                    $(".filter").css({'margin-right':'10px','float':'right'});
                    $(".controls-buttons").html('<div class="export-buttons" style="margin: 5px 0 0 0; padding: 0"><ul class="controls-buttons"><li style="margin: 0; padding: 0"><a type="button" table="vndb_economics_data" class="with-tip" action="export" style="cursor: pointer">Export</a></li></ul></div>');
                });
            },

            index: function(){
                $(document).ready(function(){
                    $("#event-dialog").dialog({
                        modal: true,
                        autoOpen: false,
                        closeOnEscape: true,
                        width: 500
                    });
                    $("#vndb_economics_ref_filter input").unbind("keyup").bind("keyup", function(){
                        // $("#my-filter").val($(this).val()).trigger("change");
                        var id = "#" + $(this).parent().attr("id").replace("_filter", "");
                        $(id).dataTable({bRetrieve: true}).fnDraw();
                    });
                    $.fn.dataTableExt.afnFiltering.push(
                        function( oSettings, aData, iDataIndex ) {
                            var check = false;
                            var keywords = $("#vndb_economics_ref_filter input").val();                            
                            if(keywords == ""){
                                check = true;
                            }else{
                                keywords = keywords.split(',');
                                $.each(aData, function(i, sample){
                                    check = true;
                                    sample = $.trim(aData[i]);
                                    // console.log(sample);
                                    $.each(keywords, function(item, keyword){
                                        if (sample.toLowerCase().indexOf(keyword.toLowerCase()) == -1)
                                        {
                                            check = false;
                                            return false;
                                        }
                                    });
                                    if(check == true){
                                        return false;
                                    }
                                });
                            }
                            return check;
                        }
                    );
                    $(".controls-buttons").html('<div class="export-buttons" style="margin: 5px 0 0 0; padding: 0"><ul class="controls-buttons"><li style="margin: 0; padding: 0"><a table="vndb_economics_ref" type="button" class="with-tip" action="export" style="cursor: pointer">Export</a></li></ul></div>');
                });
            },

            render: function(){
                if(typeof this[$app.action] != 'undefined'){
                    new this[$app.action];
                }
            }
        });
        return new eventsListView;
    });
