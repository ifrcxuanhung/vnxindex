<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="ie ie6 no-js" dir="ltr" lang="en-US">
<![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7 no-js" dir="ltr" lang="en-US">
<![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8 no-js" dir="ltr" lang="en-US">
<![endif]-->
<!--[if IE 9 ]>
<html class="ie ie9 no-js" dir="ltr" lang="en-US">
<![endif]-->
<!--[if gt IE 9]>
<!-->
<html class="no-js" dir="ltr" lang="en-US">
<!--<![endif]-->
<!-- the "no-js" class is for Modernizr. -->
    <meta charset="UTF-8" />
    <title><?php echo $data['title'] ? $data['title'] : $data['config']['title_website']; ?></title>
    <meta content="<?php echo $data['keywords'] ? $data['keywords'] : $data['config']['meta_key']; ?>" name="keywords"/>
    <meta content="<?php echo $data['description'] ? $data['description'] : $data['config']['meta_des']; ?>" name="description"/>
    <link rel="shortcut icon" href="<?php echo WEBSITE_URL; ?>/templates/images/favicon.ico"/>

    <link rel='stylesheet' id='pe_estro_slider_style-css' href='<?php echo WEBSITE_URL; ?>/templates/css/allskins.min.css' type='text/css' media='all' />
    <link rel='stylesheet' id='default-css' href='<?php echo WEBSITE_URL; ?>/templates/css/style.css' type='text/css' media='all' />
    <link rel='stylesheet' id='skin-css' href='<?php echo WEBSITE_URL; ?>/templates/css/skin.css' type='text/css' media='all' />
    <link rel='stylesheet' id='videojs-css' href='<?php echo WEBSITE_URL; ?>/templates/css/videojs.css' type='text/css' media='all' />
    <link rel='stylesheet' id='supersized-css' href='<?php echo WEBSITE_URL; ?>/templates/css/supersized.css' type='text/css' media='all' />
    <link rel='stylesheet' id='supersized-shutter-css' href='<?php echo WEBSITE_URL; ?>/templates/css/supersized.shutter.css' type='text/css' media='all' />
    
    <script type='text/javascript' src='<?php echo WEBSITE_URL; ?>/templates/js/jquery.js'></script>
    <script type='text/javascript' src='<?php echo WEBSITE_URL; ?>/templates/js/jquery.pixelentity.kenburnsSlider.min.js'></script>
    <script type='text/javascript' src='<?php echo WEBSITE_URL; ?>/templates/js/superfish.js'></script>
    <script type='text/javascript' src='<?php echo WEBSITE_URL; ?>/templates/js/jquery.tools.min.js'></script>
    <script type='text/javascript' src='<?php echo WEBSITE_URL; ?>/templates/js/jquery.prettyPhoto.js'></script>
    <script type='text/javascript' src='<?php echo WEBSITE_URL; ?>/templates/js/video.js'></script>
    <script type='text/javascript' src='<?php echo WEBSITE_URL; ?>/templates/js/jquery.sudoSlider.min.js'></script>
    <script type='text/javascript' src='<?php echo WEBSITE_URL; ?>/templates/js/jquery.functions.js'></script>
    <script type='text/javascript' src='<?php echo WEBSITE_URL; ?>/templates/js/jquery.nivo.slider.pack.js'></script>
    <script type='text/javascript' src='<?php echo WEBSITE_URL; ?>/templates/js/nivo-init.js'></script>
    <script type='text/javascript' src='<?php echo WEBSITE_URL; ?>/templates/js/comment-reply.js'></script>
    <script type='text/javascript' src='<?php echo WEBSITE_URL; ?>/templates/js/jquery.tweet.js'></script>
    <script type='text/javascript' src='<?php echo WEBSITE_URL; ?>/templates/js/jquery.slides.min.js'></script>
    
    <!-- bookmark scroll -->
    <script type='text/javascript' src='<?php echo WEBSITE_URL; ?>/templates/js/bookmarkscroll.js'></script>
    
    <script type='text/javascript' src='<?php echo WEBSITE_URL; ?>/templates/js/cufon-yui.js'></script>
    <script type='text/javascript' src='<?php echo WEBSITE_URL; ?>/templates/js/Myriad_Pro_700.font.js'></script>
        
    <!-- top page -->
	<script type='text/javascript' src='<?php echo WEBSITE_URL; ?>/templates/js/custom.js'></script>
	
	<style type="text/css">
        .recentcomments a {
            display:inline !important;
            padding:0 !important;
            margin:0 !important;
        }
    </style>

    <!--[if lt IE 9]>
        <script type="text/javascript" src="js/html5.js"></script>
    <![endif]-->
    <script type='text/javascript'>
        Cufon.replace('#primary-navigation > ul > li > a', {
           // fontFamily: "DINpro Bold, Myriad Pro"
        }); // Works without a selector engine
        Cufon.replace('h1, h2, h3, h4', {
        //    fontFamily: "DINpro Cond"
        }); // Works without a selector engine
		
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            var sudoSlider = jQuery("#sudoslider").sudoSlider({
                vertical: true,
                continuous: true,
                controlsAttr: 'id="posts_slider_controls"'
            });
        });
    </script>
    <!--link id="democss" rel="stylesheet" href="templates/css/dark.css" type="text/css" media="screen" /-->
    <!--script type="text/javascript" src="js/demo.js"></script-->
    <link rel="stylesheet" href="<?php echo WEBSITE_URL; ?>/templates/css/demo.css" type="text/css" media="screen" />
    <!--link rel="stylesheet" href="templates/css/colorpicker.css" type="text/css" media="screen" /-->
    </head>
