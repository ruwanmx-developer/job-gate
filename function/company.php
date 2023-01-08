<?php
include_once("../database/database_config.php");
include_once('../database/send_mail.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$data = "";

if (array_key_exists('updateEmail', $_POST)) {
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
        if ($__conn->query($sql2) === TRUE) {
            $data = ['code' => 'code_1'];
            $_SESSION['ses_email'] = $email;
        } else {
            $data = ['code' => 'code_2']; // unexpected error
        }
    } else {
        $data = ['code' => 'code_2']; // no companies id 
    }
    // $__conn->query('SET FOREIGN_KEY_CHECKS = 1;');
    header('Content-type: application/json');
    echo json_encode($data);
}

if (array_key_exists('updatePassword', $_POST)) {
    $cpass = $_POST['cr_password'];
    $pass = $_POST['new_password'];
    $id = $_POST['id'];
    $sql1 = "SELECT * FROM users WHERE user_id='$id' AND password='$cpass'";
    $result = $__conn->query($sql1);
    if ($result->num_rows == 1) {
        $sql2 = "UPDATE users SET password='$pass' WHERE user_id='$id'";
        if ($__conn->query($sql2) === TRUE) {
            $data = ['code' => 'code_1']; // ok
        } else {
            $data = ['code' => 'code_2']; // unexpected error
        }
    } else {
        $data = ['code' => 'code_3']; // invalid password
    }
    header('Content-type: application/json');
    echo json_encode($data);
}

if (array_key_exists('updateDescription', $_POST)) {
    $description = $_POST['description'];
    $id = $_POST['id'];
    $sql = "UPDATE companies SET description='$description' WHERE user_id='$id'";
    if ($__conn->query($sql) === TRUE) {
        $data = ['code' => 'code_1']; // ok
    } else {
        $data = ['code' => 'code_2']; // unexpected error
    }
    header('Content-type: application/json');
    echo json_encode($data);
}

if (array_key_exists('updateAddress', $_POST)) {
    $caddress = $_POST['caddress'];
    $id = $_POST['id'];
    $sql = "UPDATE companies SET address='$caddress' WHERE user_id='$id'";
    if ($__conn->query($sql) === TRUE) {
        $data = ['code' => 'code_1']; // ok
    } else {
        $data = ['code' => 'code_2']; // unexpected error
    }
    header('Content-type: application/json');
    echo json_encode($data);
}

if (array_key_exists('updateCompanyName', $_POST)) {
    $cname = $_POST['cname'];
    $id = $_POST['id'];
    $sql = "UPDATE companies SET name='$cname' WHERE user_id='$id'";
    if ($__conn->query($sql) === TRUE) {
        $data = ['code' => 'code_1']; // ok
    } else {
        $data = ['code' => 'code_2']; // unexpected error
    }
    header('Content-type: application/json');
    echo json_encode($data);
}
if (array_key_exists('updateWebsite', $_POST)) {
    $website = $_POST['website'];
    $id = $_POST['id'];
    $sql = "UPDATE companies SET website='$website' WHERE user_id='$id'";
    if ($__conn->query($sql) === TRUE) {
        $data = ['code' => 'code_1']; // ok
    } else {
        $data = ['code' => 'code_2']; // unexpected error
    }
    header('Content-type: application/json');
    echo json_encode($data);
}
if (array_key_exists('updateLinkedIn', $_POST)) {
    $linkedin = $_POST['linkedin'];
    $id = $_POST['id'];
    $sql = "UPDATE companies SET linkedin='$linkedin' WHERE user_id='$id'";
    if ($__conn->query($sql) === TRUE) {
        $data = ['code' => 'code_1']; // ok
    } else {
        $data = ['code' => 'code_2']; // unexpected error
    }
    header('Content-type: application/json');
    echo json_encode($data);
}
if (array_key_exists('updateMobile', $_POST)) {
    $mobile = $_POST['mobile'];
    $id = $_POST['id'];
    $sql = "UPDATE companies SET mobile='$mobile' WHERE user_id='$id'";
    if ($__conn->query($sql) === TRUE) {
        $data = ['code' => 'code_1']; // ok
    } else {
        $data = ['code' => 'code_2']; // unexpected error
    }
    header('Content-type: application/json');
    echo json_encode($data);
}
if (array_key_exists('updateLogo', $_POST)) {
    $logo = $_POST['logo'];
    $id = $_POST['id'];
    $sql1 = "SELECT * FROM companies WHERE user_id='$id'";
    $result1 = $__conn->query($sql1);
    if ($result1->num_rows == 1) {
        $row1 = $result1->fetch_assoc();
        unlink('../uploads/user/' . $row1['logo']);
        $date = date('YmdHis');
        $image = "user_" . $id . $date . ".png";
        list($type, $logo) = explode(';', $logo);
        list(, $logo) = explode(',', $logo);
        $logo = base64_decode($logo);
        file_put_contents('../uploads/user/' . $image, $logo);
        $sql = "UPDATE companies SET logo='$image' WHERE user_id='$id'";
        if ($__conn->query($sql) === TRUE) {
            $data = ['code' => 'code_1']; // ok
        } else {
            $data = ['code' => 'code_2']; // unexpected error
        }
    }
    header('Content-type: application/json');
    echo json_encode($data);
}

