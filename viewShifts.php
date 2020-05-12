<main>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/shiftsStyle.css"/>

<div class="warp">
    <h1> סידור משמרות עבור שבוע מספר:
        <?php if($this->session->flashdata('week') != null){
            $date=$this->session->flashdata('week');
            echo date("W-Y", strtotime($date));}                            
            else{
            echo date("W-Y"); 
            }
        ?>
    </h1>
    <table class="view">
       
    <tr>
        <th class="date">
            <input type="week" name="week" min="2020-W01" max="2020-W52" 
                   value="<?php echo date("W-Y")?>">
            
            <?php echo form_open('Shifts/form_shiftsDate'); ?>
            
                <input type="week" name="week" min="2020-W01" max="2020-W52" 
                    value="<?php if($this->session->flashdata('week') != null){
                    $date=$this->session->flashdata('week');
                    echo date("W-Y", strtotime($date));}                            
                    else{
                    echo date("W-Y"); 
                    }
            ?>">
            
            <p><button class="submit-btn" type="submit" >בחר</button></p>
            <?php form_close();?> 
        </th>
        <th>יום ראשון</th>
        <th>יום שני</th>
        <th>יום שלישי</th>
        <th>יום רביעי</th>
        <th>יום חמישי</th>
        <th>יום שישי</th>
        <th>יום שבת</th>        
    </tr>
     <?php echo form_open('Shifts/viewShifts'); ?>
        <td><b>בוקר</b>         
        </td>
    
        <td>
           <?php
            foreach ($sunday_morning as $shift):?>
                <?php echo $shift['worker_name'];
                ?><br>
            <?php  endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($monday_morning as $shift):?>
                <?php echo $shift['worker_name'];
                ?>
            <?php  endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($tuesday_morning as $shift):?>
                <?php echo $shift['worker_name'];
                ?>
            <?php  endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($wednesday_morning as $shift):?>
                <?php echo $shift['worker_name'];
                ?>
            <?php  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($thursday_morning as $shift):?>
                <?php echo $shift['worker_name'];
                ?>
            <?php  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($friday_morning as $shift):?>
                <?php echo $shift['worker_name'];
                ?>
            <?php  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($saturday_morning as $shift):?>
                <?php echo $shift['worker_name'];
                ?>
            <?php  endforeach;  ?>
        </td>
    </tr>
    <tr>
        <td><b>ערב</b></td>
        <td>
          <?php
            foreach ($sunday_evening as $shift):?>
                <?php echo $shift['worker_name'];
                ?>
            <?php  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($monday_evening as $shift):?>
                <?php echo $shift['worker_name'];
                ?>
            <?php  endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($tuesday_evening as $shift):?>
                <?php echo $shift['worker_name'];
                ?>
            <?php  endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($wednesday_evening as $shift):?>
                <?php echo $shift['worker_name'];
                ?>
            <?php  endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($thursday_evening as $shift):?>
                <?php echo $shift['worker_name'];
                ?>
            <?php  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($friday_evening as $shift):?>
                <?php echo $shift['worker_name'];
                ?>
            <?php  endforeach;  ?>
        </td>
        <td>
           <?php
            foreach ($saturday_evening as $shift):?>
                <?php echo $shift['worker_name'];
                ?>
            <?php  endforeach;  ?>
        </td>
</tr>       
</table>    
</div>
</main>


