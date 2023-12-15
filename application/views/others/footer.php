    
    </body>
    
    <script>
    
    var theme = <?php echo json_encode($theme);?>;
    theme = theme[0];
    
    set_theme_all(theme);
    
    function set_theme_all(theme){
        var r = document.querySelector(':root');
        r.style.setProperty('--bgfirst', theme.bgfirst);
        r.style.setProperty('--bgsecond', theme.bgsecond);
        r.style.setProperty('--cfirst', theme.cfirst);
        r.style.setProperty('--csecond', theme.csecond);
        r.style.setProperty('--bfirst', theme.bfirst);
        r.style.setProperty('--beffect', theme.beffect);
    }
    
    var img_all = document.getElementsByTagName("img");
    for(i in img_all){
        
        if(isElement(img_all[i])){
            document.getElementById("hover-img").onerror = function(){
                document.getElementById("hover-img").setAttribute("src","<?php echo base_url()?>assets/__placeholder.png");
            }
        }
    }

    function isElement(element) {
        return element instanceof Element || element instanceof HTMLDocument;  
    }
    </script>

</html>