<main>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/shiftsStyle.css"/>

<div class="container">    
<?php echo form_open('Shifts/savefinalShifts'); ?>

    <?php if($this->session->flashdata('error')){?>
        <div class="alert alert-danger">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php } ?>
    <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success">
            <strong><?php echo $this->session->flashdata('success'); ?></strong><br>
            <a href="<?php echo base_url().'/Shifts/delete_shifts/.'?>" onclick=" return confirm('האם אתה בטוח שברצונך למחוק?')"><b> למחיקת המשמרות שהוגשו בשבוע שעבר לחץ כאן</b></a>
            
        </div>
    <?php } ?>
    <?php if ($this->session->flashdata('warning')) { ?>
        <div class="alert alert-warning">
            <strong><?php echo $this->session->flashdata('warning'); ?></strong><br>            
        </div>
    <?php } ?>
        <div class="alert alert-info">
            <p><strong>שים לב! </strong>יש לשבץ עובד אחד בכל משמרת באמצע השבוע .<br>                
                בסופי שבוע, <u>(חמישי ערב - שבת)</u> יש לשבץ שני מלצרים ושני ברמנים.</p>
        </div>
    
    <?php
        $sundayDate=$this->session->flashdata('sunday');
        $dates[0] = date("d-m-Y", strtotime($sundayDate));
        for($i=1;$i<7;$i++){
            $x = $dates[$i-1];
                $time =new DateTime($x); 
                $monday=$time->modify('+1 day');
                $dates[$i] = $time->format('d-m-Y');     
        }
    ?>
    <table class="manage">
    <tr>
        <th class="date">           
            <input type="week" name="week" readonly value="<?php echo $this->session->flashdata('currentWeek');?>">     
        </th>
        <th>תפקיד</th>
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
            <p><?php 
             echo date("d/m", strtotime($dates[6])); 
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
            <?php if ($sundayfreeDay === true){
            echo '<label style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
          
            <?php
            foreach ($sunday_morning as $shift): 
            if($shift['job'] == "מלצרות"){?>     
            <br><label><input class="sundayMorWaiter" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; ?></label>               
            <?php }endforeach; ?>
            <input type="hidden" value="ראשון" name="day[]">
            <input type="hidden" value="בוקר" name="time[]">    
        </td>
        <td>               
            <?php if ($mondayfreeDay === true){
            echo '<label style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($monday_morning as $shift):?>
            <?php if($shift['job'] == "מלצרות"){?>
            <br><label><input class="mondayMorWaiter" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; }?></label>  
            <?php  endforeach;  ?> 
            <input type="hidden" value="שני" name="day[]">
            <input type="hidden" value="בוקר" name="time[]">        
        </td>
        <td>
            <?php if ($tuesdayfreeDay === true){
            echo '<label style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($tuesday_morning as $shift):?>
            <?php if($shift['job'] == "מלצרות"){?>
            <br><label><input class="tuesdayMorWaiter" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; }?></label>                  
            <?php  endforeach;  ?> 
            <input type="hidden" value="שלישי" name="day[]">
            <input type="hidden" value="בוקר" name="time[]"> 
        </td>
        <td>
            <?php if ($wednesdayfreeDay === true){
            echo '<label style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($wednesday_morning as $shift):?>
            <?php if($shift['job'] == "מלצרות"){?>
            <br><label><input class="wednesdayMorWaiter" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; } ?></label>                  
            <?php  endforeach;  ?>     
            <input type="hidden" value="רביעי" name="day[]">
            <input type="hidden" value="בוקר" name="time[]"> 
        </td>
        <td>
           <?php if ($thursdayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($thursday_morning as $shift):?>
            <?php if($shift['job'] == "מלצרות"){?>
            <br><label><input class="thursdayMorWaiter" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; }?></label>                 
            <?php  endforeach;  ?>   
            <input type="hidden" value="חמישי" name="day[]">
            <input type="hidden" value="בוקר" name="time[]">
        </td>
        <td>
           <?php if ($fridayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($friday_morning as $shift):?>
            <?php if($shift['job'] == "מלצרות"){?>      
            <br><label><input class="fridayMorWaiter" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; }?></label>                 
            <?php  endforeach;  
            for ($i=0; $i< 2; $i++){
                echo
                '<input type="hidden" value="שישי" name="day[]">
                <input type="hidden" value="בוקר" name="time[]">';  
            }?>
        </td>
        <td>
           <?php if ($saturdayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($saturday_morning as $shift):?>
            <?php if($shift['job'] == "מלצרות"){?>                    
            <br><label><input class="saturdayMorWaiter" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname'];} ?></label>                  
            <?php  endforeach;  
            for ($i=0; $i< 2; $i++){
                echo
                '<input type="hidden" value="שבת" name="day[]">
                <input type="hidden" value="בוקר" name="time[]">';
            }?>
        </td>
    </tr>
    <tr class="bar">
        <td>בר</td>
        <td>
            <?php if ($sundayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($sunday_morning as $shift):?>
            <?php if($shift['job'] == "בר"){?>        
            <br><label><input class="sundayMorBar" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>"  >
            <?php echo $shift['fullname']; }?></label>
            <?php endforeach;?> 
            <input type="hidden" value="ראשון" name="day[]">
            <input type="hidden" value="בוקר" name="time[]">   
        </td>
        <td>               
            <?php if ($mondayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($monday_morning as $shift):?>
            <?php if($shift['job'] == "בר"){?>
            <br><label><input class="mondayMorBar" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>"  />
            <?php echo $shift['fullname']; }?></label>  
            <?php  endforeach;  ?>    
            <input type="hidden" value="שני" name="day[]">
            <input type="hidden" value="בוקר" name="time[]">
        </td>
        <td>
            <?php if ($tuesdayfreeDay === true){
            echo '<label style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($tuesday_morning as $shift):?>
            <?php if($shift['job'] == "בר"){?>
            <br><label><input class="tuesdayMorBar" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>" />
            <?php echo $shift['fullname']; }?></label>       
            <?php  endforeach;  ?> 
            <input class="tuesdayMorBar" type="hidden" value="שלישי" name="day[]" >
            <input class="tuesdayMorBar" type="hidden" value="בוקר" name="time[]" >          
        </td>
        <td>
            <?php if ($wednesdayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($wednesday_morning as $shift):?>
            <?php if($shift['job'] == "בר"){?>
            <br><label><input class="wednesdayMorBar" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; } ?></label>                  
            <?php  endforeach;  ?>   
            <input type="hidden" value="רביעי" name="day[]">
            <input type="hidden" value="בוקר" name="time[]"> 
        </td>
        <td>
           <?php if ($thursdayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($thursday_morning as $shift):?>
            <?php if($shift['job'] == "בר"){?>          
            <br><label><input class="thursdayMorBar" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; }?></label>                 
            <?php  endforeach;  ?>
             <input type="hidden" value="חמישי" name="day[]">
            <input type="hidden" value="בוקר" name="time[]">
        </td>
        <td>
           <?php if ($fridayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($friday_morning as $shift):?>
            <?php if($shift['job'] == "בר"){?>           
            <br><label><input class="fridayMorBar" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; }?></label>                 
            <?php  endforeach; 
            for ($i=0; $i<2;$i++){
                echo            
             '<input type="hidden" value="שישי" name="day[]">
            <input type="hidden" value="בוקר" name="time[]">';
            }?>
        </td>
        <td>
           <?php if ($saturdayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($saturday_morning as $shift):?>
            <?php if($shift['job'] == "בר"){?>
            <br><label><input class="saturdayMorBar" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname'];} ?></label>                  
            <?php  endforeach;  
            for ($i=0; $i<2;$i++){
                echo    
                '<input type="hidden" value="שבת" name="day[]">
                <input type="hidden" value="בוקר" name="time[]">';
            }?>
        </td>
    </tr>
    <tr class="hosting">
        <td>אירוח</td>
        <td>
            <?php if ($sundayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($sunday_morning as $shift):?>
            <?php if($shift['job'] == "אירוח"){?>                     
            <br><label><input class="sundayMorHost" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; }?></label>
            <?php endforeach;?> 
            <input type="hidden" value="ראשון" name="day[]">
            <input type="hidden" value="בוקר" name="time[]"> 
        </td>
        <td>          
            <?php if ($mondayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($monday_morning as $shift):?>
            <?php if($shift['job'] == "אירוח"){?>
            
            <br><label><input class="mondayMorHost" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; }?></label>  
            <?php  endforeach;  ?>     
            <input type="hidden" value="שני" name="day[]">
            <input type="hidden" value="בוקר" name="time[]">
        </td>
        <td>
            <?php if ($tuesdayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($tuesday_morning as $shift):?>
            <?php if($shift['job'] == "אירוח"){?>
            
            <br><label><input class="tuesdayMorHost" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; }?></label>                  
            <?php  endforeach;  ?>
            <input type="hidden" value="שלישי" name="day[]">
            <input type="hidden" value="בוקר" name="time[]"> 
        </td>
        <td>
            <?php if ($wednesdayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($wednesday_morning as $shift):?>
            <?php if($shift['job'] == "אירוח"){?>
            
            <br><label><input class="wednesdayMorHost" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; } ?></label>                  
            <?php  endforeach;  ?>  
            <input type="hidden" value="רביעי" name="day[]">
            <input type="hidden" value="בוקר" name="time[]"> 
        </td>
        <td>
           <?php if ($thursdayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($thursday_morning as $shift):?>
            <?php if($shift['job'] == "אירוח"){?>
            
            <br><label><input class="thursdayMorHost" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; }?></label>                 
            <?php  endforeach;  ?>     
             <input type="hidden" value="חמישי" name="day[]">
            <input type="hidden" value="בוקר" name="time[]">
        </td>
        <td>
           <?php if ($fridayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($friday_morning as $shift):?>
            <?php if($shift['job'] == "אירוח"){?>
                      
            <br><label><input class="fridayMorHost" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; }?></label>                 
            <?php  endforeach;  ?>
              <input type="hidden" value="שישי" name="day[]">
            <input type="hidden" value="בוקר" name="time[]">    
        </td>
        <td>
           <?php if ($saturdayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($saturday_morning as $shift):?>
            <?php if($shift['job'] == "אירוח"){?>
                   
            <br><label><input class="saturdayMorHost" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname'];} ?></label>                  
            <?php  endforeach;  ?>   
             <input type="hidden" value="שבת" name="day[]">
            <input type="hidden" value="בוקר" name="time[]">      
        </td>
    </tr>
    <tr class="manager">
        <td>אחמ"ש</td>
        <td>
            <?php if ($sundayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($sunday_morning as $shift):?>
            <?php if($shift['job'] == "אחמש"){?>
                  
            <br><label><input class="sundayMorManager" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; }?></label>
            <?php endforeach;?>    
             <input type="hidden" value="ראשון" name="day[]">
            <input type="hidden" value="בוקר" name="time[]">    
        </td>
        <td>               
            <?php if ($mondayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($monday_morning as $shift):?>
            <?php if($shift['job'] == "אחמש"){?>
            
            <br><label><input class="mondayMorManager" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; }?></label>  
            <?php  endforeach;  ?>   
            <input type="hidden" value="שני" name="day[]">
            <input type="hidden" value="בוקר" name="time[]">
        </td>
        <td>
            <?php if ($tuesdayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($tuesday_morning as $shift):?>
            <?php if($shift['job'] == "אחמש"){?>
           
            <br><label><input class="tuesdayyMorManager" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; }?></label>                  
            <?php  endforeach;  ?>    
             <input type="hidden" value="שלישי" name="day[]">
            <input type="hidden" value="בוקר" name="time[]"> 
        </td>
        <td>
            <?php if ($wednesdayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($wednesday_morning as $shift):?>
            <?php if($shift['job'] == "אחמש"){?>
           
            <br><label><input class="wednesdayMorManager" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; } ?></label>                  
            <?php  endforeach;  ?>   
             <input type="hidden" value="רביעי" name="day[]">
            <input type="hidden" value="בוקר" name="time[]"> 
        </td>
        <td>
           <?php if ($thursdayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($thursday_morning as $shift):?>
            <?php if($shift['job'] == "אחמש"){?>
           
            <br><label><input class="thursdayMorManager" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; }?></label>                 
            <?php  endforeach;  ?>      
              <input type="hidden" value="חמישי" name="day[]">
            <input type="hidden" value="בוקר" name="time[]">
        </td>
        <td>
           <?php if ($fridayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($friday_morning as $shift):?>
            <?php if($shift['job'] == "אחמש"){?>
                   
            <br><label><input class="fridayMorManager" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; }?></label>                 
            <?php  endforeach;  ?>
             <input type="hidden" value="שישי" name="day[]">
            <input type="hidden" value="בוקר" name="time[]">        
        </td>
        <td>
           <?php if ($saturdayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($saturday_morning as $shift):?>
            <?php if($shift['job'] == "אחמש"){?>
               
            <br><label><input class="saturdayMorManager" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname'];} ?></label>                  
            <?php  endforeach;  ?>    
             <input type="hidden" value="שבת" name="day[]">
            <input type="hidden" value="בוקר" name="time[]">          
        </td>
    </tr>
    
    <tr class="waiter">
        <td rowspan="4" style="background-color:lightgray;"><b>ערב</b></td>
            <td>מלצרות</td>
            <td>
               <?php if ($sundayfreeDay === true){
                echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
                }?>
                <?php
                foreach ($sunday_evening as $shift):?>
                <?php if($shift['job'] == "מלצרות"){?>
                      
                <br><label><input class="sundayEveWaiter" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
                <?php echo $shift['fullname'];}?></label>                   
                <?php  endforeach;  ?> 
                  <input type="hidden" value="ראשון" name="day[]">
                <input type="hidden" value="ערב" name="time[]">       
            </td>
            <td>
                <?php if ($mondayfreeDay === true){
                echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
                }?>
                <?php
                foreach ($monday_evening as $shift):?>
                <?php if($shift['job'] == "מלצרות"){?>
               
                <br><label><input class="mondayEveWaiter" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
                <?php echo $shift['fullname'];}?></label>
                <?php  endforeach;  ?>
                 <input type="hidden" value="שני" name="day[]">
                <input type="hidden" value="ערב" name="time[]">
            </td>
            <td>
                <?php if ($tuesdayfreeDay === true){
                echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
                }?>
                <?php
                foreach ($tuesday_evening as $shift):?>
                <?php if($shift['job'] == "מלצרות"){?>
               
                <br><label><input class="tuesdayEveWaiter" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
                <?php echo $shift['fullname']; }?></label>                   
                <?php  endforeach;  ?>    
                 <input type="hidden" value="שלישי" name="day[]">
                <input type="hidden" value="ערב" name="time[]">
            </td>
            <td>
                <?php if ($wednesdayfreeDay === true){
                echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
                }?>
                <?php
                foreach ($wednesday_evening as $shift):?>
                <?php if($shift['job'] == "מלצרות"){?>
               
                <br><label><input class="wednesdayEveWaiter" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
                <?php echo $shift['fullname']; }?></label>    
                <?php  endforeach;  ?>
                 <input type="hidden" value="רביעי" name="day[]">
                <input type="hidden" value="ערב" name="time[]">
                
            </td>
            <td>
                <?php if ($thursdayfreeDay === true){
                echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
                }?>
                <?php
                foreach ($thursday_evening as $shift):?>
                <?php if($shift['job'] == "מלצרות"){?>
                
                <br><label><input class="thursdayEveWaiter" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
                <?php echo $shift['fullname'];}?></label>                   
                <?php  endforeach;  
                for ($i=0; $i<2;$i++){
                echo            

                '<input type="hidden" value="חמישי" name="day[]">
                <input type="hidden" value="ערב" name="time[]">';
                }?>
            </td>
            <td>
                <?php if ($fridayfreeDay === true){
                echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
                }?>
                <?php
                foreach ($friday_evening as $shift):?>
                <?php if($shift['job'] == "מלצרות"){?>
               
                <br><label><input class="fridayEveWaiter" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
                <?php echo $shift['fullname'];}?></label>                   
                <?php  endforeach;  
                for ($i=0; $i<2;$i++){
                echo            
                    '<input type="hidden" value="שישי" name="day[]">
                    <input type="hidden" value="ערב" name="time[]">';
                }?>
            </td>
            <td>
                <?php if ($saturdayfreeDay === true){
                echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
                }?>
                <?php
                foreach ($saturday_evening as $shift):?>
                <?php if($shift['job'] == "מלצרות"){?>
                
                <br><label><input class="saturdayEveWaiter" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
                <?php echo $shift['fullname'];}?></label>
                <?php  endforeach;  
                for ($i=0; $i<2;$i++){
                echo            
                    '<input type="hidden" value="שבת" name="day[]">
                    <input type="hidden" value="ערב" name="time[]">';
                }?>
            </td>
    </tr>
    <tr class="bar">
        <td>בר</td>
        <td>
           <?php if ($sundayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($sunday_evening as $shift):?>
            <?php if($shift['job'] == "בר"){?>
                    
            <br><label><input class="sundayEveBar" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname'];}?></label>                   
            <?php  endforeach;  ?>    
             <input type="hidden" value="ראשון" name="day[]">
            <input type="hidden" value="ערב" name="time[]">      
        </td>
        <td>
            <?php if ($mondayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($monday_evening as $shift):?>
            <?php if($shift['job'] == "בר"){?>
           
            <br><label><input class="mondayEveBar"type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname'];}?></label>
            <?php  endforeach;  ?>
             <input type="hidden" value="שני" name="day[]">
            <input type="hidden" value="ערב" name="time[]">
        </td>
        <td>
            <?php if ($tuesdayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($tuesday_evening as $shift):?>
            <?php if($shift['job'] == "בר"){?>
          
            <br><label><input class="tuesdayEveBar" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; }?></label>                   
            <?php  endforeach;  ?>   
            <input type="hidden" value="שלישי" name="day[]">
            <input type="hidden" value="ערב" name="time[]">
        </td>
        <td>
            <?php if ($wednesdayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($wednesday_evening as $shift):?>
            <?php if($shift['job'] == "בר"){?>
            
            <br><label><input class="wednesdayEveBar" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; }?></label>    
            <?php  endforeach;  ?>
            <input type="hidden" value="רביעי" name="day[]">
            <input type="hidden" value="ערב" name="time[]">

        </td>
        <td>
            <?php if ($thursdayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($thursday_evening as $shift):?>
            <?php if($shift['job'] == "בר"){?>
           
            <br><label><input class="thursdayEveBar" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname'];}?></label>                   
            <?php  endforeach;  
            for ($i=0; $i<2;$i++){
                echo            
            '<input type="hidden" value="חמישי" name="day[]">
            <input type="hidden" value="ערב" name="time[]">';
            }?>
        </td>
        <td>
            <?php if ($fridayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($friday_evening as $shift):?>
            <?php if($shift['job'] == "בר"){?>
            
            <br><label><input class="fridayEveBar" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname'];}?></label>                   
            <?php  endforeach;    
            for ($i=0; $i<2;$i++){
                echo    
                '<input type="hidden" value="שישי" name="day[]">
            <input type="hidden" value="ערב" name="time[]">';
            }?>

        </td>
        <td>
            <?php if ($saturdayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($saturday_evening as $shift):?>
            <?php if($shift['job'] == "בר"){?>
           
            <br><label><input class="saturdayEveBar" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname'];}?></label>
            <?php  endforeach;  
            for ($i=0; $i<2;$i++){
                echo            

             '<input type="hidden" value="שבת" name="day[]">
            <input type="hidden" value="ערב" name="time[]">';
            }?>
        </td>
    </tr>
    <tr class="hosting">
        <td>אירוח</td>
        <td>
           <?php if ($sundayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($sunday_evening as $shift):?>
            <?php if($shift['job'] == "אירוח"){?>
                   
            <br><label><input class="sundayEveHost" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname'];}?></label>                   
            <?php  endforeach;  ?> 
             <input type="hidden" value="ראשון" name="day[]">
            <input type="hidden" value="ערב" name="time[]">       
        </td>
        <td>
            <?php if ($mondayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($monday_evening as $shift):?>
            <?php if($shift['job'] == "אירוח"){?>
           
            <br><label><input class="mondayEveHost" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname'];}?></label>
            <?php  endforeach;  ?>
             <input type="hidden" value="שני" name="day[]">
            <input type="hidden" value="ערב" name="time[]">
        </td>
        <td>
            <?php if ($tuesdayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($tuesday_evening as $shift):?>
            <?php if($shift['job'] == "אירוח"){?>
           
            <br><label><input class="tuesdayEveHost" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; }?></label>                   
            <?php  endforeach;  ?>   
             <input type="hidden" value="שלישי" name="day[]">
            <input type="hidden" value="ערב" name="time[]">
        </td>
        <td>
            <?php if ($wednesdayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($wednesday_evening as $shift):?>
            <?php if($shift['job'] == "אירוח"){?>
          
            <br><label><input class="wednesdayEveHost" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname']; }?></label>    
            <?php  endforeach;  ?>
              <input type="hidden" value="רביעי" name="day[]">
            <input type="hidden" value="ערב" name="time[]">

        </td>
        <td>
            <?php if ($thursdayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($thursday_evening as $shift):?>
            <?php if($shift['job'] == "אירוח"){?>
           
            <br><label><input class="thursdayEveHost" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname'];}?></label>                   
            <?php  endforeach;  ?>   
             <input type="hidden" value="חמישי" name="day[]">
            <input type="hidden" value="ערב" name="time[]">
        </td>
        <td>
            <?php if ($fridayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($friday_evening as $shift):?>
            <?php if($shift['job'] == "אירוח"){?>
           
            <br><label><input class="fridayEveHost" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname'];}?></label>                   
            <?php  endforeach;  ?>   
             <input type="hidden" value="שישי" name="day[]">
            <input type="hidden" value="ערב" name="time[]">
        </td>
        <td>
            <?php if ($saturdayfreeDay === true){
            echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
            }?>
            <?php
            foreach ($saturday_evening as $shift):?>
            <?php if($shift['job'] == "אירוח"){?>
           
            <br><label><input class="saturdayEveHost" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
            <?php echo $shift['fullname'];}?></label>
            <?php  endforeach;  ?>
             <input type="hidden" value="שבת" name="day[]">
            <input type="hidden" value="ערב" name="time[]">
        </td>
    </tr>
    <tr class="manager">
        <td>אחמ"ש</td>
            <td>
            <?php if ($sundayfreeDay === true){
             echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
             }?>
             <?php
             foreach ($sunday_evening as $shift):?>
             <?php if($shift['job'] == "אחמש"){?>
                    
             <br><label><input class="sundayEveManager" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
             <?php echo $shift['fullname'];}?></label>                   
             <?php  endforeach;  ?>     
              <input type="hidden" value="ראשון" name="day[]">
             <input type="hidden" value="ערב" name="time[]">       
         </td>
         <td>
             <?php if ($mondayfreeDay === true){
             echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
             }?>
             <?php
             foreach ($monday_evening as $shift):?>
             <?php if($shift['job'] == "אחמש"){?>
            
             <br><label><input class="mondayEveManager" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
             <?php echo $shift['fullname'];}?></label>
             <?php  endforeach;  ?>
              <input type="hidden" value="שני" name="day[]">
             <input type="hidden" value="ערב" name="time[]">
         </td>
         <td>
             <?php if ($tuesdayfreeDay === true){
             echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
             }?>
             <?php
             foreach ($tuesday_evening as $shift):?>
             <?php if($shift['job'] == "אחמש"){?>
            
             <br><label><input class="tuesdayEveManager" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
             <?php echo $shift['fullname']; }?></label>                   
             <?php  endforeach;  ?>    
              <input type="hidden" value="שלישי" name="day[]">
             <input type="hidden" value="ערב" name="time[]">
         </td>
         <td>
             <?php if ($wednesdayfreeDay === true){
             echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
             }?>
             <?php
             foreach ($wednesday_evening as $shift):?>
             <?php if($shift['job'] == "אחמש"){?>
            
             <br><label><input class="wednesdayEveManager" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
             <?php echo $shift['fullname']; }?></label>    
             <?php  endforeach;  ?>
              <input type="hidden" value="רביעי" name="day[]">
             <input type="hidden" value="ערב" name="time[]">

         </td>
         <td>
             <?php if ($thursdayfreeDay === true){
             echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
             }?>
             <?php
             foreach ($thursday_evening as $shift):?>
             <?php if($shift['job'] == "אחמש"){?>
            
             <br><label><input class="thursdayEveManager" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
             <?php echo $shift['fullname'];}?></label>                   
             <?php  endforeach;  ?>        
              <input type="hidden" value="חמישי" name="day[]">
             <input type="hidden" value="ערב" name="time[]">
         </td>
         <td>
             <?php if ($fridayfreeDay === true){
             echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
             }?>
             <?php
             foreach ($friday_evening as $shift):?>
             <?php if($shift['job'] == "אחמש"){?>
           
             <br><label><input class="fridayEveManager" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
             <?php echo $shift['fullname'];}?></label>                   
             <?php  endforeach;  ?>    
               <input type="hidden" value="שישי" name="day[]">
             <input type="hidden" value="ערב" name="time[]">
         </td>
         <td>
             <?php if ($saturdayfreeDay === true){
             echo '<label  style="color:MediumAquaMarine"><input type="checkbox" name="worker_name[]" id="holiday" value="חופש"> חופש</label>';
             }?>
             <?php
             foreach ($saturday_evening as $shift):?>
             <?php if($shift['job'] == "אחמש"){?>
            
             <br><label><input class="saturdayEveManager" type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
             <?php echo $shift['fullname'];}?></label>
             <?php  endforeach;  ?>
              <input type="hidden" value="שבת" name="day[]">
             <input type="hidden" value="ערב" name="time[]">
         </td>
    </tr>
    </table>
    <input type="submit" class="submit-btn" value="שלח">
    <?php echo form_close()?>

<hr class="line">
<form class="holidays">
    <p> הכנס מספר חודש על מנת לבדוק האם ישנם חגים ומועדים:
        <input type="text" name="month">
        <button class="submit-btn" type="submit"> בדוק </button>
    </p>
    <?php
        if ($_GET){
        $urlContents = "https://www.hebcal.com/hebcal/?v=1&cfg=json&maj=on&min=on&mod=on&nx=on&year=now&month=".urlencode($_GET['month'])."&mf=on&geonameid=6255147&lg=h";
        $data = file_get_contents($urlContents);
        $calArray = json_decode($data, true);
    ?>
    <div class="result">
        <h3> החגים / מועדים המתקיימים בחודש זה הם:</h3>   
        <?php
        foreach($calArray['items'] as $holiday){
        $date = $holiday['date'];
        echo $holiday['hebrew'].",  בתאריך: ".date('d-m-Y',strtotime($date))."<br>";
        }
        } else{
            $urlContents = "https://www.hebcal.com/hebcal/?v=1&cfg=json&maj=on&min=on&mod=on&nx=on&year=now&month=now&mf=on&geonameid=6255147&lg=h";
            $data = file_get_contents($urlContents);
            $calArray = json_decode($data, true);
            foreach($calArray['items'] as $holiday){
                $date = $holiday['date'];
            }
        }
    ?>
    </div>
</form>   
</div>
</main>


