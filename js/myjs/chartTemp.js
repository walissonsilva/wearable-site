// Inicializando o chart
google.charts.load('current', {'packages':['line']});
google.charts.setOnLoadCallback(init);

function init() {
  let data = new google.visualization.DataTable();
  let primeira = true;

  this.freq = [
      ['1', 0],
      ['2', 0],
      ['3', 0],
      ['4', 0],
      ['5', 0],
      ['6', 0],
      ['7', 0],
      ['8', 0],
    ];

  var options = {
    chart: {
      title: '\n'//'Box Office Earnings in First Two Weeks of Opening',
      //subtitle: 'in millions of dollars (USD)'
    },
    width: 600,
    height: 312,
    colors: ['#DE0015', '#FFAE07'],
    lineWidth: 5
  };

  let chart = new google.charts.Line(document.getElementById('chart_freq'));

  setInterval(drawChart, 5000)

  function drawChart(){ 
    freq = updateData()

    //console.log(freq[0]);

    data = new google.visualization.DataTable();

    data.addColumn('string', 'Time');
    data.addColumn('number', 'Heart Rate');
    data.addRows(freq)

    console.log('Desenhando novamente...');
    if (!primeira){
      chart.draw(data, google.charts.Line.convertOptions(options));
    } else {
      primeira = false;
    }
  }

  function updateData() {
    $.ajax({
      url: "teste.php",
      type: 'GET',
      success : function(data) {
        chartData = data;
        var obj = JSON.parse(chartData)

        let id_table

        let i = 0
        for (let [key, value] of Object.entries(obj)){
          let dayTime = value.created_at
          let pos = dayTime.search('T')
          let day = dayTime.substring(0, pos)
          let time = dayTime.substring(pos + 1, dayTime.length - 1)
          freq[i] = Array(time, parseInt(value.freq))
          i++
        }
      }
    });

    return this.freq
  }

  drawChart()
}
