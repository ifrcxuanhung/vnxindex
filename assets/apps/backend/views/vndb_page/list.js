// Filename: views/vndb_page/list
define([
    'jquery',
    'underscore',
    'backbone'
], function($, _, Backbone) {
    var VNDBPageListView = Backbone.View.extend({
        el: $(".main-container"),
        initialize: function() {
            require(['views/news'], function(obj) {
            });
        },
        events: {
            "click ul.controls-buttons li a": "goTo"
        },
        goTo: function(event) {
            var $this = $(event.currentTarget);
            var action = $($this).attr("action");
            switch (action) {
                case 'export':
                    // var ids = $($this).attr('ids');
                    // exportTable($($this).attr("table"), ids, ['id', 'date_cnf', 'confirm', 'notice']);
                    var where = new Array();
                    // var order = new Array();
                    var url = location.href;
                    var urls = url.split('/');
                    url = urls[urls.length - 1];
                    var table = $($this).attr("table");
                    var tmp_where = {
                        expr1: 'ticker',
                        op: '',
                        expr2: url
                    };
                    // var tmp_order = {
                    //     value: 'date_ex',
                    //     type: '',
                    // }
                    // switch(url){
                    //     case 'history': tmp_where.op = '<'; tmp_order.type = 'DESC'; break;
                    //     case 'furture': tmp_where.op = '>'; tmp_order.type = 'ASC'; break;
                    //     case 'today': tmp_where.op = ''; break;
                    //     case 'index': tmp_where.op = '>='; tmp_order.type = 'DESC'; break;
                    //     default: tmp_where.expr2 = url; break; 
                    // }
                    if (table != "vndb_news_day_final") {
                        where.push(tmp_where);
                    }
                    var filter = '';
                    if ($('#' + table).length == 1) {
                        var oSettings = $('#' + table).dataTable().fnSettings();
                    } else {
                        if ($('.' + table).length == 1) {
                            var oSettings = $('.' + table).dataTable().fnSettings();
                        }
                    }
                    if (typeof oSettings != 'undefined') {
                        filter = oSettings.oPreviousSearch.sSearch;
                    }
                    if (filter != '') {
                        var headers = new Array();
                        $.each(oSettings.aoColumns, function(key, item) {
                            if (item.sName != '') {
                                headers.push(item.sName);
                            }
                        });
                        tmp_where = {
                            sSearch: filter,
                            headers: headers
                        }
                        where.push(tmp_where);
                    }
                    // order.push(tmp_order);
                    order = '';
                    exportTable2(table, where, order, ['notice', 'id', 'date_cnf', 'confirm']);
                    break;
                default:
                    $(location).attr("href", $admin_url + "dividends/index/" + action);
                    break;
            }
            return false;
        },
        index: function() {
            $("#event-dialog").dialog({
                modal: true,
                autoOpen: false,
                closeOnEscape: true,
                width: 500
            });
            $(document).ready(function() {
                var rm_list = ["div.controls-buttons", ".message", ".block-footer"];
                $(rm_list).each(function(i) {
                    $("#ref " + rm_list[i]).remove();
                    $("#div " + rm_list[i]).remove();
                });
                $("#cp .custom-btn1").appendTo("#cp .block-controls");
                $("#ref .custom-btn1").appendTo("#ref .block-controls");
                $("#div .custom-btn1").appendTo("#div .block-controls");

                var columns = [
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
                        "sType": "formattedNum",
                        "swidth": "25%",
                        "sClass": "numeric"
                    },
                    {
                        "mData": "shou",
                        "sType": "formattedNum",
                        "swidth": "25%",
                        "sClass": "numeric"
                    },
                    {
                        "mData": "pref",
                        "sType": "formattedNum",
                        "swidth": "25%",
                        "sClass": "numeric"
                    },
                    {
                        "mData": "pcei",
                        "sType": "formattedNum",
                        "swidth": "25%",
                        "sClass": "numeric"
                    },
                    {
                        "mData": "pflr",
                        "sType": "formattedNum",
                        "swidth": "25%",
                        "sClass": "numeric"
                    },
                    {
                        "mData": "popn",
                        "sType": "formattedNum",
                        "swidth": "25%",
                        "sClass": "numeric"
                    },
                    {
                        "mData": "phgh",
                        "sType": "formattedNum",
                        "swidth": "25%",
                        "sClass": "numeric"
                    },
                    {
                        "mData": "plow",
                        "sType": "formattedNum",
                        "swidth": "25%",
                        "sClass": "numeric"
                    },
                    {
                        "mData": "pbase",
                        "sType": "formattedNum",
                        "swidth": "25%",
                        "sClass": "numeric"
                    },
                    {
                        "mData": "pavg",
                        "sType": "formattedNum",
                        "swidth": "25%",
                        "sClass": "numeric"
                    },
                    {
                        "mData": "pcls",
                        "sType": "formattedNum",
                        "swidth": "25%",
                        "sClass": "numeric"
                    },
                    {
                        "mData": "vlm",
                        "sType": "formattedNum",
                        "swidth": "25%",
                        "sClass": "numeric"
                    },
                    {
                        "mData": "trn",
                        "sType": "formattedNum",
                        "swidth": "25%",
                        "sClass": "numeric"
                    },
                    {
                        "mData": "last",
                        "sType": "formattedNum",
                        "swidth": "25%",
                        "sClass": "numeric"
                    },
                    {
                        "mData": "adj_pcls",
                        "sType": "formattedNum",
                        "swidth": "25%",
                        "sClass": "numeric"
                    },
                    {
                        "mData": "adj_coeff",
                        "sType": "formattedNum",
                        "swidth": "25%",
                        "sClass": "numeric"
                    },
                    {
                        "mData": "dividend",
                        "sType": "formattedNum",
                        "swidth": "25%",
                        "sClass": "numeric"
                    },
                    {
                        "mData": "rt",
                        "sType": "formattedNum",
                        "swidth": "25%",
                        "sClass": "numeric"
                    },
                    {
                        "mData": "rtd",
                        "sType": "formattedNum",
                        "swidth": "25%",
                        "sClass": "numeric"
                    }
                ];
                var ajax_url = $admin_url + "prices";
                VNDBPageListView.createTable("vndb_prices_final", ajax_url, columns);
                var columns = [
                    {
                        "mData": "ticker",
                        "sType": "string",
                        "sClass": "string"
                    },
                    {
                        "mData": "market",
                        "sType": "string",
                        "sClass": "string"
                    },
                    {
                        "mData": "date_ann",
                        "sType": "date",
                        "sClass": "string"
                    },
                    {
                        "mData": "news_type",
                        "sType": "string",
                        "sClass": "string"
                    },
                    {
                        "mData": "evname",
                        "sType": "string",
                        "sClass": "string"
                    },
                    {
                        "mData": "content",
                        "sType": "string",
                        "sClass": "string"
                    }
                ];
                var ajax_url = $admin_url + "news/get_data_by_filter";
                VNDBPageListView.createTable("vndb_news_day_final", ajax_url, columns);
            });
        },
        createTable: function(table, ajax_url, columns) {
            var url = location.href.split('/');
            var ticker = url[url.length - 1];
            if (check_file_exists($base_url + 'assets/language/datatables/' + $lang + '.txt')) {
                $file = $base_url + 'assets/language/datatables/' + $lang + '.txt';
            } else {
                $file = $base_url + 'assets/language/datatables/eng.txt';
            }
            if (typeof oTable != 'undefined') {
                $("#" + table).dataTable().fnDestroy();
            }

            var dom = '<"block-controls"<"controls-buttons"p><"my-buttons">>rti';
            if (table == 'vndb_prices_final') {
                dom = '<"block-controls"<"controls-buttons"><"my-buttons">f>rti';
            }

            var oTable = $("#" + table).dataTable({
                "oLanguage": {
                    "sUrl": $file
                },
                "sScrollY": '300px',
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
                "sAjaxSource": ajax_url,
                "fnServerData": function(sSource, aoData, fnCallback, oSettings) {
                    aoData.push({
                        "name": "ticker",
                        "value": ticker
                    });
                    // $.getJSON( sSource, aoData, function(json) {
                    //              fnCallback(json)
                    //      });
                    $.ajax({
                        "dataType": 'json',
                        "type": "POST",
                        "url": sSource,
                        "data": aoData,
                        // "async": false,                            
                        success: function(rs) {
                            if (table == 'vndb_prices_final') {
                                $.each(rs.aaData, function(key, item) {
                                    rs.aaData[key].splice(rs.aaData[key].length - 1, 1);
                                });
                            }
                            else if (table == 'vndb_news_day_final') {
                                $.each(rs.aaData, function(key, item) {
                                    rs.aaData[key].splice(rs.aaData[key].length - 1, 0);
                                });
                            }
                            fnCallback(rs);
                        }
                    });

                },
                "aoColumns": columns,
                "bPaginate": false,
                "sPaginationType": "full_numbers",
                sDom: dom,
                /* Callback to apply template setup*/
                fnDrawCallback: function()
                {
                    // this.parent().applyTemplateSetup();
                    $(this).slideDown(200);
                },
                fnInitComplete: function()
                {
                    // this.parent().applyTemplateSetup();
                    var div_id = "#" + table + "_wrapper";
                    $(this).slideDown(200);
                    var html = '<ul class="custom-btn1 controls-buttons"><li>' +
                            '<a style="cursor: pointer" action="export" table="' + table + '" class="with-tip" type="button">' + trans('bt_export') + '</a> ' +
                            '</li></ul><div style="clear: left;"></div>';
                    $(div_id + " .my-buttons").html(html);
                    oTable.fnSetFilteringPressEnter();
                    return oTable;
                }
            });
            // $.fn.dataTableExt.oStdClasses["sFilter"] = "my-style-class";
        },
        render: function() {
            if (typeof this[$app.action] != 'undefined') {
                new this[$app.action];
            }
        }
    });
    return VNDBPageListView = new VNDBPageListView;
});
