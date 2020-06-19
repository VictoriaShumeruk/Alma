<main>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/shiftsStyle.css"/>

<div class="container">
    <h1> סידור משמרות עבור שבוע מספר:
        <?php 
        if($this->session->flashdata('week') != null){
            $date=$this->session->flashdata('week');
            echo date("W-Y", strtotime($date));}                            
            else{
            echo date("W-Y"); 
            }
        ?>
    </h1>
    <table>
    <?php
        $sundayDate=$this->session->flashdata('sunday');
        $dates[0] = date("d-m-Y", strtotime($sundayDate));
        for($i=1;$i<7;$i++){
            $x = $dates[$i-1];
                $time =new DateTime($x); 
                $monday=$time->modify('+1 day');
                $dates[$i] = $time->format('d-m-Y'); 
    }?>
    <tr>
        <th class="date">
            <?php echo form_open('Shifts/form_shiftsDate'); ?>           
            <input type="week" name="week" value="<?php
            if($this->session->flashdata('week')){
                echo $this->session->flashdata('week');
            }else{
                echo $this->session->flashdata('currentWeek');
            }?>">
            <p><button class="submit-btn" type="submit" >בחר</button></p>
            <?php form_close();?> 
        </th>  
        <th> תפקיד </th>
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
    </tr>
    <tr class="waiter">
        <td rowspan="4" style="background-color:lightgrey;"><b>בוקר</b></td>  
        <td>מלצרות</td>
        <td>
           <?php
            foreach ($sunday_morning as $shift):
                if($shift['job'] == "מלצרות"){
                    echo $shift['worker_name'];
                } endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($monday_morning as $shift):
                if($shift['job'] == "מלצרות"){
                    echo $shift['worker_name'];
                } endforeach;  ?>   
        </td>
        <td>
           <?php
            foreach ($tuesday_morning as $shift):
                 if($shift['job'] == "מלצרות"){
                    echo $shift['worker_name'];
                }endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($wednesday_morning as $shift):
                if($shift['job'] == "מלצרות"){
                    echo $shift['worker_name'];
                }endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($thursday_morning as $shift):
                if($shift['job'] == "מלצרות"){
                    echo $shift['worker_name'];
                } endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($friday_morning as $shift):
                 if($shift['job'] == "מלצרות"){
                    echo $shift['worker_name'];
                }endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($saturday_morning as $shift):
                  if($shift['job'] == "מלצרות"){
                    echo $shift['worker_name'];
                } endforeach;  ?>
        </td>
        
    </tr>
    <tr class="bar">
        <td>בר</td>
        <td>
           <?php
            foreach ($sunday_morning as $shift):
                if($shift['job'] == "בר"){
                    echo $shift['worker_name'];
                }endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($monday_morning as $shift):
                 if($shift['job'] == "בר"){
                    echo $shift['worker_name'];
                }endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($tuesday_morning as $shift):
                if($shift['job'] == "בר"){
                    echo $shift['worker_name'];
                }endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($wednesday_morning as $shift):
                 if($shift['job'] == "בר"){
                    echo $shift['worker_name'];
                }endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($thursday_morning as $shift):
                 if($shift['job'] == "בר"){
                    echo $shift['worker_name'];
                }endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($friday_morning as $shift):
                if($shift['job'] == "בר"){
                    echo $shift['worker_name'];
                }endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($saturday_morning as $shift):
                 if($shift['job'] == "בר"){
                    echo $shift['worker_name'];
                }endforeach;  ?>
        </td>
    </tr>
    <tr class="hosting">
        <td>אירוח</td>
        <td>
           <?php
            foreach ($sunday_morning as $shift):
                 if($shift['job'] == "אירוח"){
                     echo $shift['worker_name'];
                 } endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($monday_morning as $shift):
                 if($shift['job'] == "אירוח"){
                     echo $shift['worker_name'];
                 } endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($tuesday_morning as $shift):
                if($shift['job'] == "אירוח"){
                     echo $shift['worker_name'];
                 } endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($wednesday_morning as $shift):
               if($shift['job'] == "אירוח"){
                     echo $shift['worker_name'];
                 } endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($thursday_morning as $shift):
                if($shift['job'] == "אירוח"){
                     echo $shift['worker_name'];
                 } endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($friday_morning as $shift):
               if($shift['job'] == "אירוח"){
                     echo $shift['worker_name'];
                 } endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($saturday_morning as $shift):
               if($shift['job'] == "אירוח"){
                     echo $shift['worker_name'];
                 } endforeach;  ?>
        </td>
    </tr>
    <tr class="manager">  
        <td>אחמ"ש</td>
        <td>
           <?php
            foreach ($sunday_morning as $shift):
                if($shift['job'] == "אחמש"){
                    echo $shift['worker_name'];
                }endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($monday_morning as $shift):
               if($shift['job'] == "אחמש"){
                    echo $shift['worker_name'];
                }endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($tuesday_morning as $shift):
                if($shift['job'] == "אחמש"){
                    echo $shift['worker_name'];
                }endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($wednesday_morning as $shift):
              if($shift['job'] == "אחמש"){
                    echo $shift['worker_name'];
                }endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($thursday_morning as $shift):
                if($shift['job'] == "אחמש"){
                    echo $shift['worker_name'];
                }endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($friday_morning as $shift):
                if($shift['job'] == "אחמש"){
                    echo $shift['worker_name'];
                }endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($saturday_morning as $shift):
                 if($shift['job'] == "אחמש"){
                    echo $shift['worker_name'];
                }endforeach;  ?>
        </td>
    </tr>
    <tr class="waiter">
        <td rowspan="4" style="background-color:lightgrey;"><b>ערב</b></td>
        <td>מלצרות</td>
        <td>
          <?php
            foreach ($sunday_evening as $shift):
                if ($shift['job'] == "מלצרות"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($monday_evening as $shift):
               if ($shift['job'] == "מלצרות"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($tuesday_evening as $shift):
               if ($shift['job'] == "מלצרות"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($wednesday_evening as $shift):
               if ($shift['job'] == "מלצרות"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($thursday_evening as $shift):
               if ($shift['job'] == "מלצרות"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($friday_evening as $shift):             
               if ($shift['job'] == "מלצרות"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($saturday_evening as $shift):
              if ($shift['job'] == "מלצרות"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
    </tr>
    <tr class="bar">      
        <td>בר</td>
        <td>
          <?php
            foreach ($sunday_evening as $shift):
                if ($shift['job'] == "בר"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($monday_evening as $shift):
               if ($shift['job'] == "בר"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($tuesday_evening as $shift):
               if ($shift['job'] == "בר"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($wednesday_evening as $shift):
               if ($shift['job'] == "בר"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($thursday_evening as $shift):
               if ($shift['job'] == "בר"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($friday_evening as $shift):             
               if ($shift['job'] == "בר"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($saturday_evening as $shift):
              if ($shift['job'] == "בר"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
    </tr>
    <tr class="hosting">
         <td>אירוח</td>
        <td>
          <?php
            foreach ($sunday_evening as $shift):
                if ($shift['job'] == "אירוח"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($monday_evening as $shift):
               if ($shift['job'] == "אירוח"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($tuesday_evening as $shift):
               if ($shift['job'] == "אירוח"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($wednesday_evening as $shift):
               if ($shift['job'] == "אירוח"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($thursday_evening as $shift):
               if ($shift['job'] == "אירוח"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($friday_evening as $shift):             
               if ($shift['job'] == "אירוח"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($saturday_evening as $shift):
              if ($shift['job'] == "אירוח"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
    </tr>
    <tr class="manager">
    <td>אחמ"ש</td>
        <td>
          <?php
            foreach ($sunday_evening as $shift):
                if ($shift['job'] == "אחמש"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($monday_evening as $shift):
               if ($shift['job'] == "אחמש"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($tuesday_evening as $shift):
               if ($shift['job'] == "אחמש"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($wednesday_evening as $shift):
               if ($shift['job'] == "אחמש"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($thursday_evening as $shift):
               if ($shift['job'] == "אחמש"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($friday_evening as $shift):             
               if ($shift['job'] == "אחמש"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($saturday_evening as $shift):
              if ($shift['job'] == "אחמש"){
                     echo $shift['worker_name'];
                }  endforeach;  ?>
        </td>
    </tr>
</table>
</div>
</main>


