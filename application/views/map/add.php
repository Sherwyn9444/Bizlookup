
<div class="d-flex justify-content-center">
<?= form_open_multipart('map/add') ?>
    <div id='add-map-form'>
        <div class="d-flex justify-content-between">
            <div class="form-group p-4 w-50">
                <label for="name">Name</label>
                <input required type="text" class="form-control" id="name" name='name' aria-describedby="nameHelp" placeholder="Enter Name">
                
                <label for="category">Owner</label>
                <input required type="text" class="form-control" id="owner" name='owner' placeholder="Enter Owner">
                <label for="x">Coordinates</label>
                <div class='d-flex justify-content-between'>
                    <input type='text' class="form-control" id="coordinate-y" onchange="toMap()" name='y' placeholder = Longitude>
                    <input type='text' class="form-control" id="coordinate-x" onchange="toMap()" name='x' placeholder = Latitude>
                    <img id='refresh' class='refresh-button ms-2'></img>
                </div>
                <div>
                    <label for="image">Upload Image</label>
                    <input type="file" class="form-control" id="image" name='image'>
                </div>
                
                <div class="form-group p-4">
                    <img id='upload-image' alt="image" style='width:365px;height:365px;object-fit:contain;visibility:hidden;'>
                </div>
            </div>  
            
            <div class="form-group p-4 w-100">
                <div id='add-map' style='width:100%;height:575px;'></div>
            </div>
            <div class='r-side-control'>
                <button type="submit" id='add-form-submit' class="btn btn-primary">Add</button>
            </div>
        </div>
    </div> 
</div>
<div class='l-side-control'>
    <a href='<?php echo base_url()?>' type="button" class="btn btn-primary">Back</a>
</div>


<script>
    var add_map = new custom_map('add-map',false,true,false,[121.15166,16.48262],17,lets);
    function lets(coordinate){
        document.getElementById("coordinate-x").value = coordinate[1];
        document.getElementById("coordinate-y").value = coordinate[0];
    }

    function toMap(){
        var x = document.getElementById("coordinate-x").value;
        var y = document.getElementById("coordinate-y").value;
        if(x && y){
            add_map.pick_point([y,x]);
        }
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
        document.getElementById("coordinate-x").value = '';
        document.getElementById("coordinate-y").value = '';
        add_map.pick_point([121.15166,16.48262],true);
    });
</script>