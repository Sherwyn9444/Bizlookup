<script>
    document.getElementById("side-user").style.backgroundColor = getComputedStyle(document.documentElement).getPropertyValue('--cfirst');
</script>
<div class='modal' id='modal-wrapper'>
    <div class='modal-control'>
        <span id='close-modal' class="close">&times;</span>
        <div class='d-flex justify-content-center'>
            <div id='modal-add' class='modal-content'>
                <div class="d-flex justify-content-center mt-4">
                    <h1 class='h1'>Add Account<h1>
                </div>
                <div class="d-flex justify-content-center">
                    <div id='add-form'>
                        <div class='p-5'>
                            <label for="username">Username</label>
                            <input required type="text" class="form-control" id="add-username" name='username' aria-describedby="nameHelp" placeholder="Enter Username">
                            <label for="password">Password</label>
                            <input required type="password" class="form-control" id="add-password" name='password' placeholder="Enter Password">
                        </div>
                    </div> 
                </div>
                <br><br><br>
                <div class="d-flex justify-content-end">
                    <button onclick="close_modal()" class="btn btn-primary px-5 py-3 mx-2">Cancel</button>
                    <button onclick="new_account()" class="btn btn-primary px-5 py-3 mx-2">Add</button>
                </div>
            </div>
        </div>

        <div class='d-flex justify-content-center'>
            <div id='modal-edit' class='modal-content'>
                <div class="d-flex justify-content-center mt-4">
                    <h1 class='h1'>Edit Account<h1>
                </div>
                <div class="d-flex justify-content-center">
                    <div id='add-form'>
                        <div class='p-5'>
                            <label for="username">Username</label>
                            <input required type="text" class="form-control" id="edit-username" name='username' aria-describedby="nameHelp">
                            
                            <label for="password">Password</label>
                            <input required type="password" class="form-control" id="edit-password" name='password'>
                        </div>
                    </div> 
                </div>
                <br><br><br>
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
            <div class='w-100'></div>
        </div>
        <div class='view-main' style='overflow:auto;'>
            <table class='table view-table'>
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Username</td>
                        <td>Type</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($accounts as $row){
                            echo 
                            "
                            <tr>
                                <td>".$row->id."</td>
                                <td>".$row->username."</td>
                                <td>".$row->type."</td>
                                <td class='w-25'>
                                    <button onclick='open_modal(true,".$row->id.",\"".$row->username."\",\"".$row->password."\")' class='btn btn-primary'>Edit</button>
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
        if(confirm("Do you wish to delete this account?")){
            window.location.href = "<?php echo site_url("account/remove")."/";?>" + id;
        }
    }

    function open_modal(isEdit = false,num = -1,name="",password=""){
        selected = num;
        console.log(name,password);
        document.getElementById("modal-wrapper").style.display = 'block';
        if(isEdit){
            document.getElementById('modal-add').style.display = 'none';
            document.getElementById('modal-edit').style.display = 'block';
            document.getElementById('edit-username').value = name;
            document.getElementById('edit-password').value = password;
        }else{
            document.getElementById('modal-add').style.display = 'block';
            document.getElementById('modal-edit').style.display = 'none';
        }
    }

    function search(){
        var usearch = document.getElementById("search").value;
        window.location.href = '<?php echo site_url("account/view")?>/?search='+usearch;
    }

    function new_account(){
        var uname = document.getElementById('add-username').value;
        var pass = document.getElementById('add-password').value;
        $.post('<?php echo site_url('account/insert');?>',{
            username:uname,
            password:pass
        },function(){

        });
        alert("Account Successfully added");
        location.reload();
    }

    function reset_search(){
        window.location.href = '<?php echo site_url("account/view")?>';
    }
    
    function edit_account(){
        var uname = document.getElementById('edit-username').value;
        var pass = document.getElementById('edit-password').value;
        if(selected != -1){
            $.post('<?php echo site_url('account/change');?>'+'/'+selected,{
                username:uname,
                password:pass
            },function(){
                
            });

            alert("Account Successfully editted");
            location.reload();   
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