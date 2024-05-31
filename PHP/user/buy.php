<?php
session_start();
if(!isset($_SESSION['user_id']))
{
    header("location:../login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../css/buy.css">

    <title>Document</title>
</head>

<body>

<?php 
require("../db/connect.php");
?>

<?php

if(isset($_POST['back'])){
    echo "<script> location.replace('perfumes.php'); </script>";
}

?>

<h1>Perfu</h1>

<?php

$usql = 'select u_name , u_email , u_address , u_pay_num from user where u_id = :x ';
$uq = $perfumas->prepare($usql);
$uq->execute(array("x"=> $_SESSION['user_id']));
$user = $uq->fetch();

$sql = 'select p_name , p_cat_id , p_qua ,  p_price , p_img  from perfume where p_id = :i';
$q = $perfumas->prepare($sql);
$q->execute(array("i" => $_GET['pid']));
$row = $q->fetch();

$sql2 = 'select c_id , c_name from category';
$q2 = $perfumas->prepare($sql2);
$q2->execute();
$cats = $q2->fetchall();

if(isset($_POST['paynum']) && $_POST['paynum'] == $user['u_pay_num'])
{
    if((int)$_POST['qua'] <= (int)$row['p_qua'])
    {
        $r_qua = (int)$row['p_qua'] - (int)$_POST['qua'];
        $esql = "update perfume set p_qua = :a where p_id = :pi";
        $e = $perfumas->prepare($esql);
        $e->execute(array("a" => $r_qua , "pi" => $_GET['pid'] ));

        $ssql = 'insert into sales (su_id,sp_id,s_price,s_qua) values (:u,:p,:pr,:q)';
        $s = $perfumas->prepare($ssql);
        $s->execute(["u"=> $_SESSION['user_id'] , "p"=> $_GET['pid'] , "pr"=> $_POST["price"]  ,  "q"=>  $_POST['qua']]);

            goto b;
        
    }
}

?>

<div class="table">

<table>
        <caption>Buying Perfume</caption>

        <tr>

        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Image</th>


        </tr>
<?php
        
        echo"
        <tr>
            
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
    
        </tr>";
        
        ?>


    </table>

    </div>

    <?php
    
    if(isset($_POST['paynum']) && isset($_POST['qua']))
{
    if($_POST['qua'] > $row['p_qua'])
        echo "<p class='qua'>Available quantity is $row[p_qua]</p>";
    if($_POST['paynum'] != $user['u_pay_num'])
        echo "<p class='qua'>Pay number is incorrect</p>";
}

    ?>

<form method="post"  >


<fieldset><legend>Confirmation</legend>

    <h2>Name: <?php echo $user['u_name'];?></h2>
    <h2>E-mail:  <?php echo $user['u_email'];?></h2>
    <h2>Address:  <?php echo $user['u_address'];?></h2>

    <label for="q"> Quantity </label> <input type="number" name="qua" id="qua" placeholder="Enter quantity to buy" value="<?php if(isset($_POST["qua"])) echo "$_POST[qua]"; ?>" required><br>
    <label for="pan">Pay Number </label> <input type="password" name="paynum" id="pan" placeholder="Enter pay number" value="<?php if(isset($_POST['paynum'])) echo "$_POST[paynum]"; ?>"  required><br>
    Cost: <pre class="price">0</pre>
    <input type="hidden" class="pr" name="price" value ='0' >
    <input type="submit" value="Confirm">
    <a href="perfumes.php" class="sign">Cancel</a>
</fieldset>
</form>

<?php

if( false ){
    b:

    
    ?>

<form method="post"  >


<fieldset>

<?php  echo $_POST['price'];?>
    <h3>Perfume bought </h3>
    <input type="submit" name="back" value="Go back">

</fieldset>
</form>

<?php
    
    
}

?>


<script>

let price = document.body.getElementsByClassName('price')[0];
let pr = document.body.getElementsByClassName('pr')[0];
let qua = document.getElementById ('qua');
price.innerHTML = qua.value * <?php echo $row['p_price'] ?>;
pr.value = qua.value * <?php echo $row['p_price'] ?>;
qua.addEventListener('input' , _=>{
if(qua.value != ''  ){
price.innerHTML = qua.value * <?php echo $row['p_price'] ?>;
pr.value = qua.value * <?php echo $row['p_price'] ?>;
}
else{
    price.innerHTML = 0;
    // pr.value = 0;
}

})

</script>



    
</body>
</html>