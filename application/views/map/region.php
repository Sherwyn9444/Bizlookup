<script>
    document.getElementById("side-regions").style.backgroundColor = getComputedStyle(document.documentElement).getPropertyValue('--cfirst');
</script>
<script>
    var editting = false;
    var r_num = -1;
    var locations = <?php
        echo json_encode($location);
    ?>;
    var businesses = <?php
        echo json_encode($business);
    ?>;
    
    var db_id = [];
    var db_name = [];
    var db_location = [];
    
    for(x in locations){
        locations[x]["business"] = [];
        db_id.push(locations[x].pin);
        db_name.push(locations[x].name);
        db_location.push([locations[x].y,locations[x].x]);
        for(y in businesses){
            if(businesses[y]['building_id'] == locations[x].pin){
                locations[x]["business"].push(businesses[y]);
            }
        }
    }
   
    var regions = <?php
        echo json_encode($region);
    ?>;

    for(x in regions){
        regions[x]['coordinate'] = JSON.parse(regions[x]['coordinate']);
    }
</script>
<div class='mb-2'>
    <button class='btn btn-primary me-2' onclick='view_region()'>View Regions</button>
    <button class='btn btn-primary me-2' onclick='open_create()'>Create Region</button>
</div>
<div>
<div id='map-tooltip'></div>
<div id='map-holder' style="width:99%;height:100%;"></div>
<div id='map-description' style='visibility:hidden;' class='b-side-control'>
    <div class='d-flex justify-content-center'>
        <h1 class='h1' id='region-title'>New Region</h1>
    </div>
    <div>
        <div class="form-group p-4 w-100">
            <div class='d-flex justify-content-between'>
                <div class='w-100'>
                    <label for="name">Name</label>
                    <input required type="text" class="form-control" id="region-name" name='name' aria-describedby="nameHelp" placeholder="Enter Name">
                </div>
                <div class='w-50 ms-1'>
                    <label for="type">Type</label>
                    <input required type="text" class="form-control" id="region-type" name='type' aria-describedby="nameHelp" placeholder="Enter Type">
                </div>
            </div>
            
            <div class="p-4" style='height:500px;overflow:auto;'>
                <div id='coordinate-holder' style='font-size:9px'>

                </div>
            </div>
            <div class="d-flex flex-row-reverse">
                <button id='region-save' type="submit" class="btn btn-primary px-3" onclick="save_function()">Save</button>
                <button type="button" class="btn btn-primary px-3 mx-2"  onclick='cancel_function()'>Cancel</button>
                <button type="button" class="btn btn-primary px-3" onclick='undo_function()'>Undo</button>
                <button type="button" class="btn btn-primary px-3 me-2" onclick='delete_function()'>Delete</button>
            
            </div>
        </div>
    </div>
</div>

<div id='map-seeker' style='visibility:hidden;' class='b-side-control'>
    <div class='d-flex justify-content-center'>
        <h1 class='h1'>Regions</h1>
    </div>
    <div>
        <div class="form-group p-4 w-100">
            <div style='height:500px;overflow:auto;'>
                <table class='table view-table w-100'>
                    <thead>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Business</th>
                    </thead>
                    <tbody id='region-holder'>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex flex-row-reverse">
                <button type="button" class="btn btn-primary px-3 mx-2"  onclick='highlight_close()'>Cancel</button>
            </div>
    </div>
