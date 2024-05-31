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

    <title>PERFUMAS</title>
    <link rel="stylesheet" href="../../css/project.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>

</head>
<body >


    <div class="all">
        
        <nav>

            <ul class="nav">
               <li><a href="../login.php" class="lb">Log out</a></li>
            <li><a href="perfumes.php">Perfumes</a></li>
                <li class="me">Main</li>
                <li><a href="about.php">About</a></li>
                <li><a href="settings.php">Setting</a></li>
            </ul>

            <div class="logo">
                <h1>perfu</h1>
            </div>
        

        </nav>
        <div class="content">
            
            <div class="welcome">
                <p class="mp">perfu</p>
                <p class="for">for perfumes...</p>
                <p  class="p1">the best sents!</p>
                <p class="p2">world best brands!</p>
                <p class="p3">with good price!</p>
            </div>
           
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

   
    </div>





</body>
</html>