</style>
      <aside class="main-sidebar sidebar-dark-danger elevation-4 sidebar-no-expand">
        <a href="<?php echo base_url ?>admin" class="brand-link bg-gradient-primary text-sm">
        <img src="<?php echo validate_image($_settings->info('logo'))?>" alt="Store Logo" class="brand-image img-circle elevation-3" style="opacity: .8;width: 1.5rem;height: 1.5rem;max-height: unset">
        <span class="brand-text font-weight-light"><?php echo $_settings->info('short_name') ?></span>
        </a>

        <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
          <div class="os-resize-observer-host observed">
            <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
          </div>
          <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
            <div class="os-resize-observer"></div>
          </div>
          <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 646px;"></div>
          <div class="os-padding">
            <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
              <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
                <div class="clearfix"></div>
                <nav class="mt-4">
                   <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item dropdown">
                      
                    </li> 
                    <li class="nav-header">Main</li>
                    <?php if($_settings->userdata('type') == 2): ?>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=incident_reports" class="nav-link nav-incident_reports">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                          Patient Care Report
                        </p>
                      </a>
                    </li>
                    <?php endif; ?>

                    <?php if($_settings->userdata('type') == 1): ?>

                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=incident_reports_admin" class="nav-link nav-incident_reports">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                          Patient Care Report
                        </p>
                      </a>
                    </li>

                    <!-- <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=teams" class="nav-link nav-teams">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                          List of Stations
                        </p>
                      </a>
                    </li> -->

                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=request" class="nav-link nav-request">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                          Request BackUp
                        </p>
                      </a>
                    </li> 

                    <li class="nav-header">Management</li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=incidents" class="nav-link nav-incidents">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>
                          Incident Types
                        </p>
                      </a>
                    </li>

                    <!-- <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=respondent_types" class="nav-link nav-respondent_types">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                          Manage Stations
                        </p>
                      </a>
                    </li> -->

                    <!-- <li class="nav-header">Report</li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=reports/daily_report" class="nav-link nav-reports_daily_report">
                        <i class="nav-icon fas fa-calendar-day"></i>
                        <p>
                          Daily Report
                        </p>
                      </a>
                    </li> -->

                    <!-- <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=reports/daily_type_report" class="nav-link nav-reports_daily_type_report">
                        <i class="nav-icon fas fa-calendar-day"></i>
                        <p>
                          Daily Report by Incident Type
                        </p>
                      </a>
                    </li> -->
                    
                    <li class="nav-header">Maintenance</li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=user/list" class="nav-link nav-user_list">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                          Responder List
                        </p>
                      </a>
                    </li>

                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=user/track" class="nav-link nav-track">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                          Track Responder
                        </p>
                      </a>
                    </li>

                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=system_info" class="nav-link nav-system_info">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                          Settings
                        </p>
                      </a>
                    </li>
                    <?php endif; ?>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
          <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
              <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
            </div>
          </div>
          <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
              <div class="os-scrollbar-handle" style="height: 55.017%; transform: translate(0px, 0px);"></div>
            </div>
          </div>
          <div class="os-scrollbar-corner"></div>
        </div>
      </aside>
      <script>
    $(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
      var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
      page = page.replace(/\//g,'_');
      console.log(page)

      if($('.nav-link.nav-'+page).length > 0){
             $('.nav-link.nav-'+page).addClass('active')
        if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
            $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
          $('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
        }
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

      }
      $('.nav-link.active').addClass('bg-gradient-danger')
    })
  </script>