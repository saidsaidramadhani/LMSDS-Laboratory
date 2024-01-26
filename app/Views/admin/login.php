
<?php 
// $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
// $system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
$system_name='Laboratory';
?>
<!DOCTYPE html>  
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Laboratory">
<meta name="author" content="Laboratory">
        <link rel="icon" href="<?php echo base_url(); ?>/optimum/logo.png" type="image/x-icon" />
        <title><?php echo $system_name; ?></title>
<!-- Bootstrap Core CSS -->
<link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>/optimum/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
<!-- animation CSS -->
<link href="<?php echo base_url(); ?>/optimum/css/animate.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="<?php echo base_url(); ?>/optimum/css/style.css" rel="stylesheet">
<!-- color CSS -->
<link href="<?php echo base_url(); ?>optimum/css/colors/megna.css" id="theme"  rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url()?>/public/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url()?>/public/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->

</head>
<body>

   <style>

        
        .form--user__icon span{
            font-size: 32px;
            position: absolute !important;
            top: 50% !important;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .container {
                width: 450px;
                height: 450px;
				margin: 0 auto;
				border-radius: 5px;
				position: absolute;
				top: 300px;
				z-index: 2;
				color: #fff;
				content: '';
				padding: 20px;
				left: 50%;
				transform: translate(-50%, -50%);
        }
        
        
        .form--user__icon {
                border-radius: 50%;
				height: 110px;
				z-index: 9;
				top: -40px;
				text-align: center;
				left: 50%;
				background: #ffffff;
				transform: translate(-50%, 0);
				position: absolute;
				width: 110px;
				color: #fff;
        }
        
        button {
			width: 80%;
			color:#fff !important;
			border-radius: 50px !important;
			border: 0 !important;
			background: #003296 !important;
        }
        
        .container h4 {
            margin-top: 732px;
        }        
		
		.containers {
			border-radius: 10px !important;
			border: 2 !important;
			box-shadow: 0px 0px 14px 2px brown;
        }
        form a{
        color:#fff !important;
        text-decoration:underline !important;
        }
    </style>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register" align="center"> 
  <div class="container" >
		<div class="form--user__icon" >
            <div class="icon--img">
			
				<img  width="110" height="110" src="<?php echo base_url(); ?>/optimum/logo.png">
            </div>
        </div>    <div class="white-box containers" style="border:2px solid brown"> 

               <div align="center"> 
			   
 					<br> <strong style="color:brown">Laboratory Management and Service Delivery System(LMSDS)</strong>.
                <div align="center">
                       <?php if (isset($page) && $page == "logout"): ?>
                    <div class="alert alert-success hide_msg pull" style="width: 100%"> <i class="fa fa-check-circle"></i> Logout Successfully &nbsp;
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    </div>
               	 	<?php endif ?>

					<?php if (isset($page) && $page == "invalid"): ?>
                    <div class="alert alert-danger hide_msg pull" style="width: 100%"> <i class="fa fa-check-circle"></i> Invalid Username or Password &nbsp;
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    </div>
               	 	<?php endif ?>
					
					<?php if (isset($page) && $page == "waitlogin"): ?>
                    <div class="alert alert-danger hide_msg pull" style="width: 100%"> <i class="fa fa-check-circle"></i> Wait for three minutes then try again <?php echo $timing; ?>&nbsp;
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    </div>
               	 	<?php endif ?>
                    </div>
		<br><br>
						<form class="form-horizontal form-material" id="login-form" action="<?php echo base_url('log'); ?>" method="post"> 

					<div class="form-group">
                                   
                                    <div class="col-xs-12">
                            <input class="form-control" type="text" name="username" value="" required="" placeholder="Username" style="width:100%">
                                    </div>
                                </div>
       <div class="form-group ">
                        <div class="col-xs-12">
                            </span><input class="form-control" type="password" name="password" value="" required="" placeholder="Password" style="width:100%">
                        </div>
                    </div>
                   
    
	 <!-- CSRF token -->
 		  
<button class="btn btn-info style1 btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" style="width:100%; color:white">
Login
</button>

<br>
<br>
<br>
 <strong style="color:black">Forgot password?. Click <a href="<?php echo base_url() ?>Recpass"><font style="color:blue">HERE</font></a> to Recover.</strong>

<div align="center"><img id="install_progress" src="<?php echo base_url() ?>/optimum/images/loading.gif" style="margin-left: 20px;  display: none"/></div>

                        </div>
						<br>
						<br>
						<br>
						<br>
                    </div>
					
                 </form>
        			
            </div>
        </div>
		
		
		
		

    </section>
	

<!-- jQuery -->
<script src="<?php echo base_url(); ?>/optimum/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>/optimum/bootstrap/dist/js/tether.min.js"></script>
<script src="<?php echo base_url(); ?>/optimum/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>/optimum/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>

<!--Custom JavaScript -->
    <script src="<?php echo base_url() ?>/optimum/js/custom.min.js"></script>
    <script src="<?php echo base_url() ?>/optimum/js/custom.js"></script>
	

	
<!-- Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>/optimum/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <link href="<?php echo base_url(); ?>/optimum/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
 
 <!-- auto hide message div-->
    <script type="text/javascript">
        $( document ).ready(function(){
           $('.hide_msg').delay(2000).slideUp();
        });
    </script>
	
<!--slimscroll JavaScript -->
<script src="<?php echo base_url(); ?>/optimum/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="<?php echo base_url(); ?>/optimum/js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>/optimum/js/custom.min.js"></script>
<!--Style Switcher -->
<script src="<?php echo base_url(); ?>/optimum/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

<script>
    $('form').submit(function (e) 
	{
        $('#install_progress').show();
        $('#modal_1').show();
        $('.btn').val('Login...');
        $('form').submit();
        e.preventDefault();
    });
	
</script>

</body>

</html>
