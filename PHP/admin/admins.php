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
<link rel="stylesheet" href="../../css/perfum.css">

    <title>Document</title>
</head>
<body>

<?php 
require("../db/connect.php");
?>

<?php
        
            $ssql = "select super_admin from admin where a_id = :i";
            $s = $perfumas->prepare($ssql);
            $s->execute(["i"=> $_SESSION['admin_id']]);
            $super = $s->fetch()['super_admin'] ;
        
?>

<div class="all">
        
        <nav>

            <ul class="nav">
               <li><a href="../login.php" class="lb">Log out</a></li>
                <li><a href="perfumes.php">Perfumes</a></li>
                <li class="me">People</li>
                <li><a href="main.php">Main</a></li>
                <li><a href="settings.php">Settings</a></li>
            </ul>

            <div class="logo">
                <h1>perfu</h1>
            </div>
        </nav>
</div>

<div class="content">
    <ul class='nav2'>
        <li class="me2">Admins</li>
        <?php
        if($super == 1){
        ?>
        <li ><a class="sub" href="add.php">Add Admin</a></li>

        <?php } ?>
        <li><a href="user.php">Users</a></li>
        </ul>
<div>   
<?php
if(isset($_GET['del']))
    {

        $usql = 'select a_name , a_email , a_id from admin where a_id = :x ';
        $uq = $perfumas->prepare($usql);
        $uq->execute(array("x"=> $_GET['del']));
        $user = $uq->fetch();

        ?>
        <div class="table">
    <form class='conf' method="post" action="admins.php?del2=<?php echo $_GET['del'];?>" >
        
    <fieldset><legend>Confirm deletting</legend>
    
    <h2>ID:  <?php echo $user['a_id'];?></h2>
    <h2>Name: <?php echo $user['a_name'];?></h2>
    <h2>E-mail:  <?php echo $user['a_email'];?></h2>
    
    <input type="submit"  value="Delete Adimn">
    <a href="admins.php" class="sign">Cancel</a>
</fieldset>
</form>
</div>

    
        <?php
        goto end;
    }

if(isset($_GET['del2'])){
$dsql = "delete from admin where a_id = :i";
    $d = $perfumas->prepare($dsql);
    $d->execute(array("i" => $_GET['del2']));
}

?>
    

    <div class="table">
            <form method ='post' action='admins.php?search'>
                <label for="user-search">Admin Search</label>
                <input id="user-search" class="sin" type="text" name="admin"  placeholder="Enter admin name" value="<?php if(isset($_POST['admin']))echo $_POST['admin'] ?>"><input class="search" type="submit" value="Search">
            </form>
        
            <?php
            
            if(isset($_GET['search'])){
                ?>
                <form method ='post' action='admins.php?back'>
                <input class="back" type="submit" value="Back">
            </form>

            <?php
            }
            
            ?>

        <?php
        if(isset($_POST['admin']) && $_POST['admin'] != '')
        {
            $sql = "select * from admin where a_name like '$_POST[admin]%'";
            $q = $perfumas->prepare($sql);
            $q->execute();
            if(!$q->rowcount()){
            
            goto n;
            }
            
        }
        else{
        $sql = 'select * from admin';
        $q = $perfumas->prepare($sql);
        $q->execute();
        if(!$q->rowcount())
        goto n;

        }

        ?>

        
    <table class="user-table">
            <caption>Admins In Database</caption>

        <tr>

        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone Number</th>

        <?php

        if($super == 1){
        ?>
                <th>Delete Admin</th>
        <?php }
        else{
            ?>
            <th>Admin Status</th>
            <?php

        } ?>


        </tr>

        <?php

        foreach($q->fetchall() as $row)
        {
        echo"
        <tr>
            
            <td>$row[a_id]</td>
            <td>$row[a_name]</td>
            <td>$row[a_email]</td>
            <td>$row[a_phone_num]</td>";
            if($super == 1){
            if($row['super_admin'] == 0){
            echo "<td><a href='?del=";
            echo "$row[a_id]'>Delete Admin";
            echo "</a>
            </td>";
            }
            elseif($row['super_admin'] == 1){
                echo "<td>BOSS</td>";
            }
        }
        else{

            if($row['super_admin'] == 0){
                echo "<td>";
                echo "Admin";
               echo"</td>";
                }
                elseif($row['super_admin'] == 1){
                    echo "<td>Super Admin</td>";
                }

        }
            
            
           echo "</tr>";
        }
        ?>
    </table>
</div>

<?php
n:
echo '<p class="err">No Such Name!</p>';   
end:
?>
<script>

    let sbtn = document.body.getElementsByClassName('search')[0];
    let bbtn = document.body.getElementsByClassName('search')[0];

        <?php if(isset($_GET['search'])){ ?>
            btbn.style.diplay = 'none';
            <?php }
    elseif(isset($_GET['back'])){

        ?>
            stbn.style.diplay = 'none';

        <?php
    }
       
               
            ?>
</script>
    
</body>
</html>