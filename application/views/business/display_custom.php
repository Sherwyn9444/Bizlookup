
<div class='w-100 mt-1'>
    <div class='d-flex justify-content-between w-100'>
        <div class='w-100 me-3'>
            <div class='d-flex justify-content-between mb-3'> 
                <h1 class='h1'>Businesses</h1>
                <div>
                    <!--<button class='btn btn-primary px-5' onclick="set_export()">Export</button>-->
                    <button class='btn btn-primary px-5' onclick='set_print()'>Print</button>
                </div>
            </div>
            <div id='print-window'>
                <table class='table custom-table'>
                        <thead id='custom-thead'>
                            <th>BID</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Address</th>
                        </thead>
                        <tbody id='custom-tbody'>

                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    var data = <?php echo json_encode($dump);?>;
    var p_data = [];
    for(var i = 0; i < data.length; i++){
        p_data.push(JSON.parse(data[i]));
    }
   
    var al = <?php echo json_encode($allow)?>;
    var all = JSON.parse(al.head);
    var allowed = all;
    var disp_allow = JSON.parse(al.title);
    set_custom();

    function set_custom(){

        var thead = document.getElementById("custom-thead");
        var str2 = "<th>BIN</th>";
            
        for(var y = 0; y < disp_allow.length; y ++){
            str2 += "<th>";
            str2 += ""+disp_allow[y];
            str2 += "</th>";
        }
            

        thead.innerHTML = str2;

        var tbody = document.getElementById("custom-tbody");
        var str = "";
        for(var x = 0; x < p_data.length; x++){
            str += "<tr>";
            str += "<td style='min-width:75px;'>"+p_data[x].bin+"</td>";
            for(var y = 0; y < allowed.length; y ++){
                str += "<td>"+p_data[x][allowed[y]]+"</td>";
            }
            str += "</tr>";
        }
        tbody.innerHTML = str;
    }

    function set_print(){
        var print_section = document.getElementById("print-window").innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = print_section;

        window.print();

        document.body.innerHTML = originalContents;
    }

    function set_export(){
        window.location.href = "<?php echo site_url("Settings/export")?>";
    }

</script>