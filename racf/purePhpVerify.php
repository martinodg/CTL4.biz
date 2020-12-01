<?
 if(session_id() == ''){
    session_start();
 }

$id_intUser=$_SESSION["id"];
require_once(__DIR__.'/../conectar7.php');
if (!$conexion) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
$consulta="SELECT rolesToUsersTable.id_role, resourcesTable.id_resource, subResourceTable.id_sresource FROM rolesToUsersTable, resourcesTable, subResourceTable, resourcesToRolesTable, subresourcesToRolesTable WHERE rolesToUsersTable.id_intUser= $id_intUser AND resourcesToRolesTable.id_role=rolesToUsersTable.id_role and rolesToUsersTable.borrado=0 AND resourcesToRolesTable.id_resource=resourcesTable.id_resource and resourcesToRolesTable.borrado=0 and resourcesToRolesTable.id_resource= $id_resource and subResourceTable.id_sresource= $id_sresource and subResourceTable.id_sresource=subresourcesToRolesTable.id_subresource AND subresourcesToRolesTable.borrado=0;";
$rs_tabla = mysqli_query($conexion,$consulta);
$nr_lineas= mysqli_num_rows($rs_tabla);
if ($nr_lineas>0) {
    return;
}else{
    header("Location: /racf/forbiden.html");
}
?>
