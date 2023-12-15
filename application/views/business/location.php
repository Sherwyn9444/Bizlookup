<script>
    document.getElementById("side-locations").style.backgroundColor = getComputedStyle(document.documentElement).getPropertyValue('--cfirst');
</script>
<div class='modal' id='modal-wrapper'>
    <div class='modal-control'>
        <span id='close-modal' class="close">&times;</span>
        <div class='d-flex justify-content-center'>
            <div id='modal-add'>
                <div class="d-flex justify-content-center mt-4">
                    <h3 class='h3'>Location</h3>
                </div>
                <div class="d-flex justify-content-center">
                <?= form_open_multipart('map/add') ?>
                    <div id='add-map-form'>
                        <div class="p-5">
                            <div class="form-group w-100">
                                <div class='d-flex'>
                                    <div class='w-25'>
                                        <label for="pid">PIN</label>
                                        <input required type="text" class="form-control" id="pid" name='pid' aria-describedby="nameHelp" placeholder="Enter PIN">
                                    </div>
                                    <div class='w-100 ms-2'>
                                        <label for="name">Name</label>
                                        <input required type="text" class="form-control" id="add-name" name='name' aria-describedby="nameHelp" placeholder="Enter Name">
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
                                    <div class='w-100'>
                                        <label for="category">Owner</label>
                                        <input type="text" class="form-control" id="add-owner" name='owner' placeholder="Enter Property Owner">
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

                                
                                <div class='d-flex'>
                                    <div class='w-100 me-1'>
                                        <label for="image">Upload Image</label>
                                        <input type="file" class="form-control py-2" id="add-image" name='image'>
                                    </div>

                                    <div class='w-100 ms-1'>
                                        <label for="x">Coordinates</label>
                                        <div class='d-flex justify-content-between'>
                                            <input type='text' class="form-control" id="add-coordinate-y" onchange="toMap()" name='y' placeholder = Longitude>
                                            <input type='text' class="form-control" id="add-coordinate-x" onchange="toMap()" name='x' placeholder = Latitude>
                                            <img id='refresh' class='refresh-button ms-2'></img>
                                        </div>
                                    </div>
                                </div>
                                <div class='d-flex mt-4'>
                                    <div class='w-100 me-1' style='border: 1px solid'>
                                        <img id='add-upload-image' alt="image" style='width:365px;height:365px;object-fit:contain;visibility:hidden;'>
                                    </div>
                                    <div class='w-100 ms-1'>
                                        <div id='add-map' style='width:100%;height:365px;'></div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-group p-2 w-100">
                                <div class="d-flex justify-content-end m-2">
                                    <button onclick="close_modal()" type="button" class="btn btn-primary px-5 py-3 mx-2">Cancel</button>
                                    <button type='button' onclick="handle_submit()" class="btn btn-primary px-5 py-3 mx-2">Save</button>
                                </div>
                            </div> 
                        </div>
                        
                    </div> 
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
            <input type="text" class="form-control w-100 mx-2" id="search" name='search' onchange="g_search()" placeholder="Search">
            <button class='btn btn-primary w-25'  onclick='g_search()'><img class='me-2' src='<?php echo base_url();?>Icon/magnifier.png' style='width:25px;height25px;'> Search</button>
            <button class='btn btn-primary ms-3 w-25'  onclick='reset_search()'><img class='me-2' src='<?php echo base_url();?>Icon/loading_arrow.png' style='width:25px;height25px;'> Refresh</button>
            <div class='w-100'></div>
        </div>
        <div class='view-main' style='overflow:auto;'>
            <table class='table view-table'>
                <thead>
                    <tr>
                        <td>PIN</td>
                        <td>Name</td>
                        <td>Location</td>
                        <td>Address</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($location as $row){
                            echo 
                            "
                            <tr>
                                <td>".$row->pin."</td>";
                            if($row->name){
                                echo "<td>".$row->name."</td>";
                            }else{
                                echo "<td>Unnamed Location</td>";
                            }
                            echo "<td>".$row->x.",".$row->y."</td>
                                <td>".$row->address."</td>
                                <td>
                                    <button onclick='open_data(".$row->pin.")' type='button' class='btn btn-primary m-1'>View</button>
                                    <button onclick='open_modal(true,".$row->pin.")' class='btn btn-primary m-1'>Edit</button>
                                    <button onclick='confirm_remove(".$row->pin.")' class='btn btn-primary m-1'>Delete</button>
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
<script>
    var selected = -1;
    var num_pin = 0;
    var editting = false;
    function confirm_remove(id){
        if(confirm("Do you wish to delete this location?")){
            window.location.href = "<?php echo site_url("map/delete")."/";?>" + id;
        }
    }

    function handle_submit(){
        if(editting){
            submit_edit();
        }else{
            submit_add();
        }
        document.getElementsByTagName("form")[0].submit();
    }

    function submit_add(){
        $.post("<?php echo site_url("map/add_data");?>",{
            pid:document.getElementById("pid").value,
            houseno:document.getElementById("address-houseno").value,
            buildingname:document.getElementById("address-buildingname").value,
            unitno:document.getElementById("address-unitno").value,
            street:document.getElementById("address-street").value,
            brgy:document.getElementById("address-brgy").value,
            subdivision:document.getElementById("address-subdivision").value,
            city:document.getElementById("address-city").value,
            province:document.getElementById("address-province").value,
            telno:document.getElementById("address-telno").value,
            email:document.getElementById("address-email").value,
            name:document.getElementById("add-name").value,
            owner:document.getElementById("add-owner").value,
            x:document.getElementById("add-coordinate-x").value,
            y:document.getElementById("add-coordinate-y").value
        },
        function(a,b){
            alert("Add Location is "+b)
        });
        alert("Location Added");
        location.reload();
    }

    function submit_edit(){
        $.post("<?php echo site_url("map/edit_data");?>",{
            pid:document.getElementById("pid").value,
            houseno:document.getElementById("address-houseno").value,
            buildingname:document.getElementById("address-buildingname").value,
            unitno:document.getElementById("address-unitno").value,
            street:document.getElementById("address-street").value,
            brgy:document.getElementById("address-brgy").value,
            subdivision:document.getElementById("address-subdivision").value,
            city:document.getElementById("address-city").value,
            province:document.getElementById("address-province").value,
            telno:document.getElementById("address-telno").value,
            email:document.getElementById("address-email").value,
            name:document.getElementById("add-name").value,
            owner:document.getElementById("add-owner").value,
            x:document.getElementById("add-coordinate-x").value,
            y:document.getElementById("add-coordinate-y").value
        },
        function(a,b){
            alert("Edit Location is "+b)
        });
        alert("Location Saved");
        location.reload();
    }

    function open_modal(isEdit = false,num = -1){
        selected = num;
        document.getElementById("modal-wrapper").style.display = 'block';
        if(isEdit){
            editting = true;
            document.getElementById('modal-add').style.display = 'block';

            document.getElementById("address-houseno").value = "";
            document.getElementById("address-buildingname").value = "";
            document.getElementById("address-unitno").value = "";
            document.getElementById("address-street").value = "";
            document.getElementById("address-brgy").value = "";
            document.getElementById("address-subdivision").value = "";
            document.getElementById("address-city").value ="Bayombong";
            document.getElementById("address-province").value = "Nueva Vizcaya";
            document.getElementById("address-telno").value = "";
            document.getElementById("address-email").value = "";

            $.post("<?php echo site_url("main/find");?>/"+selected,{},function(a,b){
                var database = JSON.parse(a);
                database = database[0];
                num_pin = database.pin;
                document.getElementById('add-name').value = database.name;
                document.getElementById('add-owner').value = database.owner;
                document.getElementById('add-coordinate-x').value = database.y;
                document.getElementById('add-coordinate-y').value = database.x;
                document.getElementById('add-upload-image').setAttribute('src',database.imgpath);
                toMap();

            });

            $.post("<?php echo site_url("main/address");?>/"+selected,{},function(a,b){
                var database2 = JSON.parse(a);
                database2 = database2[0];
                document.getElementById("address-houseno").value = database2.bldg_no;
                document.getElementById("address-buildingname").value = database2.building_name;
                document.getElementById("address-unitno").value = database2.unit_no;
                document.getElementById("address-street").value = database2.street;
                document.getElementById("address-brgy").value = database2.barangay;
                document.getElementById("address-subdivision").value = database2.subdivision;
                document.getElementById("address-city").value = database2.city;
                document.getElementById("address-province").value = database2.province;
                document.getElementById("address-telno").value = database2.tel_no;
                document.getElementById("address-email").value = database2.email_address;

            });

            setTimeout(() => {
                document.getElementById('pid').value = num_pin;
            }, 100);
        }else{
            editting = false;
            document.getElementById('modal-add').style.display = 'block';

            document.getElementById('pid').value = "";
            document.getElementById('add-name').value = "";
            document.getElementById('add-owner').value = "";
            document.getElementById('add-coordinate-x').value = "";
            document.getElementById('add-coordinate-y').value = "";
            document.getElementById('add-upload-image').setAttribute('src',"");

            document.getElementById("address-houseno").value = "";
            document.getElementById("address-buildingname").value = "";
            document.getElementById("address-unitno").value = "";
            document.getElementById("address-street").value = "";
            document.getElementById("address-brgy").value = "";
            document.getElementById("address-subdivision").value = "";
            document.getElementById("address-city").value ="Bayombong";
            document.getElementById("address-province").value = "Nueva Vizcaya";
            document.getElementById("address-telno").value = "";
            document.getElementById("address-email").value = "";

        }
    }

    function g_search(){
        var usearch = document.getElementById("search").value;
        window.location.href = '<?php echo site_url("main/properties")?>/?search='+usearch;
    }

    function reset_search(){
        window.location.href = '<?php echo site_url("main/properties")?>';
    }
    
    function close_modal(){
        document.getElementById("modal-wrapper").style.display = 'none';
    }
    window.onclick = function(event) {
        if (event.target == document.getElementById("modal-wrapper")) {
            close_modal();
        }
    }

    function pin_search(){
        $.post();
    }

    document.getElementById("close-modal").addEventListener('click',close_modal);
</script>

<script>
    var add_map = new custom_map('add-map',false,true,false,[121.15166,16.48262],17,lets);

    function lets(coordinate){
        document.getElementById("add-coordinate-x").value = coordinate[1];
        document.getElementById("add-coordinate-y").value = coordinate[0];
    }

    function toMap(){
        var x = document.getElementById("add-coordinate-x").value;
        var y = document.getElementById("add-coordinate-y").value;
        if(x && y){
            add_map.pick_point([y,x]);
        }
    }


    $(document).ready(function(){
        $("#add-image").change(function(e){
            if (e.target.files[0]) {
                document.getElementById("add-upload-image").style.visibility = 'visible';

                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("add-image").files[0]);

                oFReader.onload = function (event) {
                    document.getElementById("add-upload-image").src = event.target.result;
                };
            }
        });
    });

    var refresher = document.getElementById('refresh');
    refresher.setAttribute('src','<?php echo base_url()?>/Icon/loading_arrow.png');
    refresher.addEventListener('click',function(){
        document.getElementById("add-coordinate-x").value = '';
        document.getElementById("add-coordinate-y").value = '';
        add_map.pick_point([121.15166,16.48262],true);
    });

    function open_data(e){
        window.location.href = "<?php echo site_url('main/look')?>/"+e;
    }
</script>