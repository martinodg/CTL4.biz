<?
require_once("../../conectar7.php");

$accion=$_GET["accion"];
$id_role=$_GET["idrole"];
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
    if ($accion == "quitar") {
        if ($id_role==1 && (in_array($id_reso, array("8")))) {
            $data["mensaje"]= "It's not Possible to remove a resource containing users and roles privileges for admin role";  
            
        }else{
                $verify="UPDATE resourcesToRolesTable SET borrado='1' WHERE id_role = $id_role AND id_resource = $id_reso";
                $rs_verify=mysqli_query($conexion,$verify);
                if (mysqli_affected_rows($conexion) == "0") {
                    $query="INSERT INTO resourcesToRolesTable (id_resource, id_role, borrado) VALUES ('$id_reso','$id_role','1')";
                    $rs_query=mysqli_query($conexion,$query);
                }
        }
        mysqli_close($conexion);
    }
    echo json_encode($data);
?>

