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

 function buy(){

  

// location.href = 'http://localhost/perfumas/PHP/user/buy.php'

 }
