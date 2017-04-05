// Filename: views/projects/list
define([
    'jquery',
    'underscore',
    'backbone'], function($, _, Backbone) {
    var resourceListView = Backbone.View.extend({
        el: $(".main-container"),
        initialize: function() {},
        events: {
            "click a.action-delete": "doDelete",
            'click .action-add-right': 'doAddRight',
            'click .action-remove-right': 'doRemoveRight'
        },
        doDelete: function(event) {
            var $this = $(event.currentTarget);
            if (confirm('Are you sure')) {
                var id = $($this).attr("service_id");
                $.ajax({
                    type: "POST",
                    url: $admin_url + "service/delete",
                    data: "id=" + id,
                    success: function(msg) {
                        if (msg >= 1) {
                            $($this).parents('tr').fadeOut('slow');
                        }
                    }
                });
            }
        },
        doAddRight: function(e) {
            var $this = $(e.currentTarget);
            $this.parent().append('<span class="service-right "><input type="text" name="right[]"  value="" /><a class="action-remove-right" href="javascript:void(0)"><img src="' + $template_url + 'images/icons/fugue/cross-circle.png" width="16" height="16"> <span>Remove</span></a></span>');
        },
        doRemoveRight: function(e) {
            var $this = $(e.currentTarget);
            $this.parent().remove();
        },
        index: function() {
            $(document).ready(function() {
                oTable = $('.table-service-list').dataTable({
                    "iDisplayLength": 10,
                    "iDisplayStart": 0,
                    "bProcessing": true,
                    "aaSorting": [],
                    "sAjaxSource": $admin_url + "service/listdata",
                    "aoColumns": [{
                        "mData": "id"
                    }, {
                        "mData": "name"
                    },
                    {
                        "mData": "alias"
                    }
                    , {
                        "mData": "right"
                    }, {
                        "mData": "actions"
                    }, ],
                    "sPaginationType": "full_numbers",
                    sDom: '<"block-controls"<"controls-buttons"p>>rti<"block-footer clearfix"lf>',

                    /* Callback to apply template setup*/
                    fnDrawCallback: function() {
                        this.parent().applyTemplateSetup();
                        $(this).slideDown(200);
                    },
                    fnInitComplete: function() {
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
    return new resourceListView;
});