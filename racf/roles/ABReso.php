<?
include ("../../conectar7.php");

$accion=$_GET["accion"];
$id_role=$_GET["role"];
$id_reso=$_GET["reso"];



    if ($accion == "agregar") {
    //verify existence
    $verify="UPDATE resourcesToRolesTable SET borrado='0' WHERE id_role = $id_role AND id_resource = $id_reso";
    $rs_verify=mysqli_query($conexion,$verify);
        if (mysqli_affected_rows($conexion) == "0") {
            $query="INSERT INTO resourcesToRolesTable (id_resource, id_role) VALUES ('$id_reso','$id_role')";
            $rs_query=mysqli_query($conexion,$query);
            
        }
        mysqli_close($conexion);
    }
    if ($accion == 'quitar') {
        /*$query="DELETE FROM rolesToUsersTable WHERE id_intUser = $id_role AND id_role = $id_Sreso";*/
        $query="UPDATE resourcesToRolesTable SET borrado='1' WHERE id_role = $id_role AND id_resource = $id_reso";
        $rs_query=mysqli_query($conexion,$query);
        mysqli_close($conexion);
    }
	
?>