// admin search function
if (array_key_exists("companySearchJobs", $_POST)) {
    $search = $_POST['search_val'];
    $state = $_POST['state'];
    $sql = "SELECT a.id, a.title, b.name AS category, a.description,a.created_at, c.name AS salary_type, a.salary FROM jobs a INNER JOIN job_categories b ON a.job_category_id = b.id INNER JOIN salary_types c ON a.salary_type_id = c.id WHERE title LIKE '%$search%' AND state='$state' AND user_id='" . $_SESSION['ses_user_id'] . "'";
    $result = $__conn->query($sql);
    $count = 0;
    $__siteroot = ".";
    while ($row = $result->fetch_assoc()) {
        $count++;
        echo '<div class="col-12 col-md-6 col-xl-4">';
        include('../user_company/components/job_card.php');
        echo '</div>';
    }
    if ($count == 0) {
        echo '<div class="d-flex justify-content-center">
        <div class="empty pt-5">
            <div class="empty-img">
                <img src="./img/empty.png" alt="">
            </div>
            <div class="empty-message b">
                Oops! There are no data to view.
            </div>
        </div>
    </div>';
    }
}
// admin search function
if (array_key_exists("filterCompanyByAll", $_POST)) {
    $search = $_POST['search_val'];
    $dist = $_POST['dist'];
    $sql = "SELECT a.* FROM companies a INNER JOIN users c ON a.user_id=c.user_id WHERE c.state=1 AND a.name LIKE '%$search%' AND a.district_id LIKE '%$dist%'";
    $result = $__conn->query($sql);
    $count = 0;
    $__siteroot = ".";
    while ($row = $result->fetch_assoc()) {
        $count++;

        include('../components/company_card.php');
    }
    if ($count == 0) {
        echo '<div class="d-flex justify-content-center">
        <div class="empty pt-5">
                    <div class="empty-img">
                        <img src="https://cdn-icons-png.flaticon.com/512/4076/4076402.png" alt="">
                    </div>
                    <div class="empty-message b">
                        There are no data to show today
                    </div>
                    <div class="empty-message r">
                        Make sure that everything is spelt correctly or try different keywords.
                    </div>
                </div>
    </div>';
    }
}

// follow function
if (array_key_exists("followChange", $_POST)) {
    $id = $_POST['id'];
    $user_id = $_SESSION['ses_user_id'];
    $sql = "SELECT * FROM follows WHERE user_id='$user_id' AND company_id='$id'";
    $result = $__conn->query($sql);
    if ($result->num_rows == 1) {
        $sql2 = "DELETE FROM follows WHERE user_id='$user_id' AND company_id='$id'";
    } else {
        $sql2 = "INSERT INTO follows VALUES(NULL, '$user_id', '$id')";
    }
    if ($__conn->query($sql2) === TRUE) {
        $data = ['code' => 'code_2']; // ok
    } else {
        $data = ['code' => 'code_1']; // unexpected error
    }
    header('Content-type: application/json');
    echo json_encode($data);
}

// reject application
if (array_key_exists("rejectApplication", $_POST)) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM job_applications WHERE id='$id'";
    $result = $__conn->query($sql);
    if ($result->num_rows == 1) {
        $sql2 = "UPDATE job_applications SET status=3,responded_date=CURTIME() WHERE id='$id'";
        if ($__conn->query($sql2) === TRUE) {
            $data = ['code' => 'code_2']; // ok
        } else {
            $data = ['code' => 'code_1']; // unexpected error
        }
    } else {
        $data = ['code' => 'code_1']; // unexpected error
    }

    header('Content-type: application/json');
    echo json_encode($data);
}
if (array_key_exists("changeJobState", $_POST)) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM jobs WHERE id='$id'";
    $result = $__conn->query($sql);
    if ($result->num_rows == 1) {
        $sql2 = "UPDATE jobs SET state=2 WHERE id='$id'";
        if ($__conn->query($sql2) === TRUE) {
            $data = ['code' => 'code_2']; // ok
        } else {
            $data = ['code' => 'code_1']; // unexpected error
        }
    } else {
        $data = ['code' => 'code_1']; // unexpected error
    }

    header('Content-type: application/json');
    echo json_encode($data);
}

if (array_key_exists("inviteUser", $_POST)) {
    $user_id = $_POST['user_id'];
    $company_id = $_POST['company_id'];
    $data = "";
    $sql = "SELECT a.*, b.email FROM employies a INNER JOIN users b ON a.user_id=b.user_id WHERE a.user_id='$user_id'";
    $result = $__conn->query($sql);
    if ($result->num_rows == 1) {
        $row1 = $result->fetch_assoc();
        $sql = "SELECT * FROM companies WHERE user_id='$company_id'";
        $result = $__conn->query($sql);
        if ($result->num_rows == 1) {
            $row2 = $result->fetch_assoc();
            // sendmail
            $to = $row1['email'];
            $subject = 'Recuit Invitation';
            $resetLink = $__site_url . "/" . "view_company.php?id=" . $company_id;
            $message = "Welcome " . $row1['first_name'] . ",<br>";
            $message .= "Happy News for you !<br><br>";
            $message .= "We have seen your skills matching our requirement.<br><br>";
            $message .= "Contact us using this link to contact us.<br>";
            $message .= "<a href=" . $resetLink . "> <button>View Company</button> <a/><br><br>";
            $message .= "Or copy and paste  the URL into your browser:<br>";
            $message .= "<a href='" . $resetLink . "'>" . $resetLink . "</a>";

            $headers = "From: Job Gate System\r\n";
            $headers .= "Content-type: text/html\r\n";

            if (mail($to, $subject, $message, $headers) === TRUE) {
                $data = ['code' => 'code_2'];
            } else {
                $data = ['code' => 'code_1'];
            }
        } else {
            $data = ['code' => 'code_1'];
        }
    } else {
        $data = ['code' => 'code_1'];
    }
    header('Content-type: application/json');
    echo json_encode($data);
}