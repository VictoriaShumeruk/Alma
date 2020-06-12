
  
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/tableMap.css">
<script src="<?php echo base_url();?>/assets/js/tableMap.js"></script>
<div class="edit">
<?php echo $reservation['id'];?>
           
                <?php echo form_open('Hosting/edit'."/".$reservation['id']); ?>
                   
                    <input type="hidden"  name="id" value="<?php echo $reservation['id'];?>">
                    <label for="tnum">מספר שולחן
                    <select type="number" id="tnum1" name="num" value="<?php echo $reservation['num']; ?>">
                        <?php for ($i = 2; $i <= 9; $i++) : ?>
                            <option id="in" value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?></select>
                    <select type="number" id="tnum2" name="num" style="display: none;" value="<?php echo $reservation['num'];?>">
                            <?php for ($i = 12; $i <= 23; $i++) : ?>
                            <option id="out" value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?></select>
                    <select type="number" id="tnum3" name="num" style="display: none;" value="<?php echo $reservation['num'];?>">
                            <?php for ($i = 32; $i <= 35; $i++) : ?>
                            <option id="tr" value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select></label><br>
                      
                    <label for="loc">אזור
                        <select id="loc" name="location"  style="width:100%;"  onchange="change_tnum(this.value)" required>
                            <option value="פנים"<?php if($reservation['location'] == 'פנים'): ?> selected="selected"<?php endif; ?> >פנים</option>
                            <option value="חוץ"<?php if($reservation['location'] == 'חוץ'): ?> selected="selected"<?php endif; ?> >חוץ</option>
                            <option value="טרסה"<?php if($reservation['location'] == 'טרסה'): ?> selected="selected"<?php endif; ?> >טרסה</option>
                    </select></label><br>
                    
                    <label for="dine">מס' סועדים
                        <input type="number" name="diners" id="dine" min='1' max='30' value="<?php echo $reservation['diners']; ?>"></label><br>
<!--                            <div><?php echo $error['dine']; ?>   </div>  -->
                    <label for="date">תאריך
                    <input type="date" id="date" name="re_date" style="margin-left: 0;"
                        min="2020-01-01" max="2020-12-31" value="<?php echo date('Y-m-d', strtotime($reservation['re_date'])); ?>"></label><br>   
<!--                            <div><?php echo  $error['date']; ?>   </div>-->
                    <label for="time">שעה
                        <input type="time" id="time" name="re_time" value="<?php echo date('H:i', strtotime($reservation['re_time'])); ?>"></label><br>
<!--                    <div><?php echo $error['time']; ?> </div>-->
                    
                    <fieldset><legend visible="true">פרטי איש קשר</legend>
                    <label for="phone">מספר טלפון
                    <input type="number" maxlength="10" id="phone" name="phonenumber" value="<?php echo $reservation['phonenumber']; ?>"></label><br>
<!--                    <div><?php echo $error['phone']; ?> </div>-->
                    
                    <label for="name">שם פרטי ומשפחה
                    <input type="text" id="name" name="fullname" value="<?php echo $reservation['fullname']; ?>"></label><br></fieldset>
<!--                    <div><?php echo $error['fullname'];?> </div>-->
                    <input type="submit" name="submit" id="edit" value="שמור שינויים">
                    
        <?php echo form_close();?>

</div>