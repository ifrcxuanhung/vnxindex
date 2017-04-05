<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends Admin {

    function __construct() {
        parent::__construct();
        $this->load->model('Document_model', 'document_model');
        $this->load->helper(array('my_array_helper', 'form'));
    }

    function upload_documents() {
        $this->template->write_view('content', 'document/upload_documents', $this->data);
        $this->template->write('title', 'Upload Documents');
        $this->template->render();
    }
    
    function papers() {
        if(!$this->input->is_ajax_request()){
            $this->template->write_view('content', 'document/papers', $this->data);
            $this->template->write('title', 'Document Papers');
            $this->template->render();
        }else{
            $this->db->select('a.*, b.name');
            $this->db->from('vfdb_documents_papers as a');
            $this->db->join('vfdb_documents_journals as b','a.journal = b.refjournal','left');
            $data = $this->db->get()->result_array();
            foreach($data as $key => $item){
                foreach($item as $k => $v){
                    if($k != 'reference' && $k != 'abstract' && $k != 'keywords' && $k != 'pdf' && $k != 'name' && $k != 'id'){
                        if($k == 'journal'){
                            $response['aaData'][$key][] = '<a class="with-tip" title="' . $item['name'] . '" href="">'.$v.'</a>';
                        }else{
                            $response['aaData'][$key][] = $v;
                        }
                    }
                }
                if($item['keywords'] != ''){
                    $keywords = '<li class="green-keyword"><a class="with-tip" title="' . $item['keywords'] . '" href="#">Keywords</a></li>';
                }else{
                    $keywords = '';
                }
                if($item['abstract'] != ''){
                    $abstract = '<li class="green-keyword"><a class="with-tip" title="' . $item['abstract'] . '" href="#">Abstract</a></li>';
                }else{
                    $abstract = '';
                }
                if($item['pdf'] != ''){
                    $pdf = '<li class="green-keyword"><a class="with-tip" title="' . $item['pdf'] . '" href="'.admin_url().'document/download_pdf/id/'.$item['id'].'">PDF</a></li>';
                }else{
                    $pdf = '';
                }
                $response['aaData'][$key][] = '<ul class="keywords" style="text-align: center;">'.$keywords.' '.$abstract.' '.$pdf.'</ul>';
                $response['aaData'][$key][] = '<ul class="keywords" style="text-align: center;">
                    <li class="green-keyword"><a href="' . admin_url() . 'document/edit/parem/papers_' . $item['id'] . '" title="Edit" class="with-tip">Edit</a></li>
                            <li class="red_fx_keyword"><a href="' . admin_url() . 'document/delete/" title="Delete" class="with-tip delete" pid="' . $item['id'] . '" ptable="vfdb_documents_papers">Delete</a></li>';
            }
            $this->output->set_output(json_encode($response));
        }
    }
    
    function authors() {
        if(!$this->input->is_ajax_request()){
            $this->template->write_view('content', 'document/authors', $this->data);
            $this->template->write('title', 'Document Authors');
            $this->template->render();
        }else{
            $data = $this->db->get('vfdb_documents_authors')->result_array();
            foreach($data as $key => $item){
                foreach($item as $k => $v){
                    if($k != 'id' && $k!='refauthor' && $k != 'email'){
                        $response['aaData'][$key][] = $v;
                    }
                }     
                if($item['email'] != ''){
                    $email = '<li class="green-keyword"><a class="with-tip" title="' . $item['email'] . '" href="#">Email</a></li>';
                }else{
                    $email = '';
                }
                $response['aaData'][$key][] = '<ul class="keywords" style="text-align: center;">'.$email.'</ul>';
                $response['aaData'][$key][] = '<ul class="keywords" style="text-align: center;">
                    <li class="green-keyword"><a href="' . admin_url() . 'document/edit/parem/authors_' . $item['id'] . '" title="Edit" class="with-tip">Edit</a></li>
                            <li class="red_fx_keyword"><a href="' . admin_url() . 'document/delete/" title="Delete" class="with-tip delete" pid="' . $item['id'] . '" ptable="vfdb_documents_authors">Delete</a></li>';
                
            }
            $this->output->set_output(json_encode($response));
        }
    }
    
    function journals() {
        if(!$this->input->is_ajax_request()){
            $this->template->write_view('content', 'document/journals', $this->data);
            $this->template->write('title', 'Document Journals');
            $this->template->render();
        }else{
            $data = $this->db->get('vfdb_documents_journals')->result_array();
            foreach($data as $key => $item){
                foreach($item as $k => $v){
                    if($k != 'id' && $k != 'refjournal' && $k != 'website'){
                        $response['aaData'][$key][] = $v;
                    }
                }   
                if($item['website'] != ''){
                    $website = '<li class="green-keyword"><a class="with-tip" target="_blank" title="' . $item['website'] . '" href="' . $item['website'] . '">Website</a></li>';
                }else{
                    $website = '';
                }
                $response['aaData'][$key][] = '<ul class="keywords" style="text-align: center;">'.$website.'</ul>';
                $response['aaData'][$key][] = '<ul class="keywords" style="text-align: center;">
                    <li class="green-keyword"><a href="' . admin_url() . 'document/edit/parem/journals_' . $item['id'] . '" title="Edit" class="with-tip">Edit</a></li>
                            <li class="red_fx_keyword"><a href="' . admin_url() . 'document/delete/" title="Delete" class="with-tip delete" pid="' . $item['id'] . '" ptable="vfdb_documents_journals">Delete</a></li>';
                
            }
            $this->output->set_output(json_encode($response));
        }
    }
    
    function process_upload_documents(){
        if ($this->input->is_ajax_request()) {
            $from = microtime(true);
            set_time_limit(0);
            $path = "//LOCAL/INDEXIFRC/IFRCVN/VFDB/DOCUMENTS/";
            $data = file($path."upload_documents.txt");
            array_shift($data);
            foreach($data as $item){
                $data_array = explode("\t",$item);
                $filename = $path."TEXT/".$data_array[0];
                $data_1 = file($filename);
                $data_final = array();
                foreach($data_1 as $dt1){
                    $data_1_1 = explode("\t",$dt1);
                    $data_final_11 = array();
                    foreach($data_1_1 as $dt11){
                        if(strpos($dt11,'-') || strpos($dt11,'@') || strpos($dt11,'.') || strpos($dt11,'://')){
                            $data_final_11[] = trim($dt11);
                        }else{
                            $dt11 = utf8_convert_url($dt11, " "); 
                            $dt11 = str_replace(' s',' is',$dt11);
                            $dt11 = str_replace(' pdf','.pdf',$dt11);
                            $data_final_11[] = trim($dt11);
                        }
                    }
                    $data_final[] = implode("\t",$data_final_11);
                }
                $content = implode("\r\n",$data_final);
                $fp = fopen($filename, "w"); 
		fwrite($fp, $content); 
		fclose($fp);
                $table = $data_array[1];
                if(file_exists($filename)){
                    $this->document_model->load_data($filename,$table);
                }
            }
            $path_2 = "//LOCAL/INDEXIFRC/IFRCVN/VFDB/DOCUMENTS/PAPERS/SOURCE/";
            $data_2 = glob($path_2."*.pdf");
            foreach($data_2 as $dt2){
                $filename_old = basename($dt2,'.pdf');
                $filename_old = utf8_convert_url($filename_old, " ");
                $filename_old = str_replace(' s',' is',$filename_old);
                $file = $path_2.$filename_old.'.pdf';
                rename($dt2, $file);
                $filename_new = utf8_convert_url($filename_old);
                $file_new = $path_2.'../DOWNLOAD/'.$filename_new.'.pdf';
                copy($file, $file_new);
            }
            $total = microtime(true) - $from;
            $response[0]['time'] = round($total, 2);
            $response[0]['task'] = 'Upload Document';
            echo json_encode($response);
        }
    }
    
    public function download_pdf(){
        $id = $this->uri->segment(5);
        $file = $this->document_model->get_filename($id);
        $file_pdf = str_replace(' ','-',trim($file['pdf']));
        $filename = '//LOCAL/INDEXIFRC/IFRCVN/VFDB/DOCUMENTS/PAPERS/DOWNLOAD/'.$file_pdf;
        header("Pragma: public");
        header("Expires: 0"); 
        header("Pragma: no-cache"); 
        header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");  
        header("Content-Type: application/force-download"); 
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-disposition: attachment; filename=' . basename($filename));
        header("Content-Type: application/pdf");
        header("Content-Transfer-Encoding: binary");
        header('Content-Length: ' . filesize($filename));
        @readfile($filename);
        exit(0);
    }
    
    public function edit(){
        $parem = $this->uri->segment(5);
        $arr_parem = explode('_',$parem);
        $id = $arr_parem[1];
        $name = $arr_parem[0];
        $table = "vfdb_documents_".$name;
        $this->data->input = $this->document_model->get_data($id,$table);
        if($this->input->post()){
            $now = time();
            $this->data->input = $this->input->post();
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('journal', 'Journal', 'required');
            if($this->form_validation->run()){
                $this->document_model->edit($this->data->input,$id,$table);
                redirect(admin_url() . 'document/'.$name);
            }
        }
        $this->template->write_view('content', 'document/edit', $this->data);
        $this->template->write('title', 'Edit Document');
        $this->template->render();
    }
    
    public function delete(){
        if($this->input->is_ajax_request()){
            $id = $this->input->post('id');
            $table = $this->input->post('table');
            $this->document_model->delete($id,$table);
            $this->output->set_output('1');
        }
    }
}