<?php
class Pdf extends Welcome {
    function __construct() {
        parent::__construct();
        $this->load->model('article_model', 'marticle');
    }
    public function index($name = "") {
        $this->load->library('ion_auth');
        
        $set = $this->db->get('setting')->result_array();
        foreach($set as $value)
        {
            $setting[$value['key']] = $value['value'];
        }
        $this->data->download_documents = $setting['download_documents'];
        $allow_download = 0;
        
        if($setting['download_documents'] == 0)
        {
            $allow_download = 1;
        }
        else
        {
            if($setting['download_documents'] == 1)
            {
                $user_id = @$this->session->userdata('user_id');
                if($user_id != "")
                {
                    $allow_download = 1;
                }
            }
            if($setting['download_documents'] == 2)
            {
                $user_id = @$this->session->userdata('user_id');
                $users_groups = $this->ion_auth_model->get_users_groups($user_id)->result_array();
                $group_id = (isset($users_groups[0]['id'])) ? $users_groups[0]['id'] : '0';
                if(check_service($group_id, "", 'admin'))
                {
                   $allow_download = 1;
                }
            }
        }

        if($allow_download == 1)
        {
            //http://localhost/vnxindex//assets/upload/images/pdf/IFRC_VNX_RULES.pdf

			$name = str_replace('.pdf', '.PDF', $name);
            $linkPdf = base_url() .'assets/upload/images/pdf/'. $name;
            echo "<script>window.location = '$linkPdf'</script>";
        }
        else
        {
            $this->template->write_view('content', 'pdf', $this->data);
            $this->template->render();
        }
        
    }
    
}