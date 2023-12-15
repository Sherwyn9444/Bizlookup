<div>
    <div class='d-flex justify-content-between'>
        
        <div class='w-100'>
            <div class='d-flex justify-content-start'>
                <div class='w-25'>
                    <select id='select-brgy' class='form-select' onchange="select_filter(this.value)">
                        <option value = "0">All</option>
                        <?php
                            foreach($barangay as $bd){
                                echo "<option value=".$bd->id.">".$bd->name."</option>";
                            };
                        ?>
                    </select>
                </div>
                <div class='w-25 ms-2'>
                    <select id='select-month' class='form-select' onchange="set_month(this.value)">
                        <option value = "-1">All</option>
                        <option value = "0">January</option>
                        <option value = "1">February</option>
                        <option value = "2">March</option>
                        <option value = "3">April</option>
                        <option value = "4">May</option>
                        <option value = "5">June</option>
                        <option value = "6">July</option>
                        <option value = "7">August</option>
                        <option value = "8">September</option>
                        <option value = "9">October</option>
                        <option value = "10">November</option>
                        <option value = "11">December</option>
                    </select>
                </div>
                <div class='w-25 ms-2'>
                    <select id='select-year' class='form-select' onchange="set_year(this.value)">
                        
                    </select>
                </div>
            </div>
            <div id='chart-holder-1'>
                <canvas id="time_chart_1" style="width:100%;"></canvas>
            </div>
        </div>
        <div class='w-50'>
            <div id='chart-holder-2' >
                <canvas id="status_chart" style="width:100%;"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
var date_barangay = <?php echo json_encode($brgy_date)?>;
var barangay = <?php echo json_encode($barangay)?>;
var filter = ["year","month","day"];
var selected = "day";
var filter_max = 31;
var month = new Date().getMonth();
var year = new Date().getFullYear();
var xValues = [];
var yValues = [];

document.getElementById('select-month').value = month;

load_year();
function load_year(){
    var str = "";
    var ctr = 0;
    for(var i = parseInt(year) - 20; i < year; i++){
        str += "<option value = "+i+">"+(parseInt(year - 20)+ctr)+"</option>";
        ctr++;
    }
    str += "<option value = "+year+" selected>"+(year)+"</option>";
    document.getElementById('select-year').innerHTML = str;
}

function set_year(val){
    year = val;
    select_filter(document.getElementById("select-brgy").value);
}

function get_brgy(id){
    for(var i = 0; i < barangay.length;i++){
        if(barangay[i].id == id){
            return barangay[i].name;
        }
    }
}

function formalize(xv,yv,des){
    var xval = [];
    var yval = [];
    if(selected == "day"){
        for(var x = 1; x <= filter_max; x++){
            xval.push(x);
            yval.push(0);
        }

        for(var y = 0; y < xv.length;y++){
            var temp_date = new Date(xv[y]);
            if(month == temp_date.getMonth()){
                yval[temp_date.getDate() - 1] = yv[y];
            }
        }
    }
    return [xval,yval,des];
    
}   

function create_chart(val){
    document.getElementById('chart-holder-1').innerHTML = '<canvas id="time_chart_1" style="width:100%;"></canvas>';
    bdchart = new data_chart("time_chart_1","Businesses per barangay","line",val[2],val[0],val[1]);
    bdchart.render();
}

function set_month(e){
    e = parseInt(e) + 1;
    var d = new Date(year, e, 0).getDate();
    filter_max = d;
    month = parseInt(e) - 1;
    select_filter(document.getElementById("select-brgy").value);
}

