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

if ( isset($_POST['name']) && isset($_POST['cat']) && isset($_POST['price']) && isset($_POST['qua']) && isset($_POST['img']) && isset($_POST['ava']))
{


    if ( !empty($_POST['name']) && !empty($_POST['cat']) && !empty($_POST['price']) && (!empty($_POST['qua']) || $_POST['qua']==0) && (!empty($_POST['img']) || isset($_POST['oimg'])) && (!empty($_POST['ava']) || $_POST['ava']==0)){
        
        $img = $_POST['oimg'];
        if(!empty($_POST['img'])){
            $img = $_POST['img'];

        }
        $sql = 'update perfume set p_name = :n
         , p_cat_id = :c
         ,p_price = :p
         ,p_qua = :q
         ,p_img = :i
         ,available = :a  where p_id = :pn ';
        $q = $perfumas->prepare($sql);
        $q->execute(array("n"=>$_POST['name'],"c"=>$_POST['cat'],"p"=>$_POST['price'],"q"=>$_POST['qua'],"i"=>$img,"a"=>$_POST['ava'],"pn"=>(int)$_POST['pid']));
        echo "<p class='done'>Perfume edited seccesfully</p>";
        goto a;

    }
}

if( isset($_POST['sname']))
{

    if(empty($_POST['sname']))
    {
        echo"<p class='err'>You have to enter perfume name!<p>";
        goto a;
    }
    else{
    $sql = 'select p_id , p_name , p_cat_id , p_price , p_qua , p_img , available from perfume where p_name = :n ';
            $q = $perfumas->prepare($sql);
            $q->execute(array("n"=>$_POST['sname']));
           if($q->rowcount())
           {
            $arr = $q->fetch();

                $p_id = $arr['p_id'];
                $p_name = $arr['p_name'];
                $p_price = $arr['p_price'];
                $p_cat_id = $arr['p_cat_id'];
                $p_qua = $arr['p_qua'];
                $p_img = $arr['p_img'];
                $available = $arr['available'];

                ?>

<form method="post"  >
    <a class="back" href="../perfumes.php">Go Back</a>

    <fieldset><legend>Edit Perfume</legend>
            <input type="hidden" name="pid" value="<?php echo $p_id; ?>">
        <label for="n">Perfume Name</label> <input type="text" name="name" id="n" placeholder="Enter perfume name" value="<?php echo $p_name;?>" required><br>
        <label >Perfume Category </label><br>
            <label class="ra" for="m">MEN </label><input type="radio" name="cat" id="m" value="1" <?php if($p_cat_id == "1"){?> checked<?php } ?>  required>
            <label class="ra" for="w">WOMEN</label><input type="radio" name="cat" id="w" value="2" <?php if($p_cat_id == "2"){?>checked<?php } ?> required>
            <label class="ra" for="b">BOTH</label><input type="radio" name="cat" id="b" value="3" <?php if($p_cat_id == "3"){?>checked<?php } ?> required><br>
        <label for="p">Perfume price </label> <input type="number" name="price" id="p" placeholder="Enter perfume price" value="<?php echo $p_price;?>" required><br>
        <label for="q">Perfume Quantity </label> <input type="number" name="qua" id="q" placeholder="Enter perfume quantity" value="<?php echo $p_qua;?>" required>
        <label for="i" class="img">Perfume Image </label><img id='old' src="../../../img/<?php echo $p_img;?>"><br>
        
        <input type="file" name="img" id="i" accept="image/*">
        <input type="hidden" name="oimg" value="<?php echo $p_img; ?>">

        <img class='pic' id="img" ><br>
        <label class="ra" for="a">Available</label><input type="radio" id="a" value="1" <?php if($available == "1"){?>checked<?php } ?> name="ava" >
        <label class="ra" for="ua">Unavailable</label><input type="radio" id="ua" value="0" <?php if($available == "0"){?>checked<?php } ?> name="ava">
        <input type="submit" value="EDIT">

    </fieldset>
    <button class="back" name="cancel" value="cancel" >Cancel</button>


</form>

                <?php
            }
            else{
                echo
                "<p class='err'>No such perfume name!</p>";
                goto a;
            }
}
}
else
{a:
    ?>

    <form method='post'>
       <a class="back" href="../perfumes.php">Go Back</a>
        <fieldset><legend>Edit Perfume</legend>

            <label for="n">Enter the name of perfume you wnat to edit</label> <input type="text" name="sname" id="n" placeholder="Enter perfume name" required><br>
            <input type="submit" value="FIND">
        </fieldset>

    </form>

<?php
}

?>

<script>


let imgname = document.getElementById("i");
let img = document.getElementById("img");
let old = document.getElementById("old");



imgname.addEventListener('input' ,_=>{
    if(imgname.files.length != ""){
        img.src = "../../../img/"+imgname.files[0].name;
        old.style.display = "none";
        img.style.display = "inline";
    


    }
    else{
        img.src = "";
        img.style.display = 'none';
        old.style.display = "inline";

        img.alt = "Chosse an image";

    }
})

</script>





</body>
</html>