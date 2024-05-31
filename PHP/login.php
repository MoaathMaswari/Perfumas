<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="../CSS/logsign.css">

    <title>Log In</title>
</head>
<body>
    
<?php 
require("db/connect.php");
?>

<h1>Perfu</h1>

<?php
if (!isset($_POST['email']) && !isset($_POST['password'])){


?>
<form method="post"  >

    <fieldset><legend>Log In</legend>
    
        <label for="em">E-mail </label> <input type="email" name="email" id="em" placeholder="Enter email" required><br>
        <label for="pw">PassWord </label> <input type="password" name="password" id="pw" placeholder="Enter password" required><br>

        <input type="submit" value="Log In">
        <P>You don't have an account? <a href="signup.php" class="sign">Sign Up</a></P>
    </fieldset>
</form>
<?php
}
?>

<?php

if (isset($_POST['email']) && isset($_POST['password']))
{
    if(!empty($_POST['email']) && !empty($_POST['password']))
    {
        
            $sql = 'select u_id , u_email , u_password , active from user where u_email = :x ';
            $q = $perfumas->prepare($sql);
            $q->execute(array("x"=>$_POST['email']));
            $user = $q->fetch();
            if($q->rowcount())
            {
                if(password_verify($_POST['password'],$user['u_password'])){
                    if($user['active'] == 0){
                        echo '<p class="blocked">Sorry, you are blocked!</p>';
                        ?>
                        <form method="post"  >
                
                            <fieldset><legend>Log In</legend>
                
                                <label for="em">E-mail </label> <input type="email" name="email" id="em" placeholder="Enter email" value="<?php echo $_POST['email'];?>" required><br>
                                <label for="pw">PassWord </label> <input type="password" name="password" id="pw" placeholder="Enter password" required><br>
                
                                <input type="submit" value="Log In">
                                <P>You don't have an account? <a href="signup.php" class="sign">Sign Up</a></P>
                            </fieldset>
                        </form>
                <?php
                    }
                    else{
                $_SESSION["user_id"] = $user['u_id'];
                 header("location:user/main.php") ;
                    }

            }
        }
            else 
            {
                $sql = 'select a_id , a_email , a_password from admin where a_email = :x ';
                $q = $perfumas->prepare($sql);
                $q->execute(array("x"=>$_POST['email']));
                $admin = $q->fetch();
                if($q->rowcount() && password_verify($_POST['password'],$admin['a_password']))
                {
                    $_SESSION["admin_id"] = $admin['a_id'];
                     header("location:admin/main.php") ;
                }
                else
                {
                    echo "<p class='err'>Wrong Emial or Password! <p>"; 
                    ?>
                    
                    <form method="post"  >

                        <fieldset><legend>Log In</legend>

                            <label for="em">E-mail </label> <input type="email" name="email" id="em" placeholder="Enter email" value="<?php echo $_POST['email'];?>" required><br>
                            <label for="pw">PassWord </label> <input type="password" name="password" id="pw" placeholder="Enter password"  required><br>

                            <input type="submit" value="Log In">
                            <P>You don't have an account? <a href="signup.php" class="sign">Sign Up</a></P>
                        </fieldset>
                    </form>   
                    <?php
                }
            }
    }
    else
    {
        ?>
        <form method="post"  >

            <fieldset><legend>Log In</legend>

                <label for="em">E-mail </label> <input type="email" name="email" id="em" placeholder="Enter email" value="<?php echo $_POST['email'];?>" required><br>
                <label for="pw">PassWord </label> <input type="password" name="password" id="pw" placeholder="Enter password" required><br>

                <input type="submit" value="Log In">
                <P>You don't have an account? <a href="signup.php" class="sign">Sign Up</a></P>
            </fieldset>
        </form>
<?php
        echo "<p class='err'>You have to fill all the fields!<p>";
    }
                                

       


}


?>
    
</body>
</html>