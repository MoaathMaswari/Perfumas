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
$d = 0;
if(isset($_POST['deleteall'])){

    $del = 'truncate perfume ';
    $d = $perfumas->prepare($del);
    $d->execute();
    if($d->rowcount())
    {

        $d = 1;
    }
    else{
        $d = 2;
    }
    goto d;
}


?>


</div>
    <form class="form" method="post">
        <input type="hidden" name="pid" value='<?php echo $row['p_id']; ?>' >
        <h2>Confirm deletting</h2>
        <input class="deleteall" type="submit" name='deleteall' value="Delete all perfumes">
        <a class="cb"  href="delete.php">Cancel</a>
    </form>

    
    <?php 
    d:
    if ($d == 1) {?>
    <form class="form" method="post">

        <h2 class="done">Perfumes Deleted</h2>
 
        <a class="cb" href="../perfumes.php">Go back</a>
    </form>

<?php }
elseif($d == 2)
{
    ?>
    <form class="form" method="post">

<h2 class='err'>No perfumes in database</h2>

<a class="cb" href="../perfumes.php">Go back</a>
</form>
    <?php
}
?>
 
</body>
</html>