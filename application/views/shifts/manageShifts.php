<main>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/shiftsStyle.css"/>

<div class="warp">
<p id="error"><?php
    if (isset($error)) {
        echo $error['message'];
    }
    ?> 
</p>    

<?php echo form_open('Shifts/saveFinalShifts'); ?>
<!--    <h2><?php echo $title; ?></h2>-->
<table class="manage">
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
    <tr>
        <td><b>בוקר</b></td>         
        <td>
            <?php
            foreach ($sunday_morning as $shift):?>
            <br><label><input type="checkbox" name="sunday" value="<?php echo $shift['fullname'];?>">
                <?php echo $shift['fullname'];
                ?></label>
            <?php  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($monday_morning as $shift):?>
            <br><label><input type="checkbox" name="monday" value="<?php echo $shift['fullname'];?>">
                <?php echo $shift['fullname'];
                ?></label>
            <?php  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($tuesday_morning as $shift):?>
            <br><label><input type="checkbox" name="tuesday" value="<?php echo $shift['fullname'];?>">
                <?php echo $shift['fullname'];
                ?></label>
            <?php  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($wednesday_morning as $shift):?>
            <br><label><input type="checkbox" name="wednesday" value="<?php echo $shift['fullname'];?>">
                <?php echo $shift['fullname'];
                ?></label>
            <?php  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($thursday_morning as $shift):?>
            <br><label><input type="checkbox" name="thursday" value="<?php echo $shift['fullname'];?>">
                <?php echo $shift['fullname'];
                ?></label>
            <?php  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($friday_morning as $shift):?>
            <br><label><input type="checkbox" name="friday" value="<?php echo $shift['fullname'];?>">
                <?php echo $shift['fullname'];
                ?></label>
            <?php  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($saturday_morning as $shift):?>
            <br><label><input type="checkbox" name="saturday" value="<?php echo $shift['fullname'];?>">
                <?php echo $shift['fullname'];
                ?></label>
            <?php  endforeach;  ?>
        </td>
    </tr>
    <tr>
        <td><b>ערב</b></td>
        <td>
            <?php
            foreach ($sunday_evening as $shift):?>
            <br><label><input type="checkbox" name="sunday" value="<?php echo $shift['fullname'];?>">
                <?php echo $shift['fullname'];
                ?></label>
            <?php  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($monday_evening as $shift):?>
            <br><label><input type="checkbox" name="monday" value="<?php echo $shift['fullname'];?>">
                <?php echo $shift['fullname'];
                ?></label>
            <?php  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($tuesday_evening as $shift):?>
            <br><label><input type="checkbox" name="tuesday" value="<?php echo $shift['fullname'];?>">
                <?php echo $shift['fullname'];
                ?></label>
            <?php  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($wednesday_evening as $shift):?>
            <br><label><input type="checkbox" name="wednesday" value="<?php echo $shift['fullname'];?>">
                <?php echo $shift['fullname'];
                ?></label>
            <?php  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($thursday_evening as $shift):?>
            <br><label><input type="checkbox" name="thursday" value="<?php echo $shift['fullname'];?>">
                <?php echo $shift['fullname'];
                ?></label>
            <?php  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($friday_evening as $shift):?>
            <br><label><input type="checkbox" name="friday" value="<?php echo $shift['fullname'];?>">
                <?php echo $shift['fullname'];
                ?></label>
            <?php  endforeach;  ?>
        </td>
        <td>
            <?php
            foreach ($saturday_evening as $shift):?>
            <br><label><input type="checkbox" name="saturday" value="<?php echo $shift['fullname'];?>">
                <?php echo $shift['fullname'];
                ?></label>
            <?php  endforeach;  ?>
        </td>
</tr>   
</table>
    <span>
        <!--<input id="ss" type="button" class="button" name="submit" value="שלח">-->
        <!--<button class="button" type="submit">שלח</button>-->
    </span>
<input type="submit" value="שלח">
<!--    <span id="sending">
     <button type="submit">שלח</button>
    </span>-->
 
<!--    <div class="send">
        <button type="submit">שלח</button>
<input type="button" class="button" name="submit" value="שלח">
    </div>
     
</div>

</main>

<script>
//    $(document).ready(function(){
//    $("input[type='button']").on('click', function(){
       
//      $("#ss").click(function () {
////           event.preventDefault();
////        $("#radio_submit").click(function (e) {      
//            var sunday = $('input:checkbox[name=sunday]:checked').val();
//            var monday = $('input:checkbox[name=monday]:checked').val();
//            var tuesday = $('input:checkbox[name=tuesday]:checked').val();
//            var wednesday = $('input:checkbox[name=wednesday]:checked').val();
//            var thursday = $('input:checkbox[name=thursday]:checked').val();
//            var friday = $('input:checkbox[name=friday]:checked').val();
//            var saturday = $('input:checkbox[name=saturday]:checked').val();
//            $.ajax({
//                type: 'POST',
//                url: "<?php echo site_url(); ?>" + "/Shifts/saveShifts",
//                data: {sunday: sunday, monday:monday, tuesday:tuesday, wednesday:wednesday, thursday:thursday, friday:friday, saturday:saturday},
//                error: function () {
//                    alert('משהו השתבש, אנא נסה שנית');
//                },
//                success: function (data) {
//                    if (data === "") {
//                        alert("המשמרות נשלחו בהצלחה");
//                        window.location.href = "<?php echo site_url('Pages/index'); ?>";
//                    }
//                    else {
//                        $("#error").html(data);
//                    }
//                }
//            });
//        });
//    });



</script>
