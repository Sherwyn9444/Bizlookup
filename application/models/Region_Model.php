<?php
class Region_Model extends CI_Model {

	public function get_data($search = ""){
        $query = $this->db->get("region");
        return $query->result();
    }

    public function add($data){
        $this->db->insert("region",array(
            "name" => $data->post("name"),
            "type" => $data->post("type"),
            "coordinate" => $data->post("coordinates")
        ));
    }

    public function edit($id,$data){
        $this->db->where("id",$id);
        $this->db->update("region",array(
            "name" => $data->post("name"),
            "type" => $data->post("type"),
            "coordinate" => $data->post("coordinates")
        ));
    }

    public function delete($id){
        $this->db->delete("region",array(
            "id" => $id,
        ));
    }

    public function get_barangay(){
        $query = $this->db->get("barangay");
        return $query->result();
    }

}
