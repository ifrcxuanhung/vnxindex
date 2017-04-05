// Filename: views/dividend_report
define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var dividendReportListView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){
            },
            events: {
                "click #save": "count"

            },
            count: function(){
                start = $("#startdate").val();
                if(check_file_exists($base_url + 'assets/language/datatables/' + $lang + '.txt')){
                    $file = $base_url + 'assets/language/datatables/' + $lang + '.txt';
                }else{
                    $file = $base_url + 'assets/language/datatables/eng.txt';
                }
                $(".table-report").dataTable().fnDestroy();
                oTable = $('.table-report').dataTable({
                    "oLanguage":{
                        "sUrl": $file
                    },
                    "iDisplayLength": 10,
                    "iDisplayStart": 0,
                    "bProcessing": true,
                    "bRetrieve": true,
                    "aaSorting": [],
                    "bAutoWidth": true,
                    "bServerSide": false,
                    "sAjaxSource": $admin_url + 'dividend_report',
                    "fnServerData": function(sSource, aoData, fnCallback, oSettings) {
                        aoData.push({
                            "name" : "start",
                            "value" : start
                        });
                        // $.getJSON( sSource, aoData, function(json) {
                        //              fnCallback(json)
                        //      });
                        $.ajax( {
                            "dataType": 'json',
                            "type": "POST",
                            "url": sSource,
                            "data": aoData,
                            "success": fnCallback
                        });

                    },
                    "aoColumns": [
                    {
                        "mData": "date_ex",
                        "sType": "date",
                        "swidth": "25%"
                    },
                    {
                        "mData": "ticker",
                        "sType": "string",
                        "swidth": "25%"
                    },
                    {
                        "mData": "market",
                        "sType": "string",
                        "swidth": "25%"
                    },
                    {
                        "mData": "div_value",
                        "sType": "formatted-num",
                        "swidth": "25%"
                    },
                    {
                        "mData": "exc_info",
                        "sType": "formatted-num",
                        "swidth": "25%"
                    }
                    ],
                    "sPaginationType": "full_numbers",
                    sDom: '<"block-controls"<"controls-buttons"p>>rti<"block-footer clearfix"lf>',

                    /* Callback to apply template setup*/
                    fnDrawCallback: function()
                    {
                        // this.parent().applyTemplateSetup();
                        $(this).slideDown(200);
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
            index: function(){
                $(document).ready(function(){
                    var $date='';
                    $.ajax({
                        type: "POST",
                        url: $admin_url+"vndb_report/date",
                        success: function(data){
                            data=JSON.parse(data);
                            $date=data.date;
                            $("#startdate").datepicker({
                                maxDate: 0,
                                minDate:$date,
                                dateFormat: 'yy-mm-dd',
                                onSelect: function(selected){
                                    $("#enddate").datepicker("option", "minDate", selected);
                                    $("#enddate").val($("#startdate").val());
                                }
                            });
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
        return dividendReportListView = new dividendReportListView;
    });
