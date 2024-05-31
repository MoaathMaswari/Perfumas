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
<link rel="stylesheet" href="../../css/set.css">

    <title>Document</title>
</head>


<body>

<?php 
require("../db/connect.php");
?>




<?php

$edited = 0;
if ( isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['opassword']) && isset($_POST['phonenumber']) && isset($_POST['address']))
{
    
    if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['opassword']) && !empty($_POST['phonenumber']) && !empty($_POST['address']))
    
    {

        $sql = 'select a_password from admin where a_id = :aid ';
        $q = $perfumas->prepare($sql);
        $q->execute(["aid"=>$_SESSION['admin_id']]);
        $adminoldpass = $q->fetch()['a_password'];
        
                $password = 0;
                if(password_verify($_POST['opassword'],$adminoldpass))
                {
                    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
                }

                if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
                    $edited =-3;
                    goto a;
                }
                
                
                if($password != 0 )
                {
                    $sql2 = 'update admin set
                    a_name = :un,
                    a_email = :ue,
                    a_password = :up,
                    a_phone_num = :upn,
                    a_address = :ua where a_id = :aid';
                    $q2 = $perfumas->prepare($sql2);
                    $q2->execute(array("un"=>$_POST['username'],"ue"=>$_POST['email'],"up"=>$password,"upn"=>$_POST['phonenumber'],"ua"=>$_POST['address'],"aid"=>$_SESSION['admin_id']));
                    $edited = 1;
                
                    
                }
                else{
                    $edited = -1;
                  
                }

    }
    else{
        $edited = -2;
    }
    a:
}
    



?>


<div class="all">
        
        <nav>

            <ul class="nav">
               <li><a href="../login.php" class="lb">Log out</a></li>
                <li><a href="perfumes.php">Perfumes</a></li>
                <li><a href="user.php">Users</a></li>
                <li><a href="main.php">Main</a></li>
                <li><a href="sales.php">Sales</a></li>

                <li class="me">Settings</li>
            </ul>

            <div class="logo">
                <h1>perfu</h1>
            </div>
        </nav>
</div>

<div class="div">
    <h3>Settings</h3>

    <?php
    $usql = 'select * from admin where a_id = :x ';
    $uq = $perfumas->prepare($usql);
    $uq->execute(array("x"=> $_SESSION['admin_id']));
    $admin = $uq->fetch();
    ?>
</div>

<div class="info">
    <h4>Name: <p><?php echo $admin['a_name'];?><p></h4>
    <h4>E-mail:  <p><?php echo $admin['a_email'];?><p></h4>
</div>

    <div>
    
    <?php

if(isset($_POST['del'])){

    ?>
    
    <form method="post"  >

    <fieldset><legend>Delete my ccount</legend>

        <input class="conf" type="submit" name="confirm" value="Confirm">
         <a href="settings.php" class="log">Cancel</a>
            </fieldset>
</form>
    
    <?php
    goto noset;
}

if(isset($_POST['confirm'])){
    
    $del = "delete from admin where a_id = :ui";
    $d = $perfumas->prepare($del);
    $d->execute(array("ui"=> $_SESSION['admin_id']));

    session_reset();
    session_destroy();
     echo "<script>
     location.replace('../login.php')
     </script>";
}
elseif(isset($_POST['edit'])){
    

    ?>


<form method="post"  >

    <fieldset><legend>Edit Account</legend>

        <label for="un">UserName </label> <input type="text" name="username" id="un" placeholder="Enter your name" value="<?php echo $admin['a_name'];?>" required><br>
        <label for="em">E-mail </label> <input type="email" name="email" id="em" placeholder="Enter email" value="<?php echo $admin['a_email'];?>" required><br>
        <label for="opw">Old PassWord </label> <input type="password" name="opassword" id="opw" placeholder="Enter old password" required><br>
        <label for="pw">New PassWord </label> <input type="password" name="password" id="pw" placeholder="Enter new password" required><br>
        <label for="pn">Phone Number </label> <input type="number" name="phonenumber" id="pn" placeholder="Enter your phone number" value="<?php echo $admin['a_phone_num'];?>" required><br>
        <label for="ad">Address </label> <input type="text" name="address" id="ad" placeholder="Where do you live" value="<?php echo $admin['a_address'];?>" required><br>
        <input type="submit" name="edited" value="Edit">
         <a href="settings.php" class="log">Cancel</a>
            </fieldset>
</form>

    <?php
    goto noset;
}
elseif(isset($_POST['edited'])){
    if($edited != 0 ){
        if($edited == -1 ){
            echo '<p class="err">Wrong old password!</p>';
        }
        elseif($edited == -2){
            echo '<p class="err">You have to fill all the fields!</p>';

        }
        elseif($edited == 1){
            echo '<p class="edit">Account Edited successefully!</p>';
            goto e;
        }
        elseif($edited == -3){
            echo "<p class = 'err'>Email is not valid</p>";
            echo "<p class = 'err'>Example : name@thing.com</p>";
        }
        
    ?>

<form method="post"  >

<fieldset><legend>Edit Account</legend>

    <label for="un">UserName </label> <input type="text" name="username" id="un" placeholder="Enter your name" value="<?php echo $_POST['username'];?>" required><br>
    <label for="em">E-mail </label> <input type="email" name="email" id="em" placeholder="Enter email" value="<?php echo $_POST['email'];?>" required><br>
    <label for="opw">Old PassWord </label> <input type="password" name="opassword" id="opw" placeholder="Enter old password" required><br>
    <label for="pw">New PassWord </label> <input type="password" name="password" id="pw" placeholder="Enter new password" required><br>
    <label for="pn">Phone Number </label> <input type="number" name="phonenumber" id="pn" placeholder="Enter your phone number" value="<?php echo $_POST['phonenumber'];?>" required><br>
    <label for="ad">Address </label> <input type="text" name="address" id="ad" placeholder="Where do you live" value="<?php echo $_POST['address'];?>" required><br>
    <input type="submit" name="edited" value="Edit">
     <a href="settings.php" class="log">Cancel</a>
        </fieldset>
</form>


<?php
 goto noset;
        }
}

e:
?>


<form class="set" method="post">
    <input type="submit" name="edit" value="Edit my account">
    <input type="submit" name="del" class="del" value="Delete my account">
    </form>
</div>

<?php noset: ?>


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