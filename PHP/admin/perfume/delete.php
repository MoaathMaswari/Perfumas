<?php
session_start();
if(!isset($_SESSION['admin_id']))
{
    header("location:../../login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../../../css/add.css">
    <title>Document</title>
</head>
<body>
<?php 
require("../../db/connect.php");
?>

<h1>Perfu</h1>




<?php
$f = 10;

if(isset($_POST['one'])){
    ?>
    <form method='post'>
    <a class="back" href="delete.php">Go Back</a>
     <fieldset><legend>Delete Perfume</legend>
 
         <label for="n">Enter the name of perfume you wnat to delete</label> <input type="text" name="sname" id="n" placeholder="Enter perfume name" required><br>
         <input type="submit" value="Select">
     </fieldset>
     
    </form>
    <?php
    goto end;
 
}
elseif(isset($_POST['all'])){

    header("location:deleteall.php");
    esit();
    
}

if(isset($_POST['delete'])){

    $del = 'delete from perfume where p_id = :pi';
    $d = $perfumas->prepare($del);
    $d->execute(array("pi" => $_POST['pid']));
    echo '<h3 class="done">Perfume deleted</h3>';
     goto a;

}

if(isset($_POST['sname']))
{
    if(!empty($_POST['sname'])){
    $sql = 'select * from perfume where p_name = :pn';
    $q = $perfumas->prepare($sql);
    $q->execute(array("pn" => $_POST['sname']));
    if($q->rowcount()){
    $row = $q->fetch();

?>

<div class="table">

<table>
        <caption>Deletting Perfume</caption>

        <tr>

        <th>Id</th>
        <th>Name</th>
        <th>Image</th>

          
        </tr>
<?php
        
        echo"
        <tr>
            <td>$row[p_id]</td>
            <td>$row[p_name]</td>
            <td><img src='../../../img/$row[p_img]'></td>
    
        </tr>";
        
        ?>


    </table>

    </div>
    <form class="form" method="post">
        <input type="hidden" name="pid" value='<?php echo $row['p_id']; ?>' >
        <h2>Confirm deletting</h2>
        <input type="submit" name='delete' value="Delete">
        <a href="delete.php">Cancel</a>
    </form>

    
    
    <?php 
    // goto end;
    }
    else{
        echo '<h4 class="err">No such name!<h4>';
        $f = 0;
        goto end;
    }
}
else{
    echo '<h4 class="err">You have to enter perfume name<h4>';
    goto a;
    
}
}
else{
    a:
    ?>
    <form method='post'>
   <a class="back" href="../perfumes.php">Go Back</a>
    <fieldset><legend>Delete Option</legend>

    <input class="op" name='one' type="submit" value="Delete one perfume">
    </fieldset>

</form>

<form method='post'>

        <input class="op" name='all' type="submit" value="Delete all perfumes">
    </fieldset>

</form>


<?php
} 
end:
if($f == 0){
?>

<form method='post' action='delete.php'>

        <input type="submit" value="Go back">
 

</form>

<?php
}
?>

 


   
    
</body>
</html>