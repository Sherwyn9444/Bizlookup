
class main_map{
    points = [];
    restriction = [];
    map;
    constructor(object_id,center = [121.15166,16.48262],zoom = 17,on_click = ()=>{}, on_hover = ()=>{}){
        this.center = center;
        this.restriction = ['x','y','owner'];
        this.status_pattern = [];
        this.status_none = "#6e6e6e";
        var temp_map = new ol.Map({
            layers:[
                new ol.layer.Tile({
                    source: new ol.source.TileJSON({
                        url:'https://api.maptiler.com/maps/openstreetmap/tiles.json?key=iXy9WEaPCZfoCJLTKnjL',
                        tileSize:512,
                    })
                }),
                
            ],
            target: object_id,
            view: new ol.View({
                center: ol.proj.fromLonLat(center),
                zoom: zoom,
            })
        });

        temp_map.on("pointermove",function(event){
            var pixel = temp_map.getPixelFromCoordinate(event.coordinate);
            var count = 0;
            temp_map.forEachFeatureAtPixel(pixel, function (feature, layer) {
                if(layer && !on_tooltip && layer.type != 'Region'){
                    on_hover(feature.individual);
                }
                count++;
            });
            
            if(!count){
                close_tooltip();
            }
        });
        

        temp_map.on("singleclick",function(event){

            on_click(event.coordinate);
            //temp_map.addLayer(createPoint(event.coordinate));
        })
        
    
        this.map = temp_map;
    };

    set_scheme(scheme = {'one':'red'}){
        this.scheme = scheme;
    }

    set_images(images = {'one':'Icon/Marker_Icon.png','two':'Icon/Marker_Icon.png'}){
        this.images = images;
    }

