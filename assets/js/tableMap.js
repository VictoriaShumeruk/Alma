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
function openNav() {
  document.getElementById("createRes").style.width = "350px";
  document.getElementById("map").style.marginRight = "350px";
  document.getElementById("map").style.width = "60%";
}

function closeNav() {
  document.getElementById("createRes").style.width = "0";
  document.getElementById("map").style.marginRight= "0";
  document.getElementById("map").style.width = "70%";
}

function change_tnum(value){
    if(value === 'פנים'){
        document.getElementById("in").removeClass('hidden');
        document.getElementById("out").addClass('hidden');
        document.getElementById("tr").addClass('hidden');
    }
    else if(value === 'חוץ'){
        document.getElementById("in").addClass('hidden');
        document.getElementById("out").removeClass('hidden');
        document.getElementById("tr").removeClass('hidden');
    }
    else{
        document.getElementById("in").addClass('hidden');
        document.getElementById("out").addClass('hidden');
        document.getElementById("tr").removeClass('hidden');
    }
}