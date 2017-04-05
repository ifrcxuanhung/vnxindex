<!DOCTYPE html>
<html lang="en-US">
    <head>
        <?php echo $this->block->head() ?>
    </head>
    <body class="home blog dark">
        <div class="switherHead"></div>
        <div class="colored">
            <div class="blue"></div>
            <div class="aqua"></div>
            <div class="green"></div>
            <div class="yellow"></div>
            <div class="red"></div>
        </div>
        <div class="hfeed site" id="page">
            <?php echo $this->block->header() ?>
            <div id="main" >
                <div class="content_area" id="primary">
                    <div role="main" class="site_content" id="content">
                        <?php echo $this->block->profile() ?>
                        <div id="mainpage_accordion_area"> 
                            <!-- LIST OF INDEXES -->
                            <?php echo $this->block->listindex() ?>
                            <!-- /LIST OF INDEXES-->

                            <!-- PERFORMANCE RANKING -->
                            <div id="performance">
                                <?php echo $this->block->performance_ranking() ?>
                            </div>
                            <!-- /PERFORMANCE RANKING--> 

                            <!-- DOCUMENTATION -->
                            <?php echo $this->block->documentation() ?>
                            <!-- /DOCUMENTATION --> 
                            
                            <!-- ARTICLE -->
                            <?php echo $this->block->home_article() ?>
                            <!-- /ARTICLE -->

                            <!-- CONTACTS -->
                            <?php echo $this->block->contact() ?>
                            <!-- /CONTACT --> 
                        </div>
                        <!-- #mainpage_accordion_area --> 
                    </div>
                    <!-- #content --> 
                </div>
                <!-- #primary --> 
            </div>
            <!-- #main -->
            <?php echo $this->block->footer() ?>
        </div>
        <!-- #page --> 

        <?php echo $this->block->script() ?>
    </body>
</html>
