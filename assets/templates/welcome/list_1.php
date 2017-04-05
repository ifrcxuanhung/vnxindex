<?php
$mtran = new Models_mTranslates();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="<?php echo $data['keywords'] ?>" />
        <meta name="description" content="<?php echo $data['description'] ?>" />
        <title><?php echo $data['title'] ?></title>        
        <link href="<?php echo base_url() ?>css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery-1.4.min.js"></script>
        <!-- banner -->
        <script type="text/javascript" src="<?php echo base_url() ?>js/galleryview/jquery.timers-1.1.2.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/galleryview/jquery.galleryview-2.0-pack.js"></script>
        <script type="text/javascript">
            // initialize slideshow (Gallery View)
            $(document).ready(function() {
                if ($('#GalleryView').length > 0) {
                    $('#GalleryView').galleryView({
                        show_panels: true,
                        show_filmstrip: false,
                        panel_width: 920,
                        panel_height: 289,
                        frame_width: 87,
                        frame_height: 45,
                        frame_gap: 8,
                        pointer_size: 16,
                        pause_on_hover: true,
                        filmstrip_position: 'bottom',
                        overlay_position: 'bottom',
                        nav_theme: 'dark',
                        transition_speed: 800,
                        transition_interval: 4000
                    });
                }
            });
        </script>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/galleryview.min.css" />
        <!-- end banner -->
        <!-- clock -->
        <script type="text/javascript" >
            function date_heure(id)
            {
                date = new Date;
                annee = date.getFullYear();
                moi = date.getMonth();
                mois = new Array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
                jours = new Array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
                j = date.getDate();
                jour = date.getDay();

                h = date.getHours();
                if(h<10)
                {
                    h = "0"+h;
                }
                m = date.getMinutes();
                if(m<10)
                {
                    m = "0"+m;
                }
                s = date.getSeconds();
                if(s<10)
                {
                    s = "0"+s;
                }
                resultat = jours[jour]+' '+j+' '+mois[moi]+' '+annee+' - '+h+':'+m+':'+s;
                document.getElementById(id).innerHTML = resultat;
                setTimeout('date_heure("'+id+'");','1000');
                return true;
            }
        </script>
        <!-- end clock -->

        <!-- Cufon -->

        <script type="text/javascript" src="<?php echo base_url() ?>js/cufon/cufon-yui.js"></script>

        <script type="text/javascript" src="<?php echo base_url() ?>js/cufon/Futura_BdCn_BT_400.font.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                Cufon.replace('h1, h2, h3, #search-top span', { fontFamily: 'Futura BdCn BT' });
                date_heure('date_heure');
            });
        </script>
        <!-- end cufon -->

        <!-- corner -->
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.corner.js"></script>
        <script type="text/javascript">
            $('a.link').corner('5px');
            $('#search-top').corner('10px bottom');
        </script>
        <!-- end corner -->

        <!-- bookmark-->
        <script type="text/javascript" src="<?php echo base_url() ?>js/bookmarkscroll.js" ></script>
        <!-- end bookmark-->

        

        <!-- fancybox login -->
        <script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.2.pack.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.1.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.1.css" media="screen" />

        <script type="text/javascript">
            $(document).ready(function() {
                $(".login").fancybox({
                    'autoScale'			: false,
                    'transitionIn'		: 'none',
                    'transitionOut'		: 'none',
                    'type'			: 'iframe'
                });
            });
        </script>
        <!-- end fancybox login -->
                
    </head>

    <body>
        <div id="wrapper">
            <div id="header">
                <div id="top-bar">
                    <div id="languge">
                        <?php
                            foreach ($data['lang'] as $value) {
                                echo '<a  href="' . base_url() . 'index.php?lang=' . $value['code_lang'] . '" ><img src="' . $value['images'] . '"/></a>&nbsp;';
                            }
                        ?>
                    </div>
                    <div id="date_heure"></div>


                    <div id="search-top">
                        <form action="<?php echo base_url() ?>search/search.php" id="SearchForm" method="get">
                            <span style="padding-top:9px">Search</span><div id="search-frm">

                                <input type="text" name="query" id="SearchInput" value="" />
                            </div>
                            <input type="image" src="<?php echo base_url() ?>images/search-button.jpg" />
                            <input type="hidden" name="search" id="SearchSubmit" class="noStyle" value="1" />
                        </form>

                    </div>
                    <img src="<?php echo base_url() ?>images/Logo-white.png" alt="logo" />
                </div>
                <!-- end top-bar -->

                <div id="banner">
                    <ul id="GalleryView">

                        <?php
			if($data['slide'])
			foreach ($data['slide'] as $key => $value) {
			?>
                        <li>
                            <img src="<?php echo $value['images'] ?>" style="width: 920px;" />
                            <div class="panel-overlay">
                                <h4><?php echo $value['name']; ?></h4>
                            </div>
                        </li>
                        <?php
			}
			?>

                    </ul>
                </div>

                <div class="menu">
		    <?php
		    echo $data['menu'];
		    ?> 
		</div>

                <!-- end menu -->
            </div>
            <!-- end header --><a name="tops" id="tops"></a>
            <a href="#tops"><div title="Go to top" id="jump"></div></a>
            <div id="content">
                <div class="bot-l"></div>
                <div class="bot-r"></div>

                <div id="left">
                    <div class="gray-col">

                        <div class="top-col"><h1><?php echo $data['headers'] ?></h1></div>
                        <div class="mid-col">
                            <div class="gray-col-bl"></div>
                            <div class="gray-col-br"></div>

                            <ul class="list-1">
				<?php
                                if($data['list_news'])
				foreach ($data['list_news'] as $key => $value) {
				    $title = explode('|', $value['title']);
				?>
                                <li>
                                    <a href="#<?php echo unicode_convert($title[0]);?>">
					 <?php echo $title[0];?>					
				    </a>
                                </li>
                                <?php
				}
				?>
                            </ul>
                        </div>
                    </div>
                    
                </div>
                <!-- end left -->

                <div id="right">
		    <?php
		    if($data['intro'] != '')
		    {
			$intro = explode('|', strip_tags($data['intro']));
		    ?>
			<h3 style="padding-top:15px;" ><?php echo $intro[0]?></h3>
			<h1 class="orange"><?php echo $intro[1]?></h1>
		    <?php
		    }
		    
		    if($data['list_news'])
		    foreach ($data['list_news'] as $key => $value) {
			$title = explode('|', $value['title']);
			$content = explode('<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>', $value['content'])
		    ?>
                    <a id="<?php echo unicode_convert($title[0]);?>" name="<?php echo unicode_convert($title[0]);?>"></a>
                    <div class="row-1">
                        <div class="heading">

                            <h3 style="padding-top: 30px;"><?php echo $title[0]?></h3>
                            <h1 class="blue"><?php echo $title[1]?></h1>

                        </div>
                        <div class="container">
			    <?php 
				if($value['images'] != '')				
				{
			    ?>
				<img src="<?php echo $value['images']?>" rel="photo" />
			    <?php 
				}
			    ?>
			    <div class="info" style="color:#0C3992">
				<?php echo $content[0] == '<p>&nbsp;</p>'.chr(13).chr(10) ?  $content[1] :  $content[0]; ?>
			    </div>
			    <?php
				echo $content[0] != '<p>&nbsp;</p>'.chr(13).chr(10) ?  $content[1] : '';
				
				if($value['intro'] != '')
				{
				    if(strpos($value['intro'], 'http://') === false)
					$link = base_url().$value['intro'];
				    else
					$link = $value['intro'];
					
			    ?>			    
				    <a href="<?php echo $link ?>" class="link red-button">
					<span class="arrow"></span>
					<?php echo $mtran->get_translates("read more", $_SESSION['lang']) ?>				    
				    </a>
			    <?
				}
			    ?>
                        </div>

                        <div style="clear: both;"></div>
                    </div>
                    <!-- end row 1 -->
		    <?php
		    }
		    ?>
                    
                </div>
                <div style="clear: both;"></div>
            </div>
            <!-- end content -->
            <div id="bottom-box">
                <div class="cornor-tl"></div>
                <div class="cornor-tr"></div>

                <div class="cornor-bl"></div>
                <div class="cornor-br"></div>
                <?php
		if($data['footer']['list'])
		foreach($data['footer']['list'] as $key => $value)
		{
		?>
                <div class="box-1 <?php echo ($key == 2) ? "no-border" : ""?> ">		    
                    <img src="<?php echo $value['images']?>" />
                    <div>
                        <h2><?php echo $value['title']?></h2>
                        <?php echo $value['content']?>
			<a href="<?php echo $value['intro']?>" class="link blue-button">
			    <span class="arrow"></span>
                            <?php echo $mtran->get_translates("read more", $_SESSION['lang']) ?>
                        </a>
                    </div>
                </div>                
		<?php
		}
		?>



                <div style="clear: both;"></div>
            </div>
            <!-- end bottom box -->
        </div>

        <div id="footer">
	IFRC (Intelligent Financial Research & Consulting) © 2011
        </div>
    </body>
</html>
<?php
viewarr($data);
?>
