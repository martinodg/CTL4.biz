<?
include ("../conectar7.php");

$accion=$_GET["accion"];
$id_User=$_GET["user"];
$idRole=$_GET["role"];



    if ($accion == "agregar") {
    //verify existence
    $verify="UPDATE rolesToUsersTable SET borrado='0' WHERE id_intUser = $id_User AND id_role = $idRole";
    $rs_verify=mysqli_query($conexion,$verify);
        if (mysqli_affected_rows($conexion) == "0") {
            $query="INSERT INTO rolesToUsersTable (id_role, id_intUser) VALUES ('$idRole','$id_User')";
            $rs_query=mysqli_query($conexion,$query);
            
        }
        mysqli_close($conexion);
    }
    if ($accion == 'quitar') {
        /*$query="DELETE FROM rolesToUsersTable WHERE id_intUser = $id_User AND id_role = $idRole";*/
        $query="UPDATE rolesToUsersTable SET borrado='1' WHERE id_intUser = $id_User AND id_role = $idRole";
        $rs_query=mysqli_query($conexion,$query);
        mysqli_close($conexion);
    }
	
?>

