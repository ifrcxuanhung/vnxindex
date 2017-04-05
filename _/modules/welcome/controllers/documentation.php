<?php
require('_/modules/welcome/controllers/block.php');
/* * *******************************************************************************************************************
 * Client  Name ：  IFRC
 * ---------------------------------------------------------------------------------------------------------------------
 * Project Name ：  VNFDB
 * ---------------------------------------------------------------------------------------------------------------------
 * File Name    ：  home.php 
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
class Documentation extends Welcome {
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
    function __construct() {
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
     * M001         ： New  2013-19-12 (TienPham)  
     * *************************************************************************************************************** */
    public function index($code_cate = "", $page = 1) {
        $this->load->Model('home_model', 'mhome');
        $this->load->model('article_model', 'marticle');
        $this->load->model('category_model', 'mcategory');
        $this->load->library('ion_auth');
        $post_per_page =  $this->config->item('post_per_page');
        if ($this->input->is_ajax_request()) {
            if ($this->mhome->addNewsLetter($this->input->post('email')) == 1) {
                $this->output->set_output('ok');
            }
        } else {
            $list_category = $this->mcategory->getCategoryByCodeParent('DOCUMENTATION');
            $this->data->list_category = $list_category['curent'];
            
            $this->data->code_cate = $code_cate;
            if($code_cate != "")
            {
                $num_page = $this->marticle->num_row_article_cate($code_cate);
                $page = round($page);$page = max(1,$page);$page = min($num_page,$page);
                $this->data->num_page = $num_page;
                $this->data->curent_page = $page;
                
                $start = ($page - 1) * $post_per_page;
                $limit = "$start,$post_per_page";
                $list_document = $this->marticle->list_article_cate($code_cate, $limit);
            }
            else
            {
                $num_page = $this->marticle->num_row_article_cate('DOCUMENTATION');
                $page = round($page);$page = max(1,$page);$page = min($num_page,$page);
                $this->data->num_page = $num_page;
                $this->data->curent_page = $page;
                
                $start = ($page - 1) * $post_per_page;
                $limit = "$start,$post_per_page";
                $list_document = $this->marticle->list_article_cate('DOCUMENTATION', $limit);
            }
            $list_document = $list_document['curent'];
            $this->data->list_document = $list_document;
            
            $set = $this->db->get('setting')->result_array();
            foreach($set as $value)
            {
                $setting[$value['key']] = $value['value'];
            }
            
            $this->data->download_documents = $setting['download_documents'];
            $this->data->allow_download = 0;
            
            if($setting['download_documents'] != 0)
            {
                if($setting['download_documents'] == 1)//Đăng nhập mới cho phép download
                {
                    $user_id = @$this->session->userdata('user_id');
                    if($user_id != "")
                    {
                        $this->data->allow_download = 1;
                    }
                    else
                    {
                        $this->data->allow_download = 0;
                    }
                    
                }
                if($setting['download_documents'] == 2)//User thuoc Group VIP va ADMIN
                {
                    $user_id = @$this->session->userdata('user_id');
                    $users_groups = $this->ion_auth_model->get_users_groups($user_id)->result_array();
                    $group_id = (isset($users_groups[0]['id'])) ? $users_groups[0]['id'] : '0';
                    if(check_service($group_id, "", 'admin'))
                    {
                        $this->data->allow_download = 1;
                    }
                    else
                    {
                        $this->data->allow_download = 0;
                    }
                }
            }
            

            $this->template->write_view('content', 'documentation', $this->data);
            $this->template->render();
        }
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
     * M001         ： New  2013.12.03 (TienPham)  
     * *************************************************************************************************************** */
    public function detail_alex($user_id = 0) {
        $this->load->model('vfdb_user_model', 'user_model');
        $this->load->model('research_model');
        $info_user = $this->user_model->getInfoUserById($user_id);
        $this->data->info_user = isset($info_user[0]) ? $info_user[0] : "";
        
        $research_category = $this->research_model->getAllCategoryResearch();
        $research_category = $research_category['current'];
        foreach($research_category as $k=>$v)
        {
            $research = $this->research_model->getResearchByIdUser($user_id, $v['category_code']);
            $data[$v['category_code']] = $research['current'];
        }
        $this->data->list_research = $data;
        $this->data->user_id = $user_id;
        $this->template->set_template('researchers');
        $this->template->write_view('content', 'research/researchers_detail', $this->data);
        $this->template->render();
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
    public function detail($user_id = 0) {
        $this->load->Model('home_model', 'mhome');
        if ($this->input->is_ajax_request()) {
            if ($this->mhome->addNewsLetter($this->input->post('email')) == 1) {
                $this->output->set_output('ok');
            }
        } else {
            $block = new Block;
            $this->load->model('vfdb_user_model', 'user_model');
            $this->load->model('research_model');
            $info_user = $this->user_model->getInfoUserById($user_id);
            $this->data->info_user = isset($info_user[0]) ? $info_user[0] : "";
            
            $this->data->user_id = $user_id;
            $list_research = $this->research_model->getAllResearchByIdUser($user_id);
            //echo '<pre>'; print_r($list_research['current']);exit;
            $this->data->list_research = $list_research['current'];

            
            $this->template->write_view('content', 'research/researchers_detail', $this->data);
            $this->template->render();
        }
  
        
        
    }
    
    public function add()
    {
        $this->load->model('research_model', 'research');
        $category = $this->research->getAllCategoryResearch();
        $this->data->category = $category['current'];
        //echo $this->input->post('long-description-vn');
        if ($this->input->post('save', TRUE)) {
            $file_name = "";
            $file=$_FILES['upload_file'];
        	if($file['name']!="")
        	{
        		$file_name=$file['name'];
        		move_uploaded_file($file['tmp_name'],'assets/upload/files/research/'.$file_name);
        	}
            $research_method = $this->input->post('research_method');
            $research_id = $this->input->post('research_id');
            $data = array(
                        'status' => $this->input->post('status'),
                        'sort_order' => $this->input->post('sort_order'),
                        'date_added' => date("Y-m-d H:i:s"),
                        'date_modified' => date("Y-m-d H:i:s"),
                        'user_id' => $this->session->userdata('user_id'),
                        'time_start' => $this->input->post('time_start'),
                        'time_end' => $this->input->post('time_end'),
                        'file_url' => $file_name
                        );
            if($research_method == "add")
                $research_id = $this->research->add_research($data);
            else{
                unset($data['date_added']);
                if($file_name == "")
                {
                    unset($data['file_url']);
                }
                else
                {
                    $upload_file_old = $this->input->post('upload_file_old');
                    if(file_exists('assets/upload/files/research/'.$upload_file_old))
                	{
                		unlink('assets/upload/files/research/'.$upload_file_old);
                	}
                }
                $this->research->update_research($research_id, $data);
            }
            foreach($this->data->list_language as $lang)
            {
                $lang_code = $lang['code'];
                $data2 = array(
                        'research_id' => $research_id,
                        'lang_code' => $lang_code,
                        'title' => $this->input->post("title-$lang_code"),
                        'author' => $this->input->post("author-$lang_code"),
                        'journal_conference' => $this->input->post("journal-conference-$lang_code"),
                        'description' => $this->input->post("description-$lang_code"),
                        'long_description' => $this->input->post("long-description-$lang_code")
                );
                 if($research_method == "add")
                    $this->research->add_research_des($data2);
                else
                    $this->research->update_research_des($research_id, $lang_code, $data2);
            }
            $user_id = $this->session->userdata('user_id');
            $link = base_url().'researchers/detail/'. $user_id .'/abcd.html';
            echo "<script>top.location.href='$link';</script>";
        }
        
        $this->template->set_template('researchers');
        $this->template->write_view('content', 'research/researchers_add', $this->data);
        $this->template->render();
    }
    
    public function edit($research_id = "")
    {
        $this->load->model('research_model', 'research');
        $category = $this->research->getAllCategoryResearch();
        $this->data->category = $category['current'];
        
        $detail_research = $this->research->getOneResearchById($research_id);
        $this->data->detail_research = $detail_research;
        $this->data->research_id = $research_id;

        $this->template->set_template('researchers');
        $this->template->write_view('content', 'research/researchers_add', $this->data);
        $this->template->render();
    }
    
    public function rlist($user_id = "")
    {
        if($this->session->userdata('user_id') == "")
        {
            //echo "<script>alert('Bạn phải đăng nhập mới vô được trang này')</script>";
            $link = base_url().'researchers';
            redirect($link);
        }
            
        $this->load->model('research_model');
        
        $list_research = $this->research_model->getAllResearchByIdUser($user_id);
        $this->data->list_research = $list_research['current'];

        $this->template->set_template('researchers');
        $this->template->write_view('content', 'research/researchers_rlist', $this->data);
        $this->template->render();
    }
    
    public function delete($research_id = "")
    {
        $this->load->model('research_model');
        $this->research_model->delete_research($research_id);
        $link = base_url().'researchers/rlist';
        redirect($link);
    }
    
    public function post($research_id = "")
    {
        $this->load->model('vfdb_user_model', 'user_model');
        $this->load->model('research_model');
        
        $research_post = $this->research_model->getPost($research_id);
        $this->data->research_post = $research_post['current'];
        
        $user_id = $research_post['current']['0']['user_id'];
        $this->data->user_id = $user_id;
        $info_user = $this->user_model->getInfoUserById($user_id);
        $this->data->info_user = $info_user[0];
        
        $relatedPost = $this->research_model->getRelatedPost($user_id, $research_id);
        $this->data->relatedPost = $relatedPost['current'];
        
        $this->template->set_template('researchers');
        $this->template->write_view('content', 'research/researchers_post', $this->data);
        $this->template->render();
    }
    
    public function user()
    {
        $this->load->model('research_model');
        $user_id = $this->session->userdata('user_id');
        $this->data->infoUser = $this->research_model->getAllInfomationUser($user_id);
        //print_r($this->data->infoUser);exit;
        
        if ($this->input->post('save', TRUE))
        {
            $file_name = "";
            $file=$_FILES['upload_image'];
            //print_r($file);exit;
        	if($file['name']!="")
        	{
        		$file_name=time().$file['name'];
        		move_uploaded_file($file['tmp_name'],'assets/upload/files/research/'.$file_name);
        	}
            $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'phone' => $this->input->post('phone'),
                    'date_birth' => $this->input->post('date_birth'),
                    'address' => $this->input->post('address'),
                    'website' => $this->input->post('website'),
                    'image' => $file_name
            );
            
            $user_id = $this->session->userdata('user_id');
            if($file_name == "")
            {
                unset($data['image']);
            }
            else
            {
                $image_user_old = $this->input->post('image_user_old');
                if(file_exists('assets/upload/files/research/'.$image_user_old))
            	{
            		unlink('assets/upload/files/research/'.$image_user_old);
            	}
            }
            $this->research_model->update_user($user_id, $data);
            
            $data2 = array(
                    'nationality' => $this->input->post('nationality'),
                    'university' => $this->input->post('university'),
                    'profile_position' => $this->input->post('profile_position'),
                    'profile' => $this->input->post('profile'),
                    'experience' => $this->input->post('experience'),
                    'specialities' => $this->input->post('specialities')
            );
            $this->research_model->update_user_infomation($user_id, $data2);
            $link = base_url().'researchers';
            //redirect($link);
            echo "<script>top.location.href='$link';</script>";
        }
        
        
        $this->template->set_template('researchers');
        $this->template->write_view('content', 'research/researchers_user', $this->data);
        $this->template->render();
    }
}
