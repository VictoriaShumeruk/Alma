<main>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/shiftsStyle.css"/>

    <div class="wrap">
        <div class="row">
            
             <?php if(($_SESSION['role']=='מנהל')){?>           
            <div class=box><a href="<?php echo site_url().'user/editUsers'?>">
                       עריכת פרטי עובדים
            </a></div>
            <?php
                } else {
                    echo '<div class=box onclick="autho()"><a href="#">
                   עריכת פרטי עובדים
                    </a></div>';
                }
            ?>
            
            <div class=box><a href="<?php echo site_url().'user/viewUsers'?>">
                  צפייה בפרטי עובדים 
            </a></div>
            
            <?php if( ($_SESSION['id'])==(isset($_SESSION['id']))){?>
            <div class=box><a href="<?php echo site_url().'user/editMyUser'?>">
                   עריכת הפרטים שלי
            </a></div>
            <?php }?>
        </div>
    </div>   
</main>


<script>
function autho(){
swal({
    title: "",
    text: " רק מנהל רשאי לערוך פרטי עובדים",
    icon: "error",
    button: "הבנתי:) ",
});
};
</script>

