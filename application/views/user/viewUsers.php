<main>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/userStyle.css"/>
<div class="row">
        <?php foreach ($workers as $worker):
            echo '<div class="card">';
            echo '<h1>'.$worker['fullname'].'</h1>';
            echo '<p><label> תעודת זהות: </label>'.$worker['id'];
            echo '<p><label> תפקיד: </label>'.$worker['role'];
            echo '<p><label> מפר טלפון: </label>'.$worker['phone'];
            echo '<p><label> דואר אלקטרוני: </label>'.$worker['email'];
            echo '<p><label> תאריך תחילת העסקה: </label>'.$worker['start_working'];
            echo'</div>';
            endforeach;?>
</div>
</main>