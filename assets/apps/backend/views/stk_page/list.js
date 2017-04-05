// Filename: views/stk_page/list
define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var stkPageListView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){
            },
            events: {
                
                "click a.export": "export",
                
            },
            export: function(event){
                var $this = $(event.currentTarget);
                exportTable("#composition", 'stk_composition.csv');
            },
            index: function(){
                $(document).ready(function(){
                    var rm_list = ["controls-buttons", "message", "block-footer"];
                    $(rm_list).each(function(i){
                        $("#ref ." + rm_list[i]).remove();
                    });
                    $(".block-footer").remove();
                });
            },

            render: function(){
                if(typeof this[$app.action] != 'undefined'){
                    new this[$app.action];
                }
            }
        });
        return stkPageListView = new stkPageListView;
    });
