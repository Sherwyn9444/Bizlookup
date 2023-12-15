<div class="d-flex justify-content-center mt-4">
    <h1 class='h1'>All<h1>
</div>
<div class="d-flex justify-content-center">
    <div>
    <div class='w-100 py-1' style='background-color:lightgray;'></div>
    <div class='tab-toggle'>
        <div class='view-main' style='overflow:auto;'>
        </div>
    </div>
    </div>
</div>
<script>
    function delete_data(loc_id){
        if(confirm("Do you wish to continue deleting #"+loc_id)){
            window.location.href = "<?php echo site_url("map/delete")?>/"+loc_id;
        }
    }

    function edit_data(loc_id){
        window.location.href = "<?php echo site_url("main/edit")?>/"+loc_id;
    }

    function view_data(loc_id){
        window.location.href = "<?php echo site_url("main/look")?>/"+loc_id;
    }
    
</script>
<div class='l-side-control'>
    <a type='button' href='<?php echo base_url()?>' class='btn btn-primary'>Back</a>
    <a type='button' href='<?php echo site_url("main/add")?>' class='btn btn-primary'>Add New</a>
</div>
<script>
    var tab_select = 0;
    var all_tabs = document.getElementsByClassName('tab-header');
    var tab_body = document.getElementsByClassName('tab-toggle');

    for(var x = 0; x < all_tabs.length; x++){
        all_tabs[x].addEventListener("click",function(){
            change_tab(this.id);
        });

        all_tabs[x].addEventListener("mouseover",function(){
            hover_tab(this.id);
        });

        all_tabs[x].addEventListener("mouseleave",function(){
            unhover_tab();
        });
    }

    change_tab(0);
    function change_tab(number){
        var all_tab = document.getElementsByClassName('tab-header');
        for(var x = 0; x < all_tab.length; x++){
            all_tab[x].style.backgroundColor = "gray";    
        }
        tab_select = number;
        all_tab[number].style.backgroundColor = "lightgray";
        setter();
    }

    function hover_tab(number){
        change_tab(tab_select);
        var all_tab = document.getElementsByClassName('tab-header');
        all_tab[number].style.backgroundColor = "whitesmoke";
    }

    function setter(){
        for(var x = 0; x < tab_body.length; x++){
            tab_body[x].style.display = "none";    
        }
        tab_body[tab_select].style.display = "block";
    }
    function unhover_tab(){
        change_tab(tab_select);
    }
</script>