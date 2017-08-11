// Endereços dos json's que contém os dados (no ThingSpeak)
const ipFreq = 'https://api.thingspeak.com/channels/306028/fields/1.json?api_key=DTWASHAB2FDWY6HC&results=8'
const ipTemp = 'https://api.thingspeak.com/channels/306028/fields/2.json?api_key=DTWASHAB2FDWY6HC&results=8'

// Inicializando o chart
google.charts.load('current', {'packages':['line']});
google.charts.setOnLoadCallback(init);

function init() {
  let data = new google.visualization.DataTable();

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

  let chart = new google.charts.Line(document.getElementById('curve_chart'));

  setInterval(drawChart, 5000)

  function drawChart(){ 
    freq = updateData()

    //console.log(freq[0]);

    data = new google.visualization.DataTable();

    data.addColumn('string', 'Time');
    data.addColumn('number', 'Heart Rate');
    data.addRows(freq)

    console.log('Desenhando novamente...');
    chart.draw(data, google.charts.Line.convertOptions(options));
  }

  function updateData() {
    /*fetch(ipFreq)
      .then(res => res.json())
      .then(info => {
        //console.log(info.feeds);
        let i = 0
        for (let [key, value] of Object.entries(info.feeds)){
          let dayTime = value.created_at
          let pos = dayTime.search('T')
          let day = dayTime.substring(0, pos)
          let time = dayTime.substring(pos + 1, dayTime.length - 1)
          this.freq[i] = Array(time, parseInt(value.field1))
          //console.log(this.freq[i]);
          i++
          //console.log(`${value.created_at}: ${value.field1}`)
        }

      })*/

    $.ajax({
      url: "teste.php",
      type: 'GET',
      success : function(data) {
        chartData = data;
        var obj = JSON.parse(chartData)

        let i = 0
        for (let [key, value] of Object.entries(obj)){
          console.log(value.field1)
          let dayTime = value.created_at
          let pos = dayTime.search('T')
          let day = dayTime.substring(0, pos)
          let time = dayTime.substring(pos + 1, dayTime.length - 1)
          freq[i] = Array(time, parseInt(value.freq))
          console.log(freq[i]);
          i++
          //console.log(`${value.created_at}: ${value.field1}`)
        }
      }
    });

    return this.freq
  }

  drawChart()
}
