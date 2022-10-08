<?php
include_once("../database/database_config.php");
include_once('../database/send_mail.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(array_key_exists('updateEmail',$_POST)){
    $email = $_POST['email'];
    $id = $_POST['id'];
    $sql1 = "SELECT * FROM users WHERE user_id='$id'";
    $result = $__conn->query($sql1);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // $postEmail = $row['email'];
        // $__conn->query('SET FOREIGN_KEY_CHECKS = 0;');
        $sql2 = "UPDATE users SET email='$email' WHERE user_id='$id'";
        // $sql3 = "UPDATE users SET email='$email' WHERE email='$postEmail'";
        if($__conn->query($sql2) === TRUE){
            $data = [ 'code' => 'code_1'];
            $_SESSION['ses_email'] = $email;
        } else {
            $data = [ 'code' => 'code_2']; // unexpected error
        }
    } else {
        $data = [ 'code' => 'code_2' ]; // no companies id 
    }
    // $__conn->query('SET FOREIGN_KEY_CHECKS = 1;');
    header('Content-type: application/json');
    echo json_encode( $data );
}

if(array_key_exists('updatePassword',$_POST)){
    $cpass = $_POST['cr_password'];
    $pass = $_POST['new_password'];
    $id = $_POST['id'];
    $sql1 = "SELECT * FROM users WHERE user_id='$id' AND password='$cpass'";
    $result = $__conn->query($sql1);
    if ($result->num_rows == 1) {
        $sql2 = "UPDATE users SET password='$pass' WHERE user_id='$id'";
        if($__conn->query($sql2) === TRUE){
            $data = [ 'code' => 'code_1']; // ok
        } else {
            $data = [ 'code' => 'code_2']; // unexpected error
        }
    } else {
        $data = [ 'code' => 'code_3' ]; // invalid password
    }
    header('Content-type: application/json');
    echo json_encode( $data );
}

if(array_key_exists('updateDescription',$_POST)){
    $description = $_POST['description'];
    $id = $_POST['id'];
        $sql = "UPDATE companies SET description='$description' WHERE user_id='$id'";
        if($__conn->query($sql) === TRUE){
            $data = [ 'code' => 'code_1']; // ok
        } else {
            $data = [ 'code' => 'code_2']; // unexpected error
        }
    header('Content-type: application/json');
    echo json_encode( $data );
}

if(array_key_exists('updateAddress',$_POST)){
    $caddress = $_POST['caddress'];
    $id = $_POST['id'];
        $sql = "UPDATE companies SET address='$caddress' WHERE user_id='$id'";
        if($__conn->query($sql) === TRUE){
            $data = [ 'code' => 'code_1']; // ok
        } else {
            $data = [ 'code' => 'code_2']; // unexpected error
        }
    header('Content-type: application/json');
    echo json_encode( $data );
}

if(array_key_exists('updateCompanyName',$_POST)){
    $cname = $_POST['cname'];
    $id = $_POST['id'];
        $sql = "UPDATE companies SET name='$cname' WHERE user_id='$id'";
        if($__conn->query($sql) === TRUE){
            $data = [ 'code' => 'code_1']; // ok
        } else {
            $data = [ 'code' => 'code_2']; // unexpected error
        }
    header('Content-type: application/json');
    echo json_encode( $data );
}
if(array_key_exists('updateWebsite',$_POST)){
    $website = $_POST['website'];
    $id = $_POST['id'];
        $sql = "UPDATE companies SET website='$website' WHERE user_id='$id'";
        if($__conn->query($sql) === TRUE){
            $data = [ 'code' => 'code_1']; // ok
        } else {
            $data = [ 'code' => 'code_2']; // unexpected error
        }
    header('Content-type: application/json');
    echo json_encode( $data );
}
if(array_key_exists('updateLinkedIn',$_POST)){
    $linkedin = $_POST['linkedin'];
    $id = $_POST['id'];
        $sql = "UPDATE companies SET linkedin='$linkedin' WHERE user_id='$id'";
        if($__conn->query($sql) === TRUE){
            $data = [ 'code' => 'code_1']; // ok
        } else {
            $data = [ 'code' => 'code_2']; // unexpected error
        }
    header('Content-type: application/json');
    echo json_encode( $data );
}
if(array_key_exists('updateMobile',$_POST)){
    $mobile = $_POST['mobile'];
    $id = $_POST['id'];
        $sql = "UPDATE companies SET mobile='$mobile' WHERE user_id='$id'";
        if($__conn->query($sql) === TRUE){
            $data = [ 'code' => 'code_1']; // ok
        } else {
            $data = [ 'code' => 'code_2']; // unexpected error
        }
    header('Content-type: application/json');
    echo json_encode( $data );
}
if(array_key_exists('updateLogo',$_POST)){
    $logo = $_POST['logo'];
    $id = $_POST['id'];
    $image = "user_" . $id . ".png";
            list($type, $logo) = explode(';', $logo);
            list(, $logo) = explode(',', $logo);
            $logo = base64_decode($logo);
            file_put_contents('../uploads/user/' . $image, $logo);
        $sql = "UPDATE companies SET logo='$image' WHERE user_id='$id'";
        if($__conn->query($sql) === TRUE){
            $data = [ 'code' => 'code_1']; // ok
        } else {
            $data = [ 'code' => 'code_2']; // unexpected error
        }
    header('Content-type: application/json');
    echo json_encode( $data );
}
?>