<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../CSS/logsign.css">

    <title>Sign Up</title>
</head>
<body>
<?php 
require("db/connect.php");
?>

<h1>Perfu</h1>

<?php
$d=0;
if ( isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['paynum']) && isset($_POST['phonenumber']) && isset($_POST['address']))
{
   
   if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['paynum']) && !empty($_POST['phonenumber']) && !empty($_POST['address']))

        {
            $duoplicate = 0;
            $sql = 'select u_name , u_email from user ';
            $q = $perfumas->prepare($sql);
            $q->execute();
            if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
                echo "<p class = 'err'>Email is not valid</p>";
                echo "<p class = 'err'>Example : name@thing.com</p>";
                goto a;
            }

            if($q->rowcount()){
            foreach($q->fetchall() as $row)
            {
                // if($row['u_name'] == $_POST["username"]){
                    //     echo 'Sorry, this user-name is already taken'
                    
                    if($row['u_email'] == $_POST["email"]){
                        echo '<p class = "err">Sorry, this e-mail has an account already!</p>';
                        goto a;
                    }
                    else{
                        $duoplicate = 1;
                    }
                }
            }
            else{
                $duoplicate = 1;
            }

            if($duoplicate == 1)
            {
                $sql2 = 'insert into user (u_name,u_email,u_password,u_pay_num,u_phone_num,u_address) values(:un,:ue,:up,:upan,:upn,:ua) ';
                $q2 = $perfumas->prepare($sql2);
                $q2->execute(array("un"=>$_POST['username'],"ue"=>$_POST['email'],"up"=>password_hash($_POST['password'],PASSWORD_DEFAULT),"upan"=>$_POST['paynum'],"upn"=>$_POST['phonenumber'],"ua"=>$_POST['address']));

                $sql3 = 'select u_id from user where u_email = :x ';
                $q3 = $perfumas->prepare($sql3);
                $q3->execute(array("x"=> $_POST['email']));
                $_SESSION["user_id"] = $q3->fetch()['u_id'];
                $d=1;
                goto clear;
                cleared:
                header("location:user/main.php") ;
                exit();
            }
        }
    else{
       
  
                echo "<p class='err'>You have to fill all the fieldsddd!<p>";
            a:?>
                <form method="post"  >

                <fieldset><legend>Sign Up</legend>
                
                    <label for="un">UserName </label> <input type="text" name="username" id="un" placeholder="Enter your name" value="<?php echo $_POST['username'];?>" required><br>
                    <label for="em">E-mail </label> <input type="email" name="email" id="em" placeholder="Enter email" value="<?php echo $_POST['email'];?>" required><br>
                    <label for="pw">PassWord </label> <input type="password" name="password" id="pw" placeholder="Enter password" value="<?php echo $_POST['password'];?>" required><br>
                    <label for="pan">Pay Number </label> <input type="password" name="paynum" id="pan" placeholder="Enter your pay number" value="<?php echo $_POST['paynum'];?>" required><br>
                    <label for="pn">Phone Number </label> <input type="number" name="phonenumber" id="pn" placeholder="Enter your phone number" value="<?php echo $_POST['phonenumber'];?>" required><br>
                    <label for="ad">Address </label> <input type="text" name="address" id="ad" placeholder="Where do you live" value="<?php echo $_POST['address'];?>" required><br>
                    <input type="submit" value="Sign Up">
                    <p>I have an account already <a href="login.php" class="log">Log In</a></p>
                </fieldset>
            </form>
            <?php
        
        }

    }
   
  
else{
    clear:
    ?>
    <form method="post"  >

    <fieldset><legend>Sign Up</legend>
    
        <label for="un">UserName </label> <input type="text" name="username" id="un" placeholder="Enter your name" required><br>
        <label for="em">E-mail</label> <input type="email" name="email" id="em" placeholder="Enter email" required><br>
        <label for="pw">PassWord </label> <input type="password" name="password" id="pw" placeholder="Enter password" required><br>
        <label for="pan">Pay Nmber</label> <input type="password" name="paynum" id="pan" placeholder="Enter your pay number" required><br>
        <label for="pn">Phone Number</label> <input type="number" name="phonenumber" id="pn" placeholder="Enter your phone number" required><br>
        <label for="ad">Address</label> <input type="text" name="address" id="ad" placeholder="Where do you live" required><br>
        <input type="submit" value="Sign Up">
        <p>I have an account already <a href="login.php" class="log">Log In</a></p>
    </fieldset>
</form>
<?php
}
if ($d==1){
    goto cleared;
}



?>




    
</body>
</html>