
<div class="d-flex justify-content-center">
<?= form_open_multipart('map/edit/'.$location->pin) ?>
    <div id='add-map-form'>
        <div class="d-flex justify-content-between">
            <div class="form-group p-4 w-50">
                <label for="name">Name</label>
                <input required type="text" class="form-control" id="name" name='name' aria-describedby="nameHelp" value='<?php echo $location->name;?>'>
                
                <label for="category">Owner</label>
                <input required type="text" class="form-control" id="owner" name='owner' value = '<?php echo $location->owner;?>'>
                <label for="x">Coordinates</label>
                <div class='d-flex justify-content-between'>
                    <input type='text' class="form-control" id="coordinate-y" onchange="toMap()" name='y' value = <?php echo $location->x;?>>
                    <input type='text' class="form-control" id="coordinate-x" onchange="toMap()" name='x' value = <?php echo $location->y;?>>
                    <img id='refresh' class='refresh-button ms-2'></img>
                </div>
                <div>
                    
                    <label for="image">Upload Image</label>
                    <input type="file" class="form-control" id="image" name='image'>
                </div>
                
                <div class="form-group p-4">
                    <img id='upload-image' alt="image" style='width:365px;height:365px;object-fit:contain;' src='<?php echo $location->imgpath;?>'>
                    
                </div>
            </div>
            <div class="form-group p-4 w-100">
                <div id='add-map' style='width:100%;height:575px;'></div>
            </div>
            <div class='r-side-control'>
                <button type="submit" id='add-form-submit' class="btn btn-primary">Save</button>
            </div>
        </div>
    </div> 
</div>
<div class='l-side-control'>
    <a href='<?php echo base_url()?>' type="button" class="btn btn-primary">Back</a>
</div>



<script>
    var coordinate = [<?php echo $location->x;?>,<?php echo $location->y;?>];
    if(coordinate[0] == 0 && coordinate[1] == 0){
        coordinate = [121.15166,16.48262];
    }
    var add_map = new custom_map('add-map',false,true,false,coordinate,17,lets,true);
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

    add_map.map.addLayer(layer);
    
    function toMap(){
        var x = document.getElementById("coordinate-x").value;
        var y = document.getElementById("coordinate-y").value;
        if(x && y){
            add_map.pick_point([y,x]);
        }
    }

    function lets(coordinate){
        document.getElementById("coordinate-x").value = coordinate[1];
        document.getElementById("coordinate-y").value = coordinate[0];
    }

    $(document).ready(function(){
        $("#image").change(function(e){
            if (e.target.files[0]) {
                document.getElementById("upload-image").style.visibility = 'visible';

                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("image").files[0]);

                oFReader.onload = function (event) {
                    document.getElementById("upload-image").src = event.target.result;
                };
            }
        });
    });

    var refresher = document.getElementById('refresh');
    refresher.setAttribute('src','<?php echo base_url()?>/Icon/loading_arrow.png');
    refresher.addEventListener('click',function(){
        document.getElementById("coordinate-x").value = '<?php echo $location->y;?>';
        document.getElementById("coordinate-y").value = '<?php echo $location->x;?>';
        add_map.pick_point([<?php echo $location->x;?>,<?php echo $location->y;?>]);
    });
</script>