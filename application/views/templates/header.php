<!DOCTYPE html>
<html lang="he" dir="rtl">
    <head>
        <meta charset="utf-8">
        <title>עלמא</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/templateStyle.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <!-- Bootstrap CSS -->   
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <link href="http://getbootstrap.com/2.3.2/assets/css/bootstrap-responsive.css" rel="stylesheet">

   <?php error_reporting(E_ALL ^ E_NOTICE); ?>

    </head>
    <body>
        <header class="login">    
            <?php if(isset($_SESSION['id'])){?>
            
            <a href="<?php echo site_url().'Pages/index'?>"> <img src="<?php echo base_url();?>/assets/images/homeIcon.jpg" id="img"></a>
            <?php
                } else {
                    echo '<a href="#" onclick="autho()"> <img src="'.site_url().'/assets/images/homeIcon.jpg" id="img"></a>';
                }
            ?>
            
            <button id="back"> <img src="<?php echo base_url();?>/assets/images/back.jpg" onclick="goBack()" id="img"></button>
  
            <?php
            if (isset($_SESSION['id'])){?>
            <button id="b_login"><a href="<?php echo site_url().'User/logout'?>">התנתקות</a></button>
            
            <div class="worker"> <?php if (isset($_SESSION['id'])){echo 'עובד נוכחי: '.$_SESSION['fullname'];} ?></div>
            <?php
                } else {
                    echo '<button id="b_login"><a href="' . site_url() . '/User/login"> התחברות</a></button>';
                }
            ?>
        </header>
        
<script>
    function goBack() {
        window.history.go(-1);
    }
    
   
    function autho(){
    swal({
        title: "",
        text: " עלייך להיות מחובר למערכת על מנת לגשת לדף הבית",
        icon: "warning",
        button: "הבנתי:) ",
    });
    };
</script>
              
              