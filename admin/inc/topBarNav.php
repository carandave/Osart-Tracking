<?php 

$Ids = $_settings->userdata('id');

?>

<style>
  .user-img{
        position: absolute;
        height: 27px;
        width: 27px;
        object-fit: cover;
        left: -7%;
        top: -12%;
  }
  .btn-rounded{
        border-radius: 50px;
  }
</style>
      <nav class="main-header navbar navbar-expand navbar-light shadow text-sm">
        <ul class="navbar-nav">
          <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo base_url ?>" class="nav-link"><?php echo (!isMobileDevice()) ? $_settings->info('name'):$_settings->info('short_name'); ?> - Admin</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <div class="btn-group nav-link">
                  <button type="button" class="btn btn-rounded badge badge-light dropdown-toggle dropdown-icon" data-toggle="dropdown">
                    
                    <!-- <span><img src="<?php echo validate_image($_settings->userdata('avatar')) ?>" class="img-circle elevation-2 user-img" alt="User Image"></span> -->
                    <?php 
                    
                    $sqlp = "SELECT * FROM users WHERE id='$Ids'";
                    $result= $conn->query($sqlp);
                    
                    ?>

                    <?php if($result->num_rows > 0){?>
                      <?php while($rowsp = $result->fetch_assoc()){?>

                        <span><img src="<?php echo $rowsp['image_dir']?>" alt="" class="img-circle elevation-2 user-img"></span>

                      <?php } ?>
                    <?php } ?>

                    <span class="ml-3"><?php echo ucwords($_settings->userdata('firstname').' '.$_settings->userdata('lastname')) ?></span>
                    <span class="sr-only">Toggle Dropdown </span>
                  </button>
                  <div class="dropdown-menu" role="menu">
                    <a class="dropdown-item" href="<?php echo base_url.'admin/?page=user' ?>"><span class="fa fa-user"></span> My Account </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo base_url.'/classes/Login.php?f=logout' ?>"><span class="fas fa-sign-out-alt"></span> Logout</a>
                  </div>
              </div>
          </li>
          <li class="nav-item">
         
          </li>
        </ul>
      </nav>