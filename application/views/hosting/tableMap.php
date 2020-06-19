<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/tableMapStyle.css">
<script src="<?php echo base_url();?>/assets/js/tableMap.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery_v1.9.1.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/script.js"></script>   
<script type="text/javascript">

    $(document).ready(function occupied(){
    
    <?php foreach ($tables as $table): ?>
            var num= <?php echo $table['num'];?>
             document.getElementById(num).style.background=red;
    <?php endforeach;?>
}
window.onload = occupied;
</script>
<div id="map"> 
        <h1>מפת שולחנות</h1>
        <nav>
            <ul>
                <li  type="button" onclick="inside()"><a  id="inside">פנים</a></li>
                <li  type="button" onclick="outside()"><a  id="outside">חוץ</a></li>
                <li  type="button" onclick="terrace()"><a  id="terrace"> טרסה</a></li>
             </ul>    
        </nav>
        <div class="vertical-menu">  <form method="post" action="form_reDate">
                <a> <label for="reservations" >מציג הזמנות עבור:</label>
                    <input type="date" id="date" name="re_date" style="width: 50%;"
                           min="2020-01-01" max="2020-12-31" value="<?php if($this->session->flashdata('reDate') != null){
                    $datee=$this->session->flashdata('reDate');
                    echo date('Y-m-d', strtotime($datee)); }
                    else{
                    echo date('Y-m-d') ;
                    } ?>">
                    <button type="submit" id="choose" onclick="send_date()">בחר</button></a></form>  

                <?php if (is_array($tables) || is_object($tables)){ ?>
                <?php foreach ($tables as $table): ?>
                   
                 <a class="dropdown">
                    <span>מספר שולחן:</span><span>    </span><?php echo $table['num']; ?>
                    <span>מיקום:</span><span>    </span><?php echo $table['location']; ?><br>
                    <span>מס' סועדים:</span><span>    </span><?php echo $table['diners']; ?><br>
                     <?php $time_t = $table['re_time'];?>
                    <span>שעה:</span><span>    </span><?php echo date('H:i', strtotime($time_t)); ?>
                     <?php echo form_open('Hosting/get_id'."/".$table['id']); ?>
                    <input type="hidden"  name="id" value="<?php echo $table['id'];?>">
                    
                    <input type="submit" name="submit" value="עריכת הזמנה" onclick="location.href='<?php echo site_url().'hosting/edit_reservation.php'?>'">
                    
                   <?php echo form_close();?>
                    <div class="dropdown-content">
                            <h4>איש קשר</h4>
                           <span>מספר טלפון:</span><span>    </span><?php echo $table['phonenumber']; ?><br>
                           <span>שם מלא:</span><span>    </span><?php echo $table['fullname']; ?><br>
                        </div>
                    </a>
                <?php
              endforeach;
}
                ?>
                 <a type="button"  class="openbtn" onclick="createOpen()" id="create" style="background-color: #DBC2FF; font-weight: bold;">הזמנה חדשה</a>
          </div>
        
         
         
        <article id="tableIn">
              
            <div class='round' id="2">2</div>
            <div class='round' id="3">3</div>
            <div class='round' id="4">4</div>
            <div id="5">5</div>
            <div class='round' id="6">6</div>
            <div class='round' id="7">7</div>
            <div class='round' id="8">8</div>
            <div id='9'>9</div>
           
        </article>
        <article id="tableOut">
            
            <div id='12'>12</div>
            <div >13</div>
            <div >14</div>
            <div class='round'>15</div>
            <div >16</div>
            <div >17</div>
            <div >18</div>
            <div class='round'>19</div>
            <div>20</div>
            <div>21</div>
            <div>22</div>
            <div class='round'>23</div>
            
            
        </article>
        <article id="tableTr">
            <div >32</div>
            <div >33</div>
            <div >34</div>
            <div class='round'>35</div>
        </article> 
        
</div>      
        
      
        <div id="createRes" class="sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                <?php echo form_open('Hosting/create'); ?> 
