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
            '*actions': 'defaultAction'
        },
        welcomeAction: function(){
            require(['views/welcome'], function(welcomeView){
                welcomeView.render();
            });
        },
        homeAction: function(){
            require(['views/home'], function(homeView){
                homeView.render();
            });
        },
        defaultAction: function(actions) {

            // We have no matching route, lets display the home page
        }
    });
    var initialize = function() {
        var app_router = new AppRouter;
        Backbone.history.start({
            pushState: true,
            root: "/vnfdb/"
        });
        $("div.account").on("click", "a", function(){
            var that = this;
            require(['views/account'], function(accountView){
                accountView.accountManage(that);
            });
        });
        $("a.forgotten_password").live("click", function(){
            var html = '<form id="forgot-form" method="post">'+
                    '<p class="message error no-margin"></p>'+
                    '<label style="float: left; width: 90px; margin-left: 62px">E-mail</label>'+
                    '<input type="text" name="identity" style="margin-bottom: 10px; width: 250px" /><br />'+
                    '<label style="float: left; width: 90px; margin-left: 62px">Captcha</label>'+
                    '<div class="field"><img style="margin-left:5px;" src="' + $base_url + 'captcha" />'+
                        '<input type="text" style="width: 50px; float: left; height: 24px" name="security_code" class="<?php echo isset($input[\'security_code\']) ? \'error\' : NULL; ?>" />'+
                    '</div>'+
                    '<label style="float: left; width: 90px; margin-left: 62px">&nbsp;</label>'+
                    '<div style="margin-bottom: 10px"><button type="submit" name="submit" class="ui-button">Submit</button></div>'+
                    '</form>';
            $("#account-dialog").html(html);
            $("button[name='submit']").click(function(){
                $.ajax({
                    url: $base_url + 'account/forgotten_password',
                    type: 'post',
                    data: $("#forgot-form").serialize(),
                    success: function(rs){
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