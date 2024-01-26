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
          <form id="logout-form" action="<?php echo base_url();?>auth/logout" method="GET" style="display: none;">
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

                  <li class="nav-item">
                      <a href="<?php echo base_url();?>registrations" class="nav-link">
                          <i class="nav-icon  fas fa-user"></i>
                          <p>Registrations</p>
                      </a>
                  </li>

				  <li class="nav-item has-treeview">
					  <a href="#" class="nav-link">
						  <i class="nav-icon fas fa-cogs"></i>
						  <p>
							  System Administration
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
							  <a href="<?php echo base_url();?>users" class="nav-link">
								  <i class="far fa-circle nav-icon"></i>
								  <p>Manage Users</p>
							  </a>
						  </li>
						  
						  <li class="nav-item">
							  <a href="<?php echo base_url();?>user_types" class="nav-link">
								  <i class="far fa-circle nav-icon"></i>
								  <p>User Types</p>
							  </a>
						  </li>						  
						  
						  <li class="nav-item">
							  <a href="<?php echo base_url();?>permissions" class="nav-link">
								  <i class="far fa-circle nav-icon"></i>
								  <p>Permission</p>
							  </a>
						  </li>						  
						  <li class="nav-item">
							  <a href="<?php echo base_url();?>roles" class="nav-link">
								  <i class="far fa-circle nav-icon"></i>
								  <p>Roles</p>
							  </a>
						  </li>
						  <li class="nav-item">
							  <a href="<?php echo base_url();?>activateRegistration" class="nav-link">
								  <i class="far fa-circle nav-icon"></i>
								  <p>Activate Registration</p>
							  </a>
						  </li>
					  </ul>
				  </li>
                  <li class="nav-item">
                      <a href="<?php echo base_url();?>laboratories" class="nav-link">
                          <i class="nav-icon  fa fa-flask"></i>
                          <p>Laboratory Unit</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo base_url();?>sections" class="nav-link">
                          <i class="nav-icon  fa fa-syringe"></i>
                          <p>Sub-Units</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo base_url();?>item_locations" class="nav-link">
                          <i class="nav-icon  fa fa-dungeon"></i>
                          <p>Item Locations</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo base_url();?>item_types" class="nav-link">
                          <i class="nav-icon  fa fa-home"></i>
                          <p>Item Types</p>
                      </a>
                  </li>	
                  <li class="nav-item">
                      <a href="<?php echo base_url();?>items" class="nav-link">
                          <i class="nav-icon  fa fa-home"></i>
                          <p>Items</p>
                      </a>
                  </li>					  
                  <li class="nav-item">
                      <a href="<?php echo base_url();?>services" class="nav-link">
                          <i class="nav-icon  fa fa-home"></i>
                          <p>Services</p>
                      </a>
                  </li>	
                  <li class="nav-item">
                      <a href="<?php echo base_url();?>samples" class="nav-link">
                          <i class="nav-icon  fa fa-hospital"></i>
                          <p>Samples</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo base_url();?>equipment_types" class="nav-link">
                          <i class="nav-icon  far fa-building"></i>
                          <p>Equipment Types</p>
                      </a>
                  </li>				  
                  <li class="nav-item">
                      <a href="<?php echo base_url();?>equipments" class="nav-link">
                          <i class="nav-icon  far fa-building"></i>
                          <p>Equipments</p>
                      </a>
                  </li>
				  <li class="nav-item">
                      <a href="<?php echo base_url();?>suppliers" class="nav-link">
                          <i class="nav-icon  far fa-syringe"></i>
                          <p>Suppliers</p>
                      </a>
                  </li>
				  <li class="nav-item">
                      <a href="<?php echo base_url();?>inventories" class="nav-link">
                          <i class="nav-icon  far fa-syringe"></i>
                          <p>Inventory</p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="<?php echo base_url();?>borrowings" class="nav-link">
                          <i class="nav-icon  far fa-user"></i>
                          <p>My Borrowing</p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="<?php echo base_url();?>borrows" class="nav-link">
                          <i class="nav-icon  far fa-building"></i>
                          <p>Borrow Equipments</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo base_url();?>requests" class="nav-link">
                          <i class="nav-icon  far fa-building"></i>
                          <p>Requests</p>
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

        <div class="row">
          <div class="col-md-12">

				<?php
				if (isset($dyn_table)) {
					echo $dyn_table;
				}
				?>				


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


