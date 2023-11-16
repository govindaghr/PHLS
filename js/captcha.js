//provide support for safari and other ios & non-compliant browsers
function hasHtml5Validation () {
  return typeof document.createElement('input').checkValidity === 'function';
}

if (hasHtml5Validation()) {
  $('.validate-form').submit(function (e) {
    if (!this.checkValidity()) {
      e.preventDefault();
      $(this).addClass('invalid');
      $('#status').html('invalid');
    } else {
      $(this).removeClass('invalid');
      $('#status').html('submitted');
    }
  });
}
//math to text functions by Ian L. of Jafty.com
function makenumber(numb){
if(numb==1)return "1";
if(numb==2)return "2";
if(numb==3)return "3";
if(numb==4)return "4";
if(numb==5)return "5";
if(numb==6)return "6";
if(numb==7)return "7";
if(numb==8)return "8";
if(numb==9)return "9";
if(numb==10)return "10";
}//end makenumber function
function placenumber(){
var x = Math.floor((Math.random() * 10) + 1);
var y = Math.floor((Math.random() * 10) + 1);
var no1 = makenumber(x);
var no2 = makenumber(y);
var ans = x+y;
document.getElementById('answer').pattern=ans;
document.getElementById("no1").innerHTML = no1;
document.getElementById("no2").innerHTML = no2;
}//end placenumber function