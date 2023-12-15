<?php
class Install_Model extends CI_Model {

	public function install($data){
        $this->load->helper('file');
        $str = "<?php
        defined('BASEPATH') OR exit('No direct script access allowed');
        \$active_group = 'default';
        \$query_builder = TRUE;
        \$db['default'] = array(
            'dsn'	=> '',
            'hostname' => '".$data->post("hostname")."',
            'username' => '".$data->post("username")."',
            'password' => '".$data->post("password")."',
            'database' => '".$data->post("database")."',
            'dbdriver' => '".$data->post("dbdriver")."',
            'dbprefix' => '',
            'pconnect' => FALSE,
            'db_debug' => (ENVIRONMENT !== 'production'),
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci',
            'swap_pre' => '',
            'encrypt' => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE,
            'failover' => array(),
            'save_queries' => TRUE
        );
        ";
        
        $path = './application/config/database.php';
        if ( ! write_file($path, $str))
        {
            echo 'Unable to write the file';
        }
        else
        {
            echo 'File written!';
        }

        $dbcon = file_get_contents('./assets/setup.sql');
        $dbset = str_replace("`gis`","`".$data->post("database")."`",$dbcon);
        write_file('./assets/base.sql', $dbset);

        mysqli_multi_query($this->db->conn_id, $dbset);

        //$this->others();

        //echo $dbset;
        redirect("install/set_triggers");
    }