<body class="home page page-id-246 page-template-default">
    <p id="back-top">
		<a href="#top">Back to Top</a>
	</p>
	<div class="topbar">
        <div></div>
    </div>
    <div class="page_bg"></div>
    <div class="wrapper hfeed">
        <header id="header">
            <div class="logo">
                <a href="<?php echo WEBSITE_URL; ?>" title="<?php echo $data['config']['title_website']; ?>">
                    <img src="<?php echo $data['config']['logo_website']; ?>" alt="<?php echo $data['config']['title_website']; ?>" />
                </a>
            </div>
            <!--div class="sologant_com"><h1 title="Business"><span class="orange_cl"></span><span class="orange_cl"></span><span class="orange_cl"></span><span class="orange_cl"></span></h1></div-->
            <div class="site-navigation">
                <div class="lang_top">
                    <a href="<?php echo WEBSITE_URL; ?>?lang=fr">
                        <img src="<?php echo WEBSITE_URL; ?>/templates/images/flag_france.png">
                    </a>
                    <a href="<?php echo WEBSITE_URL; ?>?lang=en">
                        <img src="<?php echo WEBSITE_URL; ?>/templates/images/flag_en.png">
                    </a>
                    <a href="<?php echo WEBSITE_URL; ?>?lang=vn">
                        <img src="<?php echo WEBSITE_URL; ?>/templates/images/flag-vn.png">
                    </a>
                </div>
                <ul class="alignright">
                    <li>
                        <a href="<?php echo WEBSITE_URL; ?>" class="icon-home">Business</a>
                    </li>
                    <li>
                        <span class="icon-search"></span>
                    </li>
                </ul>
                <div class="clear"></div>
               <form method="get" action="<?php echo WEBSITE_URL ?>/search/search.php" id="searchform">
                   <input type="text" id="s" name="query" value="<?php echo html_entity_decode($data['mtran']->get_translates('Keyword')); ?>" />
                   <button type="submit" id="search-submit" class="search_submit" value="Search" title="Search"><?php echo $data['mtran']->get_translates('Search'); ?></button>
                </form>
            </div>
            <div class="clear"></div>
            <div class="menuBg_wrapper">
                <nav id="primary-navigation" role="navigation">
                    <ul id="menu-primary-nav" class="sf-menu">
                        <?php showBlock('menutop'); ?>
                    </ul>
                    <div class="clear"></div>
                </nav>
            </div>
        </header>