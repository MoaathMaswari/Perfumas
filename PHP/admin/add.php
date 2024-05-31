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
<link rel="stylesheet" href="../../CSS/logsign.css">

    <title>Sign Up</title>
</head>
<body>
<?php 
require("../db/connect.php");
?>

<h1>Perfu</h1>

<?php
$d=0;
if ( isset($_POST['adminname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['phonenumber']) && isset($_POST['address']))
{
   
   if(!empty($_POST['adminname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['phonenumber']) && !empty($_POST['address']))

        {
            $duoplicate = 0;
            $sql = 'select a_name , a_email from admin ';
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

                    if($row['a_email'] == $_POST["email"]){
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
                $sql2 = 'insert into admin (a_name,a_email,a_password,a_phone_num,a_address) values(:un,:ue,:up,:upn,:ua) ';
                $q2 = $perfumas->prepare($sql2);
                $q2->execute(array("un"=>$_POST['adminname'],"ue"=>$_POST['email'],"up"=>password_hash($_POST['password'],PASSWORD_DEFAULT),"upn"=>$_POST['phonenumber'],"ua"=>$_POST['address']));

                $sql3 = 'select a_id from admin where a_email = :x ';
                $q3 = $perfumas->prepare($sql3);
                $q3->execute(array("x"=> $_POST['email']));
                $d=1;

                goto end;

            }
        }
    else{
       
  
                echo "<p class='err'>You have to fill all the fieldsddd!<p>";
            a:?>
                <form method="post"  >

                <fieldset><legend>Add admin</legend>
                
                    <label for="un">AdminName </label> <input type="text" name="adminname" id="un" placeholder="Enter admin name" value="<?php echo $_POST['adminname'];?>" required><br>
                    <label for="em">E-mail </label> <input type="email" name="email" id="em" placeholder="Enter admin email" value="<?php echo $_POST['email'];?>" required><br>
                    <label for="pw">PassWord </label> <input type="password" name="password" id="pw" placeholder="Enter admin password" value="<?php echo $_POST['password'];?>" required><br>
                    <label for="pn">Phone Number </label> <input type="number" name="phonenumber" id="pn" placeholder="Enter admin phone number" value="<?php echo $_POST['phonenumber'];?>" required><br>
                    <label for="ad">Address </label> <input type="text" name="address" id="ad" placeholder="Enter admin address" value="<?php echo $_POST['address'];?>" required><br>
                    <input class="add" type="submit" value="Add Admin">
                   <a href="login.php" class="cancel" class="log">Cancel</a>
                </fieldset>
            </form>
            <?php
        
        }

    }
   
  
else{
    ?>
    <form method="post"  >

    <fieldset><legend>Add admin</legend>
    
        <label for="un">AdminName </label> <input type="text" name="adminname" id="un" placeholder="Enter admin name" required><br>
        <label for="em">E-mail</label> <input type="email" name="email" id="em" placeholder="Enter admin email" required><br>
        <label for="pw">PassWord </label> <input type="password" name="password" id="pw" placeholder="Enter admin password" required><br>
        <label for="pn">Phone Number</label> <input type="number" name="phonenumber" id="pn" placeholder="Enter admin phone number" required><br>
        <label for="ad">Address</label> <input type="text" name="address" id="ad" placeholder="Enter admin address" required><br>
        <input type="submit" class="add" name="add" value="Add Admin">
        <a href="admins.php" class="cancel">Cancel</a>
    </fieldset>
</form>
<?php
}
if ($d==1){

    end:

    ?>
<form method="post" action="admins.php" >
        <fieldset>

            <h3>Admin added </h3>
            <input type="submit" name="back" value="Go back">

        </fieldset>
</form>
    
    
    <?php
    
}



?>




    
</body>
</html>