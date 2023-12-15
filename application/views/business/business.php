<script>
    document.getElementById("side-businesses").style.backgroundColor = getComputedStyle(document.documentElement).getPropertyValue('--cfirst');
</script>
<div class='modal' id='modal-wrapper'>
    <div class='modal-control'>
        <span id='close-modal' class="close">&times;</span>
        <div class='d-flex justify-content-center'>
            <div id='modal-add' class='modal-content'>
                <div class="d-flex justify-content-center mt-4">
                    <h3 class='h3'>Add Business</h3>
                </div>
                <div class="d-flex justify-content-center">
                    <div id='add-form'>
                        <div class='p-5'>
                            <label for="name">Name</label>
                            <input required type="text" class="form-control" id="add-name" name='name' aria-describedby="nameHelp" placeholder="Enter Name">
                            
                            <div class='d-flex'>
                                <div class='w-100 me-2'>
                                    <label for="year">Owner</label>
                                    <div class='d-flex justify-content-start w-100'>
                                        <input readonly type="text" class="form-control" id="add-owner" name='owner' placeholder="Owner">
                                        <button class='btn btn-primary' onclick="open_second_modal(true)">Select</button>
                                    </div>
                                </div>
                                <div class='w-100 ms-2'>
                                    <label for="building">PIN</label>
                                    <div class='d-flex justify-content-start w-100'>
                                        <input readonly type="text" class="form-control" id="add-building" name='building' placeholder="PIN">
                                        <button class='btn btn-primary' onclick="open_second_modal(false)">Select</button>
                                    </div>
                                </div>
                            </div>

                            <div class='d-flex'>
                                <div class='w-100'>
                                    <label for="year">Date</label>
                                    <input type="date" class="form-control" id="add-year" name='year' value="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class='w-100 ms-2'>
                                    <label for="type">Type</label>
                                    <select id='add-type' name='type' class="form-select">
                                        <option value='Single' selected>Single</option>
                                        <option value='Partnership'>Partnership</option>
                                        <option value='Corporation'>Corporation</option>
                                        <option value='Cooperative'>Cooperative</option>
                                    </select>
                                </div>
                                <div class='w-100 mx-2'>
                                    <label for="category">Category</label>
                                    <!--<input required type="text" class="form-control" id="category" name='category' placeholder="Enter Category">-->
                                    <select id='add-category' name='category' class="form-select">
                                        <option value='' selected>Select</option>
                                        <?php 
                                            foreach($category as $row){
                                                echo "<option value='".$row->name."'>".$row->name."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <hr class='mt-5 mb-4'>
                            <h2 class='h2'>Requirements</h2>
                            <div class='d-flex ps-5'>
                                <div class='w-50' style='font-size:21px;'>
                                    <label class="form-group ch_con" for="barangay" style='height:fit-content'>
                                        <input type="checkbox" id="add-barangay" style="width:20px;height:20px" name='barangay'>
                                        Barangay Business Clearance
                                    </label>
                                </div>
                                <div class='w-50' style='font-size:21px;'>
                                    <label class="form-group ch_con" for="tax" style='height:fit-content'>
                                        <input type="checkbox" id="add-tax" style="width:20px;height:20px" name='tax'>
                                        Community Tax Certificate
                                    </label>                
                                </div>
                            
                            </div>
                            <div class='d-flex ps-5'>
                                <div class='w-50' style='font-size:21px;'>
                                    <label class="form-group ch_con" for="dti" style='height:fit-content'>
                                        <input type="checkbox" id="add-dti" style="width:20px;height:20px" name='dti'>
                                        DTI Registration
                                    </label>                
                                </div>
                                <div class='w-50' style='font-size:21px;'>
                                    <label class="form-group ch_con" for="pic" style='height:fit-content'>
                                        <input type="checkbox" id="add-pic" style="width:20px;height:20px" name='pic'>
                                        2x2 Id Picture
                                    </label>                
                                </div>
                            </div>
                            <div class='d-flex ps-5'>
                                <div class='w-50' style='font-size:21px;'>
                                    <label class="form-group ch_con" for="sanitary" style='height:fit-content'>
                                        <input type="checkbox" id="add-sanitary" style="width:20px;height:20px" name='sanitary'>
                                        Health Sanitary Permit
                                    </label>                
                                </div>
                                <div class='w-50' style='font-size:21px;'>
                                    <label class="form-group ch_con" for="fire" style='height:fit-content'>
                                        <input type="checkbox" id="add-fire" style="width:20px;height:20px" name='fire'>
                                        Fire Safety Inspection Certificate
                                    </label>                
                                </div>
                            </div>
                            <div class='d-flex ps-5'>
                                <div class='w-50' style='font-size:21px;'>
                                    <label class="form-group ch_con" for="permit" style='height:fit-content'>
                                        <input type="checkbox" id="add-permit" style="width:20px;height:20px" name='permit'>
                                        Occupation Permit
                                    </label>                
                                </div>
                                <div class='w-50' style='font-size:21px;'>
                                    <label class="form-group ch_con" for="zone" style='height:fit-content'>
                                        <input type="checkbox" id="add-zone" style="width:20px;height:20px" name='zone'>
                                        Zoning Clearance
                                    </label>                
                                </div>
                            </div>
                            <div class='d-flex ps-5'>
                                <div class='w-50' style='font-size:21px;'>
                                    <label class="form-group ch_con" for="lease" style='height:fit-content'>
                                        <input type="checkbox" id="add-lease" style="width:20px;height:20px" name='lease'>
                                        Contract of Lease
                                    </label>                
                                </div>
                                <div class='w-50' style='font-size:21px;'>
                                    <label class="form-group ch_con" for="menro" style='height:fit-content'>
                                        <input type="checkbox" id="add-menro" style="width:20px;height:20px" name='menro'>
                                        MENRO Certificate
                                    </label>                
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <br><br><br>
                <div class="d-flex justify-content-end"'>
                    <button onclick="close_modal()" class="btn btn-primary px-5 py-3 mx-2">Cancel</button>
                    <button onclick="new_account()" class="btn btn-primary px-5 py-3 mx-2">Add</button>
                </div>
            </div>
        </div>
        
        <div class='d-flex justify-content-center'>
            <div id='modal-owner' class='modal-content'>
                <div class="d-flex justify-content-center mt-4">
                    <h3 class='h3'>Owner</h3>
                </div>
                <div class="d-flex justify-content-center">
                    <div id='add-form'>
                        <div class='p-5'>
                            <div class='d-flex'>
                                <div class='w-100 ms-1'>
                                    <label for="last">Last Name</label>
                                    <input required type="text" class="form-control" id="owner-last" name='last' aria-describedby="nameHelp" placeholder="Enter Last Name">
                                </div>
                                <div class='w-100 ms-1'>
                                    <label for="first">First Name</label>
                                    <input required type="text" class="form-control" id="owner-first" name='first' aria-describedby="nameHelp" placeholder="Enter First Name">
                                </div>
                                <div class='w-100 ms-1'>
                                    <label for="middle">Middle Name</label>
                                    <input required type="text" class="form-control" id="owner-middle" name='middle' aria-describedby="nameHelp" placeholder="Enter Middle Name">
                                </div>
                            </div>
                            <div class='d-flex'>
                                <div class='w-100 ms-1'>
                                    <label for="houseno">House No.</label>
                                    <input type="text" class="form-control" id="owner-houseno" name='houseno' aria-describedby="nameHelp" placeholder="House No.">
                                </div>
                                <div class='w-100 ms-1'>
                                    <label for="buildingname">Building Name</label>
                                    <input type="text" class="form-control" id="owner-buildingname" name='buildingname' aria-describedby="nameHelp" placeholder="Building Name">
                                </div>
                            </div>
                            <div class='d-flex'>
                                <div class='w-25 ms-1'>
                                    <label for="unitno">Unit No.</label>
                                    <input type="text" class="form-control" id="owner-unitno" name='unitno' aria-describedby="nameHelp" placeholder="Unit">
                                </div>
                                <div class='w-100 ms-1'>
                                    <label for="street">Street</label>
                                    <input type="text" class="form-control" id="owner-street" name='street' aria-describedby="nameHelp" placeholder="Street">
                                </div>
                                <div class='w-100 ms-1'>
                                    <label for="brgy">Barangay</label>
                                    <input type="text" class="form-control" id="owner-brgy" name='brgy' aria-describedby="nameHelp" placeholder="Barangay">
                                </div>
                            </div>
                            <div class='d-flex'>
                                <div class='w-100 ms-1'>
                                    <label for="subdivision">Subdivision</label>
                                    <input type="text" class="form-control" id="owner-subdivision" name='subdivision' aria-describedby="nameHelp" placeholder="Subdivision">
                                </div>
                                <div class='w-100 ms-1'>
                                    <label for="city">City/Munipality</label>
                                    <input type="text" class="form-control" id="owner-city" name='city' aria-describedby="nameHelp" value="Bayombong">
                                </div>
                                <div class='w-100 ms-1'>
                                    <label for="province">Province</label>
                                    <input type="text" class="form-control" id="owner-province" name='province' aria-describedby="nameHelp" value="Nueva Vizcaya">
                                </div>
                            </div>
                            <div class='d-flex'>
                                <div class='w-100 ms-1'>
                                    <label for="telno">Tel No.</label>
                                    <input type="text" class="form-control" id="owner-telno" name='telno' aria-describedby="nameHelp" placeholder="Tel. No">
                                </div>
                            </div>
                            <div class='d-flex'>
                                <div class='w-100 ms-1'>
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="owner-email" name='email' aria-describedby="nameHelp" placeholder="Email">
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <br><br><br>
                <div class="d-flex justify-content-end"'>
                    <button onclick="close_second_modal()" class="btn btn-primary px-5 py-3 mx-2">Cancel</button>
                    <button onclick="set_owner()" class="btn btn-primary px-5 py-3 mx-2">Save</button>
                </div>
            </div>
        </div>

        <div class='d-flex justify-content-center'>
            <div id='modal-pin' class='modal-content'>
                <div class="d-flex justify-content-center mt-4">
                    <h3 class='h3'>Property Index Number</h3>
                </div>
                <div class="d-flex justify-content-center">
                    <div id='add-form'>
                        <div class='p-5'>
                            <div class='d-flex'>
                                <div class='w-100 ms-1'>
                                    <label>PIN</label>
                                    <select id="pin-pin" onchange="set_fill_pin()" class='form-select'>
                                    </select>
                                </div>
                            </div>
                            <div class='d-flex'>
                                <div class='w-100 ms-1'>
                                    <label>Province</label>
                                    <select id="pin-province" onchange="fill_set_pin()" class='form-select'>
                                    </select>
                                </div>
                                <div class='w-100 ms-1'>
                                    <label>Municipal</label>
                                    <select id="pin-city" onchange="fill_set_pin()" class='form-select'>
                                    </select>
                                </div>
                                <div class='w-100 ms-1'>
                                    <label>Barangay</label>
                                    <select id="pin-barangay" onchange="fill_set_pin()" class='form-select'>
                                    </select>
                                </div>
                                <div class='w-100 ms-1'>
                                    <label>Street</label>
                                    <select id="pin-street" onchange="fill_set_pin()" class='form-select'>
                                    </select>
                                </div>
                            </div>
                            <div class='d-flex'>
                                <div class='w-100 ms-1'>
                                    <label>Building Name</label>
                                    <select id="pin-name" onchange="fill_set_pin()" class='form-select'>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br><br>
                <div class="d-flex justify-content-end"'>
                    <button onclick="close_third_modal()" class="btn btn-primary px-5 py-3 mx-2">Cancel</button>
                    <button onclick="choose_pin()" class="btn btn-primary px-5 py-3 mx-2">Choose</button>
                </div>
            </div>
        </div>

        <div class='d-flex justify-content-center'>
            <div id='modal-address' class='modal-content'>
                <div class="d-flex justify-content-center mt-4">
                    <h3 class='h3'>Address</h3>
                </div>
                <div class="d-flex justify-content-center">
                    <div id='add-form'>
                        <div class='p-5'>
                            <div class='d-flex'>
                                <div class='w-100 ms-1'>
                                    <label for="last">Property Index Number</label>
                                    <div class='d-flex justify-content-start w-100'>
                                    <input type="text" class="form-control" id="address-pin" name='last' aria-describedby="nameHelp" placeholder="PIN">
                                        <button class='btn btn-primary ms-2' onclick="open_third_modal()">Choose</button>
                                        <button class='btn btn-primary ms-2' onclick="refresh_address()">Refresh</button>
                                    </div>
                                </div>
                            </div>
                            <div class='d-flex'>
                                <div class='w-100 ms-1'>
                                    <label for="houseno">House No.</label>
                                    <input type="text" class="form-control" id="address-houseno" name='houseno' aria-describedby="nameHelp" placeholder="House No.">
                                </div>
                                <div class='w-100 ms-1'>
                                    <label for="buildingname">Building Name</label>
                                    <input type="text" class="form-control" id="address-buildingname" name='buildingname' aria-describedby="nameHelp" placeholder="Building Name">
                                </div>
                            </div>
                            <div class='d-flex'>
                                <div class='w-25 ms-1'>
                                    <label for="unitno">Unit No.</label>
                                    <input type="text" class="form-control" id="address-unitno" name='unitno' aria-describedby="nameHelp" placeholder="Unit">
                                </div>
                                <div class='w-100 ms-1'>
                                    <label for="street">Street</label>
                                    <input type="text" class="form-control" id="address-street" name='street' aria-describedby="nameHelp" placeholder="Street">
                                </div>
                                <div class='w-100 ms-1'>
                                    <label for="brgy">Barangay</label>
                                    <input type="text" class="form-control" id="address-brgy" name='brgy' aria-describedby="nameHelp" placeholder="Barangay">
                                </div>
                            </div>
                            <div class='d-flex'>
                                <div class='w-100 ms-1'>
                                    <label for="subdivision">Subdivision</label>
                                    <input type="text" class="form-control" id="address-subdivision" name='subdivision' aria-describedby="nameHelp" placeholder="Subdivision">
                                </div>
                                <div class='w-100 ms-1'>
                                    <label for="city">City/Munipality</label>
                                    <input type="text" class="form-control" id="address-city" name='city' aria-describedby="nameHelp" value="Bayombong">
                                </div>
                                <div class='w-100 ms-1'>
                                    <label for="province">Province</label>
                                    <input type="text" class="form-control" id="address-province" name='province' aria-describedby="nameHelp" value="Nueva Vizcaya">
                                </div>
                            </div>
                            <div class='d-flex'>
                                <div class='w-100 ms-1'>
                                    <label for="telno">Tel No.</label>
                                    <input type="text" class="form-control" id="address-telno" name='telno' aria-describedby="nameHelp" placeholder="Tel. No">
                                </div>
                            </div>
                            <div class='d-flex'>
                                <div class='w-100 ms-1'>
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="address-email" name='email' aria-describedby="nameHelp" placeholder="Email">
                                </div>
                            </div>
                            
                        </div>
                    </div> 
                </div>
                <br><br><br>
                <div class="d-flex justify-content-end"'>
                    <button onclick="close_second_modal()" class="btn btn-primary px-5 py-3 mx-2">Cancel</button>
                    <button onclick="set_address()" class="btn btn-primary px-5 py-3 mx-2">Save</button>
                </div>
            </div>
        </div>

        <div class='d-flex justify-content-center'>
            <div id='modal-edit' class='modal-content'>
                <div class="d-flex justify-content-center mt-4">
                    <h3 class='h3'>Edit Business</h3>
                </div>
                <div class="d-flex justify-content-center">
                <div id='add-form'>
                    <div class='p-5'>
                        <label for="name">Name</label>
                        <input required type="text" class="form-control" id="edit-name" name='name' aria-describedby="nameHelp" placeholder="Enter Name">

                        <div class='d-flex'>
                            <div class='w-100 me-2'>
                                <label for="year">Owner</label>
                                <div class='d-flex justify-content-start w-100'>
                                    <input required type="text" class="form-control" id="edit-owner" name='owner' placeholder="Owner">
                                    <button class='btn btn-primary' onclick="open_second_modal(true,true)">Select</button>
                                </div>
                            </div>
                            <div class='w-100 ms-2'>
                                <label for="building">PIN</label>
                                <div class='d-flex justify-content-start w-100'>
                                    <input type="text" class="form-control" id="edit-building" name='building' placeholder="PIN">
                                    <button class='btn btn-primary' onclick="open_second_modal(false,true)">Select</button>
                                </div>
                            </div>
                        </div>

                        <div class='d-flex'>
                            <div class='w-100'>
                                <label for="year">Date</label>
                                <input required type="date" class="form-control" id="edit-year" name='year' value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class='w-100 ms-2'>
                                    <label for="type">Type</label>
                                    <select id='edit-type' name='type' class="form-select">
                                        <option value='Single' selected>Single</option>
                                        <option value='Partnership'>Partnership</option>
                                        <option value='Corporation'>Corporation</option>
                                        <option value='Cooperative'>Cooperative</option>
                                    </select>
                                </div>
                            <div class='w-100 mx-2'>
                                <label for="category">Category</label>
                                <!--<input required type="text" class="form-control" id="category" name='category' placeholder="Enter Category">-->
                                <select id='edit-category' name='category' class="form-select">
                                    <option value='' selected>Select</option>
                                    <?php 
                                        foreach($category as $row){
                                            echo "<option value='".$row->name."'>".$row->name."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <hr class='mt-5 mb-4'>
                        <h2 class='h2'>Requirements</h2>
                        <div class='d-flex ps-5'>
                            <div class='w-50' style='font-size:21px;'>
                                <label class="form-group ch_con" for="barangay" style='height:fit-content'>
                                    <input type="checkbox" id="edit-barangay" style="width:20px;height:20px" name='barangay'>
                                    Barangay Business Clearance
                                </label>
                            </div>
                            <div class='w-50' style='font-size:21px;'>
                                <label class="form-group ch_con" for="tax" style='height:fit-content'>
                                    <input type="checkbox" id="edit-tax" style="width:20px;height:20px" name='tax'>
                                    Community Tax Certificate
                                </label>                
                            </div>
                           
                        </div>
                        <div class='d-flex ps-5'>
                            <div class='w-50' style='font-size:21px;'>
                                <label class="form-group ch_con" for="dti" style='height:fit-content'>
                                    <input type="checkbox" id="edit-dti" style="width:20px;height:20px" name='dti'>
                                    DTI Registration
                                </label>                
                            </div>
                            <div class='w-50' style='font-size:21px;'>
                                <label class="form-group ch_con" for="pic" style='height:fit-content'>
                                    <input type="checkbox" id="edit-pic" style="width:20px;height:20px" name='pic'>
                                    2x2 Id Picture
                                </label>                
                            </div>
                        </div>
                        <div class='d-flex ps-5'>
                            <div class='w-50' style='font-size:21px;'>
                                <label class="form-group ch_con" for="sanitary" style='height:fit-content'>
                                    <input type="checkbox" id="edit-sanitary" style="width:20px;height:20px" name='sanitary'>
                                    Health Sanitary Permit
                                </label>                
                            </div>
                            <div class='w-50' style='font-size:21px;'>
                                <label class="form-group ch_con" for="fire" style='height:fit-content'>
                                    <input type="checkbox" id="edit-fire" style="width:20px;height:20px" name='fire'>
                                    Fire Safety Inspection Certificate
                                </label>                
                            </div>
                        </div>
                        <div class='d-flex ps-5'>
                            <div class='w-50' style='font-size:21px;'>
                                <label class="form-group ch_con" for="permit" style='height:fit-content'>
                                    <input type="checkbox" id="edit-permit" style="width:20px;height:20px" name='permit'>
                                    Occupation Permit
                                </label>                
                            </div>
                            <div class='w-50' style='font-size:21px;'>
                                <label class="form-group ch_con" for="zone" style='height:fit-content'>
                                    <input type="checkbox" id="edit-zone" style="width:20px;height:20px" name='zone'>
                                    Zoning Clearance
                                </label>                
                            </div>
                        </div>
                        <div class='d-flex ps-5'>
                            <div class='w-50' style='font-size:21px;'>
                                <label class="form-group ch_con" for="lease" style='height:fit-content'>
                                    <input type="checkbox" id="edit-lease" style="width:20px;height:20px" name='lease'>
                                    Contract of Lease
                                </label>                
                            </div>
                            <div class='w-50' style='font-size:21px;'>
                                <label class="form-group ch_con" for="menro" style='height:fit-content'>
                                    <input type="checkbox" id="edit-menro" style="width:20px;height:20px" name='menro'>
                                    MENRO Certificate
                                </label>                
                            </div>
                        </div>
                    </div>
                </div> 
                </div>
                <br>
                <div class="d-flex justify-content-end">
                    <button onclick="close_modal()" class="btn btn-primary px-5 py-3 mx-2">Cancel</button>
                    <button onclick="edit_account()" class="btn btn-primary px-5 py-3 mx-2">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-start">
    <div class='w-100'>
    <div>
        <div class='d-flex justify-content-start my-2'>
            <button onclick="open_modal(false)" class='btn btn-primary w-25'>Add New</button>
            <input type="text" class="form-control w-100 mx-2" id="search" name='search' onchange="search()" placeholder="Search">
            <button class='btn btn-primary w-25'  onclick='search()'><img class='me-2' src='<?php echo base_url();?>Icon/magnifier.png' style='width:25px;height25px;'> Search</button>
            <button class='btn btn-primary ms-3 w-25'  onclick='reset_search()'><img class='me-2' src='<?php echo base_url();?>Icon/loading_arrow.png' style='width:25px;height25px;'> Refresh</button>
            <div class='w-100 d-flex justify-content-end me-5'>
                <button class='btn btn-primary px-5' onclick="table_get()">Report</button>
            </div>
        </div>
        <div class='view-main' style='overflow:auto;'>
            <table class='table view-table'>
                <thead>
                    <tr>
                        <td>BIN</td>
                        <td>Name</td>
                        <td>Owner</td>
                        <td>Type</td>
                        <td>Category</td>
                        <td>Status</td>
                        <td>Date</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($business as $row){
                            echo 
                            "
                            <tr>
                                <td>".$row->bin."</td>
                                <td>".$row->name."</td>
                                <td>".$row->owner."</td>
                                <td>".$row->type."</td>
                                <td>".$row->category."</td>
                                <td>".$row->status."</td>
                                <td>".$row->date."</td>
                                <td>
                                    <button onclick='open_view(".$row->number.")' type='button' class='btn btn-primary m-1'>View</button>
                                    <button onclick='open_modal(true,".$row->number.")' class='btn btn-primary m-1'>Edit</button>
                                    <button onclick='confirm_remove(".$row->number.")' class='btn btn-primary m-1'>Delete</button>
                                </td>
                            </tr>
                            ";
                        };
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>
</div>
<script>
    var all_pin = <?php echo json_encode($pin)?>;
    var all_address = <?php echo json_encode($address)?>;
    var all_business = <?php echo json_encode($business)?>;
    var available_pin = all_pin;
    var available_address = all_address;

    function set_fill_pin(){
        
        for(var x = 0; x < available_address.length; x++){
            if(available_address[x].pin == document.getElementById("pin-pin").value){

                document.getElementById("pin-name").value = available_address[x].building_id;
                break;
            }
        }
    }

    function fill_set_pin(){
        
        var set_street = document.getElementById("pin-street").value;
        var set_name = document.getElementById("pin-name").value;
        var set_province = document.getElementById("pin-province").value;
        var set_city = document.getElementById("pin-city").value;
        var set_barangay = document.getElementById("pin-barangay").value;

        //console.log(set_province);

        for(var x = 0; x < available_address.length; x++){
            if(available_address[x].building_id == document.getElementById("pin-street").value)
            set_street = available_address[x].street;
            if(available_address[x].building_id == document.getElementById("pin-name").value)
            set_name = available_address[x].building_name;
            if(available_address[x].building_id == document.getElementById("pin-province").value)
            set_province = available_address[x].province;
            if(available_address[x].building_id == document.getElementById("pin-city").value)
            set_city = available_address[x].city;
            if(available_address[x].building_id == document.getElementById("pin-barangay").value)
            set_barangay = available_address[x].barangay;
        }

        //console.log(available_address);
        var temp_available = [];
        for(var x = 0; x < available_address.length; x++){
            var val = true;
            val = (val && available_address[x].street.includes(set_street));
            val = (val && available_address[x].province.includes(set_province));
            val = (val && available_address[x].city.includes(set_city));
            val = (val && available_address[x].barangay.includes(set_barangay));
            if(val){
                temp_available.push(available_address[x]);
                //console.log(available_address[x]);
            }
        }
        
        var build_pin = "";
        var all_pin = [];

        var build_name = "";
        var all_name = [];

        
        //console.log(temp_available);
        for(x in temp_available){
            if(!all_pin.includes(temp_available[x].pin))
            build_pin += "<option value="+temp_available[x].pin+">"+temp_available[x].pin+"</option>";
            if(!all_name.includes(temp_available[x].pin))
            build_name += "<option value="+temp_available[x].building_id+">"+temp_available[x].building_name+"</option>";
            
            all_pin.push(temp_available[x].pin);
            all_pin.push(temp_available[x].building_name);
        };

        document.getElementById("pin-pin").innerHTML = build_pin;
        document.getElementById("pin-name").innerHTML = build_name;
    }

    function fill_pin(temp_address){
        var build_name = "";
        var build_pin = "";
        var build_street = "";
        var build_province = "";
        var build_city = "";
        var build_barangay = "";
        var all_name = [];
        var all_pin = [];
        var all_street = [];
        var all_province = [];
        var all_city = [];
        var all_barangay = [];

        for(i in available_address){
            if(!all_name.includes(available_address[i].building_name))
            build_name += "<option value="+available_address[i].building_id+">"+available_address[i].building_name+"</option>";
            if(!all_street.includes(available_address[i].street))
            build_street += "<option value="+available_address[i].building_id+">"+available_address[i].street+"</option>";
            if(!all_province.includes(available_address[i].province))
            build_province += "<option value="+available_address[i].building_id+">"+available_address[i].province+"</option>";
            if(!all_pin.includes(available_address[i].pin))
            build_pin += "<option value="+available_address[i].pin+">"+available_address[i].pin+"</option>";
            if(!all_city.includes(available_address[i].city))
            build_city += "<option value="+available_address[i].building_id+">"+available_address[i].city+"</option>";
            if(!all_barangay.includes(available_address[i].barangay))
            build_barangay += "<option value="+available_address[i].building_id+">"+available_address[i].barangay+"</option>";
        
            all_name.push(available_address[i].building_name);
            all_pin.push(available_address[i].pin);
            all_street.push(available_address[i].street);
            all_province.push(available_address[i].province);
            all_city.push(available_address[i].city);
            all_barangay.push(available_address[i].barangay);
            
        }


        document.getElementById("pin-name").innerHTML = "<option value=''>Select</option>"+build_name;
        document.getElementById("pin-street").innerHTML = "<option value=''>Select</option>"+build_street;
        document.getElementById("pin-province").innerHTML = "<option value=''>Select</option>"+build_province;
        document.getElementById("pin-city").innerHTML = "<option value=''>Select</option>"+build_city;
        document.getElementById("pin-barangay").innerHTML = "<option value=''>Select</option>"+build_barangay;
        document.getElementById("pin-pin").innerHTML = "<option value=''>Select</option>"+build_pin;
    }

    function choose_pin(){
        document.getElementById("address-pin").value = document.getElementById("pin-pin").value;
        choose_address();
        close_third_modal();
    }

    function set_address(){
        var selected_pin = document.getElementById("address-pin").value;
        
        document.getElementById("add-building").value = selected_pin;
        document.getElementById("edit-building").value = selected_pin;
        close_second_modal();
    }

    function set_owner(){
        
        var firstname = document.getElementById("owner-first").value;
        var lastname = document.getElementById("owner-last").value;
        var middlename = document.getElementById("owner-middle").value;
        document.getElementById("add-owner").value = lastname +", " + firstname +" " + middlename;
        document.getElementById("edit-owner").value = lastname +", " + firstname +" " + middlename;
        close_second_modal();
    }
    
    function choose_owner(id){
        $.post("<?php echo site_url("business/findowner");?>/"+id,{},function(a,b){
            var database = JSON.parse(a);
            document.getElementById("owner-last").value = database.last_name;
            document.getElementById("owner-first").value = database.first_name;
            document.getElementById("owner-middle").value = database.middle_name;
            document.getElementById("owner-houseno").value = database.house_no;
            document.getElementById("owner-buildingname").value = database.building_name;
            document.getElementById("owner-unitno").value = database.unit_no;
            document.getElementById("owner-street").value = database.street;
            document.getElementById("owner-brgy").value = database.barangay;
            document.getElementById("owner-subdivision").value = database.subdivision;
            document.getElementById("owner-city").value = database.city;
            document.getElementById("owner-province").value = database.province;
            document.getElementById("owner-telno").value = database.tel_no;
            document.getElementById("owner-email").value = database.email_address;

        })
    }

    function choose_address(){
        var selected_pin = document.getElementById("address-pin").value;
        var chosen_address = null;
        for(i in all_address){
            if(all_address[i].pin == selected_pin){
                chosen_address = all_address[i];
                break;
            }
        }

        if(chosen_address){
            document.getElementById("address-houseno").value = chosen_address.bldg_no;
            document.getElementById("address-buildingname").value = chosen_address.building_name;
            document.getElementById("address-unitno").value = chosen_address.unit_no;
            document.getElementById("address-street").value = chosen_address.street;
            document.getElementById("address-brgy").value = chosen_address.barangay;
            document.getElementById("address-subdivision").value = chosen_address.subdivision;
            document.getElementById("address-city").value = chosen_address.city;
            document.getElementById("address-province").value = chosen_address.province;
            document.getElementById("address-telno").value = chosen_address.tel_no;
            document.getElementById("address-email").value = chosen_address.email_address;

            if(document.getElementById("address-pin").value && document.getElementById("address-pin").value != 0){document.getElementById("address-pin").disabled = true};
            if(document.getElementById("address-houseno").value  && document.getElementById("address-houseno").value != 0)document.getElementById("address-houseno").disabled = true;
            if(document.getElementById("address-buildingname").value)document.getElementById("address-buildingname").disabled = true;
            if(document.getElementById("address-unitno").value && document.getElementById("address-unitno").value != 0)document.getElementById("address-unitno").disabled = true;
            if(document.getElementById("address-street").value)document.getElementById("address-street").disabled = true;
            if(document.getElementById("address-brgy").value)document.getElementById("address-brgy").disabled = true;
            if(document.getElementById("address-subdivision").value) document.getElementById("address-subdivision").disabled = true;
            if(document.getElementById("address-city").value)document.getElementById("address-city").disabled = true;
            if(document.getElementById("address-province").value)document.getElementById("address-province").disabled = true;
            if(document.getElementById("address-telno").value && document.getElementById("address-telno").value != 0)document.getElementById("address-telno").disabled = true;
            if(document.getElementById("address-email").value)document.getElementById("address-email").disabled = true;
        }
    }

    function refresh_address(){
        document.getElementById("address-pin").disabled = false;
        document.getElementById("address-houseno").disabled = false;
        document.getElementById("address-buildingname").disabled = false;
        document.getElementById("address-unitno").disabled = false;
        document.getElementById("address-street").disabled = false;
        document.getElementById("address-brgy").disabled = false;
        document.getElementById("address-subdivision").disabled = false;
        document.getElementById("address-city").disabled = false;
        document.getElementById("address-province").disabled = false;
        document.getElementById("address-telno").disabled = false;
        document.getElementById("address-email").disabled = false;

        document.getElementById("address-pin").value = "";
        document.getElementById("address-houseno").value = "";
        document.getElementById("address-buildingname").value = "";
        document.getElementById("address-unitno").value = "";
        document.getElementById("address-street").value = "";
        document.getElementById("address-brgy").value = "";
        document.getElementById("address-subdivision").value = "";
        document.getElementById("address-city").value = "Bayombong";
        document.getElementById("address-province").value = "Nueva Vizcaya";
        document.getElementById("address-telno").value = "";
        document.getElementById("address-email").value = "";
    }

    fill_pin(available_address);
</script>
<script>
    var editting = false;
    var selected = -1;
    var edit_owner_id = -1;
    
    function confirm_remove(id){
        if(confirm("Do you wish to delete this business?")){
            window.location.href = "<?php echo site_url("business/delete_business")."/";?>" + id;
        }
    }

    var all_checkbox = document.getElementsByClassName("ch_con");

    for(var i = 0; i < all_checkbox.length; i++){
        all_checkbox[i].addEventListener('click',function(e){
            var inp = this.getElementsByTagName("input");
            if(inp[0].checked){
                inp[0].checked = false;
            }else{
                inp[0].checked = true;
            }
        });
    }
    
    function close_third_modal(){
        
        document.getElementById("modal-pin").style.display = 'none';
        document.getElementById("modal-address").style.display = 'block';
    }

    function open_third_modal(){
        document.getElementById("modal-address").style.display = 'none';
        document.getElementById("modal-pin").style.display = 'block';
    }
    
    function open_second_modal(isOwner = false,isEdit = false){
        if(isOwner){
            document.getElementById("modal-owner").style.display = 'block';
        }else{
            document.getElementById("modal-address").style.display = 'block';
        }

        if(isEdit){
            document.getElementById('modal-edit').style.display = 'none';
        }else{
            document.getElementById('modal-add').style.display = 'none';
        }
    }

    function open_modal(isEdit = false,num = -1){
        editting = isEdit;
        selected = num;

        document.getElementById("modal-wrapper").style.display = 'block';
        document.getElementById("modal-owner").style.display = 'none';
        document.getElementById("modal-address").style.display = 'none';
        document.getElementById("modal-pin").style.display = 'none';

        if(isEdit){
            document.getElementById('modal-add').style.display = 'none';
            document.getElementById('modal-edit').style.display = 'block';
            
            
            $.post("<?php echo site_url("business/find");?>/"+selected,{},function(a,b){
                var database = JSON.parse(a);
                document.getElementById('edit-name').value = database.name;
                document.getElementById('edit-owner').value = database.owner;
                document.getElementById('edit-category').value = database.category;
                document.getElementById('edit-year').value = database.date;
                document.getElementById('edit-type').value = database.type;
                document.getElementById('edit-building').value = database.building_id;
                document.getElementById("address-pin").value = database.building_id;
                choose_address();
                choose_owner(database.owner_id);
                edit_owner_id = database.owner_id;
                
                if(database.fire_clearance == 1){document.getElementById('edit-fire').checked = true;}else{document.getElementById('edit-fire').checked = false;};
                if(database.tax_clearance == 1){document.getElementById('edit-tax').checked = true;}else{document.getElementById('edit-tax').checked = false;};
                if(database.barangay_clearance == 1){document.getElementById('edit-barangay').checked = true;}else{document.getElementById('edit-barangay').checked = false;};
                if(database.sanitary_clearance == 1){document.getElementById('edit-sanitary').checked = true;}else{document.getElementById('edit-sanitary').checked = false;};
                if(database.building_permit == 1){document.getElementById('edit-permit').checked = true;}else{document.getElementById('edit-permit').checked = false;};
                if(database.dti_registration == 1){document.getElementById('edit-dti').checked = true;}else{document.getElementById('edit-dti').checked = false;};
                if(database.zoning_clearance == 1){document.getElementById('edit-zone').checked = true;}else{document.getElementById('edit-zone').checked = false;};
                if(database.contract_lease == 1){document.getElementById('edit-lease').checked = true;}else{document.getElementById('edit-lease').checked = false;};
                if(database.menro_cert == 1){document.getElementById('edit-menro').checked = true;}else{document.getElementById('edit-menro').checked = false;};
                if(database.pic_clearance == 1){document.getElementById('edit-pic').checked = true;}else{document.getElementById('edit-pic').checked = false;};
                
            });

            //$this->Business_Model->get_business($id);
            //$data['category'] = $this->Business_Model->get_categories();
            
        }else{
            document.getElementById('modal-add').style.display = 'block';
            document.getElementById('modal-edit').style.display = 'none';
        }
    }

    function search(){
        var usearch = document.getElementById("search").value;
        window.location.href = '<?php echo site_url("main/businesses")?>/?search='+usearch;
    }
    
    function new_account(){
        var addresspin = "";
        if(document.getElementById("address-pin").value != ""){
            addresspin = document.getElementById("address-pin").value;
        }
        
        $.post('<?php echo site_url('business/add_business');?>',{
            name:document.getElementById('add-name').value,
            owner:document.getElementById('add-owner').value,
            category:document.getElementById('add-category').value,
            year:document.getElementById('add-year').value,
            type:document.getElementById('add-type').value,
            building:document.getElementById('add-building').value,
            fire:document.getElementById('add-fire').checked,
            tax:document.getElementById('add-tax').checked,
            barangay:document.getElementById('add-barangay').checked,
            sanitary:document.getElementById('add-sanitary').checked,
            zone:document.getElementById('add-zone').checked,
            dti:document.getElementById('add-dti').checked,
            lease:document.getElementById('add-lease').checked,
            pic:document.getElementById('add-pic').checked,
            menro:document.getElementById('add-menro').checked,
            permit:document.getElementById('add-permit').checked,

            owner_first:document.getElementById("owner-first").value,
            owner_last:document.getElementById("owner-last").value,
            owner_middle:document.getElementById("owner-middle").value,
            owner_houseno:document.getElementById("owner-houseno").value ,
            owner_buildingname:document.getElementById("owner-buildingname").value ,
            owner_unitno:document.getElementById("owner-unitno").value,
            owner_street:document.getElementById("owner-street").value,
            owner_brgy:document.getElementById("owner-brgy").value ,
            owner_subdivision:document.getElementById("owner-subdivision").value,
            owner_city:document.getElementById("owner-city").value,
            owner_province:document.getElementById("owner-province").value,
            owner_telno:document.getElementById("owner-telno").value,
            owner_email:document.getElementById("owner-email").value,

            address_pin:addresspin,
            address_houseno:document.getElementById("address-houseno").value ,
            address_buildingname:document.getElementById("address-buildingname").value ,
            address_unitno:document.getElementById("address-unitno").value,
            address_street:document.getElementById("address-street").value,
            address_brgy:document.getElementById("address-brgy").value ,
            address_subdivision:document.getElementById("address-subdivision").value,
            address_city:document.getElementById("address-city").value,
            address_province:document.getElementById("address-province").value,
            address_telno:document.getElementById("address-telno").value,
            address_email:document.getElementById("address-email").value
        },function(data,status){
            
            if(status == "success"){
                alert("Business Added");
                close_modal();
                location.reload();
            }
        });
    }

    function new_address(){

        /*
        "pin" => $data->post("pin"),
            "bldg_no" => $data->post("bldg_no"),
            "building_name" => $data->post("bldg_name"),
            "unit_no" => $data->post("address_unit_no"),
            "street" => $data->post("address_street"),
            "barangay" => $this->check_clearance($data->post("address_barangay")),
            "subdivision" => $this->check_clearance($data->post("address_subdivision")),
            "city" => $this->check_clearance($data->post("address_city")),
            "province" => $this->check_clearance($data->post("address_province")),
            "tel_no" => $this->check_clearance($data->post("address_tel_no")),
            "email_address" => $this->check_clearance($data->post("address_email")),
        */
        $.post('<?php echo site_url('business/add_business');?>',{
            //pin:document.getElementById('add-name').value,
            bldg_no:document.getElementById('address-houseno').value,
            bldg_name:document.getElementById('address-buildingname').value,
            address_unit_no:document.getElementById('address-unitno').value,
            address_street:document.getElementById('address-street').value,
            address_barangay:document.getElementById('address-brgy').value,
            address_subdivision:document.getElementById('address-subdivision').value,
            address_city:document.getElementById('address-city').value,
            address_tel_no:document.getElementById('address-telno').value,
            address_email:document.getElementById('address-email').value
        },function(data, status){
            if(status == "success"){
                alert("Business Added");
                close_modal();
                location.reload();
            }
        });
    }

    function reset_search(){
        window.location.href = '<?php echo site_url("main/businesses")?>';
    }
    
    function edit_account(){
        if(selected != -1){
            
            $.post('<?php echo site_url('business/edit_business');?>'+'/'+selected,{
                name:document.getElementById('edit-name').value,
                owner:document.getElementById('edit-owner').value,
                category:document.getElementById('edit-category').value,
                year:document.getElementById('edit-year').value,
                type:document.getElementById('edit-type').value,
                building:document.getElementById('edit-building').value,
                fire:document.getElementById('edit-fire').checked,
                tax:document.getElementById('edit-tax').checked,
                barangay:document.getElementById('edit-barangay').checked,
                sanitary:document.getElementById('edit-sanitary').checked,
                zone:document.getElementById('edit-zone').checked,
                dti:document.getElementById('edit-dti').checked,
                lease:document.getElementById('edit-lease').checked,
                pic:document.getElementById('edit-pic').checked,
                menro:document.getElementById('edit-menro').checked,
                permit:document.getElementById('edit-permit').checked,

                owner_id:edit_owner_id,
                owner_first:document.getElementById("owner-first").value,
                owner_last:document.getElementById("owner-last").value,
                owner_middle:document.getElementById("owner-middle").value,
                owner_houseno:document.getElementById("owner-houseno").value ,
                owner_buildingname:document.getElementById("owner-buildingname").value ,
                owner_unitno:document.getElementById("owner-unitno").value,
                owner_street:document.getElementById("owner-street").value,
                owner_brgy:document.getElementById("owner-brgy").value ,
                owner_subdivision:document.getElementById("owner-subdivision").value,
                owner_city:document.getElementById("owner-city").value,
                owner_province:document.getElementById("owner-province").value,
                owner_telno:document.getElementById("owner-telno").value,
                owner_email:document.getElementById("owner-email").value,

                address_pin:document.getElementById("address-pin").value,
                address_houseno:document.getElementById("address-houseno").value ,
                address_buildingname:document.getElementById("address-buildingname").value ,
                address_unitno:document.getElementById("address-unitno").value,
                address_street:document.getElementById("address-street").value,
                address_brgy:document.getElementById("address-brgy").value ,
                address_subdivision:document.getElementById("address-subdivision").value,
                address_city:document.getElementById("address-city").value,
                address_province:document.getElementById("address-province").value,
                address_telno:document.getElementById("address-telno").value,
                address_email:document.getElementById("address-email").value

            },function(a,b){
                
                
                location.reload();
                
            });    
            alert("Business Edited");
            location.reload();
        }
    }

    function close_second_modal(){
        isEdit = editting;

        if(isEdit){
            document.getElementById('modal-edit').style.display = 'block';
        }else{
            document.getElementById('modal-add').style.display = 'block';
        }

        document.getElementById("modal-owner").style.display = 'none';
        document.getElementById("modal-address").style.display = 'none';
    }
    function close_modal(){
        document.getElementById("modal-wrapper").style.display = 'none';
    }
    window.onclick = function(event) {
        if (event.target == document.getElementById("modal-wrapper")) {
            close_modal();
        }
    }

    document.getElementById("close-modal").addEventListener('click',close_modal);

    function open_view(e){
        window.location.href = "<?php echo site_url('main/display')?>/"+e;
    }

    function table_get(){
        //console.log(all_business);
        postAndRedirect('<?php echo site_url('main/custom');?>', all_business);
        /*
        $.post('<?php echo site_url('main/custom');?>',all_business,function(a,b){
            
        });*/
    }

    function postAndRedirect(url, postData){
        var postFormStr = "<form method='POST' action='" + url + "'>\n";
        
        for(var i = 0; i < postData.length; i++){
            
            postFormStr += "<input type='hidden' name='" + i + "' value='" + JSON.stringify(postData[i]) + "'></input>";
                
        }
        postFormStr += "</form>";

        var formElement = $(postFormStr);
        $('body').append(formElement);
        $(formElement).submit();
    }
</script>