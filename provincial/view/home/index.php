<?php
    $setting = setting();
    $width = (isset($setting['provincial_width']) && $setting['provincial_width'] != "") ? "style='width: {$setting['gwc_width']}'" : "";
?>
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
        <div class="hfeed site" id="page" <?php echo $width ?>>
            <?php echo $this->block->header() ?>
            <div id="main" > <!--22011A-->
                <div class="content_area" id="primary">
                    <div role="main" class="site_content" id="content">
                        <?php echo $this->block->profile() ?>
                        <div id="mainpage_accordion_area"> 
                            <?php
                            foreach ($listArticle as $keyArticle => $valueArticle)
                            {
                                if (in_array('index', explode(';', $valueArticle['group'])))
                                {
                                    $this->block->listindex($valueArticle['article_id']);
                                }
                                else if (in_array('performance', explode(';', $valueArticle['group'])))
                                {
                                    $this->block->performance_ranking($valueArticle['article_id']);
                                }
                                else
                                {
                                    if (in_array('publications', explode(';', $valueArticle['group'])))
                                    {
                                        $this->block->listpublications($valueArticle['article_id']);
                                    }
                                    else
                                    {
                                        if(in_array('progress', explode(';', $valueArticle['group'])))
                                        {
                                            $this->block->project_progress($valueArticle['article_id']);
                                        }
                                        else
                                        {
                                            $this->block->home_article($valueArticle['article_id']);
                                        }
                                        
                                    }
                                }
                            }
                            echo $this->block->documentation();
                            echo $this->block->our_website();
                            echo $this->block->contact();
                            ?>
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
