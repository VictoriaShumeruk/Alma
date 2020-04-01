<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/formStyle.css"/>
<div class="form"> 
    <p id="error">
        <?php
        if (isset($error)) {
            echo $error['message'];
        }
        ?>
    </p>
    <?php echo form_open('Login/auth'); ?>
    <input type="text" id="id" name="id" placeholder="הכנס תז" autocomplete="on" required><label>:תעודת זהות </label>
    <input type="password" id="password" name="password" placeholder="הכנס סיסמא" required ><label> :סיסמא </label>
    
    <input class="button" id="submit" type="submit" value="התחברות" name="submit">
    <input class="button" id="register" type="button" value="הרשמה" name="register" onclick="window.location = '<?php echo site_url(); ?>/Login/register'">
   
</div>