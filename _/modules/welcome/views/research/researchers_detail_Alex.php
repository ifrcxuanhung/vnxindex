<?php
    if($info_user != "")
    {
?>
<section class="section profile_section first odd" id="profile">
  <div class="section_header profile_section_header opened">
    <h2 class="section_title profile_section_title vis"><a href="#"><span class="icon icon-user"></span><span class="section_name">Profile</span></a><span class="section_icon"></span></h2>
        <?php 
            if($this->session->userdata('user_id') == $user_id)
            {
        ?>
            <a class="edit_research" href="<?php echo base_url() . 'researchers/rlist' ?>"><?php trans('edit') ?></a></a><span class="section_icon"></span>
        <?php
            }
        ?>
    
    <div id="profile_header">
      <div id="profile_user">
        <div id="profile_photo"><img src="<?php echo base_url() .'assets/upload/files/research/'. $info_user['image'] ?>" alt="<?php echo $info_user['first_name'] . $info_user['last_name'] ?>" /></div>
        <div id="profile_name_area">
          <div id="profile_name">
            <h1 id="profile_title"><span class="firstname"><?php echo $info_user['first_name'] ?></span> <span class="lastname"><?php echo $info_user['last_name'] ?></span></h1>
            <h4 id="profile_position"><?php echo $info_user['profile_position'] ?></h4>
          </div>
        </div>
      </div>
      <div id="profile_data">
        <div class="profile_row name"> <span class="th"><?php trans('name') ?>:</span><span class="td"><?php echo $info_user['first_name'] .' '. $info_user['last_name'] ?></span> </div>
        <div class="profile_row birth"> <span class="th"><?php trans('date_of_birth') ?>:</span><span class="td"><?php echo $info_user['date_birth']?></span> </div>
        <div class="profile_row address"> <span class="th"><?php trans('address') ?>:</span><span class="td"><?php echo $info_user['address']?></span> </div>
        <div class="profile_row phone"> <span class="th"><?php trans('phone') ?>:</span><span class="td"><?php echo $info_user['phone'] ?></span> </div>
        <div class="profile_row email"> <span class="th"><?php trans('email') ?>:</span><span class="td"><?php echo $info_user['email']?></span> </div>
        <div class="profile_row website"> <span class="th"><?php trans('website') ?>:</span><span class="td"><a target="_blank" href="<?php echo (substr($info_user['website'],0,4) == 'http') ? $info_user['website'] : "http://".$info_user['website']; ?>"><?php echo $info_user['website'] ?></a></span> </div>
      </div>
    </div>
  </div>
  <div class="section_body profile_section_body">
    <div class="proile_body">
        <p class="profile_name"><?php trans('profile') ?></p>
        <p><?php echo $info_user['profile']; ?></p>
        <p class="profile_name"><?php trans('experience') ?></p>
        <p><?php echo $info_user['experience']; ?></p>
        <p class="profile_name"><?php trans('specialities') ?></p>
        <p><?php echo $info_user['specialities']; ?></p>
    </div>
  </div>
</section>
<div id="mainpage_accordion_area"> 
  
  <!-- RESUME -->
  <section class="section resume_section even" id="resume">
    <div id="resume_buttons"> <!--<a target="_blank" id="resume_link" href="print.html"><span class="label">Print</span><span class="icon-print icon"></span></a>--> </div>
    <div class="section_header resume_section_header">
      <h2 class="section_title resume_section_title"><a href="#"><span class="icon icon-align-left"></span><span class="section_name">Resume</span></a><span class="section_icon"></span></h2>
    </div>
    <div class="section_body resume_section_body">
      
      <div class="wrapper resume_wrapper">
        <?php
       //echo '<pre>'; print_r($list_research);exit;
            if(!empty($list_research))
            {
                $j = 0;
                foreach($list_research as $key=>$value)
                {
        ?>
        <div class="category resume_category resume_category_1 <?php echo ($j%2 == 0) ? 'first' : 'odd'; ?>">
          <div class="category_header resume_category_header">
            <h3 class="category_title"><span class="category_title_icon <?php echo ($j%2 == 0) ? 'aqua' : 'green'; ?>"></span><?php trans("$key") ?></h3>
          </div>
          <div class="category_body resume_category_body">
            <?php
                $j++;
                $i = 0;
                foreach($value as $k=>$v)
                {
                    $i++;
                    $link = base_url() .'researchers/post/'. $v['research_id'] .'/'. utf8_convert_url($v['title']) .'.html';
            ?>
            <article class="post resume_post resume_post_1 <?php echo ($i == 1) ? 'first' : 'odd'; ?>">
              <div class="post_header resume_post_header">
                <div class="resume_period"> <span class="period_from"><?php echo $v['time_start'] ?></span> - <span class="period_to"><?php echo $v['time_end'] ?></span> </div>
                <h4 class="post_title"><span class="post_title_icon aqua"></span><a href="<?php echo $link ?>"><?php echo $v['title'] ?></a></h4>
                <h5 class="post_subtitle"><?php echo $v['job_position'] ?></h5>
              </div>
              <div class="post_body resume_post_body">
                <?php echo $v['description'] ?>
              </div>
            </article>
            <?php
                }
            ?>
          </div>
        </div>
        <?php
                }
            }
        ?>
      </div>
      <!-- /wrapper --> 
    </div>
    <!-- /section_body --> 
  </section>
  <!-- /RESUME--> 
  
  
  <!-- CONTACTS -->
  <section class="section contact_section even" id="contact">
    <div class="section_header contact_section_header">
      <h2 class="section_title contact_section_title"><a href="#"><span class="icon icon-envelope-alt"></span><span class="section_name">Contacts</span></a><span class="section_icon"></span></h2>
    </div>
    <div class="section_body contact_section_body">
      <div id="googlemap_data">
        <div id="sc_googlemap" style="width:100%;height:294px;" class="sc_googlemap"></div>
        <div class="add_info">
          <div class="profile_row header "> Contact info </div>
          <div class="profile_row address"> <span class="th">Address</span><span class="td"></span> </div>
          <div class="profile_row phone"> <span class="th">Phone</span><span class="td"></span> </div>
          <div class="profile_row email"> <span class="th">Email</span><span class="td"></span> </div>
          <div class="profile_row website"> <span class="th">Website</span><span class="td"></span> </div>
        </div>
      </div>
      <div class="sidebar contact_sidebar">
        <aside class="widget widget_qrcode_vcard" id="qrcode-vcard-widget-2">
          <h3 class="widget_title">VCARD</h3>
          <div class="widget_inner">
            <div class="qrcode"></div>
          </div>
        </aside>
      </div>
      <div class="contact_form">
        <div class="contact_form_data">
          <div class="sc_contact_form">
            <h3 class="title">Let's keep in touch</h3>
            <form action="include/sendmail.php" method="post">
              <div class="field">
                <label class="required" for="sc_contact_form_username">Name</label>
                <input type="text" name="username" id="sc_contact_form_username" />
              </div>
              <div class="field">
                <label class="required" for="sc_contact_form_email">Email</label>
                <input type="text" name="email" id="sc_contact_form_email" />
              </div>
              <div class="field message">
                <label class="required" for="sc_contact_form_message">Your Message</label>
                <textarea name="message" id="sc_contact_form_message"></textarea>
              </div>
              <div class="button"> <a class="enter" href="#"><span>Submit</span></a> </div>
            </form>
            <div class="result sc_infobox"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- .section_body --> 
  </section>
  <!-- /CONTACT --> 
</div>
<?php } ?>