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
                <li><a href="user.php">People</a></li>
                <li><a href="main.php">Main</a></li>
                <li class="me">Sales</li>
                <li><a href="settings.php">Settings</a></li>
            </ul>

            <div class="logo">
                <h1>perfu</h1>
            </div>
        </nav>
</div>


<?php

    if(isset($_GET['del']))
    {

        $usql = 'select * from sales where s_id = :x ';
        $uq = $perfumas->prepare($usql);
        $uq->execute(array("x"=> $_GET['del']));
        $sale = $uq->fetch();

        ?>
        <div class="table">
    <form class='conf' method="post" action="sales.php?del2=<?php echo $_GET['del'];?>" >
        
    <fieldset><legend>Confirm deletting</legend>
    
    <h2>Sale ID :  <?php echo $sale['s_id'];?></h2>
    <h2>Buyer ID : <?php echo $sale['su_id'];?></h2>
    <h2>Perfume ID : <?php echo $sale['sp_id'];?></h2>
    <h2>Sale Price :  <?php echo $sale['s_price'];?></h2>
    <h2>Sale Quantity : <?php echo $sale['s_qua'];?></h2>
    <h2>Date : <?php echo $sale['s_date'];?></h2>
    
    <input type="submit"  value="Delete Sale">
    <a href="sales.php" class="sign">Cancel</a>
</fieldset>
</form>
</div>


    
        <?php
        goto end;
    }

if(isset($_GET['del2'])){
$dsql = "delete from sales where s_id = :i";
    $d = $perfumas->prepare($dsql);
    $d->execute(array("i" => $_GET['del2']));
}

?>
    
    <div class="table t2">
    <form method ='post' action='sales.php?search'>
            <label for="user-search">Sales Search</label>
            <input id="user-search" class="sin" type="text" name="date"  placeholder="Enter sale date" value="<?php if(isset($_POST['date']))echo $_POST['date'] ?>"><input class="search" type="submit" value="Search">
        </form>

        <?php
            $notfound = 0;
            if(isset($_GET['search'])){
                ?>
                <form method ='post' action='sales.php?back'>
                <input class="back" type="submit" value="Back">
            </form>

            <?php
            }

            if(isset($_POST['date'])){
                $sql = "select * from sales where s_date like '%$_POST[date]%'";
                $q = $perfumas->prepare($sql);
                $q->execute();
                if(!$q->rowcount()){
                    $notfound = 1;
                    goto n;
                    }
        
                }
                else{
                $sql = 'select * from sales';
                $q = $perfumas->prepare($sql);
                $q->execute();
                }
            
            ?>


        
    <table class="user-table">
            <caption>Sales In Database</caption>

        <tr>

        <th>ID</th>
        <th>Buyer ID </th>
        <th>Perfume ID </th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Date</th>
        <th>Delete</th>


        </tr>

        <?php

        foreach($q->fetchall() as $row)
        {
        echo"
        <tr>
            
            <td>$row[s_id]</td>
            <td>$row[su_id]</td>
            <td>$row[sp_id]</td>
            <td>$row[s_price]</td>
            <td>$row[s_qua]</td>
            <td>$row[s_date]</td>
            
        
            ";
            echo "<td><a href='?del=";
            echo "$row[s_id]'>Delete Sale";
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
echo '<p class="err">No Such Date!</p>';   
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