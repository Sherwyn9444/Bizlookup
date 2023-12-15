
class custom_map{
    points = [];
    restriction = [];
    map;
    constructor(object_id,ishover = true, isclick = false, isactive = true,center = [121.15166,16.48262],zoom = 17,on_click){
        this.ishover = ishover;
        this.isclick = isclick;
        this.isactive = isactive;
        this.center = center;
        this.restriction = ['x','y','owner'];

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

        if(ishover){
            var res = this.restriction;
            temp_map.on("pointermove",function(event){
                var pixel = temp_map.getPixelFromCoordinate(event.coordinate);
                var count = 0;
                temp_map.forEachFeatureAtPixel(pixel, function (feature, layer) {
                    if(layer && !on_tooltip && layer.type != 'Region'){
                        show_tooltip(feature.individual,event.pixel,res);
                    }
                    count++;
                });
                
                if(!count){
                    close_tooltip();
                }
            });
        }
        if(isclick){
            temp_map.on("singleclick",function(event){
                reset(temp_map);
                var coordinate = ol.proj.transform(event.coordinate, 'EPSG:3857', 'EPSG:4326')
                var layer = new ol.layer.Vector({
                    source: new ol.source.Vector({
                        features: [
                            new ol.Feature(new ol.geom.Point(event.coordinate))
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

                temp_map.addLayer(layer);
                on_click(coordinate);
                //temp_map.addLayer(createPoint(event.coordinate));
            })
        }
        
        if(isactive){
            temp_map.on("singleclick",function(event){
                var pixel = temp_map.getPixelFromCoordinate(event.coordinate);
                temp_map.forEachFeatureAtPixel(pixel, function (feature, layer) {
                    if(layer && layer.type != 'Region'){
                        on_click(feature);
                    }
                });
                
            })
        }


        this.map = temp_map;
    };

    set_scheme(scheme = {'one':'red'}){
        this.scheme = scheme;
    }

    set_images(images = {'one':'Icon/Marker_Icon.png','two':'Icon/Marker_Icon.png'}){
        this.images = images;
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

    get_style(business, size = 0.06){
        var ctr = [0,0,0];
        var max = 0;
        for(x in business){
            max++;
            if(business[x]['status'] == "Active"){
                ctr[1] += 1;
            }else if(business[x]['status'] == "Inactive"){
                ctr[0] += 1;
            };
        }
        var rgbcolors = [Math.round(255*(ctr[0]/max)),Math.round(255*(ctr[1]/max)),Math.round(255*(ctr[2]/max))];
        if(ctr[0] == 0 && ctr[1] == 0 && ctr[2] == 0){
            rgbcolors = [110,110,110];
        }
        /*
        max = Math.max(ctr[0],ctr[1],ctr[2]);
        var hsl = 0;
        var perce = 50;
        var rgbcolors = [255*(ctr[0]/max),255*(ctr[1]/max),255*(ctr[2]/max)];
        //hsl = (colors[0] + colors[1] + colors[2]) / max;
        if(max == 0){
            perce = 0;
        }
        for(x in rgbcolors){
            if(isNaN(rgbcolors[x])){
                rgbcolors[x] = 0;
            }
        }
        var hexcolor = [rgbcolors[0].toString(16)+'0000','00'+rgbcolors[1].toString(16)+'00','0000'+rgbcolors[2].toString(16)];
        var decicolor = [parseInt(hexcolor[0],16),parseInt(hexcolor[1],16),parseInt(hexcolor[2],16)];
        var color = 0;
        if(decicolor[0] != 0 && decicolor[1] != 0){
            color = Math.round((decicolor[0] + decicolor[1]) / 2);
        }else{
            color = (decicolor[0] + decicolor[1]);
        };
        color = color.toString(16);
        if(isNaN(hsl)){
            hsl = 0;
        }
        while(color.length < 6){
            color = '0' + color;
        }
        console.log(ctr,color);
        //'rgb('+colors[0]+','+colors[1]+','+colors[2]+')'
        //0/360 -> red
        //120 -> green
        //240 -> blue
        */
        var style_layer = new ol.style.Style({
            image: new ol.style.Icon({
                color: 'rgb('+rgbcolors[0]+','+rgbcolors[1]+','+rgbcolors[2]+')',
                crossOrigin: 'anonymous',
                src: 'Icon/Marker_Icon.png',
                scale: size
            }),
        });
        return style_layer;
    }

    check_filter(filter = {category:['one','two']}){
        //console.log(filter);
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
                
                if(busi.length <= 0 && filter['status'].includes('empty')){
                    features[z].setStyle(this.get_style(obj['business']));
                }
                
                for(var i = 0; i < busi.length; i++){
                    var bkey = (Object.keys(busi[i]));
                    //console.log();
                    if(filter['category'].includes(busi[i]['category']) && filter['status'].includes(busi[i]['status']) && filter['year'].includes((new Date(busi[i]['date']).getFullYear()).toString())){
                        features[z].setStyle(this.get_style(obj['business']));
                        if(!is_on.includes(busi[i])){
                            is_on.push(busi[i]);
                        }
                    }
                }
                
                for(var i = 0; i < busi.length; i++){
                    var clear = false;

                    for(var ci = 0; ci < filter['clear'].length; ci++){
                        if(busi[i][filter['clear'][ci]] && busi[i][filter['clear'][ci]] == 1){
                            features[z].setStyle(this.get_style(obj['business']));
                            
                        }else{
                            features[z].setStyle(zero_style);
                            clear = true;
                            break;
                        }
                    }

                    if(!clear){
                        if(!is_on.includes(busi[i])){
                            is_on.push(busi[i]);
                        }
                    }
                }
                
                if(obj['name']){   
                    if((!obj['name'].toLowerCase().includes(filter['name'].toLowerCase()))){
                        features[z].setStyle(zero_style);
                    }
                }

                if(obj['id']){
                    if(!obj['id'].toLowerCase().includes(filter['name'].toLowerCase())){
                        features[z].setStyle(zero_style);
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

var on_tooltip = false;
var tooltip = document.createElement("div");
tooltip.style.backgroundColor = "lightgray";
tooltip.style.padding = "5px";
tooltip.style.width = "200px";
tooltip.style.borderRadius = "10px";

function show_tooltip(def,pix,restriction){
    document.getElementById('map-tooltip').appendChild(tooltip);
    var words = document.createElement("div");
    var img = document.createElement("div");

    tooltip.style.position = "absolute";
    tooltip.style.zIndex = 99;
    tooltip.style.visibility = "visible";
    words.style.padding = "5px";
    
    on_tooltip = true;
    var keys = Object.keys(def);
    
    for(var i = 0; i < keys.length; i++){
        if(!restriction.includes(keys[i])){
            var temp = document.createElement("div");
            if(typeof def[keys[i]] === 'object'){
                    temp.innerHTML =  "";
                for(var x in def[keys[i]]){
                    var style;
                    var style_bg;
                    if(def[keys[i]][x]['status'] == 'Active'){
                        style = 'color: green;';
                        style_bg = 'filter: invert(100%)';
                    }else{
                        style = 'color: red;';
                        style_bg = 'filter: invert(100%)';
                    }
                    temp.innerHTML += "<div class='d-flex justify-content-start'><img style='"+style_bg+"' class='tooltip-icon' src='"+base_url+"/Icon/"+def[keys[i]][x]['category'].replace(" ","_")+"'><div style='display:block;"+style+"'><b>"+ def[keys[i]][x]['name'] +" ["+ def[keys[i]][x]['number'] +"]</b></div></div>";
                }
                words.appendChild(temp);
                
            }else if(keys[i] == 'imgpath'){
                img.innerHTML += "<img src="+def[keys[i]]+" class='tooltip-img'>";
            }else{
                temp.innerHTML = keys[i] + ": " + def[keys[i]];
                words.appendChild(temp);
            }
        }
    }

    tooltip.appendChild(img);
    tooltip.appendChild(words);
    tooltip.style.left = pix[0];
    tooltip.style.top = pix[1];
}


function close_tooltip(){
    on_tooltip = false;
    tooltip.innerHTML = "";
    tooltip.style.visibility = "hidden";
    
}

function reset(map){
    var all_layers = map.getAllLayers();
    for(var l = 1; l < all_layers.length; l++){
        map.removeLayer(all_layers[l]);
    }
}

var temp_region = [];
var end_point = -1;

class region_map{

    points = [];
    restriction = [];
    temp_region = [];
    on_click = function(){};
    on_hover = function(){};
    map;
    
    constructor(object_id,ishover = true, isclick = false,center = [121.15166,16.48262],zoom = 17,regions = [], points = []){
        this.ishover = ishover;
        this.isclick = isclick;
        this.restriction = ['x','y'];
        this.temp_region = [];
        this.points = points;
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
            }),
            
        });

        this.map = temp_map;
    };

    set_onhover(f = false){
        if(f){
            this.map.un("pointermove",function(){});
        }else{
            this.map.on("pointermove",function(){});
        }
    }

    set_onclick(f){
        if(f){
            this.map.un("singleclick",this.create_region);
        }else{
            this.map.on("singleclick",this.create_region);
        }
    }

    create_region(event){
        var all_layers = event.target.getAllLayers();
        for(x in all_layers){
            if(all_layers[x].name == "temporary"){
                event.target.removeLayer(all_layers[x]);
            }
        }

        var coordinate = ol.proj.transform(event.coordinate, 'EPSG:3857', 'EPSG:4326');
        temp_region.push(coordinate);

        var new_region = [];
        for(var i = 0; i < temp_region.length; i++){
            new_region.push(ol.proj.fromLonLat([temp_region[i][0],temp_region[i][1]]));
        }

        var feat = new ol.Feature({
            geometry: new ol.geom.Polygon([new_region])
        });
        var layer = new ol.layer.Vector({
            source: new ol.source.Vector({
                features: [feat],
            }),
            style: new ol.style.Style({
                stroke: new ol.style.Stroke({
                  color: 'rgba(0, 0, 255, 0.5)',
                  width: 3,
                }),
                fill: new ol.style.Fill({
                  color: 'rgba(0, 0, 255, 0.1)',
                }),
                text : new ol.style.Text({
                    text: " ",
                    font: '12px sans-serif',
                    stroke: new ol.style.Stroke({
                      color: 'black',
                      width: 0.75
                    }),
                    fill: new ol.style.Fill({
                        color:'black'
                    }),
                    overflow: false
                  })
              }),
        });
        layer.name = "temporary";
        
        set_description(temp_region);

        var layer_p = new ol.layer.Vector({
            source: new ol.source.Vector({
                features: [
                    new ol.Feature(new ol.geom.Point(event.coordinate))
                ],
            }),
            style: new ol.style.Style({
                image: new ol.style.Circle({
                    fill: new ol.style.Fill({
                        color: 'rgba(0,0,255,1)',
                    }),
                    crossOrigin: 'anonymous',
                    radius: 4
                }),
            })
        });

        layer_p.name = 'temp';
        layer_p.type = 'border';
        event.target.addLayer(layer);
        event.target.addLayer(layer_p);
    }

    

    add_region(region,description = [{name:"Object", category:'one'}]){
        
        var coordinate = [];
        for(x in region['coordinate']){
            coordinate.push(ol.proj.fromLonLat(region['coordinate'][x]));
        };
        var feat = new ol.Feature({
            geometry: new ol.geom.Polygon([coordinate])
        });
        var layer = new ol.layer.Vector({
            source: new ol.source.Vector({
                features: [feat],
            }),
            style: new ol.style.Style({
                stroke: new ol.style.Stroke({
                  color: 'rgba(0, 0, 255, 1)',
                  width: 3,
                }),
                fill: new ol.style.Fill({
                  color: 'rgba(0, 0, 255, 0.1)',
                }),
                text : new ol.style.Text({
                    text: region['name'],
                    font: '12px sans-serif',
                    stroke: new ol.style.Stroke({
                      color: 'black',
                      width: 0.75
                    }),
                    fill: new ol.style.Fill({
                        color:'black'
                    }),
                    overflow: false
                  })
              }),
        });
        layer.id = region['id'];
        layer.name = region['name'];
        layer.type = region['type'];
        layer.population = 0;
        layer.count = 0;
        layer.locations = [];
        layer.extra = {};
        layer.description = description;
        this.map.addLayer(layer);
    }

    cancel_region(){
        var all_layers = this.map.getAllLayers();
        temp_region = [];
        for(x in all_layers){
            if(all_layers[x].name == "temporary" || all_layers[x].name == "temp" ){
                this.map.removeLayer(all_layers[x]);
            }
        }
    }
    
    reset_region(){
        
        var all_layers = this.map.getAllLayers();
        for(x in all_layers){
            if(all_layers[x].name == "temporary" || all_layers[x].name == "temp" ){
                this.map.removeLayer(all_layers[x]);
            }
        }

        var new_region = [];
        for(var i = 0; i < temp_region.length; i++){
            new_region.push(ol.proj.fromLonLat([temp_region[i][0],temp_region[i][1]]));
        } 
        

        var feat = new ol.Feature({
            geometry: new ol.geom.Polygon([new_region])
        });
        var layer = new ol.layer.Vector({
            source: new ol.source.Vector({
                features: [feat],
            }),
            style: new ol.style.Style({
                stroke: new ol.style.Stroke({
                  color: 'rgba(0, 0, 255, 0.5)',
                  width: 3,
                }),
                fill: new ol.style.Fill({
                  color: 'rgba(0, 0, 255, 0.1)',
                }),
                text : new ol.style.Text({
                    text: " ",
                    font: '12px sans-serif',
                    stroke: new ol.style.Stroke({
                      color: 'black',
                      width: 0.75
                    }),
                    fill: new ol.style.Fill({
                        color:'black'
                    }),
                    overflow: false
                  })
              }),
        });
        layer.name = "temporary";
        this.map.addLayer(layer);

        set_description(temp_region);

        for(x in new_region){
            var layer_p = new ol.layer.Vector({
                source: new ol.source.Vector({
                    features: [
                        new ol.Feature(new ol.geom.Point(new_region[x]))
                    ],
                }),
                style: new ol.style.Style({
                    image: new ol.style.Circle({
                        fill: new ol.style.Fill({
                            color: 'rgba(0,0,255,1)',
                        }),
                        crossOrigin: 'anonymous',
                        radius: 4
                    }),
                })
            });
            layer_p.name = 'temp';
            layer_p.type = 'border';
            this.map.addLayer(layer_p);
        }
    }

    region_recount(number){
        var start = [];
        var mid = [];
        var end = [];
        for(x in temp_region){
            if(x < parseInt(number)){
                end.push(temp_region[x]);
            }else{
                start.push(temp_region[x]);
            }
        }
        var real = start.concat(end);
        return real;
    }

    analyze(str = 'population',category = {}){
        this.highlight_reset();
        var layers = this.get_all_region();
        var max = 0;
        var all = 0;
        for(var x = 0; x < layers.length;x++){
            if(layers[x][str] > max){
                max = layers[x][str];
                all +=  layers[x][str]; 
            }
        }
        for(var x = 0; x < layers.length;x++){
            
            var style = new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'rgba(255, 0, 0, 0.1)',
                    width: 3,
                }),
                fill: new ol.style.Fill({
                    color: 'rgba(255, 0, 0, '+(layers[x][str] / (max + 1.5) + 0.05)+')',
                }),
                text : new ol.style.Text({
                    text: layers[x].name,
                    font: '12px sans-serif',
                    stroke: new ol.style.Stroke({
                        color: 'black',
                        width: 0.75
                    }),
                    fill: new ol.style.Fill({
                        color:'black'
                    }),
                    overflow: false
                })
            });
            layers[x].setStyle(style);
        }

        

    }
    highlight_reset(){
        var layers = this.get_all_region();
        for(var x = 0; x < layers.length;x++){

            var style1 = new ol.style.Style({
                stroke: new ol.style.Stroke({
                  color: 'rgba(0, 0, 255, 1)',
                  width: 3,
                }),
                fill: new ol.style.Fill({
                  color: 'rgba(0, 0, 255, 0.1)',
                }),
                text : new ol.style.Text({
                    text: layers[x].name,
                    font: '12px sans-serif',
                    stroke: new ol.style.Stroke({
                      color: 'black',
                      width: 0.75
                    }),
                    fill: new ol.style.Fill({
                        color:'black'
                    }),
                    overflow: false
                  })
              });

            layers[x].setStyle(style1);
        }
    }
    highlight_choose(layer){
        var layers = this.get_all_region();
        var selected;

        for(var x = 0; x < layers.length;x++){
            if(layers[x].name == layer){
                selected = layers[x];
                break;
            }
        }
        var coordinates = selected.getSource().getFeatures()[0].getGeometry().getCoordinates();
        var center = selected.getSource().getFeatures()[0].getGeometry().getExtent();
        var ccenter = ol.extent.getCenter(center);
        var coordinate = [];
        temp_region = coordinate;
        for(x in coordinates[0]){
            coordinate.push(ol.proj.transform(coordinates[0][x], 'EPSG:3857', 'EPSG:4326'));
        }
        var cam_view =  new ol.View({
            center: [ccenter[0],ccenter[1]],
            zoom: this.map.getView().getZoom(),
        });
        edit_region(selected,coordinate);
       
        this.map.setView(cam_view);
    }

    highlight_coordinate(number){
        this.reset_region();
        var selected_coor = temp_region[number];
        var all_layers = this.get_all_region("border");
        var selected;
        for(x in all_layers){
            var coor = all_layers[x].getSource().getFeatures()[0].getGeometry().getCoordinates();
            if(coor[0] == ol.proj.fromLonLat(selected_coor)[0] && coor[0] == ol.proj.fromLonLat(selected_coor)[0]){
                selected = all_layers[x];
                break;
            }
        }
        var style =  new ol.style.Style({
                image: new ol.style.Circle({
                    fill: new ol.style.Fill({
                        color: 'rgba(255,255,0,1)',
                    }),
                    crossOrigin: 'anonymous',
                    radius: 4
                }),
            });
        
        selected.setStyle(style);
    }

    highlight(layer){
        this.highlight_reset();
        var layers = this.get_all_region();
        var selected;

        for(var x = 0; x < layers.length;x++){
            if(layers[x].name == layer){
                selected = layers[x];
                break;
            }
        }

        var style2 = new ol.style.Style({
            stroke: new ol.style.Stroke({
              color: 'rgba(255, 255, 0, 1)',
              width: 3,
            }),
            fill: new ol.style.Fill({
              color: 'rgba(255, 255, 0, 0.1)',
            }),
            text : new ol.style.Text({
                text: selected.name,
                font: '12px sans-serif',
                stroke: new ol.style.Stroke({
                  color: 'black',
                  width: 0.75
                }),
                fill: new ol.style.Fill({
                    color:'black'
                }),
                overflow: false
              })
          });
          selected.setStyle(style2);
    }

    get_all_region(str = "Barangay"){
        var all_region = this.map.getAllLayers();
        var temp = [];
        for(x in all_region){
            if(all_region[x].type){
                temp.push(all_region[x]);
            }
        }
        return temp;
    }

    inside_reset(){
        var all_layers = this.map.getAllLayers();
        all_layers['population'] = 0;
        all_layers['count'] = 0;
    }
    is_inside(layer,point,extra = {}){
        var polygonGeometry = layer.getSource().getFeatures()[0].getGeometry();
        var coords = [point['x'],point['y']];
        coords = [coords[0],coords[1]];
        coords = ol.proj.fromLonLat(coords);
        if(polygonGeometry.intersectsCoordinate(coords)){
            layer.population += 1;   
            layer.count += point['business'].length;
            layer.locations.push(point);
            
        };
        layer['extra'] = extra;
        
    }
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
