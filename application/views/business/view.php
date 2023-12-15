
<div class="d-flex justify-content-between">
    <div class="d-flex justify-content-center w-100 px-5">
        <div class="form-group p-4 w-100">
            <div class="d-flex justify-content-center">
                <h1 class="h1"><?php echo $location->name;?></h1>
            </div>    
            <label for="owner">Owner</label>
            <input required type="text" readonly class="form-control" id="owner" name='owner' value=<?php echo $location->owner;?>>
            <div class="form-group pt-4 px-4 pb-2 w-100">
                <div id='view-map' style='width:100%;height:475px;'></div>
            </div>
            <div class="d-flex flex-row-reverse mx-3">
                <input type="button" class="btn btn-primary mx-1" onclick="edit_location(<?php echo $location->pin?>)" id="add-business" name="add_business" value="Edit">
                <input type="button" class="btn btn-primary mx-1" onclick="view_location(<?php echo $location->pin?>)" id="add-business" name="add_business" value="View">
            </div>   
        </div>
    </div>
    <div class="w-100">
        <div class="d-flex justify-content-center w-75 m-3">
            <input required type="text" class="form-control mx-3" id="search" onchange='search(this.value)' name='search' aria-describedby="nameHelp" placeholder="Search">
            
            <input type="button" onclick='add_new()' class="btn btn-primary mx-3" id="add-business" name='add_business' value="Add New">
        </div>
        <div style="overflow:auto; height:650px;">
        <?php
            foreach($building as $row){
                echo '
                    <div class="b-holder" id="b-'.$row->number.'">
                    <div class="d-flex justify-content-center mb-4">
                        <h2 class="h2">'.$row->name.' [ '.$row->number.' ]</h2>
                    </div>
                    <div class="d-flex justify-content-between">
                        <img class="w-25 me-5" style="filter:invert(100%);" src='.base_url().'/Icon/'.str_replace(" ","_",$row->category).'>
                            
                        <div class="w-75">
                            <h5 class="h5">Owner: '.$row->owner.'</h5>
                            <div>
                                <div class="w-100">
                                    <div>Status : '.$row->status.'</div>
                                </div>
                                <div  class="w-100">
                                    <div>Category : '.$row->category.'</div>
                                </div>
                                <div  class="w-100">
                                    <div>Date : '.$row->date.'</div>
                                </div>
                            </div>
                            <div>
                                Clearances : 
                                <div class="">';
                echo "<div class='d-flex'>";
                    if($row->barangay_clearance){
                        echo "<div style='color:green;' class='ps-3 w-50'>Barangay Clearance</div>";
                    }else{
                        echo "<div style='color:red;' class='ps-3 w-50'>Barangay Clearance</div>";
                    }
                    
                    if($row->sanitary_clearance){
                        echo "<div style='color:green;' class='ps-3 w-50'>Sanitary Clearance</div>";
                    }else{
                        echo "<div style='color:red;' class='ps-3 w-50'>Sanitary Clearance</div>";
                    }
                echo "</div>";
                echo "<div class='d-flex'>";
                    if($row->tax_clearance){
                        echo "<div style='color:green;' class='ps-3 w-50'>Tax (BIR) Clearance</div>";
                    }else{
                        echo "<div style='color:red;' class='ps-3 w-50'>Tax (BIR) Clearance</div>";
                    }
                    if($row->fire_clearance){
                        echo "<div style='color:green;' class='ps-3 w-50'>Fire Clearance</div>";
                    }else{
                        echo "<div style='color:red;' class='ps-3 w-50'>Fire Clearance</div>";
                    }
                echo "</div>";
                echo "<div class='d-flex'>";
                    if($row->building_permit){
                        echo "<div style='color:green;' class='ps-3 w-50'>Building Permit</div>";
                    }else{
                        echo "<div style='color:red;' class='ps-3 w-50'>Building Permit</div>";
                    }
                echo "</div>";
                echo '
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row-reverse mx-5">
                        <input type="button" class="btn btn-primary mx-1" onclick="delete_new('.$row->number.')" id="add-business" name="add_business" value="Remove">
                        <input type="button" class="btn btn-primary mx-1" onclick="edit_new('.$row->number.')" id="add-business" name="add_business" value="Edit">
                    </div>
                    <hr>
                    </div>
                ';
            }
        ?></div>
    </div>
</div>

<div class='l-side-control'>
    <a href='<?php echo base_url()?>' type="button" id='add-form-submit' class="btn btn-primary">Home</a>
</div>


<script>
    var coordinate = [<?php echo $location->x;?>,<?php echo $location->y;?>];
    var view_map = new custom_map('view-map',false,false,false,coordinate,17,lets,true);
    var layer = new ol.layer.Vector({
        source: new ol.source.Vector({
            features: [
                new ol.Feature(new ol.geom.Point(ol.proj.fromLonLat(coordinate)))
            ],
        }),
        style: new ol.style.Style({
            image: new ol.style.Circle({
                fill: new ol.style.Fill({
                    color: 'rgba(255,0,0,1)',
                }),
                crossOrigin: 'anonymous',
                radius: 7
            }),
        })
    });

    view_map.map.addLayer(layer);
    
    function lets(coordinate){
        
    }
</script>
<script>
    search();
    function add_new(){
        window.location.href = "<?php echo site_url("business/add") . "/" . $location->pin;?>";
    }
    function edit_new(id){
        window.location.href = "<?php echo site_url("business/edit");?>"+"/"+id;
    }
    function delete_new(id){
        if(confirm("Are you sure to delete?")){
            window.location.href = "<?php echo site_url("business/delete_business");?>"+"/"+id;
        }
    }
    function edit_location(id){
        window.location.href = "<?php echo site_url("main/edit");?>"+"/"+id;
    }
    function view_location(id){
        window.location.href = "<?php echo site_url("main/look");?>"+"/"+id;
    }
    function search(val){
        var url = "<?php echo site_url("business/search"). "/" . $location->pin?>";
        //console.log(val);
        $.post(url,{
            search:val
        },function(data){
            var all = document.getElementsByClassName('b-holder');
            var list = JSON.parse(data);
            for(var x = 0; x < all.length; x++){                
                all[x].style.display = 'none';
                for(y in list){
                    if(all[x].id != "b-"+list[y]){
                        all[x].style.display = 'none';
                    }else{
                        all[x].style.display = 'block';
                        break;
                    }
                }
            }
        });
        /*
        var all = document.getElementsByClassName('b-holder');
        for(x in all){
            console.log(all[x].id);
        }*/

    }
</script>
