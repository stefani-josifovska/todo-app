<?php
$sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "todo_list";

try {
    $connect = new PDO("mysql:host=$sName;db_name=$db_name", $uName,$pass);
    $connect -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // received data:
    $data = array();

    $query = "SELECT * FROM $db_name.tasks";
    $statement = $connect->prepare($query);
    $statement->execute();
    while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    header("Access-Control-Allow-Origin: *");
    header("content-type: application/json");
    echo json_encode($data);
    // echo "Connected!";
} catch (PDOException $e) {
    echo "Connection failed : " . $e -> getMessage();
}
?>