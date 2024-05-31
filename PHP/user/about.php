<?php
session_start();
if(!isset($_SESSION['user_id']))
{
    header("location:../login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../../css/project.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>

    <title>About</title>
</head>
<body>
    <div class="all">
    <nav>
        <ul class="nav">
            <li><a href="../login.php" class="lb">Log out</a></li>
            <li><a href="perfumes.php">Perfumes</a></li>
            <li><a href="main.php">Main</a></li>
            <li class="me">About</li>
            <li><a href="settings.php">ٍSettings</a></li>
        </ul>

        <div class="logo">
            <h1>perfu</h1>
        </div>


    </nav>

    <div class="content">

    <h1 class="abt">History</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto rerum impedit tempora quae dolorum ex, omnis dolores minima ab, optio quia illum cumque consequatur vitae quis fugit quod laboriosam facere laborum reiciendis consectetur autem! Corporis soluta, eligendi veniam iste necessitatibus, vero eos alias ex modi similique dignissimos? Error hic cumque molestias natus, tempore iure tenetur atque animi quibusdam, ipsum corrupti labore id dolores impedit nihil beatae optio illum soluta, repellendus asperiores consequuntur mollitia. Deleniti consectetur eligendi dolores dolorum quibusdam debitis obcaecati placeat? Quisquam, suscipit magnam rerum expedita voluptatem quam vel est quo nemo harum ab dolorem laboriosam incidunt maiores mollitia. ipsum dolor sit amet consectetur adipisicing elit. Reiciendis harum corrupti minus quod fugiat ut atque odit sed facere! Ullam fugit est velit iusto adipisci illum nesciunt ex, repellendus a.</p>
    
    <h1 class="abt">founders</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto rerum impedit tempora quae dolorum ex, omnis dolores minima ab, optio quia illum cumque consequatur vitae quis fugit quod laboriosam facere laborum reiciendis consectetur autem! Corporis soluta, eligendi veniam iste necessitatibus, vero eos alias ex modi similique dignissimos? Error hic cumque molestias natus, tempore iure tenetur atque animi quibusdam, ipsum corrupti labore id dolores impedit nihil beatae optio illum soluta, repellendus asperiores consequuntur mollitia. Deleniti consectetur eligendi dolores dolorum quibusdam debitis obcaecati placeat? Quisquam, suscipit magnam rerum expedita voluptatem quam vel est quo nemo harum ab dolorem laboriosam incidunt maiores mollitia. ipsum dolor sit amet consectetur adipisicing elit. Reiciendis harum corrupti minus quod fugiat ut atque odit sed facere! Ullam fugit est velit iusto adipisci illum nesciunt ex, repellendus a.</p>
    
    <h1 class="abt">Acheviments</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto rerum impedit tempora quae dolorum ex, omnis dolores minima ab, optio quia illum cumque consequatur vitae quis fugit quod laboriosam facere laborum reiciendis consectetur autem! Corporis soluta, eligendi veniam iste necessitatibus, vero eos alias ex modi similique dignissimos? Error hic cumque molestias natus, tempore iure tenetur atque animi quibusdam, ipsum corrupti labore id dolores impedit nihil beatae optio illum soluta, repellendus asperiores consequuntur mollitia. Deleniti consectetur eligendi dolores dolorum quibusdam debitis obcaecati placeat? Quisquam, suscipit magnam rerum expedita voluptatem quam vel est quo nemo harum ab dolorem laboriosam incidunt maiores mollitia. ipsum dolor sit amet consectetur adipisicing elit. Reiciendis harum corrupti minus quod fugiat ut atque odit sed facere! Ullam fugit est velit iusto adipisci illum nesciunt ex, repellendus a.</p>
    </div>
    


    <footer>
        <div class="logo">
            <h1>perfu</h1>
        </div>

        <hr>

        <table>
            <tr>
            <td >Facebook</td>
            <td >Twitter</td>
            <td >Instgram</td>
            <td >whatsapp</td>
            </tr>
            
            <tr>
                <td><a href="https://www.Facebook.com"><i class="fab fa-facebook"></i></a></td>
                <td><a href="https://www.Twitter.com"><i class="fab fa-twitter"></i></a></td>
                <td><a href="https://www.Instgram.com"><i class="fab fa-instagram"></i></a></td>
                <td><a href="https://www.whatsapp.com"><i class="fa-brands fa-whatsapp"></i></a></td>
            </tr>
        </table>
        
        <div class="goto-menu" onclick="menu()">^</div>

    </footer>



  
    </div>

<script>
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
</script>
</body>
</html>