<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/formStyle.css"/>
<div class="form"> 
    <p id="error">
        <?php
        if (isset($error)) {
            echo $error;
        }
        ?>
    </p>
    <?php echo form_open('User/auth'); ?>
    <h2><?php echo $title; ?></h2>
    
    <label>תעודת זהות </label><input type="text" id="id" name="id" placeholder="הכנס תז" autocomplete="on" required>
    <label> סיסמא </label><input type="password" id="password" name="password" placeholder="הכנס סיסמא" required >
    
    <input class="button" id="submit" type="submit" value="התחברות" name="submit">
    
    <div class="reg"> עובד חדש ? לחץ להירשם למערכת :) 
    <input id="register" type="button" value="הרשמה" name="register" onclick="window.location = '<?php echo site_url(); ?>/User/register'">
   </div>
</div>