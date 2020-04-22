<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/tableMapStyle.css">
<script src="<?php echo base_url();?>/assets/js/tableMap.js"></script>
<div id="map"> 
        <h1>מפת שולחנות</h1>
        <nav>
            <ul>
                <li  type="button" onclick="inside()"><a  id="inside">פנים</a></li>
                <li  type="button" onclick="outside()"><a  id="outside">חוץ</a></li>
                <li  type="button" onclick="terrace()"><a  id="terrace"> טרסה</a></li>
             </ul>    
        </nav>
          <div class="vertical-menu">    
                 <h3>מציג הזמנות עבור : <?php echo @date('d-m-y'); ?></h3>             
                <?php
               
                foreach($tables as $table):
                
                ?>
                    
                 <a class="dropdown">
                    <span>מספר שולחן:</span><span>    </span><?php echo $table['num']; ?>
                    <span>מיקום:</span><span>    </span><?php echo $table['location']; ?><br>
                    <span>מס' סועדים:</span><span>    </span><?php echo $table['diners']; ?><br>
                     <?php $time_t = $table['re_time'];?>
                    <span>שעה:</span><span>    </span><?php echo date('H:i', strtotime($time_t)); ?>
                        <div class="dropdown-content">
                            <h4>איש קשר</h4>
                           <span>מספר טלפון:</span><span>    </span><?php echo $table['phonenumber']; ?><br>
                           <span>שם מלא:</span><span>    </span><?php echo $table['fullname']; ?><br>
                        </div>
                    </a>
                <?php
              endforeach;
                ?>
                 <a type="button"  class="openbtn" onclick="openNav()" id="create" style="background-color: #DBC2FF; font-weight: bold;">הזמנה חדשה</a>
          </div>
        
        
        <article id="tableIn">
            
            <div >2</div>
            <div >3</div>
            <div >4</div>
            <div >5</div>
            <div >6</div>
            <div >7</div>
            <div >8</div>
            <div >9</div>
           
        </article>
        <article id="tableOut">
            
            <div >12</div>
            <div >13</div>
            <div >14</div>
            <div >15</div>
            <div >16</div>
            <div >17</div>
            <div >18</div>
            <div >19</div>
            <div>20</div>
            <div>21</div>
            <div>22</div>
            <div>23</div>
            
            
        </article>
        <article id="tableTr">
            <div >32</div>
            <div >33</div>
            <div >34</div>
            <div>35</div>
        </article>  

        <div id="createRes" class="sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                <?php echo form_open('Hosting/create'); ?>
                
                    <form id="form_insert" name="form_insert" method="POST" action="create.php">
                    <label for="tnum">מספר שולחן
                        <select type="number" id="tnum" name="num">
                            <?php for ($i = 2; $i <= 9; $i++) : ?>
                                <option id="in" value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                                <?php for ($i = 12; $i <= 23; $i++) : ?>
                                <option id="out" value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
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
                        <input type="number" name="diners" id="dine"></label><br>
                        
                    <label for="date">תאריך
                    <input type="date" id="date" name="re_date" style="margin-left: 0;"
                        min="2020-01-01" max="2020-12-31"></label><br>   
                       
                       
                    <label for="time">שעה
                    <input type="time" id="time" name="re_time"></label><br>
                    
                    
                    <fieldset><legend visible="true">פרטי איש קשר</legend>
                    <label for="phone">מספר טלפון
                    <input type="number" maxlength="10" id="phone" name="phonenumber"></label><br>
                    
                    <label for="name">שם פרטי ומשפחה
                    <input type="text" id="name" name="fullname"></label><br></fieldset>
                    
                    <button type="submit" name="save" value="אישור">אישור</button>
                    
                </form>

        </div>
