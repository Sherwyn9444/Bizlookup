<?php
class Install extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model("Location_Model");
        $this->load->model("Business_Model");
        $this->load->model("Settings_Model");
        $this->load->model("Install_Model");
        $this->load->dbutil();
    }

	public function index()
	{
        $this->load->view('install');
	}

    public function set()
	{
        $this->Install_Model->install($this->input);
        //$this->load->view('install');
	}

    public function set_triggers()
	{
        $this->Install_Model->triggers();
        //$this->load->view('install');
	}

    public function set_views()
	{
        $this->Install_Model->views();
        //$this->load->view('install');
	}
}


