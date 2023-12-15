<?php
class Account_Model extends CI_Model {

	public function get_data(){
        $query = $this->db->get("accounts");
        return $query->result();
    }

    public function get_search($search){
        $this->db->select("*");
        $this->db->from("accounts");
        $this->db->like("id",$search);
        $this->db->or_like("username",$search);
        $this->db->or_like("password",$search);
        $query = $this->db->get();
        return $query->result();
    }

    public function get($id){
        $query = $this->db->get_where("accounts",array("id"=>$id));
        return $query->row();
    }
    public function get_user($username,$password){
        $query = $this->db->get_where("accounts",array("username"=>$username,"password"=>$password));
        return $query->row();
    }

    public function add_data($data){
        $this->db->insert("accounts",array(
            "username" => $data->post("username"),
            "password" => $data->post("password"),
            "type" => "user"
        ));
    }

    public function edit_data($id,$data){
        $this->db->where("id",$id);
        $this->db->update("accounts",array(
            "username" => $data->post("username"),
            "password" => $data->post("password"),
        ));
    }

    public function delete_data($id){
        $this->db->delete("accounts",array(
            "id" => $id,
        ));
    }
}
