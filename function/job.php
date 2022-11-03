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
    $data = "";
    $sql = "INSERT INTO jobs VALUES (NULL,'$id','$title','$desc','$salary','$stype','$jtype','$category','$district','1',NULL)";
    if($__conn->query($sql) === TRUE){
        $data = [ 'code' => 'code_1'];
    } else {
        $data = [ 'code' => 'code_2'];
    }
    header('Content-type: application/json');
    echo json_encode( $data );
}

if(array_key_exists("apply_job",$_POST)){
    $id = $_SESSION['ses_user_id'];
    $job_id = $_POST['id'];
    $data = "";
    $sql = "SELECT * FROM job_applications WHERE user_id='$id' AND job_id='$job_id' AND status=1";
    $result = $__conn->query($sql);
    if ($result->num_rows == 1) {
        $data = [ 'code' => 'code_1']; // job application have
    } else {
        $sql2 = "INSERT INTO job_applications VALUES(NULL, '$id', '$job_id',1,NULL,CURDATE(),NULL)";
        if($__conn->query($sql2) === TRUE){
            $data = [ 'code' => 'code_2']; // success
        } else {
            $data = [ 'code' => 'code_3']; // unexpected
        }
    }
    header('Content-type: application/json');
    echo json_encode( $data );
}
?>