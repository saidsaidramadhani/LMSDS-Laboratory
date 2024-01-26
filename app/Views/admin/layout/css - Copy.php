<?php 
 $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
// $system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>/optimum/logo.png">
    <title><?php echo $system_name; ?></title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE/plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE/plugins/toastr/toastr.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  

 
  <style>
      body{
  height:100%;
}

   .datepicker {
    font-size: 0.875em;
  }
  /* solution 2: the original datepicker use 20px so replace with the following:*/

  .datepicker td, .datepicker th {
    width: 2.5em;
    height: 2.0em;
  }
</style>  
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">


        
