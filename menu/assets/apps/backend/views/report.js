// Filename: views/hsx/list
define([
    'jquery',
    'underscore',
    'backbone',
	'text!templates/caculation/report.html'
    ], function($, _, Backbone,reportTemplate){
		var $html='<div class="caculation-report"><img style="margin-left:180px" src="'+$template_url+'images/loading.gif"/></div>';
        var fileListView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){
            },
            events: {
                "click #save": "excute",
        
            },
			openModal: function openModal($title,$content,$width)
			{
				$.modal({
					content: $content,
					title: $title,
					maxWidth: 2500,
					width: $width,
					buttons: {
						'Close': function(win) {
							window.location.href = $admin_url;
						}
					}
				});
			},
            excute: function(e){
                $this = $(e.currentTarget);
                $("#file-daily").hide();
                $(".disable-form").show();
                $(".disable-form").append("<img src='" + $base_url + "assets/templates/backend/images/mask-loader.gif' style='position: absolute; top: 50%; left: 50%;' />");
                var month = $("#month").val();
                var year = $("#year").val();
					fileListView.openModal('Report Month', $html, 400);
                    $("#modal").show(0, function(){
						$.ajax({
							url: $admin_url + "report/process_report_month",
							type: 'post',
							data: 'month=' + month + '&year=' + year,
							async: false,
							success: function(data){
								var dataTemplate = {};
								dataTemplate.report = JSON.parse(data);
                                //var compiledTemplate = _.template( reportTemplate, datatemplate );
                                $('.caculation-report').html('<ul class="blocks-list">'
									+"<li>"
										+'<a href="#" class="float-left"><img width="16" height="16" src="'+$template_url+'images/icons/fugue/status.png"> '+dataTemplate.report.task+'</a>'
										+'<ul class="tags float-right">'
											+'<li>'+dataTemplate.report.result+'</li>'
										+"</ul>"
									+"</li>"
								+"</ul>").fadeIn();
							}
						});
					})
                //}
            },
        });
        return fileListView = new fileListView;
    });
