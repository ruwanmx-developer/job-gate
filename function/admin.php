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
                    <img src="../site_images/empty.png" alt="">
                </div>
                <div class="empty-message b">
                    Oops! There are no company matching your filters to view.
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
        $sql1 = "UPDATE users SET state = 1 WHERE user_id = '$id'";
        if ($__conn->query($sql1) === TRUE) {
            $data = [ 'code' => 'code_2']; // company acepted
        } else {
            $data = [ 'code' => 'code_1']; // unexpected error
        }
    }
    header('Content-type: application/json');
    echo json_encode( $data );
}



?>