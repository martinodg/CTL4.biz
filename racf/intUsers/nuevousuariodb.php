<?
require_once("config.php");

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
    ?>