<?php
session_start();
unset($_SESSION["id"]); 
unset($_SESSION["intUser"]);
unset($_SESSION["BaseDeDatos"]); 
unset($_SESSION["Usuario_DB"]); 
unset($_SESSION["Password_DB"]);
//header("Location:login.php");    
echo"<script>
   parent.changeURL('../index.php');
</script>";

?>

