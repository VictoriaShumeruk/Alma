
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
 
  var x = window.matchMedia("(max-width: 700px)");
  if (x.matches) { // If media query matches
     document.getElementById("createRes").style.width = "100%";
  } else {
   document.getElementById("createRes").style.width = "350px";
  document.getElementById("map").style.marginRight = "350px";
  document.getElementById("map").style.width = "60%";
}
}
function closeNav(){
    var x = window.matchMedia("(max-width: 600px)");
  if (x.matches) { // If media query matches
    document.getElementById("createRes").style.width = "0px";
    document.getElementById("map").style.width = "100%";
  } else {
  document.getElementById("createRes").style.width = "0px";
  document.getElementById("map").style.marginRight= "0";
  document.getElementById("map").style.width = "70%";
}}
function errorDiv() {
  var x = document.getElementById("error_div");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function errorDiv1() {
  var x = document.getElementById("errorDiv1");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
function change_tnum(x){

    $('#tnum1').hide();
    $('#tnum1').attr('disabled', true);

    $('#tnum2').hide();
    $('#tnum2').attr('disabled', true);

    $('#tnum3').hide();// hide any options already shown
    $('#tnum3').attr('disabled', true);

    switch (x) { // show whichever option is appropriate

        case 'פנים':
            $('#tnum1').show();
            $('#tnum1').attr('disabled', false); // or simply remove disabled attribute
            inside();
            break;

        case 'חוץ':
            $('#tnum2').show();
            $('#tnum2').attr('disabled', false);
            outside();
            break;

        case 'טרסה':
            $('#tnum3').show();
            $('#tnum3').attr('disabled', false);
            terrace();
            break;
        default:
            $('#tnum1').attr('disabled', false); // or simply remove disabled attribute
            inside();
            break;
}
}
function remove_selection(){
      for(var i=2;i<34;i++){
          if(i===10){
              i = 12;
          }
          if(i===24){
              i = 32;
          }
                document.getElementById(i).style.outline="none";
      }
}
function select(x){
      document.getElementById(x).style.outline="8px dashed #FFB500";
}
function table_selection(x){
    remove_selection(),
    select(x);
}

function sitting(x){
    document.getElementById(x).style.background="#C2FEB1"
}


