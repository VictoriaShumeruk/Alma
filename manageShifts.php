<main>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/shiftsStyle.css"/>
<form class="holidays">
    <p> הכנס מספר חודש על מנת לבדוק האם ישנם חגים ומועדים:
    <input type="text" name="month">
    <button class="submit-btn" type="submit"> בדוק </button>
    </p>
    <?php
    $cal =NULL;
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
        echo $holiday['hebrew'].",  בתאריך: ".date('d-m-y',strtotime($date)).".<br>";
        }
    }?>            
    </div>
</form>   
<div class="warp">    
<?php echo form_open('Shifts/savefinalShifts'); ?>

    <?php if($this->session->flashdata('error')){?>
        <div class="alert alert-danger">
            <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>-->
                <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php } ?>
    <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success">
          <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>-->
            <strong><?php echo $this->session->flashdata('success'); ?></strong>
        </div>
    <?php } ?>
   
    <table class="manage">
        <tr>
            <th class="date">           
                <input type="week" name="week" min="2020-W01" max="2020-W52">                         
            </th>
            <th>יום ראשון</th>
            <th>יום שני</th>
            <th>יום שלישי</th>
            <th>יום רביעי</th>
            <th>יום חמישי</th>
            <th>יום שישי</th>
            <th>יום שבת</th>        
        </tr>
        <tr>
            <td><b>בוקר</b></td>         
            <td>
                <input type="hidden" value="ראשון" name="day[]">
                <input type="hidden" value="בוקר" name="time[]">
                <?php
                foreach ($sunday_morning as $shift):?>
                <br><label><input type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
                    <?php echo $shift['fullname'];
                    ?></label>
                <?php  endforeach;  ?>
            </td>
            <td>
                <input type="hidden" value="שני" name="day[]">
                <input type="hidden" value="בוקר" name="time[]">
                <?php
                foreach ($monday_morning as $shift):?>
                <br><label><input type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
                    <?php echo $shift['fullname'];
                    ?></label>
                <?php  endforeach;  ?>
            </td>
            <td>
                <input type="hidden" value="שלישי" name="day[]">
                <input type="hidden" value="בוקר" name="time[]">
                <?php
                foreach ($tuesday_morning as $shift):?>
                <br><label><input type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
                    <?php echo $shift['fullname'];
                    ?></label>
                <?php  endforeach;  ?>
            </td>
            <td>
                <input type="hidden" value="רביעי" name="day[]">
                <input type="hidden" value="בוקר" name="time[]">
                <?php
                foreach ($wednesday_morning as $shift):?>
                <br><label><input type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
                    <?php echo $shift['fullname'];
                    ?></label>
                <?php  endforeach;  ?>
            </td>
            <td>
                <input type="hidden" value="חמישי" name="day[]">
                <input type="hidden" value="בוקר" name="time[]">
                <?php
                foreach ($thursday_morning as $shift):?>
                <br><label><input type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
                    <?php echo $shift['fullname'];
                    ?></label>
                <?php  endforeach;  ?>
            </td>
            <td>
                <input type="hidden" value="שישי" name="day[]">
                <input type="hidden" value="בוקר" name="time[]">
                <?php
                foreach ($friday_morning as $shift):?>
                <br><label><input type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
                    <?php echo $shift['fullname'];
                    ?></label>
                <?php  endforeach;  ?>
            </td>
            <td>
                <input type="hidden" value="שבת" name="day[]">
                <input type="hidden" value="בוקר" name="time[]">
                <?php
                foreach ($saturday_morning as $shift):?>
                <br><label><input type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
                    <?php echo $shift['fullname'];
                    ?></label>
                <?php  endforeach;  ?>
            </td>
        </tr>
        <tr>
            <td><b>ערב</b></td>
            <td>
                <input type="hidden" value="ראשון" name="day[]">
                <input type="hidden" value="ערב" name="time[]">
                <?php
                foreach ($sunday_evening as $shift):?>
                <br><label><input type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
                    <?php echo $shift['fullname'];
                    ?></label>
                <?php  endforeach;  ?>
            </td>
            <td>
                <input type="hidden" value="שני" name="day[]">
                <input type="hidden" value="ערב" name="time[]">
                <?php
                foreach ($monday_evening as $shift):?>
                <br><label><input type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
                    <?php echo $shift['fullname'];
                    ?></label>
                <?php  endforeach;  ?>
            </td>
            <td>
                <input type="hidden" value="שלישי" name="day[]">
                <input type="hidden" value="ערב" name="time[]">
                <?php
                foreach ($tuesday_evening as $shift):?>
                <br><label><input type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
                    <?php echo $shift['fullname'];
                    ?></label>
                <?php  endforeach;  ?>
            </td>
            <td>
                <input type="hidden" value="רביעי" name="day[]">
                <input type="hidden" value="ערב" name="time[]">
                <?php
                foreach ($wednesday_evening as $shift):?>
                <br><label><input type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
                    <?php echo $shift['fullname'];
                    ?></label>
                <?php  endforeach;  ?>
            </td>
            <td>
                <input type="hidden" value="חמישי" name="day[]">
                <input type="hidden" value="ערב" name="time[]">
                <?php
                foreach ($thursday_evening as $shift):?>
                <br><label><input type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
                    <?php echo $shift['fullname'];
                    ?></label>
                <?php  endforeach;  ?>
            </td>
            <td>
                <input type="hidden" value="שישי" name="day[]">
                <input type="hidden" value="ערב" name="time[]">
                <?php
                foreach ($friday_evening as $shift):?>
                <br><label><input type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
                    <?php echo $shift['fullname'];
                    ?></label>
                <?php  endforeach;  ?>
            </td>
            <td>
                <input type="hidden" value="שבת" name="day[]">
                <input type="hidden" value="ערב" name="time[]">
                <?php
                foreach ($saturday_evening as $shift):?>
                <br><label><input type="checkbox" name="worker_name[]" value="<?php echo $shift['fullname'];?>">
                    <?php echo $shift['fullname'];
                    ?></label>
                <?php  endforeach;  ?>
            </td>
    </tr>   
    </table>


    <input type="submit" class="submit-btn" value="שלח">
</div>

    <!--<button id="submit" type="submit" name="submit" class="submit-btn">שלח </button>        
<!---->

</main>
