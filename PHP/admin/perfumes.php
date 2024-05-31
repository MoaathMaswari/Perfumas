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

<div class="all">
        
        <nav>

            <ul class="nav">
               <li><a href="../login.php" class="lb">Log out</a></li>
                <li class="me">Perfumes</li>
                <li><a href="user.php">Users</a></li>
                <li><a href="main.php">Main</a</li>
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
        <li><a href="perfume/add.php">Add Prefume</a></li>
        <li><a href="perfume/edit.php">Edit Prefume</a></li>
        <li><a href="perfume/delete.php">Delete Prefume</a></li>
    
    </ul>
<div>   

<?php

    if(isset($_GET['action']) && isset($_GET['pid']) )
    {

        $Esql = "update perfume set available = :a where p_id = :i";
        $e = $perfumas->prepare($Esql);
        if($_GET['action']=="deac"){
        $e->execute(array("a" => 0 , "i" => $_GET['pid']));
        }
        elseif($_GET['action']=="ac"){
        $e->execute(array("a" => 1 , "i" => $_GET['pid']));
        }

    }

?>
    
<div class="table">

<form method ='post' action='perfumes.php?search'>
            <label for="p-search">Perfume Search</label>
                <input id="p-search" class="sin" type="text" name="per"  placeholder="Enter perfume name" value="<?php if(isset($_POST['per']))echo $_POST['per'] ?>"><input class="search" type="submit" value="Search">
        </form>

        <?php
            
            if(isset($_GET['search'])){
                ?>
                <form method ='post' action='perfumes.php?back'>
                <input class="back" type="submit" value="Back">
            </form>

            <?php
            }

            if(isset($_POST['per']) && !empty($_POST['per'])){
        
                $sql = "select * from perfume where p_name like '$_POST[per]%'";
                $q = $perfumas->prepare($sql);
                $q->execute();
        
                if(!$q->rowcount()){
                    
                    goto n;
                    }
            }
            else{
                $sql = 'select * from perfume';
                $q = $perfumas->prepare($sql);
                $q->execute();
            }
            
            ?>


    <table>
        <caption>Perfumes In Database</caption>

        <tr>

        <th>Id</th>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Image</th>
        <th>Available</th>
        <th>(De)Activate</th>

        </tr>

        <?php

        $sql2 = 'select c_id , c_name from category';
        $q2 = $perfumas->prepare($sql2);
        $q2->execute();
        $cats = $q2->fetchall();

        foreach($q->fetchall() as $row)
        {
        echo"
        <tr>
            
            <td>$row[p_id]</td>
            <td>$row[p_name]</td>
            <td>";
            foreach($cats as $cat){
            if( $row['p_cat_id'] == $cat['c_id']){
            echo $cat['c_name'];
            break;
            }}
            echo"
            </td>
            <td>$row[p_price]</td>
            <td>$row[p_qua]</td>
            <td><img src='../../img/$row[p_img]'></td>
            <td>";
            if ($row['available']==1)
            echo "Available";
            else{
                echo "Unavailable";
            }
            
            echo "</td>
            <td><a href='?action=";
            if($row['available']==1)
            echo "deac&pid=$row[p_id]'>Deactivate";
            else
            echo "ac&pid=$row[p_id]'>Activate";

        echo "</a></td>
        </tr>";
        }
        ?>


    </table>
</div>


<?php
n:
echo '<p class="err">No Such Name!</p>';   
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