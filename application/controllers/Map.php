<?php
class Map extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model("Location_Model");
        $this->load->model("Business_Model");
        $this->load->model("Settings_Model");
    }

	public function index()
	{
      
	}

    public function add_data(){
        $this->Location_Model->add_data($this->input);
    }

    public function edit_data(){
        $this->Location_Model->edit_data($this->input);
    }
    
    public function add(){
        $pid = $this->input->post("pid");
        if(!isset($pid) || $pid == ""){
            

            $config['upload_path']          = FCPATH.'photos';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['file_name']        = $this->input->post("name");
            $config['max_size']             = 20480;
            $config['max_width']            = 2048;
            $config['max_height']           = 2048;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('image'))
            {
                redirect(site_url("main/properties"));
            }
            else
            {
                redirect(site_url("main/properties"));
            }
        }else{
            
            

            if(!file_exists(base_url().'photos/'.str_replace(' ', '',$this->input->post("name")))){
                $config['upload_path']          = FCPATH.'photos';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['file_name']        = str_replace(' ', '',$this->input->post("name"));
                $config['max_size']             = 20480;
                $config['max_width']            = 2048;
                $config['max_height']           = 2048;
                $config['overwrite']           = true;
        
                $this->load->library('upload', $config);
        
                if ( ! $this->upload->do_upload('image'))
                {
                    redirect(site_url("main/properties"));
                }
                else
                {
                    redirect(site_url("main/properties"));
                }
            }else{
                redirect(site_url("main/properties"));
            }
        }
        
    }

    public function delete($id){
		$this->Location_Model->delete_data($id);
        redirect(site_url("main/properties"));
    }

    public function edit(){
        $id = $this->input->post("edit_pid");
		$this->Location_Model->edit_data($id,$this->input);

        if(!file_exists(base_url().'photos/'.str_replace(' ', '',$this->input->post("name")))){
            $config['upload_path']          = FCPATH.'photos';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['file_name']        = str_replace(' ', '',$this->input->post("name"));
            $config['max_size']             = 20480;
            $config['max_width']            = 2048;
            $config['max_height']           = 2048;
            $config['overwrite']           = true;
    
            $this->load->library('upload', $config);
    
            if ( ! $this->upload->do_upload('image'))
            {
                redirect(site_url("main/view"));
            }
            else
            {
                redirect(site_url("main/view"));
            }
        }else{
            redirect(site_url("main/view"));
        }
    }
}
