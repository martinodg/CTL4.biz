<?
session_start();
include ("../conectar7.php");

$id_resource=$_GET["idResource"];
$id_sresource=$_GET["idSresource"];
$id_intUser=$_SESSION["intUser"];

function debug_to_console($data2deb) {
    $output = $data2deb;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}


$consulta="SELECT resourcesTable.resourceName, subResourceTable.subResourceName FROM resourcesTable, subResourceTable,`subresourcesToRolesTable`, rolesToUsersTable, resourcesToRolesTable WHERE subresourcesToRolesTable.id_role=rolesToUsersTable.id_role and subresourcesToRolesTable.borrado=0 and rolesToUsersTable.borrado=0 and rolesToUsersTable.id_intUser='$id_intUser' and resourcesToRolesTable.id_resource=$id_resource and subresourcesToRolesTable.id_subresource=$id_sresource and subResourceTable.id_sresource=subresourcesToRolesTable.id_subresource and resourcesTable.id_resource=resourcesToRolesTable.id_resource and resourcesToRolesTable.borrado=0;";
$rs_tabla = mysqli_query($conexion,$consulta);
$nr_lineas= mysqli_num_rows($rs_tabla);
echo $consulta;

//$nr_lineas=0;
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
