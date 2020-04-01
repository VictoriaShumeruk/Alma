<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/formStyle.css"/>
<div class="form">
<p id="error"><?php
    if (isset($error)) {
        echo $error['message'];
    }
    ?> </p>

<?php echo form_open('Login/save'); ?>
    <h2><?php echo $title; ?></h2>
    
    <input type="text" id="fullname" name="user" required> <label>:שם מלא</label>
    
    <input type="number" id="id" name="user" required> <label> :תעודת זהות  </label>
    
    <select class="s" id="role" name="user" required> 
        <option value="מנהל">מנהל</option>
        <option value="עובד">עובד</option>
    </select>
   <label>:תפקיד</label>
   
<!--    <input type="text" id="role" name="user" placeholder="עובד / מנהל" required> <label>:תפקיד </label>
   -->
    <input type="number" id="phone" name="user" required>  <label>:מספר טלפון  </label>
    
    <input type="email" id="email" name="user" required><label>:אימייל  </label>
   
    <input type="password" id="password" name="password" >  <label>:סיסמא  </label>
    
    <input id="reg" type="button" value="שלח" class="button" name="submit">
<?php echo form_close(); ?>   
</div>

<script>
    $("#reg").click(function () {
        
            var fullname = $("#fullname").val();
            var id = $("#id").val();
            var role = $("#role").val();
            var phone = $("#phone").val();
            var email = $("#email").val();
            var password = $("#password").val();
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url(); ?>" + "/Login/save",
                data: {fullname: fullname, id:id, role:role, phone:phone, email:email, password:password},
                error: function () {
                    alert('Something went wrong, please try again');
                },
                success: function (data) {
                    if (data === "") {
                        alert("ההרשמה בוצעה בהצלחה");
                        window.location.href = "<?php echo site_url('Login/login'); ?>";
                    }
                    else {
                        $("#error").html(data);
                    }
                }
            });
        
    });
</script>