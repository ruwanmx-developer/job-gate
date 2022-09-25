<?php

include_once("../database/database_config.php");
include_once('../database/send_mail.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// com signup function
if(array_key_exists("com_signup",$_POST)){
    $email = $_POST["email"];
    $enc_password = $_POST["password"];
    $cname = $_POST["cname"];
    $caddress = $_POST["caddress"];
    $description = $_POST["description"];
    $logo = $_POST["logo"];
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $__conn->query($sql);
    $data = "";
    if ($result->num_rows > 0) {
        $data = [ 'code' => 'code_1' ]; // email exists
    } else{
        $sql2 = "INSERT INTO users VALUES (NULL, '$email', '$enc_password', 3, 3)";
        if ( ($__conn->query($sql2) === TRUE)) {
            $sql3 = "SELECT * FROM users WHERE email='$email'";
            $result = $__conn->query($sql3);
            $row = $result->fetch_assoc();
            $image = "user_" . $row['user_id'] . ".png";
            list($type, $logo) = explode(';', $logo);
            list(, $logo) = explode(',', $logo);
            $logo = base64_decode($logo);
            file_put_contents('../uploads/user/' . $image, $logo);
            $sql = "INSERT INTO companies VALUES ('".$row['user_id']."', '$cname', '$caddress',NULL,'$description', '$image', NULL,NULL,NULL)";
            if ( ($__conn->query($sql) === TRUE)) {
                $_SESSION['ses_email'] = $email;
                $_SESSION['ses_company_name'] = $cname;
                $_SESSION['ses_role_id'] = 3;
                $_SESSION['ses_user_state'] = 2;
                $data = [ 'code' => 'code_3', 'role' => 3 ]; // success
            } else {
                $data = [ 'code' => 'code_2' ]; // unexpected
            }
        } else {
            $data = [ 'code' => 'code_2' ]; // unexpected
        }
    }
    header('Content-type: application/json');
    echo json_encode( $data );
}

// emp signup function
if(array_key_exists("emp_signup",$_POST)){
    $email = $_POST["email"];
    $enc_password = $_POST["password"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $logo = $_POST["image"];
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $__conn->query($sql);
    $data = "";
    if ($result->num_rows > 0) {
        $data = [ 'code' => 'code_1' ]; // email exists
    } else{
        $sql2 = "INSERT INTO users VALUES (NULL, '$email', '$enc_password', 1, 2)";
        if ( ($__conn->query($sql2) === TRUE)) {
            $sql3 = "SELECT * FROM users WHERE email='$email'";
            $result = $__conn->query($sql3);
            $row = $result->fetch_assoc();
            $image = "user_" . $row['user_id'] . ".png";
            list($type, $logo) = explode(';', $logo);
            list(, $logo) = explode(',', $logo);
            $logo = base64_decode($logo);
            file_put_contents('../uploads/user/' . $image, $logo);
            $sql = "INSERT INTO employies VALUES ('".$row['user_id']."', '$fname', '$lname',NULL,'$image', NULL, NULL,NULL,NULL,NULL,NULL)";
            if ( ($__conn->query($sql) === TRUE)) {
                $_SESSION['ses_email'] = $email;
                $_SESSION['ses_full_name'] = $fname . " " . $lname;
                $_SESSION['ses_first_name'] = $fname;
                $_SESSION['ses_role_id'] = 2;
                $_SESSION['ses_user_state'] = 1;
                $data = [ 'code' => 'code_3', 'role' => 2 ]; // success
            } else {
                $data = [ 'code' => 'code_2' ]; // unexpected
            }
        } else {
            $data = [ 'code' => 'code_2' ]; // unexpected
        }
    }
    header('Content-type: application/json');
    echo json_encode( $data );
}
?>