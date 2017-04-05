
    </div>
        <footer id="footer">
            <div class="wrapper">
                <div class="footer-nav-wrapper">
                    <div class="fnwl1"></div>
                    <div class="fnwc1">
                        <nav>
                            <ul id="menu-footer-nav" class="menu">
                                <?php showBlock('menubottom'); ?>
                            </ul>
                            <div class="social_links">
                                <?php if ($data['config']['facebook'] != '') { ?><a class="facebook" href="<?php echo $data['config']['facebook']; ?>" target="_blank">Facebook</a><?php } ?>                               
                                <?php if ($data['config']['linkedin'] != '') { ?><a class="linkedin" href="<?php echo $data['config']['linkedin']; ?>" target="_blank">LinkedIn</a><?php } ?>
                                <?php if ($data['config']['twitter'] != '') { ?><a class="twitter" href="<?php echo $data['config']['twitter']; ?>" target="_blank">Twitter</a><?php } ?>
                            </div>
                        </nav>
                    </div>
                    <div class="fnwr1"></div>
                </div>
                <div class="clear"></div>
                <div class="footer-content">
                    <?php showBlock('bottom_actualites'); ?>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="copyright">
                <div class="wrapper">
                    <span style="margin-right:550px;">All rights reserved. Copyright © 2012</span>
                    <span>
                        <a href="http://ifrc.fr">www.ifrc.fr</a>
                    </span>
                </div>
            </div>
        </footer>
        <script type='text/javascript'>
            Cufon.now();
        </script>
		<script type='text/javascript'>
            jQuery('.lang_top').css('position','absolute');
			  var _gaq = _gaq || [];
			  _gaq.push(['_setAccount', 'UA-34019004-1']);
			  _gaq.push(['_setDomainName', 'ifrc.fr']);
			  _gaq.push(['_setAllowLinker', true]);
			  _gaq.push(['_trackPageview']);

			  (function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			  })();
        </script>
			
    </body>
</html>