
function inside(){
    document.getElementById('tableIn').style.display = "block";
    document.getElementById('tableOut').style.display = "none";
    document.getElementById('tableTr').style.display = "none";
}
function outside(){
    document.getElementById('tableIn').style.display = "none";
    document.getElementById('tableOut').style.display = "block";
    document.getElementById('tableTr').style.display = "none";
}
function terrace(){
    document.getElementById('tableIn').style.display = "none";
    document.getElementById('tableOut').style.display = "none";
    document.getElementById('tableTr').style.display = "block";
}
   
function createOpen(){
  document.getElementById("createRes").style.width = "350px";
  document.getElementById("map").style.marginRight = "350px";
  document.getElementById("map").style.width = "60%";
}
function editOpen() {
  document.getElementById("editRes").style.width = "350px";
  document.getElementById("map").style.marginRight = "350px";
  document.getElementById("map").style.width = "60%";
}
function closeNav() {
  document.getElementById("editRes").style.width = "0px";
  document.getElementById("createRes").style.width = "0px";
  document.getElementById("map").style.marginRight= "0";
  document.getElementById("map").style.width = "70%";
}
function errorDiv() {
  var x = document.getElementById("error_div");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
function change_tnum(x){
    
    $('#tnum1').hide();
    $('#tnum2').hide();
    $('#tnum3').hide();// hide any options already shown
    switch ($('#loc').val()) { // show whichever option is appropriate
      case 'פנים':
        $('#tnum1').show();
        inside();
        break;
      case 'חוץ':
        $('#tnum2').show();
        outside();
        break;
      case 'טרסה':
        $('#tnum3').show();
        terrace();
        break;
      default:
        break;
    }
}
//
//$(document).ready(function() {
//    var $validator = $("#insert_form").validate({
//        rules: {
//            dine: {required: true},
//            date: {required: true , date : true,  dateITA : true},
//            time: {required: true, regex:/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/},
//            phone: {required: true, exactlentgh:10, regex:/^[0-9]{10}+$/},
//            name: {required: true, regex:/^[a-zA-Zא-ת ]*$/}
//        },
//        messages: {
//            dine: {required: "אנא מלא מספר סועדים!"},
//            date: {required: "אנא מלא תאריך להזמנה!"},
//            time: {required: "אנא מלא שעה להזמנה!"},
//            phone: {required: "אנא מלא מספר טלפון תקין של הלקוח!"},
//            name: {required: "אנא מלא שם פרטי ומשפחה של הלקוח!"}
//        }
//    });
//    
//
//    $('#save').click(function(e) {
//        e.preventDefault();
//            var loc = $("#loc").val();
//            var dine = $("#dine").val();
//            var date = $("#date").val();
//            var time = $("#time").val();
//            var phone = $("#phone").val();
//            var fullname = $("#fullname").val();
//
//        var $valid = $("#insert_form").valid();
//        if (!$valid) {
//            $validator.focusInvalid();
//            return false;
//        } else {
//            $.ajax({
//                url: "<?php echo base_url(); ?>" + "/hosting/create",
//                method:'POST',
//                data:{ loc:loc, dine:dine, date:date, time:time, phone:phone, fullname: fullname},
//                dataType:"json",
//                beforeSend: function() {
//                    console.log(data);
//                },
//                success: function(returnData) {
//                    if (returnData.status) {
//                        $('.ajax_success').html('ההזמנה הוספה בהצלחה!');
//                    }
//                }
//            });
//        }
//    });
//});
    
    
 $("#save").click(function (e) { 
     
        e.preventDefault(); 
        var tnum1 = $("#tnum1").val();
        var tnum2 = $("#tnum2").val();
        var tnum3 = $("#tnum3").val();
        var loc = $("#loc").val();
        var dine = $("#dine").val();
        var date = $("#date").val();
        var time = $("#time").val();
        var phone = $("#phone").val();
        var fullname = $("#name").val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo site_url(); ?>" + "/hosting/create",
                data: {tnum1:tnum1, tnum2:tnum2, tnum3:tnum3, loc:loc, dine:dine, 
                date:date, time:time, phone:phone, fullname: fullname},
                error: function () {
                    alert( "Load was performed.");
                },
                success: function (data) {
                    if (data.error === 0) {
                        alert("ההרשמה בוצעה בהצלחה");
                        window.location.href = "<?php echo site_url('hosting/tableMap'); ?>";
                    }
                    else {
                        
                        alert("ההזמנה לא התקבלה!")
                        $("#error_div").html('validation_error');
                    }
                }
            });
    });

            
  
