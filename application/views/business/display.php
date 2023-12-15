<div class='w-100'>
    <div class='d-flex justify-content-between w-100'>
        <a type='button' href='<?php echo site_url("main/map");?>' class='btn btn-primary'>Go to Map</a>
    </div>
</div>

<div class='w-100 mt-1'>
    <div class='d-flex justify-content-between w-100'>
        <div class='w-100 me-3'>
            <div class='disp-item disp-clickable' id='<?php echo $business->bin?>'>
                <div class='d-flex justify-content-start'>
                    <div class='disp-image'>
                        <img src="<?php echo $location->imgpath?>">
                    </div>
                    <div>
                        <div><h4 class='h4'>Business Name: <?php echo $business->name?></h4></div>
                        <div>Business Owner: <?php echo $business->owner?></div>
                        <div>Business Email: <?php echo $owner->email_address?></div>
                        <div>Date Added: <?php echo $business->date?></div>
                        <?php 
                        if($business->date_approved){
                            echo "<div>Date Registered: " . $business->date_approved ."</div>";
                        }
                        ?>
                        </div>
                </div>
                <div class='d-flex justify-content-between'>
                    
                    <div>Type: <?php echo $business->type?></div>
                    <div>Category: <?php echo $business->category?></div>
                    <div class='px-2' style = "background-color:
                    <?php 
                    foreach($status as $status_color){
                        if($business->status == $status_color->status){
                            echo $status_color->color;
                            break;
                        }
                    }?>;"

                    >Status: <?php echo $business->status?></div>
                </div>

                <div>
                <?php
                echo "<div class='d-flex justify-content-between'>
                <div class='w-100 d-flex'><input class='me-2' style='width:30px;height:50px;' type='checkbox' "; if($business->barangay_clearance){ echo "checked"; }; echo "><div class='w-100'>Barangay Business Clearance</div></div>
                <div class='w-100 d-flex'><input class='me-2' style='width:30px;height:50px;' type='checkbox' "; if($business->tax_clearance){ echo "checked"; }; echo "><div class='w-100'>Community Tax Clearance</div></div>
                <div class='w-100 d-flex'><input class='me-2' style='width:30px;height:50px;' type='checkbox' "; if($business->dti_registration){ echo "checked"; }; echo "><div class='w-100'>DTI Registration</div></div>
                <div class='w-100 d-flex'><input class='me-2' style='width:30px;height:50px;' type='checkbox' "; if($business->sanitary_clearance){ echo "checked"; }; echo "><div class='w-100'>Health Sanitary Permit</div></div>
                <div class='w-100 d-flex'><input class='me-2' style='width:30px;height:50px;' type='checkbox' "; if($business->pic_clearance){ echo "checked"; }; echo "><div class='w-100'>2x2 Id Picture</div></div>
                
            </div>
            <div class='d-flex justify-content-between'>
                <div class='w-100 d-flex'><input class='me-2' style='width:30px;height:50px;' type='checkbox' "; if($business->fire_clearance){ echo "checked"; }; echo "><div class='w-100'>Fire Safety Inspection</div></div>
                <div class='w-100 d-flex'><input class='me-2' style='width:30px;height:50px;' type='checkbox' "; if($business->building_permit){ echo "checked"; }; echo "><div class='w-100'>Occupation Permit</div></div>
                <div class='w-100 d-flex'><input class='me-2' style='width:30px;height:50px;' type='checkbox' "; if($business->zoning_clearance){ echo "checked"; }; echo "><div class='w-100'>Zoning Clearance</div></div>
                <div class='w-100 d-flex'><input class='me-2' style='width:30px;height:50px;' type='checkbox' "; if($business->contract_lease){ echo "checked"; }; echo "><div class='w-100'>Contract of Lease</div></div>
                <div class='w-100 d-flex'><input class='me-2' style='width:30px;height:50px;' type='checkbox' "; if($business->menro_cert){ echo "checked"; }; echo "><div class='w-100'>Menro Certificate</div></div>
            </div>";
                ?>
                
                    
                </div>
            </div>
            <div class='disp-item disp-clickable' id='<?php echo $address->pin?>'>
                <h3 class='h3'>Address</h3>
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
            <div class='disp-item'>
                <h3 class='h3'>Owner</h3>
                <div>
                    <div class='d-flex justify-content-start'>
                        <div class='me-5'>Last Name: <?php echo $owner->last_name?></div>
                        <div class='me-5'>First Name: <?php echo $owner->first_name?></div>
                        <div class='me-5'>Middle Name: <?php echo $owner->middle_name?></div>
                    </div>
                    <div class='d-flex justify-content-start'>
                        <div class='me-5'>Building Name: <?php echo $owner->building_name?></div>
                        <div class='me-5'>House No.: <?php echo $owner->house_no?></div>
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
                                <td><?php echo $owner->unit_no?></td>
                                <td><?php echo $owner->street?></td>
                                <td><?php echo $owner->barangay?></td>
                                <td><?php echo $owner->subdivision?></td>
                                <td><?php echo $owner->city?></td>
                                <td><?php echo $owner->province?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-50 disp-map">
            <div id='map-holder' style="width:100%;height:100%;"></div>
            <div class='d-flex justify-content-center'>
                <div>Coordinate: <?php echo $location->x?>, <?php echo $location->y?></div>
            </div>
            <div class='mt-3 d-flex justify-content-center w-100'>
                <button id='approve-button' class='btn btn-primary' onclick="approve_business()">Approve Business</button>
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

    document.getElementsByClassName('disp-clickable')[0].addEventListener('click',function(){
        open_edit_data(document.getElementsByClassName('disp-clickable')[0].id);
    });

    document.getElementsByClassName('disp-clickable')[1].addEventListener('click',function(){
        open_data(document.getElementsByClassName('disp-clickable')[1].id);
    });
    function open_data(e){
        window.location.href = "<?php echo site_url('main/look')?>/"+e;
    }

    function open_edit_data(e){
        window.location.href = "<?php echo site_url('main/businesses')?>/?search="+e;
    }

    if(business.status == "Waiting"){
        document.getElementById("approve-button").style.visibility = "visible";
    }else{
        document.getElementById("approve-button").style.visibility = "hidden"
    }

    function approve_business(){
        var id = <?php echo $business->number?>;
        window.location.href = "<?php echo site_url('business/approve_business')?>/"+id+"";
        alert("Business Approved");
    }
</script>