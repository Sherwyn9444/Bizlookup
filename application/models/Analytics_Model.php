<?php
class Analytics_Model extends CI_Model {

	public function get_barangay_date(){
        $query = $this->db->get("view_date_barangay_count");
        return $query->result();
    }

    public function get_barangay(){
        $query = $this->db->get("barangay");
        return $query->result();
    }

    public function get_status(){
        $query = $this->db->get("view_status_count");
        return $query->result();
    }
}
