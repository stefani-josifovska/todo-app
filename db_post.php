<?php
header('Access-Control-Allow-Origin: *');
header("content-type: application/json");
// header('"Access-Control-Allow-Credentials" : true ');
$sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "todo_list";

try {
    // $id = $_POST['id'];
    // $title = $_POST['title'];
    // $description = $_POST['description'];
    // $person = $_POST['person'];
    // $isDone = $_POST['isDone'];
    // $doneTime = $_POST['doneTime'];

    $connect = new PDO("mysql:host=$sName;db_name=$db_name", $uName,$pass);
    $connect -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $received_data = json_decode(file_get_contents("php://input"));
    $data = array(
        ':id' => $received_data->id,
        ':title' => $received_data->title,
        ':description' => $received_data->description,
        ':person' => $received_data->person,
        ':isDone' => $received_data->isDone,
        ':doneTime' => $received_data->doneTime
    );

    $query = "INSERT INTO $db_name.tasks (id, title, description, person, isDone, doneTime) 
     VALUES ( :id, :title, :description, :person, :isDone, null)";

    $statement = $connect->prepare($query);
    $statement->execute();

    // header("Access-Control-Allow-Origin: *");
    
} catch (PDOException $e) {
    // echo "Connection failed : " . $e -> getMessage();
}

?>