</div>
</div>
<script>
    
  
</script>
<script>
    var description_object = document.getElementById("map-description");
    var locator_object = document.getElementById("map-seeker");
    var coordinate_object = document.getElementById("coordinate-holder");
    var region_object = document.getElementById("region-holder");
    var reg_map;
    var map_filter = {};
    set_map();
    //set_filter();
    
    function set_map(){
        
        var center_point = [121.15166,16.48262];
        reg_map = new region_map('map-holder',true,false,center_point,16,[],[]);
        //reg_map.set_scheme(c_scheme);
        //reg_map.set_images(i_scheme);

        for(x in regions){
            reg_map.add_region(regions[x],locations);
        }
        
        //reg_map.add_region("Salvacion",Salvacion);
    }

    function open_create(){
        reg_map.set_onclick(false);
        description_object.style.visibility = "visible";
        editting = false;
        document.getElementById('region-name').value = "";
        document.getElementById('region-type').value = "";
        init_description();
        highlight_close();
    }
   
    function init_description(){
        if(!editting){
            document.getElementById('region-save').innerHTML = "Save";
            document.getElementById('region-title').innerHTML = "New Region";
        }else{
            document.getElementById('region-save').innerHTML = "Edit";
            document.getElementById('region-title').innerHTML = "Edit Region";
        }
    }
    function set_description(coordinates){
        coordinate_object.innerHTML = "";
        for(x in coordinates){
            var temp = document.createElement("div");
            temp.setAttribute('class','region-coordinate');
            temp.setAttribute('id',x);
            temp.style.fontSize = "13px";
            temp.innerHTML = "> "+coordinates[x][0]+", "+coordinates[x][1];
            temp.addEventListener("mouseover",function(){
                view_point(this.id);
            });
            temp.addEventListener("mousedown",function(){
                prio_point(this.id);
            });
            coordinate_object.appendChild(temp);
        }
        
    }

    function edit_region(layer,coordinates){
        open_create(); 
        editting = true;
        init_description();
        r_num = layer.id;
        set_description(coordinates);
        document.getElementById('region-name').value = layer.name;
        document.getElementById('region-type').value = layer.type;
        reg_map.reset_region();
    }

    function close_create(){
        reg_map.set_onclick(function(){});
    }

    function view_point(number){
        reg_map.highlight_coordinate(number);
    }

    function prio_point(number){
        console.log(number);
        temp_region = reg_map.region_recount(number);
        reg_map.reset_region();
    }
    function view_region(){
        cancel_function();
        region_object.innerHTML = "";
        locator_object.style.visibility = "visible";
        reg_map.highlight_reset();
        var all_region = reg_map.get_all_region();
        for(x in all_region){
            var temp = document.createElement("tr");
            temp.setAttribute('class','location-name');
            temp.setAttribute('id',all_region[x].name);
            temp.innerHTML += "<td>"+all_region[x].name+"</td><td style='text-align:center'>"+all_region[x].population+"</td><td style='text-align:center'>"+all_region[x].count+"</td>";
            region_object.appendChild(temp);
        }
        highlight_region();
    }   

    check_inside();
    reg_map.analyze();
    
    function check_inside(){
        var all_regions = reg_map.get_all_region();
        for(x in all_regions){
            for(y in db_location){
                reg_map.is_inside(all_regions[x],locations[y],{});
            }
        }
    }

    function highlight_region(){
        var all_loc = document.getElementsByClassName('location-name');
        for(var x = 0; x < all_loc.length; x++){
            all_loc[x].addEventListener("click",function(){
                reg_map.highlight_choose(this.id);
            });
            all_loc[x].addEventListener('mouseover',function(){
                reg_map.highlight(this.id);
            });
        }
    }

    function highlight_close(){
        locator_object.style.visibility = "hidden";
        region_object.innerHTML = "";
        reg_map.analyze();
    }

    function save_function(){
        var str = JSON.stringify(temp_region);
        var name = document.getElementById("region-name").value;
        var type = document.getElementById("region-type").value;
        var land = "<?php echo site_url("region/add")?>";
        if(editting){
            land = "<?php echo site_url("region/edit")?>"+"/"+r_num;
        }
        $.post(land,{
            "name":name,
            "type":type,
            "coordinates":str
        },function(data,success){
            if(success){
                alert("Region Saved");
                location.reload();
            }
        });
        cancel_function();
    }

    function delete_function(){
        var name = document.getElementById("region-name").value;
        $.post("<?php echo site_url("region/delete")?>"+"/"+r_num,{
            
        },function(data,success){
            if(success){
                alert("Region Deleted");
                location.reload();
            }
        });
    }

    function undo_function(){
        temp_region.pop();
        reg_map.reset_region();
    }

    function cancel_function(){
        reg_map.set_onclick(true);
        reg_map.cancel_region();
        coordinate_object.innerHTML = "";
        description_object.style.visibility = "hidden";
    }
</script>
    
<!--
map-location
    -differed by color
    -try address
    -general
        -overlapping data
filter
    -by categories
    -search
selection
    -name
    -description
-->