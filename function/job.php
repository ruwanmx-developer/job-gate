<?php
include_once("../database/database_config.php");
include_once('../database/send_mail.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (array_key_exists("addNewJob", $_POST)) {
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
    if ($__conn->query($sql) === TRUE) {
        $data = ['code' => 'code_1'];
    } else {
        $data = ['code' => 'code_2'];
    }
    header('Content-type: application/json');
    echo json_encode($data);
}
if (array_key_exists("filterJobByAll", $_POST)) {
    $search_val = $_POST['search_val'];
    $min_salary = ($_POST['min_salary'] === "") ? 0 : $_POST['min_salary'];
    $max_salary = ($_POST['max_salary'] === "") ? 99999999 : $_POST['max_salary'];
    $job_cat = $_POST['job_cat'];
    $job_type = $_POST['job_type'];
    $dist = $_POST['dist'];
    $sql = "SELECT a.id, a.title, b.name AS category, a.description, a.salary, g.name AS salary_type , f.user_id AS company_id, f.name AS company, d.district, e.name FROM jobs a INNER JOIN job_categories b ON a.job_category_id = b.id INNER JOIN districts d ON a.district_id = d.id INNER JOIN job_types e ON a.job_type_id = e.id INNER JOIN companies f ON a.user_id = f.user_id INNER JOIN salary_types g ON a.salary_type_id = g.id WHERE a.title LIKE '%$search_val%' AND a.salary >= '$min_salary' AND a.salary <= '$max_salary' AND a.job_category_id LIKE '%$job_cat%' AND a.job_type_id LIKE '%$job_type%' AND a.district_id LIKE '%$dist%'";
    $result = $__conn->query($sql);
    $count = 0;
    while ($row = $result->fetch_assoc()) {
        $count++;
        include('../components/job_card.php');
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
if (array_key_exists("apply_job", $_POST)) {
    $id = $_SESSION['ses_user_id'];
    $job_id = $_POST['id'];
    $data = "";
    $sql = "SELECT * FROM job_applications WHERE user_id='$id' AND job_id='$job_id' AND status=1";
    $result = $__conn->query($sql);
    if ($result->num_rows == 1) {
        $data = ['code' => 'code_1']; // job application have
    } else {
        $sql2 = "INSERT INTO job_applications VALUES(NULL, '$id', '$job_id',1,NULL,CURDATE(),NULL)";
        if ($__conn->query($sql2) === TRUE) {
            $data = ['code' => 'code_2']; // success
        } else {
            $data = ['code' => 'code_3']; // unexpected
        }
    }
    header('Content-type: application/json');
    echo json_encode($data);
}