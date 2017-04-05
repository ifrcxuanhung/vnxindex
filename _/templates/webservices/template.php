<!doctype html>
<!--[if lt IE 8 ]><html lang="en" class="no-js ie ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie"><![endif]-->
<!--[if (gt IE 8)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
    <head>
        <title>
            <?php
            trans('title_uel');
            echo ($this->router->fetch_class()) != '' ? ucwords($this->router->fetch_class()) : '';
            ?>
        </title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo template_url(); ?>favicon.ico">
        <meta charset="utf-8" />
        <link href="<?php echo template_url(); ?>css/compress.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo template_url(); ?>css/style.css" rel="stylesheet" type="text/css" />
        <link href='<?php echo base_url(); ?>assets/bundles/jqGrid/css/ui.jqgrid.css' rel='stylesheet' type='text/css' media='screen' />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/bundles/jqGrid/plugins/ui.multiselect.css" />
        <script src="<?php echo template_url(); ?>js/libs/modernizr.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/bundles/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/bundles/jquery.livequery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/templates/backend/js/ZeroClipboard.min.js"></script>
        <script>
            var $template_url='<?php echo template_url(); ?>';
            var $base_url='<?php echo base_url(); ?>';
            var $admin_url='<?php echo admin_url(); ?>';

            var $app={'module':'<?php echo $this->router->fetch_module(); ?>',
                'controller':'<?php echo $this->router->fetch_class(); ?>',
                'action':'<?php echo $this->router->fetch_method(); ?>'};
        </script>

    </head>
    <body style="background: none;">
        <!-- The template uses conditional comments to add wrappers div for ie8 and ie7 - just add .ie or .ie7 prefix to your css selectors when needed -->
        <!--[if lt IE 9]><div class="ie"><![endif]-->
        <!--[if lt IE 8]><div class="ie7"><![endif]-->
        <!-- Header -->
        <!-- Server status -->
        <header id="myTop">
            <div class="container_12">

            </div>
            <h1 id="slogan">
                VFDB - WEB SERVICES
            </h1>
        </header>
        <!-- End server status -->
        <!-- Main nav -->
        <nav style="height:90px;"></nav>
        <!-- end menu -->
        <!-- Status bar -->
        <div id="status-bar">
            <div class="container_12">
                
            </div>
        </div>
        <!-- End status bar -->
        <div id="header-shadow"></div>
        <!-- End header -->
        <!-- Always visible control bar -->
        <!-- End control bar -->
        <!-- Content -->
        <!--[if lt IE 8]></div><![endif]-->
        <!--[if lt IE 9]></div><![endif]-->

        <!-- Always visible control bar -->
        <!-- End control bar -->

        <article class="container_12 main-container">
            <?php echo $content ?>
            <div class="clear"></div>
        </article>
        <footer>
            <div class="float-left">

            </div>
            <div class="float-right">

            </div>
        </footer>
        <div id="lean_overlay">
            <section class="grid_12" id="calculatingBlock">
                <span>
                    <center>
                        <?php trans('calculating'); ?><br><img width="100" src="<?php echo template_url(); ?>images/preloader.gif">
                    </center>
                </span>
            </section>
        </div>
        <!-- load javascript -->
        <!-- Generic libs -->
        <script src="<?php echo template_url(); ?>js/old-browsers.js"></script>
        <!-- remove if you do not need older browsers detection -->
        <script src="<?php echo template_url(); ?>js/libs/jquery.hashchange.js"></script>
        <!-- Template libs -->
        <script src="<?php echo template_url(); ?>js/jquery.accessibleList.js"></script>
        <script src="<?php echo template_url(); ?>js/searchField.js"></script>
        <script src="<?php echo template_url(); ?>js/common.js"></script>
        <script src="<?php echo template_url(); ?>js/standard.js"></script>
        <!--[if lte IE 8]><script src="js/standard.ie.js"></script><![endif]-->
        <script src="<?php echo template_url(); ?>js/jquery.tip.js"></script>
        <script src="<?php echo template_url(); ?>js/jquery.contextMenu.js"></script>
        <script src="<?php echo template_url(); ?>js/jquery.modal.js"></script>
        <!-- Custom styles lib -->
        <script src="<?php echo template_url(); ?>js/list.js"></script>
        <!-- Plugins -->
        <script src="<?php echo template_url(); ?>js/libs/jquery.dataTables.min.js"></script>
        <script src="<?php echo template_url(); ?>js/libs/dataTables.formattedNum.js"></script>
        <script src="<?php echo template_url(); ?>js/libs/dataTables.fnSetFilteringPressEnter.js"></script>
        <script src="<?php echo template_url(); ?>js/libs/jquery.datepick/jquery.datepick.min.js"></script>
        <script src="<?php echo template_url(); ?>js/mootools-core.js"></script>
        <script src="<?php echo template_url(); ?>js/menu.gkmenu.js"></script>
        <script src="<?php echo template_url(); ?>js/jquery.dataTables.columnFilter.js"></script>
        <script src="<?php echo base_url(); ?>assets/bundles/jquery-ui/jquery-ui-1.8.22.custom.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bundles/jquery-ui/css/jquery-ui-1.8.1.custom.css" />
        <script src="<?php echo base_url(); ?>assets/bundles/jquery.mousewheel-3.0.6.pack.js" ></script>
        <script src="<?php echo base_url(); ?>assets/bundles/fancyBox/jquery.fancybox.pack.js" ></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bundles/fancyBox/jquery.fancybox.css" />
        <script src="<?php echo base_url(); ?>assets/bundles/sisyphus.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/bundles/jqGrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
        <script src='<?php echo base_url(); ?>assets/bundles/jqGrid/js/jquery.jqGrid.min.js' type="text/javascript"></script>
        <script data-main="<?php echo base_url(); ?>assets/apps/backend/main" src="<?php echo base_url(); ?>assets/bundles/require.js"></script>
        <script>
            function showHidden(div1, div2){
                $(div1).focus(function(){
                    $(div2).slideDown();
                });}
        </script>
    </body>
</html>