<?php 
include_once("../database/database_config.php");
include_once('../database/send_mail.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// log out function 
if(array_key_exists("logout", $_GET)){
    session_destroy();
    header("location: ../index.php");
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

// user forgot password
if(array_key_exists("userForgotPassword", $_POST)){
    $email = $_POST['email'];
    $data = "";
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $__conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $sql = "SELECT * FROM password_resets WHERE email='$email'";
        $result = $__conn->query($sql);
        if ($result->num_rows == 0) {
            $data = [ 'code' => 'code_4' ];
        } else {
            $ps = $row['password'];
            $token = md5($email . $ps);
            $sql = "INSERT INTO password_resets VALUES (NULL, '$email', '$token')";
            if($__conn->query($sql) === TRUE){
                $resetLink = $__site_url ."/". "reset_password.php?token=" . $token;

                // sendmail
                $to = $email;
                $subject = 'Reset Password';

                $message = "Welcome " . $email. ",<br>";
                $message .= "Forgot your password?<br><br>";
                $message .= "We received a request to reset the password for your account.<br><br>";
                $message .= "To reset your password, click on the button below:<br>";
                $message .= "<a href=" .$resetLink. "> <button>Reset Password</button> <a/><br><br>";
                $message .= "Or copy and paste  the URL into your browser:<br>";
                $message .= "<a href='".$resetLink."'>" .$resetLink. "</a>" ;

                $headers = "From: Job Gate System\r\n";
                $headers .= "Content-type: text/html\r\n";
                
                if(mail($to, $subject, $message, $headers) === TRUE){
                    $data = [ 'code' => 'code_2' ];
                } else {
                    $data = [ 'code' => 'code_3' ];
                }
                
            } else {
                $data = [ 'code' => 'code_3' ];
            }
        }
    } else {
        $data = [ 'code' => 'code_1' ];
    }
    header('Content-type: application/json');
    echo json_encode( $data );
}

?>