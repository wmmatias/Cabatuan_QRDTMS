<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>            </main>
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
            var ctx = document.getElementById("daily");
            var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [ "<?=date('M-d', strtotime($ychart['created_at']))?>","<?=date('M-d', strtotime($dchart['created_at']))?>"],
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
                    maxTicksLimit: 2 //count
                    }
                }],
                yAxes: [{
                    ticks: {
                    min: 0,
                    max: <?=$wmax['total_price']?>, //max value
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
                    max: <?=$wmax['total_price']?>, //max value
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
                    max: <?=$mmax['total_price']?>, //max value
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
