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
    <title>Offers</title>
    <link rel="stylesheet" href="https:/cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
</head>
<body>

<?php 
require("../db/connect.php");
?>
    
    <div class="all">
    <nav>
        <ul class="nav">
        <li><a href="../login.php" class="lb">Log out</a></li>
            <li class="me">Perfumes</li>
            <li><a href="main.php">Main</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="settings.php">Setting</a></li>

        </ul>
        
        <div class="logo">
            <h1>perfu</h1>
        </div>

    </nav>

    <div class="content">

        <div class="slider">
            <div class="move">
                <p class="which">1</p><p class="how-many">/</p><p class="out-of">4</p>
                <p class="left-arrow" onclick=Lmove()><</p>
                <p class="right-arrow" onclick=Rmove()>></p>
                <img class="img1 imgo" src="../../img/2 (10).jpg" alt="">
                <img class="img2 imgo"  src="../../img/2 (1).jpg" alt=""> 
               <img class="img3 imgo"  src="../../img/2 (13).jpg" alt="">
               <img class="img4 imgo"  src="../../img/2 (18).jpg" alt="">
              <span class="dots" onclick="gotopic1()"></span> <span class="dots" onclick="gotopic2()"></span> <span class="dots" onclick="gotopic3()"></span><span class="dots" onclick="gotopic4()"></span>
            </div>
        </div>
    </div>



    <h2 class='buy'> BUY PERFUMES</h2>

    <div class="pics">

<?php

$sql = 'select p_id , p_name , p_price , p_qua , p_img , available from perfume';
$q = $perfumas->prepare($sql);
$q->execute();
if($q->rowcount()){



foreach($q->fetchall() as $row){

        if($row['available'] == 1 && $row['p_qua'] >=1 ){
    echo "

    <div class='pic'>
        <a href='../../img/$row[p_img]' target='_blank'><img src='../../img/$row[p_img]'></a>
        <p>
            $row[p_name]<br>
            price = $row[p_price]<br>
            <a class='buy-a' href='buy.php?pid=$row[p_id]'>buy</a>
         </p>    
    </div>
        
        ";
        }
    

}

}

?>

   
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
            
        </footer>

    <div class="goto-menu" onclick="menu()">^</div>

   

 

    <script src="../../JS/project.js"></script>
</body>
</html>