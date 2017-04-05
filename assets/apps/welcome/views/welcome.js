// Filename: views/welcome
define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var welcomeView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){
            },
            events: {
                // "click a.action-delete": "doDelete",
                //"click a.order": "showColumnByOrder"
            },
            index: function(){
            },
            render: function(){
                if(typeof this[$app.action] != 'undefined'){
                    new this[$app.action];
                }
            }
        });
        return welcomeView = new welcomeView;
});
