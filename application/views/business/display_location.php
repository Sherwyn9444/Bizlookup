<div class='w-100'>
    <div class='d-flex justify-content-between w-100'>
        <a type='button' href='<?php echo site_url("main/map");?>' class='btn btn-primary'>Go to Map</a>
    </div>
</div>

<div class='w-100 mt-1'>
    <div class='d-flex justify-content-between w-100'>
        <div class='w-100 me-3'>
            <div class='disp-item disp-clickable' id='<?php echo $address->pin?>'>
                <div class='d-flex'>
                    <div class='disp-image'>
                            <img src='<?php echo $location->imgpath?>'>
                    </div>
                    <h3 class='h3 ps-3' style='padding-top: 35px;'><?php echo $location->name?></h3>
                </div>
                <div>
                    
                    <div class='d-flex justify-content-between'>
                        <div>PIN: <?php echo $address->pin?></div>
                        <div>Building Name: <?php echo $address->building_name?></div>
                        <div>Building No.: <?php echo $address->bldg_no?></div>
                    </div>
                    <div class='w-100'>
                        <table class='disp-table w-100'>
                            <tr>
                                <th>#</th>
                                <th>Street</th>
                                <th>Barangay</th>
                                <th>Subdivision</th>
                                <th>City/Municipality</th>
                                <th>Province</th>
                            </tr>
                            <tr>
                                <td><?php echo $address->unit_no?></td>
                                <td><?php echo $address->street?></td>
                                <td><?php echo $address->barangay?></td>
                                <td><?php echo $address->subdivision?></td>
                                <td><?php echo $address->city?></td>
                                <td><?php echo $address->province?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class='disp-item d-flex justify-content-between'>
                <div class='w-100'><hr></div>
                
                <div style='font-size:20px;'>Businesses</div>
                <div class='w-100'><hr></div>
            </div>
            <?php
            foreach($business as $b){
                echo "
                <div class='disp-clickable' id='".$b->number."'>
                    <div class='d-flex justify-content-start'>
                        
                        <div>
                            <div><h4 class='h4'>Business Name: ".$b->name."</h4></div>
                            <div><h5 class='h5'>Business Owner: ".$b->owner."</h5></div>
                        </div>
                    </div>
                    <div class='d-flex justify-content-between'>
                        <div>Date Added: ".$b->date."</div>
                        <div>Type: ".$b->type."</div>
                        <div>Category: ".$b->category."</div>
                        ";
                        /*
                    if($b->status == "Registered"){
                        echo "<div style = 'color:#00FF00'>";
                    }else if($b->status == "Waiting"){
                        echo "<div style = 'color:#9ACD32'>";
                    }else if($b->status == "Pending"){
                        echo "<div style = 'color:#FFFF00'>";
                    }*/

                    foreach($status as $status_color){
                        if($b->status == $status_color->status){
                            echo "<div class='px-2' style = 'background-color:".$status_color->color."'>" ;
                            break;
                        }
                    }

                    echo "Status: ".$b->status."</div>";
                    echo "
                    </div>
                    <br>
                    <h5>Requirements</h5>
                    <div>";
                    echo "<div class='d-flex justify-content-between'>
                        <div class='w-100 d-flex'><input class='me-2' style='width:30px;height:50px;' type='checkbox' "; if($b->barangay_clearance){ echo "checked"; }; echo "><div class='w-100'>Barangay Business Clearance</div></div>
                        <div class='w-100 d-flex'><input class='me-2' style='width:30px;height:50px;' type='checkbox' "; if($b->tax_clearance){ echo "checked"; }; echo "><div class='w-100'>Community Tax Clearance</div></div>
                        <div class='w-100 d-flex'><input class='me-2' style='width:30px;height:50px;' type='checkbox' "; if($b->dti_registration){ echo "checked"; }; echo "><div class='w-100'>DTI Registration</div></div>
                        <div class='w-100 d-flex'><input class='me-2' style='width:30px;height:50px;' type='checkbox' "; if($b->sanitary_clearance){ echo "checked"; }; echo "><div class='w-100'>Health Sanitary Permit</div></div>
                        <div class='w-100 d-flex'><input class='me-2' style='width:30px;height:50px;' type='checkbox' "; if($b->pic_clearance){ echo "checked"; }; echo "><div class='w-100'>2x2 Id Picture</div></div>
                        
                    </div>
                    <div class='d-flex justify-content-between'>
                        <div class='w-100 d-flex'><input class='me-2' style='width:30px;height:50px;' type='checkbox' "; if($b->fire_clearance){ echo "checked"; }; echo "><div class='w-100'>Fire Safety Inspection</div></div>
                        <div class='w-100 d-flex'><input class='me-2' style='width:30px;height:50px;' type='checkbox' "; if($b->building_permit){ echo "checked"; }; echo "><div class='w-100'>Occupation Permit</div></div>
                        <div class='w-100 d-flex'><input class='me-2' style='width:30px;height:50px;' type='checkbox' "; if($b->zoning_clearance){ echo "checked"; }; echo "><div class='w-100'>Zoning Clearance</div></div>
                        <div class='w-100 d-flex'><input class='me-2' style='width:30px;height:50px;' type='checkbox' "; if($b->contract_lease){ echo "checked"; }; echo "><div class='w-100'>Contract of Lease</div></div>
                        <div class='w-100 d-flex'><input class='me-2' style='width:30px;height:50px;' type='checkbox' "; if($b->menro_cert){ echo "checked"; }; echo "><div class='w-100'>Menro Certificate</div></div>
                    </div>
                    </div>
                </div>
                ";
            }
            
            ?>
        </div>
        <div class="w-50 disp-map">
            <div id='map-holder' style="width:100%;height:100%;"></div>
            <div class='d-flex justify-content-center'>
                <div>Coordinate: <?php echo $location->x?>, <?php echo $location->y?></div>
            </div>
        </div>
    </div>
</div>

<script>
    var show_map;
    var map_filter = {};
    var business = <?php echo json_encode($business)?>;
    var coordinate = ["<?php echo $location->x?>","<?php echo $location->y?>"]
    set_map();
    //set_filter();
    
    function set_map(){
        show_map = new main_map("map-holder",coordinate);

        show_map.add_temp(coordinate,business.status);
    }
    var ipstr = "<?php echo site_url('main/display')?>";
    var businesses = document.getElementsByClassName("disp-clickable");
    businesses[0].addEventListener('click',function(){
        open_edit_data(businesses[0].id);
    });
    for(var x  = 1; x < businesses.length; x++){
        businesses[x].addEventListener('click',function(){
            window.location.href = ipstr+"/"+this.id;
        });
    }

    function open_edit_data(e){
        window.location.href = "<?php echo site_url('main/properties')?>/?search="+e;
    }
</script>