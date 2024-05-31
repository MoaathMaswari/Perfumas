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
                <li><a href="sales.php">Sales</a></li>
                <li><a href="settings.php">Settings</a></li>
            </ul>

            <div class="logo">
                <h1>perfu</h1>
            </div>
        </nav>
</div>

<div class="content">
    <ul class='nav2'>
        <li><a href="admins.php">Admins</a></li>
        <li class="me2">Users</li>
        <?php
        if($super == 1){
        ?>
        <li ><a class="sub" href="deleteall.php">Delete all users</a></li>

        <?php } ?>
        </ul>
<div>   

<?php

    if(isset($_GET['action']) && isset($_GET['uid']) )
    {

        $Esql = "update user set active = :a where u_id = :i";
        $e = $perfumas->prepare($Esql);
        if($_GET['action']=="deac"){
        $e->execute(array("a" => 0 , "i" => $_GET['uid']));
        }
        elseif($_GET['action']=="ac"){
        $e->execute(array("a" => 1 , "i" => $_GET['uid']));
        }

    }
    elseif(isset($_GET['del']))
    {

        $usql = 'select u_name , u_email , u_id from user where u_id = :x ';
        $uq = $perfumas->prepare($usql);
        $uq->execute(array("x"=> $_GET['del']));
        $user = $uq->fetch();

        ?>
        <div class="table">
    <form class='conf' method="post" action="user.php?del2=<?php echo $_GET['del'];?>" >
        
    <fieldset><legend>Confirm deletting</legend>
    
    <h2>ID:  <?php echo $user['u_id'];?></h2>
    <h2>Name: <?php echo $user['u_name'];?></h2>
    <h2>E-mail:  <?php echo $user['u_email'];?></h2>
    
    <input type="submit"  value="Delete User">
    <a href="user.php" class="sign">Cancel</a>
</fieldset>
</form>
</div>

    
        <?php
        goto end;
    }

if(isset($_GET['del2'])){
$dsql = "delete from user where u_id = :i";
    $d = $perfumas->prepare($dsql);
    $d->execute(array("i" => $_GET['del2']));
}

?>
    
    <div class="table">
    <form method ='post' action='user.php?search'>
            <label for="user-search">User Search</label>
            <input id="user-search" class="sin" type="text" name="user"  placeholder="Enter user name" value="<?php if(isset($_POST['user']))echo $_POST['user'] ?>"><input class="search" type="submit" value="Search">
        </form>

        <?php
            $notfound = 0;
            if(isset($_GET['search'])){
                ?>
                <form method ='post' action='user.php?back'>
                <input class="back" type="submit" value="Back">
            </form>

            <?php
            }

            if(isset($_POST['user'])){
                $sql = "select * from user where u_name like '$_POST[user]%'";
                $q = $perfumas->prepare($sql);
                $q->execute();
                if(!$q->rowcount()){
                    $notfound = 1;
                    goto n;
                    }
        
                }
                else{
                $sql = 'select * from user';
                $q = $perfumas->prepare($sql);
                $q->execute();
                }
            
            ?>


        
    <table class="user-table">
            <caption>Users In Database</caption>

        <tr>

        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Status</th>
        <th>(De)Activate</th>
        <th>Delete</th>

        </tr>

        <?php

        foreach($q->fetchall() as $row)
        {
        echo"
        <tr>
            
            <td>$row[u_id]</td>
            <td>$row[u_name]</td>
            <td>$row[u_email]</td>
            <td>";
            if ($row['active']==1)
            echo "Active";
            else{
                echo "Inactive";
            }
            
            echo "
            </td>
            <td><a href='?action=";
            if($row['active']==1)
            echo "deac&uid=$row[u_id]'>Deactivate";
            else
            echo "ac&uid=$row[u_id]'>Activate";

            echo "</a></td>
            <td><a href='?del=";
           
            echo "$row[u_id]'>Delete User";

            echo "</a>
            </td>
            
            </tr>";
        }
        ?>
    </table>
</div>


<?php
n:
if($notfound)
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