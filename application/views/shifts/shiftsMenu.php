<main>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/shiftsStyle.css"/>

<div class="container">
    <div class="row">
        <?php if(($_SESSION['role']=='מנהל')){?>           
        <div class=box><a href="<?php echo site_url().'shifts/manageShifts'?>">
                   שיבוץ משמרות
        </a></div>
        <?php
            } else {           
                echo '<div class=box onclick="autho()"><a href="#">
                שיבוץ משמרות
                </a></div>';
            } ?>
   
        <div class=box><a href="<?php echo site_url().'shifts/sendShifts'?>">
              שליחת משמרות 
        </a></div>

        <div class=box><a href="<?php echo site_url().'shifts/viewShifts'?>">
               צפייה בסידור משמרות
        </a></div>
    </div>
</div>   
</main>


<script>
function autho(){
swal({
    title: "",
    text: " משתמש שאינו מנהל לא ראשי להכנס לשיבוץ משמרות",
    icon: "error",
    button: "הבנתי:) ",
});
};
</script>

