<?php
class Business extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model("Location_Model");
        $this->load->model("Business_Model");
        $this->load->model("Settings_Model");
        $this->load->dbutil();
    }

	public function index()
	{
      
	}

    public function search($num){
        
        $search = $this->Business_Model->get_search($num);
        $temp = array();
        foreach($search as $row){
            array_push($temp,$row->number);
        }
        echo json_encode($temp);
    }

    public function find($num){
        $search = $this->Business_Model->get_business($num);
        echo json_encode($search);
    }

    public function findowner($num){
        $search = $this->Business_Model->get_owner($num);
        echo json_encode($search);
    }

    public function add($id){
        if($this->session->has_userdata("user")){
            $data['content'] = "business/add";
            $data['category'] = $this->Business_Model->get_categories();
            $data['id'] = $id;
            $this->load->view('template',$data);   
        }else{
            $this->load->view('others/trespass'); 
        }
    }

    public function edit($id){
        if($this->session->has_userdata("user")){
            $data['content'] = "business/edit";
            $data['business'] = $this->Business_Model->get_business($id);
            $data['category'] = $this->Business_Model->get_categories();
            $data['id'] = $id;
            $this->load->view('template',$data);   
        }else{
            $this->load->view('others/trespass'); 
        }
    }

    public function add_business(){
		$this->Business_Model->add_data($this->input);
        redirect(base_url());
    }

    public function approve_business($id){
        $this->Business_Model->approve($id);
        redirect("main/businesses");
    }

    public function delete_business($id){
		$this->Business_Model->delete_data($id);
        redirect("main/businesses");
    }

    public function edit_business($id){
		$this->Business_Model->edit_data($id,$this->input);
        //redirect(base_url());
    }

    public function add_address(){
		$this->Business_Model->add_address($this->input);
        redirect(base_url());
    }

    public function delete_address($id){
		$this->Business_Model->delete_address($id);
        //redirect(base_url());
    }

    public function edit_address($id){
		$this->Business_Model->edit_address($id,$this->input);
        //redirect(base_url());
    }

    public function add_owner(){
		$this->Business_Model->add_owner($this->input);
        redirect(base_url());
    }

    public function delete_owner($id){
		$this->Business_Model->delete_owner($id);
        //redirect(base_url());
    }

    public function edit_owner($id){
		$this->Business_Model->edit_owner($id,$this->input);
        //redirect(base_url());
    }
}


