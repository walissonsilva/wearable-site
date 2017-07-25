// Endereços dos json's que contém os dados (no ThingSpeak)
const ipFreq = 'https://api.thingspeak.com/channels/306028/fields/1.json?api_key=DTWASHAB2FDWY6HC&results=15'
const ipTemp = 'https://api.thingspeak.com/channels/306028/fields/2.json?api_key=DTWASHAB2FDWY6HC&results=15'

// Inicializando o chart
google.charts.load('current', {'packages':['line']});
google.charts.setOnLoadCallback(init);

function init() {
  let data = new google.visualization.DataTable();

  // data.addColumn('string', 'Time');
  // data.addColumn('number', 'Heart Rate');
  // //data.addColumn('number', 'Body Temperature');
  //
  // //let dados = obterDados()
  //
  // data.addRows([
  //   ['1',  37.8],
  //   ['2',  30.9],
  //   ['3',  25.4],
  //   ['4',  11.7],
  //   ['5',  11.9],
  //   ['6',   8.8],
  //   ['7',   7.6],
  //   ['8',  12.3],
  //   ['9',  16.9],
  //   ['10', 12.8]
  // ]);

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
    width: 700,
    height: 312,
    colors: ['#DE0015', '#FFAE07'],
    lineWidth: 5
  };

  let chart = new google.charts.Line(document.getElementById('curve_chart'));

  setInterval(drawChart, 5000)
  drawChart()

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
    fetch(ipFreq)
      .then(res => res.json())
      .then(info => {
        //console.log(info.feeds);
        let i = 0
        for (let [key, value] of Object.entries(info.feeds)){
          let dayTime = value.created_at
          let pos = dayTime.search('T')
          let day = dayTime.substring(0, pos)
          let time = dayTime.substring(pos + 1, dayTime.length - 1)
          this.freq[i] = Array(i.toString(), parseInt(value.field1))
          //console.log(this.freq[i]);
          i++
          //console.log(`${value.created_at}: ${value.field1}`)
        }

      })

    return this.freq
  }
}
