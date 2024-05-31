<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../../css/add.css">

    <title>Document</title>
</head>
<body>

<?php 
require("../db/connect.php");
?>

<h1>Perfu</h1>

<?php
$d = 0;
if(isset($_POST['deleteall'])){

    $del = 'truncate user ';
    $d = $perfumas->prepare($del);
    $d->execute();
    $d = 1;
    goto d;
}


?>


</div>
    <form class="form" method="post">
        <input type="hidden" name="pid" value='<?php echo $row['p_id']; ?>' >
        <h2>Confirm deletting</h2>
        <input class="deleteall" type="submit" name='deleteall' value="Delete all users">
        <a class="cb"  href="user.php">Cancel</a>
    </form>

    
    <?php 
    d:
    if ($d == 1) {?>
    <form class="form" method="post">

        <h2>Users Deleted</h2>
 
        <a class="cb" href="user.php">Go back</a>
    </form>

<?php } ?>
 
    
</body>
</html>