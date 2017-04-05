<?php

class Test extends Welcome {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->template->write_view('content', 'test', $this->data);
        $this->template->render();
    }

    public function aabc(){
        echo 12322223;
    }

}

/* End of file welcome.php */
    /* Location: ./application/controllers/welcome.php */