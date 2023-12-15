<?php
class Business_Model extends CI_Model {

	public function get_data(){
        $query = $this->db->get("view_business_details");
        return $query->result();
    }

    public function get_all(){
        $query = $this->db->get("business");
        return $query->result();
    }

    public function get_pin(){
        $query = $this->db->get("location");
        return $query->result();
    }

    public function get_address(){
        $query = $this->db->get("business_address");
        return $query->result();
    }

    public function get_location_count(){
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
        $query = $this->db->get("view_location_count");
        return $query->result();
    }

    public function get_year_count(){
        $query = $this->db->get("view_year_count");
        return $query->result();
    }
    
    public function get_status_count(){
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
        $query = $this->db->get("view_status_count");
        
        return $query->result();
    }

    public function get_category_count(){
        $query = $this->db->get("view_category_count");
        return $query->result();
    }

    public function get_building($id){
        $query = $this->db->get_where("business",array("building_id"=>$id));
        return $query->result();
        
    }

    public function get_business($id){
        $query = $this->db->get_where("business",array("number"=>$id));
        return $query->row();
        
    }

    public function get_index($id){
        $query = $this->db->get_where("business",array("number"=>$id));
        return $query->row()->pin;
        
    }

    public function get_owner($id){
        $query = $this->db->get_where("business_owner",array("owner_id"=>$id));
        return $query->row();
    }

    public function get_business_address($id){
        $query = $this->db->get_where("business_address",array("building_id"=>$id));
        return $query->row();
    }

    public function get_business_location($id){
        $query = $this->db->get_where("business_address",array("pin"=>$id));
        return $query->row();
    }
    
    public function get_categories(){
        $query = $this->db->get("categories");
        return $query->result();
    }

    public function get_default_status(){
        $query = $this->db->get_where("status",array("isDefault" => 1));
        return $query->row()->name;
    }

    public function get_condition_status(){
        $query = $this->db->get_where("status",array("isCondition" => 1));
        return $query->row()->name;
    }

    public function get_approve_status(){
        $query = $this->db->get_where("status",array("isApprove" => 1));
        return $query->row()->name;
    }

    public function get_retired_status(){
        $query = $this->db->get_where("status",array("isRetired" => 1));
        return $query->row()->name;
    }

    public function get_all_status(){
        $query = $this->db->get("status");
        return $query->result();
    }

