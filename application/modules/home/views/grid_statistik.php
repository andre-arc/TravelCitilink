
<script type="text/javascript">
  $(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container', 
                type: 'line',  
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: 'Statistik Pengeluaran',
                x: -20 
            },
            subtitle: {
                text: 'Taman Midi Anggun Langsa',
                x: -20
            },
            xAxis: { 
                categories: [
                    <?php 
                        foreach ($grafik[0]['bulan'] as $key) {
                            echo "'$key', ";
                        }
                    ?>
                ]
            },
            yAxis: {
                title: {  
                    text: 'Total Pengeluaran'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080' 
                }]
            },
            tooltip: { 
    
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y ;
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
   
    
            series: [
                <?php foreach ($grafik as $graph): ?>
                {
                    name: '<?= $graph["name"] ?>',  
            
                    data: [
                        <?php foreach ($graph["total"] as $total):
                            $total = $total == 0 ? 'null' : $total;
                            echo "$total, ";
                        endforeach ?>
                    ]
            },
                <?php endforeach ?>
          
            
            ]
        });
    });
    
});  
</script>
  </head>
  <body>
    <div id='container'></div>    
  </body>
</html>