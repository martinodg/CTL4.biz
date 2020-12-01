<?
session_start();
require_once("../conectar7.php");

$id_resource=$_GET["idResource"];
$id_sresource=$_GET["idSresource"];
$id_intUser=$_SESSION["id"];

$consulta="SELECT rolesToUsersTable.id_role, resourcesTable.id_resource, subResourceTable.id_sresource FROM rolesToUsersTable, resourcesTable, subResourceTable, resourcesToRolesTable, subresourcesToRolesTable WHERE rolesToUsersTable.id_intUser= $id_intUser AND resourcesToRolesTable.id_role=rolesToUsersTable.id_role and rolesToUsersTable.borrado=0 AND resourcesToRolesTable.id_resource=resourcesTable.id_resource and resourcesToRolesTable.borrado=0 and resourcesToRolesTable.id_resource= $id_resource and subResourceTable.id_sresource= $id_sresource and subResourceTable.id_sresource=subresourcesToRolesTable.id_subresource AND subresourcesToRolesTable.borrado=0;";
$rs_tabla = mysqli_query($conexion,$consulta);
$nr_lineas= mysqli_num_rows($rs_tabla);

if ($nr_lineas>0) {
    $status= "Allowed";
}else{
    $status= "Forbiden";  
}
$data["res"]= $id_resource;
$data["subres"]= $id_sresource;
$data["intuser"]= $id_intUser;
$data["answer"]= $status;  

echo json_encode($data);
?>
