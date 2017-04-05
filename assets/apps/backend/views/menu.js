// Filename: views/projects/list
define([
    'jquery',
    'underscore',
    'backbone'
], function($, _, Backbone) {
    var menuListView = Backbone.View.extend({
        el: $(".main-container"),
        initialize: function() {
        },
        events: {
            "click a.action-delete": "doDelete",
            "click input.action-change-status": "doChangeStatus"
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
                        var id = $($this).attr('menu_id');
                        $.ajax({
                            type: "POST",
                            url: $admin_url + "menu/delete",
                            data: "id=" + id,
                            success: function(msg) {
                                win.closeModal();
                                if (msg >= 1) {
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
        doChangeStatus: function(event) {
            var $this = $(event.currentTarget);
            var status = 'unchecked';
            var id = $($this).attr('menu_id');
            if ($($this).prop('checked')) {
                status = 'checked';
            }
            $.ajax({
                url: $base_url + 'backend/menu/active',
                type: 'post',
                data: 'status=' + status + '&id=' + id,
                async: false,
                success: function(html) {
                    if (html == 'success') {
                        alert('Change Successful!')
                    }
                }
            });
        },
        index: function() {
            $(document).ready(function()
            {
                if (check_file_exists($base_url + 'assets/language/datatables/' + $lang + '.txt')) {
                    $file = $base_url + 'assets/language/datatables/' + $lang + '.txt';
                } else {
                    $file = $base_url + 'assets/language/datatables/eng.txt';
                }
                oTable = $('.table-menu-list').dataTable({
                    "oLanguage": {
                        "sUrl": $file
                    },
                    "iDisplayLength": 10,
                    "iDisplayStart": 0,
                    "bProcessing": true,
                    "aaSorting": [],
                    "sAjaxSource": $admin_url + "menu/listdata",
                    "aoColumns": [
                        {
                            "mData": "name",
                            "sType": "string",
                            "bSearchable": true,
                            "bSortable": true
                        },
                        {
                            "mData": "link",
                            "sType": "string",
                            "bSearchable": true,
                            "bSortable": true
                        },
                        {
                            "mData": "website",
                            "sType": "string",
                            "bSearchable": true,
                            "bSortable": true
                        },
                        {
                            "mData": "sort_order",
                            "sType": "numeric",
                            "bSearchable": true,
                            "bSortable": true
                        },
                        {
                            "mData": "status",
                            "sType": "numeric",
                            "bSearchable": true,
                            "bSortable": true
                        },
                        {
                            "mData": "actions",
                            "bSearchable": true,
                            "bSortable": true
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
                        //  this.parent().applyTemplateSetup();
                        this.parent().applyTemplateSetup();
                        $(this).slideDown(200);
                    },
                    fnInitComplete: function()
                    {
                        //  this.parent().applyTemplateSetup();
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
    return new menuListView;
});
