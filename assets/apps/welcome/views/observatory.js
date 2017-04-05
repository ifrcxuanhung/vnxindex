// Filename: views/observatory
define([
    'jquery',
    'underscore',
    'backbone'
], function($, _, Backbone) {
    var observatoryView = Backbone.View.extend({
        el: $(".main-container"),
        initialize: function() {
        },
        events: {
            "click a.getarticle": "getArticle"
        },
        getArticle: function(event) {
            var $this = $(event.currentTarget);
            ifrc.getarticle($this.html());
        },
        index: function() {
            $(document).ready(function() {
                $("#branding").remove();
            });
        },
        render: function() {
            if (typeof this[$app.action] != 'undefined') {
                new this[$app.action];
            }
        }
    });
    return new observatoryView;
});
