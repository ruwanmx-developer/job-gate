<?php 
include_once("../database/database_config.php");
include_once('../database/send_mail.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// user login function
if(array_key_exists("user_login",$_POST)){
    $_email = $_POST["email"];
    $enc_password = $_POST["password"];
    $sql = "SELECT * FROM users WHERE email='$_email'";
    $result = $__conn->query($sql);
    $data = "";
    if ($result->num_rows == 0) {
        $data = [ 'code' => 'code_1' ];
    } else{
        $sql = "SELECT * FROM users WHERE email='$_email' AND password='$enc_password'";
        $result = $__conn->query($sql);
        if ($result->num_rows == 0) {
            $data = [ 'code' => 'code_2' ];
        } else {
            $row = $result->fetch_assoc();
            $_SESSION['ses_user_id'] = $row['user_id'];
            $_SESSION['ses_email'] = $row['email'];
            $_SESSION['ses_role_id'] = $row['role_id'];
            $_SESSION['ses_user_state'] = $row['state'];
            if($row['role_id'] == 2){
                $_SESSION['ses_full_name'] = $row['first_name']. " ".$row['last_name'];
                $_SESSION['ses_first_name'] = $row['first_name'];
                $_SESSION['ses_last_name'] = $row['last_name'];
            }
            if($row['role_id'] == 3){
                $sql1 = "SELECT * FROM company WHERE email='$_email'";
                $result1 = $__conn->query($sql1);
                $row1 = $result1->fetch_assoc();
                $_SESSION['ses_company_name'] = $row['first_name'];
                $_SESSION['ses_company_id'] = $row1['id'];
            }
            $data = [ 'code' => 'code_3', 'role' => $row['role_id'] ];
        }
    }  
    header('Content-type: application/json');
    echo json_encode( $data );
}
?>