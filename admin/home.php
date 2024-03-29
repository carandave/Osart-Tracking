<br>
<div class="row">
          
          <div class="col-12 col-sm-4 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-gradient-warning elevation-1"><i class="fas fa-list"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Health Facilities</span>
                <span class="info-box-number">
                  <?php 
                    $respondent_type = $conn->query("SELECT * FROM respondent_type_list where delete_flag = 0 and `status` = 1")->num_rows;
                    echo format_num($respondent_type);
                  ?>
                  <?php ?>
                </span>
              </div>
            </div>
          </div>
          
          <div class="col-12 col-sm-4 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-gradient-success elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Available Emergency Rooms</span>
                <span class="info-box-number">
                  <?php 
                    $team = $conn->query("SELECT * FROM team_list where delete_flag = 0 and `status` = 1 and id not in (SELECT team_id from report_teams where report_id in (SELECT id FROM report_list where `status` = 0) ) ")->num_rows;
                    echo format_num($team);
                  ?>
                  <?php ?>
                </span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-4 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-gradient-danger elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Unavailable Emergency Rooms</span>
                <span class="info-box-number">
                  <?php 
                    $team = $conn->query("SELECT * FROM team_list where delete_flag = 0 and `status` = 1 and id in (SELECT team_id from report_teams where report_id in (SELECT id FROM report_list where `status` = 0) ) ")->num_rows;
                    echo format_num($team);
                  ?>
                  <?php ?>
                </span>
              </div>
            </div>
          </div>
        </div>