<!--<form id="form_insert" name="form_insert" method="POST" action="create.php" >-->
                        <div class="alert alert-danger" id="error_div">
                            <?php if($this->session->flashdata('error')){
                            echo $this->session->flashdata('error'),
                                    '<script type="text/javascript">',
     'openNav();',
     '</script>'
          ;} 
                            else
                                {echo '<script type="text/javascript">',
                                        'errorDiv();',
                                        '</script>'
                                   ;} ?>
                            </div>
                        <label for="tnum">מספר שולחן
                        <select type="number" id="tnum1" name="num" value="<?=@$table['num']; ?>">
                            <?php for ($i = 2; $i <= 9; $i++) : ?>
                                <option id="in" value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?></select>
                        <select type="number" id="tnum2" name="num" style="display: none;">
                                <?php for ($i = 12; $i <= 23; $i++) : ?>
                                <option id="out" value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?></select>
                        <select type="number" id="tnum3" name="num" style="display: none;">
                                <?php for ($i = 32; $i <= 35; $i++) : ?>
                                <option id="tr" value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select></label><br>
                      
                    <label for="loc">אזור
                        <select id="loc" name="location"  style="width:100%;" onchange="change_tnum(this.value)" required>
                            <option value="פנים" >פנים</option>
                            <option value="חוץ" >חוץ</option>
                            <option value="טרסה" >טרסה</option>
                    </select></label><br>
                    
                    <label for="dine">מס' סועדים
                        <input type="number" name="diners" id="dine" min='1' max='30'></label><br>
<!--                            <div><?php echo $error['dine']; ?>   </div>  -->
                    <label for="date">תאריך
                    <input type="date" id="date" name="re_date" style="margin-left: 0;"
                        min="2020-01-01" max="2020-12-31"></label><br>   
<!--                            <div><?php echo  $error['date']; ?>   </div>-->
                    <label for="time">שעה
                    <input type="time" id="time" name="re_time"></label><br>
<!--                    <div><?php echo $error['time']; ?> </div>-->
                    
                    <fieldset><legend visible="true">פרטי איש קשר</legend>
                    <label for="phone">מספר טלפון
                    <input type="number" maxlength="10" id="phone" name="phonenumber"></label><br>
<!--                    <div><?php echo $error['phone']; ?> </div>-->
                    
                    <label for="name">שם פרטי ומשפחה
                    <input type="text" id="name" name="fullname"></label><br></fieldset>
<!--                    <div><?php echo $error['fullname'];?> </div>-->
                    <input type="submit" name="submit" id="save" style="width: 100%;" value="יצירת הזמנה">
                <?php echo form_close();?>
                
        </div><link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/tableMap.css">
<script src="<?php echo base_url();?>/assets/js/tableMap.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery_v1.9.1.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/script.js"></script>   
<script type="text/javascript">

    $(document).ready(function occupied(){
    
    <?php foreach ($tables as $table): ?>
            var num= <?php echo $table['num'];?>
             document.getElementById(num).style.background=red;
    <?php endforeach;?>
}
window.onload = occupied;
</script>
<div id="map"> 
        <h1>מפת שולחנות</h1>
        <nav>
            <ul>
                <li  type="button" onclick="inside()"><a  id="inside">פנים</a></li>
                <li  type="button" onclick="outside()"><a  id="outside">חוץ</a></li>
                <li  type="button" onclick="terrace()"><a  id="terrace"> טרסה</a></li>
             </ul>    
        </nav>
        <div class="vertical-menu">  <form method="post" action="form_reDate">
                <a> <label for="reservations" >מציג הזמנות עבור:</label>
                    <input type="date" id="date" name="re_date" style="width: 50%;"
                           min="2020-01-01" max="2020-12-31" value="<?php if($this->session->flashdata('reDate') != null){
                    $datee=$this->session->flashdata('reDate');
                    echo date('Y-m-d', strtotime($datee)); }
                    else{
                    echo date('Y-m-d') ;
                    } ?>">
                    <button type="submit" id="choose" onclick="send_date()">בחר</button></a></form>  

                <?php if (is_array($tables) || is_object($tables)){ ?>
                <?php foreach ($tables as $table): ?>
                   
                 <a class="dropdown">
                    <span>מספר שולחן:</span><span>    </span><?php echo $table['num']; ?>
                    <span>מיקום:</span><span>    </span><?php echo $table['location']; ?><br>
                    <span>מס' סועדים:</span><span>    </span><?php echo $table['diners']; ?><br>
                     <?php $time_t = $table['re_time'];?>
                    <span>שעה:</span><span>    </span><?php echo date('H:i', strtotime($time_t)); ?>
                     <?php echo form_open('Hosting/get_id'."/".$table['id']); ?>
                    <input type="hidden"  name="id" value="<?php echo $table['id'];?>">
                    
                    <input type="submit" name="submit" value="עריכת הזמנה" onclick="location.href='<?php echo site_url().'hosting/edit_reservation.php'?>'">
                    
                   <?php echo form_close();?>
                    <div class="dropdown-content">
                            <h4>איש קשר</h4>
                           <span>מספר טלפון:</span><span>    </span><?php echo $table['phonenumber']; ?><br>
                           <span>שם מלא:</span><span>    </span><?php echo $table['fullname']; ?><br>
                        </div>
                    </a>
                <?php
              endforeach;
}
                ?>
                 <a type="button"  class="openbtn" onclick="createOpen()" id="create" style="background-color: #DBC2FF; font-weight: bold;">הזמנה חדשה</a>
          </div>
        
         
         
        <article id="tableIn">
              
            <div class='round' id="2">2</div>
            <div class='round' id="3">3</div>
            <div class='round' id="4">4</div>
            <div id="5">5</div>
            <div class='round' id="6">6</div>
            <div class='round' id="7">7</div>
            <div class='round' id="8">8</div>
            <div id='9'>9</div>
           
        </article>
        <article id="tableOut">
            
            <div id='12'>12</div>
            <div >13</div>
            <div >14</div>
            <div class='round'>15</div>
            <div >16</div>
            <div >17</div>
            <div >18</div>
            <div class='round'>19</div>
            <div>20</div>
            <div>21</div>
            <div>22</div>
            <div class='round'>23</div>
            
            
        </article>
        <article id="tableTr">
            <div >32</div>
            <div >33</div>
            <div >34</div>
            <div class='round'>35</div>
        </article> 

        <?php foreach ($tables as $table): ?>
