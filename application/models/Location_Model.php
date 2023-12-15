<?php
class Location_Model extends CI_Model {

	public function get_data($search = ""){
        $this->db->like("name",$search);
        $this->db->or_like("pin",$search);
        $query = $this->db->get("location");
        return $query->result();
    }

    public function get_all(){
        $query = $this->db->get("location");
        return $query->result();
    }

    public function get_search($search){
        $this->db->like("name",$search);
        $this->db->or_like("pin",$search);
        $this->db->or_like("owner",$search);
        $this->db->or_like("address",$search);
        
        $this->db->select("*");
        $this->db->from("location");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_address($num){
        $query = $this->db->get_where("business_address",array("pin"=>$num));
        return $query->result();
    }

    public function get_datum($id){
        $query = $this->db->get_where("location",array("pin"=>$id));
        return $query->row();
    }

    public function add_data($data){
        $address = "#". $data->post("unitno") + " ";
        if($data->post("street")){
            $address += $data->post("unitno") + " st., ";
        }
        if($data->post("subdivision")){
            $address += $data->post("subdivision") + " Subd., ";
        }
        if($data->post("brgy")){
            $address += "Brgy. ". $data->post("brgy") + ", ";
        }
        if($data->post("city")){
            $address += $data->post("city") + ", ";
        }
        if($data->post("province")){
            $address += $data->post("province") + "";
        }
        
        if($data->post("pid")){
            $this->db->insert("location",array(
                "pin" => $data->post("pid"),
                "name" => $data->post("name"),
                "owner" => $data->post("owner"),
                "address" => $address,
                "x" => $data->post("y"),
                "y" => $data->post("x"),
                "imgpath" => /*FCPATH.'photos\\'.*/base_url().'photos/'.str_replace(' ', '',$data->post("name"))
            ));
        }else{
            $this->db->insert("location",array(
                "name" => $data->post("name"),
                "owner" => $data->post("owner"),
                "address" => $address,
                "x" => $data->post("y"),
                "y" => $data->post("x"),
                "imgpath" => /*FCPATH.'photos\\'.*/base_url().'photos/'.str_replace(' ', '',$data->post("name"))
            ));
        }

        $this->db->insert("business_address",array(
            "pin" => $this->db->insert_id(),
            "bldg_no" => $data->post("houseno"),
            "building_name" => $data->post("buildingname"),
            "unit_no" => $data->post("unitno"),
            "street" => $data->post("street"),
            "barangay" => $data->post("brgy"),
            "subdivision" => $data->post("subdivision"),
            "city" => $data->post("city"),
            "province" => $data->post("province"),
            "tel_no" => $data->post("telno"),
            "email_address" => $data->post("email"),
        ));
    }
    public function delete_data($data){
        $name = $this->db->get_where("location",array("pin"=>$data))->row()->imgpath;
        $extend = substr($name,strrpos($name,"/"));
        $path = "./photos".$extend.".png";
        $this->load->helper("file");
        $yay = unlink($path);
        
        $this->db->delete("location",array(
           "pin" => $data,
        ));
    }

    public function edit_data($data){
        $id = $data->post("pid");
        $address = "#". $data->post("unitno") . " ";
        
        if( $data->post("street") ){
            $address = $address . $data->post("street") . " st., ";
        }
        if($data->post("subdivision")){
            $address = $address . $data->post("subdivision") . " Subd., ";
        }
        if($data->post("brgy")){
            $address = $address . "Brgy. ". $data->post("brgy") . ", ";
        }
        if($data->post("city")){
            $address = $address . $data->post("city") . ", ";
        }
        if($data->post("province")){
            $address = $address . $data->post("province") . "";
        }
        
        

        $this->db->where('pin', $id);
        $this->db->update("location",array(
            "name" => $data->post("name"),
            "owner" => $data->post("owner"),
            "address" => $address,
            "x" => $data->post("y"),
            "y" => $data->post("x"),
            "imgpath" => base_url().'photos/'.str_replace(' ', '',$data->post("name"))
        ));

        $this->db->where('pin', $id);
        $this->db->update("business_address",array(
            "bldg_no" => $data->post("houseno"),
            "building_name" => $data->post("buildingname"),
            "unit_no" => $data->post("unitno"),
            "street" => $data->post("street"),
            "barangay" => $data->post("brgy"),
            "subdivision" => $data->post("subdivision"),
            "city" => $data->post("city"),
            "province" => $data->post("province"),
            "tel_no" => $data->post("telno"),
            "email_address" => $data->post("email"),
        ));
    }
}
