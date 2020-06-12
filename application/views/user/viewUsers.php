<main>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/userStyle.css"/>
<div class="container">
    
    <?php if($this->session->flashdata('error')){?>
    <div class="alert alert-danger">
        <?php echo $this->session->flashdata('error'); ?>
    </div><?php } ?>
    
    <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success">
            <strong><?php echo $this->session->flashdata('success'); ?></strong>
    </div><?php } ?>
    
    
<div class="row">
    <?php foreach ($workers as $worker):
        echo '<div class="card col">';
        echo '<h1>'.$worker['fullname'].'</h1>';
        echo '<p><label> תעודת זהות: </label> '.$worker['id'];
        echo '<p><label> סטטוס: </label> '.$worker['role'];
        echo '<p><label> תפקיד: </label> '.$worker['job'];
        echo '<p><label> מספר טלפון: </label> '.$worker['phone'];
        echo '<p><label> דואר אלקטרוני: </label> '.$worker['email'];
        echo '<p><label> תאריך לידה: </label> '.date('d-m-Y',strtotime($worker['birth_date']));
        echo '<p><label> תאריך העסקה: </label> '.date('d-m-Y',strtotime($worker['start_working']));
        echo'</div>';
        endforeach;?>
</div>


<div class="row"> 
   <?php if(($_SESSION['role']=='מנהל')){           
        echo '<button type="button" class="open-button" onclick="openForm()">עריכת פרטי עובדים</button>';
        echo '<button type="button" class="open-button"><a href="' . site_url() . '/User/register"> הוספת עובד חדש</a></button>';     
   }else {
        echo '<button type="button" class="open-button" onclick="autho()">עריכת פרטי עובדים</button>';
        echo '<button type="button" class="open-button" onclick="autho()"> הוספת עובד חדש</a></button>';
    }?>    
</div>
        
    
<div class="row" id="edit_row">    
<?php foreach ($workers as $worker):?>
    <div class="card" id="edit_card"> 
    <?php echo form_open('User/edit'."/".$worker['id']); ?>   
       
    <p><label>שם מלא</label><input type="text" id="fullname" name="fullname" value="<?php echo $worker['fullname'];?>"></p> 
    
    <p><label>תעודת זהות </label><input type="number" id="id" name="id" value="<?php echo $worker['id'];?>" ></p> 
    
    <p><label>סטטוס</label>
    <select class="s" id="role" name="role" > 
        <option hidden><?php echo $worker['role'];?> </option>
        <option value="מנהל">מנהל</option>
        <option value="עובד">עובד</option>
    </select></p>
        
    <p><label>תפקיד</label>
    <select class="s" id="job" name="job"> 
        <option hidden><?php echo $worker['job'];?> </option>
        <option hidden> בחר תפקיד </option>
        <option value="מלצרות">מלצרות</option>
        <option value="בר">בר</option>
        <option value="אירוח">אירוח</option>
        <option value="אחמש">אחמ"ש</option>
    </select></p>
  
   
    <p><label>מספר טלפון  </label><input type="number" id="phone" name="phone" value="<?php echo $worker['phone'];?>"></p>
    
    <p><label>אימייל  </label><input type="email" id="email" name="email" value="<?php echo $worker['email'];?>"></p>
   
    <p><label> חשבון בנק  </label><input type="text" id="bank_account" name="bank_account" value="<?php echo $worker['bank_account'];?>"></p>
    
    <p><label>תאריך לידה  </label><input type="date" id="birth_date" name="birth_date" value="<?php echo $worker['birth_date'];?>"></p>
    
    <p><label>סיסמא  </label><input type="password" id="password" name="password" value="<?php echo $worker['password'];?>"></p>

    <p>
        <button type="submit" class="open-button">עדכן</button>
        <a href="<?php echo base_url() . '/User/delete_user/'.$worker['id'];?>" class="open-button" onclick=" return confirm('האם אתה בטוח שברצונך למחוק?')"> מחק</a>
    </p>
</div>
    
<?php echo form_close();?>   
    
<?php endforeach;?>
   
</div>
</div>

</main>

<script>
    function openForm() {
        document.getElementById("edit_row").style.display = "inline-block";
    }
    
    <?php if($this->session->flashdata('error')){?>
        document.getElementById("edit_row").style.display = "inline-block";
    <?php }?>

    
    
    function autho(){
    swal({
        title: "",
        text: " משתמש שאינו מנהל לא ראשי לערוך פרטי עובדים",
        icon: "error",
        button: "הבנתי:) ",
    });
}

</script>
