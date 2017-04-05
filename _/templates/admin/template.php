<!doctype html>
<!--[if lt IE 8 ]><html lang="en" class="no-js ie ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie"><![endif]-->
<!--[if (gt IE 8)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
    <head>
        <title>
            <?php
            trans('title_administrator');
            echo ($this->router->fetch_class()) != '' ? ' | ' . ucwords($this->router->fetch_class()) : '';
            ?>
        </title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo template_url(); ?>favicon.ico">
        <meta charset="utf-8" />

        <link href="<?php echo template_url(); ?>css/compress2.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo template_url(); ?>css/style.css" rel="stylesheet" type="text/css" />
        <link href='<?php echo base_url(); ?>assets/bundles/jqGrid-4.5.2/css/ui.jqgrid.css' rel='stylesheet' type='text/css' media='screen' />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/bundles/jqGrid-4.5.2/plugins/ui.multiselect.css" />
        <script src="<?php echo template_url(); ?>js/libs/modernizr.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/bundles/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/bundles/jquery.livequery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/templates/backend/js/ZeroClipboard.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/templates/backend/js/highstocks.js"></script>
        <script>
            var $template_url = '<?php echo template_url(); ?>';
            var $base_url = '<?php echo base_url(); ?>';
            var $admin_url = '<?php echo admin_url(); ?>';
            var $userid = '<?php echo isset($this->ion_auth->user()->row()->user_id) ? $this->ion_auth->user()->row()->user_id : $this->session->userdata('user_id'); ?>';
            var $lang = "<?php echo $curent_language['code']; ?>";

            var $app = {'module': '<?php echo $this->router->fetch_module(); ?>',
                'controller': '<?php echo $this->router->fetch_class(); ?>',
                'action': '<?php echo $this->router->fetch_method(); ?>'};

            var $device = "<?php echo strtolower($this->agent->mobile()); ?>";
        </script>
        <script type="text/javascript"><!--
            /* use php to get the server time */
            var serverdate = new Date();
            var ore = serverdate.getHours();
            var minute = serverdate.getMinutes();
            var secunde = serverdate.getSeconds();

            /* function that process and display data */
            function timer() {
                secunde++;
                if (secunde > 59) {
                    secunde = 0;
                    minute++;
                }
                if (minute > 59) {
                    minute = 0;
                    ore++;
                }
                if (ore > 23) {
                    ore = 0;
                }

                var output = (ore < 10 ? "0" : "") + ore + ":" + (minute < 10 ? "0" : "") + minute + ":" + (secunde < 10 ? "0" : "") + secunde;

                document.getElementById("timer").innerHTML = output;
            }

            /* call the function when page is loaded and then at every second */
            window.onload = function() {
                setInterval("timer()", 1000);
            }
  --></script>

    </head>
    <body style="background: none;">
        <!-- The template uses conditional comments to add wrappers div for ie8 and ie7 - just add .ie or .ie7 prefix to your css selectors when needed -->
        <!--[if lt IE 9]><div class="ie"><![endif]-->
        <!--[if lt IE 8]><div class="ie7"><![endif]-->
        <!-- Header -->
        <!-- Server status -->
        <header id="myTop">
            <div class="container_12">
                <?php if (isset($list_language) && is_array($list_language)) { ?>
                    <div class="server-info list-language">
                        <ul>
                            <?php foreach ($list_language as $value) { ?>
                                <li class="<?php echo $curent_language['code'] == $value['code'] ? 'active' : '' ?>">
                                    <a href="javascript: void(0);" langcode="<?php echo $value['code']; ?>">
                                        <img src="<?php echo template_url() ?>images/icons/flags/<?php echo $value['code']; ?>.png" width="16" height="11" alt="<?php echo $value['name']; ?>" title="<?php echo $value['name']; ?>">
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <div class="server-info">
                    <?php trans('date'); ?> : <span style="color: #FFF"><?php echo date('Y-m-d', strtotime('now')); ?></span>
                    <span id="timer" style="color: #FFF"></span>
                </div>
            </div>
            <h1 id="slogan">
                <?php trans('slogan'); ?>
            </h1>
        </header>
        <!-- End server status -->
        <!-- Main nav -->
        <nav style="height:90px;"></nav>
        <div id="gkMainMenu">
            <div class="gk-menu">
                <?php
                $group_id = $this->ion_auth->get_users_groups($this->ion_auth->user()->row()->user_id)->row()->id;
                ?>
                <ul class="gkmenu level0">
                    <li class="first">
                        <a title="<?php trans('mn_Home'); ?>" href="<?php echo admin_url() . 'home'; ?>" class="first"><span style="height:45px;width:1px;background:none;"></span><img src="<?php echo template_url(); ?>images/home.png" alt="" /><span class="des_menu"><?php trans('mn_Home'); ?></span></a>
                    </li>
                    <?php
                    if (check_service($group_id, $listServicesUser, 'admin')) {
                        ?>
                        <li class="haschild">
                            <a href="#" title="<?php trans('mn_Users'); ?>"><span class="menu-title"></span><img src="<?php echo template_url(); ?>images/user_icon.png" alt="" /><span class="des_menu"><?php trans('mn_Users'); ?></a>
                            <div class="childcontent">
                                <div class="childcontent-inner-wrap normalSubmenu">
                                    <div class="childcontent-inner">
                                        <ul class="gkmenu level1">
                                            <li class="first">
                                                <a href="<?php echo admin_url() . 'users' ?>" class=" first" title="<?php trans('mn_Manage_User'); ?>"><span class="menu-title"><?php trans('mn_Manage_User'); ?></span></a>
                                            </li>
                                            <li>
                                                <a href="<?php echo admin_url() . 'group' ?>" class=" first" title="<?php trans('mn_User_Groups'); ?>"><span class="menu-title"><?php trans('mn_User_Groups'); ?></span></a>
                                            </li>
                                            <li>
                                                <a href="<?php echo admin_url() . 'services' ?>" title="<?php trans('mn_services'); ?>"><span class="menu-title"><?php trans('mn_services'); ?></span></a>
                                            </li>
                                            <li>
                                                <a href="<?php echo admin_url() . 'log' ?>" title="<?php trans('mn_Log'); ?>"><span class="menu-title"><?php trans('mn_Log'); ?></span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="haschild">
                            <a href="#" title="<?php trans('mn_Website'); ?>"><span class="menu-title"></span><img src="<?php echo template_url(); ?>images/websites_icon.png" alt="" /><span class="des_menu"><?php trans('mn_Website'); ?></a>
                            <div class="childcontent">
                                <div class="childcontent-inner-wrap normalSubmenu">
                                    <div class="childcontent-inner">
                                        <ul class="gkmenu level1">
                                            <li class="first haschild">
                                                <a href="<?php echo admin_url() . 'menu' ?>" class=" first" title="<?php trans('mn_Menu'); ?>"><span class="menu-title"><?php trans('mn_Menu'); ?></span></a>
                                            </li>
                                            <li>
                                                <a href="<?php echo admin_url() . 'page' ?>" title="<?php trans('mn_Pages'); ?>"><span class="menu-title"><?php trans('mn_Pages'); ?></span></a>
                                            </li>
                                            <li>
                                                <a href="<?php echo admin_url() . 'category' ?>" title="<?php trans('mn_Categories'); ?>"><span class="menu-title"><?php trans('mn_Categories'); ?></span></a>
                                            </li>
                                            <li>
                                                <a href="<?php echo admin_url() . 'article' ?>" title="<?php trans('mn_Articles'); ?>"><span class="menu-title"><?php trans('mn_Articles'); ?></span></a>
                                            </li>
                                            <li>
                                                <a href="<?php echo admin_url() . 'media' ?>"  title="<?php trans('mn_Media'); ?>"><span class="menu-title"><?php trans('mn_Media'); ?></span></a>
                                            </li>
                                            <li>
                                                <a href="<?php echo admin_url() . 'request' ?>"  title="<?php trans('mn_Request'); ?>"><span class="menu-title"><?php trans('mn_Request'); ?></span></a>
                                            </li>
                                            <li>
                                                <a href="<?php echo admin_url() . 'newsletter' ?>"  title="<?php trans('mn_Newsletter'); ?>"><span class="menu-title"><?php trans('mn_Newsletter'); ?></span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="haschild">
                            <a href="#" title="<?php trans('mn_System'); ?>"><span class="menu-title"></span><img src="<?php echo template_url(); ?>images/system_icon.png" alt="" /><span class="des_menu"><?php trans('mn_System'); ?></a>
                            <div class="childcontent">
                                <div class="childcontent-inner-wrap normalSubmenu">
                                    <div class="childcontent-inner">
                                        <ul class="gkmenu level1">
                                            <li class="first haschild">
                                                <a href="<?php echo admin_url() . 'setting' ?>" class=" first" title="<?php trans('mn_Settings'); ?>"><span class="menu-title"><?php trans('mn_Settings'); ?></span></a>
                                            </li>
                                            <li>
                                                <a href="<?php echo admin_url() . 'language' ?>" title="<?php trans('mn_Languages'); ?>"><span class="menu-title"><?php trans('mn_Languages'); ?></span></a>
                                            </li>
                                            <li>
                                                <a href="<?php echo admin_url() . 'translate' ?>"  title="<?php trans('mn_Translates'); ?>"><span class="menu-title"><?php trans('mn_Translates'); ?></span></a>
                                            </li>
                                            <li>
                                                <a href="<?php echo admin_url() . '#' ?>" title="<?php trans('mn_Backup'); ?>"><span class="menu-title"><?php trans('mn_Backup'); ?></span></a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" onClick="file_manager();" class="first" title="<?php trans('mn_Files'); ?>"><span class="menu-title"><?php trans('mn_Files'); ?></span></a>
                                            </li>
                                            <li class="last">
                                                <a href="<?php echo admin_url(); ?>update_report" class="first" title="<?php trans('mn_Update_report'); ?>"><span class="menu-title"><?php trans('mn_Update_report'); ?></span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php
                    }
                    if (check_service($group_id, $listServicesUser, 'help')) {
                        ?>                            
                        <li class="first">
                            <a href="<?php echo admin_url() . 'help' ?>" class="first" title="<?php trans('mn_Help'); ?>"><span style="height:45px;width:1px;background:none;"></span><img src="<?php echo template_url(); ?>images/help.png" alt="" /><span class="des_menu"><?php trans('mn_Help'); ?></a>
                        </li>
                        <?php
                    }
                    ?>                      
                    <li>
                        <a href="<?= admin_url() ?>vnfdb_demo" class="" title="<?php trans('mn_Demo'); ?>"><span class="menu-title"><?php trans('mn_Demo'); ?></span></a>
                    </li>
                    <li>
                        <a href="<?= admin_url() ?>indexlist" class="" title="<?php trans('index_list'); ?>"><span class="menu-title"><?php trans('index_list'); ?></span></a>
                    </li>
                </ul>

            </div>
        </div>
        <!-- end menu -->
        <!-- Status bar -->
        <div id="status-bar">
            <div class="container_12">
                <ul id="status-infos">
                    <li class="spaced">
                        <?php trans('bt_logged_as'); ?>:
                        <strong>
                            <?php echo isset($this->ion_auth->user()->row()->username) ? ucfirst($this->ion_auth->user()->row()->username) : ''; ?>
                        </strong>
                    </li>
                    <li>
                        <a class="button red" href="<?php echo base_url() . 'auth/logout' ?>">
                            <?php trans('bt_logout'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="button"><strong><?php trans('bt_info'); ?></strong></a>
                        <div id="message-list" class="result-block">
                            <span class="arrow"><span></span></span>
                            <ul class="relative small-files-list icon_info_tabs">
                                <li>
                                    <a href="#"><strong><?php trans('version'); ?>:</strong>
                                        <?php trans('version_value'); ?>
                                        <br>
                                        <small></small>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><strong><?php trans('ip_address'); ?>:</strong>
                                        <?php echo $_SERVER['SERVER_ADDR']; ?>
                                        <br>
                                        <small></small>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <ul id="breadcrumb">
                    <li><a href="#" title="<?php trans('bar_Title'); ?>"><?php trans('bar_Title'); ?></a></li>
                    <?php if ($this->router->fetch_class() != 'admin'): ?>
                        <li><a style="text-transform: capitalize" href="<?php echo admin_url() . $this->router->fetch_class(); ?>" title="<?php trans('mn_' . $this->router->fetch_class()); ?>"><?php trans('mn_' . $this->router->fetch_class()); ?></a></li>
                    <?php endif; ?>
                    <?php if ($this->router->fetch_method() != 'index'): ?>
                        <li><a style="text-transform: capitalize" href="#" title="<?php trans('mn_' . $title); ?>"><?php trans('mn_' . $title); ?></a></li>
                    <?php endif; ?>
                </ul>
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
        <?php echo $bar; ?>
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
                        <?php trans('processing'); ?><br><img width="100" src="<?php echo template_url(); ?>images/preloader.gif">
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
        <script src="<?php echo template_url(); ?>js/libs/dataTables.fnMyFilter.js"></script>
        <script src="<?php echo template_url(); ?>js/libs/dataTables.fnReloadAjax.js"></script>
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
        <script src="<?php echo base_url(); ?>assets/bundles/jqGrid-4.5.2/js/i18n/grid.locale-en.js" type="text/javascript"></script>
        <script src='<?php echo base_url(); ?>assets/bundles/jqGrid-4.5.2/js/jquery.jqGrid.min.js' type="text/javascript"></script>
        <script data-main="<?php echo base_url(); ?>assets/apps/backend/main" src="<?php echo base_url(); ?>assets/bundles/require.js"></script>
        <script>
                                                        function showHidden(div1, div2) {
                                                            $(div1).focus(function() {
                                                                $(div2).slideDown();
                                                            });
                                                        }
        </script>
    </body>
</html>