<?php
class Account extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model("Location_Model");
        $this->load->model("Business_Model");
        $this->load->model("Account_Model");
        $this->load->model("Settings_Model");
    }

	public function index()
	{
      
	}

    public function view(){
        if($this->session->has_userdata("user")){
            $data['content'] = "account/view";
            if(isset($_GET['search'])){
                $data['accounts'] = $this->Account_Model->get_search($_GET['search']);
            }else{
                $data['accounts'] = $this->Account_Model->get_data();
            }
            $data['theme'] = $this->Settings_Model->get_selected_theme();
            $data['title'] = "Accounts";
            $data['status'] = $this->Business_Model->get_status_count();
            $this->load->view('template_admin',$data); 
        }else{
            $this->load->view('others/trespass'); 
        }
    }
    public function login(){
        $data['content'] = "account/login";
        $data['theme'] = $this->Settings_Model->get_selected_theme();
		$this->load->view('template_base',$data);   
    }

    public function confirm(){
        //$this->Business_Model->get_categories();
        $account = $this->Account_Model->get_user($this->input->post('username'),$this->input->post('password'));
        if($account){
            $this->session->set_userdata(array("user"=>$account));
            redirect("main/view");
        }else{
            redirect("account/login");
        }
    }

    public function logout(){
        $this->session->unset_userdata("user");
        redirect("main");   
    }

    public function add(){
        if($this->session->has_userdata("user")){
            $data['content'] = "account/add";
            $this->load->view('template_admin',$data); 
        }else{
            $this->load->view('others/trespass'); 
        }
    }

    public function insert(){
        $this->Account_Model->add_data($this->input);
        redirect('Account/view');
    }

    public function edit($id){
        if($this->session->has_userdata("user")){
            $data['content'] = "account/edit";
            $data['account'] = $this->Account_Model->get($id);
            $data['account_id'] = $id;
            $this->load->view('template',$data); 
        }else{
            $this->load->view('others/trespass'); 
        }
    }

    public function change($id){
        if($this->session->has_userdata("user")){
            $this->Account_Model->edit_data($id,$this->input);
            redirect('Account/view');
        }
    }

    public function remove($id){
        if($this->session->has_userdata("user")){
            $this->Account_Model->delete_data($id);
            redirect('Account/view');
        }
    }
}
