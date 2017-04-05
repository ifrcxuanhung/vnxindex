// Filename: views/language
define([
    'jquery',
    'underscore',
    'backbone'
], function($, _, Backbone) {
    var languageListView = Backbone.View.extend({
        el: $(".main-container"),
        initialize: function() {
        },
        events: {
            "click a.action-delete": "doDelete",
            "click a.language-active": "doActive"
        },
        doDelete: function(event) {
            var $this = $(event.currentTarget);
            $.modal({
                content: 'Are you sure?',
                title: 'Delete',
                maxWidth: 2500,
                width: 400,
                buttons: {
                    'Yes': function(win) {
                        var id = $($this).attr('language_id');
                        $.ajax({
                            type: "POST",
                            url: $admin_url + "language/delete",
                            data: "id=" + id,
                            success: function(msg) {
                                win.closeModal();F
                                if (msg >= 1) {
                                    $($this).parents("tr").fadeOut('slow');
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
        doActive: function(event) {
            var $this = $(event.currentTarget);
            //if (confirm('Are you sure')) {
            var id = $($this).attr('language_id');
            var text = $($this).text();
            var anchor = $this;
            if (anchor.data("disabled")) {
                return false;
            }
            anchor.data("disabled", "disabled");
            $("#loading").show();
            $.ajax({
                type: "POST",
                url: $admin_url + "language/chang_active",
                data: "id=" + id + "&text=" + text,
                success: function(text) {
                    if (typeof text !== "undefined") {
                        if (text == "Enable") {
                            $($this).css("color", "green");
                        }
                        else if (text == "Disable") {
                            $($this).css("color", "red");
                        }
                        $($this).text(text);
                    }
                    anchor.removeData("disabled");
                    $("#loading").hide();
                }
            });
            //}
        },
        index: function() {
            $(document).ready(function()
            {
                if (check_file_exists($base_url + 'assets/language/datatables/' + $lang + '.txt')) {
                    $file = $base_url + 'assets/language/datatables/' + $lang + '.txt';
                } else {
                    $file = $base_url + 'assets/language/datatables/eng.txt';
                }
                oTable = $('.table-language-list').dataTable({
                    "oLanguage": {
                        "sUrl": $file
                    },
                    "iDisplayLength": 10,
                    "iDisplayStart": 0,
                    "bProcessing": true,
                    "aaSorting": [],
                    "sAjaxSource": $admin_url + "language/listdata",
                    "aoColumns": [
                        {
                            "mData": "name"
                        },
                        {
                            "mData": "code"
                        },
                        {
                            "mData": "sort_order"
                        },
                        {
                            "mData": "status"
                        },
                        {
                            "mData": "action"
                        }
                    ],
                    "sScrollY": '300px',
                    "bScrollCollapse": true,
                    "bPaginate": false,
                    "sPaginationType": "full_numbers",
                    sDom: '<"block-controls"<"controls-buttons">f>rti',
                    /* Callback to apply template setup*/
                    fnDrawCallback: function()
                    {
                        this.parent().applyTemplateSetup();
                        $(this).slideDown(200);
                    },
                    fnInitComplete: function()
                    {
                        this.parent().applyTemplateSetup();
                        $(this).slideDown(200);
                    }
                });
            });
        },
        render: function() {
            if (typeof this[$app.action] != 'undefined') {
                new this[$app.action];
            }
        }
    });
    return new languageListView;
});
