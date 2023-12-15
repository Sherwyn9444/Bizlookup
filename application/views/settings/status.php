<div class='modal' id='modal-wrapper'>
    <div class='modal-control'>
        <span id='close-modal' class="close">&times;</span>
        <div class='d-flex justify-content-center'>
            <div id='modal-add' class='modal-content'>
                <div class="d-flex justify-content-center mt-4">
                    <h1 class='h1'>Add Status<h1>
                </div>
                <div class="d-flex justify-content-center">
                    <div id='add-form'>
                        <div class='p-5'>
                            <label for="name">Name</label>
                            <input required type="text" class="form-control" id="add-name" name='name' aria-describedby="nameHelp" placeholder="Name">
                            
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="add-description" name='description' placeholder="Description">
                            
                            <label for="color">Color</label>
                            <div>
                            <input type="text" class="form-control" id="add-color" name='color' placeholder="Color">
                            <input type="color" onchange='color_change(false)' class='form-control' style='height:35px;' id="add-scolor" name='scolor'>    
                            </div>
                        </div>
                    </div> 
                </div>
                <br><br><br>
                <div class="d-flex justify-content-end">
                    <button onclick="close_modal()" class="btn btn-primary px-5 py-3 mx-2">Cancel</button>
                    <button onclick="new_type()" class="btn btn-primary px-5 py-3 mx-2">Add</button>
                </div>
            </div>
        </div>

        <div class='d-flex justify-content-center'>
            <div id='modal-edit' class='modal-content'>
                <div class="d-flex justify-content-center mt-4">
                    <h1 class='h1'>Edit Status<h1>
                </div>
                <div class="d-flex justify-content-center">
                    <div id='add-form'>
                        <div class='p-5'>
                            <label for="name">Name</label>
                            <input required type="text" class="form-control" id="edit-name" name='name' aria-describedby="nameHelp">
                            
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="edit-description" name='description'>

                            <label for="color">Color</label>
                            <div>
                            <input type="text" class="form-control" id="edit-color" name='color'>
                            <input type="color" onchange='color_change(true)' class='form-control' style='height:35px;' id="edit-scolor" name='scolor'>
                            </div>
                        
                        </div>
                    </div> 
                </div>
                <br><br><br>
                <div class="d-flex justify-content-end">
                    <button onclick="close_modal()" class="btn btn-primary px-5 py-3 mx-2">Cancel</button>
                    <button onclick="edit_type()" class="btn btn-primary px-5 py-3 mx-2">Edit</button>
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
            <button class='btn btn-primary'  onclick='reset_search()'><img src='<?php echo base_url();?>Icon/loading_arrow.png' style='width:25px;height25px;'></button>
            <div class='w-100'></div>
        </div>
        <div class='view-main' style='overflow:auto;'>
            <h1 class='h1'>Status</h1><br>
            <table class='table view-table'>
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Name</td>
                        <td>Description</td>
                        <td>Color</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($statuses as $row){
                            echo 
                            "
                            <tr>
                                <td>".$row->id."</td>
                                <td>".$row->name."</td>
                                <td>".$row->description."</td>
                                <td><div style='background-color:".$row->color.";width:50px;height:50px;'></div></td>
                                <td class='w-25'>
                                    <button onclick='open_modal(true,".$row->id.",\"".$row->name."\",\"".$row->description."\",\"".$row->color."\")' class='btn btn-primary'>Edit</button>
                                    <button onclick='confirm_remove(".$row->id.")' class='btn btn-primary'>Delete</button>
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
    function confirm_remove(id){
        if(confirm("Do you wish to delete this type?")){
            window.location.href = "<?php echo site_url("settings/remove_type")."/";?>" + id;
        }
    }

    function color_change(isEdit = false){
        if(isEdit){
            document.getElementById('edit-color').value = document.getElementById('edit-scolor').value;
        }else{
            document.getElementById('add-color').value = document.getElementById('add-scolor').value;
        }
    }
    function open_modal(isEdit = false,num = -1,name="",password="",color=""){
        selected = num;
        document.getElementById("modal-wrapper").style.display = 'block';
        if(isEdit){
            document.getElementById('modal-add').style.display = 'none';
            document.getElementById('modal-edit').style.display = 'block';
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-description').value = password;
            document.getElementById('edit-color').value = color;
            document.getElementById('edit-color').value = color;
            document.getElementById('edit-scolor').value = color;
        }else{
            document.getElementById('modal-add').style.display = 'block';
            document.getElementById('modal-edit').style.display = 'none';
        }
    }

    function search(){
        var usearch = document.getElementById("search").value;
        window.location.href = '<?php echo site_url("settings/status")?>/?search='+usearch;
    }

    function new_type(){
        $.post('<?php echo site_url('settings/add_status');?>',{
            name:document.getElementById('add-name').value,
            description:document.getElementById('add-description').value,
            color:document.getElementById('add-color').value
        },function(){
            location.reload();
        });
    }

    function reset_search(){
        window.location.href = '<?php echo site_url("settings/status")?>';
    }
    
    function edit_type(){
        if(selected != -1){
            $.post('<?php echo site_url('settings/edit_status');?>'+'/'+selected,{
                name:document.getElementById('edit-name').value,
                description:document.getElementById('edit-description').value,
                color:document.getElementById('edit-color').value
            },function(){
                location.reload();
            });    
        }
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
</script>