<main>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/shiftsStyle.css"/>

<div class="container">
<?php if($this->session->flashdata('error')){?>
    <div class="alert alert-danger">
        <!--<a href="<?php echo site_url().'pages/index'?>" class="close" data-dismiss="alert" aria-label="close">×</a>-->
        <?php echo $this->session->flashdata('error'); ?>
        <!--<a href="<?php echo site_url().'pages/index'?>" class='alert-link'> לחזרה לדף בית לחץ כאן</a>-->

    </div>
<?php } ?>
<?php if ($this->session->flashdata('success')) { ?>
    <div class="alert alert-success">
        <!--<a href="<?php echo site_url().'pages/index'?>" class="close" data-dismiss="alert" aria-label="close">×</a>-->
        <!--<a href=". site_url().'pages/index'" class='alert-link'> לחזרה לדף בית לחץ כאן</a>-->
      <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>-->
        <strong><?php echo $this->session->flashdata('success'); ?></strong>
    </div>
<?php } ?>
<?php echo form_open('Shifts/saveShifts'); ?>
<?php
    $sundayDate=$this->session->flashdata('sunday');
    $dates[0] = date("d-m-Y", strtotime($sundayDate));
    for($i=1;$i<7;$i++){
        $x = $dates[$i-1];
        $time =new DateTime($x); 
        $monday=$time->modify('+1 day');
        $dates[$i] = $time->format('d-m-Y'); 
}?>
<table>
    <tr>
        <th id="1">יום ראשון
            <p><?php echo date("d/m", strtotime($dates[0]));
             foreach($calArray['items'] as $holiday){
                    $date = $holiday['date'];
                    if ($dates[0] == date('d-m-Y',strtotime($date))){
                        echo '<br>'.$holiday['hebrew'];
                        $sundayfreeDay = true;
                    }
                }
            ?><script><?php if($sundayfreeDay ==true){?> document.getElementById("1").style.background="MediumAquaMarine"; <?php }?></script>
            </p>
        </th>
        <th id="2">יום שני
            <p><?php echo date("d/m", strtotime($dates[1])); 
             foreach($calArray['items'] as $holiday){
                    $date = $holiday['date'];
                    if ($dates[1] == date('d-m-Y',strtotime($date))){
                        echo '<br>'.$holiday['hebrew'];
                        $mondayfreeDay = true;
                    }
                }
            ?><script><?php if($mondayfreeDay ==true){?> document.getElementById("2").style.background="MediumAquaMarine"; <?php }?></script>
            </p>
        </th>
        <th id="3">יום שלישי
            <p><?php echo date("d/m", strtotime($dates[2])); 
             foreach($calArray['items'] as $holiday){
                    $date = $holiday['date'];
                    if ($dates[2] == date('d-m-Y',strtotime($date))){
                        echo '<br>'.$holiday['hebrew'];
                        $tuesdayfreeDay = true;
                    }
                }
            ?><script><?php if($tuesdayfreeDay ==true){?> document.getElementById("3").style.background="MediumAquaMarine"; <?php }?></script>
            </p>
        </th>
        <th id="4">יום רביעי
            <p><?php echo date("d/m", strtotime($dates[3])); 
             foreach($calArray['items'] as $holiday){
                    $date = $holiday['date'];
                    if ($dates[3] == date('d-m-Y',strtotime($date))){
                        echo '<br>'.$holiday['hebrew'];
                        $wednesfreeDay = true;
                    }
                }
            ?><script><?php if($wednesdayfreeDay ==true){?> document.getElementById("4").style.background="MediumAquaMarine"; <?php }?></script>
            </p>
        </th>
        <th id="5">יום חמישי
            <p><?php echo date("d/m", strtotime($dates[4])); 
             foreach($calArray['items'] as $holiday){
                    $date = $holiday['date'];
                    if ($dates[4] == date('d-m-Y',strtotime($date))){
                        echo '<br>'.$holiday['hebrew'];
                        $thursdayfreeDay = true;
                    }
                }
            ?><script><?php if($thursdayfreeDay ==true){?> document.getElementById("5").style.background="MediumAquaMarine"; <?php }?></script>
            </p>
        </th>
        <th id="6">יום שישי
            <p><?php echo date("d/m", strtotime($dates[5]));
                foreach($calArray['items'] as $holiday){
                    $date = $holiday['date'];
                    if ($dates[5] == date('d-m-Y',strtotime($date))){
                        echo '<br>'.$holiday['hebrew'];
                        $fridayfreeDay = true;
                    }
                }
                ?> <script><?php if($fridayfreeDay ==true){?> document.getElementById("6").style.background="MediumAquaMarine"; <?php }?></script>
            </p>
        </th>
        <th id="7">יום שבת
            <p><?php echo date("d/m", strtotime($dates[6])); 
             foreach($calArray['items'] as $holiday){
                    $date = $holiday['date'];
                    if ($dates[6] == date('d-m-Y',strtotime($date))){
                        echo '<br>'.$holiday['hebrew'];
                        $saturdayfreeDay = true;
                    }
                }
            ?><script><?php if($saturdayfreeDay ==true){?> document.getElementById("7").style.background="MediumAquaMarine"; <?php }?></script>
            </p>
        </th>
