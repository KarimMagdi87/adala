<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>عدالة</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/dt-1.10.8/datatables.min.css"/>




    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div id="wrapper">
<!-- header -->
<!--header class="jumbotron">
    <div class="container">
        <div class="col-md-10">
            <h1>عدالة</h1>
            <p>تطبيق عدالة</p>
        </div>
        <div class="col-md-2">

        </div>
    </div>
</header-->
<?php if (isset($cpy_status) && isset($dnld_status)) { ?>
<input type="hidden" value="<?php echo $cpy_status; ?>" id="cpy_status"/>  <!-- save copy status from session -->
<input type="hidden" value="<?php echo $dnld_status; ?>" id="dnld_status"/>  <!-- save download status from session -->
<?php } ?>

<!-- nav -->
<?php
if(isset($username) && $username == 'admin'){
    $this->view('nav_backend');
    }else{
        $this->view('nav');
}
?>

<div clas="row">
    <div class="col-md-12 msgsuccess">
        <div class="alert alert-success">
            <a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
            <strong>تم بنجاح</strong>
        </div>
    </div>
</div>
