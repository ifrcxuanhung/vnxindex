<?php

require("mail/class.phpmailer.php");
require("mail/class.smtp.php");
require("mail/class.pop3.php");
include_once "model/first_model.php";
include_once "model/translate_model.php";

Class Ajax_Controller {

    protected $first_model;
    protected $translate_model;

    Public function __construct()
    {
        $this->first_model = new First_Model();
        $this->translate_model = new Translate_Model();
    }

    public function contact()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $captcha = $_POST['captcha'];
        if ($captcha == $_SESSION['real'])
        {
            $config = $this->first_model->getEmailContact();
            $to = isset($config[0]['contact_email']) ? $config[0]['contact_email'] : 'contact@ifrc.fr';
            $subject = "Email contact of {$name} ({$email})";
            $message = $message;
            $send = $this->sendmail($to, $to, $name, $subject, $message, $to, $to);
            echo $send == 1 ? 1 : 0;
        }
        else
        {
            echo 0;
        }
        exit;
    }

    public function sendmail($mailto, $nameto, $namefrom, $subject, $noidung, $namereplay, $emailreplay)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP(); // set mailer to use SMTP
        $mail->Host = "auth.smtp.1and1.fr"; // specify main and backup server
        $mail->Port = 587; // set the port to use
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->SMTPSecure = "tls";
        $mail->Username = "index@ifrc.fr"; // your SMTP username or your gmail username// Email gui thu
        $mail->Password = "welcome"; // your SMTP password or your gmail password
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

        if (!$mail->Send())
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }

    public function changeLanguage()
    {
        $langcode = $_POST['langcode'];
        $_SESSION['LANG_CURRENT'] = $langcode;
    }

    public function test()
    {
        echo "TEST";
    }

    public function translate()
    {
        echo $this->translate_model->getTranslate($_POST['str']);
    }

    public function sort_mtd()
    {
        $_SESSION['performance_ranking_sort'] = "mtd_{$_POST['sort']}";
        
    }

    public function sort_ytd()
    {
        $_SESSION['performance_ranking_sort'] = "ytd_{$_POST['sort']}";
        
    }
    
    public function select_provider()
    {
        $_SESSION['performance_ranking_provider'] = $_POST['provider'];
        
    }
    
    public function searchIndex()
    {
        $output['query'] = 'Unit';
        $output['suggestions'] = $this->first_model->getListSearchIndexes($_POST['query'], CODE_CATE);
        echo json_encode($output);
        
    }
    
    public function sort_membership()
    {
        switch($_POST['column']) {
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
    
    public function searchCompany()
    {
        $output['query'] = 'Unit';
        $output['suggestions'] = $this->first_model->getListSearchCompanies($_POST['query'], CODE_CATE);
        echo json_encode($output);
        
    }

}
