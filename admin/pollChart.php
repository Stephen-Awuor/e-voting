<?php include_once("template/header.php");?>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script> 
  
<script type="text/javascript">
  var pollChart;
  var pos;
  var posName;
  var colors = [];

  $(document).ready(function(){
    $('#select-pos').find('option').last().prop('selected', true)
    pos = $('#select-pos').val()   
      getSelectedPosition() 


    $('#select-pos').change(function(){
      pos = $(this).val()
      getSelectedPosition()
    });    
  });



function getSelectedPosition(){
  posName = $('#select-pos option:selected').text()
  $.ajax({
      type: "post",
      url: "data/results.json.php",
      data: {posId: pos},
      success: function(data){
        candidatesJson = data;
        drawChart(pos)                       
      }
    });
}

function drawChart(pos){  
  colors = Highcharts.getOptions().colors;        
  var categories = $.map(candidatesJson, function(o) { return o["name"]; }); 
  var data = [];  
  for(var i = 0, teamJsonLength = candidatesJson.length ; i < teamJsonLength ; i++ ){
    var team = candidatesJson[i];
    data.push({y: parseInt(team.voteCount) , color: colors[ i % colors.length] });
  }
  
  pollChart = new Highcharts.Chart({     
    chart: {
      renderTo: 'chartContainer',
      type: 'column' // change this to column if want to show the column chart
    },
    title: {
      text: posName,
      style:{
        color: '#3E576F',
        fontSize: '23px',
        fontFamily: 'Helvetica Neue,Helvetica,Arial,sans-serif'
      }
    },            
    subtitle: {
      text: 'Results for '+posName+' Position'
    },            
    xAxis: {
      categories: categories,
      labels: {
        style: {
          fontSize: '16px',
          fontFamily: 'Helvetica Neue,Helvetica,Arial,sans-serif',
          color: 'black'
        }
      }
    },
    yAxis: {
      title: {
        text: 'Votes',
        style: {
          fontSize: '14px',
          fontFamily: 'Helvetica Neue,Helvetica,Arial,sans-serif',
          color: 'black',
          fontWeight: 'normal'
        }
      }
    },
    legend: {
      enabled: false
    },
    tooltip:{
      enabled: false
    },
    series: [{
      name: 'Vote Count',
      data: data,
      dataLabels: {
      enabled: true,  
      }      
    }],
    exporting: {
      enabled: false
    }            
  });
}

var ti = setInterval(function() { getData(pos); }, 5000);

function getData(pos){
  console.log("retrieving data from server ");
  $.ajax({
    type: "post",
    url: "data/checkVotes.php",
    data:{posId: pos},
    success: function(votes){
      for (var i = 0; i < votes.length; i++) {
        votes[i] = parseInt(votes[i]);
      }                
      pollChart.series[0].setData(votes);
      $.each(pollChart.series[0].data, function(i, point) {
        point.graphic.attr({
            fill: colors[ i % colors.length]
        });
    });
    pollChart.series[0].redraw();
      //pollChart.series[0].data
    }
  });             
}
</script>
<script src="../js/highcharts.js"></script>
<script src="../js/data.js"></script>
<script src="../js/exporting.js"></script>
<div class='column' style="display:inline-block;">
  <h5>Select Position</h5>
  <hr>
  <select name="position" id="select-pos" size="10">
  <?php 
    $select_query = "SELECT positionid, position FROM position";
    $result = mysql_query($select_query)or die ("Could not Query <BR>".mysql_error()); 
    while($row = mysql_fetch_array($result)){
      extract($row);
      echo "<option value='$positionid'>$position</option>"; //Place the positions in combo box
    }
      ?>
  </select>
</div>
<div class='column' id="chartContainer" style="min-width: 500px; height: 500px; margin: 0 auto; float:right; ">Loading...</div>
<div style='clear:both;'></div>
<?php include_once("template/header.php");?>   
