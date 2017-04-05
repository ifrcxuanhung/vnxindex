// Filename: views/projects/list
define([
    'jquery',
    'underscore',
    'backbone'
], function($, _, Backbone) {
    var indexlistView = Backbone.View.extend({
        el: $(".main-container"),
        initialize: function() {
        },
        events: {
            "click button.action-query": "doQuery"
        },
        doQuery: function(event) {
            var $this = $(event.currentTarget);
            $.modal({
                content: '<textarea class="input_query" type="text" name=""></textarea>',
                title: 'Query',
                maxWidth: 2500,
                width: 800,
                buttons: {
                    'Run Query': function(win) {
                        var query = $('textarea.input_query').val();
                        $.ajax({
                            type: "POST",
                            url: $admin_url + "indexlist/runquery",
                            data: "query=" + query,
                            success: function(data) {
                                //alert(data);
                                var obj = jQuery.parseJSON(data);
                                //alert(obj.performances);
                                //return false;
                                $('#tabs-indexes').html(obj.indexes);
                                $('#tabs-performance').html(obj.performances);
                                $('.sortable').each(function(i)
                                {
                                    var $this = this;
                                    var $data = [];
                                    $(this).find('th').each(function(e) {
                                        var $e = {
                                            sType: $(this).attr('sType'),
                                            bSortable: $(this).attr('bSortable') == 'true' ? true : false,
                                            sClass: $(this).attr('sClass'),
                                            sName: $(this).attr('sName')
                                        };
                                        $data.push($e);
                                    });
                                    var table = $(this);
                                    if ($($this).attr('footer') == 'false') {
                                        if ($($this).attr('search') == 'true') {
                                            dom = '<"block-controls"<"controls-buttons"> <"filter"f>>rti';
                                        } else {
                                            if($($this).attr('block') == 'false'){
                                                dom = 'rti';
                                            }else{
                                                dom = '<"block-controls"<"controls-buttons">> rti';
                                            }
                                        }
                                    }
                                    else {
                                        dom = '<"block-controls"<"controls-buttons"p> <"filter"f>>rti<"block-footer clearfix"l>';
                                    }
                            
                                    var sScrollY = '150px';
                            
                                    if ($($this).attr('page') == 'group') {
                                        dom = '<"block-controls"<"controls-buttons">f>rti';
                                    }
                                    else if ($($this).attr('page') == 'setting') {
                                        sScrollY = '340px';
                                    }
                                    else if ($($this).attr('page') == 'translate') {
                                        sScrollY = '340px';
                                    }
                                    else if ($($this).attr('page') == 'sysformat_showview') {
                                        sScrollY = '340px';
                                    }
                            
                                    $obj_table = {
                                        "sScrollY": $($this).attr('pagination') == 'false' ? sScrollY : '',
                                        "aoColumns": $data,
                                        "aaSorting": [],
                                        "iDisplayLength": 11,
                                        "iDisplayStart": 0,
                                        "bAutoWidth": true,
                                        "bPaginate": $($this).attr('pagination') == 'false' ? false : true,
                                        "sPaginationType": "full_numbers",
                                        "bProcessing": true,
                                        "bRetrieve": true,
                                        /*
                                         * Set DOM structure for table controls
                                         * @url http://www.datatables.net/examples/basic_init/dom.html
                                         */
                                        sDom: dom,
                                        /*
                                         * Callback to apply template setup
                                         */
                                        fnDrawCallback: function()
                                        {
                                            // this.parent().applyTemplateSetup();
                                            $($this).slideDown(200);
                                        },
                                        fnInitComplete: function()
                                        {
                                            // this.parent().applyTemplateSetup();
                                            $($this).slideDown(200);
                                            if ($($this).attr('search') == 'true') {
                                                $('.filter').css({
                                                    'float': 'right',
                                                    'margin-right': '20px'
                                                });
                                            }
                                            div_id = "#" + $(this).attr("id") + "_wrapper";
                                            if ($(this).attr("scroll") == "scrollable") {
                                                $(div_id + " .dataTables_scrollHeadInner").css({
                                                    "background": "-moz-linear-gradient(center top , #CCCCCC, #A4A4A4) repeat scroll 0 0 transparent",
                                                    "border-top": "1px solid white"
                                                });
                                                $(div_id + " .dataTables_scroll th").css("border-top", "none");
                                                $("section").css("margin-bottom", 0);
                                            }
                            
                                        }
                                    };
                                    if ($(this).attr("scroll") == "scrollable") {
                                        $obj_table.bPaginate = false;
                                        $obj_table.sScrollY = "350px";
                                    }
                                    var oTable = table.dataTable($obj_table);
                            
                                    // Sorting arrows behaviour
                                    table.find('thead .sort-up').click(function(event)
                                    {
                                        // Stop link behaviour
                                        event.preventDefault();
                            
                                        // Find column index
                                        var column = $(this).closest('th'),
                                                columnIndex = column.parent().children().index(column.get(0));
                            
                                        // Send command
                                        oTable.fnSort([[columnIndex, 'asc']]);
                            
                                        // Prevent bubbling
                                        return false;
                                    });
                                    table.find('thead .sort-down').click(function(event)
                                    {
                                        // Stop link behaviour
                                        event.preventDefault();
                            
                                        // Find column index
                                        var column = $(this).closest('th'),
                                                columnIndex = column.parent().children().index(column.get(0));
                            
                                        // Send command
                                        oTable.fnSort([[columnIndex, 'desc']]);
                            
                                        // Prevent bubbling
                                        return false;
                                    });
                                    /* make custom btn append to block-controls */
                                });
                                
                                
                                
                                
                                /*
                                win.closeModal();
                                if (msg >= 1) {
                                    $($this).parents('tr').fadeOut('slow');
                                }
                                */
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

        index: function() {
            $(document).ready(function(){
            });
        },
        render: function() {
            if (typeof this[$app.action] != 'undefined') {
                new this[$app.action];
            }
        }
    });
    return new indexlistView;
});
