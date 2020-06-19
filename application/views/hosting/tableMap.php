<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/tableMapStyle.css">
<script src="<?php echo base_url();?>/assets/js/tableMap.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery_v1.9.1.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/script.js"></script>   

<div class="container" id="map"> 
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
                    <button style="left: auto;"type="submit" id="choose" onclick="send_date()">בחר</button></a></form>  

                <?php if (is_array($tables) || is_object($tables)){ ?>
                <?php foreach ($tables as $table): ?>
                   
                 <a class="dropdown">
                    <span>מספר שולחן:</span><span>    </span><?php echo $table['num']; ?>
                    <span>מיקום:</span><span>    </span><?php echo $table['location']; ?><br>
                    <span>מס' סועדים:</span><span>    </span><?php echo $table['diners']; ?><br>
                     <?php $time_t = $table['re_time'];?>
                    <span>שעה:</span><span>    </span><?php echo date('H:i', strtotime($time_t)); ?><br>
                        <?php echo form_open('Hosting/get_id'."/".$table['id'], 'class="reservationForm"'); ?>
                        <input type="hidden"  name="id" value="<?php echo $table['id'];?>">
                        <input class="clicked" type="submit" name="submit" value="עריכת הזמנה" onclick="location.href='<?php echo site_url().'hosting/editReservation.php'?>'">
                        <?php echo form_close();?>
                        <?php echo form_open('Hosting/delete_reservation'."/".$table['id'], 'class="reservationForm"'); ?>
                        <input class="clicked" type="submit" name="submit" onclick=" return confirm('האם אתה בטוח שברצונך למחוק הזמנה זו?')" value="מחק הזמנה">
                        <?php echo form_close();?>
                        <input class="clicked" id="sit" onclick="sitting(<?php echo $table['num']?>)" value="הושב">
                       
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
            
            <div id="12">12</div>
            <div id="13">13</div>
            <div id="14">14</div>
            <div class='round' id="15">15</div>
            <div id="16">16</div>
            <div id="17">17</div>
            <div id="18">18</div>
            <div class='round' id="19">19</div>
            <div id="20">20</div>
            <div id="21">21</div>
            <div id="22">22</div>
            <div class='round' id="23">23</div>
            
            
        </article>
        <article id="tableTr">
            <div id="32">32</div>
            <div id="33">33</div>
            <div id="34">34</div>
            <div class='round'>35</div>
        </article> 
        <div class="dropdown-content">
                            <h4>איש קשר</h4>
                            
                           <span>מספר טלפון:</span><span>    </span><?php echo $table['phonenumber']; ?><br>
                           <span>שם מלא:</span><span>    </span><?php echo $table['fullname']; ?><br>
       </div>
        
</div> 
<?php foreach ($tables as $table): ?>
<script> 
        document.getElementById(<?php echo $table['num']?>).style.background="#FF8C7A";
                document.getElementById(<?php echo $table['num']?>).style.color="white";
$(document).ready(function(){
    $("#<?php echo $table['num']?>").load(function(){
        var e = $('<div><?php echo $table['diners']; ?></div>');
        $("#<?php echo $table['num']?>").append($(e));    
        
        });
    });
</script>
<?php endforeach;?>
           


      
        <div id="createRes" class="sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                <?php echo form_open('Hosting/create'); ?> 
<form id="form_insert" name="form_insert" method="POST" class="form-horizontal" action="create.php" >
                        <div class="alert alert-danger" id="error_div">
                           
                            <?php if($this->session->flashdata('error')){
                            echo $this->session->flashdata('error'),
                                
                                    '<script type="text/javascript">',
                                    'createOpen();',
                                    '</script>'
                                         ;}
                            else
                                {echo '<script type="text/javascript">',
                                        'errorDiv();',
                                        '</script>'
                                   ;} ?>
                            </div>
                            <div class="alert alert-danger" id="errorDiv1">
                                <?php if($this->session->flashdata('error_name')) {
                                echo $this->session->flashdata('error_name'),
                                    '<script type="text/javascript">',
                                    'createOpen();',
                                    '</script>'
                                ;}
                                else
                                {echo '<script type="text/javascript">',
                                        'errorDiv1();',
                                        '</script>'
                                   ;} ?>
                            </div>
    <label class="control-label" for="tnum">מספר שולחן
                        <select type="number" id="tnum1" name="num" onchange="table_selection(this.value)">
                            <?php for ($i = 2; $i <= 9; $i++) : ?>
                                <option id="in" value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?></select>
                        <select type="number" id="tnum2" name="num" style="display: none;" onchange="table_selection(this.value)">
                                <?php for ($i = 12; $i <= 23; $i++) : ?>
                                <option id="out" value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?></select>
                        <select type="number" id="tnum3" name="num" style="display: none;" onchange="table_selection(this.value)">
                                <?php for ($i = 32; $i <= 35; $i++) : ?>
                                <option id="tr" value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select></label><br>
                      
                    <label class="control-label" for="loc">אזור
                        <select id="loc" name="location"  style="width:100%;" onchange="change_tnum(this.value)" required>
                            <option value="פנים" >פנים</option>
                            <option value="חוץ" >חוץ</option>
                            <option value="טרסה" >טרסה</option>
                    </select></label><br>
                    
                    <label class="control-label" for="dine">מס' סועדים
                        <input type="number" name="diners" id="dine" min='1' max='30'></label><br>
                    <label class="control-label" for="date">תאריך
                    <input type="date" id="date" name="re_date" style="margin-left: 0;"
                        min="2020-01-01" max="2020-12-31"></label><br>   
                    <label class="control-label" for="time">שעה
                        <input type="time" id="time" name="re_time" value="<?php date_default_timezone_set('Israel'); echo date("H:i", time());?>"></label><br>
                    
                    <fieldset><legend visible="true">פרטי איש קשר</legend>
                    <label class="control-label" for="phone">מספר טלפון
                    <input type="number" maxlength="10" id="phone" name="phonenumber"></label><br>
                    
                    <label class="control-label" for="name">שם פרטי ומשפחה
                    <input type="text" id="name" name="fullname"></label><br></fieldset>
                    <input type="submit" name="submit" class="btn-block btn-lg" id="save" value="יצירת הזמנה">
                <?php echo form_close();?>
</form>    
        </div>
<script>
$('#tnum1').change(function() {
    if (!($(this).hasClass("round"))){
        if($('#dine').val()>4){
            window.alert('השולחן קטן מדי עבור מספר הסועדים שנבחר! השולחן מכיל עד 4 סועדים');
        }    
    }
});
$('#tnum2').change(function() {
    if (!($(this).hasClass("round"))){
        if($('#dine').val()>4){
            window.alert('השולחן קטן מדי עבור מספר הסועדים שנבחר!');
        }    
    }
     if ($(this).hasClass("round")){
       if($('#dine').val()>9){
            window.alert('השולחן קטן מדי עבור מספר הסועדים שנבחר!');
        }
    }
});
$('#tnum3').change(function() {
    if (!($(this).hasClass("round"))){
        if($('#dine').val()>4){
            window.alert('השולחן קטן מדי עבור מספר הסועדים שנבחר!');
        }    
    }
     if ($(this).hasClass("round")){
       if($('#dine').val()>8){
            window.alert('השולחן קטן מדי עבור מספר הסועדים שנבחר!');
        }
    }
   
});
</script>

