<main>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/shiftsStyle.css"/>

<div class="warp">
    <?php
    if (isset($error)) {?>
    <p class='alert alert-danger' id="error">
        <?php echo $error['message'];
    }
    ?></p> 
<?php echo form_open('Shifts/viewShifts'); ?>
<!--    <h2><?php echo $title; ?></h2>-->
    <table class="view">
    <tr>
        <th></th>
        <th>יום ראשון</th>
        <th>יום שני</th>
        <th>יום שלישי</th>
        <th>יום רביעי</th>
        <th>יום חמישי</th>
        <th>יום שישי</th>
        <th>יום שבת</th>        
    </tr>
   
        <td><b>בוקר</b>         
        </td>
    
        <td>            
            <?php
            foreach ($sunday_worker_morning as $shift):
                echo $shift['sunday'];
            ?>
            <?php  endforeach;  ?>
        </td>
    
    <tr>
        <td><b>ערב</b></td>     
        <td>            
            <?php
            foreach ($sunday_worker_evening as $shift):
                echo $shift['sunday'];
            ?>
            <?php  endforeach;  ?>
        </td>
    </tr>
    
</table>
    
</div>

</main>


