<script>
    document.getElementById("side-map").style.backgroundColor = getComputedStyle(document.documentElement).getPropertyValue('--cfirst');
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

    var points = <?php
        echo json_encode($points);
    ?>;

    var businesses = <?php
        echo json_encode($business);
    ?>;

    
    var db_id = [];
    var db_name = [];
    var db_location = [];
    var db_empty_sum = 0;
    var db_not_empty_sum = 0;
    
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

    for(y in points){
        
        if(points[y]['business'] == null){
            db_empty_sum++;
        }else{
            db_not_empty_sum++;
        }
    }

</script>
<div class='d-flex justify-content-between w-100 mb-2'>
    <div class='me-2 w-100'><input type='text' class='form-control' onchange="set_search_filter()" id="map-search" placeholder="Search"></div>
    <?php
    
        foreach($status as $stats){
            echo "<div class='px-5 map-legend' id='".$stats->status."' style='background-color:".$stats->color.";font-weight:bold;'>".$stats->status."</div>";
        }
    ?>
    <div class='px-5 map-legend' id="empty" style='background-color:#000000;font-weight:bold; color:white;'>None</div>
    <div class='px-5 map-legend' id="all" style='background-color:#FFFFFF;font-weight:bold; color:black;'>All</div>
    
    <div class='w-100 px-1'>
        <select id='map-brgy' class='form-select' onchange="set_barangay_filter(this.value)">
            <option value = "0">All</option>
            <?php
                foreach($barangay as $bd){
                    echo "<option value=".$bd->id.">".$bd->name."</option>";
                };
            ?>
        </select>
    </div>
    <div class='w-100 pe-1'>
        <select id='map-brgy' class='form-select' onchange="set_category_filter(this.value)">
            <option value = "0">All</option>
            <?php
                foreach($category as $cat){
                    echo "<option value=".$cat->id.">".$cat->name."</option>";
                };
            ?>
        </select>
    </div>
</div>
<div class='d-flex justify-content-start w-100 h-100'>
    <div id='map-tooltip'></div>
    <div class='d-flex justify-content-between w-100'>
        <div id='map-holder' style="width:99%;height:100%;"></div>
        <div class='w-25 mx-3 p-3 map-definer'>
            <div class='map-location p-2'>
                <img id ='hover-img' class='map-img'>
                <div id='hover-pin'>PIN:</div>
                <div id='hover-name'>Property Name:</div>
                <div id='hover-owner'>Property Owner:</div>
                <div id='hover-date'>Date:</div>
                <div id='hover-location'>
                    Location
                    <div id='hover-location-x' class='ps-2'>Latitude:</div>
                    <div id='hover-location-y' class='ps-2'>Longitude:</div>
                </div>
            </div>
            <hr>
            <div id='hover-business'>Businesses
                
            </div>
        </div>
    </div>
    
