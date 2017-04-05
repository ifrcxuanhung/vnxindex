// Filename: views/welcome
define([
    'jquery',
    'underscore',
    'backbone'
], function($, _, Backbone) {
    var pageView = Backbone.View.extend({
        el: $(".main-container"),
        initialize: function() {
        },
        events: {
        },
        index: function() {
            $(document).ready(function() {
                var $href = "";
                $("div.main_content a").each(function() {
                    $href = $(this).attr("href");
                    if (typeof $href !== "undefined") {
                        if ($href.indexOf("http") === -1) {
                            if ($href.substring(0, 1) === "/") {
                                $(this).attr("href", $base_url + $href.substring(1));
                            } else {
                                $(this).attr("href", $base_url + $href);
                            }
                        }
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
    return new pageView;
});
