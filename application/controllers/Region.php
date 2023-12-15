<?php
class Region extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model("Location_Model");
        $this->load->model("Business_Model");
        $this->load->model("Region_Model");
        $this->load->model("Settings_Model");
    }

	public function index()
	{

        $data['content'] = "map/region";
        $data['location'] = $this->Location_Model->get_data();
        $data['business'] = $this->Business_Model->get_data();
        $data['status'] = $this->Business_Model->get_status_count();
        $data['category'] = $this->Business_Model->get_category_count();
        $data['region'] = $this->Region_Model->get_data();
        $data['title'] = "Regions";
        $data['theme'] = $this->Settings_Model->get_selected_theme();
        $data['status'] = $this->Business_Model->get_status_count();
		$this->load->view('template_admin',$data);
	}

    public function add(){
        $this->Region_Model->add($this->input);
    }

    public function edit($id){
        $this->Region_Model->edit($id,$this->input);
    }

    public function delete($id){
        $this->Region_Model->delete($id);
    }

}
