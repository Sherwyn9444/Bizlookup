<div class='admin-front-sidebar d-flex justify-content-start h-100 m-0 p-0'>
    <div id='admin-side'  class='admin-sidebar d-flex justify-content-between'>
        <div id='admin-side-in' class='w-100'>
            <div>
                <div class='p-4'>
                    <img style="width:150px;height:150px;" src="<?php echo base_url()?>Icon/bizlookup.png">
                </div>
            </div>
            <div class=''>
                <div>
                    <div class="admin-sidebar-button">
                        <a class=' py-2 ps-2' id = "side-dashboard" href="<?php echo site_url("main/view")?>">Dashboard</a>
                    </div>
                    <?php
                        if($this->session->userdata("user")->type == "admin"){
                            echo '<div class="admin-sidebar-button" >
                            <a class=" py-2 ps-2" id = "side-user" href="'.site_url("account/view").'">Users</a>                
                        </div>';
                        };
                    ?>
                    
                    <div class="admin-sidebar-button">
                        <a class=' py-2 ps-2'  id = "side-map" href="<?php echo site_url('main/map')?>">Map</a>                
                    </div>
                    <div class="admin-sidebar-button" >
                        <a class=' py-2 ps-2' id = "side-locations" href = "<?php echo site_url("main/properties")?>">Locations</a>                
                    </div>
                    <div class="admin-sidebar-button" >
                        <a class=' py-2 ps-2' id = "side-businesses" href = "<?php echo site_url("main/businesses")?>">Businesses</a>                
                    </div>
                    <div class="admin-sidebar-button" >
                        <a class=' py-2 ps-2' id = "side-regions" href = "<?php echo site_url("region")?>">Regions</a>                
                    </div>
                    <div class="admin-sidebar-button" >
                        <a class=' py-2 ps-2' id = "side-settings" href = "<?php echo site_url("settings")?>">Settings</a>                
                    </div>
                    <div class="admin-sidebar-button">
                        <a class=' py-2 ps-2' href="<?php echo site_url('Account/logout')?>">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
        <div id='admin-sidebar-hider'>
            <img class='mt-1' id='admin-hider-img' style='width:25px;' src="<?php echo base_url()?>Icon/burger_icon.png">  
        </div>
    </div>
    
    <div class='admin-body w-100'>
        <div class='admin-sidebar-header'>
            <div class="d-flex justify-content-start mt-1 ps-3">
                <h4 class='h4'><?php if(isset($title)){ echo $title;} ?></h4>
            </div>
            <div id='admin-head'>
            <div class="d-flex justify-content-between">
                <?php
                    foreach($status as $stats){
                        if($stats->count > 0 || !isset($stats->count)){
                        echo "
                        <div class='d-flex justify-content-between ps-2 w-100 mx-3 mb-3 admin-header-div'>
                        <div><div style='font-size:44px'>";
                        if(isset($stats->count)){ echo $stats->count;}else{ echo 0;};
                        echo "</div> <div>";
                        if(isset($stats->status)){echo $stats->status;} else { echo "Status 1";};
                        echo "</div></div><div></div></div>";
                        }
                    }
                ?>
                            
            </div>
            </div>
        </div>
        <script>
            var adminHide = true;
            document.getElementById('admin-sidebar-hider').addEventListener('click',function(){
                if(adminHide){
                    adminHide = false;
                    document.getElementById('admin-side').style.width = "25px";
                    document.getElementById('admin-head').style.height = "0%";
                    setTimeout(()=>{document.getElementById('admin-side-in').style.display = "none";},180);
                    //document.getElementById('admin-sidebar-hider').innerHTML = "";
                }else{
                    adminHide = true;
                    document.getElementById('admin-side').style.width = "225px";
                    document.getElementById('admin-head').style.height = "110px";
                    setTimeout(()=>{document.getElementById('admin-side-in').style.display = "block";},60);
                    //document.getElementById('admin-sidebar-hider').innerHTML = "";
                }
            });

            var status_template = <?php echo json_encode($status)?>;
        </script>
        <div class='admin-sidebar-body'>

