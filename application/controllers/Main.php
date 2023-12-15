<?php
class Main extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model("Location_Model");
        $this->load->model("Business_Model");
        $this->load->model("Analytics_Model");
        $this->load->model("Settings_Model");
        $this->load->dbutil();
    }

	public function index()
	{   
        if($this->session->has_userdata("user")){
            $data['account'] = $this->session->userdata("user");
            redirect("main/view");
        }
        /*
        $data['content'] = "map/landing";
        $data['theme'] = $this->Settings_Model->get_selected_theme();
        $data['location'] = $this->Location_Model->get_data();
        $data['business'] = $this->Business_Model->get_data();
        $data['status'] = $this->Business_Model->get_status_count();
        $data['years'] = $this->Business_Model->get_year_count();
        $data['clearance'] = $this->Business_Model->get_clearance_count();
        $data['category'] = $this->Business_Model->get_category_count();
        $data['points'] = $this->Business_Model->get_location_count();

		$this->load->view('template',$data);*/
        if(!$this->dbutil->database_exists($this->db->database) || !$this->db){
            redirect("Install");;
        }else{
            redirect("Account/login");
        }
        
	}

    public function map()
	{
        if($this->session->has_userdata("user")){
            $data['account'] = $this->session->userdata("user");
        }
        $data['content'] = "map/map";
        $data['location'] = $this->Location_Model->get_data();
        $data['business'] = $this->Business_Model->get_data();
        $data['status'] = $this->Business_Model->get_status_count();
        $data['years'] = $this->Business_Model->get_year_count();
        $data['category'] = $this->Business_Model->get_categories();
        $data['points'] = $this->Business_Model->get_location_count();
        $data['barangay'] = $this->Analytics_Model->get_barangay();
        $data['theme'] = $this->Settings_Model->get_selected_theme();
        $data['title'] = "Map";
		$this->load->view('template_admin',$data);
	}

    public function add(){
        if($this->session->has_userdata("user")){
            $data['content'] = "map/add";
            
            $this->load->view('template',$data);   
        }else{
            $this->load->view('others/trespass'); 
        }
    }

    public function business($id){
        $data['content'] = "business/view";
        $data['location'] = $this->Location_Model->get_datum($id);
        $data['building'] = $this->Business_Model->get_building($id);
        $data['id'] = $id;
		$this->load->view('template',$data);   
    }

    public function edit($id){
        if($this->session->has_userdata("user")){
            $data['content'] = "map/edit";
            $data['pid'] = $id;
            $data['location'] = $this->Location_Model->get_datum($id);
            $this->load->view('template',$data);   
        }else{
            $this->load->view('others/trespass'); 
        }
    }

    public function view(){
        if($this->session->has_userdata("user")){
            $data['content'] = "map/view";
            $data['location'] = $this->Location_Model->get_data();
            $data['business'] = $this->Business_Model->get_data();
            $data['brgy_date'] = $this->Analytics_Model->get_barangay_date();
            $data['barangay'] = $this->Analytics_Model->get_barangay();
            $data['theme'] = $this->Settings_Model->get_selected_theme();
            $data['title'] = "Dashboard";
            $data['status'] = $this->Business_Model->get_status_count();
            $this->load->view('template_admin',$data);
        }else{
            $this->load->view('others/trespass'); 
        }
    }

    public function custom(){
        if($this->session->has_userdata("user")){
            $data['content'] = "business/display_custom";
            $data['allow'] = $this->Settings_Model->get_allowed();
            $data['title'] = "";
            $data['dump'] = $this->input->post();
            $data['status'] = $this->Business_Model->get_status_count();
            $data['theme'] = $this->Settings_Model->get_selected_theme();
            $this->load->view('template_admin',$data);
        }else{
            $this->load->view('others/trespass'); 
        }
    }

    public function properties(){
        if($this->session->has_userdata("user")){
            $data['content'] = "business/location";

            if(isset($_GET['search'])){
                $data['location'] = $this->Location_Model->get_search($_GET['search']);
            }else{
                $data['location'] = $this->Location_Model->get_data();
            }
            $data['status'] = $this->Business_Model->get_status_count();
            $data['title'] = "Locations";
            $data['theme'] = $this->Settings_Model->get_selected_theme();
            
            $this->load->view('template_admin',$data);
        }else{
            $this->load->view('others/trespass'); 
        }
    }

    public function find($num){
        $search = $this->Location_Model->get_search($num);
        echo json_encode($search);
    }

    public function address($num){
        $search = $this->Location_Model->get_address($num);
        echo json_encode($search);
    }

    public function businesses(){
        if($this->session->has_userdata("user")){
            
            $data['content'] = "business/business";

            if(isset($_GET['search'])){
                $data['business'] = $this->Business_Model->search($_GET['search']);
            }else{
                $data['business'] = $this->Business_Model->get_data();
            }
            $data['status'] = $this->Business_Model->get_status_count();
            $data['title'] = "Businesses";

            $data['pin'] = $this->Business_Model->get_pin();
            $data['address'] = $this->Business_Model->get_address();
            $data['category'] = $this->Business_Model->get_categories();
            $data['theme'] = $this->Settings_Model->get_selected_theme();

            $this->load->view('template_admin',$data);
        }else{
            $this->load->view('others/trespass'); 
        }
    }

    public function display($num){
        if($this->session->has_userdata("user")){
            $data['content'] = "business/display";
            $data['business'] = $this->Business_Model->get_business($num);
            $data['location'] = $this->Location_Model->get_datum($this->Business_Model->get_business($num)->building_id);
            $data['status'] = $this->Business_Model->get_status_count();
            
            $data['owner'] = $this->Business_Model->get_owner($this->Business_Model->get_business($num)->owner_id);
            $data['address'] = $this->Business_Model->get_business_address($this->Business_Model->get_business($num)->address);
            
            $data['title'] = "";
            $data['theme'] = $this->Settings_Model->get_selected_theme();
            $this->load->view('template_admin',$data);
        }else{
            $this->load->view('others/trespass'); 
        }
    }

     public function look($id)
	{
        if($this->session->has_userdata("user")){
            $data['content'] = "business/display_location";
            $data['address'] = $this->Business_Model->get_business_location($id);
            $data['location'] = $this->Location_Model->get_datum($id);
            $data['business'] = $this->Business_Model->get_building($id);
            $data['status'] = $this->Business_Model->get_status_count();
            
            $data['title'] = "";
            $data['theme'] = $this->Settings_Model->get_selected_theme();
            $this->load->view('template_admin',$data);
        }else{
            $this->load->view('others/trespass'); 
        }
	}

    public function report()
	{
        if($this->session->has_userdata("user")){
            $data['content'] = "settings/report";
            $data['theme'] = $this->Settings_Model->get_selected_theme();
            $data['status'] = $this->Business_Model->get_status_count();
            $data['title'] = "Report";
            $this->load->view('template_admin',$data);
        }else{
            $this->load->view('others/trespass'); 
        }
	}

    public function test(){
        $data['content'] = "others/test";
        $data['theme'] = $this->Settings_Model->get_selected_theme();
        $data['status'] = $this->Business_Model->get_status_count();
        $data['title'] = "Testing";
        $data['test'] = $this->Business_Model->get_status_from_text("Waiting");
        $this->load->view('template_admin',$data);
    }
}

