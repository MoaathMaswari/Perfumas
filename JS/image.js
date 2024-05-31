let imgname = document.getElementById("i");
let img = document.getElementById("img");

imgname.addEventListener('input' ,_=>{
    if(imgname.files.length){
    img.src = "../../../img/"+imgname.files[0].name;
    img.height="100";
    }
    else{
        img.src = "";
        img.height="0";

    }
})

imgname.addEventListener('submit' , _=>{
    img.src = "../../../img/"+imgname.files[0].name;
    img.height="100";
})
