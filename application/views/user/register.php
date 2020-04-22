<main>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/formStyle.css"/>
<div class="form">
<p id="error"><?php
    if (isset($error)) {
        echo $error['message'];
    }
    ?> 
</p>
<?php echo form_open('User/save'); ?>
    <h2><?php echo $title; ?></h2>
    
    <label>שם מלא</label><input type="text" id="fullname" name="user" required> 
    
    <label>  תעודת זהות </label><input type="number" id="id" name="user" required> 
    
     <label>תפקיד</label>
    <select class="s" id="role" name="user" required> 
        <option hidden> בחר תפקיד </option>
        <option value="מנהל">מנהל</option>
        <option value="עובד">עובד</option>
    </select>
  
   
    <label>מספר טלפון  </label><input type="number" id="phone" name="user" required>  
    
    <label>אימייל  </label><input type="email" id="email" name="user" required>
   
    <label>סיסמא  </label><input type="password" id="password" name="user" >  
    
    <input id="reg" type="button" value="שלח" class="button" name="submit">
 
</div>
</main>

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
                url: "<?php echo site_url(); ?>" + "/User/save",
                data: {fullname: fullname, id:id, role:role, phone:phone, email:email, password:password},
                error: function () {
                    swal("","משהו השתבש, אנא נסה שנית","error");
                },
                success: function (data) {
                    if (data === "") {
                        swal("","ההרשמה בוצעה בהצלחה","success");
                        window.location.href = "<?php echo site_url('User/login'); ?>";
                    }
                    else {
                        $("#error").html(data);
                    }
                }
            });
        
    });
</script>