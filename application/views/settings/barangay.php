<div class='modal' id='modal-wrapper'>
    <div class='modal-control'>
        <span id='close-modal' class="close">&times;</span>
        <div class='d-flex justify-content-center'>
            <div id='modal-add' class='modal-content'>
                <div class="d-flex justify-content-center mt-4">
                    <h1 class='h1'>Add Barangay<h1>
                </div>
                <div class="d-flex justify-content-center">
                    <div id='add-form'>
                        <div class='p-5'>
                            <label for="name">Name</label>
                            <input required type="text" class="form-control" id="add-name" name='name' aria-describedby="nameHelp" placeholder="Name">
                            
                        </div>
                    </div> 
                </div>
                <br><br><br>
                <div class="d-flex justify-content-end">
                    <button onclick="close_modal()" class="btn btn-primary px-5 py-3 mx-2">Cancel</button>
                    <button onclick="new_barangay()" class="btn btn-primary px-5 py-3 mx-2">Add</button>
                </div>
            </div>
        </div>

        <div class='d-flex justify-content-center'>
            <div id='modal-edit' class='modal-content'>
                <div class="d-flex justify-content-center mt-4">
                    <h1 class='h1'>Edit Barangay<h1>
                </div>
                <div class="d-flex justify-content-center">
                    <div id='add-form'>
                        <div class='p-5'>
                            <label for="name">Name</label>
                            <input required type="text" class="form-control" id="edit-name" name='name' aria-describedby="nameHelp">
                            
                        </div>
                    </div> 
                </div>
                <br><br><br>
                <div class="d-flex justify-content-end">
                    <button onclick="close_modal()" class="btn btn-primary px-5 py-3 mx-2">Cancel</button>
                    <button onclick="edit_barangay()" class="btn btn-primary px-5 py-3 mx-2">Edit</button>
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
            <h1 class='h1'>Barangays</h1><br>
            <table class='table view-table'>
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Name</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($barangay as $row){
                            echo 
                            "
                            <tr>
                                <td>".$row->id."</td>
                                <td>".$row->name."</td>
                                <td class='w-25'>
                                    <button onclick='open_modal(true,".$row->id.",\"".$row->name."\")' class='btn btn-primary'>Edit</button>
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
        if(confirm("Do you wish to delete this barangay?")){
            window.location.href = "<?php echo site_url("settings/remove_barangay")."/";?>" + id;
        }
    }

    function open_modal(isEdit = false,num = -1,name="",password=""){
        selected = num;
        document.getElementById("modal-wrapper").style.display = 'block';
        if(isEdit){
            document.getElementById('modal-add').style.display = 'none';
            document.getElementById('modal-edit').style.display = 'block';
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-description').value = password;
        }else{
            document.getElementById('modal-add').style.display = 'block';
            document.getElementById('modal-edit').style.display = 'none';
        }
    }

    function search(){
        var usearch = document.getElementById("search").value;
        window.location.href = '<?php echo site_url("settings/barangay")?>/?search='+usearch;
    }

    function new_barangay(){
        $.post('<?php echo site_url('settings/add_barangay');?>',{
            name:document.getElementById('add-name').value
        },function(){
            location.reload();
        });
    }

    function reset_search(){
        window.location.href = '<?php echo site_url("settings/barangay")?>';
    }
    
    function edit_barangay(){
        if(selected != -1){
            $.post('<?php echo site_url('settings/edit_barangay');?>'+'/'+selected,{
                username:document.getElementById('edit-name').value
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