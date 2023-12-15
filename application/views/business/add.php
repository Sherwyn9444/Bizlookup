
<div class="d-flex justify-content-center">
<form id='add-form' method='POST' action='<?php echo site_url("business/add_business")?>'>
    <div class="form-group p-4">
        <label for="name">Name</label>
        <input required type="text" class="form-control" id="name" name='name' aria-describedby="nameHelp" placeholder="Enter Name">
        
        <label for="owner">Owner</label>
        <input required type="text" class="form-control" id="owner" name='owner' placeholder="Enter Owner">
        
        <div class='d-flex'>
            <div class='w-100'>
                <label for="year">Date</label>
                <input required type="date" class="form-control" id="year" name='year' value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class='w-100'>
                <label for="status">Status</label>
                <select name='status' class="form-select">
                    <option value='Active' selected>Active</option>
                    <option value='Inactive'>Inactive</option>
                </select>
            </div>
        <!--<input type="text" class="form-control" id="status" name='status' placeholder="Enter Status">-->
            <div class='w-100 mx-2'>
                <label for="category">Category</label>
                <!--<input required type="text" class="form-control" id="category" name='category' placeholder="Enter Category">-->
                <select name='category' class="form-select">
                    <option value='' selected>Select</option>
                    <?php 
                        foreach($category as $row){
                            echo "<option value='".$row->name."'>".$row->name."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class='w-25'>
                <label for="building">PIN</label>
                <input readonly type="text" class="form-control" id="building" name='building' value = <?php echo $id;?>>
            </div>
        </div>
        <hr class='mt-5 mb-4'>
        <h2 class='h2'>Clearances</h2>
        <div class='d-flex ps-5'>
            <div class='w-50'>
                <label class="ch_container" for="barangay">Barangay Clearance
                    <input type="checkbox" id="barangay" name='barangay'>
                    <span class="checkmark mt-2"></span>
                </label>                
            </div>
            <div class='w-50'>
                <label class="ch_container" for="sanitary">Sanitary Clearance
                    <input type="checkbox" id="sanitary" name='sanitary'>
                    <span class="checkmark mt-2"></span>
                </label>                
            </div>
        </div>
        <div class='d-flex ps-5'>
            <div class='w-50'>
                <label class="ch_container" for="tax">Tax (BIR) Clearance
                    <input type="checkbox" id="tax" name='tax'>
                    <span class="checkmark mt-2"></span>
                </label>                
            </div>
            <div class='w-50'>
                <label class="ch_container" for="fire">Fire Clearance
                    <input type="checkbox" id="fire" name='fire'>
                    <span class="checkmark mt-2"></span>
                </label>                
            </div>
        </div>
        <div class='d-flex ps-5'>
            <div class='w-50'>
                <label class="ch_container" for="permit">Building Permit
                    <input type="checkbox" id="permit" name='permit'>
                    <span class="checkmark mt-2"></span>
                </label>                
            </div>
        </div>
        
    </div>
    <input type='hidden' class="form-control" id="coordinate-x" name='x' value = 0>
    <input type='hidden' class="form-control" id="coordinate-y" name='y' value = 0>
    <div class='r-side-control'>
        <button type="submit" id='add-form-submit' class="btn btn-primary">Add</button>
    </div>
</form> 
</div>
<div class='l-side-control'>
    <a href='<?php echo base_url()?>' type="button" id='add-form-submit' class="btn btn-primary">Back</a>
</div>