<script> document.getElementById(<?php echo $table['num']?>).style.background="red"; </script>
<?php endforeach;?>
</div>



        
      
        <div id="createRes" class="sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                <?php echo form_open('Hosting/create'); ?> 
<!--<form id="form_insert" name="form_insert" method="POST" action="create.php" >-->
                        <div class="alert alert-danger" id="error_div">
                            <?php if($this->session->flashdata('error')){
                            echo $this->session->flashdata('error'),
                                    '<script type="text/javascript">',
     'openNav();',
     '</script>'
          ;} 
                            else
                                {echo '<script type="text/javascript">',
                                        'errorDiv();',
                                        '</script>'
                                   ;} ?>
                            </div>
                        <label for="tnum">מספר שולחן
                        <select type="number" id="tnum1" name="num" value="<?=@$table['num']; ?>">
                            <?php for ($i = 2; $i <= 9; $i++) : ?>
                                <option id="in" value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?></select>
                        <select type="number" id="tnum2" name="num" style="display: none;">
                                <?php for ($i = 12; $i <= 23; $i++) : ?>
                                <option id="out" value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?></select>
                        <select type="number" id="tnum3" name="num" style="display: none;">
                                <?php for ($i = 32; $i <= 35; $i++) : ?>
                                <option id="tr" value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select></label><br>
                      
                    <label for="loc">אזור
                        <select id="loc" name="location"  style="width:100%;" onchange="change_tnum(this.value)" required>
                            <option value="פנים" >פנים</option>
                            <option value="חוץ" >חוץ</option>
                            <option value="טרסה" >טרסה</option>
                    </select></label><br>
                    
                    <label for="dine">מס' סועדים
                        <input type="number" name="diners" id="dine" min='1' max='30'></label><br>
<!--                            <div><?php echo $error['dine']; ?>   </div>  -->
                    <label for="date">תאריך
                    <input type="date" id="date" name="re_date" style="margin-left: 0;"
                        min="2020-01-01" max="2020-12-31"></label><br>   
<!--                            <div><?php echo  $error['date']; ?>   </div>-->
                    <label for="time">שעה
                    <input type="time" id="time" name="re_time"></label><br>
<!--                    <div><?php echo $error['time']; ?> </div>-->
                    
                    <fieldset><legend visible="true">פרטי איש קשר</legend>
                    <label for="phone">מספר טלפון
                    <input type="number" maxlength="10" id="phone" name="phonenumber"></label><br>
<!--                    <div><?php echo $error['phone']; ?> </div>-->
                    
                    <label for="name">שם פרטי ומשפחה
                    <input type="text" id="name" name="fullname"></label><br></fieldset>
<!--                    <div><?php echo $error['fullname'];?> </div>-->
                    <input type="submit" name="submit" id="save" style="width: 100%;" value="יצירת הזמנה">
                <?php echo form_close();?>
                
        </div>