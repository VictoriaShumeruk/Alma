
<?php
    $cal =NULL;
    if ($_GET){
    $urlContents = "https://www.hebcal.com/hebcal/?v=1&cfg=json&maj=on&min=on&mod=on&nx=on&year=now&month=".urlencode($_GET['month'])."&mf=on&geonameid=6255147&lg=h";
    $data = file_get_contents($urlContents);
    $calArray = json_decode($data, true);
    
//    print_r($calArray);
  
//    $cal = "חג / מועד: ".$calArray['items'][0]['hebrew']."<br> מתקיים בתאריך: ".$calArray['items'][0]['date'];  
//    $cal1 = "חג / מועד: ".$calArray['items'][1]['hebrew']."<br> מתקיים בתאריך: ".$calArray['items'][1]['date'];  
}


?>

<style>
    .holidays{
        border: 3px solid lightblue;
        display: inline-block;
    }
        
    .result{  
        font-weight: bold;
        font-size: 12px; 
        text-align: center;
    }
   
</style>

    <form>
        <div class="holidays">
            <p> הכנס מספר חודש על מנת לבדוק האם ישנם חגים ומועדים:
            <input type="text" name="month">
            <input type="submit" value="בדוק"></p>
            <div class="result">
                <h3> החגים / מועדים המתקיימים בחודש זה הם:</h3>   
            
            <?php 
//           $hi = $holiday['date'];
           foreach($calArray['items'] as $holiday){
                $date = $holiday['date'];
                echo $holiday['hebrew'].",  בתאריך: ".date('d-m-y',strtotime($date)).".<br>";
            }; ?>
            </div>
        </div>
    </form>
