<?php
include_once("../database/database_config.php");
include_once('../database/send_mail.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(array_key_exists("addNewJob",$_POST)){
    $id = $_SESSION['ses_user_id'];
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $category = $_POST['category'];
    $jtype = $_POST['jtype'];
    $stype = $_POST['stype'];
    $salary = $_POST['salary'];
    $company = $_POST['company'];
    $district = $_POST['district'];
    $sql = "INSERT INTO jobs VALUES (NULL,'$id','$title','$desc','$salary','$stype','$jtype','$category','$district','1',NULL)";
    if($__conn->query($sql) === TRUE){
        $data = [ 'code' => 'code_1'];
    } else {
        $data = [ 'code' => 'code_2'];
    }
    header('Content-type: application/json');
    echo json_encode( $data );
}
?>