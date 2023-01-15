<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$year = date('Y');
$past = $year - '1';
?>            </main>
<!-- <?php var_dump($ynow15)?> -->
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div></div>
                            <div class="text-muted">
                                Copyright &copy; Cabatuan | QRDTMS <?php  echo $curr_year = date('Y'); ?>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <!-- <script src="/assets/demo/chart-area-demo.js"></script> -->
        <!-- <script src="/assets/demo/chart-bar-demo.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="/assets/js/datatables-simple-demo.js"></script>

        <!-- daily Reports -->
        <script>
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            // Area Chart Example
            var ctx = document.getElementById("t");
            var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [
<?php           foreach($yychart as $data){
?>                  "<?=$data['year_chart']?>",    
<?php           }
?>                ],
                datasets: [{
                label: "Sessions",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: [
<?php           foreach($yychart as $data){
?>                  "<?=$data['total_price']?>",    
<?php           }
?>                ],
                }],
            },
            options: {
                scales: {
                xAxes: [{
                    time: {
                    unit: 'date'
                    },
                    gridLines: {
                    display: false
                    },
                    ticks: {
                    maxTicksLimit: 10 //count
                    }
                }],
                yAxes: [{
                    ticks: {
                    min: 0,
                    max: 1000000, //max value
                    maxTicksLimit: 7 //count
                    },
                    gridLines: {
                    color: "rgba(0, 0, 0, .125)",
                    }
                }],
                },
                legend: {
                display: false
                }
            }
            });
        </script>

        <!-- weekly Reports -->
        <script>
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            // Area Chart Example
            var ctx = document.getElementById("weekly");
            var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [
<?php               foreach($wchart as $data){
?>                      "<?= date('M-d', strtotime($data['created_at'])) ?>",
<?php               }
?>                ],
                datasets: [{
                label: "Sessions",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: [
<?php               foreach($wchart as $data){
?>                      "<?= $data['total_price']?>",
<?php               }
?>                ],
                }],
            },
            options: {
                scales: {
                xAxes: [{
                    time: {
                    unit: 'date'
                    },
                    gridLines: {
                    display: false
                    },
                    ticks: {
                    maxTicksLimit: 7 //count
                    }
                }],
                yAxes: [{
                    ticks: {
                    min: 0,
                    max: <?=$wmax[0]['total_price']?>, //max value
                    maxTicksLimit: 7 //count
                    },
                    gridLines: {
                    color: "rgba(0, 0, 0, .125)",
                    }
                }],
                },
                legend: {
                display: false
                }
            }
            });
        </script>

        
        <!-- monthly Reports -->
        <script>
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            // Area Chart Example
            var ctx = document.getElementById("monthly");
            var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [ 
<?php               foreach($mchart as $data){
?>                      "<?= date('d', strtotime($data['created_at'])) ?>",
<?php               }
?>                ],
                datasets: [{
                label: "Sessions",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: [
<?php               foreach($mchart as $data){
?>                      "<?= $data['total_price']?>",
<?php               }
?>                ],
                }],
            },
            options: {
                scales: {
                xAxes: [{
                    time: {
                    unit: 'date'
                    },
                    gridLines: {
                    display: false
                    },
                    ticks: {
                    maxTicksLimit: 31 //count
                    }
                }],
                yAxes: [{
                    ticks: {
                    min: 0,
                    max: <?=$mmax[0]['total_price']?>, //max value
                    maxTicksLimit: 10 //count
                    },
                    gridLines: {
                    color: "rgba(0, 0, 0, .125)",
                    }
                }],
                },
                legend: {
                display: false
                }
            }
            });
        </script>

        
        
        <!-- monthly Reports -->
        <script>
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            // Area Chart Example
            var ctx = document.getElementById("bar3");
            var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["<?=$past?>", "<?=$year?>"],
                datasets: [
             {
                label:"Municipal Mayor",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: ["<?=(Empty($pynow) ? '0' : $pynow[0]['total_price'])?>", "<?=(Empty($ynow) ? '0' : $ynow[0]['total_price'])?>" ]},
                {
                label:"Municipal Vice Mayor",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,316,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: ["<?=(empty($pynow2) ? '0' : $pynow2[0]['total_price'])?>", "<?=(empty($ynow2) ? '0' : $ynow2[0]['total_price'])?>" ]},
                {
                label:"Sanguniang Bayan",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,416,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: ["<?=(empty($pynow3) ? '0' : $pynow3[0]['total_price'])?>", "<?=(empty($ynow3) ? '0' : $ynow3[0]['total_price'])?>" ]},
                {
                label:"Treasury",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,516,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: ["<?=(empty($pynow4) ? '0' : $pynow[0]['total_price'])?>", "<?=(empty($ynow15) ? '0' : $ynow[0]['total_price'])?>" ]},
                {
                label:"Accounting",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,616,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: ["<?=(empty($pynow5) ? '0' : $pynow[0]['total_price'])?>", "<?=(empty($ynow15) ? '0' : $ynow[0]['total_price'])?>" ]},
                {
                label:"Budget Officer",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,716,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: ["<?=(empty($pynow6) ? '0' : $pynow[0]['total_price'])?>", "<?=(empty($ynow15) ? '0' : $ynow[0]['total_price'])?>" ]},
                {
                label:"Planning",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,816,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: ["<?=(empty($pynow7) ? '0' : $pynow[0]['total_price'])?>", "<?=(empty($ynow15) ? '0' : $ynow[0]['total_price'])?>" ]},
                {
                label:"Engr",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,916,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: ["<?=(empty($pynow8) ? '0' : $pynow[0]['total_price'])?>", "<?=(empty($ynow15) ? '0' : $ynow[0]['total_price'])?>" ]},
                {
                label:"Assesor",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,226,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: ["<?=(empty($pynow9) ? '0' : $pynow[0]['total_price'])?>", "<?=(empty($ynow15) ? '0' : $ynow[0]['total_price'])?>" ]},
                {
                label:"Registrar",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,236,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: ["<?=(empty($pynow10) ? '0' : $pynow[0]['total_price'])?>", "<?=(empty($ynow15) ? '0' : $ynow[0]['total_price'])?>" ]},
                {
                label:"DRRMO",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,246,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: ["<?=(empty($pynow11) ? '0' : $pynow[0]['total_price'])?>", "<?=(empty($ynow15) ? '0' : $ynow[0]['total_price'])?>" ]},
                {
                label:"Agri",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,256,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: ["<?=(empty($pynow12) ? '0' : $pynow[0]['total_price'])?>", "<?=(empty($ynow15) ? '0' : $ynow[0]['total_price'])?>" ]},
                {
                label:"SWD",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,266,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: ["<?=(empty($pynow12) ? '0' : $pynow[0]['total_price'])?>", "<?=(empty($ynow15) ? '0' : $ynow[0]['total_price'])?>" ]},
                {
                label:"MHO",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,276,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: ["<?=(empty($pynow14) ? '0' : $pynow[0]['total_price'])?>", "<?=(empty($ynow15) ? '0' : $ynow[0]['total_price'])?>" ]},
                {
                label:"Waterworks",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,286,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: ["<?=(empty($pynow15) ? '0' : $pynow[0]['total_price'])?>", "<?=(empty($ynow15) ? '0' : $ynow[0]['total_price'])?>" ]},
               
            ],
            },
            options: {
                scales: {
                xAxes: [{
                    time: {
                    unit: 'date'
                    },
                    gridLines: {
                    display: false
                    },
                    ticks: {
                    maxTicksLimit: 31 //count
                    }
                }],
                yAxes: [{
                    ticks: {
                    min: 0,
                    max: 700000, //max value
                    maxTicksLimit: 10 //count
                    },
                    gridLines: {
                    color: "rgba(0, 0, 0, .125)",
                    }
                }],
                },
                legend: {
                display: false
                }
            }
            });
        </script>
    </body>
</html>
