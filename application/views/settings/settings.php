<script>
    document.getElementById("side-settings").style.backgroundColor = getComputedStyle(document.documentElement).getPropertyValue('--cfirst');
</script>
<div class='w-100 mt-1'>
    <div class='d-flex justify-content-between w-100'>
        <div class='w-100 me-3'>
            <h1 class='h1'>Content Settings</h1>
            <div class='disp-item mt-4'>
                <h2 class="h2">Theme</h2>
                <div class='d-flex'>
                    <div>Select Theme : </div>
                    <div>
                        <select class='form-select' onchange='change_theme(this.value)'>
                            <?php
                                foreach($themes as $th){
                                    if($th->isSelected == 1){
                                        echo " <option selected value='".$th->id."'>".$th->name."</option>";
                                    }else{
                                        echo " <option value='".$th->id."'>".$th->name."</option>";
                                    }
                                    
                                }
                            ?>
                           
                        </select>
                    </div>
                    <div>
                        <button  onclick="save_theme()" class='btn btn-primary px-4'>Save</button>
                    </div>
                    <div class='ms-5'>
                        
                        <button  onclick="configure_theme()" class='btn btn-primary'>Configure</button>
                    </div>
                </div>
            </div>
            <div class='my-5'></div>
            <h1 class='h1'>Data Settings</h1>
            <div class='d-flex justify-content-between mt-4'>
                <div class='disp-item w-100'>
                    <h3 class="h3">Business Category</h3>
                    <div class='d-flex'>
                        <div><button onclick="configure_categories()" class='btn btn-primary'>Configure</button></div>
                    </div>
                </div>
                <div class='disp-item w-100 mx-3'>
                    <h3 class="h3">Business Type</h3>
                    <div class='d-flex'>
                        <div><button  onclick="configure_types()" class='btn btn-primary'>Configure</button></div>
                    </div>
                </div>
                <div class='disp-item w-100 me-3'>
                    <h3 class="h3">Barangay</h3>
                    <div class='d-flex'>
                        <div><button  onclick="configure_barangay()" class='btn btn-primary'>Configure</button></div>
                    </div>
                </div>
                <div class='disp-item w-100 me-3'>
                    <h3 class="h3">Status</h3>
                    <div class='d-flex'>
                        <div><button  onclick="configure_status()" class='btn btn-primary'>Configure</button></div>
                    </div>
                </div>
                <div class='disp-item w-100'>
                    <h3 class="h3">Database</h3>
                    <div class='d-flex'>
                        <div><button  onclick="backup_db()" class='btn btn-primary'>Backup</button></div>
                        <div><button  onclick="backup_db()" class='btn btn-primary'>Recover</button></div>
                    
                    </div>
                </div>
            </div>
            <div class='disp-item w-100'>
                <h2 class="h2">Display (Print)</h2>
                <div class='d-flex justify-content-between'>
                    <div id='settings-allowed'>
                        
                    </div>
                    <div><button onclick="save_allow()" class='btn btn-primary'>Save</button></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var selected_theme = -1;
    var themes = <?php echo json_encode($themes)?>;
    
    var all_fields = ["name","owner","type","status","category","date","location_address","building_name","unit_no","street","barangay","subdivision","city","province","tel_no","email_address"];
    var disp_fields = ["Name","Owner","Type","Status","Category","Date","Full Address","Building Name","House No.","Street","Barangay","Subdivision","City","Province","Tel No.","Email Address"];
    var al = <?php echo json_encode($allow)?>;
    var all = JSON.parse(al.head);
    var allowed = all;
    var disp_allow = [];

    start_allow();
    function start_allow(){
        document.getElementById('settings-allowed').innerHTML = "";
        disp_allow = [];
        var str = "<div class='d-flex justify-content-start'>";
        var half = Math.floor(all_fields.length/2);
        for(var x = 0; x < half; x++){
            str += "<div class='d-flex'  style='width:150px;'>";
            if(allowed.includes(all_fields[x])){
                str += "<input type='checkbox' checked onclick='return false;' style='width:20px;'>";
                disp_allow.push(disp_fields[x]);
            }else{
                str += "<input type='checkbox' onclick='return false;' style='width:20px;'>";
            }
            str += "<div class='allow-pix px-1' id='"+all_fields[x]+"'><u>"+disp_fields[x]+"</u></div></div>";
            
        }
        str += "</div><div class='d-flex justify-content-start'>";
        for(var x = half; x < all_fields.length; x++){
            str += "<div class='d-flex' style='width:150px;'> ";
            if(allowed.includes(all_fields[x])){
                str += "<input type='checkbox' onclick='return false;' checked style='width:20px;'>";
                disp_allow.push(disp_fields[x]);
            }else{
                str += "<input type='checkbox' onclick='return false;' style='width:20px;'>";
            }
            str += "<div class='allow-pix px-1' id='"+all_fields[x]+"'><u>"+disp_fields[x]+"</u></div></div>";
            
        }
        str += "</div>";
        document.getElementById('settings-allowed').innerHTML = str;
        setup_allow();
    }
    
    function setup_allow(){
        var all_allow = document.getElementsByClassName("allow-pix");

        for(var x = 0; x < all_allow.length; x++){
            all_allow[x].addEventListener("click",function(){
                console.log(this.id);
                if(allowed.includes(this.id)){
                    var index = allowed.indexOf(this.id);
                    var y = allowed.splice(index, 1);
                }else{
                    allowed.push(this.id);
                }
                start_allow();
            })
        }
    }

    function save_allow(){
        $.post("<?php echo site_url("settings/edit_allow")?>/1",{
            allow:JSON.stringify(allowed),
            title:JSON.stringify(disp_allow)
        });

        alert("Save Successful");
    }

    function configure_categories(){
        window.location.href = "<?php echo site_url('settings/categories')?>";
    }

    function configure_types(){
        window.location.href = "<?php echo site_url('settings/types')?>";
    }

    function configure_barangay(){
        window.location.href = "<?php echo site_url('settings/barangay')?>";
    }

    function configure_status(){
        window.location.href = "<?php echo site_url('settings/status')?>";
    }

    function configure_theme(){
        window.location.href = "<?php echo site_url('settings/theme')?>";
    }

    function change_theme(val){
        var sel_theme;
        for(var i = 0; i < themes.length; i++){
            if(themes[i].id == val){
                sel_theme = themes[i];
            }
        }
        selected_theme = val;
        set_theme_all(sel_theme);
    }

    function set_theme_all(theme){
        var r = document.querySelector(':root');
        r.style.setProperty('--bgfirst', theme.bgfirst);
        r.style.setProperty('--bgsecond', theme.bgsecond);
        r.style.setProperty('--cfirst', theme.cfirst);
        r.style.setProperty('--csecond', theme.csecond);
        r.style.setProperty('--bfirst', theme.bfirst);
        r.style.setProperty('--beffect', theme.beffect);
    }

    function save_theme(){
        if(selected_theme != -1){
            window.location.href = "<?php echo site_url('settings/save_theme')?>/"+selected_theme;
        }
    }

    function backup_db(){
        window.location.href = "<?php echo site_url('settings/backup')?>";
    }
</script>