    add_temp(coordinate, status){
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
                    radius: 8
                }),
            })
        });
        this.map.addLayer(layer);
        //console.log(layer);
    }

    add_layer(name,location,indiv = [{name:"Object", category:'one'}],businesses= []){

        var features = [];
        
        location = this.reverser(location);
        for(var i = 0 ; i < location.length; i ++){
            var feat = new ol.Feature(new ol.geom.Point(ol.proj.fromLonLat([location[i][0],location[i][1]])));
            feat.individual = indiv[i];
            feat.business = businesses;
            
            if(location[i][0] == this.center[0] && location[i][1] == this.center[1]){
                feat.setStyle(this.get_style(indiv[i].business,0.1));
            }else{
                feat.setStyle(this.get_style(indiv[i].business));
            }
            features.push(feat);
        };

        var layer = new ol.layer.Vector({
            source: new ol.source.Vector({
                features: features,
            }),
        });
        
        layer.name = name;
        layer.type = 'Location';
        
        this.map.addLayer(layer);
    };

    set_status_style(pattern){
        console.log(pattern);
        this.status_pattern = pattern;
    }

    set_status_none(pattern){
        this.status_none = pattern;
    }

    get_style(business, size = 0.06){
        var ctr = [];
        var color = "";
        var max = 0;
        for(x in business){
            max++;
            for(y in this.status_pattern){
                if(business[x]['status'] == this.status_pattern[y].status){
                    ctr.push(this.status_pattern[y].color);
                }
            }
        }
        console.log(ctr);
        
        for(var x = 0; x < ctr.length; x++){
            if(ctr[x]){
                if(x == 0){
                    color = ctr[x];
                }else{
                    color = blendColors(color,ctr[x],0.5);
                }
            }
        }
        if(color == ""){
            color = this.status_none;
        }
        console.log(color);
        if(ctr[0] == 0 && ctr[1] == 0 && ctr[2] == 0){
            rgbcolors = [110,110,110];
        }
        var style_layer = new ol.style.Style({
            image: new ol.style.Icon({
                color: color,
                crossOrigin: 'anonymous',
                src: 'Icon/Marker_Icon.png',
                scale: size
            }),
        });
        return style_layer;
    }

    check_filter(filter = {category:['one','two']}){
        var layers = this.map.getAllLayers();
        var zero_style = new ol.style.Style(null);
        var is_on = [];
        for(var x = 1; x < layers.length; x++){
            var sources = layers[x].getSource();
            var features = sources.getFeatures();
            for(var z = 0; z < features.length; z++){
                var obj = features[z].individual;
                //console.log(obj);
                var keys = (Object.keys(obj));
                var filter_keys = Object.keys(filter);

                
                features[z].setStyle(zero_style);
                
                //features[z].setStyle(this.get_style(obj['business']));
                var busi = obj.business;
               
                var open = 0;
               
                for(var i = 0; i < busi.length; i++){
                    var bkey = Object.keys(busi[i]);
                    for(var j = 0; j < bkey.length; j++){
                        if(busi[i][bkey[j]])
                        if(busi[i][bkey[j]].toLowerCase().includes(filter['search'].toLowerCase()) || (!filter['search'])){
                            
                            open++;
                            break;
                        }
                    }
                    if(open)break;
                }
                
                for(var i = 0; i < busi.length; i++){
                    if(filter['barangay'])
                    if(busi[i].barangay == filter['barangay']){
                        open++;
                        break;
                    }
                }

                for(var i = 0; i < busi.length; i++){
                    if(busi[i].status == filter['status']){
                        open++;
                        break;
                    }
                }

                for(var i = 0; i < busi.length; i++){
                    if(filter['category'])
                    if(busi[i].category == filter['category']){
                        open++;
                        break;
                    }
                }
                
                if(busi.length <= 0 && (filter['status'].includes('all') || filter['status'].includes('empty'))){

                    if(!filter['barangay'] && !filter['category'])open++;
                    open++;
                }

                if(filter['search'].includes(obj.pin) && filter['search'] != ""){
                    open++;
                }

                if(filter['status'] == 'all'){
                    open++;
                }

                if(!filter['barangay']){
                    open++;
                }

                if(!filter['category']){
                    open++;
                }
                
               if(open > 3){
                    features[z].setStyle(this.get_style(obj['business']));
                    if(is_on.includes(features[z].individual)){

                    }else{
                        is_on.push(features[z].individual);
                    }
               }

            }
        }

        return is_on;
    }

    pick_point(coor = [0,0],zoomonly = false){
        reset(this.map);
        var layer = new ol.layer.Vector({
            source: new ol.source.Vector({
                features: [
                    new ol.Feature(new ol.geom.Point(ol.proj.fromLonLat(coor)))
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
        var cam_view =  new ol.View({
            center: ol.proj.fromLonLat(coor),
            zoom: this.map.getView().getZoom(),
        });
       
        if(!zoomonly){
            this.map.addLayer(layer);
        }

        this.map.setView(cam_view);
        
    }
    show_all(){
        var layers = this.map.getAllLayers();
        for(var x = 1; x < layers.length; x++){
            var sources = layers[x].getSource();
            var features = sources.getFeatures();
            for(var z = 0; z < features.length; z++){
                var obj = features[z].individual;
                features[z].setStyle(this.get_style(obj['business']));
            }
        }
    }

    
    get_all_points(){
        return this.map.getLayers();
    }
    get_points(location){
        var pixel = map.getPixelFromCoordinate(location);
    };

    reverser(locations){
        var temp = [];
        for(var i = 0; i < locations.length; i++){
            temp.push([locations[i][1],locations[i][0]]);
        }
        return temp;
    }
    
    convert(locations){
        var temp = [];
        for(var i = 0; i < locations.length; i++){
            temp.push(ol.proj.fromLonLat([locations[i][0],locations[i][1]]));
        }
        return temp;
    }
}

function blendColors(colorA, colorB, amount) {
    const [rA, gA, bA] = colorA.match(/\w\w/g).map((c) => parseInt(c, 16));
    const [rB, gB, bB] = colorB.match(/\w\w/g).map((c) => parseInt(c, 16));
    const r = Math.round(rA + (rB - rA) * amount).toString(16).padStart(2, '0');
    const g = Math.round(gA + (gB - gA) * amount).toString(16).padStart(2, '0');
    const b = Math.round(bA + (bB - bA) * amount).toString(16).padStart(2, '0');
    return '#' + r + g + b;
  }
  