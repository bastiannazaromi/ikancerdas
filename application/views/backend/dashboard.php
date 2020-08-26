<div class="content-wrapper">
  <!-- Page Title Header Starts-->
  <div class="row page-title-header">
    <div class="col-12">
      <div class="page-header">
        <h4 class="page-title"><?= $title ;?></h4>
      </div>
    </div>    
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-6 grid-margin stretch-card bg-info">
          <div class="card"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
            <div class="card-body pb-0">
              <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title mb-0">Volume Pakan</h4>
                  <div class="bg-light">
                    <i class="fas fa-store fa-2x"></i>
                  </div>
              </div>
              <h3 class="font-weight-medium mb-4" id="pakan"></h3>
            </div>
          </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card bg-danger">
          <div class="card"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
            <div class="card-body pb-0">
              <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title mb-0">Tingkat Kekeruhan Air</h4>
                <div class="bg-light">
                    <i class="fas fa-water fa-2x"></i>
                  </div>
              </div>
              <h3 class="font-weight-medium mb-4" id="kekeruhan"></h3>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    
  </div>

  <div class="row">
    <div class="grafik col-md-12">
        <div class="card">
            <div class="card-header">
            
            </div>
            <div id="grafik" style="width:100%; height:480px;"></div>
        </div>
    </div>
</div>

</div>

<script>
    var chart;
    var total=0;
    function tampil(){
            $.ajax({
                url: "<?php echo base_url('Dashboard/get_realtime') ; ?>",
                dataType:'json',
                success:function(result){
                    if (result.length>total){
                        total=result.length;
                        var i;
                        var pakan = [];
                        var kekeruhan = [];
                        var waktu = [];

                        for(i=0; i<result.length; i++){
                            pakan[i] = Number(result[i].pakan);
                            kekeruhan[i] = Number(result[i].kekeruhan);
                            waktu[i] = result[i].waktu;
                            chart.series[0].setData(pakan);
                            chart.series[1].setData(kekeruhan);
                            chart.xAxis[0].setCategories(waktu);
                        }
                        
                    }
                    else if (result.length<=total)
                    {
                        var i;
                        var pakan = [];
                        var kekeruhan = [];
                        var waktu = [];

                        for(i=0; i<result.length; i++){
                            pakan[i] = Number(result[i].pakan);
                            kekeruhan[i] = Number(result[i].kekeruhan);
                            waktu[i] = result[i].waktu;
                            chart.series[0].setData(pakan);
                            chart.series[1].setData(kekeruhan);
                            chart.xAxis[0].setCategories(waktu);
                        }
                        
                    }

                    setTimeout(tampil, 2000); 
                }
            });
    }
    
    document.addEventListener('DOMContentLoaded',function(){
        
        chart=Highcharts.chart('grafik',{
            chart:{
            type: 'line',
            events:{
                    load:tampil
                }
            },
            title:{
                text:'Data Rekap Pakan Ikan dan Kekeruhan Air'
            },

            yAxis: {
                title: {
                    text: 'Nilai'
                }
            },

            xAxis: {
                
            },
            
            series:[{
                name:"Volume Pakan"
            },
            {
                name:"Kekeruhan"
            }]
        });
    });    

    function dashboard(){
    $.ajax({
        url: "<?= base_url('Dashboard/get_realtime')?>",
        dataType: 'json',
        success:function(result){
          
          $('#pakan').text(result[0]["pakan"] + " %");

          $('#kekeruhan').text(result[0]["kekeruhan"] + " NTU");
          
          setTimeout(dashboard, 2000); 
        }
    });
  }
  
  document.addEventListener('DOMContentLoaded',function(){
    dashboard();
  }); 

</script>