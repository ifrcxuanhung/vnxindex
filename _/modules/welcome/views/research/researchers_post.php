<?php
    //print_r($info_user);exit;
    //print_r($research_post);exit;
?>
<div id="main"  class="right_sidebar single">
    <section id="profile" class="section profile_section odd first blog_page"> <a href="<?php echo base_url() .'researchers/detail/'. $user_id .'/'. utf8_convert_url($info_user['first_name']) .'-'. utf8_convert_url($info_user['last_name']) ?>" id="profile_page_link"><span class="icon-user icon"></span><span class="label">Profile</span></a>
      <div class="section_header profile_section_header">
        <div id="profile_header">
          <div id="profile_user">
            <div id="profile_photo"><img src="<?php echo base_url() .'assets/upload/files/research/'. $info_user['image'] ?>" alt="<?php echo $info_user['first_name'] ?>" /></div>
            <div id="profile_name_area">
              <div id="profile_name">
                <h1 id="profile_title"><span class="firstname"><?php echo $info_user['first_name'] ?></span> <span class="lastname"><?php echo $info_user['last_name'] ?></span></h1>
                <h4 id="profile_position"><?php echo $info_user['profile_position'] ?></h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div id="primary" class="content_area">
      <div id="content" class="site_content post_content" role="main">
        <section class="section post_section blog_section">
          <div class="section_body post_section_body">
            <article class="post">
              <h3 class="post_title"><?php echo $research_post['0']['title'] ?></h3>
              <div class="content_text"><?php echo $research_post['0']['long_description'] ?></div>
              <?php
                if($research_post['0']['file_url'] != "")
                {
                    $type_file = explode('.', $research_post['0']['file_url']);
                    $type_file = $type_file[1];
                    $link = base_url() .'assets/upload/files/research/'. $research_post['0']['file_url'];
              ?>
              <p class="file_upload_post">
                <a target="_blank" href="<?php echo $link ?>"><img class="img_file_upload_post" src="<?php echo base_url() .'assets/upload/files/'. $type_file .'.png';?>" /></a>
                <a target="_blank" class="name_file_upload_post" href="<?php echo $link ?>"><?php echo $research_post['0']['file_url'] ?></a>
              </p>
              <?php
                }
              ?>
            </article>
            
            <div id="related_posts">
              <h3 class="section_title"><span class="icon"></span><?php trans('related_posts') ?></h3>
              <?php
              $i = 0;
                foreach($relatedPost as $k => $v)
                {
                    $link = base_url() .'researchers/post/'. $v['research_id'] .'/'. utf8_convert_url($v['title']) .'.html';
              ?>
              <article class="related_posts odd <?php echo ($i == 0) ? 'first' : 'even' ?>">
                <h3><a href="<?php echo $link ?>"><?php echo $v['title'] ?></a></h3>
                <div class="post-info"> <a href="javascript:void(0);" class="post_date"><span class="icon-time"></span><?php echo $v['date_added'] ?></a></div>
              </article>
              <?php } ?>

            </div>
          </div>
          
          <!-- #post_content --> 
        </section>
      </div>
      <!-- #primary --> 
    </div>
    
  </div>