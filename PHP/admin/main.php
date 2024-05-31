<?php
session_start();
if(!isset($_SESSION['admin_id']))
{
    header("location:../login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../../css/project.css">
    <title>Document</title>
</head>
<body>

<?php 
require("../db/connect.php");
?>

<div class="all">
        
        <nav>

            <ul class="nav">
               <li><a  class="lb">Log out</a></li>
               <script> document.body.getElementsByClassName('lb')[0].addEventListener('click',_=>{

                location.replace('../login.php');
               }) </script>
                <li><a href="perfumes.php">Perfumes</a></li>
                <li><a href="user.php">Users</a></li>
                <li class="me">Main</li>
                <li><a href="sales.php">Sales</a></li>
                <li><a href="settings.php">Settings</a></li>
            </ul>

            <div class="logo">
                <h1>perfu</h1>
            </div>
        </nav>
</div>

<?php
   $sql = 'select a_name from admin where a_id = :x ';
   $q = $perfumas->prepare($sql);
   $q->execute(array("x"=>$_SESSION['admin_id']));
    $a_name = $q->fetch()['a_name'];
   echo "<div class='a-hi'>Admin<br> $a_name<br> Welcome  to 
   <h1>PERFUMAS</h1><br></div>
   
   "; 
?>
    
</body>
</html>