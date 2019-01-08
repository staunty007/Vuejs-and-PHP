<?php
header('Access-Control-Allow-Headers: Content-Type');
header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);
require_once('../inc/conn.php');

$action = 'read';

if(isset($_GET['action'])){
    $action = $_GET['action'];
}


if($action == 'create') {

    $name = $input['name'];
    $email = $input['email'];
    $mobile = $input['mobile'];
    $password = $input['password'];

    if (empty($email) || empty($password) || empty($mobile) || empty($password)) {
        echo json_encode(['error' => 'Fields Required']);
        die();
    }

    $check_users = $conn->query("SELECT * from users where email = '$email'");
    if ($check_users->num_rows > 0) {
        echo json_encode(['error' => 'Email Address Already Exsists']);
        die();
    }
    
    $result = $conn->query("INSERT INTO users (`name`,email,mobile,`password`) VALUES ('$name','$email','$mobile','$password')");

    if($result) {
        echo json_encode(['success' => 'User Added successfully']);
    } else {
        echo json_encode(['error' => 'Cannot Add User at the Moment, Please Try Again']);
        
    }
}

if ($action == 'read') {
    $all_users = $conn->query("SELECT * FROM users ORDER BY id DESC");
    //$users = array();
    while(
        $row = $all_users->fetch_assoc()
       ){
       //array_push($users,$row);
       $users[] = $row;
        echo json_encode(['users' => (array) $users]);
    }
}


?>
