<?php include 'layout/css.php'; ?>

  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">

          <a class="nav-link" data-toggle="dropdown" href="#">info@nm-aist.ac.tz<i class="fas fa-angle-down down"></i></a>

          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

            <div class="dropdown-divider"></div>
            <a data-toggle="modal" href="#staffProfile" class="dropdown-item">Profile</a>

            <div class="dropdown-divider"></div>
            <a data-toggle="modal" href="#settings" data-backdrop="static" data-keyboard="false" class="dropdown-item">Change Password</a>

            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo base_url();?>auth/logout"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            Logout
          </a>
          <form id="logout-form" action="/logout" method="GET" style="display: none;">
            @csrf
          </form>

        </li>

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->

    <aside class="main-sidebar sidebar-dark-secondary elevation-5">
      <!-- Brand Logo -->

      <div class="brand-link" style="background-color:#F4F6F9;">
        <img src="<?php echo base_url();?>AdminLTE/images/logo.png" alt="NM-AIST" style="opacity: 100; border-radius: 8px; width: 70%; height:70%; padding-left:45px;">
        <span class="brand-text font-weight-light"><div style="padding-left:55px; color: #800000; font-size: 14pt; font-weight: bold;">NM-AIST LMSDS</div></span>
      </div>

      <!-- Sidebar -->
      <div class="sidebar">

<!--        side bar menu-->

          <br><br><br><br>
          <!--Sidebar Menu -->
          <nav class="mt-3">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <li class="nav-item">
                      <a href="<?php echo base_url();?>admin/dashboard" class="nav-link">
                          <i class="nav-icon  fas fa-tachometer-alt"></i>
                          <p>Home</p>
                      </a>
                  </li>

				  <li class="nav-item has-treeview">
					  <a href="#" class="nav-link">
						  <i class="nav-icon fas fa-cogs"></i>
						  <p>
							  Settings
							  <i class="fas fa-angle-left right"></i>
						  </p>
					  </a>
					  <ul class="nav nav-treeview">

						  <li class="nav-item">
							  <a href="<?php echo base_url();?>systems" class="nav-link">
								  <i class="far fa-circle nav-icon"></i>
								  <p>System</p>
							  </a>
						  </li>

						  <li class="nav-item">
							  <a href="/users" class="nav-link">
								  <i class="far fa-circle nav-icon"></i>
								  <p>Manage Users</p>
							  </a>
						  </li>
						  <li class="nav-item">
							  <a href="/activateRegistration" class="nav-link">
								  <i class="far fa-circle nav-icon"></i>
								  <p>Activate Registration</p>
							  </a>
						  </li>
					  </ul>
				  </li>
                  <li class="nav-item">
                      <a href="<?php echo base_url();?>laboratories" class="nav-link">
                          <i class="nav-icon  fa fa-university"></i>
                          <p>Laboratory Unit</p>
                      </a>
                  </li>
                   <li class="nav-item">
                      <a href="<?php echo base_url();?>samples" class="nav-link">
                          <i class="nav-icon  far fa-building"></i>
                          <p>Samples</p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="<?php echo base_url();?>track_sample" class="nav-link">
                          <i class="nav-icon fas fa-calendar"></i>
                          <p>Track Sample</p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="<?php echo base_url();?>control_number" class="nav-link">
                          <i class="nav-icon fas fa-bacon nav-icon"></i>
                          <p>Control Number</p>
                      </a>
                  </li>
                          <li class="nav-item">
                              <a href="/reports" class="nav-link">
                                  <i class="nav-icon fas fa-chart-pie"></i>
                                  <p>Reports</p>
                              </a>
                          </li>
                          <li class="nav-item has-treeview">
                              <a href="#" class="nav-link">
                                  <i class="nav-icon far fa-eye"></i>
                                  <p>
                                      Audit Trail
                                      <i class="fas fa-angle-left right"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="/systemAccess" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>System Access</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>

                      </ul>
          </nav>
          <!-- /.sidebar-menu
          </div>
          <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">

          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="classes" class="nav-link" style="color:black">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fas fa-newspaper"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Courses</span>
                                <span class="info-box-number">
					0
				</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>

                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="results" class="nav-link" style="color:black">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-tasks"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Submitted results</span>
                                <span class="info-box-number">
                        0
				</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="students" class="nav-link" style="color:black">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-graduate"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Students</span>
                                <span class="info-box-number">
				0

				</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="#" class="nav-link" style="color:black">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Instructors</span>
                                <span class="info-box-number">
					0

				</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">

            <div class="title_left">
             <table border="0" style="margin-left: 62.5%; width: 38%; margin-bottom:5px"><tr><td>
                 <div style="float:left; padding-left: 73%">
                     <div style="float:left;">
                         <button type="button" class="btn btn-block btn-info btn-sm" data-toggle="modal" data-target="#enrollmentForm" data-backdrop="static" data-keyboard="false"></span>Button here</button>
                     </div>
                 </div>
             </td></tr>
             </table>
           </div>
           <div class="title_right">

            <div class="card card-info">

<!--              Section title-->
              <div class="card-header">
                <h3 class="card-title">Title here</h3>
              </div>

              Contents here
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->

	<?php include 'layout/footer.php'; ?>
</div>
<?php include 'layout/js.php'; ?>


