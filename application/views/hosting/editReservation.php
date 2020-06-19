<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/tableMapStyle.css">
<script src="<?php echo base_url();?>/assets/js/tableMap.js"></script>
<div class="edit">
           
                <?php echo form_open('Hosting/edit'."/".$reservation['id']); ?>
                   
                    <input type="hidden"  name="id" value="<?php echo $reservation['id'];?>">
                    <label class="control-label" for="tnum">מספר שולחן</label>
                        <select type="number" id="tnum1" name="num" >
                            <?php for ($i = 2; $i <= 9; $i++) : ?>
                                <option id="in" value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?></select>
                        <select type="number" id="tnum2" name="num" style="display: none;" >
                                <?php for ($i = 12; $i <= 23; $i++) : ?>
                                <option id="out" value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?></select>
                        <select type="number" id="tnum3" name="num" style="display: none;">
                                <?php for ($i = 32; $i <= 35; $i++) : ?>
                                <option id="tr" value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select><br>
                      
                    <label class="control-label" for="loc">אזור</label>
                        <select style="width: 300px;" id="loc" name="location"  style="width:100%;" onchange="change_tnum(this.value)" required>
                            <option value="פנים" >פנים</option>
                            <option value="חוץ" >חוץ</option>
                            <option value="טרסה" >טרסה</option>
                    </select><br>
                    
                  
                    <label for="dine">מס' סועדים</label>
                        <input type="number" name="diners" id="dine" min='1' max='30' value="<?php echo $reservation['diners']; ?>"><br>
<!--                            <div><?php echo $error['dine']; ?>   </div>  -->
                    <label for="date">תאריך</label>
                    <input type="date" id="date" name="re_date" style="margin-left: 0;"
                        min="2020-01-01" max="2020-12-31" value="<?php echo date('Y-m-d', strtotime($reservation['re_date'])); ?>"><br>   
<!--                            <div><?php echo  $error['date']; ?>   </div>-->
                    <label for="time">שעה</label>
                        <input type="time" id="time" name="re_time" value="<?php echo date('H:i', strtotime($reservation['re_time'])); ?>"><br>
<!--                    <div><?php echo $error['time']; ?> </div>-->
                    
                    <fieldset><legend visible="true">פרטי איש קשר</legend>
                        <label for="phone">מספר טלפון</label>
                    <input type="number" maxlength="10" id="phone" name="phonenumber" value="<?php echo $reservation['phonenumber']; ?>"><br>
<!--                    <div><?php echo $error['phone']; ?> </div>-->
                    
                    <label for="name">שם פרטי ומשפחה</label>
                    <input type="text" id="name" name="fullname" value="<?php echo $reservation['fullname']; ?>"><br></fieldset>
<!--                    <div><?php echo $error['fullname'];?> </div>-->
                        <button style="width: 50%;"type="submit" id="edit" value="שמור שינויים">שמור שינויים</button>
                    
        <?php echo form_close();?>

        </div>

