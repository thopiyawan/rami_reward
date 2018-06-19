<!DOCTYPE html>
<html>
<head>
  <title>กราฟน้ำหนัก</title>
  <title>กราฟน้ำหนัก</title>
</head>
<meta charset="utf-8">

<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<style>
#chartdiv {
  width   : 100%;
  height    : 500px;
  font-size : 11px;
}                            
</style>
<style>
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}
</style>
<script type="text/javascript">
    
var chartData = generateChartData();

var chart = AmCharts.makeChart("chartdiv", {
    "type": "serial",
    "theme": "light",
    "marginRight": 80,
    "dataProvider": chartData,
    "balloon": {
        "cornerRadius": 6,
        "horizontalPadding": 15,
        "verticalPadding": 10
    },
    "valueAxes": [{
        "position": "left",
        "title": "weight"
    }],
    "graphs": [{
        "bullet": "square",
        "bulletBorderAlpha": 1,
        "bulletBorderThickness": 1,
        "fillAlphas": 0.3,
        "fillColorsField": "lineColor",
        "legendValueText": "[[value]]",
        "lineColorField": "lineColor",
        "title": "duration",
        "valueField": "duration"
    }],
    "chartScrollbar": {

    },
    "chartCursor": {
        "categoryBalloonDateFormat": "week",
        "cursorAlpha": 0,
        "fullWidth": true
    },
    
    "categoryField": "date",
    
    "categoryAxis": {
        "axisColor": "#555555",
        "gridAlpha": 0,
        "gridCount": 50
    },
    "export": {
        "enabled": true
    }
});



chart.addListener("dataUpdated", zoomChart);

function zoomChart() {
    // chart.zoomToDates(new Date(2012, 0, 3), new Date(2012, 0, 11));
}

// generate some random data, quite different range
function generateChartData() {
   var chartData =[];
          
             @foreach ($record1 as $records1)
              {{ $records1->user_Pre_weight}}
             @endforeach 
             
             @foreach ($record as $records)
               {{ $records->preg_week}}
               $weightweek= {{ $records->preg_weight}}-{{ $records1->user_Pre_weight}}
              
               chartData.push({
                "date":        {{ $records->preg_week}},
                "duration":    $weightweek
               });
             @endforeach 
         
    return chartData;
}
</script>

<body>
           <div class="content">
                <div class="title m-b-md">
                   <div id="chartdiv"></div>
                </div>

           
            </div>
<br>
<br>
<br>
<br>
   <u><h1>น้ำหนักระหว่างการตั้งครรภ์</h1></u>
   <h2>ก่อนตั้งครรภ์น้ำหนัก : {{ $records1->user_Pre_weight}}</h2>
 <div>
  <table id="customers">
    <thead>
        <tr>
            <th>สัปดาห์</th>
            <th>น้ำหนัก</th>
        </tr>
    </thead>
    <tbody>
          @foreach ($record as $records)
          <tr>
              <td>{{ $records->preg_week}}</td>
              <td>{{ $records->preg_weight}}</td>
          </tr>
         @endforeach
   </tbody>
</table></div>
</body>
</html>




