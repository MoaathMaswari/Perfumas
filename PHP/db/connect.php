<?php

try{

$perfumas = new PDO("mysql:host=localhost;dbname=perfumas","root","");

}
catch(PDOException)
{
echo "Sorry, something went wrong! Try again later." ;
exit();
echo "hi";

}

?>
