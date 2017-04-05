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
    <head style="content=text/html; charset=utf-8">
        <meta charset="UTF-8" />
        <title>
            <?php
            echo $config['title_website'];
            echo ($this->router->fetch_class()) != '' ? ' | ' . ucwords($this->router->fetch_class()) : '';
            echo (isset($title) && $title != '') ? (' | ' . $title) : '';
            ?>
        </title>
        <meta content="<?php echo (isset($keywords) && $keywords != '') ? $keywords : $setting['meta_keys']; ?>" name="keywords"/>
        <meta content="<?php echo (isset($description) && $description != '') ? $description : $setting['meta_des']; ?>" name="description"/>
        <link rel="shortcut icon" href="<?php echo base_url() . 'assets/upload/Config/favicon-ifrc.png' ?>" />
        <link rel='stylesheet' id='pe_estro_slider_style-css' href='<?php echo template_url(); ?>css/allskins.min.css' type='text/css' media='all' />

        <link rel='stylesheet' id='default-css' href='<?php echo template_url(); ?>css/style-index.css' type='text/css' media='all' />
        <link rel='stylesheet' id='default-css' href='<?php echo template_url(); ?>css/style.css' type='text/css' media='all' />
        <link rel='stylesheet' id='skin-css' href='<?php echo template_url(); ?>css/skin.css' type='text/css' media='all' />
        <link rel='stylesheet' id='videojs-css' href='<?php echo template_url(); ?>css/videojs.css' type='text/css' media='all' />
        <link rel='stylesheet' id='supersized-css' href='<?php echo template_url(); ?>css/supersized.css' type='text/css' media='all' />
        <link rel='stylesheet' id='supersized-shutter-css' href='<?php echo template_url(); ?>css/supersized.shutter.css' type='text/css' media='all' />

        <link rel='stylesheet' href='<?php echo template_url(); ?>css/flexigrid.css' type='text/css' media='all' />

        <!--css JQGRID-->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $template_url; ?>global/test/css/jquery-ui.css" />
        <!-- The link to the CSS that the grid needs -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $template_url; ?>global/test/css/ui.jqgrid.css" />
        <!--end css JQGRID-->
        
        <link rel='stylesheet' href='<?php echo template_url(); ?>css/jquery.mCustomScrollbar.css' type='text/css' media='all' />
        




        <script type='text/javascript' src='<?php echo base_url(); ?>assets/bundles/jquery-1.7.2.min.js'></script>
        <script type='text/javascript' src='<?php echo template_url(); ?>js/jquery.pixelentity.kenburnsSlider.min.js'></script>
        <script type='text/javascript' src='<?php echo template_url(); ?>js/superfish.js'></script>
        <script type='text/javascript' src='<?php echo template_url(); ?>js/jquery.tools.min.js'></script>
        <script type='text/javascript' src='<?php echo template_url(); ?>js/jquery.prettyPhoto.js'></script>
        <script type='text/javascript' src='<?php echo template_url(); ?>js/video.js'></script>
        <script type='text/javascript' src='<?php echo template_url(); ?>js/jquery.sudoSlider.min.js'></script>
        <script type='text/javascript' src='<?php echo template_url(); ?>js/jquery.functions.js'></script>
        <script type='text/javascript' src='<?php echo template_url(); ?>js/jquery.nivo.slider.pack.js'></script>
        <script type='text/javascript' src='<?php echo template_url(); ?>js/comment-reply.js'></script>
        <script type='text/javascript' src='<?php echo template_url(); ?>js/jquery.tweet.js'></script>
        <script type='text/javascript' src='<?php echo template_url(); ?>js/jquery.slides.min.js'></script>



        
        <script type='text/javascript' src='<?php echo template_url(); ?>js/jquery.mCustomScrollbar.js'></script>
        

        <!-- bookmark scroll -->
        <script type='text/javascript' src='<?php echo template_url(); ?>js/bookmarkscroll.js'></script>

        <script type='text/javascript' src='<?php echo template_url(); ?>js/cufon-yui.js'></script>
        <script type='text/javascript' src='<?php echo template_url(); ?>js/Myriad_Pro_700.font.js'></script>
        <!-- highcharts -->
        <script src="<?php echo template_url(); ?>js/highstock.js" type="text/javascript"></script>        
        <script src="<?php echo template_url(); ?>js/exporting.js"></script>




        <!-- top page -->
        <script type='text/javascript' src='<?php echo template_url(); ?>js/custom.js'></script>
        <script>
            var $template_url = '<?php echo template_url(); ?>';
            var $base_url = '<?php echo base_url(); ?>';
            var $admin_url = '<?php echo admin_url(); ?>';
            var $userid = '<?php echo!empty($account) ? $account->user_id : ''; ?>';
            var $lang = "<?php echo $curent_language['code']; ?>";

            var $app = {'module': '<?php echo $this->router->fetch_module(); ?>',
                'controller': '<?php echo $this->router->fetch_class(); ?>',
                'action': '<?php echo $this->router->fetch_method(); ?>'};

            var $device = "<?php echo strtolower($this->agent->mobile()); ?>";
        </script>

        <!--ifrc-index-->
        <script type='text/javascript' src='<?php echo template_url(); ?>js/general.js'></script>
        <script type='text/javascript' src='<?php echo template_url(); ?>js/flexigrid.js'></script>

        <!-- script ticker -->
        <link href="<?php echo template_url(); ?>css/modern-ticker.css" type="text/css" rel="stylesheet">
        <script src="<?php echo template_url(); ?>js/jquery.modern-ticker.min.js" type="text/javascript"></script>
        <script type="text/javascript">

            $(function() {

                $(".ticker1").modernTicker({
                    effect: "scroll",
                    scrollInterval: 10,
                    transitionTime: 5000,
                    autoplay: true
                });
            });

        </script>
        <style type="text/css">
            .recentcomments a {
                display:inline !important;
                padding:0 !important;
                margin:0 !important;
            }
            .ui-dialog, .ui-dialog,.ui-widget, .ui-widget-content, .ui-corner-all, .ui-draggable, .ui-resizable {background:#24282B !important}​
            .ui-widget-content a{color:#fff !important;}
        </style>
        <script type="text/javascript" src="<?php echo template_url(); ?>js/html5.js"></script>
        <!--[if lt IE 9]>
            <script type="text/javascript" src="<?php echo template_url(); ?>js/html5.js"></script>
        <![endif]-->
        <script type='text/javascript'>
            Cufon.replace('#primary-navigation > ul > li > a', {
                // fontFamily: "DINpro Bold, Myriad Pro"
            }); // Works without a selector engine
            Cufon.replace('h1, h2, h3', {
                fontFamily: "Myriad Pro"
            }); // Works without a selector engine

        </script>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                var sudoSlider = jQuery("#sudoslider").sudoSlider({
                    vertical: true,
                    continuous: true,
                    controlsAttr: 'id="posts_slider_controls"'
                });

                $('.mt-news ul li:first').attr('style', 'padding-left: 750px; color: #f49a24;');
            });
        </script>
        <!--link id="democss" rel="stylesheet" href="templates/css/dark.css" type="text/css" media="screen" /-->
        <!--script type="text/javascript" src="js/demo.js"></script-->
        <link rel="stylesheet" href="<?php echo template_url(); ?>css/demo.css" type="text/css" media="screen" />
        <!--link rel="stylesheet" href="templates/css/colorpicker.css" type="text/css" media="screen" /-->

    </head>

    <body class="home page page-id-246 page-template-default" onload="$('#body').show();">
        <noscript>          
        <meta http-equiv="refresh" content="0;URL=secure/is_js" />
        </noscript>
        <div id="body" class="main-container" style="display: none">
            <p id="back-top">
                <a href="#top"><?php trans('back_to_top'); ?></a>
            </p>
            <div class="topbar">
                <div></div>
            </div>
            <div class="page_bg"></div>
            <div class="wrapper hfeed">
            <?php
                //Kiem tra là controller pdf thì không hiển thị slide
                if($this->router->fetch_class() != 'pdf')
                {
             ?>
                <header id="header">
                    <div class="logo">
                        <a href="<?php echo base_url(); ?>" title="<?php echo $config['title_website']; ?>">
                            <img src="<?php echo base_url() . 'assets/upload/Config/' . $config['logo_website']; ?>" alt="<?php echo $config['title_website']; ?>" />
                        </a>
                    </div>
                  
                    <!--<div style="float: left;background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #f23e3e 0%, #790000 100%) repeat scroll 0 0;
						border: 1px solid #333;border-radius: 5px;text-align: center; margin-top: 10.7%; margin-left: 5px;height: 20px;" class="logo"> 
                        <a href="<?php echo base_url(); ?>report_daily"  target="_blank" style="color: white !important;">Daily Indexes Report</a>
                    </div>-->
                    
                    <!--
                    <div class="social_links">
                    <?php if ($config['facebook'] != '') { ?><a class="facebook" href="<?php echo $config['facebook']; ?>" target="_blank">Facebook</a><?php } ?>                               
                    <?php if ($config['linkedin'] != '') { ?><a class="linkedin" href="<?php echo $config['linkedin']; ?>" target="_blank">LinkedIn</a><?php } ?>
                    <?php if ($config['twitter'] != '') { ?><a class="twitter" href="<?php echo $config['twitter']; ?>" target="_blank">Twitter</a><?php } ?>
                    </div>
                    -->
                    <?php
                        if(@$setting['PVN'] == 1)
                        {
                    ?>
                    <!--<div class="logo-partners">
                        <a href="" title="">
                            <img src="<?php echo base_url() . 'assets/upload/Config/logo-partners.png'; ?>" alt="PETRO VIETNAM" />
                        </a>
                    </div>-->
                    <?php } ?>
                    <div class="site-navigation">
                        <div class="lang_top" style="z-index: 1">
                            <?php if (isset($list_language) && is_array($list_language)) { ?>
                                <div class="server-info list-language">
                                    <ul>
                                        <?php
                                        //array_pop($list_language);
                                        foreach ($list_language as $value) {
                                            ?>
                                            <li style="margin-left: 5px" class="<?php echo $curent_language['code'] == $value['code'] ? 'active' : '' ?>">
                                                <a href="javascript: void(0);" langcode="<?php echo $value['code']; ?>">
                                                    <img <?php echo $curent_language['code'] == $value['code'] ? 'style="opacity: 0.5;"' : '' ?> src="<?php echo base_url() ?>assets/templates/backend/images/icons/flags/<?php echo $value['code']; ?>.png" width="20" height="15" alt="<?php echo $value['name']; ?>" title="<?php echo $value['name']; ?>">
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php } ?>
                        </div>
                        <ul class="alignright">
                            <li>
                                <a class="icon-sitemap" href="<?php echo base_url(); ?>contact"><?php trans('contact'); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>" class="icon-home"><?php trans('business'); ?></a>
                            </li>
                            <li>
                                <span class="icon-search"></span>
                            </li>
                        </ul>
                        <div class="clear"></div>
                        <form method="get" action="<?php echo base_url(); ?>search/index" id="searchform">
                            <input type="text" id="s" name="query" value="<?php trans('keyword'); ?>" />
                            <button type="submit" id="search-submit" class="search_submit" value="Search" title="<?php trans('search'); ?>"><?php trans('search'); ?></button>
                        </form>
                    </div>
                    <div style="width: 48%; float: left;">
                        <div class="account" style="width: 100%; height: 10%; text-align: right;;">
                            <div id="account-dialog" style="width: 100%;display:none; text-align: right;"></div>
                            <?php
                            if (empty($account)) {
                                ?>
                                <a action="login" href="javascript:void(0)" style="text-align: right;"><?php
                                    trans('Login');
                                    echo '</a> | <a action="register" href="javascript:void(0)">';
                                    trans('Register');
                                    echo '</a> | <a action="private" style="opacity: 0.5;" >';
                                    trans('private_access');
                                    ?></a>
                                <?php
                            } else {
                                ?>
                                <a action="account-info" href="javascript:void(0)"style="text-align: right;"><?php echo $account->email; ?></a>
                                <ul id="account-manager" style="float: right;text-align: right;">
                                    <li style="text-align: right;">
                                        
                                        <ul>
                                            <li><a action="change-pass" href="javascript:void(0)"><?php trans('change_password'); ?></a></li>
                                            <li><a action="update-info" href="javascript:void(0)"><?php trans('update_information'); ?></a></li>
                                        </ul>
                                    </li>
                                </ul>
                                &nbsp;&nbsp;|&nbsp;&nbsp;<a action="logout" href="<?php echo base_url(); ?>auth/vfdb_auth/logout"><?php trans('Logout'); ?></a>
                                &nbsp;&nbsp;|&nbsp;&nbsp;<a action="private" href="<?php echo base_url(); ?>backend/home"><?php trans('private_access'); ?></a>
                                <?php
                            }
                            ?>
    						<div class="clear" style="padding-bottom: 30px;"></div>
                        </div>
                        <!--<div style="width: 100%;text-align: left;">
                            <div  style="float: left;margin-top: 7.7%; margin-left: 5px;height: 20px;"> 
                                    <h5><?php trans('indexes_report');?>:</h5>
                            </div>
                            <div  style="float: left;margin-top: 7.7%; margin-left: 5px;height: 20px;"> 
                                <a href="<?php echo base_url(); ?>report_daily"  target="_blank">
                                    <span class="label label-sm label-danger"><?php trans('daily');?></span>
                                </a>
                            </div>
                            <div  style="float: left;margin-top: 7.7%; margin-left: 5px;height: 20px;"> 
                                <a href="<?php echo base_url(); ?>report_monthly"  target="_blank">
                                    <span class="label label-sm label-danger"><?php trans('monthly');?></span>
                                </a>
                            </div> 
                            <div  style="float: left;margin-top: 7.7%; margin-left: 5px;height: 20px;"> 
                                    <h5><?php trans('market_report');?> :</h5>
                            </div> 
                            <div  style="float: left;margin-top: 7.7%; margin-left: 5px;height: 20px;"> 
                                <a href="<?php echo base_url(); ?>report_market_day"  target="_blank">
                                    <span class="label label-sm label-danger"><?php trans('daily');?></span>
                                </a>
                            </div>                      
                        </div>-->
                    </div>
                    <div class="clear"></div>
                    <div class="menuBg_wrapper">
                        <nav id="primary-navigation" role="navigation">
                            <ul id="menu-primary-nav" class="sf-menu">
                                <?php echo $menutop; ?>
                            </ul>
                            <div class="clear"></div>
                        </nav>
                    </div>
                </header>
                
                

                 <?php  if($this->router->fetch_class() == 'home' ){ ?>
                <script type='text/javascript' src='<?php echo template_url(); ?>js/nivo-init.js'></script>
                <section id="branding" role="banner">
                    <div class="branding-wrapper">
                        <div id="nivoSlider" class="nivoSlider" style="height:466px">
                            <?php
                            if ($bannertop['curent']) {
                                foreach ($bannertop['curent'] as $key => $value) {
                                    ?><img alt="" src="<?php echo image_thumb($value['image'], 466, 1272); ?>" title="" />
                                    <?php
                                }
                            }
                            ?></div>
                        <div class="script_index_slide">
                            <div class="ticker1 modern-ticker mt-round">
                                <div class="mt-news">
                                    <ul>
                                    
                                     <?php
									//echo "<pre>";print_r($tickers);exit; 
                                        if (!empty($tickers)) {
                                            $string = 'Top Ten 2017 Performers - Date : ';
                                            $str = '';
                                            foreach ($tickers1 as $ticker) {
                                                $date = $ticker['date'];
                                                if ($ticker['varyear'] > 0)
                                                    $str .= '<li><a href="#" target="_self" class="up_idx"> ' . $ticker['idx_name_sn'] . '<b class="up_cl"> +' . number_format($ticker['varyear']*100, 2) . '% </b></a></li>';
                                                else
                                                    $str .= '<li><a href="#" target="_self" class="down_ind"> ' . $ticker['idx_name_sn'] . ' <b class="down_cl"> ' . number_format($ticker['varyear']*100, 2) . '% </b></a></li>';
                                            }
                                            echo '<li>' . $string . $date . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li> ' . $str;
                                        }
                                        ?>
                                        <?php
                                        echo '<li>'.str_repeat('&nbsp;',210).'</li> ';
                                        if (!empty($tickers)) {
                                            $string = 'VNX & PVN Indexes - Date : ';
                                            $str = '';
                                            foreach ($tickers as $ticker) {
                                                $date = $ticker['date'];
                                                if ($ticker['idx_var'] > 0)
                                                    $str .= '<li><a href="#" target="_self" class="up_idx"> ' . $ticker['idx_name'] . ' <b class="cl_idx"> ' . number_format($ticker['idx_last'], 2) . ' </b> <b class="up_cl"> +' . number_format($ticker['idx_var']*100, 2) . '% </b></a></li>';
                                                else
                                                    $str .= '<li><a href="#" target="_self" class="down_ind"> ' . $ticker['idx_name'] . ' <b class="cl_idx"> ' . number_format($ticker['idx_last'], 2) . ' </b> <b class="down_cl"> ' . number_format($ticker['idx_var']*100, 2) . '% </b></a></li>';
                                            }
                                            echo '<li>' . $string . $date . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li> ' . $str;
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
                
                <script type="text/javascript">
                    var sliderOptions = [];
                    sliderOptions['effect'] = 'random';
                    sliderOptions['slices'] = '10';
                    sliderOptions['boxCols'] = '8';
                    sliderOptions['boxRows'] = '4';
                    sliderOptions['animSpeed'] = '500';
                    sliderOptions['pauseTime'] = '10000';
                    sliderOptions['directionNav'] = true;
                    sliderOptions['directionNavHide'] = true;
                    sliderOptions['controlNav'] = true;
                    sliderOptions['keyboardNav'] = true;
                    sliderOptions['pauseOnHover'] = true;
                    sliderOptions['manualAdvance'] = false;
                    sliderOptions['captions'] = true;
                    sliderOptions['captionOpacity'] = '0.5';
                    sliderOptions['stopAtEnd'] = false;
                </script>
                <?php } ?>
                <?php } ?>
                
                <!--begin-->
                
    
    <!--end container-->
				<!--end-->                
                
                <?php echo $bottomslider; ?>
                
                
                
                <div class="right-sidebar" role="main" id="content">
                    <?php echo $content; ?>
                </div>


            </div>
            <?php
                //Kiem tra là controller pdf thì không hiển thị slide
                if($this->router->fetch_class() != 'pdf')
                {
            ?>
            <footer id="footer">
                <div class="wrapper">
                    <div class="footer-nav-wrapper">
                        <div class="fnwl1"></div>
                        <div class="fnwc1">
                            <nav>
                                <ul id="menu-footer-nav" class="menu">
                                    <?php
                                    $count = 0;
                                    if ($botmenu['curent']) {
                                        foreach ($botmenu['curent'] as $key => $value) {
                                            ?>
                                            <?php if ($count == 0) {
                                                ?>
                                                <li id="menu-item-<?php echo $value['menu_id'] ?>" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-246 current_page_item menu-item-<?php echo $value['menu_id'] ?>">
                                                    <a href="<?php echo base_url() . $value['link']; ?>"><?php echo $value['name']; ?></a>
                                                </li>
                                                <?php
                                            } else {
                                                ?>
                                                <li id="menu-item-<?php echo $value['menu_id'] ?>" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-<?php echo $value['menu_id'] ?>">
                                                    <a href="<?php echo base_url() . $value['link']; ?>"><?php echo $value['name']; ?></a>
                                                </li>
                                                <?php
                                            }
                                            $count++;
                                        }
                                    }
                                    ?>
                                </ul>

                            </nav>
                        </div>
                        <div class="fnwr1"></div>
                    </div>
                    <div class="clear"></div>
                    <div class="footer-content">
                        <?php
 
                        if ($list['curent']) {
                            $count = 0;
                            foreach ($list['curent'] as $key => $value) {
                                $count++;
                                $string = explode("<hr />", $value['description']);
                                if ($count == 2) {
                                    ?> 
                                    <div class="one_third last">
                                        <div id="text-2" class="widget widget_text_last">
                                            <a href="<?php echo base_url(); ?>article/index/<?php echo $value['category_code'] . '/' . strtolower(utf8_convert_url($value['title'], '-')); ?>.html" rel="bookmark"><h3><?php echo $value['title']; ?></h3></a>
                                            <div class="pic_log_bot_art">
                                                <a class="thumbnail" href="<?php echo base_url(); ?>article/index/<?php echo $value['category_code'] . '/' . strtolower(utf8_convert_url($value['title'], '-')); ?>.html" rel="bookmark" title="<?php echo $value['title']; ?>">
                                                    <img src="<?php echo image_thumb($value['image'], 65, 65); ?>" class="attachment-65x65 wp-post-image" alt="<?php echo $value['title']; ?>" title="<?php echo $value['title']; ?>" />
                                                </a>
                                            </div>
                                            <div class="post_extra_info fx_cl_title_right">
                                                <?php echo $string[0]; ?>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="one_third">
                                        <div id="text-2" class="widget widget_text">
                                            <a href="<?php echo base_url(); ?>article/index/<?php echo $value['category_code'] . '/' . strtolower(utf8_convert_url($value['title'], '-')); ?>.html" rel="bookmark"><h3><?php echo $value['title']; ?></h3></a>
                                            <div class="pic_log_bot_art">
                                                <a class="thumbnail" href="<?php echo base_url(); ?>article/index/<?php echo $value['category_code'] . '/' . strtolower(utf8_convert_url($value['title'], '-')); ?>.html" rel="bookmark" title="<?php echo $value['title']; ?>">
                                                    <img src="<?php echo image_thumb($value['image'], 65, 65); ?>" class="attachment-65x65 wp-post-image" alt="<?php echo $value['title']; ?>" title="<?php echo $value['title']; ?>" />
                                                </a>
                                            </div>
                                            <div class="post_extra_info fx_cl_title_right">
                                                <?php echo $string[0]; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        ?>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="copyright">
                    <div class="wrapper">
                        <div class="copy-left">All rights reserved. Copyright © 2013</div>
                        <div class="copy-right">
                            <a href="http://ifrc.fr">www.ifrc.fr</a>
                        </div>
                    </div>
                </div>
            </footer>
            <?php } ?>
            <script type='text/javascript'>
                Cufon.now();
            </script>
            <script type='text/javascript'>
                jQuery('.lang_top').css('position', 'absolute');
                var _gaq = _gaq || [];
                _gaq.push(['_setAccount', 'UA-34019004-1']);
                _gaq.push(['_setDomainName', 'ifrc.fr']);
                _gaq.push(['_setAllowLinker', true]);
                _gaq.push(['_trackPageview']);

                (function() {
                    var ga = document.createElement('script');
                    ga.type = 'text/javascript';
                    ga.async = true;
                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(ga, s);
                })();
            </script>
            <!-- load javascript -->
            <!-- Generic libs -->
            <script src="<?php echo template_url(); ?>js/old-browsers.js"></script>
            <!-- remove if you do not need older browsers detection -->
            <script src="<?php echo template_url(); ?>js/libs/jquery.hashchange.js"></script>
            <!-- Template libs -->
            <script src="<?php echo template_url(); ?>js/jquery.accessibleList.js"></script>
            <script src="<?php echo template_url(); ?>js/searchField.js"></script>
            <script src="<?php echo template_url(); ?>js/common.js"></script>
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
            <script src="<?php echo template_url(); ?>js/jquery.dataTables.columnFilter.js"></script>
            <script src="<?php echo base_url(); ?>assets/bundles/jquery-ui/jquery-ui-1.8.22.custom.min.js"></script>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bundles/jquery-ui/css/custom-theme/jquery-ui-1.10.2.custom.css" />
            <script src="<?php echo base_url(); ?>assets/bundles/jquery.mousewheel-3.0.6.pack.js" ></script>
            <script src="<?php echo base_url(); ?>assets/bundles/fancyBox/jquery.fancybox.pack.js" ></script>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bundles/fancyBox/jquery.fancybox.css" />
            <script src="<?php echo base_url(); ?>assets/bundles/sisyphus.min.js" type="text/javascript"></script>
<!--            <script src="--><?php //echo base_url(); ?><!--assets/bundles/jqGrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>-->
<!--            <script src='--><?php //echo base_url(); ?><!--assets/bundles/jqGrid/js/jquery.jqGrid.min.js' type="text/javascript"></script>-->

            <!--js JQGRID-->
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/templates/welcome/global/test/src/i18n/grid.locale-en.js"></script>
            <!-- This is the Javascript file of jqGrid -->
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/templates/welcome/global/test/js/jquery.jqGrid.min.js"></script>
            <!--end js JQGRID-->

            <script data-main="<?php echo base_url(); ?>assets/apps/welcome/main" src="<?php echo base_url(); ?>assets/bundles/require.js"></script>
            
          



            <script>
                function showHidden(div1, div2) {
                    $(div1).focus(function() {
                        $(div2).slideDown();
                    });
                }

                $(document).ready(function() {
                    setInterval(function() {
                        $('#slides_381 .slides_nav a[class="next"]').click();
                    }, 5000);
                });
            </script>
            <script src="<?php echo template_url(); ?>jquery-ui/jquery-ui-1.8.13.custom.min.js"></script>
            <link rel="stylesheet" type="text/css" href="<?php echo template_url(); ?>jquery-ui/ui-lightness/jquery-ui-1.8.13.custom.css" />
        </div>
        <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-45691744-17', 'vnxindex.com');
      ga('send', 'pageview');

    </script>
    <div class="popup"></div>
    <div class="popup-background"></div>
    </body>
</html>