</div>
<script>
    
    var ccontrol = document.getElementsByClassName("all_check");
    var scontrol = document.getElementsByClassName("all_type");

    var cdisplay = document.getElementsByClassName("all_type_color");
    var sdisplay = document.getElementsByClassName("all_color");

    var ydisplay = document.getElementsByClassName("all_year");
    var cldisplay = document.getElementsByClassName("all_clear");
    var bdisplay = document.getElementsByClassName("all_brgy");
    
    for(var i = 0; i < sdisplay.length; i++){
        sdisplay[i].style.backgroundColor = color_scheme[sdisplay[i].id];
    }

    function check_filter(e,name){
        var tempcontrol = document.getElementsByClassName(name);
        for(var i = 0; i < tempcontrol.length; i++){
            tempcontrol[i].checked = e.checked;
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
        for(var i = 0; i < ydisplay.length; i++){
            ydisplay[i].checked = true;
        }
        for(var i = 0; i < cldisplay.length; i++){
            cldisplay[i].checked = false;
        }
        for(var i = 0; i < bdisplay.length; i++){
            bdisplay[i].checked = true;
        }
        document.getElementById("category_open").checked = true;
        document.getElementById("status_open").checked = true;
        document.getElementById("year_open").checked = true;
        document.getElementById("clear_open").checked = false;
        document.getElementById("brgy_open").checked = true;
    }
</script>
<script>
    var barangay = <?php echo json_encode($barangay)?>;
    var category = <?php echo json_encode($category)?>;
    var show_map;
    var map_filter = {};
    var map_open = [];
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
        
        show_map = new main_map('map-holder',center_point,17,open_location,show_location);
        show_map.set_status_style(status_template);
        
        //main_map.set_scheme(c_scheme);
        //main_map.set_images(i_scheme);
        show_map.add_layer("Batch 1",db_location,locations,locations);
        
        //main_map.add_region("Salvacion",Salvacion);
    }

    function show_location(e){
        document.getElementsByClassName("map-location")[0].setAttribute("id",e.pin);
        document.getElementById("hover-img").setAttribute("src",e.imgpath);
        document.getElementById("hover-pin").innerHTML = "PIN: "+e.pin;
        document.getElementById("hover-name").innerHTML = "Name: "+e.name;
        document.getElementById("hover-owner").innerHTML = "Owner: "+e.owner;
        document.getElementById("hover-date").innerHTML = "Date: "+e.date;
        document.getElementById("hover-location-x").innerHTML = "Latitude: "+e.y;
        document.getElementById("hover-location-y").innerHTML = "Longitude: "+e.x;
    
        document.getElementById("hover-img").onerror = function(){
            document.getElementById("hover-img").setAttribute("src","<?php echo base_url()?>assets/__placeholder.png");
        }
        

        var str = "<b>Businesses:</b> ";
        for(i in e.business){
            str += create_def(e.business[i]);
        }
        document.getElementById("hover-business").innerHTML = str;
        open_setup();

        var id = document.getElementsByClassName("map-location")[0].id;
        document.getElementsByClassName("map-location")[0].addEventListener('click',function(){
            window.location.href = "<?php echo site_url('main/look')?>/"+id;
        });

        
    }

    function create_def(bus){
        var img_src = "<?php echo base_url();?>/Icon/"+bus.category.replace(" ","_");
        var color = "";

        for(var i = 0; i < status_template.length; i++){
            if(bus.status == status_template[i].status){
                color = status_template[i].color;
            }
        }
        
        var str = "\
        <div class='w-100 mb-3 py-1 px-2 map-business-display' id='"+bus.number+"'>\
            <div class='d-flex justify-content-between'>\
                <div>BIN: "+bus.bin+"</div>\
                <div style='margin-top:15px;width:10px;height:10px;border-radius:100%;background-color:"+color+";'></div>\
            </div>\
            <div class='d-flex justify-content-start'>\
                <img style='width:25px;height:25px;margin-right:5px;' src='"+img_src+"'> "+bus.name+"\
            </div>\
        </div>";

        return str;
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
    var legends = document.getElementsByClassName("map-legend");
    for(var i = 0; i < legends.length; i++){
        legends[i].addEventListener('click',function(){
           
            set_status_filter(this.id);
        });
    }

    map_filter['status'] = "all";
    map_filter['search'] = document.getElementById("map-search").value;

    function set_search_filter(){
        map_filter['search'] = document.getElementById("map-search").value;
        map_open = show_map.check_filter(map_filter);
    }
    function set_barangay_filter(id){
        var bname = "";
        if(id == 0){
            delete map_filter['barangay'];
        }else{
            for(var i = 0; i < barangay.length;i++){
                if(barangay[i].id == id){
                    bname = barangay[i].name;
                }
            }
            map_filter['barangay'] = bname;
        }
        map_filter['search'] = document.getElementById("map-search").value;
        map_open = show_map.check_filter(map_filter);
    }

    function set_category_filter(id){
        var cname = "";
        if(id == 0){
            delete map_filter['category'];
        }else{
            for(var i = 0; i < category.length;i++){
                if(category[i].id == id){
                    cname = category[i].name;
                }
            }
            map_filter['category'] = cname;
        }
        map_filter['search'] = document.getElementById("map-search").value;
        map_open = show_map.check_filter(map_filter);
    }

    function set_status_filter(id){
        map_filter['status'] = id;
        map_filter['search'] = document.getElementById("map-search").value;
        map_open = show_map.check_filter(map_filter);
    }
    
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

        var year_filter = [];
        for(var i = 0; i < ydisplay.length;i++){
            if(ydisplay[i].checked){
                year_filter.push(ydisplay[i].id);
            };
        }

        var clear_filter = [];
        for(var i = 0; i < cldisplay.length;i++){
            if(cldisplay[i].checked){
                clear_filter.push(cldisplay[i].id);
            };
        }
        
        var brgy_filter = [];
        for(var i = 0; i < bdisplay.length;i++){
            if(bdisplay[i].checked){
                brgy_filter.push(bdisplay[i].id);
            };
        }
        
        map_filter['category'] = category_filter;
        map_filter['status'] = type_filter;
        map_filter['year'] = year_filter;
        map_filter['clear'] = clear_filter;
        map_filter['brgy'] = brgy_filter;

        var val = document.getElementById("search_category").value;
        map_filter['name'] = val;
        show_map.check_filter(map_filter);

    }
    
    
</script>
<script>

    function open_setup(){
        var location_business = document.getElementsByClassName("map-business-display");
    
        for(var i = 0; i < location_business.length ; i++){
            location_business[i].addEventListener("click",function(){
                open_display(this.id)
            })
        }
    }
    
    function open_display(e){
        window.location.href = "<?php echo site_url('main/display')?>/"+e;
    }
    function open_search(){
        var search_bar = document.getElementById("all_side_search");
        var search_adv = document.getElementById("search-advance");
        if(is_open){
            is_open = false;
            search_bar.style.width = "300px";
            search_bar.style.visibility = "visible";
            search_adv.style.visibility = "visible";
            
        }else{
            is_open = true;
            search_bar.style.width = "0%";
            search_bar.style.visibility = "hidden";
            search_adv.style.visibility = "hidden";
        }
    }

    var acct_obj = document.getElementById("account-holder");
    var acct_open = false;
    function open_account(){
        if(acct_open){
            acct_open = false;
            acct_obj.style.display = "none";
        }else{
            acct_open = true;
            acct_obj.style.display = "block";
        }
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById("modal-wrapper")) {
            close_modal();
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