function select_filter(i){
    var brgy = get_brgy(i);
    xValues = [];
    yValues = [];

    if(i == 0){

        if(document.getElementById("select-month").value == -1){
            
            var xyear = ["January","February","March","April","May","June","July","August","September","October","November","December"];
            

            var data_temp = [];
            for(var x = 0; x < barangay.length; x++){
                brgy = get_brgy(x);
                
                z_temp = {};

                for(var j = 1; j <= 12; j++){
                    z_temp[j] = 0;
                }

                for(var i = 0; i < date_barangay.length;i++){
                    if(date_barangay[i].barangay == brgy && date_barangay[i].year == year){
                        z_temp[date_barangay[i].month] += parseInt(date_barangay[i].count);
                    }
                }
                data_temp.push(z_temp);
            }

            document.getElementById('chart-holder-1').innerHTML = '<canvas id="time_chart_1" style="width:100%;"></canvas>';
            bdchart = new data_chart("time_chart_1","Businesses per barangay","line","");
            
            bdchart.setXval(xyear);

            for(var y = 1; y < data_temp.length; y++){
                var y_temp = [];
                for(var z = 1; z <= 12 ; z++){
                    y_temp.push(data_temp[y][z]);
                }
                
                var hsl_col = (360/data_temp.length) * (y);
                var sat = 50;
                console.log(hsl_col);
                bdchart.add_data_set(get_brgy(y),y_temp,"hsl("+hsl_col+", 100%, "+sat+"%)","hsl("+hsl_col+", 100%, "+sat+"%)");
            }

            bdchart.render();

        }else{
            var all_brgy = [];
            for(var x = 0; x < barangay.length; x++){
                brgy = get_brgy(x);
                xValues = [];
                yValues = [];
                for(var i = 0; i < date_barangay.length;i++){
                    
                    if(date_barangay[i].barangay == brgy && date_barangay[i].year == year && date_barangay[i].month == month+1){
                        xValues.push(date_barangay[i]["date"]);
                        yValues.push(date_barangay[i].count);
                    }
                }
                all_brgy.push([xValues,yValues]); 
            }
            document.getElementById('chart-holder-1').innerHTML = '<canvas id="time_chart_1" style="width:100%;"></canvas>';
            bdchart = new data_chart("time_chart_1","Businesses per barangay","line","");
            
            
            var xDate = [];
            for(var x = 1; x <= filter_max; x++){
                xDate.push(x);
            }
            bdchart.setXval(xDate);

            for(var y = 1; y < all_brgy.length; y++){
                var set_stone = formalize(all_brgy[y][0],all_brgy[y][1]);
                var hsl_col = (360/all_brgy.length) * (y);
                var sat = 50;
                console.log(hsl_col);
                bdchart.add_data_set(get_brgy(y),set_stone[1],"hsl("+hsl_col+", 100%, "+sat+"%)","hsl("+hsl_col+", 100%, "+sat+"%)");
            }


            bdchart.render();
        }
        
    }else{
        for(var i = 0; i < date_barangay.length;i++){
            if(date_barangay[i].barangay == brgy && date_barangay[i].year == year && date_barangay[i].month == month+1){
                xValues.push(date_barangay[i]["date"]);
                yValues.push(date_barangay[i].count);
            }
        }
        create_chart(formalize(xValues,yValues, brgy));
    }
    
    
}

var bdchart = new data_chart("time_chart_1","Businesses within barangay vs Date","line","Salvacion",xValues,yValues);
bdchart.render();

select_filter(0);
</script>

<script>

    document.getElementById("side-dashboard").style.backgroundColor = getComputedStyle(document.documentElement).getPropertyValue('--cfirst');

    var b_status = <?php echo json_encode($status);?>;
    var pie_chart;

    var b_x = [];
    var b_y = [];
    var barColors = [];

    for(var x = 0; x < status_template.length; x++){
        b_x.push(status_template[x].status);
        b_y.push(status_template[x].count);
        barColors.push(status_template[x].color);
    }
    

    pie_chart = new Chart("status_chart", {
        type: "pie",
        data: {
            labels: b_x,
            datasets: [{
            backgroundColor: barColors,
            data: b_y
            }]
        },
        options: {
            title: {
            display: true,
            text: "Business Status",
            fontSize:22,
            fontColor:"#FFFFFF",
            }
        }
    });

$("#status_chart").click( 
    function(evt){
        var activePoints = pie_chart.getElementsAtEvent(evt);      
        
        if(activePoints.length > 0){
            //get the internal index of slice in pie chart
            var clickedElementindex = activePoints[0]["_index"];

            //get specific label by index 
            var label = pie_chart.data.labels[clickedElementindex];

            //get value by index      
            var value = pie_chart.data.datasets[0].data[clickedElementindex];

            //console.log(clickedElementindex,label,value);   
            window.location.href = "<?php echo site_url('main/businesses')?>/?search="+label;
        }
        
    }
);  

</script>
