<script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.js" type="text/javascript"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
        <small>Control panel</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
            <p>USER INFO</p>
            <?php 
              echo $name."<br>".$role."<br>".$role_text."<br>".$email."<br>".$userId;
            ?>
            <br><br><br>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $managerCount ?></h3>
                  <p>Manager Accounts</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-stalker"></i>
                </div>
                <a href="<?php echo base_url(); ?>userListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-darkred">
                <div class="inner">
                  <h3><?php echo $employeeCount ?></h3>
                  <p>Subordinate employee</p><!-- Employee Accounts -->
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                <a href="<?php echo base_url(); ?>userListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $myActiveTasks ?></h3>
                  <p>My Active Tasks</p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-clipboard"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
             <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $completedTasks ?>/<?php echo $allTasks ?></h3>
                  <p>Copleted Tasks of my group</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="<?php echo base_url(); ?>taskManagment" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>150</h3>
                  <p>Overview of vehicles</p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-car"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-darkgreen">
                <div class="inner">
                  <h3>150 000 EUR</h3>
                  <p>Total Profit <i>2017</i></p>
                </div>
                <div class="icon">
                  <i class="ion ion-connection-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            
        </div>

        <?php
          if($role == ROLE_ADMIN || $role == ROLE_MANAGER) {
        ?>
        <div class="container-fluid" style="margin-top: 60px;">
          <div class="row">
            
            <div class="col-md-6">
              <h3>The chart shows car repairs for each individual a car brand</h3>
              <canvas id="barChart"></canvas>

              <script>
                var ctx = $("#barChart");
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ["Fabia", "Octavia", "Mercedes", "Audi", "BMW", "Felicia", "Seat", "Suzuky"],
                        datasets: [{
                            label: '# Repair',
                            data: [12, 19, 3, 5, 20, 3, 8, 15],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
              </script>
            </div>

            <div class="col-md-6">
              <h3>Profit</h3>
              <canvas id="profit"></canvas>

              <script>
                var ctx = $("#profit");
                
                  var data = {
                    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    datasets: [
                        {
                            label: "One Year Profit",
                            fill: false,
                            lineTension: 0.1,
                            backgroundColor: "rgba(75,192,192,0.4)",
                            borderColor: "rgba(75,192,192,1)",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            pointBorderColor: "rgba(75,192,192,1)",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(75,192,192,1)",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            pointHoverBorderWidth: 2,
                            pointRadius: 1,
                            pointHitRadius: 10,
                            data: [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56, 55, 40],
                            spanGaps: false,
                        }
                    ]
                };

              var myLineChart = new Chart(ctx, {
                type: 'line',
                data: data
                // options: options
              });
              </script>
            </div>
          </div>
        </div>

        <div class="container-fluid" style="margin-top: 60px;">
          <div class="row">
              <div class="col-md-2">
                <h3>Employee vs Manager</h3>
                <canvas id="pie"></canvas>

                <script>
                  var ctx = $("#pie");
                  var data = {
                    labels: [
                        "Employee",
                        "Manager"
                    ],
                    datasets: [{
                            data: [<?php echo $employeeCount ?>, <?php echo $managerCount ?>],
                            backgroundColor: [
                                "#a94442",
                                "#f39c12"
                            ],
                            hoverBackgroundColor: [
                                "#a94442",
                                "#f39c12"
                            ]
                        }]
                  };

                  var myPieChart = new Chart(ctx,{
                      type: 'pie',
                      data: data
                      //options: options
                  });
                  </script>
              </div>
          </div>
        </div>
        <?php
          }
        ?>
    </section>
</div>