<html>
    <head>
        <link href="<?php echo base_url()?>assets/bootstrap-5.3.0-dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url()?>assets/css/checkbox.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/ol/ol-v7.2.2-ol.css">    <!--Map-->
        <link rel="icon" href="<?php echo base_url()?>Icon/bizlookup.png">
        <script src="<?php echo base_url()?>assets/ol/ol-v7.2.2-dist-ol.js"></script>   <!--Map-->
        <script src="<?php echo base_url()?>assets/ol/elm-pep-1.0.6-dist-elm-pep.js"></script> <!--Map-->
        <script src="<?php echo base_url()?>assets/js/data.js"></script> <!--Data-->
        <script src="<?php echo base_url()?>assets/js/scheme.js"></script> <!--color-->
        <script src="<?php echo base_url()?>assets/js/map.js"></script> <!--Map-->
        <script src="<?php echo base_url()?>assets/js/map2.js"></script> <!--Map-->
        <script src="<?php echo base_url()?>assets/js/analytics.js"></script> <!--chart-->
        <script src="<?php echo base_url()?>assets/jquery-3.6.4.min.js"></script>
        <script src="<?php echo base_url()?>assets/bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <script>
            var base_url = '<?php echo base_url()?>';
        </script>
        <style>

            :root{
                --bgfirst: #FFFFFF;
                --bgsecond:#48494B;
                --cfirst:#D9D9D9;
                --csecond:#FFFFFF;
                --bfirst:#00FFFF;
                --beffect:#2F2F2F;
                
            }

            body{
                background-color: var(--bgfirst);
                
            }
            .l-side-control{
                position: absolute;
                z-index: 2;
                bottom: 25px;
                left:  25px;
                width: 200px;
            }

            .t-side-control{
                position: absolute;
                z-index: 2;
                top: 60px;
                left:  5px;
                width: 300px; 
            }

            .top-side-control{
                position: absolute;
                z-index: 2;
                margin-top: 25px;
                margin-left: 35px;
            }
            
            .b-side-control{
                position: absolute;
                z-index: 3;
                top: 20px;
                right:  5px;
                width: fit-content;
                
            }

            .r-side-control{
                position: absolute;
                z-index: 2;
                bottom: 25px;
                right:  25px;
                background-color: rgba(128,128,128,0.25);
            } 
            
            .a-side-control{
                margin-top:15px;
                border-radius: 15px;
                background-color: lightgrey;
                width:300px;
            }

            .pix-color{
                width: 35px;
                height: 35px;
                border: 1px solid black;
            }
            .form-color{
                height: 50px;
            }
            .location-name{
                background-color: lightgray;
                color:black;
                margin: 5px;
                padding: 2px;
                cursor: pointer;
            }
            
            .location-name:hover{
                background-color: var(--csecond);
                color:black;
            }

            .view-card div{
                margin: 1px;
            }

            .view-card{
                display: inline-block;
                width: 300px;
                height: 445px;
                background-color: var(--bgfirst);
                margin: 15px;
                padding: 15px;
                overflow: auto;
                border-radius: 15px;
            }
            
            .view-controls button{
                margin-left: 5px;
            }
            .view-img{
                width: 100%;
                height: 125px;
                border-radius: 15px;
                object-fit: contain;
                object-position: top;
            }
            .view-clearance{
                border-radius:15px;
                text-align:center;
                display: inline-block;
                width: fit-content;
            }
            .region-coordinate{
                background-color: var(--bgfirst);
                color:var(--csecond);
                cursor: pointer;
                padding: 7px;
                padding-top: 1px;
                padding-bottom: 1px;
            }
            .region-coordinate:hover{
                background-color: var(--csecond);
                color: var(--bgfirst);
            }
            .refresh-button{
                width: 40px;
                height: 40px;
                cursor: pointer;
                
            }

            .allow-pix{
                cursor: pointer;
                height:fit-content;
            }

            #all_side_search{
                padding-top: 15px;
                padding-right: 15px;
                padding-bottom: 15px;
                background-color:rgba(255,255,255,0.9);
                visibility: hidden;
                width: 0%;
                overflow: hidden;
                transition: width 1s, visibility 0.75s;
            }
            #add-form{
                width: 100%;
                background-color: lightgray;
                border-radius: 10px;
                margin-top: 25px;
            }

            #add-form label, #add-map-form label{
                color:black;
            }

            #add-map-form{
                width: 100%;
                background-color: lightgray;
                border-radius: 10px;
                margin-top: 25px;
            }

            #login-form{
                padding: 25px;
                background-color: var(--bgsecond);
                color: var(--csecond);
            }
            
            .map-legend{
                color: black;
            }
            #tab-separator{
                margin-right: 25px;
                background-color: var(--bgsecond);
            }
            .view-main{
                margin-right: 15px;
                height: 500px;
                border-radius: 10px;
                border-top-left-radius: 0px;
                padding: 15px;
                background-color: var(--bgsecond);
            }

            .disp-item{
                margin-bottom: 10px;
                padding: 10px;
                background-color: var(--bgsecond);
            
            }

            .disp-image img{
                object-fit: contain;
                width: 100%;
                height: 100%;
            }
            .disp-clickable{
                cursor: pointer;
                margin-bottom: 10px;
                padding: 10px;
                background-color: var(--bgsecond);
            }

            .disp-clickable div{
                margin: 1px;
            }
            .disp-clickable:hover{
                background-color: var(--beffect);
            }

            .disp-item div{
                margin: 5px;
            }
            .disp-image{
                width: 100px;
                height: 100px;
            }
            .disp-map{
                height:500px;
                border: 1px solid var(--bfirst);
            }

            .disp-table{
                margin-top: 15px;
                background-color: var(--bgsecond);
                color:var(--csecond);
            }

            .disp-table td{
                border-top: 1px solid var(--bgfirst);
            }
            .view-table{
                /*overflow: auto;*/
                background-color: var(--bgsecond);
            }

            .view-table thead td{
                font-weight: bold;
                color:var(--csecond);
            }
            
            .view-table tbody td{
                color:var(--cfirst);
            }

            .view-table > thead > tr > td{
                border-bottom:1px solid var(--bfirst);
            }

            .view-table > tbody > tr > td{
                border-bottom:1px solid var(--bfirst);
            }

            .custom-table{
                background-color: var(--bgsecond);
                color:var(--csecond);
            }

            .custom-table th{
                background-color: var(--bgsecond);
                color:var(--csecond);
            }
            .custom-table td{
                background-color: var(--bgsecond);
                color:var(--csecond);
            }

            .table td{
                background-color: var(--bgsecond);
            }
            .table th{
                background-color: var(--bgsecond);
            }

            .all-table{
                width: 300px;
            }

            .all-table th{
                color:var(--csecond);
            }

            .all-table td{
                color:var(--csecond);
            }
            
            .tooltip-img{
                width: 100%;
                height: fit-content;
                max-height: 125px;
                border-radius: 15px;
                object-fit: contain;
                object-position: top;
            }
            
            .tooltip-icon{
                width: 25px;
                height: 25px;
                object-fit: contain;
                margin-right:5px;
            }
            #map-description, #map-seeker{
                background-color: var(--bgsecond);
                color:var(--csecond);
                padding: 5px;
                border-radius: 10px;
            }
            
            .map-definer{
                background-color: var(--bgsecond);
                height:100%;
                overflow: auto;
                font-size: 14px;
            }

            .map-location:hover{
                background-color: var(--beffect);
            }

            .map-img{
                width: 100%;
                height: 100px;
                border-radius: 15px;
                object-fit: contain;
                object-position: top;
            }

            .map-business-display:hover{
                background-color: var(--beffect);
            }

            .map-legend{
                cursor: pointer;
                padding-top: 8px;
            }
            
            .tab-header{
                border-top-left-radius: 15px;
                border-top-right-radius: 15px;
                background-color: var(--bgsecond);
                color: var(--bgfirst);
                cursor: pointer;
            }
            

            .in-front{
                position: absolute;
                left:0;
                top:0;
            }

            .admin-header-div{
                background-color: var(--bgsecond);
                color:var(--csecond);
                height:100px;
                
            }
            .admin-front-sidebar{
                
            }

            .admin-sidebar-body{
                width: 100%;
                padding-left: 15px;
                color: var(--csecond);
            }

            #admin-sidebar-hider{
                height:100%;
                width:25px;
                text-align: center;
                font-size:35px;
                cursor:pointer;
            }
            
            .admin-sidebar{
                background-color: var(--bgsecond);
                width: 225px;
                color: var(--csecond);
                transition: 0.25s ease-in-out;
            }
            .admin-sidebar-button{
                cursor: pointer;
                list-style-type: none;
            }
            .admin-sidebar-header{
                color: var(--csecond);
            }
            .admin-sidebar-button a{
                text-decoration: none;
                color:black;
                background-color: var(--bgsecond);
                color: var(--csecond);
                display: block;
            }

            #admin-head{
                height:110px;
                overflow: hidden;
                transition: 0.25s ease-in-out;
            }
            .admin-sidebar-button a:hover{
                background-color: var(--beffect);
                color: var(--bgsecond);
            }
            
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 5; /* Sit on top */
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            }

                /* Modal Content/Box */
            .modal-control {
                background-color: #fefefe;
                margin: 15% auto; /* 15% from the top and centered */
                margin-top: 2%;
                padding: 20px;
                border: 1px solid #888;
                width: 80%; /* Could be more or less, depending on screen size */
                background-color: var(--bgsecond);
            }

            .modal-content{
                width: 80%;
                background-color: var(--bgsecond);
                
                border: none;
            }

                /* The Close Button */
            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }

            .login-img{
                background-image: url('<?php echo base_url()?>Icon/Background1.jpg');
                
            }
            
        </style>
    </head>
    <body>
   

