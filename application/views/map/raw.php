
<script>
    var is_open = true;

    var cpoint = <?php
        if(isset($look)){
            echo $look;
        }else{
            echo -1;
        } 
    ?>;
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
            if(businesses[y]['building_id'] == locations[x]['pin']){
                locations[x]["business"].push(businesses[y]);
            }
        }
    }
</script>
<div class='l-side-control'>
    <a type='button' href='<?php echo site_url("region")?>' class='btn btn-primary'>Region</a>
    <br><br>
    <a type='button' href='<?php echo site_url("main/view")?>' class='btn btn-primary'>View All</a>
    <a type='button' href='<?php echo site_url("main/add")?>' class='btn btn-primary'>Add New</a>
</div>
<div class='b-side-control'>
    <div class='d-flex flex-row-reverse mx-2'>
        <a type='button' href='' class='btn btn-primary'>Log in</a>
    </div>
</div>
<div class='t-side-control'>
    <button class='btn' onclick='open_search()' style='width:50px;height:50px;'><img style='width:100%' src ='<?php echo base_url()?>/Icon/magnifier.png'></button>
    <div id="all_side_search" style="margin-top:-55px;margin-bottom:5px; ">
        <div style="margin-left:55px;" class="d-flex justify-content-center">
            <input type="text" class="form-control" id="search_category" name='search_category' placeholder="Search">
            <input type="button" class="btn btn-primary" onclick='search_filter()' value="Go">
        </div>
    </div>
    <button class='btn btn-primary'  onclick='check_all()'>Show All</button>
</div>

<div class='r-side-control'>
    <table class="table all-table">
        <thead>
            <tr>
                <th scope="col"><input type='checkbox' onchange='check_filter_status(this)' checked id='status_open' style='width:20px;height:20px;'></th>
                <th scope="col">@</th>
                <th scope="col">Type</th>
                <th scope="col">Count</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
                foreach($status as $row){
                    echo 
                    "
                        <tr>
                            <td><input type='checkbox' onchange='set_filter()' checked class='all_type' id='".$row->status."' style='width:20px;height:20px;'></td>
                            <td><div class='all_color' id='".$row->status."' style='width:20px;height:20px;'></div></td>
                            <td>".$row->status."</td>
                            <td>".$row->count."</td>
                        </tr>
                    ";
                }
            ?>
        </tbody>
    </table>

    <table class="table all-table">
        <thead>
            <tr>
                <th scope="col"><input type='checkbox' checked onchange='check_filter_category(this)' id='category_open' style='width:20px;height:20px;'></th>
                <th scope="col">@</th>
                <th scope="col">Category</th>
                <th scope="col">Count</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
                foreach($category as $row){
                    echo 
                    "
                        <tr>
                            <td><input type='checkbox' onchange='set_filter()' class='all_check' checked id='".$row->category."' style='width:20px;height:20px;'></td>
                            <td><img class='all_type_color' id='".$row->category."' src='".base_url()."/Icon/".str_replace(" ","_",$row->category)."' style='filter: invert(100%);width:20px;height:20px;'></img></td>
                            <td>".$row->category."</td>
                            <td>".$row->count."</td>
                        </tr>
                    ";
                }
                
            ?>
        </tbody>
    </table>
</div>

<div>
<div id='map-tooltip'></div>
<div id='map-holder' style="width:100%;height:100%;"></div>
</div>
<script>
    
    var ccontrol = document.getElementsByClassName("all_check");
    var scontrol = document.getElementsByClassName("all_type");
    var cdisplay = document.getElementsByClassName("all_type_color");
    var sdisplay = document.getElementsByClassName("all_color");
    
    for(var i = 0; i < sdisplay.length; i++){
        sdisplay[i].style.backgroundColor = color_scheme[sdisplay[i].id];
    }

    function check_filter_category(e){
        for(var i = 0; i < ccontrol.length; i++){
            ccontrol[i].checked = e.checked;
        }
        set_filter();
    }
    
    function check_filter_status(e){
        for(var i = 0; i < scontrol.length; i++){
            scontrol[i].checked = e.checked;
        }
        set_filter();
    }

    function check_all(){
        main_map.show_all();
        for(var i = 0; i < ccontrol.length; i++){
            ccontrol[i].checked = true;
        }
        for(var i = 0; i < scontrol.length; i++){
            scontrol[i].checked = true;
        }
        document.getElementById("category_open").checked = true;
        document.getElementById("status_open").checked = true;
    }
</script>
<script>
    var main_map;
    var map_filter = {};
    set_map();
    //set_filter();
    
    function set_map(){
        
        var center_point = [121.15166,16.48262];
        for(var i =0; i < db_id.length; i++){
            if(cpoint == db_id[i]){
                center_point = [db_location[i][1],db_location[i][0]];
                break;
            };
        }
        main_map = new custom_map('map-holder',true,false,true,center_point,17,open_location);
        //main_map.set_scheme(c_scheme);
        //main_map.set_images(i_scheme);
        main_map.add_layer("Batch 1",db_location,locations,locations);
        //main_map.add_region("Salvacion",Salvacion);
    }

    function open_location(e){
        window.location.href = "<?php echo site_url("main/business")?>/"+e.individual['pin'];
    }
    /*
    function check_filter_category(e){
        for(var x = 0; x < ccontrol.length; x++){
            ccontrol[x].checked = e.checked;
        }
        set_filter();
    }

    function check_filter_type(e){
        for(var x = 0; x < tcontrol.length; x++){
            tcontrol[x].checked = e.checked;
        }
        set_filter();
    }
*/
    function search_filter(){
        set_filter();
    }
    
    function set_filter(){
        var category_filter = [];
        for(var i = 0; i < ccontrol.length;i++){
            if(ccontrol[i].checked){
                category_filter.push(ccontrol[i].id);
            };
        }

        var type_filter = [];
        for(var i = 0; i < scontrol.length;i++){
            if(scontrol[i].checked){
                type_filter.push(scontrol[i].id);
            };
        }

        map_filter['category'] = category_filter;
        map_filter['status'] = type_filter;

        var val = document.getElementById("search_category").value;
        map_filter['name'] = val;

        main_map.check_filter(map_filter);
    }
    
</script>
<script>
    function open_search(){
        var search_bar = document.getElementById("all_side_search");
        if(is_open){
            is_open = false;
            search_bar.style.width = "100%";
            search_bar.style.visibility = "visible";
        }else{
            is_open = true;
            search_bar.style.width = "0%";
            search_bar.style.visibility = "hidden";
        }
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