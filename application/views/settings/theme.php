<div class='modal' id='modal-wrapper'>
    <div class='modal-control'>
        <span id='close-modal' class="close">&times;</span>
        <div class='d-flex justify-content-center'>
            <div id='modal-add' class='modal-content'>
                <div class="d-flex justify-content-center mt-4">
                    <h1 class='h1'>Add Theme<h1>
                </div>
                <div class="d-flex justify-content-center">
                    <div id='add-form'>
                        <div class='p-5'>
                            <label for="name">Name</label>
                            <input required type="text" class="form-control" id="add-name" name='name' aria-describedby="nameHelp" placeholder="Name">
                            
                            <div class='d-flex mt-2'>
                                <label class='w-50' for="bgfirst">Background Primary</label>
                                <input type="color" class='form-control' style='height:35px;' id="add-bgfirst" name='bgfirst'>
                            </div>

                            <div class='d-flex mt-2'>
                                <label class='w-50' for="bgsecond">Background Secondary</label>
                                <input type="color" class='form-control' style='height:35px;' id="add-bgsecond" name='bgsecond'>
                            </div>

                            <div class='d-flex mt-2'>
                                <label class='w-50' for="csecond">Font Primary</label>
                                <input type="color" class='form-control' style='height:35px;' id="add-csecond" name='csecond'>
                            </div>

                            <div class='d-flex mt-2'>
                                <label class='w-50' for="cfirst">Font Secondary</label>
                                <input type="color" class='form-control' style='height:35px;' id="add-cfirst" name='cfirst'>
                            </div>

                            <div class='d-flex mt-2'>
                                <label class='w-50' for="bfirst">Border</label>
                                <input type="color" class='form-control' style='height:35px;' id="add-bfirst" name='bfirst'>
                            </div>

                            <div class='d-flex mt-2'>
                                <label class='w-50' for="beffect">Hover</label>
                                <input type="color" class='form-control' style='height:35px;' id="add-beffect" name='beffect'>
                            </div>

                        </div>
                    </div> 
                </div>
                <br><br><br>
                <div class="d-flex justify-content-end">
                    <button onclick="close_modal()" class="btn btn-primary px-5 py-3 mx-2">Cancel</button>
                    <button onclick="new_theme()" class="btn btn-primary px-5 py-3 mx-2">Add</button>
                </div>
            </div>
        </div>

        <div class='d-flex justify-content-center'>
            <div id='modal-edit' class='modal-content'>
                <div class="d-flex justify-content-center mt-4">
                    <h1 class='h1'>Edit Theme<h1>
                </div>
                <div class="d-flex justify-content-center">
                    <div id='add-form'>
                        <div class='p-5'>
                            <label for="name">Name</label>
                            <input required type="text" class="form-control" id="edit-name" name='name' aria-describedby="nameHelp" placeholder="Name">
                            
                            <div class='d-flex mt-2'>
                                <label class='w-50' for="bgfirst">Background Primary</label>
                                <input type="color" class='form-control' style='height:35px;' id="edit-bgfirst" name='bgfirst'>
                            </div>

                            <div class='d-flex mt-2'>
                                <label class='w-50' for="bgsecond">Background Secondary</label>
                                <input type="color" class='form-control' style='height:35px;' id="edit-bgsecond" name='bgsecond'>
                            </div>

                            <div class='d-flex mt-2'>
                                <label class='w-50' for="csecond">Font Primary</label>
                                <input type="color" class='form-control' style='height:35px;' id="edit-csecond" name='csecond'>
                            </div>

                            <div class='d-flex mt-2'>
                                <label class='w-50' for="cfirst">Font Secondary</label>
                                <input type="color" class='form-control' style='height:35px;' id="edit-cfirst" name='cfirst'>
                            </div>

                            <div class='d-flex mt-2'>
                                <label class='w-50' for="bfirst">Border</label>
                                <input type="color" class='form-control' style='height:35px;' id="edit-bfirst" name='bfirst'>
                            </div>

                            <div class='d-flex mt-2'>
                                <label class='w-50' for="beffect">Hover</label>
                                <input type="color" class='form-control' style='height:35px;' id="edit-beffect" name='beffect'>
                            </div>
                        </div>
                    </div> 
                </div>
                <br><br><br>
                <div class="d-flex justify-content-end">
                    <button onclick="close_modal()" class="btn btn-primary px-5 py-3 mx-2">Cancel</button>
                    <button onclick="edit_theme()" class="btn btn-primary px-5 py-3 mx-2">Edit</button>
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
            <h1 class='h1'>Theme</h1><br>
            <table class='table view-table'>
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Name</td>
                        <td>BG Primary</td>
                        <td>BG Secondary</td>
                        <td>Font Primary</td>
                        <td>Font Secondary</td>
                        <td>Border</td>
                        <td>Hover</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($themes as $row){
                            echo 
                            "
                            <tr>
                                <td><div>".$row->id."</div></td>
                                <td><div>".$row->name."</div></td>
                                <td><div class='pix-color' style='background-color: ".$row->bgfirst.";'></div></td>
                                <td><div class='pix-color' style='background-color: ".$row->bgsecond.";'></div></td>
                                <td><div class='pix-color' style='background-color: ".$row->csecond.";'></div></td>
                                <td><div class='pix-color' style='background-color: ".$row->cfirst.";'></div></td>
                                <td><div class='pix-color' style='background-color: ".$row->bfirst.";'></div></td>
                                <td><div class='pix-color' style='background-color: ".$row->beffect.";'></div></td>
                                <td class='w-25'>
                                    <button onclick='open_modal(true,".$row->id.")' class='btn btn-primary'>Edit</button>
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
    var all_theme = <?php echo json_encode($themes)?>;
    var selected = -1;
    function confirm_remove(id){
        if(confirm("Do you wish to delete this category?")){
            window.location.href = "<?php echo site_url("settings/remove_theme")."/";?>" + id;
        }
    }

    function get_theme(id){
        var sel_theme;
        for(var i = 0; i < all_theme.length; i++){
            if(all_theme[i].id == id){
                return all_theme[i];
            }
        }
    }
    function open_modal(isEdit = false,num = -1){
        selected = num;
        var select_theme = get_theme(num);
        console.log(select_theme);
        document.getElementById("modal-wrapper").style.display = 'block';
        if(isEdit){
            document.getElementById('modal-add').style.display = 'none';
            document.getElementById('modal-edit').style.display = 'block';
            document.getElementById('edit-name').value = select_theme.name;
            document.getElementById('edit-bgfirst').value = select_theme.bgfirst;
            document.getElementById('edit-bgsecond').value = select_theme.bgsecond;
            document.getElementById('edit-cfirst').value = select_theme.cfirst;
            document.getElementById('edit-csecond').value = select_theme.csecond;
            document.getElementById('edit-bfirst').value = select_theme.bfirst;
            document.getElementById('edit-beffect').value = select_theme.beffect;
        }else{
            document.getElementById('modal-add').style.display = 'block';
            document.getElementById('modal-edit').style.display = 'none';
        }
    }

    function search(){
        var usearch = document.getElementById("search").value;
        window.location.href = '<?php echo site_url("settings/theme")?>/?search='+usearch;
    }

    function new_theme(){

        $.post('<?php echo site_url('settings/add_theme');?>',{
            name:document.getElementById('add-name').value,
            bgfirst:document.getElementById('add-bgfirst').value,
            bgsecond:document.getElementById('add-bgsecond').value,
            cfirst:document.getElementById('add-cfirst').value,
            csecond:document.getElementById('add-csecond').value,
            bfirst:document.getElementById('add-bfirst').value,
            beffect:document.getElementById('add-beffect').value
        },function(){
            location.reload();
        });
    }

    function reset_search(){
        window.location.href = '<?php echo site_url("settings/theme")?>';
    }
    
    function edit_theme(){
        
        if(selected != -1){
            $.post('<?php echo site_url('settings/edit_theme');?>'+'/'+selected,{
                name:document.getElementById('edit-name').value,
                bgfirst:document.getElementById('edit-bgfirst').value,
                bgsecond:document.getElementById('edit-bgsecond').value,
                cfirst:document.getElementById('edit-cfirst').value,
                csecond:document.getElementById('edit-csecond').value,
                bfirst:document.getElementById('edit-bfirst').value,
                beffect:document.getElementById('edit-beffect').value
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