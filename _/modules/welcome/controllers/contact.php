<?php

require('_/modules/welcome/controllers/block.php');
require('_/modules/welcome/controllers/class.phpmailer.php');
require('_/modules/welcome/controllers/class.smtp.php');
require('_/modules/welcome/controllers/class.pop3.php');
/* * *******************************************************************************************************************
 * Client  Name ：  IFRC
 * ---------------------------------------------------------------------------------------------------------------------
 * Project Name ：  VNFDB
 * ---------------------------------------------------------------------------------------------------------------------
 * File Name    ：  contact.php 
 * ---------------------------------------------------------------------------------------------------------------------
 * Entry Server ：
 * ---------------------------------------------------------------------------------------------------------------------
 * Called By    ：  System
 * ---------------------------------------------------------------------------------------------------------------------
 * Notice       ：
 * ---------------------------------------------------------------------------------------------------------------------
 * Copyright    ：  IFRC
 * ---------------------------------------------------------------------------------------------------------------------
 * Comment      ：
 * ---------------------------------------------------------------------------------------------------------------------
 * History      ：
 * ---------------------------------------------------------------------------------------------------------------------
 * Version V001 ：  2013.07.8 (LongNguyen)        New Create 
 * ******************************************************************************************************************* */

class Contact extends Welcome {
    /*     * ***********************************************************************************************************
     * Name         ： __construct
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： New  2012.08.14 (LongNguyen)  
     * *************************************************************************************************************** */

    public function __construct()
    {
        parent::__construct();
    }

    /*     * ***********************************************************************************************************
     * Name         ： index
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M001         ： New  2012.08.14 (LongNguyen)  
     * *************************************************************************************************************** */

    public function index()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->mhome->addNewsLetter($this->input->post('email')) == 1)
            {
                $this->output->set_output('ok');
            }
        }
        else
        {
            if ($this->input->post())
            {
                $this->data->input = $this->input->post();
                
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $message = $this->input->post('message');

                if ($this->input->post('captcha') == $this->session->userdata('captcha'))
                {
                    $to = $this->data->config['contact_email'];
                    $subject = "Email contact of {$name} ({$email})";
                    $message = $message;
                    $send = $this->sendmail($to, $to, $name, $subject, $message, $to, $to);
                    echo $send == 1 ? '<script>alert("Send message successfull"); window.location.href="' . base_url() . '"</script>' : '';
                }
                else
                {
                    $this->data->error = 'captcha incorrect';
                }
            }
            $block = new Block;
            $this->data->contact = $block->showContact();
            $this->data->newsletter = $block->newsletter();
            $this->data->partner_right = $block->partner_right();
            $this->data->actualites = $block->actualites();
            $this->session->set_userdata('check', md5(time()));
            $this->template->write_view('content', 'contact', $this->data);
            $this->template->render();
        }
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

}
