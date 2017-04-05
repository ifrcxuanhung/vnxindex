<div id="content" role="main" class="right-sidebar">
    <div id="sidebar">
        <div id="popular_posts-3" class="widget widget_popular_posts">
            <?php echo $actualites; ?>
        </div> 

        <?php
        echo $newsletter;
        ?>                   
    </div>
    <div id="main">
        <div class="main_content">
            <div class="breadcrumb">
                <a href="<?php echo base_url(); ?>" class="lnk_home"><?php trans('Home'); ?></a>                    
                <span><?php trans('search_result'); ?></span>
            </div>

            <article class="post-1 post type-post status-publish format-standard hentry category-blog-category category-posts-with-image tag-blog tag-hello"
                     id="post-1">
                <div class="header-styled">
                    <h2><?php trans('search_result'); ?></h2>
                </div>              

                <div class="entry-content addcl_content">
                    <p>
                        <?php
                           //$mysql_table_prefix='search_';
                           $mysql_table_prefix='';
                        /*-------------------------------------------------------------------------------------------------*/
                        include_once ("searchindex/include/commonfuncs.php");
                        require_once('searchindex/settings/db_search.php');
                        require_once('searchindex/settings/conf.php'); 
                        require_once("searchindex/include/searchfuncs.php");
                        include_once ("searchindex/settings/en-language.php");
                        $search =1;
                        extract(getHttpVars());

                        if (isset($_GET['query'])){
                            $query = $_GET['query'];
                        }else{
                            $query=FALSE;
                        }
                        if (isset($_GET['search'])){
                            $search = $_GET['search'];
                        }else{
                            $search=1;
                        }
                        if (isset($_GET['domain'])){
                            $domain = $_GET['domain'];
                        }else{
                            $domain=FALSE;
                        }
                        if (isset($_GET['results'])){
                            $results = $_GET['results'];
                        }else{
                            $results=FALSE;
                        }
                        if (isset($_GET['start'])){
                            $start = $_GET['start'];
                        }else{
                            $start=FALSE;
                        }
                        if (isset($_GET['category'])){
                            $category = $_GET['category'];
                        }else{
                            $category=FALSE;
                        }
                        if (isset($_GET['type'])){
                            $type = $_GET['type'];  
                        }else{
                            $type=FALSE;
                        }

                        $str = substr($query, 0, 5);
                        $site = substr($query, 5);
                        $qsite = substr($query, 9);
                        $pos = strstr($qsite, '.');
                        $name = rtrim($qsite, $pos);
						
						//echo '________'.$name;
						//echo $query.'-';exit;//sdasd
						//echo $start.'-';exit;//rong
						//echo $category.'-';exit;//rong
						//echo $type.'-';exit;//rong
						//echo $results.'-';exit;//rong
						//echo $domain.'-';exit;//rong
						//exit;
						
						
						
                        if ($str == 'site:') {
						
                        header("Location: results.php?query=$name&search=1&results=10&domain=$site");
                        }
						
                        if (preg_match("/[^a-z0-9-.]+/", $domain)) {
                            $domain="";
                        }


                        if ($results != "") {
                            $results_per_page = $results;
                        }

                        if (get_magic_quotes_gpc()==1) {//no pass
                            $query = stripslashes($query);
                        }
                        if ($query !='') {
                        include_once ("searchindex/include/websfunctions.php");
                        }
                        mysql_close($link);
						
                        /*-------------------------------------------------------------------------------------------------*/

                        ?>

                    </p>
                </div>
            </article>                                        
            <div class="clear"></div>
        </div>
    </div>
</div>