    public function triggers(){
        $this->db->query("DROP TRIGGER IF EXISTS `trigger_business_bin`");
        $this->db->query("
            CREATE TRIGGER `trigger_business_bin` BEFORE INSERT ON `business`\r\n
            FOR EACH ROW BEGIN\r\n
            SET new.bin = (SELECT CONCAT(new.building_id,'-',COUNT(*) + 1,'') FROM business WHERE building_id = new.building_id LIMIT 1);\r\n
            END\r\n
        ");

        $this->db->query("DROP TRIGGER IF EXISTS `trigger_business_bin_edit`");
        $this->db->query("
            CREATE TRIGGER `trigger_business_bin_edit` BEFORE UPDATE ON `business`\r\n
            FOR EACH ROW BEGIN\r\n
            SET new.bin = (SELECT concat(new.building_id,'-',COUNT(*) + 1,'') FROM business WHERE building_id = new.building_id LIMIT 1);\r\n
            END\r\n
        ");

        $this->db->query("DROP TRIGGER IF EXISTS `trigger_business_logs_add`");
        $this->db->query("
            CREATE TRIGGER `trigger_business_logs_add` AFTER INSERT ON `business`\r\n
            FOR EACH ROW BEGIN\r\n
            insert into business_logs (bid, action) values (new.number, 'Add New Business');\r\n
            END\r\n
        ");

        $this->db->query("DROP TRIGGER IF EXISTS `trigger_business_logs_edit`");
        $this->db->query("
            CREATE TRIGGER `trigger_business_logs_edit` AFTER UPDATE ON `business`\r\n
            FOR EACH ROW BEGIN\r\n
            INSERT INTO business_logs (bid, ACTION) VALUES (new.number, 'Edit Business');\r\n
            END\r\n
        ");

        $this->db->query("DROP TRIGGER IF EXISTS `trigger_business_logs_add_address`");
        $this->db->query("
            CREATE TRIGGER `trigger_business_logs_add_address` AFTER INSERT ON `business_address`\r\n
            FOR EACH ROW BEGIN\r\n
            INSERT INTO business_logs (bid, ACTION) VALUES ((SELECT number FROM business WHERE address = new.building_id), 'Add Business Address');\r\n
            END\r\n
        ");

        $this->db->query("DROP TRIGGER IF EXISTS `trigger_business_logs_edit_address`");
        $this->db->query("
            CREATE TRIGGER `trigger_business_logs_edit_address` AFTER UPDATE ON `business_address`\r\n
            FOR EACH ROW BEGIN\r\n
            INSERT INTO business_logs (bid, ACTION) VALUES ((SELECT number FROM business WHERE address = new.building_id), 'Edit Business Address');\r\n
            END\r\n
        ");

        $this->db->query("DROP TRIGGER IF EXISTS `trigger_business_logs_add_owner`");
        $this->db->query("
            CREATE TRIGGER `trigger_business_logs_add_owner` AFTER INSERT ON `business_owner`\r\n
            FOR EACH ROW BEGIN\r\n
            INSERT INTO business_logs (bid, ACTION) VALUES ((SELECT number FROM business WHERE owner_id = new.owner_id), 'Add Business Owner');\r\n
            END\r\n
        ");

        $this->db->query("DROP TRIGGER IF EXISTS `trigger_business_logs_edit_owner`");
        $this->db->query("
            CREATE TRIGGER `trigger_business_logs_edit_owner` AFTER UPDATE ON `business_owner`\r\n
            FOR EACH ROW BEGIN\r\n
            INSERT INTO business_logs (bid, ACTION) VALUES ((SELECT number FROM business WHERE owner_id = new.owner_id), 'Add Business Owner');\r\n
            END\r\n
        ");

        $this->db->query("DROP TRIGGER IF EXISTS `trigger_settings_logs_add_categories`");
        $this->db->query("
            CREATE TRIGGER `trigger_settings_logs_add_categories` AFTER INSERT ON `categories`\r\n
            FOR EACH ROW BEGIN\r\n
            INSERT INTO settings_logs (sid, ACTION) VALUES (new.id, 'Add Category');\r\n
            END\r\n
        ");

        $this->db->query("DROP TRIGGER IF EXISTS `trigger_settings_logs_edit_categories`");
        $this->db->query("
            CREATE TRIGGER `trigger_settings_logs_edit_categories` AFTER UPDATE ON `categories`\r\n
            FOR EACH ROW BEGIN\r\n
            INSERT INTO settings_logs (sid, ACTION) VALUES (new.id, 'Edit Category');\r\n
            END\r\n
        ");

        $this->db->query("DROP TRIGGER IF EXISTS `trigger_location_logs_add`");
        $this->db->query("
            CREATE TRIGGER `trigger_location_logs_add` AFTER INSERT ON `location`\r\n
            FOR EACH ROW BEGIN\r\n
            INSERT INTO location_logs (lid, ACTION) VALUES (new.pin, 'Add Location');\r\n
            END\r\n
        ");

        $this->db->query("DROP TRIGGER IF EXISTS `trigger_location_logs_edit`");
        $this->db->query("
            CREATE TRIGGER `trigger_location_logs_edit` AFTER UPDATE ON `location`\r\n
            FOR EACH ROW BEGIN\r\n
            INSERT INTO location_logs (lid, ACTION) VALUES (new.pin, 'Edit Location');\r\n
            END\r\n
        ");

        $this->db->query("DROP TRIGGER IF EXISTS `trigger_settings_logs_add_types`");
        $this->db->query("
            CREATE TRIGGER `trigger_settings_logs_add_types` AFTER INSERT ON `types`\r\n
            FOR EACH ROW BEGIN\r\n
            INSERT INTO settings_logs (sid, ACTION) VALUES (new.id, 'Add Type');\r\n
            END\r\n
        ");

        $this->db->query("DROP TRIGGER IF EXISTS `trigger_settings_logs_edit_types`");
        $this->db->query("
            CREATE TRIGGER `trigger_settings_logs_edit_types` AFTER UPDATE ON `types`\r\n
            FOR EACH ROW BEGIN\r\n
            INSERT INTO settings_logs (sid, ACTION) VALUES (new.id, 'Edit Type');\r\n
            END\r\n
        ");

        redirect("install/set_views");
    }

    public function views(){
        $this->db->query("DROP VIEW IF EXISTS `view_business_details`");
        $this->db->query("
        CREATE VIEW `view_business_details` AS (select `a`.`number` AS `number`,`a`.`bin` AS `bin`,`a`.`name` AS `name`,`a`.`owner` AS `owner`,`a`.`owner_id` AS `owner_id`,`a`.`address` AS `address`,`a`.`incentives` AS `incentives`,`a`.`type` AS `type`,`a`.`status` AS `status`,`a`.`category` AS `category`,`a`.`date` AS `date`,`a`.`barangay_clearance` AS `barangay_clearance`,`a`.`tax_clearance` AS `tax_clearance`,`a`.`dti_registration` AS `dti_registration`,`a`.`sanitary_clearance` AS `sanitary_clearance`,`a`.`fire_clearance` AS `fire_clearance`,`a`.`building_permit` AS `building_permit`,`a`.`zoning_clearance` AS `zoning_clearance`,`a`.`contract_lease` AS `contract_lease`,`a`.`pic_clearance` AS `pic_clearance`,`a`.`menro_cert` AS `menro_cert`,`a`.`building_id` AS `building_id`,`a`.`business_area` AS `business_area`,`d`.`address` AS `location_address`,`b`.`bldg_no` AS `bldg_no`,`b`.`building_name` AS `building_name`,`b`.`unit_no` AS `unit_no`,`b`.`street` AS `street`,`b`.`barangay` AS `barangay`,`b`.`subdivision` AS `subdivision`,`b`.`city` AS `city`,`b`.`province` AS `province`,`b`.`tel_no` AS `tel_no`,`b`.`email_address` AS `email_address` from (((`business` `a` join `business_address` `b` on((`a`.`address` = `b`.`building_id`))) join `business_owner` `c` on((`a`.`owner_id` = `c`.`owner_id`))) join `location` `d` on((`a`.`building_id` = `d`.`pin`)))) 
        ");

        $this->db->query("DROP VIEW IF EXISTS `view_category_count`");
        $this->db->query("
        CREATE VIEW `view_category_count` AS (select `business`.`category` AS `category`,count(`business`.`category`) AS `count` from `business` group by `business`.`category`)
        ");

        $this->db->query("DROP VIEW IF EXISTS `view_date_barangay_count`");
        $this->db->query("
        CREATE VIEW `view_date_barangay_count` AS (select `a`.`date` AS `date`,year(`a`.`date`) AS `year`,month(`a`.`date`) AS `month`,dayofmonth(`a`.`date`) AS `day`,count(`a`.`number`) AS `count`,`b`.`barangay` AS `barangay` from (`business` `a` join `business_address` `b` on((`b`.`pin` = `a`.`building_id`))) group by `b`.`barangay`,`a`.`date`) 
        ");

        $this->db->query("DROP VIEW IF EXISTS `view_location_count`");
        $this->db->query("
        CREATE VIEW `view_location_count` AS (select `a`.`name` AS `name`,`b`.`name` AS `business`,count(`a`.`name`) AS `count` from (`location` `a` left join `business` `b` on((`a`.`pin` = `b`.`building_id`))) group by `a`.`name`)
        ");

        $this->db->query("DROP VIEW IF EXISTS `view_pin_count`");
        $this->db->query("
        CREATE VIEW `view_pin_count` AS (select `business`.`building_id` AS `building_id`,count(0) AS `COUNT` from `business` group by `business`.`building_id`)
        ");

        $this->db->query("DROP VIEW IF EXISTS `view_status_count`");
        $this->db->query("
        CREATE VIEW `view_status_count` AS (select `a`.`name` AS `status`,count(`b`.`status`) AS `count`,`a`.`color` AS `color` from (`status` `a` left join `business` `b` on((`a`.`name` = `b`.`status`))) group by `a`.`name` order by `a`.`id`)
        ");

        $this->db->query("DROP VIEW IF EXISTS `view_year_count`");
        $this->db->query("
        CREATE VIEW `view_year_count` AS (select year(`business`.`date`) AS `year`,count(`business`.`date`) AS `count` from `business` group by year(`business`.`date`))
        ");

        redirect("main");
    }

}
