<?php
class Settings extends CI_Controller {
    
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
        if($this->session->has_userdata("user")){
            $data['content'] = "settings/settings";
            $data['status'] = $this->Business_Model->get_status_count();
            $data['title'] = "Settings";
            $data['themes'] = $this->Settings_Model->get_theme();
            $data['theme'] = $this->Settings_Model->get_selected_theme();
            $data['allow'] = $this->Settings_Model->get_allowed();
            $this->load->view('template_admin',$data);
        }else{
            $this->load->view('others/trespass'); 
        }
        
	}

    public function categories()
	{   
        if($this->session->has_userdata("user")){
            $data['content'] = "settings/categories";
            if(isset($_GET['search'])){
                $data['categories'] = $this->Settings_Model->get_categories($_GET['search']);
            }else{
                $data['categories'] = $this->Settings_Model->get_categories("");
            }
            $data['theme'] = $this->Settings_Model->get_selected_theme();
            $data['status'] = $this->Business_Model->get_status_count();
            $data['title'] = "Settings";
            $this->load->view('template_admin',$data);
        }else{
            $this->load->view('others/trespass'); 
        }
	}

    public function types()
	{   
        if($this->session->has_userdata("user")){
            $data['content'] = "settings/types";
            if(isset($_GET['search'])){
                $data['types'] = $this->Settings_Model->get_types($_GET['search']);
            }else{
                $data['types'] = $this->Settings_Model->get_types("");
            }
            $data['theme'] = $this->Settings_Model->get_selected_theme();
            $data['status'] = $this->Business_Model->get_status_count();
            $data['title'] = "Settings";
            $this->load->view('template_admin',$data);
        }else{
            $this->load->view('others/trespass'); 
        }
	}

    public function barangay()
	{   
        if($this->session->has_userdata("user")){
            $data['content'] = "settings/barangay";
            if(isset($_GET['search'])){
                $data['barangay'] = $this->Settings_Model->get_barangay($_GET['search']);
            }else{
                $data['barangay'] = $this->Settings_Model->get_barangay("");
            }
            $data['theme'] = $this->Settings_Model->get_selected_theme();
            $data['status'] = $this->Business_Model->get_status_count();
            $data['title'] = "Settings";
            $this->load->view('template_admin',$data);
        }else{
            $this->load->view('others/trespass'); 
        }
	}

    public function theme()
	{   
        if($this->session->has_userdata("user")){
            $data['content'] = "settings/theme";
            if(isset($_GET['search'])){
                $data['themes'] = $this->Settings_Model->get_theme($_GET['search']);
            }else{
                $data['themes'] = $this->Settings_Model->get_theme("");
            }
            $data['theme'] = $this->Settings_Model->get_selected_theme();
            $data['status'] = $this->Business_Model->get_status_count();
            $data['title'] = "Settings";
            $this->load->view('template_admin',$data);
        }else{
            $this->load->view('others/trespass'); 
        }
	}

    public function status()
	{   
        if($this->session->has_userdata("user")){
            $data['content'] = "settings/status";
            if(isset($_GET['search'])){
                $data['statuses'] = $this->Settings_Model->get_status($_GET['search']);
            }else{
                $data['statuses'] = $this->Settings_Model->get_status("");
            }
            $data['theme'] = $this->Settings_Model->get_selected_theme();
            $data['status'] = $this->Business_Model->get_status_count();
            $data['title'] = "Settings";
            $this->load->view('template_admin',$data);
        }else{
            $this->load->view('others/trespass'); 
        }
	}

    public function export($search){
        $this->Settings_Model->export_csv($search);
        //redirect("main/businesses");
    }

    public function backup(){
        $this->Settings_Model->backup();
        redirect("settings");
    }

    public function display(){
        if($this->session->has_userdata("user")){
            $data['content'] = "business/display";
            $data['theme'] = $this->Settings_Model->get_selected_theme();
            $data['business'] = $this->Business_Model->get_business($num);
            $data['location'] = $this->Location_Model->get_datum($this->Business_Model->get_business($num)->building_id);
            $data['status'] = $this->Business_Model->get_status_count();
            
            $data['owner'] = $this->Business_Model->get_owner($this->Business_Model->get_business($num)->owner_id);
            $data['address'] = $this->Business_Model->get_business_address($this->Business_Model->get_business($num)->address);
            
            $data['title'] = "";
            $this->load->view('template_admin',$data);
        }else{
            $this->load->view('others/trespass'); 
        }
    }

    public function add_category(){
        $this->Settings_Model->add_category($this->input);
        redirect("settings");
    }

    public function add_type(){
        $this->Settings_Model->add_type($this->input);
        redirect("settings");
    }

    public function add_barangay(){
        $this->Settings_Model->add_barangay($this->input);
        redirect("settings");
    }

    public function add_theme(){
        $this->Settings_Model->add_theme($this->input);
        redirect("settings");
    }
    public function add_status(){
        $this->Settings_Model->add_status($this->input);
        redirect("settings");
    }

    public function edit_category($id){
        $this->Settings_Model->edit_category($id,$this->input);
        redirect("settings");
    }
    public function edit_type($id){
        $this->Settings_Model->edit_type($id,$this->input);
        redirect("settings");
    }
    public function edit_barangay($id){
        $this->Settings_Model->edit_barangay($id,$this->input);
        redirect("settings");
    }
    public function edit_theme($id){
        $this->Settings_Model->edit_theme($id,$this->input);
        redirect("settings");
    }
    public function edit_status($id){
        $this->Settings_Model->edit_status($id,$this->input);
        redirect("settings");
    }
    public function edit_allow($id){
        $this->Settings_Model->edit_allowed($id,$this->input);
        redirect("settings");
    }

    public function remove_category($id){
        $this->Settings_Model->remove_categories($id);
        redirect("settings");
    }

    public function remove_type($id){
        $this->Settings_Model->remove_types($id);
        redirect("settings");
    }

    public function remove_barangay($id){
        $this->Settings_Model->remove_barangay($id);
        redirect("settings");
    }
    public function remove_theme($id){
        $this->Settings_Model->remove_theme($id);
        redirect("settings");
    }

    public function save_theme($id){
        $this->Settings_Model->save_theme($id);
        redirect("settings");
    }
}

