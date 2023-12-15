class data_chart{

    constructor(target,title,type,dataname,x = [],y = [],fcolor="white",color = "rgba(0,255,255,1.0)",color2 = "rgba(0,255,255,0.5)"){
        this.target = target;
        this.type = type;
        this.x = x;
        this.y = y;
        this.fcolor = fcolor;
        this.color = color;
        this.color2 = color2;
        this.title = title;
        this.chart = null;
        this.data_set = [];
        this.max = 0;
        this.min = 9999999;
        if(dataname != ""){
            this.add_data_set(dataname,y,color,color2);
        }
        
    }
    
    setMax(){
        for(var i = 0; i < this.data_set.length; i++){
            for(var j = 0; j < this.data_set[i].data.length;j++){
                if(this.max < this.data_set[i].data[j]){
                    this.max = this.data_set[i].data[j];
                }
            }
        }
    }

    setXval(x){
        this.x = x;
    }
    
    add_data_set(dataname,y,color = this.color,color2 = this.color2){
        this.data_set.push(
            {
                label:dataname,
                backgroundColor:color,
                borderColor:color2,
                data: y,
                fill: false,
                lineTension: 0
            }
        );
        this.setMax();
    }
    render(){
        var mx = parseInt(this.max) + 1;
        this.chart = new Chart(this.target,{
            type:this.type,
            data:{
                labels:this.x,
                datasets:this.data_set,
            },
            options: {
                legend: {
                    display: true,
                } ,
                title: {
                    fontColor:this.fcolor,
                    display: true,
                    fontSize:22,
                    text: this.title
                },
                scales: {
                    yAxes: [
                        {
                            ticks: {min: 0, max:mx},
                            color: "white",
                        }
                    ],
                  }
            },
        });
    }
}