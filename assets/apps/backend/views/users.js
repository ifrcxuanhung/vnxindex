// Filename: views/projects/list
define([
    'jquery',
    'underscore',
    'backbone'
], function($, _, Backbone) {
    var userListView = Backbone.View.extend({
        el: $(".main-container"),
        initialize: function() {

        },
        events: {
            "click a.action-delete": "doDelete"
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
                        var id = $($this).attr('user_id');
                        $.ajax({
                            type: "POST",
                            url: $admin_url + "users/delete",
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
        doGetFormServices: function(event) {
            var $this = $(event.currentTarget);
            var $groupId = $($this).val();
            $.ajax({
                type: 'POST',
                url: $admin_url + "users/get_form_services",
                data: 'id=' + $groupId,
                success: function(rs) {
                    $('.services-content').html(rs);
                    generalApply();
                    $(document.body).applyTemplateSetup();
                }
            });
        },
        index: function() {
            $(document).ready(function()
            {
                oTable = $('.table-user-list').dataTable({
                    "iDisplayLength": 10,
                    "iDisplayStart": 0,
                    "bProcessing": true,
                    "aaSorting": [],
                    "sAjaxSource": $admin_url + "users/listdata",
                    "aoColumns": [
                        {
                            "mData": "first_name"
                        },
                        {
                            "mData": "last_name"
                        },
                        {
                            "mData": "email"
                        },
                        {
                            "mData": "group"
                        },
                        {
                            "mData": "active"
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
        services: function() {

        },
        render: function() {
            if (typeof this[$app.action] != 'undefined') {
                new this[$app.action];
            }
        }
    });
    return new userListView;
});
