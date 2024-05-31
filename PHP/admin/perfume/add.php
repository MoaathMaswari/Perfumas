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


        if ( !empty($_POST['name']) && !empty($_POST['cat']) && !empty($_POST['price']) && !empty($_POST['qua']) && !empty($_POST['img']) && (!empty($_POST['ava']) || $_POST['ava']==0))
        {
            $sql = 'insert into perfume (p_name,p_cat_id,p_price,p_qua,p_img,available) values (:n,:c,:p,:q,:i,:a) ';
            $q = $perfumas->prepare($sql);
            $q->execute(array("n"=>$_POST['name'],"c"=>$_POST['cat'],"p"=>$_POST['price'],"q"=>$_POST['qua'],"i"=>$_POST['img'],"a"=>$_POST['ava']));
            echo "<p class='done'>Perfume added seccesfully</p>";
            goto a;
        }
        elseif ( !empty($_POST['name']) && !empty($_POST['cat']) && !empty($_POST['price']) && !empty($_POST['qua']) && empty($_POST['img']) && (!empty($_POST['ava']) || $_POST['ava']==='0'))
        {
            echo "<p class='err'>Please choose perfume imgage</p>";
                goto c;
        }
        else{
            echo "<p class='err'>Please fill all fields  </p> ";
            c:
            ?>
<form method="post"  >
<a class="back" href="../perfumes.php">Go Back</a>

    <fieldset><legend>Add Perfume</legend>

        <label for="n">Perfume Name</label> <input type="text" name="name" id="n" placeholder="Enter perfume name" value="<?php echo $_POST['name'];?>" required><br>
        <label >Perfume Category </label><br>
        <label class="ra" for="m">MEN </label><input type="radio" name="cat" id="m" value="1" <?php if($_POST['cat'] == "1"){?>checked<?php } ?>  required>
            <label class="ra" for="w">WOMEN</label><input type="radio" name="cat" id="w" value="2" <?php if($_POST['cat'] == "2"){?>checked<?php } ?> required>
            <label class="ra" for="b">BOTH</label><input type="radio" name="cat" id="b" value="3" <?php if($_POST['cat'] == "3"){?>checked<?php } ?> required><br>
        <label for="p">Perfume price </label> <input type="number" name="price" id="p" placeholder="Enter perfume price" value="<?php echo $_POST['price'];?>" required><br>
        <label for="q">Perfume Quantity </label> <input type="number" name="qua" id="q" placeholder="Enter perfume quantity" value="<?php echo $_POST['qua'];?>" required>
        <label for="i" class="img">Perfume Image</label><input type="file" name="img" id="i" accept="image/*">
        <img class='pic' id="img" ><br>
        <label class="ra" for="a">Available</label><input type="radio" id="a" value="1" <?php if($_POST['ava'] == "1"){?>checked<?php } ?> name="ava" >
        <label class="ra" for="ua">Unavailable</label><input type="radio" id="ua" value="0" <?php if($_POST['ava'] == "0"){?>checked<?php } ?> name="ava">
        <input type="submit" value="ADD">

    </fieldset>

</form>
            
            <?php
        }
       
    }
    else{
        a:
        ?>
        
<form method="post"  >
    <a class="back" href="../perfumes.php">Go Back</a>

    <fieldset><legend>Add Perfume</legend>

        <label for="n">Perfume Name</label> <input type="text" name="name" id="n" placeholder="Enter perfume name" required><br>
        <label >Perfume Category </label><br>
        <label class="ra" for="m">MEN </label><input type="radio" name="cat" id="m" value="1" checked required>
            <label class="ra" for="w">WOMEN</label><input type="radio" name="cat" id="w" value="2" required>
            <label class="ra" for="b">BOTH</label><input type="radio" name="cat" id="b" value="3" required><br>
        <label for="p">Perfume price </label> <input type="number" name="price" id="p" placeholder="Enter perfume price" required><br>
        <label for="q">Perfume Quantity </label> <input type="number" name="qua" id="q" placeholder="Enter perfume quantity" required >
        <label for="i" class="img">Perfume Image</label><input class='imeg' type="file" name="img" value="hi" id="i" accept="image/*">
        <img class='pic' id="img" ><br>
        <label class="ra" for="a">Available</label><input type="radio" id="a" value="1" name="ava" checked>
        <label class="ra" for="ua">Unavailable</label><input type="radio" id="ua" value="0" name="ava">
        <input type="submit" value="ADD">

    </fieldset>

</form>

        <?php
    }

?>


<script>

let imgname = document.getElementById("i");
let img = document.getElementById("img");

imgname.addEventListener('input' ,_=>{
    if(imgname.files.length != ""){
    img.src = "../../../img/"+imgname.files[0].name;
    img.style.display = "block"
    }
    else{
        img.src = "";
        img.style.display = 'none';
        img.alt = "Chosse an image"

    }
})

</script>






   
</body>
</html>