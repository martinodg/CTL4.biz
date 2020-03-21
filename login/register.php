<?php
include("../conectar.php"); 
$compania=$_POST["company_name"];
$nombre=$_POST["name"];
$emilio=$_POST["email"];
$clave=$_POST["password"];
$language=$_POST["language"];


// ************************functions****************************
//convert string to hex code
function strToHex($string){
    $hex='';
    for ($i=0; $i < strlen($string); $i++){
        $hex .= dechex(ord($string[$i]));
    }
    return $hex;
}
// *************************************************************

// ************************functions****************************
//convert string to MD5 code
function strToMD5($string){
    $md5strng= "T_".md5($string);
    $cleaner = trim(strip_tags($md5strng));
    return $cleaner;
}
// *************************************************************


// verify if company and mail already exist
$query_verify="SELECT * FROM login_user, user_data WHERE login_user.user_name='".$emilio."' and user_data.company_name='".$compania."';";
$rs_verify =mysqli_query($conexion,$query_verify);

//if company and name do not exist
if (mysqli_num_rows($rs_verify)==0) {
    $id_company=strToMD5($compania."_".$emilio);
    echo "El nombre de la base de datos es: ".$id_company."<br>";
    $query_login_insert="INSERT INTO login_user (id_company,user_name,password) VALUES ('$id_company','$emilio','$clave');";
    $rs_login_insert=mysqli_query($conexion,$query_login_insert);
    //echo "<script>alert('Your account has been created succesfully, enjoy CTL4.biz!!!');</script>";
    //echo "el servidor de base de datos es: ".$Servidor."<br>";
    //echo "el usuario es: ".$Usuario."<br>";
    //echo "la password es: ".$Password."<br>";  
    mysqli_close($conexion);
    // Create connection
    $conn1 = new mysqli($Servidor,$Usuario,$Password);
    // Check connection
    if ($conn1->connect_error) {
        die("connection failed: " . $conn1->connect_error)."<br>";
    }
    
    // Create database
    echo "Creando base de datos<br>";
    $sql = "CREATE DATABASE ".$id_company.";";
    echo $sql."<br>";
    if ($conn1->query($sql) === TRUE) {
        echo "Database created successfully<br>";
    } else {
        echo "Error creating database: " . $conn1->error ."<br>";
    }
    echo "**********************************************************<br>";
    echo "Creando usuario<br>";
    // Create User for Database
    $sql2 = "GRANT CREATE ON $id_company.* TO '$emilio'@'%' IDENTIFIED BY '$clave';";
    echo $sql2."<br>";
    if ($conn1->query($sql2) === TRUE) {
        echo "User created successfully<br>";
    } else {
        echo "Error creating user: " . $conn1->error."<br>";
    }
    echo "**********************************************************<br>";
    echo "Dando privilegios al usuario<br>";
    // Grant permisions to user for new DB
    $sql3 = "GRANT SELECT, INSERT, ALTER, UPDATE, CREATE, LOCK TABLES ON $id_company.* TO '$emilio'@'%';";
    echo $sql3."<br>";
    if ($conn1->query($sql3) === TRUE) {
        echo "Privileges granted successfully<br>";
    } else {
        echo "Error granting permits: " . $conn1->error."<br>";
    }
    $conn1->close();
    echo "**********************************************************<br>";
    echo "Importando tabla<br>";
    //load model DB on the new created DB  
    $sql4 = file_get_contents('../database'.$language.'.sql');
    $conn2 = new mysqli("$Servidor", "$emilio", "$clave", "$id_company");
    if (mysqli_connect_errno()) { /* check connection */
        printf("connect failed: %s\n", mysqli_connect_error());
        exit();
    }

/* execute multi query */
if ($conn2->multi_query($sql4)) {
    echo "success<br>";
    echo $sql4;
} else {
   echo "error<br>";
   echo $sql4;
}
    $conn2->close();
    echo"<script>
        window.location = 'login.php';
    </script>";
    exit;
}else{
    //if company and mail exist send alert and back to register form
    if ($language=="0"){
        $errorm='The Company name and email you just entered already exist as CTL4.biz registered user';
    }else{
        $errorm='En nombre de la compania e email provistos ya existen como usuarios de CTS4.biz';
    }
    echo "<script>alert($errorm);</script>";

    echo"<script>
        window.location = 'register.html';
    </script>";
    exit;
}
