// Filename: views/projects/list
define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/services/list.html'
    ], function($, _, Backbone, servicesListTemplate){
        var servicesListView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){
            },
            events: {
                "click a.action-delete": "doDelete",
                "change select[name='services']": "doChangeParentCate",
                "click a.services-active": "doActive",
                'click .action-add-right': 'doAddRight',
                'click .action-remove-right': 'doRemoveRight'
            },
            doDelete:function(event){
                var $this=$(event.currentTarget);
                if (confirm('Are you sure')) {
                    var id=$($this).attr("services_id");
                    $.ajax({
                        type: "POST",
                        url: $admin_url+"services/delete",
                        data: "id=" + id,
                        success: function(msg){
                            if(msg>=1){
                                $($this).parents('tr').fadeOut('slow');
                            }else{
                                alert('the child services still exists');
                            }
                        }
                    });
                }
            },
            doActive:function(event){
                var $this=$(event.currentTarget);
                //if (confirm('Are you sure')) {
                    var id=$($this).attr("services_id");
                    var text=$($this).text();
                    $("#loading").show();
                    $.ajax({
                        type: "POST",
                        url: $admin_url+"services/chang_active",
                        data: "id="+id + "&text=" + text,
                        success: function(text){
                            if(typeof text !== "undefined"){
                                if(text == "Enable") {
                                    $($this).css("color", "green");
                                }
                                else if(text == "Disable") {
                                     $($this).css("color", "red");
                                }
                                $($this).text(text);
                            }
                            $("#loading").hide();
                        }
                    });
                //}
            },
            doChangeParentCate :function(event){
                var $this=$(event.currentTarget);
                var id = $this.val();
                window.location = $base_url + 'backend/services/index/' + id;
            },
            doAddRight: function(e) {
                var $this = $(e.currentTarget);
                $this.parent().append('<span class="service-right "><input type="text" name="right[]"  value="" /><a class="action-remove-right" href="javascript:void(0)"><img src="' + $template_url + 'images/icons/fugue/cross-circle.png" width="16" height="16"> <span>Remove</span></a></span>');
            },
            doRemoveRight: function(e) {
                var $this = $(e.currentTarget);
                $this.parent().remove();
            },
            index: function(){
                $(document).ready(function()
                {
                    var $string = document.URL;
                    var $str_arr = $string.split('/');
                    $id = $str_arr[$str_arr.length - 1];
                    if(check_file_exists($base_url + 'assets/language/datatables/' + $lang + '.txt')){
                        $file = $base_url + 'assets/language/datatables/' + $lang + '.txt';
                    }else{
                        $file = $base_url + 'assets/language/datatables/eng.txt';
                    }
                    oTable = $('.table-services-list').dataTable({
                        "oLanguage":{
                            "sUrl": $file
                        },
                        "iDisplayLength":10,
                        "iDisplayStart": 0,
                        "bProcessing": true,
                        "aaSorting": [],
                        "sAjaxSource": $admin_url+"services/listdata/" + $id,
                        "aoColumns": [
                        {
                            "mData": "services_id"
                        },
                        {
                            "mData": "name"
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
                        "sPaginationType": "full_numbers",
                        sDom: '<"block-controls"<"controls-buttons"p>>rti<"block-footer clearfix"lf>',

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
                var data={};
                var compiledTemplate = _.template( servicesListTemplate, data );
                $("#page").html( compiledTemplate );
            },
            render: function(){
                if(typeof this[$app.action] != 'undefined'){
                    new this[$app.action];
                }
            }
        });
        return new servicesListView;
    });
