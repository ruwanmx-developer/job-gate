<?php 
include_once("../database/database_config.php");
include_once('../database/send_mail.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// admin search function
if(array_key_exists("adminSearchCompany", $_POST)){
    $search = $_POST['search_val'];
    $state = $_POST['state'];
    $sql = "SELECT a.name, a.logo, a.user_id, b.state, b.email FROM companies a INNER JOIN users b ON a.user_id = b.user_id WHERE a.name LIKE '%$search%' AND b.state=$state";
    $result = $__conn->query($sql);
    $count = 0;
    $__siteroot = ".";
    while($row = $result->fetch_assoc()) {
        $count++;
        echo '<div class="col-12 col-md-6 col-xl-4">';
        include('../user_admin/components/admin_company_card.php');
        echo '</div>';
    }
    if($count == 0){ 
        echo '<div class="d-flex justify-content-center">
        <div class="empty pt-5">
            <div class="empty-img">
                <img src="./img/empty.png" alt="">
            </div>
            <div class="empty-message b">
                Oops! There are no companies to view.
            </div>
        </div>
    </div>';
     }
}

// admin change stste of a company
if(array_key_exists("change_company_state", $_POST)){
    $id = $_POST['id'];
    $state = $_POST['state'];
    $sql = "SELECT * FROM users WHERE user_id='$id'";
    $result = $__conn->query($sql);
    $data = "";
    if ($result->num_rows == 0) {
        $data = [ 'code' => 'code_1' ]; // unexpected error 
    } else {
        $sql1 = "UPDATE users SET state = $state WHERE user_id = '$id'";
        if ($__conn->query($sql1) === TRUE) {

            // sendmail
            // $sql = "SELECT * FROM users WHERE user_id='$id'";
            // $result = $__conn->query($sql);
            // $row = $result->fetch_assoc();
            // $type = ($row['role_id'] == 2) ? "Employee" : "Company" ;
            // $state =  ($row['state'] == 1) ? "Active" : "Blocked" ;
            // $subject = 'Account State Changed';

            // $message = "Hello " . $row['email']. ",<br>";
            // $message .= "Our administration had desided to change your state of your $type account to $state. You can go to your profile and check out for more details.";
            // $headers = "From: Job Gate System\r\n";
            // $headers .= "Content-type: text/html\r\n";
            
            // mail($to, $subject, $message, $headers);
            $data = [ 'code' => 'code_2']; // company acepted
        } else {
            $data = [ 'code' => 'code_1']; // unexpected error
        }
    }
    header('Content-type: application/json');
    echo json_encode( $data );
}

// update job categories
if(array_key_exists("updateJobCategory", $_POST)){
    $name = $_POST['category'];
    $id = $_POST['id'];
    $data = "";
    if($id == '_1'){
        $sql = "INSERT INTO job_categories VALUES (NULL, '$name')";
        if($__conn->query($sql) === TRUE){
            $data = [ 'code' => 'code_2' ];
        } else {
            $data = [ 'code' => 'code_1' ];
        }
    } else {
    $sql = "SELECT * FROM job_categories WHERE id='$id'";
    $result = $__conn->query($sql);
    if ($result->num_rows == 1) {
        $sql = "UPDATE job_categories SET name = '$name' WHERE id='$id'";
        if($__conn->query($sql) === TRUE){
            $data = [ 'code' => 'code_2' ];
        } else {
            $data = [ 'code' => 'code_1' ];
        }
    } else {
        $data = [ 'code' => 'code_1' ];
    }
}
    header('Content-type: application/json');
    echo json_encode( $data );
}

// update job types
if(array_key_exists("updateJobType", $_POST)){
    $name = $_POST['type'];
    $id = $_POST['id'];
    $data = "";
    if($id == '_1'){
        $sql = "INSERT INTO job_types VALUES (NULL, '$name')";
        if($__conn->query($sql) === TRUE){
            $data = [ 'code' => 'code_2' ];
        } else {
            $data = [ 'code' => 'code_1' ];
        }
    } else {
    $sql = "SELECT * FROM job_types WHERE id='$id'";
    $result = $__conn->query($sql);
    if ($result->num_rows == 1) {
        $sql = "UPDATE job_types SET name = '$name' WHERE id='$id'";
        if($__conn->query($sql) === TRUE){
            $data = [ 'code' => 'code_2' ];
        } else {
            $data = [ 'code' => 'code_1' ];
        }
    } else {
        $data = [ 'code' => 'code_1' ];
    }
}
    header('Content-type: application/json');
    echo json_encode( $data );
}

?>