<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Records | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url()?>/public/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url()?>/public/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url()?>/public/assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>IPA</b>LEAVE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

          <?php 
          if(!empty(session()->getFlashData('fail'))) : ?>
          <div class="alert alert-danger">
            <?=  session()->getFlashData('fail') ?>
          </div>
          <?php endif   ?>
          <?php 
          if(!empty(session()->getFlashData('success'))) : ?>
          <div class="alert alert-success">
            <?=  session()->getFlashData('success') ?>
          </div>
          <?php endif   ?>

        <form action="<?= base_url('/check') ?>" method="post" autocomplete="off">
          <?= csrf_field() ?>

        <div class="form-group">
          <label for="Email">Enter Email</label>
          <input type="text" class="form-control" placeholder="Enter Email" name="email"   >
          <span class="text-danger"><?= isset($validation) ? display_error($validation , 'email') : '' ?> </span>  
        </div>

         <div class="form-group">
          <label for="Password">Password</label>
          <input type="Password" class="form-control" name="password"  placeholder="Enter Password"  >
          <span class="text-danger"><?= isset($validation) ? display_error($validation , 'password') : '' ?> </span>  
        </div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
             
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url()?>/public/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url()?>/public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url()?>/public/assets/dist/js/adminlte.min.js"></script>

</body>
</html>
