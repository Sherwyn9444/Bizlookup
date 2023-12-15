<?php
class Settings_Model extends CI_Model {

	public function get_categories($search = ""){
        $this->db->like("id",$search);
        $this->db->or_like("name",$search);
        $this->db->or_like("description",$search);
        $query = $this->db->get("categories");
        return $query->result();
    }

    public function get_types($search = ""){
        $this->db->like("id",$search);
        $this->db->or_like("name",$search);
        $this->db->or_like("description",$search);
        $query = $this->db->get("types");
        return $query->result();
    }

    public function get_barangay($search = ""){
        $this->db->like("id",$search);
        $this->db->or_like("name",$search);
        $query = $this->db->get("barangay");
        return $query->result();
    }

    public function get_theme($search = ""){
        $this->db->like("id",$search);
        $this->db->or_like("name",$search);
        $query = $this->db->get("theme");
        return $query->result();
    }

    public function get_status($search = ""){
        $this->db->like("id",$search);
        $this->db->or_like("name",$search);
        $query = $this->db->get("status");
        return $query->result();
    }

    public function get_allowed(){
        $query = $this->db->get("allowed");
        return $query->row();
    }

    public function save_theme($id){
        $this->db->update("theme",array(
            "isSelected" => 0
        ));

        $this->db->where("id",$id);
        $this->db->update("theme",array(
            "isSelected" => 1
        ));
    }

    public function add_category($data){
        $this->db->insert("categories",array(
            "name" => $data->post("name"),
            "description" => $data->post("description")
        ));
    }

    public function edit_category($id,$data){
        $this->db->where("id",$id);
        $this->db->update("categories",array(
            "name" => $data->post("name"),
            "description" => $data->post("description")
        ));
    }

    public function add_status($data){
        $this->db->insert("status",array(
            "name" => $data->post("name"),
            "description" => $data->post("description"),
            "color" => $data->post("color")
        ));
    }

    public function edit_status($id,$data){
        $old = $this->db->get_where("status",array("id" => $id))->row()->name;
        $this->db->where("id",$id);
        $this->db->update("status",array(
            "name" => $data->post("name"),
            "description" => $data->post("description"),
            "color" => $data->post("color")
        ));

        $this->db->where("status",$old);
        $this->db->update("business",array(
            "status" => $data->post("name")
        ));
    }

    public function edit_allowed($id,$data){
        $this->db->where("id",$id);
        $this->db->update("allowed",array(
            "head" => $data->post("allow"),
            "title" => $data->post("title")
        ));
    }

    public function add_type($data){
        $this->db->insert("types",array(
            "name" => $data->post("name"),
            "description" => $data->post("description")
        ));
    }

    public function edit_type($id,$data){
        $this->db->where("id",$id);
        $this->db->update("types",array(
            "name" => $data->post("name"),
            "description" => $data->post("description")
        ));
    }

    public function add_theme($data){
        $this->db->insert("theme",array(
            "name" => $data->post("name"),
            "bgfirst" => $data->post("bgfirst"),
            "bgsecond" => $data->post("bgsecond"),
            "cfirst" => $data->post("cfirst"),
            "csecond" => $data->post("csecond"),
            "bfirst" => $data->post("bfirst"),
            "beffect" => $data->post("beffect")
        ));
    }

    public function edit_theme($id,$data){
        $this->db->where("id",$id);
        $this->db->update("theme",array(
            "name" => $data->post("name"),
            "bgfirst" => $data->post("bgfirst"),
            "bgsecond" => $data->post("bgsecond"),
            "cfirst" => $data->post("cfirst"),
            "csecond" => $data->post("csecond"),
            "bfirst" => $data->post("bfirst"),
            "beffect" => $data->post("beffect")
        ));
    }

    public function remove_categories($id){
        $this->db->delete("categories",array("id"=>$id));
    }

    public function remove_type($id){
        $this->db->delete("types",array("id"=>$id));
    }

    public function remove_theme($id){
        $this->db->delete("theme",array("id"=>$id));
    }

    public function add_barangay($data){
        $this->db->insert("barangay",array(
            "name" => $data->post("name"),
        ));
    }

    public function edit_barangay($id,$data){
        $this->db->where("id",$id);
        $this->db->update("barangay",array(
            "name" => $data->post("name"),
        ));
    }

    public function remove_category($id){
        $this->db->delete("barangay",array("id"=>$id));
    }

    public function get_selected_theme(){
        $query = $this->db->get_where("theme",array("isSelected"=>1));
        return $query->result();
    }

    public function export_csv($search){
        $this->db->like("name",$search);
        $this->db->or_like("number",$search);
        $this->db->or_like("owner",$search);
        $this->db->or_like("status",$search);
        $this->db->or_like("date",$search);
        $this->db->or_like("type",$search);
        $this->db->or_like("category",$search);
        $this->db->or_like("building_id",$search);
        $this->db->or_like("location_address",$search);
        
        $this->db->select("*");
        $this->db->from("view_business_details");
        $query = $this->db->get();

        echo $this->dbutil->csv_from_result($query);
    }

    /*
    public function backup(){
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
        $backup = $this->dbutil->backup();
        $this->load->helper('download');
        force_download('mybackup.gz', $backup);
    }*/

    public function backup(){
        $this->load->dbutil();
        
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
        $prefs = array(     
            'format'      => 'zip',             
            'filename'    => 'my_db_backup.sql'
            );


        $backup =& $this->dbutil->backup($prefs); 

        $db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
        $save = 'assets/backup/'.$db_name;
        
        $this->load->helper('file');
        write_file($save, $backup);

        //$this->zip->unzip('assets/backup/', 'assets/backup/');


        $this->load->helper('download');
        force_download($db_name, $backup);
    }
}
