let imgso = document.getElementsByClassName('imgo');
let which = document.getElementsByClassName('which');
let dots = document.getElementsByClassName('dots');
let i = 0;
dots[0].style.background='brown';
function Rmove(){
 
    if(i >= 0 && i < 3){
    imgso[i++].style.opacity="0";
    which[0].innerHTML=i+1;
    dots[i].style.background='brown';
    dots[i-1].style.background='black';

    }
}

function Lmove(){
 
    if(i > 0 && i <= 3){
    imgso[--i].style.opacity="1";
    which[0].innerHTML=i+1;
    dots[i].style.background='brown';
    dots[i+1].style.background='black';
    }

}

function gotopic1(){
    dots[0].style.backgroundColor = 'brown';
    dots[1].style.backgroundColor = 'black';
    dots[2].style.backgroundColor = 'black';
    dots[3].style.backgroundColor = 'black';
    imgso[0].style.opacity="1";
    which[0].innerHTML=1;
i=0;


}
function gotopic2(){
    dots[1].style.backgroundColor = 'brown';
    dots[0].style.backgroundColor = 'black';
    dots[2].style.backgroundColor = 'black';
    dots[3].style.backgroundColor = 'black';
    imgso[1].style.opacity="1";
    imgso[0].style.opacity="0";
    which[0].innerHTML=2; 
    i=1;



}
function gotopic3(){
    dots[2].style.backgroundColor = 'brown';
    dots[1].style.backgroundColor = 'black';
    dots[0].style.backgroundColor = 'black';
    dots[3].style.backgroundColor = 'black';
    imgso[2].style.opacity="1";
    imgso[0].style.opacity="0";
    imgso[1].style.opacity="0";
    imgso[3].style.opacity="0";
    which[0].innerHTML=3;
    i=2;



}
function gotopic4(){
    dots[3].style.backgroundColor = 'brown';
    dots[1].style.backgroundColor = 'black';
    dots[2].style.backgroundColor = 'black';
    dots[0].style.backgroundColor = 'black';
    imgso[3].style.opacity="1";
    imgso[0].style.opacity="0";
    imgso[1].style.opacity="0";
    imgso[2].style.opacity="0";
    which[0].innerHTML=4;
    i=3;



}






let where = document.getElementsByClassName("goto-menu");
console.log(where);
onscroll = function(){
    if(scrollY>=300){
where[0].style.opacity = "1";
where[0].style.bottom = "4vh";


    }
    else{
 where[0].style.opacity = "0";
 where[0].style.bottom = "-6vh";

    }
        
}
 function menu(){scrollTo({top:0 ,behavior:"smooth"} )}




 