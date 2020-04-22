<main>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/userStyle.css"/>

    <div class="card" onclick="edit()"> 
        <h1><?php echo $_SESSION['fullname'];?></h1>
        <p><label> תעודת זהות: </label> <?php echo $_SESSION['id'];?></p>
        <p><label> תפקיד: </label> <?php echo $_SESSION['role'];?></p>
        <p><label> מפר טלפון: </label> <?php echo $_SESSION['phone'];?></p>
        <p><label> דואר אלקטרוני: </label> <?php echo $_SESSION['email'];?></p>
        <p><label> תאריך תחילת העסקה: </label> <?php echo $_SESSION['start_working'];?></p>
    </div>
     
<!--    <div class="edit">
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

    </div>-->
</main>

<script>
    function edit(){
        alert("hi");
    }
</script>