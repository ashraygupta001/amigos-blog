 var index=1;
              function plusIndex(n){
                  index=index+1;
                  showImage(index);
                  
              };
showImage(1);
function showImage(n){
    var i;
    var x=document.getElementsByClassName("jo");
    if(n>x.length){
        index=1
    };
     if(n<1){
        index=x.length
    };
    for(i=0;i<x.length;i++){
        x[i].style.display="none";
    }
    x[index-1].style.display="block";
}
document.getElementById('button').addEventListener("click", function() {
	document.querySelector('.bg-modal').style.display = "flex";
});

document.querySelector('.close').addEventListener("click", function() {
	document.querySelector('.bg-modal').style.display = "none";
});


document.getElementById('id01').addEventListener("click", function() {
	document.querySelector('.bg-model').style.display = "flex";
});

document.querySelector('.clase').addEventListener("click", function() {
	document.querySelector('.bg-model').style.display = "none";
});

document.getElementById('id02').addEventListener("click", function() {
	document.querySelector('.bg-model').style.display = "flex";
});

document.querySelector('.clase').addEventListener("click", function() {
	document.querySelector('.bg-model').style.display = "none";
});

document.getElementById('id03').addEventListener("click", function() {
	document.querySelector('.a').style.display = "flex";
});

document.querySelector('.close1').addEventListener("click", function() {
	document.querySelector('.a').style.display = "none";
});

document.getElementById('id04').addEventListener("click", function() {
	document.querySelector('.a2').style.display = "flex";
});

document.querySelector('.close2').addEventListener("click", function() {
	document.querySelector('.a2').style.display = "none";
});
document.getElementById('id05').addEventListener("click", function() {
	document.querySelector('.a4').style.display = "flex";
});

document.querySelector('.close3').addEventListener("click", function() {
	document.querySelector('.a4').style.display = "none";
});

document.getElementById('id06').addEventListener("click", function() {
	document.querySelector('.a6').style.display = "flex";
});

document.querySelector('.close4').addEventListener("click", function() {
	document.querySelector('.a6').style.display = "none";
});
document.getElementById('id07').addEventListener("click", function() {
	document.querySelector('.a8').style.display = "flex";
});

document.querySelector('.close5').addEventListener("click", function() {
	document.querySelector('.a8').style.display = "none";
});
document.getElementById('id08').addEventListener("click", function() {
	document.querySelector('.a10').style.display = "flex";
});

document.querySelector('.close6').addEventListener("click", function() {
	document.querySelector('.a10').style.display = "none";
});
document.getElementById('id09').addEventListener("click", function() {
	document.querySelector('.a12').style.display = "flex";
});

document.querySelector('.close7').addEventListener("click", function() {
	document.querySelector('.a12').style.display = "none";
});
document.getElementById('id15').addEventListener("click", function() {
	document.querySelector('.a14').style.display = "flex";
});

document.querySelector('.close8').addEventListener("click", function() {
	document.querySelector('.a14').style.display = "none";
});

document.getElementById('id25').addEventListener("click", function() {
	document.querySelector('.a23').style.display = "flex";
});

document.querySelector('.close9').addEventListener("click", function() {
	document.querySelector('.a23').style.display = "none";
});

  