    public function search($search){
        $this->db->like("name",$search);
        $this->db->or_like("number",$search);
        $this->db->or_like("owner",$search);
        $this->db->or_like("status",$search);
        $this->db->or_like("bin",$search);
        $this->db->or_like("date",$search);
        $this->db->or_like("type",$search);
        $this->db->or_like("category",$search);
        $this->db->or_like("building_id",$search);
        $this->db->or_like("location_address",$search);
        
        $this->db->select("*");
        $this->db->from("view_business_details");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_search($num){
        $search = $this->input->post("search");
        $this->db->group_start();
        $this->db->like("name",$search);
        $this->db->or_like("bin",$search);
        $this->db->or_like("owner",$search);
        $this->db->or_like("status",$search);
        $this->db->or_like("type",$search);
        $this->db->or_like("category",$search);
        $this->db->group_end();
        $this->db->where("building_id",$num);
        $this->db->select("*");
        $this->db->from("business");
        $query = $this->db->get();
        return $query->result();
    }


    public function add_data($data){
        $this->db->insert("business_owner",array(
            "first_name" => $data->post("owner_first"),
            "last_name" => $data->post("owner_last"),
            "middle_name" => $data->post("owner_middle"),
            "house_no" => $data->post("owner_houseno"),
            "building_name" => $data->post("owner_buildingname"),
            "unit_no" => $data->post("owner_unitno"),
            "street" => $data->post("owner_street"),
            "barangay" => $data->post("owner_brgy"),
            "subdivision" => $data->post("owner_subdivision"),
            "city" => $data->post("owner_city"),
            "province" => $data->post("owner_province"),
            "tel_no" => $data->post("owner_telno"),
            "email_address" => $data->post("owner_email"),
        ));

        $ownerid = $this->db->insert_id();
        
        $query2 = $this->db->get_where("location",array(
            "pin" => $data->post('address_pin')
        ));
        $row2 = $query2->row();

        if(isset($row2)){
            $localpin = $row2->pin;
        }else{

            $paddress = "#". $data->post("unitno") . " ";
        
            if( $data->post("address_street") ){
                $paddress = $paddress . $data->post("address_street") . " st., ";
            }
            if($data->post("address_subdivision")){
                $paddress = $paddress . $data->post("address_subdivision") . " Subd., ";
            }
            if($data->post("address_brgy")){
                $paddress = $paddress . "Brgy. ". $data->post("address_brgy") . ", ";
            }
            if($data->post("address_city")){
                $paddress = $paddress . $data->post("address_city") . ", ";
            }
            if($data->post("address_province")){
                $paddress = $paddress . $data->post("address_province") . "";
            }
            
            $this->db->insert("location",array(
                "pin" => $data->post("address_pin"),
                "name" => $data->post("address_buildingname"),
                "address" => $paddress
            ));
            $localpin = $this->db->insert_id();
        }
        

        $query = $this->db->get_where("business_address",array(
            "pin" => $data->post('address_pin')
        ));
        $row = $query->row();
        
        if(isset($row)){
            $addresspin = $row->building_id;
        }else{
            $this->db->insert("business_address",array(
                "pin" => $localpin,
                "bldg_no" => $data->post("address_houseno"),
                "building_name" => $data->post("address_buildingname"),
                "unit_no" => $data->post("address_unitno"),
                "street" => $data->post("address_street"),
                "barangay" => $data->post("address_brgy"),
                "subdivision" => $data->post("address_subdivision"),
                "city" => $data->post("address_city"),
                "province" => $data->post("address_province"),
                "tel_no" => $data->post("address_telno"),
                "email_address" => $data->post("address_email"),
            ));
            $addresspin = $this->db->insert_id();
        }
        
        $stats = $this->get_default_status();
        $stats_check = $this->get_condition_status();
        $condition = $this->get_status_from_text($stats_check)->conditions;
        if(
            $this->check_clearance($data->post("barangay")) == (int)$condition[0] &&
            $this->check_clearance($data->post("sanitary")) == (int)$condition[1] &&
            $this->check_clearance($data->post("fire")) == (int)$condition[2] &&
            $this->check_clearance($data->post("tax")) == (int)$condition[3] &&
            $this->check_clearance($data->post("dti")) == (int)$condition[4] &&
            $this->check_clearance($data->post("zone")) == (int)$condition[5] &&
            $this->check_clearance($data->post("lease")) == (int)$condition[6] &&
            $this->check_clearance($data->post("menro")) == (int)$condition[7] &&
            $this->check_clearance($data->post("pic")) == (int)$condition[8] &&
            $this->check_clearance($data->post("permit")) == (int)$condition[9]
            ){
                $stats = $stats_check;
        }else{
            $stats = $this->get_default_status();
        }

        $this->db->insert("business",array(
            "name" => $data->post("name"),
            "owner" => "".$data->post("owner_last").", ".$data->post("owner_first")." ".$data->post("owner_middle"),
            "owner_id" => $ownerid,
            "type" => $data->post("type"),
            "address" => $addresspin,
            "status" => $stats ,
            "category" => $data->post("category"),
            "date" => $data->post("year"),
            "barangay_clearance" => $this->check_clearance($data->post("barangay")),
            "sanitary_clearance" => $this->check_clearance($data->post("sanitary")),
            "fire_clearance" => $this->check_clearance($data->post("fire")),
            "tax_clearance" => $this->check_clearance($data->post("tax")),
            "dti_registration" => $this->check_clearance($data->post("dti")),
            "zoning_clearance" => $this->check_clearance($data->post("zone")),
            "contract_lease" => $this->check_clearance($data->post("lease")),
            "menro_cert" => $this->check_clearance($data->post("menro")),
            "pic_clearance" => $this->check_clearance($data->post("pic")),
            "building_permit" => $this->check_clearance($data->post("permit")),
            "building_id" => $localpin
        ));
    }
    public function delete_data($data){
        $test = $this->db->get_where("business",array("number" => $data))->row();
        $retired = $this->get_retired_status();
        if($test->status != $retired){
            $this->db->where('number', $data);
            $this->db->update("business",array(
                "status" => $retired
            ));
        }else{
            $this->db->delete("business",array(
                "number" => $data,
            ));
        }
        
    }

    public function regain_data($data){
        $test = $this->db->get_where("business",array("number" => $data))->row();
        $retired = $this->get_retired_status();
        if($test->status == $retired){
            $stats = $test->status;
            $stats_check = $this->get_condition_status();
            $condition = $this->get_status_from_text($stats_check)->conditions;
            if(
                $this->check_clearance($data->post("barangay")) == (int)$condition[0] &&
                $this->check_clearance($data->post("sanitary")) == (int)$condition[1] &&
                $this->check_clearance($data->post("fire")) == (int)$condition[2] &&
                $this->check_clearance($data->post("tax")) == (int)$condition[3] &&
                $this->check_clearance($data->post("dti")) == (int)$condition[4] &&
                $this->check_clearance($data->post("zone")) == (int)$condition[5] &&
                $this->check_clearance($data->post("lease")) == (int)$condition[6] &&
                $this->check_clearance($data->post("menro")) == (int)$condition[7] &&
                $this->check_clearance($data->post("pic")) == (int)$condition[8] &&
                $this->check_clearance($data->post("permit")) == (int)$condition[9]
                ){
                    $stats = $stats_check;
            }else{
                $stats = $this->get_default_status();
            }

            $this->db->where('number', $data);
            $this->db->update("business",array(
                "status" => $stats
            ));
        }
        
    }

    public function delete_address($data){
        $this->db->delete("business_address",array(
            "building_id" => $data,
        ));
    }

    public function add_address($data){
        $this->db->insert("business_address",array(
            "pin" => $data->post("pin"),
            "bldg_no" => $data->post("bldg_no"),
            "building_name" => $data->post("bldg_name"),
            "unit_no" => $data->post("address_unit_no"),
            "street" => $data->post("address_street"),
            "barangay" => $data->post("address_barangay"),
            "subdivision" => $data->post("address_subdivision"),
            "city" => $data->post("address_city"),
            "province" => $data->post("address_province"),
            "tel_no" => $data->post("address_tel_no"),
            "email_address" => $data->post("address_email"),
        ));
    }

    public function edit_address($id,$data){
        $this->db->where('building_id', $id);
        $this->db->insert("business_address",array(
            "pin" => $data->post("pin"),
            "bldg_no" => $data->post("bldg_no"),
            "building_name" => $data->post("bldg_name"),
            "unit_no" => $data->post("address_unit_no"),
            "street" => $data->post("address_street"),
            "barangay" => $data->post("address_barangay"),
            "subdivision" => $data->post("address_subdivision"),
            "city" => $data->post("address_city"),
            "province" => $data->post("address_province"),
            "tel_no" => $data->post("address_tel_no"),
            "email_address" => $data->post("address_email"),
        ));
    }

    public function delete_owner($data){
        $this->db->delete("business_owner",array(
            "building_id" => $data,
        ));
    }

    public function add_owner($data){
        $this->db->insert("business_owner",array(
            "first_name" => $data->post("first"),
            "last_name" => $data->post("last"),
            "middle_name" => $data->post("middle"),
            "house_no" => $data->post("house_no"),
            "bldg_no" => $data->post("bldg_no"),
            "building_name" => $data->post("bldg_name"),
            "unit_no" => $data->post("owner_unit_no"),
            "street" => $data->post("owner_street"),
            "barangay" => $data->post("owner_barangay"),
            "subdivision" => $data->post("owner_subdivision"),
            "city" => $data->post("owner_city"),
            "province" => $data->post("owner_province"),
            "tel_no" => $data->post("owner_tel_no"),
            "email_owner" => $data->post("owner_email"),
        ));
    }

    public function edit_owner($id,$data){
        $this->db->where('building_id', $id);
        $this->db->insert("business_owner",array(
            "first_name" => $data->post("first"),
            "last_name" => $data->post("last"),
            "middle_name" => $data->post("middle"),
            "house_no" => $data->post("house_no"),
            "building_name" => $data->post("bldg_name"),
            "unit_no" => $data->post("owner_unit_no"),
            "street" => $data->post("owner_street"),
            "barangay" => $data->post("owner_barangay"),
            "subdivision" => $data->post("owner_subdivision"),
            "city" => $data->post("owner_city"),
            "province" => $data->post("owner_province"),
            "tel_no" => $data->post("owner_tel_no"),
            "email_owner" => $data->post("owner_email"),
        ));
    }

    public function edit_data($id,$data){
        $q = $this->db->get_where("business",array("number" => $id));
        $stats = $q->row()->status;
        $stats_check = $this->get_condition_status();
        $condition = $this->get_status_from_text($stats_check)->conditions;
        if(
            $this->check_clearance($data->post("barangay")) == (int)$condition[0] &&
            $this->check_clearance($data->post("sanitary")) == (int)$condition[1] &&
            $this->check_clearance($data->post("fire")) == (int)$condition[2] &&
            $this->check_clearance($data->post("tax")) == (int)$condition[3] &&
            $this->check_clearance($data->post("dti")) == (int)$condition[4] &&
            $this->check_clearance($data->post("zone")) == (int)$condition[5] &&
            $this->check_clearance($data->post("lease")) == (int)$condition[6] &&
            $this->check_clearance($data->post("menro")) == (int)$condition[7] &&
            $this->check_clearance($data->post("pic")) == (int)$condition[8] &&
            $this->check_clearance($data->post("permit")) == (int)$condition[9] &&
            ($stats == $this->get_default_status() || $stats == $this->get_condition_status())
            ){
                $stats = $stats_check;
        }else{
            if($stats == $this->get_condition_status()){
                $stats = $this->get_default_status();
            }else{
                $stats = $q->row()->status;
            }
        }

        $this->db->where('number', $id);
        $this->db->update("business",array(
            "name" => $data->post("name"),
            "owner" => $data->post("owner"),
            "type" => $data->post("type"),
            "status" => $stats,
            "category" => $data->post("category"),
            "date" => $data->post("year"),
            "barangay_clearance" => $this->check_clearance($data->post("barangay")),
            "sanitary_clearance" => $this->check_clearance($data->post("sanitary")),
            "fire_clearance" => $this->check_clearance($data->post("fire")),
            "tax_clearance" => $this->check_clearance($data->post("tax")),
            "dti_registration" => $this->check_clearance($data->post("dti")),
            "zoning_clearance" => $this->check_clearance($data->post("zone")),
            "contract_lease" => $this->check_clearance($data->post("lease")),
            "menro_cert" => $this->check_clearance($data->post("menro")),
            "pic_clearance" => $this->check_clearance($data->post("pic")),
            "building_permit" => $this->check_clearance($data->post("permit")),
            "building_id" => $data->post("building")
        ));

        $this->db->where('pin', $data->post('address_pin'));
        $this->db->update("business_address",array(
            "pin" => $data->post("address_pin"),
            "bldg_no" => $data->post("address_houseno"),
            "building_name" => $data->post("address_buildingname"),
            "unit_no" => $data->post("address_unitno"),
            "street" => $data->post("address_street"),
            "barangay" => $data->post("address_brgy"),
            "subdivision" => $data->post("address_subdivision"),
            "city" => $data->post("address_city"),
            "province" => $data->post("address_province"),
            "tel_no" => $data->post("address_telno"),
            "email_address" => $data->post("address_email"),
        ));
        
        $this->db->where('owner_id', $data->post('owner_id'));
        $this->db->update("business_owner",array(
            "first_name" => $data->post("owner_first"),
            "last_name" => $data->post("owner_last"),
            "middle_name" => $data->post("owner_middle"),
            "house_no" => $data->post("owner_houseno"),
            "building_name" => $data->post("owner_buildingname"),
            "unit_no" => $data->post("owner_unitno"),
            "street" => $data->post("owner_street"),
            "barangay" => $data->post("owner_brgy"),
            "subdivision" => $data->post("owner_subdivision"),
            "city" => $data->post("owner_city"),
            "province" => $data->post("owner_province"),
            "tel_no" => $data->post("owner_telno"),
            "email_address" => $data->post("owner_email"),
        ));
    }

    public function approve($id){
        $stats = $this->get_approve_status();
        $this->db->where('number', $id);
        $this->db->update("business",array(
            "status" => $stats,
            "date_approved" => date("Y-m-d")
        ));
    }

    private function check_clearance($text){
        if($text == 'true'){
            return 1;
        }else{
            return 0;
        };
    }

    public function check_condition($data,$text){
        $val = true;
        if($data->barangay_clearance != $text[0]){
            $val = false;
        }
        if($data->tax_clearance != $text[1]){
            $val = false;
        }
        if($data->dti_registration != $text[2]){
            $val = false;
        }
        if($data->sanitary_clearance != $text[3]){
            $val = false;
        }
        if($data->fire_clearance != $text[4]){
            $val = false;
        }
        if($data->building_permit != $text[5]){
            $val = false;
        }
        if($data->zoning_clearance != $text[6]){
            $val = false;
        }
        if($data->contract_lease != $text[7]){
            $val = false;
        }
        if($data->pic_clearance != $text[8]){
            $val = false;
        }
        if($data->menro_cert != $text[9]){
            $val = false;
        }

        return $val;
    }

    public function get_status_from_text($text){
        $query = $this->db->get_where("status",array("name"=>$text));
        return $query->row();
    }
    public function check_raw_condition($data,$text){
        $val = true;
        if($data != $text){
            $val = false;
        }
        return $val;
    }
}
