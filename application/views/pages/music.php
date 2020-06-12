<main>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/musicStyle.css"/>
<script type="text/javascript" src="http://cdn-files.deezer.com/js/min/dz.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/js/deezerApi.js"></script>

    <div class="container">
        <h1> הפלייליסטים של עלמא<img src="<?php echo base_url();?>/assets/images/music.jpg" height="60" width="60" id="m"></h1>
        <button class="searchWrraper" onclick="login();"> לחץ על מנת להתחבר למערכת השמע  </button>
         <!--3by@wHRExTS_tPw-->
         <!--nitzan1040@gmail.com-->
        <?php
        $curl = curl_init();      
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.deezer.com/user/3647566862/playlists',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = json_decode(curl_exec($curl),true);
        $err = curl_error($curl);

        curl_close($curl);

        if(!empty($response)){
            for($i=0;$i<=count($response);$i++){
                echo '<div class="playlist">';
                $pic=($response["data"][$i]['picture']);
                echo '<img src='.$pic.'>';
                echo '<div class=details>';
                echo 'מספר מזהה:'.' ';
                print_r ($response["data"][$i]['id']);
                echo '<br>';
                echo 'שם :'.' ';
                print_r ($response["data"][$i]['title']);
                echo '<br>';
                echo 'מספר שירים:'.' ';
                print_r ($response["data"][$i]['nb_tracks']);
                echo '<br>';
                echo 'אורך :'.' ';
                $time=(gmdate('H:i:s',($response["data"][$i]['duration']))); 
                echo $time;
                echo '</div>';
                echo '<hr class="line">';
                echo '</div>';
            }
        }else{       
            echo '<p id="error"><b>'."ישנה תקלה בהתחברות המשתמש עלמא למערכת השמע".'</b></p>';
        }
        ?>       
    
        <div class="searchWrraper">
            <form action="" method="get">
               <label id="lable" for="query"להחלפת הפלייליסט הכנס את שמו </label>
                    <br><input id="query" type="text" name="query" /> 
                    <button name="submit" type="submit">הכנס</button>
            </form>   
            <?php
                $name=filter_input(INPUT_GET, 'query');
                $i=0;
                for($i=0;$i<=count($response);$i++){
                    if($response["data"][$i]['title'] == $name){
                        $num=$response["data"][$i]['id'];
                    }
                }
            ?>
        </div>
            
        <div id="dz-root"></div>
        <script>
            DZ.init({
                appId: '412902',
                channelUrl: 'http://victoriasu.mtacloud.co.il/Alma/pages/music',
            });
        </script>
    
        <div class="deezer-widget-player" data-src="https://www.deezer.com/plugins/player?format=classic&autoplay=false&playlist=true&width=400&height=350&color=ff0000&layout=ligth&size=medium&type=playlist&id=<?php if (isset($num)){echo $num;} else{echo '7627359582';} ?>&app_id=412902" data-scrolling="no" data-frameborder="0" data-allowTransparency="true" data-width="500" data-height="300"></div>

        <script>
            (function() {
                var w = document[typeof document.getElementsByClassName === 'function' ? 'getElementsByClassName' : 'querySelectorAll']('deezer-widget-player');
                for (var i = 0, l = w.length; i < l; i++) {
                    w[i].innerHTML = '';
                    var el = document.createElement('iframe');
                    el.src = w[i].getAttribute('data-src');
                    el.scrolling = w[i].getAttribute('data-scrolling');
                    el.frameBorder = w[i].getAttribute('data-frameborder');
                    el.setAttribute('frameBorder', w[i].getAttribute('data-frameborder'));
                    el.allowTransparency = w[i].getAttribute('data-allowTransparency');
                    el.width = w[i].getAttribute('data-width');
                    el.height = w[i].getAttribute('data-height');
                    w[i].appendChild(el);
                }
        }());

        </script>
    </div>
</main>

