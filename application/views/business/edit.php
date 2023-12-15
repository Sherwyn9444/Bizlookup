
<div class="d-flex justify-content-center">
<form id='add-form' method='POST' action='<?php echo site_url("business/edit_business") . '/' . $business->number?>'>
    <div class="form-group p-4">
        <label for="name">Name</label>
        <input required type="text" class="form-control" id="name" name='name' aria-describedby="nameHelp" value = "<?php echo $business->name?>">
        
        <label for="owner">Owner</label>
        <input required type="text" class="form-control" id="owner" name='owner' value = "<?php echo $business->name?>">
           
        <label for="year">Date</label>
        <input required type="date" class="form-control" id="year" name='year' value="<?php echo $business->date; ?>">
        
        <label for="status">Status</label>
        <select name='status' class="form-select">
            <?php
                if($business->status == 'Active'){
                    echo "<option value='Active' selected>Active</option><option value='Inactive'>Inactive</option>";
                }else if($business->status == 'Inactive'){
                    echo "<option value='Active'>Active</option><option value='Inactive' selected>Inactive</option>";
                }else{
                    echo "<option value='' selected></option><option value='Active'>Active</option><option value='Inactive'>Inactive</option>";
                }
            ?>
        </select>
        <!--<input type="text" class="form-control" id="status" name='status' placeholder="Enter Status">-->
        
        <label for="category">Category</label>
        <!--<input required type="text" class="form-control" id="category" name='category' placeholder="Enter Category">-->
        <select name='category' class="form-select">
            <option value='' selected>Select</option>
            <?php 
                foreach($category as $row){
                    if($row->name == $business->category){
                        echo "<option value='".$row->name."' selected>".$row->name."</option>";
                    }else{
                        echo "<option value='".$row->name."'>".$row->name."</option>";
                    }
                    
                }
            ?>
        </select>
        <label for="building">PIN</label>
        <input readonly type="text" class="form-control" id="building" name='building' value = <?php echo $business->building_id;?>>

        <hr class='mt-5 mb-4'>
        <h2 class='h2'>Clearances</h2>
        <div class='d-flex ps-5'>
            <div class='w-50'>
                <label class="ch_container" for="barangay">Barangay Clearance
                    <input type="checkbox" id="barangay" name='barangay' <?php if($business->barangay_clearance){echo 'checked';}?>>
                    <span class="checkmark mt-2"></span>
                </label>                
            </div>
            <div class='w-50'>
                <label class="ch_container" for="sanitary">Sanitary Clearance
                    <input type="checkbox" id="sanitary" name='sanitary' <?php if($business->sanitary_clearance){echo 'checked';}?>>
                    <span class="checkmark mt-2"></span>
                </label>                
            </div>
        </div>
        <div class='d-flex ps-5'>
            <div class='w-50'>
                <label class="ch_container" for="tax">Tax (BIR) Clearance
                    <input type="checkbox" id="tax" name='tax' <?php if($business->tax_clearance){echo 'checked';}?>>
                    <span class="checkmark mt-2"></span>
                </label>                
            </div>
            <div class='w-50'>
                <label class="ch_container" for="fire">Fire Clearance
                    <input type="checkbox" id="fire" name='fire' <?php if($business->fire_clearance){echo 'checked';}?>>
                    <span class="checkmark mt-2"></span>
                </label>                
            </div>
        </div>
        <div class='d-flex ps-5'>
            <div class='w-50'>
                <label class="ch_container" for="permit">Building Permit
                    <input type="checkbox" id="permit" name='permit' <?php if($business->building_permit){echo 'checked';}?>>
                    <span class="checkmark mt-2"></span>
                </label>                
            </div>
        </div>
    </div>
   
    <div class='r-side-control'>
        <button type="submit" id='add-form-submit' class="btn btn-primary">Save</button>
    </div>
</form> 
</div>
<div class='l-side-control'>
    <a href='<?php echo site_url("main/business") .'/'. $business->building_id;?>' type="button" id='add-form-submit' class="btn btn-primary">Back</a>
</div>
