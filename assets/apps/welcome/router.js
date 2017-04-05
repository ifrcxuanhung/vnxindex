// Filename: router.js
define([
    'jquery',
    'underscore',
    'backbone', ], function($, _, Backbone) {
    var AppRouter = Backbone.Router.extend({
        routes: {
            'welcome': 'welcomeAction',
            'welcome/*path': 'welcomeAction',
            'home': 'homeAction',
            'home/*path': 'homeAction',
            'report': 'reportAction',
            'report/*path': 'reportAction',
            'report_stock': 'reportStockAction',
            'report_stock/*path': 'reportStockAction',
            'article': 'articleAction',
            'article/*path': 'articleAction',
            'page': 'pageAction',
            'page/*path': 'pageAction',
            'researhchers': 'researhchersAction',
            'researhchers/*path': 'researhchersAction',
            'jq_loadtable': 'jq_loadtableAction',
            'jq_loadtable/*path': 'jq_loadtableAction',
            'observatory': 'observatoryAction',
            'observatory/*path': 'observatoryAction',
            '*actions': 'defaultAction'
        },
        welcomeAction: function() {
            require(['views/welcome'], function(welcomeView) {
                welcomeView.render();
            });
        },
        jq_loadtableAction: function(){
            require(['views/jq_loadtable'], function(jq_loadtableView){
                jq_loadtableView.render();
            });
        },
        homeAction: function() {
            require(['views/home'], function(homeView) {
                homeView.render();
            });
        },
        reportAction: function() {
            require(['views/report'], function(reportView) {
                reportView.render();
            });
        },
        reportStockAction: function() {
            require(['views/report_stock'], function(reportStockView) {
                reportStockView.render();
            });
        },
        articleAction: function() {
            require(['views/article'], function(articleView) {
                articleView.render();
            });
        },
        pageAction: function() {
            require(['views/page'], function(pageView) {
                pageView.render();
            });
        },
        researchersAction: function() {
            require(['views/researchers'], function(researchersView) {
                researchersView.render();
            });
        },
        observatoryAction: function() {
            require(['views/observatory'], function(observatoryView) {
                observatoryView.render();
            });
        },
        defaultAction: function(actions) {

            // We have no matching route, lets display the home page
        }
    });
    var initialize = function() {
        var app_router = new AppRouter;
            if (Backbone.history&& !Backbone.History.started) {
                var startingUrl = $base_url.replace(location.protocol + '//' + location.host, "");
                    var pushStateSupported = _.isFunction(history.pushState);
                // Browsers without pushState (IE) need the root/page url in the hash
                if (!(window.history && window.history.pushState)) {
                    window.location.hash = window.location.pathname.replace(startingUrl, '');
                    startingUrl = window.location.pathname;
                }
                Backbone.history.start({ pushState: true, root: startingUrl });
                if (!pushStateSupported) {
                    var fragment = window.location.pathname.substr(Backbone.history.options.root.length);
                    Backbone.history.navigate(fragment, { trigger: true });
                }
            }
        $("div.account").on("click", "a", function() {
            var that = this;
            require(['views/account'], function(accountView) {
                accountView.accountManage(that);
            });
        });
        $("a.forgotten_password").live("click", function() {
            var html = '<form id="forgot-form" method="post">' +
                    '<p class="message error no-margin"></p>' +
                    '<label style="float: left; width: 90px; margin-left: 62px">E-mail</label>' +
                    '<input type="text" name="identity" style="margin-bottom: 10px; width: 250px" /><br />' +
                    '<label style="float: left; width: 90px; margin-left: 62px">Captcha</label>' +
                    '<div class="field"><img style="margin-left:5px;" src="' + $base_url + 'captcha" />' +
                    '<input type="text" style="width: 50px; float: left; height: 24px" name="security_code" class="<?php echo isset($input[\'security_code\']) ? \'error\' : NULL; ?>" />' +
                    '</div>' +
                    '<label style="float: left; width: 90px; margin-left: 62px">&nbsp;</label>' +
                    '<div style="margin-bottom: 10px"><button type="submit" name="submit" class="ui-button">Submit</button></div>' +
                    '</form>';
            $("#account-dialog").html(html);
            $("button[name='submit']").click(function() {
                $.ajax({
                    url: $base_url + 'account/forgotten_password',
                    type: 'post',
                    data: $("#forgot-form").serialize(),
                    success: function(rs) {
                        $("#account-dialog p.error").html(rs);
                    }
                });
                return false;
            });
        });
    };
    return {
        initialize: initialize
    };
});