<!--        <th>יום ראשון</th>
        <th>יום שני</th>
        <th>יום שלישי</th>
        <th>יום רביעי</th>
        <th>יום חמישי</th>
        <th>יום שישי</th>
        <th>יום שבת</th>        -->
    </tr>
    
    <tr>
        <td> 
            <input type="hidden" value="ראשון" name="day[]">
            <select name="time[]" required>
                <option disabled selected value=""> בחר משמרת</option>
                <option value="בוקר">בוקר</option>
                <option value="ערב">ערב</option>
                <option value="בוקר/ערב">בוקר/ערב</option>
                <option value="כפולה">כפולה</option>
                <option value="חופש">חופש</option>         
            </select>
        </td>
        
        <td>
            <input type="hidden" value="שני" name="day[]">   
            <select name="time[]" required>
                <option disabled selected value=""> בחר משמרת</option>
                <option value="בוקר">בוקר</option>
                <option value="ערב">ערב</option>
                <option value="בוקר/ערב">בוקר/ערב</option>
                <option value="כפולה">כפולה</option>
                <option value="חופש">חופש</option>
            </select>
        </td>
        
        <td>
            <input type="hidden" value="שלישי" name="day[]">
            <select name="time[]" required>
                <option disabled selected value=""> בחר משמרת</option>
                <option value="בוקר">בוקר</option>
                <option value="ערב">ערב</option>
                <option value="כפולה">כפולה</option>
                <option value="חופש">חופש</option>
            </select>
        </td>
        
        <td>
            <input type="hidden" value="רביעי" name="day[]">  
            <select name="time[]" required>
                <option disabled selected value=""> בחר משמרת</option>
                <option value="בוקר">בוקר</option>
                <option value="ערב">ערב</option>
                <option value="כפולה">כפולה</option>
                <option value="חופש">חופש</option>
            </select>
        </td>
        
        <td>
            <input type="hidden" value="חמישי" name="day[]">
            <select name="time[]" required>
                <option disabled selected value=""> בחר משמרת</option>
                <option value="בוקר">בוקר</option>
                <option value="ערב">ערב</option>
                <option value="כפולה">כפולה</option>
                <option value="חופש">חופש</option>
            </select>
        </td>
        
        <td>
            <input type="hidden" value="שישי" name="day[]">   
           <select name="time[]" required>
                <option disabled selected value=""> בחר משמרת</option>
                <option value="בוקר">בוקר</option>
                <option value="ערב">ערב</option>
                <option value="כפולה">כפולה</option>
                <option value="חופש">חופש</option>
            </select>
        </td>
        
        <td>
            <input type="hidden" value="שבת" name="day[]"> 
           <select name="time[]" required>
                <option disabled selected value=""> בחר משמרת</option>
                <option value="בוקר">בוקר</option>
                <option value="ערב">ערב</option>
                <option value="כפולה">כפולה</option>
                <option value="חופש">חופש</option>
            </select>
        </td>
        
    </tr> 
</table>
<input type="submit" value="שלח" class="submit-btn" name="submit" onclick="clicked()">      
</div>
</main>

<?php if(!($this->session->flashdata('success') || $this->session->flashdata('error'))){
echo '<script>     
$( document ).ready(function() {
    
    swal({
    title: "תזכורת",
    text: " עלייך להגיש לפחות שלוש משמרות באמצע שבוע ואחת בסופש",
    icon: "info",
    button: "הבנתי:) ",
});});
    
</script>';
}
?>
