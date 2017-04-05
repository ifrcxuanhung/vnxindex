<?php
	//echo base_url();
	//echo template_url();
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>IFRC (Intelligent Financial Research & Consulting) | Home</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="<?php echo template_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo template_url(); ?>assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo template_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo template_url(); ?>assets/css/style-metro.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo template_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo template_url(); ?>assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo template_url(); ?>assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
        <link href="<?php echo template_url(); ?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo template_url(); ?>assets/css/pages/coming-soon.css" rel="stylesheet" type="text/css"/>
        <!-- END PAGE LEVEL STYLES -->
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body class="bg_comms">
        <div class="container">
            <div class="row-fluid">
                <div class="span6 coming-soon-header">
                    <a class="brand" href="http://vnxindex.com/home">
                        <img src="<?php echo template_url(); ?>images/LOGO_IFRCINDEXES_NEW.png" alt="" />
                    </a>
                    <a class="brand_psi" href="http://vnxindex.com/home">
                        <img src="<?php echo template_url(); ?>images/logo-psi.png" alt="" />
                    </a>
                </div>
                <div class="span5 coming-soon-countdown">
                    <div id="defaultCountdown"></div>
                </div>
            </div>
			
            <div class="row-fluid">
			
                <div class="span12 coming-soon-content">
                <?php
                    foreach($list_art as $k=>$article)
                    {
                        $link = base_url() .'article/index/'. $article['category_id'] .'/'. $article['article_id'] .'/'. utf8_convert_url($article['title']) .'.html';
                ?>
                    <h1><a href="<?php echo $link ?>"><?php echo $article['title'] ?></a></h1>
                    <p><?php echo $article['description'] ?></p>
                    <br/>
                <?php } ?>

                </div>
			
                
            </div>
            <!--/end row-fluid-->
            <div class="row-fluid">
                <div class="span12 coming-soon-footer fix_cl_comming">
                    2013 © Developed by IFRC.
                </div>
            </div>
        </div>
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo template_url(); ?>assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
        <script src="<?php echo template_url(); ?>assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
        <!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
        <script src="<?php echo template_url(); ?>assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
        <script src="<?php echo template_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!--[if lt IE 9]>
        <script src="assets/plugins/excanvas.min.js"></script>
        <script src="assets/plugins/respond.min.js"></script>  
        <![endif]-->   
        <script src="<?php echo template_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo template_url(); ?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
        <script src="<?php echo template_url(); ?>assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo template_url(); ?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo template_url(); ?>assets/plugins/countdown/jquery.countdown.js" type="text/javascript"></script>
        <script src="<?php echo template_url(); ?>assets/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo template_url(); ?>assets/scripts/app.js" type="text/javascript"></script>
        <script src="<?php echo template_url(); ?>assets/scripts/coming-soon.js" type="text/javascript"></script>      
        <!-- END PAGE LEVEL SCRIPTS --> 
        <script>
            jQuery(document).ready(function() {
                var template_url = '<?php echo template_url(); ?>';
                App.init();
                CoomingSoon.init(template_url);
            });
		 
        </script>
        <!-- END JAVASCRIPTS -->
    </body><!-- END BODY -->
</html>