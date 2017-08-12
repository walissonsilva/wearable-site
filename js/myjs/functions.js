// Esta função recebe o nome do arquivo PHP que vai carregar os dados do JSON e do BD
function updateChart(arquivo) {
  if (arquivo == 'getFreq.php'){
    console.log(arquivo)
    tituloChart = 'Frequência Cardíaca (BPM)'
    idChart = 'chart_freq'
    idCard01 = "card_freq01"
    idCard02 = "card_freq02"
    idCard03 = "card_freq03"
    idCard04 = "card_freq04"
    legenda = 'Freq. Card.'
    idTable = "tab-freq"
  }


  // Inicializando o chart
  google.charts.load('current', {'packages':['line']});
  google.charts.setOnLoadCallback(init);

  function init() {
    let data = new google.visualization.DataTable();
    let primeira = true;
    let qtd = 0

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
      legend: { position: 'bottom' },
      lineWidth: 6,
      series: {
        0: {targetAxisIndex: 0},
      },
      vAxes: {
        // Adds titles to each axis.
        0: {title: tituloChart},
      },
    };

    let chart = new google.charts.Line(document.getElementById(idChart));

    setInterval(drawChart, 10000)

    function drawChart(){ 
      freq = updateData()

      //console.log(freq[0]);

      data = new google.visualization.DataTable();

      data.addColumn('string', 'Hora');
      data.addColumn('number', legenda);
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
        url: arquivo,
        type: 'GET',
        success : function(data) {
          chartData = data;
          var obj = JSON.parse(chartData)

          let id_table = document.getElementById(idTable)

          let i = it = 0
          let today = new Date()

          let maior_freq = soma_freq = qtd_soma = 0
          let maior_date, maior_time, ultimo_valor, ultima_data, ultimo_time

          for (let [key, value] of Object.entries(obj)){
            let dayTime = value.created_at
            let pos = dayTime.search('T')
            let data = dayTime.substring(0, pos)
            let time = dayTime.substring(pos + 1, dayTime.length - 1)

            let date = new Date(`${data} ${time}`)

            // Organizando a data
            pos = data.search("-")
            year = data.substring(0, pos)
            data = data.substring(pos + 1)
            month = pos = data.search("-")
            month = data.substring(0, pos)
            day = data.substring(pos + 1)

            // Se a data avaliada estiver compreendida entre os últimos sete dias (valor em ms)
            if (Math.abs(today - date) < 604800000){
              soma_freq += parseInt(value.freq)
              qtd_soma++
              if (value.freq > maior_freq){
                maior_freq = value.freq
                maior_date = `${day}/${month}/${year}`
                maior_time = time
              }
            }

            // Adicionando à tabela que fica abaixo do Chart
            if (it >= qtd) {
              let linha = `<tr><td>${day}/${month}/${year}</td><td>${time}</td><td>${value.freq}</td></tr>`
              id_table.insertAdjacentHTML('afterbegin', linha)
            }

            if (it >= obj.length - 8){
              freq[i] = Array(time, parseInt(value.freq))
              i++

              if (it == obj.length - 1){
                ultimo_valor = value.freq
                ultimo_time = time
                ultima_data = `${day}/${month}/${year}`
              }
            }

            it++
          }

          qtd = obj.length
          
          let id_card01 = document.getElementById(idCard01)
          let id_card02 = document.getElementById(idCard02)
          let id_card03 = document.getElementById(idCard03)
          let id_card04 = document.getElementById(idCard04)

          if (!isNaN(maior_freq) && maior_freq){
            id_card01.innerHTML = `<p style="font-size: 50px; text-align: center; display: block; border: solid 2px white; box-shadow: 0px 0px 20px white">${maior_freq} BPM</p><br><p>Maior valor lido nos últimos sete dias. Medição realizada em ${maior_date} às ${maior_time}.</p>`
          } else {
            id_card01.innerHTML = `<p style="font-size: 50px; text-align: center; display: block; border: solid 2px white; box-shadow: 0px 0px 20px white">0 BPM</p><br><p>Maior valor lido nos últimos sete dias. <b>Não foi possível exibir esse valor.</b></p>`
          }

          if (qtd_soma){
            let media = soma_freq / qtd_soma
            id_card03.innerHTML = `<p style="font-size: 50px; text-align: center;  display: block; border: solid 2px white; box-shadow: 0px 0px 20px white">${media} BPM</p><br><p>Média dos valores lidos nos últimos sete dias.</p>`
          } else {
            id_card03.innerHTML = `<p style="font-size: 50px; text-align: center; display: block; border: solid 2px white; box-shadow: 0px 0px 20px white">0 BPM</p><br><p><b>Não foi possível obter a média dos valores lidos nos últimos sete dias.</b></p>`
          }

          if (!isNaN(ultimo_valor)){
            id_card02.innerHTML = `<p style="font-size: 50px; text-align: center;  display: block; border: solid 2px white; box-shadow: 0px 0px 20px white">${ultimo_valor} BPM</p><br><p>Valor obtido na última medição. Medição realizada em ${ultima_data} às ${ultimo_time}.</p>`
          } else  {
            id_card02.innerHTML = `<p style="font-size: 50px; text-align: center; display: block; border: solid 2px white; box-shadow: 0px 0px 20px white">0 BPM</p><br><p><b>Não foi possível obter o valor da última medição realizada.</b></p>`
          }
        }
      });

      return this.freq
    }

    drawChart()
    setTimeout(drawChart, 3500)
  }
 
}

function updateIMC(p, a, nome){
  let peso = p
  let altura = a

  let pos = peso.search("P")
  while (pos != -1){
    pos = pos + 1
    peso = peso.substr(pos)
    pos = peso.search("P")
  }

  pos = altura.search("A")
  while (pos != -1){
    pos = pos + 1
    altura = altura.substr(pos)
    pos = altura.search("A")
  }

  peso = parseFloat(peso)
  console.log(peso)
  altura = parseFloat(altura) / 100
  console.log(altura)
  
  let IMC = ((peso / (altura * altura))).toFixed(2)

  let peso_minimo = (18.5 * altura * altura).toFixed(2)
  let peso_maximo = (25 * altura * altura).toFixed(2)

  let mensagem
  if (IMC >= 18.5 && IMC < 25){
    mensagem = `<br><b><p style="font-size: 20px;">Ótimo, ${nome}! Você está dentro do peso normal, de acordo com a classificação adotada pela Organização Mundial da Saúde (ver Tabela ao lado).</p><br><p>Dica: Para continuar nesta categoria mantenha o seu peso entre ${peso_minimo} kg e ${peso_maximo} kg.</p></b>`
  } else {
    mensagem = `<br><b><p style="font-size: 20px;">Ops! De acordo com a classificação adotada pela Organização Mundial da Saúde (ver Tabela ao lado), você não está dentre do seu peso normal, ${nome}.</b></p><br><p>Dica: faça o possível para que o seu peso esteja entre ${peso_minimo} kg e ${peso_maximo} kg.</p>`
  }

  let idCardIMC = document.getElementById("card_imc")
  idCardIMC.insertAdjacentHTML('afterbegin', mensagem)
  idCardIMC.insertAdjacentHTML('afterbegin', `<br><p>${nome}, seu Índice de Massa Corporal é:</p><br><p class="center-text" style="font-size: 50px; display: block; border: solid 2px white; box-shadow: 0px 0px 20px white; margin: 0 20% 0 20%;">${IMC} kg/m²</p>`)
}