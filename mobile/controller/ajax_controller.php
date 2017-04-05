<?php
require("mail/class.phpmailer.php");
require("mail/class.smtp.php");
require("mail/class.pop3.php");
include_once "model/first_model.php";
include_once "model/translate_model.php";
include_once "model/article_model.php";
include_once "model/ifrc_article_model.php";
Class Ajax_Controller {

    protected $first_model;
    protected $translate_model;

    Public function __construct() {
        $this->first_model = new First_Model();
        $this->translate_model = new Translate_Model();
		$this->article_model = new Article_Model();
        $this->int_article_model = new Ifrc_article_model();
    }

    public function contact() {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $captcha = $_POST['captcha'];
        if ($captcha == $_SESSION['real']) {
            $config = $this->first_model->getEmailContact();
            $to = isset($config[0]['contact_email']) ? $config[0]['contact_email'] : 'contact@ifrc.fr';
            $subject = "From " . $this->translate_model->getTranslate('VNXINDEX_title') . ", {$email}";
            $message = $message;
            $send = $this->sendmail($to, $to, $name, $subject, $message, $to, $to);
            echo $send == 1 ? 1 : 0;
        } else {
            echo 0;
        }
        exit;
    }

    public function sendmail($mailto, $nameto, $namefrom, $subject, $noidung, $namereplay, $emailreplay)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP(); // set mailer to use SMTP
        $mail->Host = "mail.ifrc.vn"; // specify main and backup server
        $mail->Port = 465; // set the port to use
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->SMTPSecure = "ssl";
        $mail->Username = "contact@ifrc.vn"; // your SMTP username or your gmail username// Email gui thu
        $mail->Password = "ifrcvn2014"; // your SMTP password or your gmail password
        //$from = $mailfrom; // Reply to this email// Email khi reply
        $mail->CharSet = "utf-8";
        $from = $emailreplay; // Reply to this email// Email khi reply
        $to = $mailto; // Recipients email ID // Email nguoi nhan
        $name = $nameto; // Recipient's name // Ten cua nguoi nhan
        $mail->From = $from;
        $mail->FromName = $namefrom; // Name to indicate where the email came from when the recepient received// Ten nguoi gui
        $mail->AddAddress($to, $name);
        $mail->AddReplyTo($from, $namereplay); // Ten trong tieu de khi tra loi
        $mail->WordWrap = 50; // set word wrap
        $mail->IsHTML(true); // send as HTML
        $mail->Subject = $subject;
        $mail->Body = $noidung; //HTML Body
        $mail->AltBody = ""; //Text Body

        if (!$mail->Send()) {
            return 0;
        } else {
            return 1;
        }
    }

    public function changeLanguage() {
        $langcode = $_POST['langcode'];
        $_SESSION['LANG_CURRENT'] = $langcode;
    }

    public function test() {
        echo "TEST";
    }

    public function translate() {
        echo $this->translate_model->getTranslate($_POST['str']);
    }

    public function sort_mtd() {
        $_SESSION['performance_ranking_sort'] = "mtd_{$_POST['sort']}";
    }

    public function sort_ytd() {
        $_SESSION['performance_ranking_sort'] = "ytd_{$_POST['sort']}";
    }

    public function select_provider() {
        $_SESSION['performance_ranking_provider'] = $_POST['provider'];
    }

    public function searchIndex()
    {
        $output['query'] = 'Unit';
        $output['suggestions'] = $this->first_model->getListSearchIndexes($_POST['query']);
        echo json_encode($output);
        
    }

    public function sort_membership() {
        switch ($_POST['column']) {
            case 'index':
                $_SESSION['membership_sort'] = "index_{$_POST['sort']}";
                break;
            case 'ytd':
                $_SESSION['membership_sort'] = "ytd_{$_POST['sort']}";
                break;
            case 'wgt':
                $_SESSION['membership_sort'] = "wgt_{$_POST['sort']}";
                break;
            default:
                break;
        }
    }

    public function searchCompany() {
        $output['query'] = 'Unit';
        $output['suggestions'] = $this->first_model->getListSearchCompanies($_POST['query']);
        echo json_encode($output);
    }

    public function getpublications() {
        $data['trans'] = $this->translate_model;
        $current_page = $_POST['current_page'];
        $current_page = round($current_page);
        $current_page = max(1, $current_page);
        $query = $_POST['query'];
        $start = ($current_page - 1) * 10;
        $data['publicatons'] = $this->first_model->getResearchPublicatons($query, $start, 10);
        foreach ($data['publicatons'] as $value) {
            $authors = (isset($value['author1'])&&$value['author1']!='' ? $value['author1'] : '').(isset($value['author2'])&&$value['author2']!='' ? ' - '.$value['author2'] : '').(isset($value['author3'])&&$value['author3']!='' ? ' - '.$value['author3'] : '').(isset($value['author4'])&&$value['author4']!='' ? ' - '.$value['author4'] : '');
            ?>  
            <article style="margin-bottom: 15px; padding-top: 15px; position: relative; min-height:60px" class="post resume_post resume_post_1 first">
                <div class="post_header resume_post_header">
                    <div class="resume_period"> <span class="period_from"><?php echo $value['year'] ?></span> </div>                
                    <h4 style="padding-left: 20px; width: 90%;" class="post_title">
                        <span class="post_title_icon aqua"></span>
                        <?php
                        $file = "";
                        $link = "";
                        if (trim($value['file']) != "") {
                            if (substr($value['file'], 0, 4) == "http") {
                                $file = $value['file'];
                            } else {
                                $file = PARENT_URL . $value['file'];
                            }
                        }else{
                            if (substr($value['link'], 0, 4) == "http") {
                                $link = $value['link'];
                            } else {
                                $link = PARENT_URL . $value['link'];
                            }
                        }
                        ?>
                        <a href="<?php echo trim($value['file']) != "" ? $file : $link ?>" class="<?php echo 'disabled' ?>" target="_blank"><?php echo $value['title'] ?></a>
                    </h4>
                    <h5 class="post_subtitle"><?php echo $authors ?></h5>              
                </div>
                <div style="width: 93%;" class="post_body resume_post_body">
                    <p style="padding-left:23px; font-weight: bold;">
                        <?php echo $value['journal'] ?>
                        <?php //echo $value['reference'] != "" ? ', ' . $value['reference'] : "" ?>
                    </p>               
                    <?php echo $value['description'] != "" ? "<p style='padding-left:23px; padding-top: 5px;'>{$value['description']}</p>" : "" ?>
                    <?php
                    if (trim($value['file']) != "") {
                        if (substr($value['file'], 0, 4) == "http") {
                            $file = $value['file'];
                            $img = BASE_URL . '/template/images/link.png';
                        } else {
                            $file = PARENT_URL . $value['file'];
                            $img = BASE_URL . '/template/images/pdf.png';
                        }
                        ?>
                        <div class="download_file">
                            <a href="<?php echo $file ?>" target="_blank"><img style="<?php echo ($file==''||$file==PARENT_URL? 'display:none' : '' ) ?>" title="<?php echo $value['title'] ?>" alt="Download" src="<?php echo $img ?>"/></a>
                        </div>
                        <?php
                        }else {
                            if (substr($value['link'], 0, 4) == "http") {
                                $link = $value['link'];
                                $img = BASE_URL . '/template/images/link.png';
                            } else {
                                $link = PARENT_URL . $value['link'];
                                $img = BASE_URL . '/template/images/pdf.png';
                            }
                            ?>
                            <div class="download_file">
                                <a href="<?php echo $link ?>" target="_blank"><img style="<?php echo ($link==''||$link==PARENT_URL? 'display:none' : '' ) ?>" title="<?php echo $value['title'] ?>" alt="Download" src="<?php echo $img; ?>"/></a>
                            </div>
                        <?php
                    }
                    ?>
                </div>
            </article>
            <?php
        }
        echo "<script>download_confirm();</script>";
    }

    public function searchQuick() {
        $output['query'] = 'Unit';
		$query = isset($_POST['query']) ? $_POST['query'] : '';
        $meta = isset($_POST['meta']) ? $_POST['meta'] : '';
        $category = isset($_POST['category']) ? $_POST['category'] : '';
        $output['suggestions'] = $this->first_model->getListSearchQuick($query, $category, $meta);
		
        echo json_encode($output);
    }

    public function getSearchQuick() {
        $output = array();
	    $title = isset($_POST['title']) ? $_POST['title'] : '';
        $meta = isset($_POST['meta']) ? $_POST['meta'] : '';
        $category = isset($_POST['category']) ? $_POST['category'] : '';
        $result = $this->first_model->getResultSearchQuick($title, $category, $meta);
	
        $html = '';
        if (count($result) > 1) {
            $authors = (isset($result['author1'])&&$result['author1']!='' ? $result['author1'] : '').(isset($result['author2'])&&$result['author2']!='' ? ' - '.$result['author2'] : '').(isset($result['author3'])&&$result['author3']!='' ? ' - '.$result['author3'] : '').(isset($result['author4'])&&$result['author4']!='' ? ' - '.$result['author4'] : '');
            $html .= "<article style='margin-bottom: 15px; padding-top: 15px; position: relative; min-height: 60px;' class='post resume_post resume_post_1 first'>";
            $html .= "<div class='post_header resume_post_header'>";
            $html .= "<div class='resume_period'> <span class='period_from'>{$result['year']}</span> </div>";
            $html .= "<h4 style='padding-left: 20px; width: 90%;' class='post_title'><span class='post_title_icon aqua'></span><a class='disabled' href='javascript:void(0)'>{$result['title']}</a></h4>";
            $html .= "<h5 class='post_subtitle'>{$authors}</h5>";
            $html .= "</div>";
            $html .= "<div style='width: 93%;' class='post_body resume_post_body'>";
            $html .= "<p style='padding-left: 23px;'>{$result['journal']}";
            //$html .= $result['reference'] != '' ? ", {$result['reference']}" : "";
            if (trim($result['file']) != "") {
                if (substr($result['file'], 0, 4) == "http") {
                    $file = $result['file'];
                    $img = BASE_URL . '/template/images/link.png';
                } else {
                    $file = PARENT_URL . $result['file'];
                    $img = BASE_URL . '/template/images/pdf.png';
                }
                $html .= "<div class='download_file'>";
                $html .= "<a href='{$file}' target='_blank'><img style='".($file == ''||$file==PARENT_URL ? 'display:none' : '' )."' title='{$result['title']}' src='{$img}' /></a>";
                $html .= "</div>";
            }else{
                if (substr($result['link'], 0, 4) == "http") {
                    $link = $result['link'];
                    $img = BASE_URL . '/template/images/link.png';
                } else {
                    $link = PARENT_URL . $result['link'];
                    $img = BASE_URL . '/template/images/pdf.png';
                }
                $html .= "<div class='download_file'>";
                $html .= "<a href='{$link}' target='_blank'><img style='".($link==''||$link==PARENT_URL ? 'display:none' : '' )."' title='{$result['title']}' src='{$img}' /></a>";
                $html .= "</div>";
            }
            $html .= "</div>";
            $html .= "</article>";
            $html .= "<script>download_confirm();</script>";
        }
        $output[] = $html;
        echo json_encode($output);
        exit();
    }
    
    public function getSearchQuickReset() {
        $output = array();
	    //$title = isset($_POST['title']) ? $_POST['title'] : '';
        //$meta = isset($_POST['meta']) ? $_POST['meta'] : '';
        $category = isset($_POST['category']) ? $_POST['category'] : '';
        //$result = $this->first_model->getResultSearchQuick($title, $category, $meta);
        $query = 'select * from ifrc_publications as tempt1 where tempt1.type like "%'.strtoupper($category).'%" order by `year` desc;';
        $result = $this->first_model->getResearchPublicatons($query, 0, 10);
	    //print_R($result);exit;   
        $html = '';
        if (count($result) > 1) {
            foreach ($result as $value) {
                $authors = (isset($value['author1'])&&$value['author1']!='' ? $value['author1'] : '').(isset($value['author2'])&&$value['author2']!='' ? ' - '.$value['author2'] : '').(isset($value['author3'])&&$value['author3']!='' ? ' - '.$value['author3'] : '').(isset($value['author4'])&&$value['author4']!='' ? ' - '.$value['author4'] : '');
                $html .= "<article style='margin-bottom: 15px; padding-top: 15px; position: relative; min-height: 60px;' class='post resume_post resume_post_1 first'>";
                $html .= "<div class='post_header resume_post_header'>";
                $html .= "<div class='resume_period'> <span class='period_from'>{$value['year']}</span> </div>";
                $html .= "<h4 style='padding-left: 20px; width: 90%;' class='post_title'><span class='post_title_icon aqua'></span><a class='disabled' href='javascript:void(0)'>{$value['title']}</a></h4>";
                $html .= "<h5 class='post_subtitle'>{$authors}</h5>";
                $html .= "</div>";
                $html .= "<div style='width: 93%;' class='post_body resume_post_body'>";
                $html .= "<p style='padding-left: 23px;'>{$value['journal']}";
                //$html .= $value['reference'] != '' ? ", {$value['reference']}" : "";
                if (trim($value['file']) != "") {
                    if (substr($value['file'], 0, 4) == "http") {
                        $file = $value['file'];
                        $img = BASE_URL . '/template/images/link.png';
                    } else {
                        $file = PARENT_URL . $value['file'];
                        $img = BASE_URL . '/template/images/pdf.png';
                    }
                    $html .= "<div class='download_file'>";
                    $html .= "<a href='{$file}' target='_blank'><img style='".($file == ''||$file==PARENT_URL ? 'display:none' : '' )."' title='{$value['title']}' src='{$img}' /></a>";
                    $html .= "</div>";
                }else{
                    if (substr($value['link'], 0, 4) == "http") {
                        $link = $value['link'];
                        $img = BASE_URL . '/template/images/link.png';
                    } else {
                        $link = PARENT_URL . $value['link'];
                        $img = BASE_URL . '/template/images/pdf.png';
                    }
                    $html .= "<div class='download_file'>";
                    $html .= "<a href='{$link}' target='_blank'><img style='".($link==''||$link==PARENT_URL ? 'display:none' : '' )."' title='{$value['title']}' src='{$img}' /></a>";
                    $html .= "</div>";
                }
                $html .= "</div>";
                $html .= "</article>";
                $html .= "<script>download_confirm();</script>";
            }
        }
        $output[] = $html;
        echo json_encode($output);
        exit();
    }
	 public function getcatelog()
    {
        $page_number = $_POST['page_number'];
        $cate_code = isset($_POST['cate_code']) ? $_POST['cate_code'] :'';
		$sub_cate_code = isset($_POST['sub_cate_code']) ? $_POST['sub_cate_code'] :'';
        if($sub_cate_code==''){
            $sum = $this->int_article_model->count_article_cate1($cate_code);
        }else {
            $sum = $this->int_article_model->count_article_scate($sub_cate_code,$cate_code);
        }
        $start = ($page_number - 1) * 10;
        $limit = $start.',10';
        //print_R($cate_code);exit;
        $ldata = $this->int_article_model->get_article_by_scate_code($cate_code,$sub_cate_code,'title asc',$limit);
        $data = $ldata['current'];
        $totalP = ceil($sum/10);
        //print_R($data);exit;
        $html = '';
        $count = 0;
        foreach($data as $value)
        {
            $url =  $value['url'];
            if (strpos($url,'http')!==FALSE||strpos($url,'https')!==FALSE) {
                $links = $url;
                $urlS = str_replace('http://','',str_replace('https://','',$url));
            } else {
                $links = BASE_URL.$url;
                $urlS = str_replace('http://','',str_replace('https://','',$links));
            } 
          $html .= "<li>";
          $html .= ' <article style="margin-bottom: 15px; padding-top: 15px; position: relative; min-height:60px" class="post resume_post resume_post_1">';
            $html .=          	'<div class="post_header resume_post_header">
                    		<h4 style="padding-left: 20px; width: 100%;" class="post_title">
                    			<span class="post_title_icon aqua"></span>
                    			<a href="'.(isset($value['url'])&&$value['url']!='' ? $links : '').'" class="'.(isset($value['url'])&&$value['url']!='' ? '' : 'disabled').'" target="_blank">'.$value['title'].'</a>
                    		</h4>           
                    	</div>';
          if(basename($value['images']) != 'no-image.jpg' && basename($value['images']) != '') {
             $html .='<div class="post_img" style="width: 20%; float: left; margin: 10px; position: relative;">
                        <img style="width: 100%;" src="'. PARENT_URL.$value['images'].'" alt="" title="" /></div>';
          } 
         
         $html .= '<div style="width:'.((basename($value['images']) != 'no-image.jpg' && basename($value['images']) != '')? '75%' : '93%') .';margin-left: 20px; position: relative; float: left; margin-left: 20px; position: relative; float: left;" class="post_body resume_post_body">'.$value['description'].'<p style="padding-top:6px">'.$value['long_description'].'</p>';
         //if(isset($value['long_description']) && $value['long_description'] != '') {
//         $html .= '<div align="right" class="right">';
//         $html .= '<input type="button" id="open_popup" name="open_popup'.$value["id"].'" rel="miendatwebPopup" href="#popup_content'.$value["id"].'" value="More"/>';
//         $html .= '</div>';
//         $html .= '<div id="popup_content'.$value["id"].'" class="popup">';
//         $html .= '<div class="popup-header"><h2>'.$value['title'].'</h2><a class="close_popup" href="javascript:void(0)"></a></div>';
//         $html .= '<div class="info_popup"><p>'.$value['description'].'</p><p>'.$value['long_description'].'</p></div></div>';
//         }
         if(isset($value['url']) && $value['url'] != '') {
            $html .= '<a href="'.(isset($value['url'])&&$value['url']!='' ? $links : '').'" class="'.(isset($value['url'])&&$value['url']!='' ? '' : 'disabled').'" target="_blank">'.$urlS.'</a>';    
         }
         $html .= "</div></article></li>";
         $count++;   
        }
        
        //$html_paging =  '<li><a cate_code="'.$cate_code.'" sub_cate_code ="'.$sub_cate_code.'" href="javascript:void(0)" page="1"> First </a></li>';
//		for($i = $page_number; $i <= $totalP; $i++)
//		{
//		    if($i <= $page_number + 5){
//				$current = ($i == $page_number) ? "class='current'" : "";
//				$html_paging .= '<li><a cate_code="'.$cate_code.'" sub_cate_code ="'.$sub_cate_code.'" href="javascript:void(0)" '.$current.' page="'.$i.'">'.$i.'</a></li>';
//            }else if($i == $totalP){
//                $html_paging .= '<li><span>...</span></li>';
//            }
//		}
//        $html_paging .= '<li><a cate_code="'.$cate_code.'" sub_cate_code ="'.$sub_cate_code.'" href="javascript:void(0)" page="'.$totalP.'"> Last </a></li>';
        $output = array('totalP' => $totalP, 'content' => $html);  
       // $output['content'] = $html;
       // $output['paging'] = $html_paging;
        
        //print_R($output);exit;
        echo json_encode($output);
      //  exit();
        //echo $html;
    }

    public function searchGlossary() {
        $output['query'] = 'Unit';
        $output['suggestions'] = array();
		$category = isset($_REQUEST["category"]) ? $_REQUEST["category"] : "glossary" ;
        $listData = $this->int_article_model->list_article_cate($category);
        $count = 0;
        foreach ($listData['current'] as $item) {
            if (strpos(strtoupper("{$item['title']}"), strtoupper($_POST['query'])) !== false) {
                $output['suggestions'][$count]['data'] = utf8_convert_url($item['title']);
                $output['suggestions'][$count]['value'] = $item['title'];
            }
            $count++;
        }
        unset($listData);
        echo json_encode($output);
        exit();
    }

    public function getSearchGlossary() {
        $output = array();
		$category = isset($_REQUEST["category"]) ? $_REQUEST["category"] : "glossary" ;
        $listData = $this->int_article_model->list_article_cate($category);
        //print_R($_POST['title']);
        $html = '';
        foreach ($listData['current'] as $key => $value) {
            if(utf8_convert_url($value['title']) == $_POST['title']) {
                  $url =  $value['url'];
                if (strpos($url,'http')!==FALSE||strpos($url,'https')!==FALSE) {
                    $links = $url;
                    $urlS = str_replace('http://','',str_replace('https://','',$url));
                } else {
                    $links = BASE_URL.$url; 
                    $urlS = str_replace('http://','',str_replace('https://','',$links));
                }
                $html .= "<li>";
                $html .= ' <article style="margin-bottom: 15px; padding-top: 15px; position: relative; min-height:60px" class="post resume_post resume_post_1">';
                  $html .=' <div class="post_header resume_post_header">
                            		<h4 style="padding-left: 20px; width: 100%;" class="post_title">
                            			<span class="post_title_icon aqua"></span>
                            			<a href="'.(isset($value['url'])&&$value['url']!='' ? $links : '').'" class="'.(isset($value['url'])&&$value['url']!='' ? '' : 'disabled').'" target="_blank">'.$value['title'].'</a>
                            		</h4>           
                            	</div>';
                 if(basename($value['images']) != 'no-image.jpg' && basename($value['images']) != '') {
                 $html .='<div class="post_img" style="width: 20%; float: left; margin: 10px; position: relative;">
                          <img style="width: 100%;" src="'. PARENT_URL.$value['images'].'" alt="" title="" /></div>';
                 } 
                 
                            	
               
                $html .= '<div style="width:'.((basename($value['images']) != 'no-image.jpg' && basename($value['images']) != '')? "75%" : "93%" ).'; margin-left: 20px; position: relative; float: left;" class="post_body resume_post_body">'.$value['description'].'<p style="padding-top:6px">'.$value['long_description'].'</p>';
               // if(isset($value['long_description']) && $value['long_description'] != '') {
//                 $html .= '<div align="right" class="right">';
//                 $html .= '<input type="button" id="open_popup" name="open_popup'.$value["id"].'" rel="miendatwebPopup" href="#popup_content'.$value["id"].'" value="More"/>';
//                 $html .= '</div>';
//                 $html .= '<div id="popup_content'.$value["id"].'" class="popup">';
//                 $html .= '<div class="popup-header"><h2>'.$value['title'].'</h2><a class="close_popup" href="javascript:void(0)"></a></div>';
//                 $html .= '<div class="info_popup"><p>'.$value['description'].'</p><p>'.$value['long_description'].'</p></div></div>';
//                }
                if(isset($value['url']) && $value['url'] != '') {
                    $html .= '<a href="'.(isset($value['url'])&&$value['url']!='' ? $links : '').'" class="'.(isset($value['url'])&&$value['url']!='' ? '' : 'disabled').'" target="_blank">'.$urlS.'</a>';    
                }
                $html .= "</div></article></li>";
                if($_POST['title'] != '') {break;}            
            }
        }
        $output[] = $html;
        echo json_encode($output);
        exit();
    }
	public function getSearchGlossaryReset() {
        $output = array();
		$category = isset($_REQUEST["category"]) ? $_REQUEST["category"] : "glossary" ;
		$where = isset($_REQUEST["where"]) ? $_REQUEST["where"] : "" ;
		$sort = isset($_REQUEST["sort_"]) ? $_REQUEST["sort_"] : "" ;
        $listData = $this->int_article_model->get_article_by_cate_code_1($category,$where, $sort,"0,10");
        //print_R($_POST['title']);
        $html = '';
        foreach ($listData['current'] as $key => $value) {
            
                $url =  $value['url'];
                if (strpos($url,'http')!==FALSE||strpos($url,'https')!==FALSE) {
                    $links = $url;
                    $urlS = str_replace('http://','',str_replace('https://','',$url));
                } else {
                    $links = 'http://'.$url; 
                    $urlS = $url;
                }
                $html .= "<li>";
                $html .= ' <article style="margin-bottom: 15px; padding-top: 15px; position: relative; min-height:60px" class="post resume_post resume_post_1">';
                  $html .=' <div class="post_header resume_post_header">
                            		<h4 style="padding-left: 20px; width: 100%;" class="post_title">
                            			<span class="post_title_icon aqua"></span>
                            			<a href="'.(isset($value['url'])&&$value['url']!='' ? $links : '').'" class="'.(isset($value['url'])&&$value['url']!='' ? '' : 'disabled').'" target="_blank">'.$value['title'].'</a>
                            		</h4>           
                            	</div>';
                 if(basename($value['images']) != 'no-image.jpg' && basename($value['images']) != '') {
                 $html .='<div class="post_img" style="width: 20%; float: left; margin: 10px; position: relative;">
                          <img style="width: 100%;" src="'. PARENT_URL.$value['images'].'" alt="" title="" /></div>';
                 } 
                 
                            	
               
                $html .= '<div style="width:'.((basename($value['images']) != 'no-image.jpg' && basename($value['images']) != '')? "75%" : "93%" ).'; margin-left: 20px; position: relative; float: left;" class="post_body resume_post_body">'.$value['description'].'<p>'.$value['long_description'].'</p>';
               
                if(isset($value['url']) && $value['url'] != '') {
                    $html .= '<a href="'.(isset($value['url'])&&$value['url']!='' ? $links : '').'" class="'.(isset($value['url'])&&$value['url']!='' ? '' : 'disabled').'" target="_blank">'.$urlS.'</a>';    
                }
                $html .= "</div></article></li>";           
            
        }
        $output[] = $html;
        echo json_encode($output);
        exit();
    }

}
