<main>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/shiftsStyle.css"/>

<div class="warp">
<p id="error"><?php
    if (isset($error)) {
        echo $error['message'];
    }
    ?> 
</p>    

<?php echo form_open('Shifts/saveShifts'); ?>
<!--    <h2><?php echo $title; ?></h2>-->

<table>
    <tr>
        <th>יום ראשון</th>
        <th>יום שני</th>
        <th>יום שלישי</th>
        <th>יום רביעי</th>
        <th>יום חמישי</th>
        <th>יום שישי</th>
        <th>יום שבת</th>        
    </tr>
    
    <tr>
        <td> 
            <input type="hidden" value="ראשון" name="day[]">
            <select name="time[]" required>
                <option disabled selected value=""> בחר סוג משמרת</option>
                <option value="בוקר">בוקר</option>
                <option value="ערב">ערב</option>
                <option value="כפולה">כפולה</option>
                <option value="חופש">חופש</option>         
            </select>
        </td>
        
        <td>
            <input type="hidden" value="שני" name="day[]">   
            <select name="time[]" required>
                <option disabled selected value=""> בחר סוג משמרת</option>
                <option value="בוקר">בוקר</option>
                <option value="ערב">ערב</option>
                <option value="כפולה">כפולה</option>
                <option value="חופש">חופש</option>
            </select>
        </td>
        
        <td>
            <input type="hidden" value="שלישי" name="day[]">
            <select name="time[]" required>
                <option disabled selected value=""> בחר סוג משמרת</option>
                <option value="בוקר">בוקר</option>
                <option value="ערב">ערב</option>
                <option value="כפולה">כפולה</option>
                <option value="חופש">חופש</option>
            </select>
        </td>
        
        <td>
            <input type="hidden" value="רביעי" name="day[]">  
            <select name="time[]" required>
                <option disabled selected value=""> בחר סוג משמרת</option>
                <option value="בוקר">בוקר</option>
                <option value="ערב">ערב</option>
                <option value="כפולה">כפולה</option>
                <option value="חופש">חופש</option>
            </select>
        </td>
        
        <td>
            <input type="hidden" value="חמישי" name="day[]">
            <select name="time[]" required>
                <option disabled selected value=""> בחר סוג משמרת</option>
                <option value="בוקר">בוקר</option>
                <option value="ערב">ערב</option>
                <option value="כפולה">כפולה</option>
                <option value="חופש">חופש</option>
            </select>
        </td>
        
        <td>
            <input type="hidden" value="שישי" name="day[]">   
           <select name="time[]" required>
                <option disabled selected value=""> בחר סוג משמרת</option>
                <option value="בוקר">בוקר</option>
                <option value="ערב">ערב</option>
                <option value="כפולה">כפולה</option>
                <option value="חופש">חופש</option>
            </select>
        </td>
        
        <td>
            <input type="hidden" value="שבת" name="day[]"> 
           <select name="time[]" required>
                <option disabled selected value=""> בחר סוג משמרת</option>
                <option value="בוקר">בוקר</option>
                <option value="ערב">ערב</option>
                <option value="כפולה">כפולה</option>
                <option value="חופש">חופש</option>
            </select>
        </td>
        
    </tr> 
</table>

        <span>
        <!--<input id="ss" type="button" value="שלח" class="button" name="submit">-->
        </span>

<!--<button value="Click Me!" onclick="suForms()"></button>-->
<button type="submit">שלח</button>

    <!--</div>-->
</div>


</main>

<script>
//             $("#ss").click(function () {       
//            var sunday = $('input:radio[name=time[]]:checked').val();
//            var monday = $('input:radio[name=time[]]:checked').val();
////            var tuesday = $('input:radio[name=tuesday]:checked').val();
////            var wednesday = $('input:radio[name=wednesday]:checked').val();
////            var thursday = $('input:radio[name=thursday]:checked').val();
////            var friday = $('input:radio[name=friday]:checked').val();
////            var saturday = $('input:radio[name=saturday]:checked').val();
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
//        
//$( document ).ready(function() {
//    swal({
//    title: "תזכורת",
//    text: " עלייך להגיש לפחות שלוש משמרות באמצע שבוע ואחת בסופש",
//    icon: "info",
//    button: "הבנתי:) ",
//});});

</script>

